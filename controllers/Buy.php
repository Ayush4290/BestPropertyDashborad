<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Buy extends CI_Controller {
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
			$data['main_content'] = 'new_buy_page';
			$this->load->view('includes/front/template', $data);
		}
	

	}