<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';


/**
 * @property Api_model $Api_model
 */

class Reactjs extends REST_Controller
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
    /*
    public function checkForToken(){
        $return = array('status' => 'error', 'message' => 'Token not valid', 'result' => '');
        $headers = getallheaders();
        if (!array_key_exists('Authorization', $headers)) {
            $this->response($return, REST_Controller::HTTP_UNAUTHORIZED);
            return false;
        } else {
            //if (substr($headers['Authorization'], 0, 6) !== 'Bearer' || $this->config->item('ApiToken') != $headers['Authorization']) {
            if ($this->config->item('ApiToken') != $headers['Authorization']) {
                $this->response($return, REST_Controller::HTTP_UNAUTHORIZED);
                return false;
            } else {
                return true;
            }
        }
    }*/

    /** add buyers  **/


    /** add seller  **/


    /** contact **/
    public function amenities_get()
    {
        
      $result = array('Car parking','Restaurants','Swimming pool','Security services','Water supply','Party hall','Elevators','Temple and religious activity place','Power backup','Gym','Cinema hall','Play area','Walking/Jogging track');



        $return = array('status' => 'done', 'message' => 'Dashboard', 'result' => $result);

        $this->response($return, REST_Controller::HTTP_OK);
    }


    /** Property **/

    public function property_get()
    {
        $getproperty = $this->Api_model->getRecordByColumn('show_in_slider', '1', 'properties', 'id,name,budget,address,property_type');
        if (empty($getproperty)) {
            $return['message'] = 'No records found';
        } else {
            $return['result'] = $getproperty;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }

    /** Gallery **/

    public function gallery_get()
    {
       $gallery = $this->Api_model->getRecordByColumnService(
    'name !=', '', 
    'status', 'active', 
    'properties', 
    'id,name,type,budget,budget_in_words,property_type,address,bathrooms,amenities,bedrooms,sqft,measureUnit,verified,CONCAT("'.base_url().'assets/properties/",image_one) as image'
);
        if (empty($gallery)) {
            $return['message'] = 'No Images found';
        } else {
            $return['result'] = $gallery;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    /** Category **/

    public function category_get()
    {
        $category = $this->Api_model->getRecordByColumn('show_in_slider', '1', 'properties', 'id,property_type,CONCAT("'.base_url().'assets/properties/",icon) as image');
        if (empty($category)) {
            $return['message'] = 'No Images found';
        } else {
            $return['result'] = $category;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }
    public function slider_get()
    {
      $result = array(
            array('image' => base_url().'assets/images/home/property-1.jpg', 'title' => '2 BHK Apartment on Sale in Banur Landran Road, Mohali'),
            array('image' => base_url().'assets/images/home/property-2.jpg', 'title' => 'Airport Road 435 Gaj /17.5 Marla Plot for Sale'),
            array('image' => base_url().'assets/images/home/property-3.jpg', 'title' => '8 Bed Room House At Dahramshala'),
            array('image' => base_url().'assets/images/home/property-4.jpg', 'title' => '3 BHK Flat, Airport Road, Mohali')
        );



        $return = array('status' => 'done', 'message' => 'Dashboard', 'result' => $result);

        $this->response($return, REST_Controller::HTTP_OK);
    }

    /**Seller Images***/
    public function addSellerImages_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        /*
        $config['upload_path'] = FCPATH . 'assets/properties/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['image']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            $uploadImg = $this->upload->data();
            $image = $uploadImg['file_name'];
        } 
        $phone = $this->input->post('phone');
        $image = $this->input->post('image');
        if (!is_numeric($phone) || strlen($phone) != 10) {
            $return['message'] = 'Phone number is not valid';
        } else {
            $addInfo = array('phone' => $phone, 'image' => $image);
            $this->Api_model->add_data_in_table($addInfo, 'seller');
            $return['result'] = '';
            $return['status'] = 'done';
            $return['message'] = 'Seller added successfully.';
        }*/
        $this->response($return, REST_Controller::HTTP_OK);
    }
 
 /*partners*/   
    public function partners_get()
    {
        $gallery = $this->Api_model->getRecordByColumn('show_on_home_page', 'yes', 'partners', 'id,CONCAT("'.base_url().'assets/images/",image) as image');
        if (empty($gallery)) {
            $return['message'] = 'No Images found';
        } else {
            $return['result'] = $gallery;
        }
        $this->response($return, REST_Controller::HTTP_OK);
    }


}