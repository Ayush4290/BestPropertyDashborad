<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }

    public function register($data) {
        // Insert data into users table
        $this->db->insert('test8', $data);
    }
}
?>
