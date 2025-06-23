<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Whatsapp extends CI_Controller {
		
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
			$data['title'] = 'Whatsapp';
			
			$where = ['wa.contact_number !=' => '']; 
			$data['whatsapp'] = $this->AdminModel->get_whatsapp_with_name($where);
			
			$data['mainContent'] = 'siteAdmin/whatsapp';
			$this->load->view('includes/admin/template', $data);
		}
		
public function wtspmessage() {
    $contact_number = $this->uri->segment(3);
    $where = ['wa.contact_number' => $contact_number];
    $data['messages'] = $this->AdminModel->get_whatsapp_with_name($where);

    if ($this->input->method() == 'post') {
        $message = $this->input->post('message');
        $has_image = !empty($_FILES['attachment']['name']);

        if (trim($message) == '' && !$has_image) {
            $this->session->set_flashdata('error', 'Please enter a message or attach an image.');
            redirect(base_url() . 'admin/whatsapp/' . $contact_number);
        }

        $phone_number_id = '679719728549064';
        $image_path = null;

        // Upload image
        if ($has_image) {
            $config['upload_path'] = './uploads/whatsapp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['attachment']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('attachment')) {
                $uploadData = $this->upload->data();
                $image_path = 'uploads/whatsapp/' . $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors('', ''));
                redirect(base_url() . 'admin/whatsapp/' . $contact_number);
            }
        }

        $user_id = $this->session->userdata('id');
        if (empty($user_id)) {
            show_error('User ID missing in session. Please login again.');
        }

        $token = 'EAARGvMRMpHEBO4p5iCsPkZB14bZAnmsqk2HrwCaiFNq1ApElMZAofcDyaKZAZAuXC921nSwPrWldrhbnlF1myVakQw4xSwHxdGqt8ivx24hLrvQbbeWaluPOQv7jet7pNEoV3dC8ZBoMmkmJoZC6eYJiDId9qZAYzEaRelPcpnjnI250wyCd0hCHgMncbAaXMgtX9QZDZD';

        // WhatsApp API Payload
        if (!empty($image_path)) {
            // Image payload
            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $contact_number,
                "type" => "image",
                "image" => [
                    "link" => base_url($image_path)
                ]
            ];
        } else {
            // Text payload
            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $contact_number,
                "type" => "text",
                "text" => ["body" => $message]
            ];
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://graph.facebook.com/v19.0/' . $phone_number_id . '/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Log to file
        $logData = "Date: " . date('Y-m-d H:i:s') . "\n";
        $logData .= "To: $contact_number\n";
        $logData .= "Payload: " . json_encode($payload) . "\n";
        $logData .= "HTTP Code: $httpCode\n";
        $logData .= "Response: $response\n";
        $logData .= "CURL Error: $error\n";
        $logData .= "-----------------------------\n";
        file_put_contents(FCPATH . 'logss.txt', $logData, FILE_APPEND);

        // Check if message sent successfully
        if ($httpCode != 200) {
            $this->session->set_flashdata('error', 'Error sending message! CURL Error: ' . $error . ' | Response: ' . $response);
            redirect(base_url() . 'admin/whatsapp/' . $contact_number);
        }

        // Save to database
        $data_insert = [
            'message' => $message,
            'whatsapp_image' => !empty($image_path) ? $image_path : '',
            'r_date' => date('Y-m-d H:i:s'),
            'r_type' => 'user',
            'contact_number' => $contact_number,
            'user_id' => $user_id,
        ];
        $this->db->insert('whatsapp_api', $data_insert);

        $this->session->set_flashdata('success', 'Message sent successfully.');
        redirect(base_url() . 'admin/whatsapp/' . $contact_number);
    }

    $data['title'] = 'Whatsapp Messages';
    $data['messages'] = $this->AdminModel->get_whatsapp_with_name($where);
    $data['r_name'] = !empty($data['messages']) ? $data['messages'][0]['r_name'] : 'Unknown';
    $data['mainContent'] = 'siteAdmin/whatsappEdit';
    $this->load->view('includes/admin/template', $data);
}

		
		
	public function firstMessage() {
    
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z ]+$/]', array('regex_match' => 'The %s field may only contain letters and spaces.'));
        $this->form_validation->set_rules('contact_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]', array('regex_match' => 'The %s must be exactly 10 digits.'));
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        
        if ($this->form_validation->run()) {

            $name = $this->input->post('name');
            $contact_number = '91' . $this->input->post('contact_number');
            
            $phone_number_id = '679719728549064';  
            $token = 'EAARGvMRMpHEBO4p5iCsPkZB14bZAnmsqk2HrwCaiFNq1ApElMZAofcDyaKZAZAuXC921nSwPrWldrhbnlF1myVakQw4xSwHxdGqt8ivx24hLrvQbbeWaluPOQv7jet7pNEoV3dC8ZBoMmkmJoZC6eYJiDId9qZAYzEaRelPcpnjnI250wyCd0hCHgMncbAaXMgtX9QZDZD';        
            
            // Insert into database
            $msgData = [
                'message' => "Name: $name\nWaiting for reply.",
                'whatsapp_image' => '',
                'r_date' => date("Y-m-d H:i:s"),
                'r_type' => 'template',
                'contact_number' => $contact_number,
            ];
            $this->AdminModel->addDataInTable($msgData, 'whatsapp_api');

            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $contact_number,
                "type" => "template",
                "template" => [
                    "name" => "property_offer_alert", // this should match your approved template name
                    "language" => [
                        "code" => "en"
                    ],
                    "components" => [
                        [
                            "type" => "header",
                            "parameters" => [
                                [
                                    "type" => "text",
                                    "text" => "Mohali"
                                ]
                            ]
                        ],
                        [
                            "type" => "body",
                            "parameters" => [
                                [
                                    "type" => "text",
                                    "text" => $name
                                ]
                            ]
                        ]
                    ]
                ]
            ];



            // WhatsApp API Template Data
           /* $payload = [
                "messaging_product" => "whatsapp",
                "to" => $contact_number,
                "type" => "template",
                "template" => [
                    "name" => "property_offer",
                    "language" => ["code" => "en"],
                    "components" => [
                        [
                            "type" => "header",
                            "parameters" => [
                                ["type" => "text", "text" => "Products!"]
                            ]
                        ],
                        [
                            "type" => "body",
                            "parameters" => []
                        ],
                        [
                            "type" => "button",
                            "sub_type" => "voice_call",
                            "index" => "0"
                        ]
                    ]
                ]
            ];*/

            // cURL Call to WhatsApp API
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => "https://graph.facebook.com/v22.0/$phone_number_id/messages",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ]
            ]);
            
            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);
            
            // Optional: Logging
            $log = "DATE: " . date("Y-m-d H:i:s") . "\n";
            $log .= "To: $contact_number\n";
            $log .= "Payload: " . json_encode($payload) . "\n";
            $log .= "Response: $response\n";
            $log .= "CURL Error: $error\n";
            $log .= "--------------------------\n\n";
            file_put_contents('whatsapp_log.txt', $log, FILE_APPEND);
			redirect(base_url('admin/whatsapp'));
        }
    }
	  
			$data['mainContent'] = 'siteAdmin/whatsapp-new-user';
			$this->load->view('includes/admin/template', $data);
}
}