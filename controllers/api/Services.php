<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Services extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Api_model');
        
        $checkToken = $this->checkForToken();
        if(!$checkToken) { die(); }
    }
    /** add seller  **/
    public function services_get()
    {
        $gallery = $this->Api_model->getRecordByColumn('show_in_home_page', 'yes', 'services', 'id,our_services,CONCAT("'.base_url().'assets/properties/",image) as image');
        if (empty($gallery)) {
            $return['message'] = 'No Records found';
        } else {
            $return['result'] = $gallery;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    public function servicesInner_get()
    {
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    
        $servicesInner = $this->Api_model->getRecordByColumn('show_in_gallery', '1', 'properties', 'id,name,type,budget,property_type,address,bathrooms,bedrooms,sqft,CONCAT("'.base_url().'assets/properties/",image_one) as image');
        if (empty($servicesInner)) {
            $return['message'] = 'No Images found';
        } else {
            $return['result'] = $servicesInner;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    public function servicesInnerPages_post()
    {
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
         
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    
	    $innerPagesMain = removeAllSpecialCharcter($data['innerpagetitle']);
	    $innerPagesMain = str_replace(['_', '-'], ' ', $innerPagesMain);
	    
	    
        $servicesInner = $this->Api_model->getRecordByColumnService('services', $innerPagesMain,'status', 'active', 'properties', 'id,name,type,budget,property_type,address,bathrooms,bedrooms,services,sqft,image_one');
        if (empty($servicesInner)) {
            $return['message'] = 'No Images found';
        } else {
            $imgUrl = base_url().'assets/properties/';
            foreach ($servicesInner as &$service) {
                $service['url'] = $imgUrl;
            }
            $return['result'] = $servicesInner;
            $return['status'] = 'done';
            $return['message'] = 'Done';
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    public function getPlans_get()
    {
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
         
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);

        $plans = $this->Api_model->getRecordByColumn('id >', 0, 'plans');
        if (empty($plans)) {
            $return['message'] = 'No plans found';
        } else {
            $return['result'] = $plans;
            $return['status'] = 'done';
            $return['message'] = 'Done';
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    
    

}