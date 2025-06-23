<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deal extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
    
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
  
   	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   } 
	//if($this->session->userdata('role') != 'Admin' && $this->session->userdata('role') != 'Manager') { redirect(base_url('admin/dashboard')); }
	 if(!stristr($this->session->userdata('role'), 'Admin') && (!stristr($this->session->userdata('role'), 'Manager'))) { redirect(base_url('admin/dashboard')); }
 }
 
  public function index() {
    $data['title'] = 'Deal'; 
 

	$data['deal'] = $this->AdminModel->getDataFromTable('deal');
	$data['mainContent'] = 'siteAdmin/deal'; 
    $this->load->view('includes/admin/template', $data);
    
 }
 
 public function dealAdd() {
  $data['title'] = 'Add Deal'; 
  
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	  
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('price', 'price','trim|required');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	 
	        $insertData = array(
	            'title'=> $this->input->post('title'),
	            'description'=> $this->input->post('description'),
				'price'=> $this->input->post('price'),
			);
			$result = $this->AdminModel->addDataInTable($insertData,'deal');
			if($result == TRUE){
				$this->session->set_flashdata('message','Deal added successfully.');
                redirect(base_url('admin/deal/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/dealAdd'; 
    $this->load->view('includes/admin/template', $data);
 }

 public function dealEdit() {
    $data['title'] = 'Edit deal'; 
 
    $id = $this->uri->segment('4');
	$data['deal'] = $this->AdminModel->getDataFromTableByField($id,'deal','id');
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('price', 'price','trim|required');
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	      $updateData = array(
	            'title'=> $this->input->post('title'),
	            'description'=> $this->input->post('description'),
				'price'=> $this->input->post('price'),
				
			);
			$result = $this->AdminModel->updateTable($id,'id','deal',$updateData);
			$this->session->set_flashdata('message','Deal update successfully.');
            redirect(base_url('admin/deal/edit').'/'.$id);
	    }
	}
	
	
	$data['mainContent'] = 'siteAdmin/dealEdit'; 
    $this->load->view('includes/admin/template', $data);

 }
 
  public function dealDelete(){
     
    $id = $this->uri->segment('4');
    $data['deal'] = $this->AdminModel->deleteRow($id,'deal','id');
    redirect(base_url('admin/deal'));
  }
}