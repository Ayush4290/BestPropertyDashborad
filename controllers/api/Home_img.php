<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php'; 

class Home_img extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Api_model');
        
        // CORS Headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        $checkToken = $this->checkForToken();
        if(!$checkToken) { die(); }
    }

    /**  OUR SERVICES Img **/
    public function get_images_post()
    {
        // Base URL for the images
        $base_url = base_url('assets/images/home/');

        // Arrays of image file names for each category
        $residential_images = [
            'rectangle_36.jpg',
            'Residentia-1.jpg',
            'Residentia-2.jpg'
        ];

        $office_space_images = [
            'office-space-1.jpg',
            'office-space-2.jpg',
            'officespace.jpg'
        ];

        $flats_and_plots_images = [
            'flats-and-plots-1.jpg',
            'flats-and-plots-2.jpg',
            'flatsandplots.jpg'
        ];

        // Construct data with IDs and headings
        $image_urls = [
            [
                'id' => "1",
                'our_services' => "Residential",
                'images' => array_map(fn($image) => $base_url . $image, $residential_images)
            ],
            [
                'id' => "2",
                'our_services' => "Office Space",
                'images' => array_map(fn($image) => $base_url . $image, $office_space_images)
            ],
            [
                'id' => "3",
                'our_services' => "Flats and Plots",
                'images' => array_map(fn($image) => $base_url . $image, $flats_and_plots_images)
            ]
        ];

        // Return the array as a JSON response
        $this->response([
            'status' => true,
            'result' => $image_urls
        ], REST_Controller::HTTP_OK);
    }
}
