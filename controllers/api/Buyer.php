<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Buyer extends REST_Controller
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
    
    /** add buyers  **/
    public function addBuyer_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $infoType = removeAllSpecialCharcter($data['infotype']);
        $userType = removeAllSpecialCharcter($data['userType']);
        $uName = removeAllSpecialCharcter($data['uName']);
        $mobile = removeAllSpecialCharcter($data['mobile']);
        if (!is_numeric($mobile) || strlen($mobile) != 10) {
            $return['message'] = 'Phone number is not valid';
        }
        elseif($infoType == 'personalInfo' && (strlen($uName) < 3 || preg_match("/[0-9]/", $uName))) {
            $return['message'] = 'Name must be at least 3 characters.';
        }
        elseif($infoType == 'personalInfo') {
            $checNumber = $this->Api_model->getRecordByColumn('mobile',$mobile,'buyers','mobile');
            if(!empty($checNumber) && $checNumber[0]['mobile']== $mobile){
                $updateInfo = array('uName' => $uName, 'userType' => $userType, 'mobile' => $mobile);
                $this->Api_model->updateTable('mobile',$mobile,'buyers',$updateInfo);
                $return['status'] = 'done';
                $return['message'] = 'Buyer added successfully.';
            }
            else{
                $addInfo = array('uName' => $uName, 'userType' => $userType, 'mobile' => $mobile);
                $this->Api_model->add_data_in_table($addInfo, 'buyers');
                $return['result'] = '';
                $return['status'] = 'done';
                $return['message'] = 'Buyer added successfully.';
            }
        }
        elseif($infoType == 'location') {
            $checNumber = $this->Api_model->getRecordByColumn('mobile',$mobile,'buyers','mobile');
            if(!empty($checNumber) && $checNumber[0]['mobile']== $mobile){
                $address = removeAllSpecialCharcter($data['address']);
                $city = removeAllSpecialCharcter($data['city']);
                $zip = removeAllSpecialCharcter($data['zip']);
                
                if($address == '' || $city == '' || $zip == ''){
                    $return['message'] = 'Please fill all fields.';
                } else {
                    $updateLocation = array('address' => $address, 'city' => $city, 'zip'=>$zip);
                    $this->Api_model->updateTable('mobile',$mobile,'buyers',$updateLocation);
                    $return['status'] = 'done';
                    $return['message'] = 'Buyer added successfully.';
                } 
            }
          }
        elseif($infoType == 'budget') {
            $checNumber = $this->Api_model->getRecordByColumn('mobile',$mobile,'buyers','mobile');
            if(!empty($checNumber) && $checNumber[0]['mobile']== $mobile){
                $minBudget = removeAllSpecialCharcter($data['minBudget']);
                $maxBudget = removeAllSpecialCharcter($data['maxBudget']);
                
                if($minBudget == '' || $maxBudget == ''){
                    $return['message'] = 'Please fill all fields.';
                } else {
                    $updateBudget = array('min_budget' => $minBudget, 'max_budget' => $maxBudget);
                    $this->Api_model->updateTable('mobile',$mobile,'buyers',$updateBudget);
                    $return['status'] = 'done';
                    $return['message'] = 'Buyer added successfully.';
                }
            }
          }
          elseif($infoType == 'requirment') {
            $checNumber = $this->Api_model->getRecordByColumn('mobile',$mobile,'buyers','mobile');
            if(!empty($checNumber) && $checNumber[0]['mobile']== $mobile){
                $residential = removeAllSpecialCharcter($data['residential']);
                $commercial = removeAllSpecialCharcter($data['commercial']);
                $propertyType = removeAllSpecialCharcter($data['propertyType']);
                
                if($propertyType == 'residential' && $residential == '' || $propertyType == 'commercial' && $commercial == ''){
                    $return['message'] = 'Please fill all fields.';
                } else {
                    $updateBudget = array('residential' => $residential, 'commercial' => $commercial);
                    $this->Api_model->updateTable('mobile',$mobile,'buyers',$updateBudget);
                    $return['status'] = 'done';
                    $return['message'] = 'Buyer added successfully.';
                }
            }
          }
        
         $this->response($return, REST_Controller::HTTP_OK);
    } 
}