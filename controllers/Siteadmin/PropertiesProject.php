<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PropertiesProject extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('AdminModel'); // Use AdminModel only

        // Check if admin is logged in
        $sessionLogin = $this->session->userdata('adminLogged');
        if (!$sessionLogin) {
            redirect(base_url('site-admin'));
        }
    }
public function index() {
    $data['title'] = 'Projects';

    if (stristr($this->session->userdata('role'), 'Agent')) {
        $userId = $this->session->userdata('id'); 
        $where = array('userid' => $userId);
        $data['projects'] = $this->AdminModel->getDataByMultipleColumns($where, 'Properties_Projects', '*', 'id DESC');
    } else {
        $where = array('Project_Approvel !=' => 'not approvel');
        $data['projects'] = $this->AdminModel->getDataByMultipleColumns($where, 'Properties_Projects', '*', 'id DESC'); // Add DESC here too
    }

    $data['mainContent'] = 'siteAdmin/propertiesProjects';
    $this->load->view('includes/admin/template', $data);
}


  
  public function addProjects() {
    $data['title'] = 'Add Projects';

    // Check if admin is logged in
    $sessionLogin = $this->session->userdata('adminLogged');
    if (!$sessionLogin) {
        redirect(base_url('site-admin'));
    }

    if ($this->input->post('save')) {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('Project_Name', 'Project Name', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'valid_email');
        $upcoming_projects = $this->input->post('Upcoming_Projects') ? 'Yes' : 'No';

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('/admin/projects/add/');
        } else {
            // Handle amenities field
            $amenities = $this->input->post('amenities');
            if (!is_array($amenities)) {
                $amenities = array();
            }
            
              $approvel = '';
    if(stristr($this->session->userdata('role'), 'Agent')) {
        $approvel ='not approvel';
    }

            // Prepare data for insertion
            $insertData = array(
                 'userid'=>$this->session->userdata('id'),
                'Project_Discription' => $this->input->post('Project_Discription'),
                'Email' => $this->input->post('Email'),
                'Project_Type' => $this->input->post('Project_Type'),
                  'Certify' => $this->input->post('Certify'),
                 
                'Upcoming_Projects' => $upcoming_projects,
                'Video_u' => $this->input->post('Video_u'),
                'Min_Budget' => $this->input->post('Min_Budget'),
                'Max_Budget' => $this->input->post('Max_Budget'),
                'Built' => $this->input->post('Built'),
                'Project_Sub_Heading' => $this->input->post('Project_Sub_Heading'),
                'Project_Name' => $this->input->post('Project_Name'),
                'Address' => $this->input->post('Address'),
                'Construction_Status' => $this->input->post('Construction_Status'),
                'Bankers' => $this->input->post('Bankers'),
                'Project_Approvel' => $approvel,
                'Property_Sub_Description' => $this->input->post('Property_Sub_Description'),
                'Exclusive_Limited' => $this->input->post('Exclusive_Limited'),
                'amenities' => implode(',', $amenities)
            );

            // Handle image uploads if any
            if (!empty($_FILES['Images']['name'][0])) {
                $this->load->library('upload');

                // Set upload configurations
                $uploadPath = './uploads/projects/';

                // Check if the directory exists, if not create it
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, TRUE);
                }

                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                $images = array();
                foreach ($_FILES['Images']['name'] as $key => $image) {
                    $_FILES['file']['name'] = $_FILES['Images']['name'][$key];
                    $_FILES['file']['type'] = $_FILES['Images']['type'][$key];
                    $_FILES['file']['tmp_name'] = $_FILES['Images']['tmp_name'][$key];
                    $_FILES['file']['error'] = $_FILES['Images']['error'][$key];
                    $_FILES['file']['size'] = $_FILES['Images']['size'][$key];

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $images[] = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                        redirect('/admin/projects/add/');
                    }
                }

                // Convert array of image names to a comma-separated string
                $insertData['Images'] = implode(',', $images);
            }
            // Insert data into the database
            $result = $this->AdminModel->insertData('Properties_Projects', $insertData);

          	if($result){
				$this->session->set_flashdata('message','Properties Project Add successfully.');

            redirect('/admin/projects/add/');
        }
    }
    }

    // Load the view
    $data['mainContent'] = 'siteAdmin/propertiesProjectsAdd';
    $this->load->view('includes/admin/template', $data);
}
public function editProjects() {
    $data['title'] = 'Edit Projects';

    // Check if admin is logged in
    $sessionLogin = $this->session->userdata('adminLogged');
    if (!$sessionLogin) {
        redirect(base_url('site-admin'));
    }

    // Get project ID from URL segment
    $id = $this->uri->segment(4);
    
    $data['totalVisitor'] = $this->AdminModel->getDataByMultipleColumns(array('project_id' => $id), 'visitor_projects', 'id');
    // Fetch project details from database
    $data['project'] = $this->AdminModel->getDataFromTableByField($id, 'Properties_Projects', 'id');

    // Handle checkbox value for Upcoming Projects
    $upcoming_projects = 'No'; // Default value
    if (!empty($data['project']->Upcoming_Projects)) { // Check existing value
        $upcoming_projects = ($data['project']->Upcoming_Projects == 'Yes') ? 'Yes' : 'No';
    }

    // Check if form is submitted
    if ($this->input->post('update')) {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('Project_Name', 'Project Name', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'valid_email');

        // Handle checkbox value from form submission
        $upcoming_projects = $this->input->post('Upcoming_Projects') ? 'Yes' : 'No';

        // If validation fails, reload the form
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('/admin/projects/edit/' . $id);
        } else {
            // Handle amenities field
            $amenities = $this->input->post('amenities');
            if (!is_array($amenities)) {
                $amenities = array();
            }

            // Prepare data for update
            $updateData = array(
                'Project_Discription' => $this->input->post('Project_Discription'),
                'Email' => $this->input->post('Email'),
                'Upcoming_Projects' => $upcoming_projects, // Save checkbox value
                'Video_u' => $this->input->post('Video_u'),
                'Min_Budget' => $this->input->post('Min_Budget'),
                'Project_Type' => $this->input->post('Project_Type'),
                  'Certify' => $this->input->post('Certify'),
                'Built' => $this->input->post('Built'),
                'Project_Sub_Heading' => $this->input->post('Project_Sub_Heading'),
                'Project_Name' => $this->input->post('Project_Name'),
                'Address' => $this->input->post('Address'),
                'Construction_Status' => $this->input->post('Construction_Status'),
                'Bankers' => $this->input->post('Bankers'),
                'Property_Sub_Description' => $this->input->post('Property_Sub_Description'),
                'Exclusive_Limited' => $this->input->post('Exclusive_Limited'),
                'amenities' => implode(',', $amenities) // Save amenities as comma-separated values
            );

            // Handle image uploads if any
            $this->load->library('upload');
            $uploadPath = './uploads/projects/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, TRUE);
            }

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);

            // Handle new images
            $images = array();
            if (!empty($_FILES['Images']['name'][0])) {
                foreach ($_FILES['Images']['name'] as $key => $image) {
                    $_FILES['file']['name'] = $_FILES['Images']['name'][$key];
                    $_FILES['file']['type'] = $_FILES['Images']['type'][$key];
                    $_FILES['file']['tmp_name'] = $_FILES['Images']['tmp_name'][$key];
                    $_FILES['file']['error'] = $_FILES['Images']['error'][$key];
                    $_FILES['file']['size'] = $_FILES['Images']['size'][$key];

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $images[] = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                        redirect('/admin/projects/edit/' . $id);
                    }
                }

                $updateData['Images'] = implode(',', $images);
            }

            // Update project data in the database
            $result = $this->AdminModel->updateLeadStatus(array('id' => $id), 'Properties_Projects', $updateData);

            if ($result) {
                $this->session->set_flashdata('message', 'Properties Project updated successfully.');
                redirect('/admin/projects/edit/' . $id);
            }
        }
    }

    // Pass checkbox value to view for checked status
    $data['upcoming_projects_checked'] = ($upcoming_projects == 'Yes') ? 'checked' : '';

    // Load the view
    $data['mainContent'] = 'siteAdmin/propertiesProjectsEdit';
    $this->load->view('includes/admin/template', $data);
}

