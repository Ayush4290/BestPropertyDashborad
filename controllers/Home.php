<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper(array('form','url','headerdata_helper'));
			$this->load->library('form_validation'); 
			
	        $this->load->model('New_home');
	        $this->load->model('AdminModel');
		}
	public function index() { 
  
 
    // Fetch a single property by its id
    $data['property'] = $this->AdminModel->getDataByMultipleColumns(array('id' => 235), 'properties');
    $data['propertyhot'] = $this->AdminModel->getDataByMultipleColumns(array('id >'=>0), 'properties');
     $data['propertyrent'] = $this->AdminModel->getDataByMultipleColumns(array('id >'=>0), 'rent');
     
    //  Our Services
  $data['residential_images'] = $this->AdminModel->getDataByMultipleColumns(
    array('services' => 'Residential'), 
    'properties', 
    'image_one'
);

// Office Space images
$data['office_space_images'] = $this->AdminModel->getDataByMultipleColumns(
    array('services' => 'Office Space'), 
    'properties', 
    'image_one'
);

// Flats and Plots images
$data['flats_and_plots_images'] = $this->AdminModel->getDataByMultipleColumns(
    array('services' => 'Flats and Plots'), 
    'properties', 
    'image_one'
);
    
  
    
    $data['page_slug'] = 'home';
    $data['page_title'] = 'Best Properties Mohali';
    $data['page_keywords'] = '';
    $data['page_description'] = '';
    $data['main_content'] = 'new_home_page';
    $this->load->view('includes/front/template', $data);
}
		
	
	}