<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_regsiter_user extends CI_Controller {
    
 private $salt = 'c1!s4vFdxM8DdmOj0lvxp3cFwQx';
 
 public function __construct()
 {
    parent::__construct();
    
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
  
   	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }  
		
    if ($this->session->userdata('role') != 'Admin') { redirect('admin/dashboard'); }
 } 
 
  public function index() {
    $data['title'] = 'Users'; 
    
    
 
	$data['users'] = $this->AdminModel->getDataFromTable('adminLogin');

	$data['mainContent'] = 'siteAdmin/user'; 
    $this->load->view('includes/admin/template', $data);
    
 }
 
 public function add() {
    $data['title'] = 'Add Users';

    $sessionLogin = $this->session->userdata('adminLogged');
    

    if (!($sessionLogin)) {
        redirect(base_url('site-admin'));
    }

    if ($this->input->post('save')) {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('email', 'userName', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_message('address', 'allow only space, comma, dot, numbers and alphabets.');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[25]');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() != FALSE) {
            
            $pass = $this->input->post('password');
            $pwdSalt = hash_hmac("sha512", $pass, $this->salt);
            
            $insertData = array(
                'fullName' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'password' => $pwdSalt,
                'role' => $this->input->post('role')
            );

            $result = $this->AdminModel->addDataInTable($insertData, 'adminLogin');

            if ($result == TRUE) {
             
                $this->session->set_flashdata('message', 'User added successfully.');
                redirect(base_url('admin/user/add'));
            }
        }
    }

    $data['mainContent'] = 'siteAdmin/agent_register';
    $this->load->view('includes/admin/template', $data);
}



 public function userEdit() {
    $data['title'] = 'Edit User'; 
 
    $id = $this->uri->segment('4');
	$data['user'] = $this->AdminModel->getDataFromTableByField($id,'adminLogin','id');
	
	
	if($this->input->post('save')) {
	        $this->form_validation->set_rules('name', 'Name','trim|required|min_length[3]|max_length[250]');
	        $this->form_validation->set_rules('email', 'Email', 'trim|required');
	        $this->form_validation->set_rules('mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
	        $this->form_validation->set_message('address', 'allow only space,comma,dot,numbers and alphabets.');
	        $this->form_validation->set_rules('password', 'min_length[8]|max_length[25]');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	      $updateData = array(
	            'fullName'=> $this->input->post('name'),
	            'email'=> $this->input->post('email'),
	            'phone'=> $this->input->post('mobile'),
	            'address'=> $this->input->post('address'),
	            'role'=> $this->input->post('role')
	            
			);
			
			$pass = $this->input->post('password');
			if($pass) {
                $pwdSalt = hash_hmac("sha512", $pass, $this->salt);
                $updateData['password'] = $pwdSalt;
			}
			
			$result = $this->AdminModel->updateTable($id,'id','adminLogin',$updateData);
			$this->session->set_flashdata('message','User update successfully.');
            redirect(base_url('admin/user/edit').'/'.$id);
	    }
	}
	
	
	$data['mainContent'] = 'siteAdmin/userEdit'; 
    $this->load->view('includes/admin/template', $data);

 }
 
  public function userDelete(){
     
    $id = $this->uri->segment('4');
    $data['user'] = $this->AdminModel->deleteRow($id,'adminLogin','id');
    redirect(base_url('admin/user'));
  }
}