<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubTask extends CI_Controller {
 
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
    $data['title'] = 'Sub Task';
    $taskId = $this->uri->segment('4');
      $data['project_id'] = $this->uri->segment(3);
    $data['tas_id'] = $this->uri->segment(4);
    
    
    $data['task'] = $this->AdminModel->getDataFromTableByField($taskId,'subtask','task_id');
    
    $data['mainContent'] = 'siteAdmin/subtask'; 
    $this->load->view('includes/admin/template', $data);
 }

public function addSubTask() {
    $data['title'] = 'Add Sub Task';

    // Retrieve project_id and tas_id from the URL segments
    $data['project_id'] = $this->uri->segment(4);
    $data['tas_id'] = $this->uri->segment(5);

    if ($this->input->post('save')) {
        $this->form_validation->set_rules('task', 'Task', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('complete_date', 'Complete Date', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() != FALSE) {
            
            $image = '';
            
            $config['upload_path'] = FCPATH.'assets/task/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('image')) { 
                $uploadImg = $this->upload->data();
                $image = $uploadImg['file_name'];
            }
            
            $addData = array(
                'task_id' => $data['tas_id'], // Use $tas_id from URL
                'project_id' => $data['project_id'] ,
                'subtask' => $this->input->post('task'),
                'subtask_detail' => $this->input->post('task_detail'),
                'start_date' => $this->input->post('start_date'),
                'complete_date' => $this->input->post('complete_date'),
                'special_instruction' => $this->input->post('special_instruction'),
                'image' => $image,
                'status' => $this->input->post('status')
            );

            $result = $this->AdminModel->addDataInTable($addData, 'subtask');
            if ($result) {
                $this->session->set_flashdata('message', 'Subtask added successfully.');
                redirect(base_url('admin/subtask/add/').$data['project_id'].'/'.$data['tas_id']); // Update the redirect URL
            } 
        }
    }

    $data['mainContent'] = 'siteAdmin/subtaskAdd';
    $this->load->view('includes/admin/template', $data);
}


 public function editsubTask() {
    $data['title'] = 'Sub Task Edit'; 
    
    $id = $this->uri->segment('6');
    $data['task'] = $this->AdminModel->getDataFromTableByField($id,'subtask','id');
    
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
                'task_id'=> $this->uri->segment('5'),
                'subtask'=> $this->input->post('task'),
                'subtask_detail'=> $this->input->post('task_detail'),
                'start_date'=> $this->input->post('start_date'),
                'complete_date'=> $this->input->post('complete_date'),
                'special_instruction'=> $this->input->post('special_instruction'),
                'image'=> $image,
                'status'=> $this->input->post('status')
                
            );
            $result = $this->AdminModel->updateTable($id,'id','subtask',$updateData);
            if($result){
                $this->session->set_flashdata('message','Sub Task update successfully.');
                redirect(base_url('admin/subtask/edit/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6)));

            } 
        }
    }
    
    
    
    if($this->input->post('submit')) {
        
        $this->form_validation->set_rules('comment', 'Comment','trim|required|min_length[3]|max_length[250]');
        
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        
        if ($this->form_validation->run() != FALSE) { 
     
            $insertData = array(
                'subtaskId'=> $this->uri->segment('4'),
                'comment'=> $this->input->post('comment')
            );
        
            $result = $this->AdminModel->addDataInTable($insertData,'subtask_comment');
            if($result){
                $this->session->set_flashdata('message','Comment Added successfully.');
                redirect(base_url('admin/subtask/edit').'/'.$id);
            }
        }
    }
    
    $comment = $this->uri->segment('6');
    $data['comment'] = $this->AdminModel->getDataFromTableByField($comment,'subtask_comment','subtaskId');
    
    $data['mainContent'] = 'siteAdmin/subtaskEdit'; 
    $this->load->view('includes/admin/template', $data);
 } 
 
 public function deletesubTask(){

 
    $id = $this->uri->segment('5');
    //$lid = $this->uri->segment('5');
    $data['comment'] = $this->AdminModel->deleteRow($lid,'subtask_comment','subtaskId');
    $data['task'] = $this->AdminModel->deleteRow($id,'subtask','id');
         
     redirect(base_url('admin/subtask').'/'.$id);
 }
 
 public function deleteComment(){
    
    $id = $this->uri->segment('6');
    $lid = $this->uri->segment('5');
    $data['comment'] = $this->AdminModel->deleteRow($lid,'subtask_comment','subtaskId');
    $data['task'] = $this->AdminModel->deleteRow($id,'subtask','id');
    
     redirect(base_url('admin/subtask/edit').'/'.$lid);
  }

}
?>
