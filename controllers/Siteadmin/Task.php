<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    $this->load->helper("file");
    
 	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
    }
    
    public function index() {
        $data['title'] = 'Task';
        $projectId = $this->uri->segment('3');
        
        $data['task'] = $this->AdminModel->getDataFromTableByField($projectId, 'task', 'project_id');
         $data['project_id'] = $projectId; // Pass project_id to the view
        $data['mainContent'] = 'siteAdmin/task'; 
        $this->load->view('includes/admin/template', $data);
    }


  public function addTask() {
    $data['title'] = 'Add Task'; 
  
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('task', 'Task','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('start_date', 'Start Date','required');
	    $this->form_validation->set_rules('complete_date', 'Complete Date','required');
	    
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) {
	        
	        $image = '';
	        
	        $config['upload_path'] = FCPATH.'assets/task/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['file_name'] = $_FILES['image']['name'];
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('image')) { 
				$uploadImg = $this->upload->data();
				$image = $uploadImg['file_name'];
			}
			
	        $addData = array(
	            'project_id'=> $this->uri->segment('4'),
	            'task'=> $this->input->post('task'),
	            'task_detail'=> $this->input->post('task_detail'),
	            'start_date'=> $this->input->post('start_date'),
	            'complete_date'=> $this->input->post('complete_date'),
	            'special_instruction'=> $this->input->post('special_instruction'),
	            'image'=> $image,
				'status'=> $this->input->post('status'),
	
				
			);
			$result = $this->AdminModel->addDataInTable($addData,'task');
			if($result){
				$this->session->set_flashdata('message','Task added successfully.');
                redirect(base_url('admin/task/add/').$this->uri->segment('4'));
			} 
	    }
	}

	$data['mainContent'] = 'siteAdmin/taskAdd'; 
    $this->load->view('includes/admin/template', $data);
 }

 public function editTask() {
    $data['title'] = 'Task Edit'; 
    
	$id = $this->uri->segment('5');
	$data['task'] = $this->AdminModel->getDataFromTableByField($id,'task','id');
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('task', 'Task','trim|required|min_length[3]|max_length[250]');
	    $this->form_validation->set_rules('start_date', 'Start Date','required');
	    $this->form_validation->set_rules('complete_date', 'Complete Date','required');
	    
	  $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) {
	        
	        $image = $this->input->post('imageOld');
	        
	        $config['upload_path'] = FCPATH.'assets/task/';
	        $config['allowed_types'] = 'jpg|jpeg|png|gif';
	        $config['file_name'] = $_FILES['image']['name'];
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('image')) {
			    
				if($image != '' && is_file(FCPATH.'assets/task/'.$image)){
                    unlink(FCPATH.'assets/task/'.$image);
				}
				$uploadImg = $this->upload->data();
				$image = $uploadImg['file_name'];
			}

			
			
	       $updateData = array(
	            'project_id'=> $this->uri->segment('4'),
	            'task'=> $this->input->post('task'),
	            'task_detail'=> $this->input->post('task_detail'),
	            'start_date'=> $this->input->post('start_date'),
	            'complete_date'=> $this->input->post('complete_date'),
	            'special_instruction'=> $this->input->post('special_instruction'),
	            'image'=> $image,
				'status'=> $this->input->post('status'),
		
				
			);
			$result = $this->AdminModel->updateTable($id,'id','task',$updateData);
			if($result){
				$this->session->set_flashdata('message','Task update successfully.');
                redirect(base_url('admin/task/edit/' . $this->uri->segment('4') . '/' . $this->uri->segment('5')));
			} 
	    }
	}
	
	
	
    if($this->input->post('submit')) {
        
	    
	    $this->form_validation->set_rules('comment', 'Comment','trim|required|min_length[3]|max_length[250]');
	    
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
	 
	        $insertData = array(
	            'comment_id'=> $this->uri->segment('4'),
	            'comment'=> $this->input->post('comment'),
	            'userId'=> $this->session->userdata('id')
		   );
			$result = $this->AdminModel->addDataInTable($insertData,'comment');
            if($result){
				$this->session->set_flashdata('message','Comment Added successfully.');
                redirect(base_url('admin/task/edit').'/'.$id);
	    }
	 }
        
    }
	
	$comment = $this->uri->segment('4');
	$data['comment'] = $this->AdminModel->getDataFromTableByField($comment,'comment','comment_id');
	
	$data['mainContent'] = 'siteAdmin/taskEdit'; 
    $this->load->view('includes/admin/template', $data);
 } 
 
 public function deleteTask(){
  
  unlink(FCPATH.'assets/task/'.$image);
 
    $id = $this->uri->segment('4');
  //  $lid = $this->uri->segment('5');
    $data['comment'] = $this->AdminModel->deleteRow($id,'comment','comment_id');
    $data['task'] = $this->AdminModel->deleteRow($id,'task','id');
         
     redirect(base_url('admin/task').'/'.$id);
 }
 
 public function deleteComment(){
    
    $id = $this->uri->segment('4');
    $lid = $this->uri->segment('5');
    $data['comment'] = $this->AdminModel->deleteRow($id,'comment','id');
    $data['task'] = $this->AdminModel->deleteRow($id,'task','id');
    
     redirect(base_url('admin/task/edit').'/'.$lid);
  }

}
?>