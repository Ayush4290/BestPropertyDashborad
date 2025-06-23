<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_home extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

   public function get_property_by_id($id) {
    $this->db->select('id, name, address, bhk, budget, image_one, sqft');
    $this->db->where('id', $id);
    $query = $this->db->get('properties');
    
    if ($query->num_rows() > 0) {
        return $query->row_array(); // Return data if exists
    } else {
        return null; // Return null if no data found
    }
}
   public function get_data($table, $conditions = [], $single = false) {
    $this->db->select('*');
    $this->db->from($table);

    if (!empty($conditions)) {
        $this->db->where($conditions);
    }

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $single ? $query->row_array() : $query->result_array();
    } else {
        return null; // No data found
    }
}
	

		
}
    

?>