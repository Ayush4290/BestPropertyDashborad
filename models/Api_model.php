<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
 	function getRecordByColumn($where,$value,$table,$columns='*') {
		$this->db->select($columns);
		$this->db->from($table);
		$this->db->where($where,$value);
		$query = $this->db->get();
		$data = FALSE;
        if($query !== FALSE && $query->num_rows() > 0){
            $data = $query->result_array();
        }
		return $data;
	} 
	function getRecordByMultipleColumn($where,$table,$columns='*',$sort='',$orderby='',$limit='') {
		$this->db->select($columns);
		$this->db->from($table);
		 $where['status'] = 'active';
		$this->db->where($where);
		if($sort != '') { $this->db->order_by($sort, $orderby); }
		if($limit != '') { $this->db->limit($limit); }
		$query = $this->db->get();
		$data = FALSE;
        if($query !== FALSE && $query->num_rows() > 0){
            $data = $query->result_array();
        }
		return $data;
	} 
	
	function getRecordByColumnService($where, $value, $additionalWhere, $additionalValue, $table, $columns = '*') {
		$this->db->select($columns);
		$this->db->from($table);
		$this->db->where($where, $value);
		$this->db->where($additionalWhere, $additionalValue);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$data = FALSE;

		if ($query !== FALSE && $query->num_rows() > 0) {
			$data = $query->result_array();
		}

		return $data;
    }
    
	function updateTable($where,$value,$table,$data) {
	    $this->db->where($where, $value);
        $this->db->update($table, $data);
        return true;
	}
    function delete($where,$value,$table) {
        $this->db->where($where, $value);
        $this->db->delete($table); 
        return true;
    }
    function add_data_in_table($data,$table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    
/*function for get values with image url*/

     public function getPropertywithImages($id) {
        $this->db->select('*');  
        $this->db->from('properties');
        $this->db->where('id', $id);
        $this->db->where('status', 'active');
        $query = $this->db->get();
        //$query = $this->db->get('properties'); 

        if ($query->num_rows() > 0) {
        $data = $query->result_array();

        foreach ($data as &$row) {
            
        $row['image_one_url'] = $this->get_image_url($row['image_one']);
        $row['image_two_url'] = $this->get_image_url($row['image_two']);
        $row['image_three_url'] = $this->get_image_url($row['image_three']);
        $row['image_four_url'] = $this->get_image_url($row['image_four']);
            }
        return $data;
        }
        return array(); 
        }

     private function get_image_url($image_name) {
        if($image_name){
        $image_url = base_url('assets/properties/' . $image_name);
        return $image_url;
         }
        }
        
public function getAdditionalPropertiesByType($propertyType, $currentId, $limit = 3)
{
    $this->db->where('property_type', $propertyType);
    $this->db->where('id !=', $currentId);
    $this->db->where('status', 'active');
    $this->db->limit($limit);
    $query = $this->db->get('properties');

     if ($query->num_rows() > 0) {
        $data = $query->result_array();

        foreach ($data as &$row) {
            
        $row['image_one_url'] = $this->get_image_url($row['image_one']);
        $row['image_two_url'] = $this->get_image_url($row['image_two']);
        $row['image_three_url'] = $this->get_image_url($row['image_three']);
        $row['image_four_url'] = $this->get_image_url($row['image_four']);
            }
        return $data;
        }
        return array(); 
        }
        public function fetch_upcoming_projects() {
        $this->db->select('Images, Min_Budget, Project_Name, Max_Budget');
        $this->db->from('Properties_Projects');
        $this->db->where('Upcoming_Projects', 'yes');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insertData($table, $data)
{
    return $this->db->insert($table, $data);
}

}

		
	 
    
    

?>