<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonalInfo extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->helper('access_helper');
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    $this->load->helper("file");
    
 	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
    }

public function index() {
    $data['title'] = 'Personal';
    $id = $this->uri->segment('4');
    $userId = $this->session->userdata('id');
    $leads =  $this->AdminModel->getDataFromTableByField($id,'buyers','id');
    $data['assignedLead'] = $this->AdminModel->getDataByMultipleColumns(array('leadid' => $id, 'userid' => $userId), 'assigned_leads');
    
    $role = $this->session->userdata('role');
    check_agent_access($leads, $data['assignedLead'], $role);


    if($this->input->post('save')) {
				$this->form_validation->set_rules('name', 'name','trim|min_length[3]|max_length[250]');
				$this->form_validation->set_rules('phone', 'phone','trim');
				$this->form_validation->set_rules('address', 'address','trim');
				$this->form_validation->set_rules('zip_code', 'zip code','trim|max_length[40]');
			$this->form_validation->set_rules('email', 'Email', 'trim|max_length[40]');

				$this->form_validation->set_rules('city', 'city','trim|min_length[3]|max_length[50]');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if ($this->form_validation->run() != FALSE) { 
				    $payment_methods = $this->input->post('Payment_Method');
                        if (!is_array($payment_methods)) {
                            $payment_methods = array(); // Set as empty array if not array
                        }
					$insertData = array(
					'userid'=>$this->session->userdata('id'),
					'userType'=> $this->input->post('buyer'),
					'uName'=> $this->input->post('name'),
					'address'=> $this->input->post('address'),
					'Profession'=> $this->input->post('Profession'),
					
					//	'zip'=> $this->input->post('zip_code'),
				
					'mobile'=> $this->input->post('phone'),
					'email'=> $this->input->post('email'),
					
					 'Payment_Method'=> implode(', ', $payment_methods), // Implode only if it's an array

					//'propertyType'=>$this->input->post('Propertytype'),
		
					);
					$id = $this->uri->segment('4');
					$result = $this->AdminModel->updateTable($id,'id','buyers',$insertData);
				
					if($result == TRUE){
						$this->session->set_flashdata('message1','Personal Information added successfully.');
						redirect(base_url('admin/leads/personal/' . $this->uri->segment(4)));
					} 
				}
    }
       $data['leads'] = $leads;
     
       
	$data['mainContent'] = 'siteAdmin/personalInfo'; 
    $this->load->view('includes/admin/template', $data);
 }
 
}

?>