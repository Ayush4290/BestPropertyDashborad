<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadTask extends CI_Controller {
 
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
    $subjectId = $this->uri->segment(3);
    
    $data['leadtask'] = $this->AdminModel->getDataFromTableByField($subjectId, 'leadTask', 'subjectId');
    $data['tasksinfo'] = $this->AdminModel->get_tasks_with_conditions('all', $subjectId); 
    $data['mainContent'] = 'siteAdmin/leadTask'; 
    $this->load->view('includes/admin/template', $data);
}

 
 public function addTask() {
    $data['title'] = 'Add Task'; 

    if ($this->input->post('save')) {
        // Set general validation rules
        $this->form_validation->set_rules('task', 'Task', 'trim|required|min_length[3]|max_length[250]');
        
        // Get the selected radio button value
        $choice = $this->input->post('choice');
        
        if ($choice === 'option2') { // Meeting selected
            // Meeting is selected, so start and complete dates are required
            $this->form_validation->set_rules('startdt', 'Start Date', 'required');
            $this->form_validation->set_rules('completedt', 'Complete Date', 'required');
        } else {
            // If 'Task' is selected, make the date fields optional
            $this->form_validation->set_rules('startdt', 'Start Date', 'trim');
            $this->form_validation->set_rules('completedt', 'Complete Date', 'trim');
        }

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        
        if ($this->form_validation->run() !== FALSE) {
            $image = '';
            
            // Configure file upload
            $config['upload_path'] = FCPATH . 'assets/task/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('image')) { 
                $uploadImg = $this->upload->data();
                $image = $uploadImg['file_name'];
            }
            
            // Set default values for optional fields if they are empty
            $startDate = $this->input->post('startdt') ? $this->input->post('startdt') : NULL;
            $completeDate = $this->input->post('completedt') ? $this->input->post('completedt') : NULL;
            $choice = $this->input->post('choice') ? $this->input->post('choice') : 'default_choice'; // Replace 'default_choice' with a suitable default value if needed
            $status = $this->input->post('status') ? $this->input->post('status') : 'default_status'; // Replace 'default_status' with a suitable default value if needed

            $addData = array(
                'subjectId' => $this->uri->segment('4'),
                'task' => $this->input->post('task'),
                'task_detail' => $this->input->post('task_detail'),
                'start_date' => $startDate,
                'complete_date' => $completeDate,
                'special_instruction' => $this->input->post('special_instruction'),
                'image' => $image,
                'choice' => $choice,
                'status' => $status
            );
            
            $result = $this->AdminModel->addDataInTable($addData, 'leadTask');
            
            if ($result) {
                $this->session->set_flashdata('message', 'Task added successfully.');
                redirect(base_url('admin/leadtask/add/') . $this->uri->segment('4'));
            }
        }
    }
    
    $data['mainContent'] = 'siteAdmin/leadTaskAdd'; 
    $this->load->view('includes/admin/template', $data);
}


public function editTask() {
    $data['title'] = 'Task Edit'; 
    $id = $this->uri->segment('5');
    $data['leadtask'] = $this->AdminModel->getDataFromTableByField($id, 'leadTask', 'id');
    
    if ($this->input->post('save')) {
        $this->form_validation->set_rules('task', 'Task', 'trim|required|min_length[3]|max_length[250]');
        
        // Get the selected radio button value
        $choice = $this->input->post('choice');
        
        if ($choice === 'option2') { // Meeting selected
            // Meeting is selected, so start and complete dates are required
            $this->form_validation->set_rules('startdt', 'Start Date', 'required');
            $this->form_validation->set_rules('completedt', 'Complete Date', 'required');
        } else {
            // If 'Task' is selected, make the date fields optional
            $this->form_validation->set_rules('startdt', 'Start Date', 'trim');
            $this->form_validation->set_rules('completedt', 'Complete Date', 'trim');
        }

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        
        if ($this->form_validation->run() != FALSE) {
            $image = $this->input->post('imageOld');
            
            $config['upload_path'] = FCPATH . 'assets/task/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['image']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('image')) {
                if ($image != '' && is_file(FCPATH . 'assets/task/' . $image)) {
                    unlink(FCPATH . 'assets/task/' . $image);
                }
                $uploadImg = $this->upload->data();
                $image = $uploadImg['file_name'];
            }

            $updateData = array(
                //'subjectId' => $this->uri->segment('4'),
                'task' => $this->input->post('task'),
                'task_detail' => $this->input->post('task_detail'),
                'start_date' => $this->input->post('startdt'),
                'complete_date' => $this->input->post('completedt'),
                'special_instruction' => $this->input->post('special_instruction'),
                'image' => $image,
                'choice' => $this->input->post('choice'),
                'status' => $this->input->post('status')
            );

            $result = $this->AdminModel->updateTable($id, 'id', 'leadTask', $updateData);
            if ($result) {
                $this->session->set_flashdata('message', 'Task updated successfully.');
                redirect(base_url('admin/leadtask/edit') . '/' . $id);
            }
        }
    }
    
    if ($this->input->post('submit')) {
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[3]|max_length[250]');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        
        if ($this->form_validation->run() != FALSE) { 
            $insertData = array(
                'leadtaskId' => $this->uri->segment('4'),
                'comment' => $this->input->post('comment')
            );
        
            $result = $this->AdminModel->addDataInTable($insertData, 'leadTask_comment');
            if ($result) {
                $this->session->set_flashdata('message', 'Comment Added successfully.');
                redirect(base_url('admin/leadtask/edit') . '/' . $id);
            }
        }
    }
    
    $comment = $this->uri->segment('4');
    $data['comment'] = $this->AdminModel->getDataFromTableByField($comment, 'leadTask_comment', 'leadtaskId');
    
    $data['mainContent'] = 'siteAdmin/leadTaskEdit'; 
    $this->load->view('includes/admin/template', $data);
}
 
 
  public function deleteTask(){
  
 
    $is = $this->uri->segment('5');
    $id = $this->uri->segment('4');
    $data['comment'] = $this->AdminModel->deleteRow($id,'leadTask_comment','leadtaskId');
    $data['task'] = $this->AdminModel->deleteRow($id,'leadTask','id');
     redirect(base_url('admin/leadtask').'/'.  $is);
 }
 
 public function deleteComment(){
    
    $id = $this->uri->segment('4');
    $lid = $this->uri->segment('5');
    $data['comment'] = $this->AdminModel->deleteRow($id,'leadTask_comment','id');
    $data['task'] = $this->AdminModel->deleteRow($id,'leadTask','id');
    
     redirect(base_url('admin/leadtask/edit').'/'.$lid);
  }
 


}
?>