public function deleteProject($id) {
    $role = $this->session->userdata('role');
    $properties = $this->AdminModel->getDataFromTableByField($id, 'Properties_Projects', 'id');
    
   
    if ($properties && stristr($role, 'Agent')) {
        if ($Properties_Projects[0]->userid != $this->session->userdata('id')) {
            redirect(base_url('admin/dashboard'));
        }
    }

    $result = $this->AdminModel->deleteRow($id, 'Properties_Projects', 'id');
    if ($result) {
        $this->session->set_flashdata('message', 'Projects deleted successfully.');
    } else {
        $this->session->set_flashdata('message', 'Projects not deleted. Please try again.');
    }
    redirect(base_url('admin/projects'));
}

//thru ajex update
 public function updateStatus() {
      
            $id = $this->input->post('list_id');
	        $updateData = array(
				'status'=> $this->input->post('status')
			);
			$result = $this->AdminModel->updateTable($id,'id','Properties_Projects',$updateData);

 }  
public function approve() {
    $data['title'] = 'Project Approval';
    
    //Condition to fetch only properties with 'not approved' status
    $where = array('id >' => '1', 'Project_Approvel' => 'not approvel');
    
    // If the user role is 'Agent', filter by userid
    if(stristr($this->session->userdata('role'), 'Agent')) { 
        $where['userid'] = $this->session->userdata('id'); 
    }

    // Fetch properties based on the conditions
    $data['Properties_Projects'] = $this->AdminModel->getDataByMultipleColumns(
        $where,
        'Properties_Projects',
        '*',
        $orderBy = 'id',
        $orderByValue = 'desc'
    );
    
    // Load the view
    $data['mainContent'] = 'siteAdmin/projectApprove';
    $this->load->view('includes/admin/template', $data);
}

public function updateApprovalStatus()
{
    $projectId = $this->input->post('projectId');
    $status = $this->input->post('status');

    if (!empty($projectId) && in_array($status, ['approvel', 'not approvel'])) {
        $updateData = ['Project_Approvel' => $status];
        $this->db->where('id', $projectId);
        $this->db->update('Properties_Projects', $updateData);
        
        echo json_encode(['status' => 'success', 'message' => 'Approval status updated.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
}

}