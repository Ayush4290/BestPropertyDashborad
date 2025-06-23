<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_demo extends CI_Controller {

  	public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper(array('form','url','headerdata_helper'));
			$this->load->library('form_validation'); 
			
	        $this->load->model('New_home');
	        $this->load->model('AdminModel');
 } 
   public function submit_form() {
        if ($this->input->post('save')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('sales_team_size', 'Sales Team Size', 'required');
            $this->form_validation->set_rules('re_type', 'RE Developer or Partner', 'required');
            $this->form_validation->set_rules('company', 'Company', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
              
            } else {
                $data = array(
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'city' => $this->input->post('city'),
                    'sales_size' => $this->input->post('sales_team_size'),
                    're_developer_partner' => $this->input->post('re_type'),
                    'company' => $this->input->post('company'),
                    'authorise_checkbox' => $this->input->post('subscribe') ? 'Yes' : 'No'
                );

                if ($this->AdminModel->insertData('schedule_demo', $data)) {
                    $this->session->set_flashdata('success', 'Form submitted successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to submit form. Try again.');
                }

                redirect(base_url().'schedule-demo');

            }
}
	
    $data['page_slug'] = 'schedule_demo';
    $data['page_title'] = 'Best Properties Mohali';
    $data['page_keywords'] = '';
    $data['page_description'] = '';
    $data['main_content'] = 'schedule_demo';
    $this->load->view('includes/front/template', $data);

        
    }
}
