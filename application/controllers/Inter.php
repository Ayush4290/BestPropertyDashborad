<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
     * @property CI_Session $session
     * @property  CI_DB $db
     * @property CI_Input $input
     * @property  AdminModel $AdminModel
     * @property   CI_Form_validation $form_validation
     * @property   CI_URI $uri
     * @property  CI_Upload $upload
     * @property  CI_DB_utility $dbutil
     * @property  User_model $User_model
     */
class Inter extends CI_Controller {



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
