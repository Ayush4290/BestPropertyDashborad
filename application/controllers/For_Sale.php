<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class For_Sale extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper(array('form','url','headerdata_helper'));
			$this->load->library('form_validation'); 
			
	
			
			
		}
		
		
		public function index() { 
		   $data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$prange = '';
			if ($this->input->is_ajax_request()) {
			    $prange = $this->input->post('range');
			    
			}
			print_r($prange);
			$data['main_content'] = 'new_for_sale';
			$this->load->view('includes/front/template', $data);
		}
	}