<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Contact extends REST_Controller
{


    public function __construct()
    {

        parent::__construct();
        // $this->load->database();
        $this->load->helper('url');
        $this->load->model('Api_model');
        
        $checkToken = $this->checkForToken();
        if(!$checkToken) { die(); }
    }

    /** add buyers  **/

    public function contact_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $input = $this->input->post();
        $auth = date('Ymdhis') . rand(10, 9999);
        $auth = md5($auth);
        $input['token'] = $auth;


        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $firstname = removeAllSpecialCharcter($data['firstname']);
        // $subject = $data['subject'];
        // $property = $data['property'];
        // $email = $data['email'];
        $phone = removeAllSpecialCharcter($data['phone']);
         $property_url = removeAllSpecialCharcter($data['property_url']);
   
       // $number = $data['number'];


        if (strlen($firstname) < 3) {
            $return['message'] = 'Name not valid.';
        } elseif (!is_numeric($phone) || strlen($phone) != 10) {
            $return['message'] = 'Phone number is not valid';
        } 
        else {
            $checkPhoneNumber = $this->Api_model->getRecordByColumn('phone',$phone,'contact','phone');
            if($checkPhoneNumber){
                $return['message'] = 'Phone number already exists';   
            }
            else{
                $addInfo = array('fname' => $firstname, 'phone' => $phone, 'property_url' => $property_url);
                $this->Api_model->add_data_in_table($addInfo, 'contact');
                $return['result'] = '';
                $return['status'] = 'done';
                $return['message'] = 'Contact added successfully.';
            }
        }


        $this->response($return, REST_Controller::HTTP_OK);
    }
}