<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rent extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
 }
 public function index() {
    $data['title'] = 'PROPERTY RENT/PG'; 
 
	//$data['properties'] = $this->AdminModel->getDataFromTable('rent','id,name,status','is_deleted','0');
	$where = array('id >','1');
	if(stristr($this->session->userdata('role'),'Agent')) { $where['userid'] = $this->session->userdata('id'); }
	$data['properties'] = $this->AdminModel->getDataByMultipleColumns($where,'rent','*',$orderBy='id',$orderByValue='desc');
	
	$data['mainContent'] = 'siteAdmin/rent'; 
    $this->load->view('includes/admin/template', $data);
 }
  public function updateRentStatus() {
      
            $id =$this->input->post('list_id');
	        $updateData = array(
				'status'=> $this->input->post('status')
			);
			$result = $this->AdminModel->updateTable($id,'id','rent',$updateData);

 }  
 
  public function addRent() {
    $data['title'] = 'Add Property Rent/PG ';  
	  
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('rName', 'property name','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('budget', 'budget','trim|required|numeric');
	    //$this->form_validation->set_rules('address', 'property address','trim|required|min_length[5]|max_length[100]');
	    $this->form_validation->set_rules('zip_code', 'zip code','trim|max_length[40]');
	    $this->form_validation->set_rules('address', 'property address','trim|required|min_length[2]|max_length[100]');
	    $this->form_validation->set_rules('pName', 'person name','trim');
	    $this->form_validation->set_rules('pPhone', 'person phone','trim');
	    $this->form_validation->set_rules('pAddress', 'person address','trim');
	    $this->form_validation->set_rules('amenities[]', 'amenities','trim|required');
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	        
	       /*$additionalsLabel = $this->input->post('additional');
	       $additionaln_label = implode('~~--~~',$additionalsLabel); 

	       $additionals_value = $this->input->post('custom_value'); 
	       $additional_value = implode('~~--~~',$additionals_value);*/
	       
	       $amenities_value = $this->input->post('amenities'); 
	       $amenities = implode('~-~',$amenities_value);
			$image = '';
			$imageTwo = '';
			$imageThree = '';
			$imageFour = '';
			$icon = '';
			
			$config['upload_path'] = FCPATH.'assets/properties/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['file_name'] = date('YmdHis').rand(10,99);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			 
			if($this->upload->do_upload('image')) { 
				$uploadImg = $this->upload->data();
				$image = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image2')) { 
				$uploadImg = $this->upload->data();
				$imageTwo = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image3')) { 
				$uploadImg = $this->upload->data();
				$imageThree = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image4')) { 
				$uploadImg = $this->upload->data();
				$imageFour = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('icon')) { 
				$uploadImg = $this->upload->data();
				$icon = $uploadImg['file_name'];
			}
	        $insertData = array(
	            'userid'=>$this->session->userdata('id'),
	            'name'=> $this->input->post('rName'),
				'property_type'=> $this->input->post('property_type'),
				'address'=> $this->input->post('address'),
				'sector'=> $this->input->post('sector'),
				'phone'=> $this->input->post('pPhone'),
				'state'=> $this->input->post('state'),
				'status'=> 'deactive',
				'zip_code'=> $this->input->post('zip_code'),
				'budget'=> $this->input->post('budget'),
				'description'=> $this->input->post('note'),
				'bathrooms'=> $this->input->post('bathrooms'),
				'verified'=> $this->input->post('verified'),
				'security_deposite'=> $this->input->post('security-deposite'),
				'property_status'=> $this->input->post('property-status'),
				'person'=> $this->input->post('pName'),
				'owner_name'=> $this->input->post('owner_name'),
				'prefer'=> $this->input->post('prefer'),
				'owner_contact'=> $this->input->post('owner_contact'),
				'refer'=> $this->input->post('refer'),
				'owner_class'=> $this->input->post('owner_class'),
				'available'=> $this->input->post('available'),
				'available_from'=> $this->input->post('available_from'),
				'booking_amount'=> $this->input->post('booking_amount'),
				'booked_by'=> $this->input->post('booked_by'),
				'booking_advance'=> $this->input->post('booking_advance'),
				'agreement'=> $this->input->post('agreement'),
				'police_verification'=> $this->input->post('police_verification'),
				'security'=> $this->input->post('security'),
				'commission'=> $this->input->post('commission'),
				'house_number'=> $this->input->post('house_no'),
				'floor'=> $this->input->post('floor'),
				//'comment'=> $this->input->post('comment'),
				'person_address'=> $this->input->post('pAddress'),
				'sqft'=>$this->input->post('area_in_sq_ft'),
				'image_one'=> $image,
				'image_two'=> $imageTwo,
				'image_three'=> $imageThree,
				'image_four'=> $imageFour,
				'icon'=> $icon,
				'amenities'=> $amenities
				
			);
			
			$result = $this->AdminModel->addDataInTable($insertData, 'rent');
			if($result){
				$this->session->set_flashdata('message','Properties added successfully.');
                redirect(base_url('admin/rent/add'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/rentAdd'; 
    $this->load->view('includes/admin/template', $data);
 }
 public function editRent() {
    $data['title'] = 'PROPERTY RENT/PG Edit'; 
  
	
	$id = $this->uri->segment('4');
	$data['properties'] = $this->AdminModel->getDataFromTableByField($id,'rent','id');
	
	$role = $this->session->userdata('role');
	if($data['properties'] && stristr($role, 'Agent')){
	    if($data['properties'][0]->userid != $this->session->userdata('id')) { redirect(base_url('admin/dashboard')); }
	}
	
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('rName', 'property name','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('budget', 'budget','trim|required|numeric');
	    $this->form_validation->set_rules('address', 'property address','trim|required|min_length[2]|max_length[100]');
	    $this->form_validation->set_rules('state', 'state','trim|required|min_length[3]|max_length[50]');
	    $this->form_validation->set_rules('zip_code', 'zip code','trim|max_length[40]'); 
	    $this->form_validation->set_rules('amenities[]', 'amenities','trim|required');
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	      /* $additionalsLabel = $this->input->post('additional');
	       if($additionalsLabel){ $additionaln_label = implode('~~--~~',$additionalsLabel); }
	       else{$additionaln_label="";}

	       $additionals_value = $this->input->post('custom_value'); 
	       if($additionals_value){$additional_value = implode('~~--~~',$additionals_value);}
	       else{$additionals_value="";}*/
	       
	       
	       $amenities_value = $this->input->post('amenities'); 
	       if($amenities_value){$amenities = implode('~-~',$amenities_value);}
	       else{$amenities_value="";}
	       
	       
			$image = $this->input->post('imageOld');
			$imageTwo = $this->input->post('imageOldTwo');
			$imageThree = $this->input->post('imageOldThree');
			$imageFour = $this->input->post('imageOldFour');
			$icon = $this->input->post('icon');
			
			$config['upload_path'] = FCPATH.'assets/properties/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['file_name'] = date('YmdHis').rand(10,99);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			 
			if($this->upload->do_upload('image')) {
			    
				if($image != '' && is_file(FCPATH.'assets/properties/'.$image)){
                    unlink(FCPATH.'assets/properties/'.$image);
				}
				$uploadImg = $this->upload->data();
				$image = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image2')) { 
				if($imageTwo != '' && is_file(FCPATH.'assets/properties/'.$imageTwo)){
                    unlink(FCPATH.'assets/properties/'.$imageTwo);
				}			    
				$uploadImg = $this->upload->data();
				$imageTwo = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image3')) { 
				if($imageThree != '' && is_file(FCPATH.'assets/properties/'.$imageThree)){
                    unlink(FCPATH.'assets/properties/'.$imageThree);
				}
				$uploadImg = $this->upload->data();
				$imageThree = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('image4')) { 
				if($imageFour != '' && is_file(FCPATH.'assets/properties/'.$imageFour)){
                    unlink(FCPATH.'assets/properties/'.$imageFour);
				}
				$uploadImg = $this->upload->data();
				$imageFour = $uploadImg['file_name'];
			}
			if($this->upload->do_upload('icon')) { 
				if($icon != '' && is_file(FCPATH.'assets/properties/'.$icon)){
                    unlink(FCPATH.'assets/properties/'.$icon);
				}
				$uploadImg = $this->upload->data();
				$icon = $uploadImg['file_name'];
			}
	        $updateData = array(
	            'name'=> $this->input->post('rName'),
				'property_type'=> $this->input->post('property_type'),
				'address'=> $this->input->post('address'),
				'sector'=> $this->input->post('sector'),
				'state'=> $this->input->post('state'),
				'zip_code'=> $this->input->post('zip_code'),
				'budget'=> $this->input->post('budget'),
				'description'=> $this->input->post('note'),
			    'owner_name'=> $this->input->post('owner_name'),
				'prefer'=> $this->input->post('prefer'),
				'refer'=> $this->input->post('refer'),
				'owner_class'=> $this->input->post('owner_class'),
				'available'=> $this->input->post('available'),
				'available_from'=> $this->input->post('available_from'),
				'booking_amount'=> $this->input->post('booking_amount'),
				'booked_by'=> $this->input->post('booked_by'),
				'floor'=> $this->input->post('floor'),
				'booking_advance'=> $this->input->post('booking_advance'),
				'agreement'=> $this->input->post('agreement'),
				'police_verification'=> $this->input->post('police_verification'),
				'security'=> $this->input->post('security'),
				'commission'=> $this->input->post('commission'),
			    'show_in_slider'=>$this->input->post('show_in_slider'),
			    'status'=>$this->input->post('status'),
				'show_in_gallery'=>$this->input->post('show_in_gallery'),
				'bathrooms'=>$this->input->post('bathrooms'),
				'bedrooms'=>$this->input->post('bedrooms'),
				'sqft'=>$this->input->post('area_in_sq_ft'),
				'measureUnit'=>$this->input->post('unit'),
				'verified'=>$this->input->post('verified'),
				'hot_deals'=>$this->input->post('hot_deals'),
				'image_one'=> $image,
				'image_two'=> $imageTwo,
				'image_three'=> $imageThree,
				'image_four'=> $imageFour,
				'icon'=> $icon,
				'amenities'=> $amenities
			);
			
			
			$result = $this->AdminModel->updateTable($id,'id','rent',$updateData);
			if($result){
				$this->session->set_flashdata('message','Property updated successfully.');
                redirect(base_url('admin/rent/edit').'/'.$id);
			} 
	    }
	}
	

	
	
	$data['mainContent'] = 'siteAdmin/rentEdit'; 
    $this->load->view('includes/admin/template', $data);
 }
    
    public function deleteRent(){
     
        $id = $this->uri->segment('4');
        $role = $this->session->userdata('role');
        $properties = $this->AdminModel->getDataFromTableByField($id,'rent','id');
    	if($properties && stristr($role, 'Agent')){
    	    if($properties[0]->userid != $this->session->userdata('id')) { redirect(base_url('admin/dashboard')); }
    	}
 
        $result =  $this->AdminModel->deleteRow($id,'rent','id');
        if($result){
            $this->session->set_flashdata('message','Property delete successfully.');
        } else {
            $this->session->set_flashdata('message','Property not delete please try again.');
        }
        redirect(base_url('admin/rent'));
    }

}
?>