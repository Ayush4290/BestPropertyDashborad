<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class LeadsView extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation'); 
			$this->load->helper('url'); 
			$this->load->helper('access_helper');
			$this->load->library('session'); 
			$this->load->model('AdminModel'); 
			$sessionLogin = $this->session->userdata('adminLogged');
			if(!($sessionLogin)) { redirect(base_url('site-admin'));   }  
		}
		public function index() {
			$data['title'] = 'View Lead'; 
			$id = $this->uri->segment('4');
             
             //update status notification
            $userId = $this->session->userdata('id');
  $notiKey = 'buyers_' . $id;
$this->db->where('notiKey', $notiKey);
$this->db->where('userid', $userId); 
$this->db->update('notification', ['status' => 1]);
            
			$userId = $this->session->userdata('id');
			$data['leads'] = $this->AdminModel->getDataFromTableByField($id,'buyers','id');
			$data['assignedLead'] = $this->AdminModel->getDataByMultipleColumns(array('leadid' => $id, 'userid' => $userId), 'assigned_leads');
			$role = $this->session->userdata('role');
    		check_agent_access($data['leads'], $data['assignedLead'], $role);
    		
			if($this->input->post('save')) {
				//$this->form_validation->set_rules('name', 'name','trim|required|min_length[3]|max_length[250]');
				$this->form_validation->set_rules('phone', 'phone','trim');
				//$this->form_validation->set_rules('address', 'address','trim|required|min_length[5]|max_length[100]');
				//$this->form_validation->set_rules('zip_code', 'zip code','trim|max_length[40]');
				$this->form_validation->set_rules('email', 'Email','trim|max_length[40]');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if ($this->form_validation->run() != FALSE) { 
					$updateData = array(
					'userType'=> $this->input->post('buyer'),
					'uName'=> $this->input->post('name'),
					'address'=> $this->input->post('address'),
					'location'=> $this->input->post('location'),
					'city'=> $this->input->post('city'),
					'mobile'=> $this->input->post('phone'),
					'email'=> $this->input->post('email'),
					'budget'=> $this->input->post('budget'),
					'min_budget'=> $this->input->post('budgetmin'),
					'max_budget'=> $this->input->post('budgetmax'),
					'requirement'=>$this->input->post('requirement'),
					'description'=>$this->input->post('description'),
					'residential'=> $this->input->post('residential'),
					'commercial'=> $this->input->post('commercial'),
					'status'=> $this->input->post('status'),
					);
					$result = $this->AdminModel->updateTable($id,'id','buyers',$updateData);
					$this->session->set_flashdata('message1','Leads update successfully.');
					//redirect(base_url('admin/leads/edit').'/'.$id);
				}
			}
		if ($this->input->post('submit')) {
    $this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[3]|max_length[250]');
    $this->form_validation->set_rules('choice', 'Type', 'trim'); // Add validation for choice field
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



    
if ($this->form_validation->run() != FALSE) { 
    $choice = $this->input->post('choice');
    $leadId = $this->uri->segment('4');

    $insertData = array(
        'leadId' => $leadId,
        'comment' => $this->input->post('comment'),
        'nextdt' => $this->input->post('nextdt'),
        'choice' => $choice
    );

    $result = $this->AdminModel->addDataInTable($insertData, 'leads_comment');

    if ($result) {
        // 🟡 Get lead details from buyers table
        $this->db->where('id', $leadId);
        $query = $this->db->get('buyers');
        $leadData = $query->row_array();

        $uName = $leadData['uName'] ?? '';
        $mobile = $leadData['mobile'] ?? '';

        // 🟢 Notification insert
        $notificationData = array(
            'userid' => $this->session->userdata('id'),
            'message' => 'Lead: ' . $uName . ' (' . $mobile . ') added new comment.',
            'notiKey' => 'buyers_' . $leadId,
            'status' => 0,
            'date' => date('Y-m-d H:i:s')
        );
        $this->AdminModel->addDataInTable($notificationData, 'notification');
    }
}

        
        if($choice == 'Meeting'){
    $sDate = $this->input->post('nextdt');
    if($sDate == ''){ $sDate = date('Y-m-d'); }
    $sDate = date('Y-m-d', strtotime($sDate));

    $leadId = $this->uri->segment('4');

    $addData = array(
        'subjectId' => $leadId,
        'task' => $this->input->post('comment'),
        'task_detail' => $this->input->post('comment'),
        'start_date' => $sDate,
        'choice' => 'meeting',
        'status' => 'active'
    );

    $result = $this->AdminModel->addDataInTable($addData, 'leadTask');

    if ($result) {
        // Buyer ka naam aur number nikalna
        $buyer = $this->db->get_where('buyers', ['id' => $leadId])->row_array();
        $uName = $buyer['uName'] ?? '';
        $mobile = $buyer['mobile'] ?? '';

        $notificationData = array(
            'userid' => $userId,
            'message' => 'Lead: ' . $uName . ' (' . $mobile . ') New leadTask',
            'notiKey' => 'buyers_' . $leadId,
            'status' => 0,
            'date' => date('Y-m-d H:i:s')
        );
        $this->AdminModel->addDataInTable($notificationData, 'notification');
    }
}
        
        
        $this->session->set_flashdata('message2', 'Leads comment added successfully.');
        redirect(base_url('admin/leads/view') . '/' . $id);
    }


/* #########  Code for Lead Assign Start #################### */  
    
$assignedAgents = $this->AdminModel->getDataByMultipleColumns(array('leadid' => $id), 'assigned_leads', 'userid');

if ($this->input->post('assignLead')) {
    
    $agentID = $this->input->post('agents');
    $existingAgentIDs = array();
    foreach ($assignedAgents as $assignedAgent) {
        $existingAgentIDs[] = $assignedAgent->userid;
    }
    
    if (!empty($agentID)) {
        foreach ($existingAgentIDs as $existingID) {
            if (!in_array($existingID, $agentID)) {  
                 $this->AdminModel->deleteRow($existingID, 'assigned_leads', 'userid');
                 $this->session->set_flashdata('message1', 'Lead assignments updated successfully.');
                 redirect(base_url('admin/leads/view') . '/' . $id);
            }
        }
        
// Lead ka naam aur mobile buyers table se le lo
$buyer = $this->db->get_where('buyers', ['id' => $id])->row_array();
$uName = $buyer['uName'] ?? '';
$mobile = $buyer['mobile'] ?? '';

foreach ($agentID as $newID) {
    if (!in_array($newID, $existingAgentIDs)) {
        $data = array(
            'leadid' => $id,
            'userid' => $newID
        );
        $this->AdminModel->addDataInTable($data, 'assigned_leads');

        // ✅ Add Notification
        $notification = array(
            'userid' => $newID,
            'message' => 'Lead: ' . $uName . ' (' . $mobile . ') Assign New Lead',
            'notiKey' => 'buyers_' . $id,
            'status' => 0,
            'date' => date('Y-m-d H:i:s')
        );
        $this->AdminModel->addDataInTable($notification, 'notification');

        // Flash message and redirect
        $this->session->set_flashdata('message1', 'Lead assignments updated successfully.');
        redirect(base_url('admin/leads/view') . '/' . $id);
    }
}


    } else {
        $this->AdminModel->deleteRow($id, 'assigned_leads', 'leadid');
        $this->session->set_flashdata('error', 'Please select at least one agent.');
        redirect(base_url('admin/leads/view') . '/' . $id);
    }

}
$data['leads'] = $this->AdminModel->getDataFromTableByField($id, 'buyers', 'id');
$data['leadscomment'] = $this->AdminModel->getDataFromTableByField($id, 'leads_comment', 'leadId');
if($assignedAgents){
    $data['selectedAgents'] = $assignedAgents;
}
$data['agents'] = $this->AdminModel->getDataByMultipleColumns(array('role' => 'Agent'), 'adminLogin', 'id,fullName');
$data['mainContent'] = 'siteAdmin/leadsView'; 
$this->load->view('includes/admin/template', $data);

		}
	
		}