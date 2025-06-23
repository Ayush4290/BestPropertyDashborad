<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Load the User_model
        $this->load->helper('url'); // Load URL helper for redirect
    }

    public function register() {
        $this->load->view('register'); // Load the register_view
    }

    public function register_user() {
        // Check if form is submitted
        if ($this->input->post('submit')) {
            // Get form data
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            // Call the model function to insert data
            $this->User_model->register($data);

            // Redirect to login page
            redirect('login');
        } else {
            // If form is not submitted, redirect to register page
            redirect('register');
        }
    }
}
?>
