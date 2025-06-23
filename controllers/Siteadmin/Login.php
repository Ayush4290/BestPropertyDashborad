<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 private $salt = 'c1!s4vFdxM8DdmOj0lvxp3cFwQx';
 //private $captcha_config = array('secret-key'=>'6Ld45Y0aAAAAAC3Bg03lgZgQc1oQIfRSC5L6MgWl','site-key'=>'6Ld45Y0aAAAAAPj7U_HM-wFzbf5tv74_VBU0OdEe');
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
    $this->load->library('session'); 
    $this->load->helper('cookie');
    $this->load->model('AdminModel'); 
    

 }
 
    public function index() {
        $data['title'] = 'Best Properties Mohali';
        if (strstr($_SERVER['HTTP_HOST'], 'krrissh')) {
            $data['title'] = 'Krrissh';
        }

        // Generate Random Math Captcha
        if (!$this->session->userdata('captcha')) {
            $num1 = rand(1, 9);
            $num2 = rand(1, 9);
            $this->session->set_userdata('captcha', $num1 + $num2);
            $data['captcha_question'] = "$num1 + $num2 = ?";
        } else {
            $data['captcha_question'] = $this->session->userdata('captcha_question');
        }

        $sessionLogin = $this->session->userdata('adminLogged');

        if (!$sessionLogin) {
            $user = $this->input->post('userName');
            $pass = $this->input->post('pass');
            $captcha_input = $this->input->post('captcha');

            // Form Validation Rules
            $this->form_validation->set_rules('userName', 'Email', 'trim|required|valid_email|max_length[50]');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('captcha', 'Captcha', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                // Validation failed
            } else {
                // Math Captcha Validation
                if ($captcha_input != $this->session->userdata('captcha')) {
                    $this->session->set_flashdata('msg', 'Captcha verification failed, please try again.');
                } else {
                    // Password Hashing
                    $pwdSalt = hash_hmac("sha512", $pass, $this->salt);
                    $row = $this->AdminModel->getLogin($user, $pwdSalt);

                    if ($row) {
                        $this->session->set_userdata('adminLogged', 'true');
                        $this->session->set_userdata('fullName', $row[0]->fullName);
                        $this->session->set_userdata('id', $row[0]->id);
                        $this->session->set_userdata('role', $row[0]->role);
                         if ($this->input->post('remember')) {
        $this->input->set_cookie('userName', $user, 86400 * 30); // 30 days
        $this->input->set_cookie('password', $pass, 86400 * 30); // Not secure in real app
    } else {
        delete_cookie('userName');
        delete_cookie('password');
    }
                        redirect(base_url('admin/dashboard'));
                    } else {
                        $this->session->set_flashdata('msg', 'Email and password do not match, please try again.');
                    }
                }
            }
        } else {
            redirect(base_url('admin/dashboard'));
        }

        // Update Captcha for next time
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        $this->session->set_userdata('captcha', $num1 + $num2);
        $this->session->set_userdata('captcha_question', "$num1 + $num2 = ?");
        $data['captcha_question'] = $this->session->userdata('captcha_question');

        $this->load->view('siteAdmin/login', $data);
    }


