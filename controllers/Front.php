<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Front extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper(array('form','url','headerdata_helper'));
			$this->load->library('form_validation'); 
			
			$this->load->model('Register_model'); 
			
			if(strstr($_SERVER['HTTP_HOST'],'krrissh')){
			    redirect('https://krrissh.com/agent-login');
			}
			
			
		}
		
		
		public function index() { 
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'front';
			$this->load->view('includes/front/template', $data);
		}
		public function error() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			//	$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'error_404';
			$this->load->view('includes/front/template', $data);
		}
		public function reactView() {
			$data['page_slug'] = 'reactView';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			
		    $visitorIP = $this->input->ip_address();
		    $where = array('ip' => $visitorIP, 'rdate' => date('Y-m-d'));
		    $checkIp = $this->Register_model->getRecordByMultipleColumn($where, 'visitor_website');
		    if(!$checkIp){
		        $addIpToTable = array('ip' => $visitorIP, 'rdate' => date('Y-m-d'));
		        $this->Register_model->addDataInTable($addIpToTable,'visitor_website');
		    }  
			
			$data['main_content'] = 'reactView';
			$this->load->view('reactView', $data);
		}
		
		public function detailProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$url_id=$this->uri->segment(2);
			$url = explode('-',$url_id);
			$id = end($url);
			
			if($this->input->post('submit')!=''){
				
				$this->form_validation->set_rules('name', 'Firstname', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				$secret = '6LcmZ6IaAAAAAJTqrmwNs0-na_4LiJ2xZBxcW7CR'; // CHANGE THIS TO YOUR OWN!
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$_POST['g-recaptcha-response'];
				$verify = json_decode(file_get_contents($url));
				if($verify->success){
					
					}else{
					$this->form_validation->set_rules('emailkkkk', 'Please check captcha checkbox', 'required');
					//$this->form_validation->set_message('required', 'Please check captcha checkbox');
				}
				
				if ($this->form_validation->run() == FALSE)
				{}else
				{
					$propertyUrl= base_url().'properties/'.$url_id;
					$contact = array(
					'fname'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'phone'=>$this->input->post('phone'),
					'message'=>$this->input->post('message'),
					'property_url'=>$propertyUrl
					);
					
					$result = $this->Register_model->addDataInTable($contact,'contact');
					
					if($result ==true){
						
						$from_email =$this->input->post('email'); 
						//$to_email =$this->input->post('email'); 
						$to_email ='weboum@gmail.com'; 
						$this->load->library('email'); 
						$msg = "<table>
                        <tr><th>Name:</th><td>".$this->input->post('name')."</td></tr>
                        <tr><th>Email:</th><td>".$this->input->post('email')."</td></tr>
                        <tr><th>Phone:</th><td>".$this->input->post('phone')."</td></tr>
                        <tr><th>Message:</th><td>".$this->input->post('message')."</td></tr>
                        <tr><th>Property Url:</th><td>".$propertyUrl."</td></tr>
                        </table>";
						$this->email->set_mailtype("html");
						$this->email->from($from_email); 
						$this->email->to($to_email);
						$this->email->subject('Best property mohali'); 
						$this->email->message($msg); 
						
						if($this->email->send()!=''){ 
							
							$messge =  'Email Successfully  Sent';
							$this->session->set_flashdata('msg', $messge);
							} else{
							$messge =  'Sorry,Email Not Sent';
							$this->session->set_flashdata('msg', $messge);
						}
						
					}
				}
			}	
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties','','','id',$id);
			$data['main_content'] = 'property_detail';
			$this->load->view('includes/front/template', $data);
		}	
		public function searchProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$url_id=$this->uri->segment(2);
			$url = explode('-',$url_id);
			$id = end($url);		
			if($this->input->post('search')) {
				/* $type = $this->input->post('type');
					$property_for = $this->input->post('property_for');
				$city = $this->input->post('city');*/
				$locality = $this->input->post('location');
				$budgetMin = $this->input->post('budgetmin');
				$budgetMax = $this->input->post('budgetmax');
			}    
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete_new('properties','','','','',$locality,$budgetMin,$budgetMax);
			//$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties','','','','',$type,$property_for,$city,$locality,$budgetMin,$budgetMax);
			$data['main_content'] = 'search_property';
			$this->load->view('includes/front/template', $data);
		}
		public function properties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'properties';
			$this->load->view('includes/front/template', $data);
		}
		public function purchaseProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'purchase_properties';
			$this->load->view('includes/front/template', $data);
		}
		public function saleProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'sale_properties';
			$this->load->view('includes/front/template', $data);
		}
		public function rentProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties');
			$data['main_content'] = 'rent_properties';
			$this->load->view('includes/front/template', $data);
		}	
		public function contact() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_slug'] = 'home';
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			if($this->input->post('submit')!=''){
				
				$this->form_validation->set_rules('name', 'Firstname', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				$secret = '6LcmZ6IaAAAAAJTqrmwNs0-na_4LiJ2xZBxcW7CR'; // CHANGE THIS TO YOUR OWN!
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$_POST['g-recaptcha-response'];
				$verify = json_decode(file_get_contents($url));
				if($verify->success){
					
					}else{
					$this->form_validation->set_rules('emailkkkk', 'Please check captcha checkbox', 'required');
					//$this->form_validation->set_message('required', 'Please check captcha checkbox');
				}
				
				if ($this->form_validation->run() == FALSE)
				{}else
				{
					$contact = array(
					'fname'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'phone'=>$this->input->post('phone'),
					'message'=>$this->input->post('message')
					);
					
					$result = $this->Register_model->addDataInTable($contact,'contact');
					
					if($result ==true){
						
						$from_email =$this->input->post('email'); 
						//$to_email =$this->input->post('email'); 
						$to_email ='weboum@gmail.com'; 
						$this->load->library('email'); 
						$msg = "<table>
                        <tr><th>Name:</th><td>".$this->input->post('name')."</td></tr>
                        <tr><th>Email:</th><td>".$this->input->post('email')."</td></tr>
                        <tr><th>Phone:</th><td>".$this->input->post('phone')."</td></tr>
                        <tr><th>Message:</th><td>".$this->input->post('message')."</td></tr>";
						$this->email->set_mailtype("html");
						$this->email->from($from_email); 
						$this->email->to($to_email);
						$this->email->subject('Best property mohali'); 
						$this->email->message($msg); 
						
						if($this->email->send()!=''){ 
							
							$messge =  'Email Successfully  Sent';
							$this->session->set_flashdata('msg', $messge);
							} else{
							$messge =  'Sorry,Email Not Sent';
							$this->session->set_flashdata('msg', $messge);
						}
						
					}
				}
			}		
			$data['main_content'] = 'contact';
			$this->load->view('includes/front/template', $data);
		}
		public function cityProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			
			$url_id=$this->uri->segment(2);
			$replace=array("-");
			$replace_with=array(" ");
			$city =str_replace($replace,$replace_with,$url_id);
			
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties','','','','',$type,$property_for,$city,$locality,$budgetMin,$budgetMax);
			$data['main_content'] = 'search_property';
			$this->load->view('includes/front/template', $data);
		}	
		public function categoryProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			
			$url_id=$this->uri->segment(2);
			$replace=array("-","and");
			$replace_with=array(" ","&");
			$type =str_replace($replace,$replace_with,$url_id);
			$data['title'] = ucfirst($type);
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties','','','','',$type,$property_for,$city,$locality,$budgetMin,$budgetMax);
			$data['main_content'] = 'search_property';
			$this->load->view('includes/front/template', $data);
		}
		public function typeProperties() {
			
			// redirect(base_url('AdminLogin'));
			
			$data['page_title'] = 'Best Properties Mohali';
			$data['page_keywords'] = '';
			$data['page_description'] = '';
			
			$url_id=$this->uri->segment(2);
			$replace=array("-","and");
			$replace_with=array(" ","&");
			$Ptype =str_replace($replace,$replace_with,$url_id);
			$data['title'] = ucfirst($Ptype);
			$data['properties'] = $this->Register_model->getDataFromTableByFieldByDelete('properties','','','','',$type,$property_for,$city,$locality,$budgetMin,$budgetMax,$Ptype);
			if($this->input->post('submit')!=''){
				
				$this->form_validation->set_rules('name', 'Firstname', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				$secret = '6LcmZ6IaAAAAAJTqrmwNs0-na_4LiJ2xZBxcW7CR'; // CHANGE THIS TO YOUR OWN!
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$_POST['g-recaptcha-response'];
				$verify = json_decode(file_get_contents($url));
				if($verify->success){
					
					}else{
					$this->form_validation->set_rules('emailkkkk', 'Please check captcha checkbox', 'required');
					//$this->form_validation->set_message('required', 'Please check captcha checkbox');
				}
				
				if ($this->form_validation->run() == FALSE)
				{}else
				{
					$contact = array(
					'fname'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'phone'=>$this->input->post('phone'),
					'message'=>$this->input->post('message')
					);
					
					$result = $this->Register_model->addDataInTable($contact,'contact');
					
					if($result ==true){
						
						$from_email =$this->input->post('email'); 
						//$to_email =$this->input->post('email'); 
						$to_email ='weboum@gmail.com'; 
						$this->load->library('email'); 
						$msg = "<table>
                        <tr><th>Name:</th><td>".$this->input->post('name')."</td></tr>
                        <tr><th>Email:</th><td>".$this->input->post('email')."</td></tr>
                        <tr><th>Phone:</th><td>".$this->input->post('phone')."</td></tr>
                        <tr><th>Message:</th><td>".$this->input->post('message')."</td></tr>";
						$this->email->set_mailtype("html");
						$this->email->from($from_email); 
						$this->email->to($to_email);
						$this->email->subject('Best property mohali'); 
						$this->email->message($msg); 
						
						if($this->email->send()!=''){ 
							
							$messge =  'Email Successfully  Sent';
							$this->session->set_flashdata('msg', $messge);
							} else{
							$messge =  'Sorry,Email Not Sent';
							$this->session->set_flashdata('msg', $messge);
						}
						
					}
				}
			}			
			
			$data['main_content'] = 'search_property';
			$this->load->view('includes/front/template', $data);
		}	
	}
