<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users Controller
 * 
 * @property CI_Input $input
 * @property CI_Uri $uri
 * @property CI_Router $router
 * @property CI_Output $output
 * @property CI_Security $security
 * @property CI_Lang $lang
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property User_model $User_model
 */
class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users/index', $data);
    }

    public function create() {
        $this->load->view('users/create');
    }

    public function store() {
        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload create view with errors
            $this->load->view('users/create');
        } else {
            // Validation passed, insert user
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
            );
            
            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'User created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create user.');
            }
            redirect('users');
        }
    }

    public function edit($id) {
        if (!$id || !is_numeric($id)) {
            show_404();
        }
        
        $data['user'] = $this->User_model->get_user($id);
        
        if (!$data['user']) {
            show_404();
        }
        
        $this->load->view('users/edit', $data);
    }

    public function update($id) {
        if (!$id || !is_numeric($id)) {
            show_404();
        }

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload edit view with errors
            $data['user'] = $this->User_model->get_user($id);
            $this->load->view('users/edit', $data);
        } else {
            // Validation passed, update user
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
            );
            
            if ($this->User_model->update_user($id, $data)) {
                $this->session->set_flashdata('success', 'User updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update user.');
            }
            redirect('users');
        }
    }

    public function delete($id) {
        if (!$id || !is_numeric($id)) {
            show_404();
        }
        
        if ($this->User_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user.');
        }
        redirect('users');
    }
}