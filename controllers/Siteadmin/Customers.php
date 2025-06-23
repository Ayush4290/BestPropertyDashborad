<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    
    //if ($this->session->userdata('role') != 'Admin' && $this->session->userdata('role') != 'Manager') { redirect('admin/dashboard'); }
     if(!stristr($this->session->userdata('role'), 'Admin') && (!stristr($this->session->userdata('role'), 'Manager'))) { redirect(base_url('admin/dashboard')); }
 }
 public function index() {
    $data['title'] = 'Customers'; 
 
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	$data['customers'] = $this->AdminModel->getDataFromTable('users','id,name,email,mobile,varified_user,password','id >','0');
	$data['mainContent'] = 'siteAdmin/customers'; 
    $this->load->view('includes/admin/template', $data);
 }
  public function updateCustomerStatus() {
      
            $id =$this->input->post('list_id');
	        $updateData = array(
				'varified_user'=> $this->input->post('status')
			);
			$result = $this->AdminModel->updateTable($id,'id','rent',$updateData);

 }  
 
  public function addCustomer() {
    $data['title'] = 'Add Customer'; 
  
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	  
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('cname', 'Name','trim|required|min_length[3]|max_length[25]');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	    $this->form_validation->set_rules('number', 'Number', 'trim|required|numeric|exact_length[10]');
	    
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	        $auth = date('Ymdhis') . rand(10, 9999);
            $inauth = md5($auth);
	        $password = $this->input->post('password');
	        $inc_password = md5($password);
	        $insertData = array(
	            'name'=> $this->input->post('cname'),
				'email'=> $this->input->post('email'),
				'mobile'=> $this->input->post('number'),
				'password'=> $inc_password,
				'token'=> $this->input->post('state'),
				'varified_user'=> 'No',
				'token'=> $inauth
				
			);
			
			$result = $this->AdminModel->addDataInTable($insertData, 'users');
			if($result){
				$this->session->set_flashdata('message','Customer added successfully.');
                redirect(base_url('admin/customer/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/customerAdd'; 
    $this->load->view('includes/admin/template', $data);
 }
 public function editCustomer() {
    $data['title'] = 'Edit Customer'; 
 
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	
	$id = $this->uri->segment('4');
	
	
if ($this->input->post('save')) {
    $this->form_validation->set_rules('cname', 'Name', 'trim|required|min_length[3]|max_length[25]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('number', 'Number', 'trim|required|numeric|exact_length[10]');
    
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    
    if ($this->form_validation->run() != FALSE) {
        $checkPassword = $this->AdminModel->getDataFromTable('users', 'password', 'id', $id);
        $existingPassword = $checkPassword[0]->password;
        $newPassword = $this->input->post('password');
        $hashedPassword = $existingPassword;
        
        if (!empty($newPassword)) {
            $hashedPassword = md5($newPassword);
        }

        $updateData = array(
            'name' => $this->input->post('cname'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('number'),
            'password' => $hashedPassword,
            'varified_user' => $this->input->post('varified_user')
        );

        $result = $this->AdminModel->updateTable($id, 'id', 'users', $updateData);
        if ($result) {
            $this->session->set_flashdata('message', 'Customer updated successfully.');
            redirect(base_url('admin/customer/edit') . '/' . $id);
        }
    }
}

	

	$data['customer'] = $this->AdminModel->getDataFromTableByField($id,'users','id');
	
	$data['mainContent'] = 'siteAdmin/customerEdit'; 
    $this->load->view('includes/admin/template', $data);
 }
 
 public function deleteCustomer(){
    $id = $this->uri->segment('4');
    $result =  $this->AdminModel->deleteRow($id,'users','id');
    if($result){
        $this->session->set_flashdata('message','Customer deleted successfully.');
    } else {
        $this->session->set_flashdata('message','Customer not deleted please try again.');
     }
     redirect(base_url('admin/customer'));
 }

}
?>