public function dashboard() {
    $data['title'] = 'Dashboard';
    $data['url'] = 'dashboard';
    $data['redirect'] = '';
    $sessionLogin = $this->session->userdata('adminLogged'); 

    if (!$sessionLogin) {
        redirect(base_url('site-admin'));   
    }

    $today = date('Y-m-d 00:00:01'); 
    $userRole = $this->session->userdata('role');
    $userId = $this->session->userdata('id');

    // Notification Status by Role
    $statusByRole = [
        'Admin' => ['New', 'Contacted', 'Qualified', 'Site Visit Scheduled', 'Site Visited', 'Negotiation', 'Document Collection', 'Follow-up Later', 'Not Interested', 'Duplicate', 'Invalid Lead', 'Booking Confirmed', 'Finalized / Closed', 'Loan Under Process'],
        'Manager' => ['Contacted', 'Qualified', 'Booking Confirmed', 'Finalized / Closed'],
        'Agent' => ['New', 'Contacted', 'Qualified', 'Site Visit Scheduled', 'Site Visited', 'Negotiation', 'Document Collection', 'Follow-up Later', 'Not Interested', 'Duplicate', 'Invalid Lead'],
        'Telecaller' => ['Contacted', 'Qualified', 'Booking Confirmed', 'Finalized / Closed'],
        'Marketing Exec' => ['Document Collection', 'Contacted', 'Finalized'],
        'CRM Executive' => ['Contacted', 'Qualified', 'Booking Confirmed', 'Finalized / Closed'],
        'Documentation' => ['Contacted', 'Document Collection', 'Loan Under Process', 'Finalized / Closed']
    ];

    $allowedStatuses = isset($statusByRole[$userRole]) ? $statusByRole[$userRole] : [];

    //  Notification Data
    $data['notifications'] = $this->AdminModel->getRoleBasedNotifications($userId, $allowedStatuses);

    // Existing logic (untouched)
    $data['lead_tasks'] = $this->AdminModel->get_tasks_with_conditions('Followup', '', $today); 
    $data['meeting_tasks'] = $this->AdminModel->get_tasks_with_conditions('meeting', '', $today);

    if (strpos($userRole, 'Agent') !==false) {
        $data['total_leads'] = $this->AdminModel->getTableRowCount('buyers', 'userid', $userId);
        $data['new_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'New', 'userid', $userId);
        $data['assigned_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Assigned', 'userid', $userId);
        $data['hot_deal_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Hot', 'userid', $userId);
        $data['contacted_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Contacted', 'userid', $userId);
        $data['interested_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Interested', 'userid', $userId);
        $data['not_interested_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Not Interested', 'userid', $userId);
        $data['junk_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Junk', 'userid', $userId);
    } else {
        $data['total_leads'] = $this->AdminModel->getTableRowCount('buyers');
        $data['new_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'New');
        $data['assigned_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Assigned');
        $data['hot_deal_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Hot');
        $data['contacted_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Contacted');
        $data['interested_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Interested');
        $data['not_interested_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Not Interested');
        $data['junk_leads'] = $this->AdminModel->getTableRowCount('buyers', 'status', 'Junk');
    }

    if ($userRole == 'Agent') {
        $data['total_properties'] = $this->AdminModel->getTableRowCount('properties', '', '', 'userid', $userId);
        $data['residential'] = $this->AdminModel->getTableRowCount('properties', 'services', 'Residential', 'userid', $userId);
        $data['commercial'] = $this->AdminModel->getTableRowCount('properties', 'services', 'Commercial', 'userid', $userId);
    } else {
        $data['total_properties'] = $this->AdminModel->getTableRowCount('properties');
        $data['residential'] = $this->AdminModel->getTableRowCount('properties', 'services', 'Residential');
        $data['commercial'] = $this->AdminModel->getTableRowCount('properties', 'services', 'Commercial');
    }

    $data['total_admin'] = $this->AdminModel->getTableRowCount('adminLogin');
    $data['admin'] = $this->AdminModel->getTableRowCount('adminLogin', 'role', 'Admin');
    $data['agent'] = $this->AdminModel->getTableRowCount('adminLogin', 'role', 'Agent');
    $data['manager'] = $this->AdminModel->getTableRowCount('adminLogin', 'role', 'Manager');

    $data['Properties_Projects'] = $this->AdminModel->getTableRowCount('Properties_Projects');
    $data['active'] = $this->AdminModel->getTableRowCount('Properties_Projects', 'Status', 'active');
    $data['deactivate'] = $this->AdminModel->getTableRowCount('Properties_Projects', 'Status', 'deactivate');

    $data['total_contact'] = $this->AdminModel->getTableRowCount('contact');

    $data['mainContent'] = 'siteAdmin/dashboard'; 
    $this->load->view('includes/admin/template', $data);
}


 public function logout() {
		
		session_destroy();
		 
		$this->session->unset_userdata('adminLogged');
		$this->session->unset_userdata('fullName');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role');
		
		redirect(base_url('site-admin'));
	}
 public function userProfile(){
    $data['title'] = 'Users';
    
	$sessionLogin = $this->session->userdata('adminLogged'); 
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	
	$data['user'] = $this->AdminModel->getDataFromTable('users','','is_deleted','0');
	$data['mainContent'] = 'siteAdmin/user'; 
    $this->load->view('includes/admin/template', $data);
 }	
 public function userProfileView(){
    $data['title'] = 'User Profile';
    
	$sessionLogin = $this->session->userdata('adminLogged'); 
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	
	$id = $this->uri->segment('4');
	
	$data['user'] = $this->AdminModel->getDataFromTableByField($id,'users','id');
	$data['mainContent'] = 'siteAdmin/userView'; 
    $this->load->view('includes/admin/template', $data);
 }
  public function userProfileEdit(){
    $data['title'] = 'User Profile Edit';
    
	$sessionLogin = $this->session->userdata('adminLogged'); 
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	
	$id = $this->uri->segment('4');
	
	if($this->input->post('save')) {
	    $this->form_validation->set_rules('rName', 'name','trim|required|min_length[3]|max_length[100]');
	    $this->form_validation->set_rules('state', 'state','trim|min_length[1]|max_length[60]');
	    $this->form_validation->set_rules('city', 'city','trim|required|min_length[1]|max_length[60]');
	    
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	    
	    if ($this->form_validation->run() != FALSE) { 
		
	        $updateData = array(
				'firstname'=> $this->input->post('rName'),
				'lastname'=> $this->input->post('lastname'),
				'state'=> $this->input->post('state'),
				'city'=> $this->input->post('city'),
				'gender'=> $this->input->post('gender'),
				'birth_date'=> $this->input->post('birth_date')
			);
			$result = $this->AdminModel->updateTable($id,'id','users',$updateData);
			if($result){
				$this->session->set_flashdata('message','User Profile update successfully.');
                redirect(base_url('admin/users/edit').'/'.$id);
			} 
	    }
	}	
	
	$data['user'] = $this->AdminModel->getDataFromTableByField($id,'users','id');
	$data['states'] = $this->AdminModel->getDataFromTable('us_states');
	$data['cities'] = $this->AdminModel->getDataFromTable('us_cities');
	$data['mainContent'] = 'siteAdmin/userEdit'; 
    $this->load->view('includes/admin/template', $data);
 }
 public function deleteUserProfile(){
     
    $id = $this->uri->segment('4');
      
    if($id > 0){
         $updateData = array(
				'is_deleted'=> 1
		 );
         $this->AdminModel->updateTable($id,'id','users',$updateData);
         $this->session->set_flashdata('message','User Profile delete successfully.');
    } else {
         $this->session->set_flashdata('message','User Profile not delete please try again.');
     }
     redirect(base_url('admin/users'));
 } 
 public function userSearch(){
    $data['title'] = 'Users';
    
	$sessionLogin = $this->session->userdata('adminLogged'); 
	if(!($sessionLogin)) { redirect(base_url('site-admin'));   }
	
	$searchName = $this->input->post('searchName');
	$user = $this->AdminModel->getDataFromTableBySearchField($searchName,'users','firstname');
	
    	if(!empty($user)) {
    	 $i = 1;
    	 foreach($user as $users){
    	    echo '<tr>
					<td>'.$i.'</td>
					<td><a href="'.base_url('admin/users/view/').''.$users->id.'">'.$users->firstname.' '.$users->lastname.'</a></td>
					<td>'.$users->email.'</td>
					<td>'.$users->city.'</td>
					<td>'.$users->state.'</td>
					<td><a href="'.base_url('admin/users/view/').''.$users->id.'" class="btn btn-success btn-sm">View</a>
					</td>
					</tr>';
    	 }$i++;
        }
 }

    /************* google recaptcha ******************/
    public function verifyResponse($recaptcha){
		
		$remoteIp = $this->getIPAddress();

		// Discard empty solution submissions
		if (empty($recaptcha)) {
			return array(
				'success' => false,
				'error-codes' => 'missing-input',
			);
		}

		$getResponse = $this->getHTTP(
			array(
				'secret' => $this->captcha_config['secret-key'],
				'remoteip' => $remoteIp,
				'response' => $recaptcha,
			)
		);

		// get reCAPTCHA server response
		$responses = json_decode($getResponse, true);

		if (isset($responses['success']) and $responses['success'] == true) {
			$status = true;
		} else {
			$status = false;
			$error = (isset($responses['error-codes'])) ? $responses['error-codes']
				: 'invalid-input-response';
		}

		return array(
			'success' => $status,
			'error-codes' => (isset($error)) ? $error : null,
		);
	}


	private function getIPAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		{
		 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
		  $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}

	private function getHTTP($data){
		
		$url = 'https://www.google.com/recaptcha/api/siteverify?'.http_build_query($data);
		$response = file_get_contents($url);

		return $response;
	}
}
?>