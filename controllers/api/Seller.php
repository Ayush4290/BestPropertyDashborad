<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Seller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->helper('url');
        $this->load->model('Api_model');
        
        $checkToken = $this->checkForToken();
        if(!$checkToken) { die(); }
    }
    /** add seller  **/
    public function addSeller_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => ''); 

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $propertyType = removeAllSpecialCharcter($data['propertyType']);
        $residential = removeAllSpecialCharcter($data['residential']);
        $commercial = removeAllSpecialCharcter($data['commercial']);
        $phone = removeAllSpecialCharcter($data['phone']);


        if ($propertyType == '') {

        } elseif (!is_numeric($phone) || strlen($phone) != 10) {
            $return['message'] = 'Phone number is not valid';
        } else {
            $checkPhoneNumber = $this->Api_model->getRecordByColumn('mobile',$phone,'users','mobile');
            if(empty($checkPhoneNumber)){
                $return['message'] = 'You are not registered please register first';
            }
            else{
            $addInfo = array('property_type' => $propertyType, 'residential' => $residential, 'commercial' => $commercial, 'phone' => $phone);
            $propertyID = $this->Api_model->add_data_in_table($addInfo, 'properties');
            $return['result'] = $propertyType;
            $return['propertyID'] = $propertyID;
            $return['status'] = 'done';
            $return['message'] = 'Seller added successfully.';
            }
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }

}