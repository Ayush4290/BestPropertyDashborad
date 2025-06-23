<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meetings extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    
 	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
    }
 public function index() {
    $data['title'] = 'Meetings';
    $lead_id = $this->uri->segment('3');
    
    //$data['meeting'] = $this->AdminModel->getDataFromTable('meetings','id,lead_id,description,meeting_date,status');
    $data['meeting'] = $this->AdminModel->getDataFromTableByField($lead_id,'meetings','lead_id');
    
	$data['mainContent'] = 'siteAdmin/meetings'; 
    $this->load->view('includes/admin/template', $data);
 }

  public function addMeeting() {
    $data['title'] = 'Add Meeting'; 
  
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('meeting_date', 'Meeting date','required');
	   // $this->form_validation->set_rules('property_for', 'property for','trim|required|min_length[3]|max_length[30]');
	 
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	       $addData = array(
	            'lead_id'=> $this->uri->segment('4'),
	            'meeting_date' => $this->input->post('meeting_date'),
	            'description'=> $this->input->post('description'),
				'status'=> $this->input->post('status')
				
			);
			$result = $this->AdminModel->addDataInTable($addData,'meetings');
			if($result){
				$this->session->set_flashdata('message','Meeting added successfully.');
                redirect(base_url('admin/meeting/add/').$this->uri->segment('4'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/meetingAdd'; 
    $this->load->view('includes/admin/template', $data);
 }

 public function editMeeting() {
    $data['title'] = 'Meeting Edit'; 
 
	
	$id = $this->uri->segment('4');
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('meeting_date', 'Meeting Date','required');
	    
	  $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	       $updateData = array(
	            'meeting_date'=> $this->input->post('meeting_date'),
				'description'=> $this->input->post('description'),
				'status'=> $this->input->post('status')
				
			);
			$result = $this->AdminModel->updateTable($id,'id','meetings',$updateData);
			if($result){
				$this->session->set_flashdata('message','Meeting update successfully.');
                redirect(base_url('admin/meeting/edit').'/'.$id);
			} 
	    }
	}
	
    $id = $this->uri->segment('4');
	$data['meeting'] = $this->AdminModel->getDataFromTableByField($id,'meetings','id');
	
	$data['mainContent'] = 'siteAdmin/meetingEdit'; 
    $this->load->view('includes/admin/template', $data);
 }
 
 public function deleteMeeting(){
     
    $id = $this->uri->segment('4');
   
       $result =  $this->AdminModel->deleteRow($id,'meetings','id');
         if($result){
         $this->session->set_flashdata('message','Meetings delete successfully.');
         }
         else{
         $this->session->set_flashdata('message','Meetings not delete please try again.');
         }
     redirect(base_url('admin/meetings').'/'.$id);
 }

}
?>