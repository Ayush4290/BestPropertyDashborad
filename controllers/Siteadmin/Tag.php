<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {
 
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
    $data['title'] = 'Tag'; 
 

	$data['tag'] = $this->AdminModel->getDataFromTable('tag');
	$data['mainContent'] = 'siteAdmin/tag'; 
    $this->load->view('includes/admin/template', $data);
    
 }
 
 public function tagAdd() {
  $data['title'] = 'Add Tag'; 
  
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	  
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	 
	        $insertData = array(
	            'title'=> $this->input->post('title'),
			);
			$result = $this->AdminModel->addDataInTable($insertData,'tag');
			if($result == TRUE){
				$this->session->set_flashdata('message','Tag added successfully.');
                redirect(base_url('admin/tag/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/tagAdd'; 
    $this->load->view('includes/admin/template', $data);
 }

 public function tagEdit() {
    $data['title'] = 'Edit Tag'; 
 
    $id = $this->uri->segment('4');
	$data['tag'] = $this->AdminModel->getDataFromTableByField($id,'tag','id');
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	      $updateData = array(
	            'title'=> $this->input->post('title'),
			);
			$result = $this->AdminModel->updateTable($id,'id','tag',$updateData);
			$this->session->set_flashdata('message','Tag update successfully.');
            redirect(base_url('admin/tag/edit').'/'.$id);
	    }
	}
	
	
	$data['mainContent'] = 'siteAdmin/tagEdit'; 
    $this->load->view('includes/admin/template', $data);

 }
 
  public function tagDelete(){
     
    $id = $this->uri->segment('4');
    $data['tag'] = $this->AdminModel->deleteRow($id,'tag','id');
    redirect(base_url('admin/tag'));
  }
}