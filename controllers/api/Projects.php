<?php

   defined('BASEPATH') OR exit('No direct script access allowed');    /*ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	*/
	require APPPATH . 'libraries/REST_Controller.php';
	class Projects extends REST_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->model('Api_model');
			
			$checkToken = $this->checkForToken();
			if(!$checkToken) { die(); }
		}

        public function add_scraped_data_post() {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");

            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                http_response_code(200);
                exit;
            }

            $return = ['status' => 'error', 'message' => 'Invalid Request', 'result' => ''];
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!is_array($data)) {
                $return['message'] = 'Invalid data format (expected array of projects)';
                $this->response($return, REST_Controller::HTTP_BAD_REQUEST);
                return;
            }

            $inserted_ids = [];
            $updated_ids = [];
            $failed_projects = [];

            foreach ($data as $project) {
                if (empty($project['project_url'])) {
                    $failed_projects[] = [
                        'reason' => 'Missing project_url',
                        'project' => $project
                    ];
                    continue;
                }

                // Prepare data
                $projectData = [
                    'title'               => $project['title'] ?? '',
                    'project_name'        => $project['project_name'] ?? '',
                    'location'            => $project['location'] ?? '',
                    'bhk_info'            => $project['bhk_info'] ?? NULL,
                    'price_range'         => $project['price_range'] ?? NULL,
                    'start_date'          => $project['start_date'] ?? NULL,
                    'complete_date'       => $project['complete_date'] ?? NULL,
                    'description'         => $project['description'] ?? NULL,
                    'main_site'           => $project['main_site'] ?? NULL,
                    'project_url'         => $project['project_url'],
                    'usp_features'        => is_array($project['usp_features']) ? json_encode($project['usp_features']) : NULL,
                ];

                // Check for existing project by URL
                $this->db->where('project_url', $project['project_url']);
                $query = $this->db->get('projects');

                if ($query->num_rows() > 0) {
                    // Update if exists
                    $existing = $query->row();
                    $this->db->where('id', $existing->id);
                    $updated = $this->db->update('projects', $projectData);

                    if ($updated) {
                        $updated_ids[] = $existing->id;
                    } else {
                        $failed_projects[] = [
                            'reason' => 'Update failed',
                            'project_url' => $project['project_url']
                        ];
                    }
                } else {
                    // Insert if not exists
                    $insertId = $this->Api_model->add_data_in_table($projectData, 'projects');

                    if ($insertId) {
                        $inserted_ids[] = $insertId;
                    } else {
                        $failed_projects[] = [
                            'reason' => 'Insert failed',
                            'project_url' => $project['project_url']
                        ];
                    }
                }
            }

            $return['status'] = 'done';
            $return['message'] = 'Projects processed successfully';
            $return['result'] = [
                'inserted_ids' => $inserted_ids,
                'updated_ids' => $updated_ids,
                'failed' => $failed_projects
            ];

            $this->response($return, REST_Controller::HTTP_OK);
        }


		/** Get Single Project  **/
		
		public function getSingleProject_post()
		{   
			// CORS headers
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header("Access-Control-Allow-Headers: Content-Type, Authorization");
			
			if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
				http_response_code(200);
				exit;
			}
			
			$return = array('status'=>'error', 'message'=>'Please send all required parameters', 'result'=>'');
			
			$json = file_get_contents('php://input');
			$data = json_decode($json, true);
			
			$projectId = $data['pid'] ?? null;
			$visitorIP = $this->input->ip_address();
			
			if (is_null($projectId)) {
				$return['message'] = 'Project ID is required'; 
			} 
			elseif (!is_numeric($projectId)) {
				$return['message'] = 'Project ID must be in numeric format'; 
			} 
			else {
				$where = array('ip' => $visitorIP, 'rdate' => date('Y-m-d'), 'project_id' =>$projectId);
				$checkIp = $this->Api_model->getRecordByMultipleColumn($where, 'visitor_projects');
				if(!$checkIp){
					$addIpToTable = array('ip' => $visitorIP, 'rdate' => date('Y-m-d'), 'project_id' =>$projectId);
					$this->Api_model->add_data_in_table($addIpToTable,'visitor_projects');
				}
			
				$singleProjectDetail = $this->Api_model->getRecordByColumn('id', $projectId, 'Properties_Projects');
				
				if (!$singleProjectDetail) {
					$return['message'] = 'No records found';
					} else {
					// Initialize an empty array to store project details with image URLs
					$projectsArray = [];
					
					// Loop through each project detail and append the image URL
					foreach ($singleProjectDetail as &$project) {
						// Append the image URL based on the 'Images' field
						if (!empty($project['Images'])) {
							$project['imageUrl'] = 'https://bestpropertiesmohali.com/assets/properties/' . $project['Images'];
							} else {
							$project['imageUrl'] = 'https://bestpropertiesmohali.com/assets/properties/default_image.jpg'; // Fallback image
						}
						
						// Add this project to the projects array
						$projectsArray[] = $project;
					}
					
					// Return the projects array
					$return['result'] = $projectsArray;
					$return['status'] = 'done';
					$return['message'] = 'Done';
				}
			}
			
			// Send the response
			$this->response($return, REST_Controller::HTTP_OK);
		}
		
		public function getSomeeField_post()
		{   
			$return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
			$json = file_get_contents('php://input');
			$data = json_decode($json, true);
			
			
			$singleProjectDetail = $this->Api_model->getRecordByColumn(
			'status', 
			'active', 
			'Properties_Projects', 
			'id, Project_Name, Min_Budget, Max_Budget, Email, Address, Images'
			); 
			
			if(!$singleProjectDetail){
				$return['message'] = 'No records found';
			}
			else {
				foreach($singleProjectDetail as &$project) {
					$imageUrls = [];
					$images = explode(',', $project['Images']); 
					
					foreach($images as $image) {
						$trimmedImage = trim($image); 
						
						if(!empty($trimmedImage)) {
							$imageUrls[] = 'https://bestpropertiesmohali.com/uploads/projects/' . $trimmedImage;
						}
					}
					
					
					unset($project['Images']);
					$project['Image_URLs'] = $imageUrls; 
				}
				
				$return['result'] = $singleProjectDetail;
				$return['status'] = 'done';
				$return['message'] = 'Done';
			}
			
			$this->response($return, REST_Controller::HTTP_OK);
		}
		
		
		public function getSomeeFieldRC_post()
         {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

    // Residential Projects
    $residentialProjects = $this->Api_model->getRecordByColumn(
        'Project_Type',
        'Residential',
        'Properties_Projects',
        'id, Project_Name, Min_Budget, Max_Budget, Email, Address, Images'
    );

    // Commercial Projects
    $commercialProjects = $this->Api_model->getRecordByColumn(
        'Project_Type',
        'Commercial',
        'Properties_Projects',
        'id, Project_Name, Min_Budget, Max_Budget, Email, Address, Images' 
    );

    // Process Residential Projects
    if ($residentialProjects) {
        foreach ($residentialProjects as &$project) {
            $imageUrls = [];
            $images = explode(',', $project['Images']);
            
            foreach ($images as $image) {
                $trimmedImage = trim($image);
                if (!empty($trimmedImage)) {
                    $imageUrls[] = 'https://bestpropertiesmohali.com/uploads/projects/' . $trimmedImage;
                }
            }
            
            unset($project['Images']);
            $project['Image_URLs'] = $imageUrls;
        }
    }

    // Process Commercial Projects
    if ($commercialProjects) {
        foreach ($commercialProjects as &$project) {
            $imageUrls = [];
            $images = explode(',', $project['Images']);
            
            foreach ($images as $image) {
                $trimmedImage = trim($image);
                if (!empty($trimmedImage)) {
                    $imageUrls[] = 'https://bestpropertiesmohali.com/uploads/projects/' . $trimmedImage;
                }
            }
            
            unset($project['Images']);
            $project['Image_URLs'] = $imageUrls;
        }
    }

    // Final Result
    if (!$residentialProjects && !$commercialProjects) {
        $return['message'] = 'No records found';
    } else {
        $return['result'] = array(
            'Residential' => $residentialProjects ? $residentialProjects : [],
            'Commercial' => $commercialProjects ? $commercialProjects : []
        );
        $return['status'] = 'done';
        $return['message'] = 'Done';
    }

    $this->response($return, REST_Controller::HTTP_OK);
}
		
		
		
		public function getProjectField_post()
		{   
			$return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
			$json = file_get_contents('php://input');
			$data = json_decode($json, true);
			
			// Fetch project details
			$ProjectDetail = $this->Api_model->getRecordByColumn('approvel', 'approvel', 'properties', 'name, property_builder, description, built, property_for, address, phone, state, services, budget, image_one, image_two, image_three, image_four');
			
			if (!$ProjectDetail) {
				$return['message'] = 'No records found';
				} else {
				// Static URL to prepend to image fields
				$static_url = 'https://bestpropertiesmohali.com/assets/properties/';
				
				// Add the static URL to image fields only if the image exists
				foreach ($ProjectDetail as &$project) {
					if (!empty($project['image_one'])) {
						$project['image_one'] = $static_url . $project['image_one'];
					}
					if (!empty($project['image_two'])) {
						$project['image_two'] = $static_url . $project['image_two'];
					}
					if (!empty($project['image_three'])) {
						$project['image_three'] = $static_url . $project['image_three'];
					}
					if (!empty($project['image_four'])) {
						$project['image_four'] = $static_url . $project['image_four'];
					}
				}
				
				$return['result'] = $ProjectDetail;
				$return['status'] = 'done';
				$return['message'] = 'Done';
			}
			
			$this->response($return, REST_Controller::HTTP_OK);
		}
		public function getUpcomingProjects_get() {
			
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header("Access-Control-Allow-Headers: Content-Type, Authorization");
			
			if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
				http_response_code(200);
				exit;
			}
			
			// Using getRecordByColumn() function to fetch data with condition
			$where = 'Upcoming_Projects';
			$value = 'yes';
			$columns = 'id, Images, Project_Name, Min_Budget, Max_Budget, Address'; // Select required fields
			$singleProjectDetail = $this->Api_model->getRecordByColumn($where, $value, 'Properties_Projects', $columns);
			
			$return = array('status' => 'error', 'message' => 'No records found', 'result' => '');
			
			if ($singleProjectDetail) {
				foreach ($singleProjectDetail as &$project) {
					$imageUrls = [];
					$images = explode(',', $project['Images']); // Handle multiple images
					
					foreach ($images as $image) {
						$trimmedImage = trim($image);
						if (!empty($trimmedImage)) {
							$imageUrls[] = 'https://bestpropertiesmohali.com/uploads/projects/' . $trimmedImage;
						}
					}
					
					unset($project['Images']);
					$project['Image_URLs'] = $imageUrls; 
				}
				
				$return['status'] = 'done';
				$return['message'] = 'Done';
				$return['result'] = $singleProjectDetail;
			}
			
			$this->response($return, REST_Controller::HTTP_OK);
		}
		
		
		
		
	}