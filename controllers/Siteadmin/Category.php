<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
    
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
  
   	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }  
	
    //	if($this->session->userdata('role') != 'Admin' && $this->session->userdata('role') != 'Manager') { redirect(base_url('admin/dashboard')); }
    if(!stristr($this->session->userdata('role'), 'Admin') && (!stristr($this->session->userdata('role'), 'Manager'))) { redirect(base_url('admin/dashboard')); }
 }
 
  public function index() {
    $data['title'] = 'Category'; 
 

	$data['category'] = $this->AdminModel->getDataFromTable('category');
	$data['mainContent'] = 'siteAdmin/category'; 
    $this->load->view('includes/admin/template', $data);
    
 }
 
 public function categoryAdd() {
  $data['title'] = 'Add Category'; 
  
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	  
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	 
	        $insertData = array(
	            'title'=> $this->input->post('title'),
			);
			$result = $this->AdminModel->addDataInTable($insertData,'category');
			if($result == TRUE){
				$this->session->set_flashdata('message','Category added successfully.');
                redirect(base_url('admin/category/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/categoryAdd'; 
    $this->load->view('includes/admin/template', $data);
 }

 public function categoryEdit() {
    $data['title'] = 'Edit Category'; 
 
    $id = $this->uri->segment('4');
	$data['category'] = $this->AdminModel->getDataFromTableByField($id,'category','id');
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('title', 'title','trim|required|min_length[3]|max_length[250]');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	      $updateData = array(
	            'title'=> $this->input->post('title'),
			);
			$result = $this->AdminModel->updateTable($id,'id','category',$updateData);
			$this->session->set_flashdata('message','Category update successfully.');
            redirect(base_url('admin/category/edit').'/'.$id);
	    }
	}
	
	
	$data['mainContent'] = 'siteAdmin/categoryEdit'; 
    $this->load->view('includes/admin/template', $data);

 }
 
  public function categoryDelete(){
     
    $id = $this->uri->segment('4');
    $data['category'] = $this->AdminModel->deleteRow($id,'category','id');
    redirect(base_url('admin/category'));
  }
}