<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Loanapi extends REST_Controller
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

    /*******Add Loan******/
    public function addLoanInfo_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $input = $this->input->post();
        
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        
        $mobile = removeAllSpecialCharcter($data['mobile']);
        $loan_amount = removeAllSpecialCharcter($data['loanAmount']);
        $description = removeAllSpecialCharcter($data['description']);
        $name = removeAllSpecialCharcter($data['name']);
        if(strlen($mobile) !== 10 || !is_numeric($mobile)) {
            $return['message'] = 'Please enter valid Mobile Number';
        }
		elseif($loan_amount == ''){
			$return['message'] = 'Please enter a valid loan amount';
		}
		elseif($name == ''){
			$return['message'] = 'Please enter a valid Name';
		}
        else{
            $loanInfo = array(
				'name'=> $name,
				'mobile' => $mobile, 
				'loan_amount' => $loan_amount,
				'description' => $description
				);
            
			$this->Api_model->add_data_in_table($loanInfo, 'loan_details');
			$return['result'] = '';
			$return['status'] = 'done';
			$return['message'] = 'Loan ammount added successfully.';
        
            $this->response($return, REST_Controller::HTTP_OK);
        }
    }
	

	
}