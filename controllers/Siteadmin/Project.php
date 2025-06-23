<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct(); 
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    
 	$sessionLogin = $this->session->userdata('adminLogged');  
	if(!($sessionLogin)) { redirect(base_url('site-admin'));  }
	
	if($this->session->userdata('role') != 'Admin' && $this->session->userdata('role') != 'Manager') { redirect(base_url('admin/dashboard')); }
	
    }
    
 public function index() {
    
    $data['title'] = 'Project';
    $data['project'] = $this->AdminModel->getDataFromTable('projects','id,title,start_date,complete_date,status');
    
	$data['mainContent'] = 'siteAdmin/project'; 
    $this->load->view('includes/admin/template', $data);
 
 }

  public function addProject() {
    $data['title'] = 'Add Project'; 
  
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'property name','trim|required|min_length[3]|max_length[250]');
	   // $this->form_validation->set_rules('property_for', 'property for','trim|required|min_length[3]|max_length[30]');
	 
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	       $addData = array(
	            'title'=> $this->input->post('title'),
				'start_date'=> $this->input->post('start_date'),
				'complete_date'=> $this->input->post('complete_date'),
				'special_instruction'=> $this->input->post('spe_instruction'),
				'description'=> $this->input->post('description'),
				'status'=> $this->input->post('status'),
				'old_status'=> $this->input->post('status')
				
			);
			$result = $this->AdminModel->addDataInTable($addData,'projects');
			if($result){
				$this->session->set_flashdata('message','Project added successfully.');
                redirect(base_url('admin/project/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/projectAdd'; 
    $this->load->view('includes/admin/template', $data);
 }
 public function editProject() {
    $data['title'] = 'Project Edit'; 
 
	
	$id = $this->uri->segment('4');
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'Title','trim|required|min_length[3]|max_length[250]');
	    
	  $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	       $updateData = array(
	            'title'=> $this->input->post('title'),
				'start_date'=> $this->input->post('start_date'),
				'complete_date'=> $this->input->post('complete_date'),
				'special_instruction'=> $this->input->post('spe_instruction'),
				'description'=> $this->input->post('description'),
				'tags'=> $this->input->post('tags'),
				'status'=> $this->input->post('status'),
				'old_status'=> $this->input->post('status')
				
			);
			$result = $this->AdminModel->updateTable($id,'id','projects',$updateData);
			if($result){
				$this->session->set_flashdata('message','Project update successfully.');
                redirect(base_url('admin/project/edit').'/'.$id);
			} 
	    }
	}
	

	$data['project'] = $this->AdminModel->getDataFromTableByField($id,'projects','id');
	
	$data['mainContent'] = 'siteAdmin/projectEdit'; 
    $this->load->view('includes/admin/template', $data);
 }
 
 public function deleteProject(){
     
    $id = $this->uri->segment('4');
   
       $result =  $this->AdminModel->deleteRow($id,'projects','id');
         if($result){
         $this->session->set_flashdata('message','Project delete successfully.');
         }
         else{
         $this->session->set_flashdata('message','Project not delete please try again.');
         }
     redirect(base_url('admin/projects'));
 }


}
?>