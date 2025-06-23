<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Rentapi extends REST_Controller
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
    
    public function rent_get()
    { 
        $rentData = $this->Api_model->getRecordByColumn('status', 'active', 'rent', 'id, name, property_type, address, sector, budget, bathrooms, verified, security_deposite, property_status, amenities, image_one as image');
        if (empty($rentData)) {
            $return['message'] = 'No Records found';
        } else {
            $return['result'] = $rentData;
            $return['imgUrl'] = base_url().'assets/properties/';
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    public function rentDetails_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
         
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        $id = $data['id'];
        if (!is_numeric($id)) {
            $return['message'] = 'Please pass a valid ID';
        } else {
            $rent = $this->Api_model->getRecordByColumn('id', $id, 'rent', '*');
            
            
            if (empty($rent)) {
                $return['message'] = 'No records found';
            } else {
                /*$propertyType = $getPropertyDetails[0]['property_type'];
                $additionalPropertyDetails = $this->Api_model->getAdditionalPropertiesByType($propertyType, $id, 3);*/
              
               
			   
                $return['status'] = 'done';
                $return['message'] = 'Success';
                $return['imgUrl'] = base_url().'assets/properties/';
                $return['result'] = array(
                    'rent' => $rent
                );
            }
        }
        
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    /*******Add Rental Properties******/
    public function addRentProperties_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $input = $this->input->post();
        
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        
        $title = removeAllSpecialCharcter($data['title']);
        $areaSqft = removeAllSpecialCharcter($data['areaSqft']);
        $sector = removeAllSpecialCharcter($data['sector']);
        $rentpermonth = removeAllSpecialCharcter($data['rentpermonth']);
        $bathroom = removeAllSpecialCharcter($data['bathroom']);
        $bedrooms = removeAllSpecialCharcter($data['bedrooms']);
        $propertyType = removeAllSpecialCharcter($data['property_type']);
        $property_description = removeAllSpecialCharcter($data['property_description']);
        $address = removeAllSpecialCharcter($data['address']);
        $bookedby = removeAllSpecialCharcter($data['bookedby']);
        $bookingamount = removeAllSpecialCharcter($data['bookingamount']);
        $available_from = removeAllSpecialCharcter($data['available_from']);
        $status = 'deactivate';
        if (strlen($title) < 3) {
            $return['message'] = 'Please enter valid plot area';
        }
        
        else{
            $propertyInformation = array(
				'name' => $title, 
				'sqft' => $areaSqft, 
				'sector' => $sector,
				'budget' => $rentpermonth,
				'bathrooms' => $bathroom,
				'bedrooms' => $bedrooms,
				'description' => $property_description,
				'address' => $address,
				'booked_by' => $bookedby,
				'booking_amount' => $bookingamount,
				'property_type' => $propertyType,
				'available_from' => $available_from,
				'status'=>$status);
            
			$this->Api_model->add_data_in_table($propertyInformation, 'rent');
			$return['result'] = '';
			$return['status'] = 'done';
			$return['message'] = 'Property added successfully.';
        
            $this->response($return, REST_Controller::HTTP_OK);
        }
    }
	
	/************Property Type Api********************/

	public function allPropertyTypeApi_get()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        /*
		$this->load->helper('propertytype');
        
		$property_types = rentPropertyType();
		//$property_types = 'test';
			if(!empty($property_types)){
				$return['result'] = $property_types;
				$return['status'] = 'done';
				$return['message'] = '';
			}
			else {
				// Property types could not be retrieved
				$return['message'] = 'Failed to retrieve property types';
			}*/
            $this->response($return, REST_Controller::HTTP_OK);
    }	
	

}