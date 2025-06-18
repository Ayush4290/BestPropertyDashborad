<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model
{
    
    public function __construct() {
      parent::__construct(); 
      $this->load->database(); 
    }
    
 	public function getLogin($user){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$user);
		//$this->db->where('password',$pass);
		$query = $this->db->get();
		return $query->result();
	}
     
    public function profileDetailsId($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$id);
        $query = $this->db->get();
    
        return $query->result_array();
    }
    public function verify_email($key) {
      $this->db->where('verify_key', $key);
      $query = $this->db->get('users');
      if($query->num_rows() > 0) {
       $data = array('confirmed'  => '1');
       $this->db->where('verify_key', $key);
       $this->db->update('users', $data);
       return true;
      }
      else
      {
       return false;
      }
    }
    public function commonFetch($tbl){
			$this->db->select('*');
			$this->db->from($tbl);
			$query = $this->db->get();
			return $query->result();
    }

   
    public function selectDataByField($field,$value,$tbl,$column='*',$limit=''){ 
			$this->db->select($column);
			$this->db->from($tbl);
			$this->db->where($field,$value);
			if($limit != '') { $this->db->limit($limit); }
			$query = $this->db->get();
			return $query->result();
    }
    
    function getRecordByMultipleColumn($where,$table,$columns='*',$sort='',$orderby='',$limit='') {
		$this->db->select($columns);
		$this->db->from($table);
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
  
    public function allItems() {
		$this->db->select('*');
		$this->db->from('restaurant_item');
		$this->db->where('status','Enable');
		$this->db->limit(20);
		$query=$this->db->get('');
		return $query->result();
	}	
    public function last_id($table)
    {
        $this->db->select('id');
        $this->db->from($table);
        $this->db->order_by('id','desc');
        $this->db->limit('1');
        $query= $this->db->get();
        if ($query->num_rows() > 0){
        return $query->result();}
    }  	
		public function getDataFromTableByFieldByDelete_new($table,$orderBy='id',$orderByValue='asc',$column='',$value='',$locality='',$budgetMin='',$budgetMax=''){
	    $this->db->select('*');
		$this->db->from($table);
		if($column != '' && $value != ''){
		   $this->db->where($column,$value);
		}
		if($locality != ''){
		   $this->db->like('address',$locality);
		}
		if($budgetMin != ''){
	    $this->db->where('budget >=', $budgetMin);
		}
		if($budgetMax != ''){
	    $this->db->where('budget <=', $budgetMax);
		}		
		$this->db->where('is_deleted','0');
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}	
	public function getDataFromTableByFieldByDelete($table,$orderBy='id',$orderByValue='asc',$column='',$value='',$type='',$property_for='',$city='',$locality='',$budgetMin='',$budgetMax='',$Ptype=''){
	    $this->db->select('*');
		$this->db->from($table);
		if($column != '' && $value != ''){
		   $this->db->where($column,$value);
		}
		if($type != ''){
		   $this->db->like('property_type',$type);
		}
		if($Ptype != ''){
		   $this->db->like('type',$Ptype);
		}		
		if($property_for != ''){
		   $this->db->where('property_for',$property_for);
		}
		if($city != ''){
		   $this->db->like('city',$city);
		}	
		if($locality != ''){
		   $this->db->like('address',$locality);
		}
		if($budgetMin != ''){
	    $this->db->where('budget >=', $budgetMin);
		}
		if($budgetMax != ''){
	    $this->db->where('budget <=', $budgetMax);
		}		
		$this->db->where('is_deleted','0');
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}	
 	public function getRecord($id,$table,$field,$return='')	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field,$id);
		$query=$this->db->get();
		if($return=='array') {
		    return $query->result_array();
		} else {
		    return $query->result();
		}
	} 
 	public function getRecordUser($id,$table,$field,$return='')	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field,$id);
		$this->db->where('confirmed','0');
		$query=$this->db->get();
		if($return=='array') {
		    return $query->result_array();
		} else {
		    return $query->result();
		}
	} 	  
	public function edit($id,$data,$table,$field){

		$this->db->where($field, $id);
       $this->db->update($table, $data);
       return true;
	}

    public function delete($id,$table,$field){
      $this->db->where($field, $id);
      $this->db->delete($table); 
      return true;
    }
 
    public function getDataFromTable($id,$table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }  
    
    public function addDataInTable($data,$table) {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
 
}

?>