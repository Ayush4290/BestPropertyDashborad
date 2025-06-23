<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class User extends REST_Controller
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
    /** User Register **/
    public function userRegister_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $input = $this->input->post();
        $auth = date('Ymdhis') . rand(10, 9999);
        $auth = md5($auth);
        $input['token'] = $auth;

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $name = removeAllSpecialCharcter($data['name']);
        $email = $data['email'];
        $varified_user = 'No';
        $password = $data['password'];
        $mobile = removeAllSpecialCharcter($data['phone']);


        if ($name == '') {

        } elseif (!is_numeric($mobile) || strlen($mobile) != 10) {
            $return['message'] = 'Mobile number is not valid';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 10) {
            $return['message'] = 'Email is not valid';
        } 
		elseif ($password == '' || strlen($password) < 6) {
            $return['message'] = 'Please enter a Password of 6 or more characters';
        }else{
            $checkUser = $this->Api_model->getRecordByColumn('mobile',$mobile,'users','mobile');
            if($checkUser){
                $return['message'] = 'Phone number already exists';   
            }
            else{
				$hashed_password = md5($password);
                $addInfo = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'token'=>$auth, 'varified_user'=>$varified_user, 'password'=>$hashed_password);
                $this->Api_model->add_data_in_table($addInfo, 'users');
                $return = array('token'=>$auth);
                //$return['result'] = '';
                $return['status'] = 'done';
                $return['message'] = 'User registered successfully!';
            }
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
    /** user login  **/
    
  public function loginUser_post() {
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
        $input = $this->input->post();
        //$auth = date('Ymdhis').rand(10,9999);
        //$auth = md5($auth);
        //$input['token'] = $auth;
        
        //$phone = $this->input->post('phone');
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
        $phone = removeAllSpecialCharcter($data['phone']);
        $password = $data['password'];
        $inkPassword = md5($password);
       // $auth = $data['token'];
        //$email = $data['email'];
        
        if($phone=='') {
            
        } elseif($phone=='' || (!is_numeric($phone)) || strlen($phone) != 10){
            $return['message'] = 'Phone number is not valid';
        } else {
            $checkUser = $this->Api_model->getRecordByColumn('mobile',$phone,'users','id,token,varified_user,password');
            if($checkUser === FALSE){
                $return['message'] = 'This phone number not exist.'; 
                $return['result'] = $phone;
            } 
            elseif($checkUser[0]['varified_user']=='No'){
                $return['message'] = 'Your number is not verified by the admin'; 
            }
            elseif($checkUser[0]['password'] !== $inkPassword){
                $return['message'] = 'Wrong Password '; 
            }
            else {
                
                if($checkUser[0]['token']=='') {
                    $updateInfo = array('token'=>$auth);
                    $this->Api_model->updateTable('id',$checkUser[0]['id'],'users',$updateInfo);
                } else {
                    $auth = $checkUser[0]['token'];
                }
                
                $return = array('token'=>$auth);
                $return['status'] = 'done';
                $return['message'] = 'User login successfully.';
            }
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    
public function userProfile_post() {
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
         
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
        $token = removeAllSpecialCharcter($data['token']);
        
        if($token=='') {
            $return['message'] = 'Please pass the valid token.';
        }
        else {
            $userData = $this->Api_model->getRecordByColumn('token',$token,'users','id,name,email,mobile,varified_user');
            
            if($userData){
                $return['status'] = 'done';
                $return['message'] = 'Done.';
                $return['result'] = $userData;
            }
            else{
                $return['message'] = 'No Records Found';    
            }
            }
        
        $this->response($return, REST_Controller::HTTP_OK);
    }

public function forgetPassword_post() {	
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
         
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
		
		$email = $data['email'];
        $token = $data['token'];
        
		if($token=='') {
            $return['message'] = 'Please pass the valid token.';
        }
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 10) {
            $return['message'] = 'Email is not valid';
        }
        else {
			//$where = array('token'=>$token, 'email'=>$email);
            //$checkEmail = $this->Api_model->getRecordByColumn($where,'users','id,email,token');
            $checkEmail = $this->Api_model->getRecordByColumn('email',$email,'users','id,email,token');
				if(!$checkEmail){
					$return['status'] = $email;
					$return['message'] = 'We cant find your email address';
					$return['result'] = 'error';
				}
				else{   
				$token = $checkEmail['token'];                   
				$qstring = $this->base64url_encode($token);                      
                $url = site_url() . '/reset-password/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                $to = $email;
                $subject = "Best Properties Forgot Password";
                $message = '<strong>Please click here to reset the password:</strong> ' . $link; 
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Best Properties <info@bestproperties.com>" . "\r\n";

           if(mail($to,$subject,$message,$headers)){
			   $return['status'] = 'Done';
               $return['message'] = 'A password reset has been requested for this email account';
			   $return['result'] = 'Done';
             }
                } 
            }
        
        $this->response($return, REST_Controller::HTTP_OK);
    }
	
	public function base64url_encode($data) { 
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 

    public function base64url_decode($data) { 
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
    }
    

}