<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
    
    public function __construct() {
      parent::__construct(); 
      $this->load->database(); 
    }
   
   public function getFilteredProperties($where = [], $like = [], $table, $select = '*', $orderBy = '', $orderByValue = '') {
    $this->db->select($select);
    $this->db->from($table);

    $this->db->join('properties_clone', 'properties_clone.id = properties.clone_id', 'left');



    if (!empty($where)) {
        $this->db->where($where);
    }

    if (!empty($like)) {
        foreach ($like as $key => $value) {
            $this->db->like($key, $value);
        }
    }

    if ($orderBy != '' && $orderByValue != '') {
        $this->db->order_by($orderBy, $orderByValue);
    }

    $query = $this->db->get();
    return $query->result();
}

public function updatePropertyStatusBulk($ids = array(), $status = '') {
    if (!empty($ids) && !empty($status)) {
        $this->db->where_in('id', $ids);
        $this->db->update('properties', ['status' => $status]);
    }
}
    
 	public function getLogin($user,$password){
		$this->db->select('*');
		$this->db->from('adminLogin');
		$this->db->where('email',$user);
		$this->db->where('password',$password);
		$query = $this->db->get();
		return $query->result(); 
	}
	
	public function getMeals(){
        $this->db->select('m.*,c.name as c_name,t.name as t_name');
        $this->db->from('meals as m');
        $this->db->join('meals_categories as c','c.id = m.meal_category','left');
        $this->db->join('meal_type as t','t.id = m.meal_type','left');
        $this->db->where('m.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    }
    public function getCookAtHomeIngredient(){
        $this->db->select('c.ingredient,c.id,m.recipe_name');
        $this->db->from('cookathome_ingredient as c');
        $this->db->join('meal_items_cookathome as m','m.id = c.meal_items_cookathome_id','left'); 
        $this->db->where('c.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    }
	public function getAdoptionReasons(){
        $this->db->select('a.*,u.firstname as user_name');
        $this->db->from('adoption_reasons as a');
        $this->db->join('users as u','u.id = a.user_id','left');
        $this->db->where('a.is_deleted',0);
        $this->db->order_by('a.sort_order','Asc');
        $query = $this->db->get();
        return $query->result(); 
    }
	public function getIngredient(){
        $this->db->select('i.*,c.name as category_name');
        $this->db->from('ingredient as i');
        $this->db->join('ingredients_category as c','c.id = i.ingredient_category_id','left');
        $this->db->where('i.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    }   
	public function getStore(){
        $this->db->select('s.*,c.name as category_name');
        $this->db->from('stores as s');
        $this->db->join('store_category as c','c.id = s.store_category_id','left');
        $this->db->where('s.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    }
	public function getMealItem(){
        $this->db->select('i.*,m.name as meal_name');
        $this->db->from('meal_items as i');
        $this->db->join('meals as m','m.id = i.meal_id','left');
        $this->db->where('i.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    } 
	public function getOrderItem(){
        $this->db->select('o.*,t.name as order_name');
        $this->db->from('order_items as o');
        $this->db->join('order_types as t','t.id = o.order_id','left');
        $query = $this->db->get();
        return $query->result(); 
    }  
	public function mealsRestrictions(){
        $this->db->select('r.*,m.name as m_name,d.name as d_name');
        $this->db->from('meals_restrictions as r');
        $this->db->join('meals as m','m.id = r.meal_id','left');
        $this->db->join('dietary_restrictions as d','d.id = r.restriction_id','left');
        $this->db->where('r.is_deleted',0);
        $query = $this->db->get();
        return $query->result(); 
    }    
	public function getDataFromTable($table,$columns='*',$column='',$value='',$orderBy='id',$orderByValue='desc'){
	    $this->db->select($columns);
		$this->db->from($table);
		if($column != '' && $value != ''){
		    $this->db->where($column,$value);
		}
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function leadgetDataFromTable($table,$columns='*',$column='',$value='',$orderBy='id',$orderByValue='desc'){
	    $this->db->select($columns);
		$this->db->from($table);
		if($column != '' && $value != ''){
		    $this->db->where($column,$value);
		}
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getDataFromTableByField($value,$table,$column,$orderBy='id',$orderByValue='asc'){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$value);
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}
	public function getDataFromTableByFieldByDelete($value,$table,$column,$orderBy='id',$orderByValue='asc'){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$value);
		$this->db->where('is_deleted','0');
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}	
	public function getDataFromTableBySearchField($value,$table,$column,$orderBy='id',$orderByValue='asc'){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->like($column,$value);
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}	
	public function getDataFromTableByWhereIn($where,$value,$table,$columns='*',$orderBy='id',$orderByValue='asc'){
	    $this->db->select($columns);
		$this->db->from($table);
		$this->db->where_in($where,$value);
		$this->db->order_by($orderBy,$orderByValue);
		$query = $this->db->get();
		return $query->result(); 
	}

 public function getDataByMultipleColumns($where, $table, $columns = '*', $orderBy = '', $orderByValue = '', $limit = '') {
	    $this->db->select($columns);
		$this->db->from($table);
		$this->db->where($where);
		if($orderBy != '') { $this->db->order_by($orderBy,$orderByValue); }
		if($limit !='') { $this->db->limit($limit); }
		$query = $this->db->get();
		return $query->result(); 
	}
		public function getDataByMultipleColumnss($where,$table,$columns,$orderBy='',$orderByValue='asc',$limit=''){
	    $this->db->select($columns);
		$this->db->from($table);
		$this->db->where($where);
		if($orderBy != '') { $this->db->order_by($orderBy,$orderByValue); }
		if($limit !='') { $this->db->limit($limit); }
		$query = $this->db->get();
		return $query->result(); 
	}
	
	public function updateTable($value,$field,$table,$data){
	    $this->db->where($field, $value);
        $this->db->update($table, $data);
        return true;
	}
	
	public function updateLeadStatus($where,$table,$data){
	    $this->db->where($where);
        $this->db->update($table, $data);
        return true;
	}
	
	
	public function addDataInTable($data,$table) {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
	
	public function deleteRow($value,$table,$field) {
      $this->db->where($field, $value);
      $this->db->delete($table); 
      return true;
    }
    
    public function get_tasks_with_conditions($type, $status = '', $today = '') {
        //$today = date('Y-m-d 00:00:01'); 
        $this->db->select('leads_comment.*,buyers.uName,  buyers.preferred_location, buyers.budget');
        $this->db->from('leads_comment');
        $this->db->join('buyers', 'leads_comment.leadId = buyers.id', 'left');
    
        $this->db->where('leads_comment.choice', $type);
        
        if ($today != '') { 
            $this->db->where('leads_comment.nextdt >=', $today); 
        }
        
        if($status != ''){
            $this->db->where('leads_comment.status', $status);
        }
    
        $this->db->order_by('leads_comment.nextdt', 'DESC');
    
        $query = $this->db->get();
        return $query->result_array();
    }

public function get_tasks_with_conditionsOLD($condition = null, $subjectId = null) {
    $today = date('Y-m-d'); 
    $this->db->select('leads_comment.*,buyers.uName,  buyers.preferred_location, buyers.budget');
    $this->db->from('leads_comment');
    $this->db->join('buyers', 'leads_comment.leadId = buyers.id', 'left');


    $this->db->group_start(); 
    $this->db->where('leads_comment.status !=', 'completed');
    $this->db->group_end(); 
    
    
    if ($condition === 'Followup') {
        $this->db->group_start(); 
        $this->db->where('leads_comment.choice', 'Followup');
        $this->db->group_end(); 
    } elseif ($condition === 'meeting') {
        $this->db->group_start(); 
        $this->db->where('leads_comment.choice', 'meeting');
        $this->db->where('leads_comment.nextdt >=', $today);
        $this->db->group_end(); 
    } elseif ($condition === 'all') {
       
    }


  if ($condition === 'Followup' || $condition === 'all') {
        $this->db->group_start(); 
        $this->db->where('leads_comment.choice', 'Followup');
        $this->db->group_end(); 
    }

    if ($leadId) {
        $this->db->where('leads_comment.leadId', $leadId);
    }
$this->db->order_by('leads_comment.nextdt', 'DESC');

    $query = $this->db->get();
    return $query->result_array();
}
public function getAgentLead($userid){
    $this->db->select('b.*');
		$this->db->from('buyers as b');
		$this->db->join('assigned_leads as s', 's.leadid=b.id', 'left');
		$this->db->where('s.userid', $userid);
	//	if($orderBy != '') { $this->db->order_by($orderBy,$orderByValue); }
	//	if($limit !='') { $this->db->limit($limit); }
		$query = $this->db->get();
		return $query->result(); 
}
public function insertLeadDeal($data) {
  
    $this->db->insert('leadDeal', $data);
    return $this->db->insert_id(); // 
}

public function getDealProperties($whereLead){
		$this->db->select('p.id, p.name, p.address, p.city, p.state, l.lead_id, l.properties_id, l.Status');
		$this->db->from('properties as p');
		$this->db->join('leadDeal as l', 'l.properties_id=p.id', 'left');
		
		if (isset($whereLead['p.id']) && is_array($whereLead['p.id'])) {
            $this->db->where_in('p.id', $whereLead['p.id']);
            unset($whereLead['p.id']);
        }
    
		$this->db->where($whereLead);
	//	if($orderBy != '') { $this->db->order_by($orderBy,$orderByValue); }
	//	if($limit !='') { $this->db->limit($limit); }
		$query = $this->db->get();
		return $query->result(); 
}


public function getTableRowCount($table, $column = '', $value = '', $userColumn = '', $userId = '') {
    $this->db->select('id');
    $this->db->from($table);

    if ($column != '' && $value != '') {
        $this->db->where($column, $value);
    }

   
    if ($userColumn != '' && $userId != '') {
        $this->db->where($userColumn, $userId);  
    }

    $query = $this->db->get();
    return $query->num_rows();
}


    
   /* public function getTableRowCount($table, $column = '', $value = '') {
    $this->db->select('id');
    $this->db->from($table);
    if ($column !='' && $value !='') {
        $this->db->where($column, $value);
    }
    $query = $this->db->get();
    return $query->num_rows();
} */

    
public function insertData($table, $data) {
        return $this->db->insert($table, $data);
    }

    // Get all projects from Properties_Projects table
    public function get_all_projects() {
        $query = $this->db->get('Properties_Projects');
        return $query->result(); // or use result_array() if preferred
    }

    // Delete a project by ID
    public function deleteProject($id) {
        $this->db->where('id', $id);
        return $this->db->delete('Properties_Projects');
    }
       public function getProjects() {
    $query = $this->db->get('Properties_Projects'); // 'projects' आपकी table का नाम होना चाहिए
    return $query->result_array(); // Projects का array return करता है
}
public function getCloneData($clone_id) {
    if ($clone_id == 0) {
        return null;
    }
    $this->db->where('id', $clone_id);
    $query = $this->db->get('properties_clone');
    return $query->row();
}


public function get_all() {
    return $this->db->get('properties')->result();
}

public function insert($data) {
    return $this->db->insert('properties', $data);
}

public function get_data($table, $conditions = [], $fields = '*') {
        $this->db->select($fields);
        $this->db->from($table);

        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    
   public function get_whatsapp_with_name($where) {
    $this->db->select('wa.*, wi.r_name, wi.contact_number');
    $this->db->from('whatsapp_api wa');
    $this->db->join('whatsapp_info wi', 'wa.contact_number = wi.contact_number', 'left');
    $this->db->where($where);
    $this->db->order_by('wa.r_date', 'ASC');
    $query = $this->db->get();
    return $query->result_array();
}


    public function get_row($table, $conditions = []) {
        $this->db->from($table);
        $this->db->where($conditions);
        $query = $this->db->get();
        return $query->row_array(); // ek hi row milegi
    
    }
    public function getFilteredLeads($filters = [], $like = [], $table, $columns = '*', $orderBy = '', $orderByValue = '', $limit = '') {
    $this->db->select($columns);
    $this->db->from($table);

    if (!empty($filters)) {
        $this->db->where($filters);
    }

    if (!empty($like)) {
        foreach ($like as $key => $val) {
            $this->db->like($key, $val);
        }
    }

    if ($orderBy != '') {
        $this->db->order_by($orderBy, $orderByValue);
    }

    if ($limit != '') {
        $this->db->limit($limit);
    }

    $query = $this->db->get();
    return $query->result();
}

public function getRoleBasedNotifications($userId, $allowedStatuses = [])
{
    $this->db->select('*');
    $this->db->from('notification');
    $this->db->where('userid', $userId);
     $this->db->where('status', 0);
    $this->db->order_by('id', 'DESC');
    $this->db->limit(20); // latest 20 notification laane ke liye

    $query = $this->db->get();
    return $query->result_array();
}





}
?>