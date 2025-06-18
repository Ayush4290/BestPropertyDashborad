<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class PropertyDetail extends REST_Controller
{
public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->model('Api_model');

    // CORS Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, Authorization");

    // Handle preflight OPTIONS request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }
	
    $checkToken = $this->checkForToken();
    if(!$checkToken) {
        die();
    }
}


    /** add seller  **/
    public function propertyDetails_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => ''); 
        
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        
        $carpet_area = removeAllSpecialCharcter($data['carpet_area']);
        $plot_area = removeAllSpecialCharcter($data['plot_area']);
        $shop_front_details = removeAllSpecialCharcter($data['shop_front_details']);
        $title = removeAllSpecialCharcter($data['title']);
        $washroom_details = removeAllSpecialCharcter($data['washroom_details']);
        $located_near = removeAllSpecialCharcter($data['located_near']);
        $availability_status = removeAllSpecialCharcter($data['availability_status']);
        $age_of_property = removeAllSpecialCharcter($data['age_of_property']);
        $measure_unit = removeAllSpecialCharcter($data['measure_unit']);
        $measure = removeAllSpecialCharcter($data['measure']);
        $price = removeAllSpecialCharcter($data['price']);
        $status = 'deactive';
        $token = removeAllSpecialCharcter($data['token']);
        if (strlen($plot_area) < 3) {
            $return['message'] = 'Please enter valid plot area';
        }
        /*elseif ($upload_dir == 'uploads/' && isset($_FILES['images'])) {
            $images = $_FILES['images'];

            foreach ($images['name'] as $key => $name) {
                $tmp_name = $images['tmp_name'][$key];
                $type = $images['type'][$key];
                $size = $images['size'][$key];

                if (move_uploaded_file($tmp_name, $upload_dir )) {
                    echo 'Image uploaded: ' . $name;
                } else {
                    echo 'Error uploading image: ' . $name;
                }
            }
        }*/
      else{
            $propertyInformation = array('carpet_area' => $carpet_area, 'plot_area' => $plot_area, 'shop_front_details' => $shop_front_details, 'title' => $title, 'washroom_details' => $washroom_details, 'located_near' => $located_near, 'availability_status' => $availability_status, 'age_of_property'=> $age_of_property, 'measure_unit'=>$measure_unit, 'measure'=>$measure, 'token'=>$token, 'price'=>$price, 'status'=>$status);
            $this->Api_model->add_data_in_table($propertyInformation, 'propertyInformation ');
            $return['result'] = '';
            $return['status'] = 'done';
            $return['message'] = 'Property details added successfully.';
        
        $this->response($return, REST_Controller::HTTP_OK);
    }
    }
    
     public function imageupload_post(){
         $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
         
        $image = '';
        $config['upload_path'] = FCPATH . 'assets/properties/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $_FILES['image']['name'];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('upload_dir')) {
            $uploadImg = $this->upload->data();
            $image = $uploadImg['file_name'];
        }
        
        if($image != ''){
            $addInfo = array('upload_dir' => $image);
            $this->Api_model->add_data_in_table($addInfo, 'propertyInformation');
            $return['result'] = '';
            $return['status'] = 'done';
            $return['message'] = 'Seller added successfully.';
        }
        
        $this->response($return, REST_Controller::HTTP_OK);
         
     }
 
    
    public function propertyAllDetails_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
         
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        $id = $data['id'];
        if (!is_numeric($id)) {
            $return['message'] = 'Please pass a valid ID';
        } else {
            $getPropertyDetails = $this->Api_model->getPropertywithImages($id, 'active');
            
            
            if (empty($getPropertyDetails)) {
                $return['message'] = 'No records found';
            } else {
                $propertyType = $getPropertyDetails[0]['property_type'];
                $additionalPropertyDetails = $this->Api_model->getAdditionalPropertiesByType($propertyType, $id, 3);
               
                $return['status'] = 'done';
                $return['message'] = 'Success';
                $return['result'] = array(
                    'main_property' => $getPropertyDetails,
                    'additional_properties' => $additionalPropertyDetails
                );
            }
        }
        
        $this->response($return, REST_Controller::HTTP_OK);
    }



    public function getAgentProperties_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
         
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        $token = removeAllSpecialCharcter($data['token']);
        if ($token == '') {
            $return['message'] = 'Please pass a valid token';
        } else {
            $getAgentPropertyDetails = $this->Api_model->getRecordByColumn('token', $token, 'propertyInformation','carpet_area, plot_area, shop_front_details, title, washroom_details, located_near, availability_status, age_of_property, upload_dir, measure_unit, measure, price');
            if (empty($getAgentPropertyDetails)) {
                $return['message'] = 'No records found';
            } else {
                $return['status'] = 'done';
                $return['message'] = 'Success';
                $return['result'] = $getAgentPropertyDetails;
            }
        }
        
        $this->response($return, REST_Controller::HTTP_OK);
    }


    public function budget_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
    	 
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    	
    	$budget = array('Below 50 lac','50 to 1cr','Up to 2cr','Up to 3cr','Up to 5cr','Up to 10cr','Above 10cr');
    	$flat = array('1 Bhk','2 Bhk','3 Bhk','4 Bhk','5 Bhk','Other');
    	
    	$villa = array('100 sq yard','125 sq yard','200 sq yard','250 sq yard','300 sq yard','400 sq yard','500 sq yard','above 500 sq yard','other');
    	
    	$house = array('500 sq yard','1000 sq yard','1 acres','other');
    	
    	$return['status'] = 'done';
                $return['message'] = 'Success';
                $return['result'] = array(
    			'budget'=>$budget,
    			'flat'=>$flat,
    			'villa'=>$villa,
    				'house'=>$house
    			); 
      
        $this->response($return, REST_Controller::HTTP_OK);
    	
    }
    public function getAnymessage_post()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $message = removeAllSpecialCharcter($data['message']);
        
        if ($data !== null && isset($message)) {
            $success_message = trim($message); // Trim any extra whitespace
            
            if (!empty($success_message)) {
                $message = array('success_message' => $success_message);
                $getAnymessage = $this->Api_model->add_data_in_table($message, 'buyers_meta');
                
                if ($getAnymessage) {
                    $return['status'] = 'success'; 
                    $return['message'] = 'Message retrieved successfully'; 
                    $return['result'] = '';
                } else {
                    $return['message'] = 'Failed to add message to the database';
                }
            } else {
                $return['message'] = 'Please type a valid message';
            }
        }
    
        $this->response($return, REST_Controller::HTTP_OK);
    }

// public function testinserimage_post(){
//     $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
//     $input = $this->input->post();
//     $json = file_get_contents('php://input');
//     $data = json_decode($json, true);
//     $image = $data['decodedimg'];
//     $base64Data = substr($image, strpos($image, ',') + 1);
//     $imageData = base64_decode($base64Data);
//     if ($imageData !== false) {
//         $im = imageCreateFromString($imageData);
//         if ($im) {
//             $timestamp = time();
//             $imageFileName = /*$order_id . '_' .*/$timestamp . '.png';
//             $imageFileUrl = 'property-images/' /*. $order_id . '_'*/ . $timestamp . '.png';
//             $img_file = '/property-images/' . $imageFileName;
// 				if (imagepng($im, $img_file, 0)) {
// 				    $this->Api_model->add_data_in_table($addInfo, 'propertyInformation');
//                             } else {
//                                 echo 'Error inserting data';
//                             }
//                         } else {
//                             echo 'Error saving image.';
//                         }
//                     } else {
//                         echo 'Base64 value is not a valid image.';
//                     }
    
    
    
    
    
// }

/********* Property Hot Deals ***************/

	public function propertyHotDeals_get()
    {
		$return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
		$where = array('hot_deals' => 'yes', 'status' => 'active');
		$prohotDeals = $this->Api_model->getRecordByMultipleColumn($where, 'properties', 'id,name,type,budget,property_type,address,bathrooms,bedrooms,sqft,measureUnit,verified,image_one','id','RANDOM',6);
			if (empty($prohotDeals)) {
				$return['message'] = 'No Hot Deals Found';
			} else {
				$return['status'] = 'Done';
				$return['message'] = 'Done';
				$return['result'] = $prohotDeals;
				$return['image_url'] = base_url() . 'assets/properties/';
			}
		$this->response($return, REST_Controller::HTTP_OK);	
	}


/************* Property property type Api **************/

	public function allPropertyPropertyTypeApi_get()
    {
        $return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');
     
		$property_types = propertyPropertyType();
			if(!empty($property_types)){
				$return['result'] = $property_types;
				$return['status'] = 'done';
				$return['message'] = '';
			}
			else {
				// Property types could not be retrieved
				$return['message'] = 'Failed to retrieve property types';
			}
            $this->response($return, REST_Controller::HTTP_OK);
    }
    public function propertHomePageSomeFields_get()
{
	$return = array('status' => 'error', 'message' => 'Please send all required parameters', 'result' => '');

	// Specific ID ke liye where condition
	$where = array('id' => 235);
	$fields = 'id, name, bedrooms as bhk, sqft, budget, address';

	// Specific ID ka data fetch karna
	$propertyData = $this->Api_model->getRecordByMultipleColumn($where, 'properties', $fields);

	if (empty($propertyData)) {
		$return['message'] = 'No Property Found for the given ID';
	} else {
		$return['status'] = 'Done';
		$return['message'] = 'Done';
		$return['result'] = $propertyData;
		$return['image_url'] = base_url() . 'assets/properties/';
	}

	$this->response($return, REST_Controller::HTTP_OK);
}

    
 /*   public function getAgentField_post()
{   
        $return = array('status'=>'error','message'=>'Please send all required parameters','result'=>'');
        $json = file_get_contents('php://input');
	    $data = json_decode($json,true);
	    
	        
	   $singleProjectDetail = $this->Api_model->getRecordByColumn('status', 'active', 'Properties', 'name, property_builder, description, services');

	        if(!$singleProjectDetail){
	            $return['message'] = 'No records found';
	        }
	        else{
    	        $return['result'] = $singleProjectDetail;
                $return['status'] = 'done';
                $return['message'] = 'Done';
	        }
	    
	    $this->response($return, REST_Controller::HTTP_OK); }*/



/*public function getProperties_post() {
    $return = array('status' => 'error', 'message' => 'Please send valid parameters', 'result' => '');

    // Fetch data for ID 235 from the `properties` table
    $singlePropertiesDetail = $this->Api_model->getRecordByMultipleColumn(
    //   ['id' => 235], // Condition to fetch only ID 235
        'properties',
        'id, name, address, bhk, budget, image_one, sqft' // Columns to fetch
    );

    if (!$singlePropertiesDetail) {
        $return['message'] = 'No records found';
    } else {
        foreach ($singlePropertiesDetail as &$property) {
            $imageUrls = [];

            // Process the `image_one` field
            $images = explode(',', $property['image_one']); // Assuming `image_one` contains comma-separated image names

            foreach ($images as $image) {
                $trimmedImage = trim($image); // Remove extra spaces
                if (!empty($trimmedImage)) {
                    $imageUrls[] = 'https://bestpropertiesmohali.com/assets/properties/' . $trimmedImage;
                }
            }

            unset($property['image_one']); // Remove the original `image_one` field
            $property['Image_URLs'] = $imageUrls; // Add new Image URLs field
        }

        $return['status'] = 'done';
        $return['message'] = 'Data fetched successfully';
        $return['result'] = $singlePropertiesDetail;
    }

    $this->response($return, REST_Controller::HTTP_OK);
}*/

public function getProperties_post() {
    $return = array('status' => 'error', 'message' => 'Please send valid parameters', 'result' => '');

    // Explicitly pass all parameters
    $propertiesList = $this->Api_model->getRecordByMultipleColumn(
        [], // No WHERE clause (get all)
        'properties',
        'id, name, address, bhk, budget, image_one, sqft',
        'id',       // Sort column
        'DESC',     // Sort order
        8           // Limit
    );

    if (!$propertiesList) {
        $return['message'] = 'No records found';
    } else {
       foreach ($propertiesList as &$property) {
    $imageUrls = [];

    $images = explode(',', $property['image_one']);
    foreach ($images as $image) {
        $trimmedImage = trim($image);

        // Remove unwanted slashes
        $cleanImage = str_replace(['\\', '/'], '', $trimmedImage);

        if (!empty($cleanImage)) {
            $imageUrls[] = 'https://bestpropertiesmohali.com/assets/properties/' . $cleanImage;
        }
    }

    unset($property['image_one']);
    $property['Image_URLs'] = $imageUrls;
}

        $return['status'] = 'done';
        $return['message'] = 'Data fetched successfully';
        $return['result'] = $propertiesList;
    }

    $this->response($return, REST_Controller::HTTP_OK);
}


public function getPropertiesSingleOne_post() {
    // CORS headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    $return = array('status' => 'error', 'message' => 'Please send valid parameters', 'result' => '');

    // Fetch input data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $propertyId = $data['pid'] ?? null;

    if (is_null($propertyId)) {
        $return['message'] = 'Property ID is required';
    } elseif (!is_numeric($propertyId)) {
        $return['message'] = 'Property ID must be numeric';
    } else {
        // Fetch property details based on property ID
        $singlePropertiesDetail = $this->Api_model->getRecordByMultipleColumn(
            ['id' => $propertyId], // Filter by Property ID
            'properties',
            'id, name, address, bhk, budget, image_one, image_two, image_three, image_four, property_builder, property_for, project_n, city, state, property_type, amenities, sqft'
        );

        if (!$singlePropertiesDetail) {
            $return['message'] = 'No records found';
        } else {
            foreach ($singlePropertiesDetail as &$property) {
                $imageUrls = [];

                // Combine all image fields into one array
                $images = array_filter([
                    $property['image_one'] ?? '',
                    // $property['image_two'] ?? '',
                    // $property['image_three'] ?? '',
                    // $property['image_four'] ?? ''
                ]);

               foreach ($images as $image) {
    $trimmedImage = trim($image); // Remove extra spaces
    if (!empty($trimmedImage)) {
        if (filter_var($trimmedImage, FILTER_VALIDATE_URL)) {
            // Already a full URL
            $imageUrls[] = $trimmedImage;
        } else {
            // Local image, add base URL
            $imageUrls[] = 'https://bestpropertiesmohali.com/assets/properties/' . $trimmedImage;
        }
    }
}


                // Parse amenities
                $amenitiesList = [];
                if (!empty($property['amenities'])) {
                    // Split amenities using the custom separator `~-~`
                    $amenitiesArray = explode('~-~', $property['amenities']);
                    $amenitiesList = array_map('trim', $amenitiesArray); // Remove extra spaces
                }

                // Remove unwanted fields and add processed data
                unset($property['image_one'], $property['image_two'], $property['image_three'], $property['image_four'], $property['amenities']);
                $property['Image_URLs'] = $imageUrls;
                $property['amenities'] = $amenitiesList; // Add parsed amenities
            }

            $return['status'] = 'done';
            $return['message'] = 'Data fetched successfully';
            $return['result'] = $singlePropertiesDetail;
        }
    }

    // Send the response
    $this->response($return, REST_Controller::HTTP_OK);
}


public function submitAgentProperties_post()
{
    $return = ['status' => 'error', 'message' => 'Invalid input', 'result' => ''];

    try {
        $json = file_get_contents("php://input");
        $dataList = json_decode($json, true);

        if (empty($dataList) || !is_array($dataList)) {
            $return['message'] = 'No valid input data received';
            $this->response($return, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $results = [];

        foreach ($dataList as $index => $data) {
            if (!is_array($data)) {
                $results[] = [
                    'index' => $index,
                    'status' => 'error',
                    'message' => 'Invalid data format'
                ];
                continue;
            }

            $insertData = [
                'name'              => isset($data['name']) ? $data['name'] : '',
                'property_for'      => isset($data['property_for']) ? $data['property_for'] : '',
                'description'       => isset($data['description']) ? $data['description'] : '',
                'built'             => isset($data['built']) ? $data['built'] : 0,
                'land'              => isset($data['land']) ? $data['land'] : 0,
                'carpet'            => isset($data['carpet']) ? $data['carpet'] : 0,
                'project_n'         => isset($data['project_n']) ? $data['project_n'] : '',
                'budget'            => isset($data['budget']) ? $data['budget'] : 0,
                'budget_in_words'   => isset($data['budget_in_words']) ? $data['budget_in_words'] : '',
                'additional'        => isset($data['additional']) ? $data['additional'] : '',
                'additional_value'  => isset($data['additional_value']) ? $data['additional_value'] : '',
                'person'            => isset($data['person']) ? $data['person'] : '',
                'phone'             => isset($data['phone']) ? $data['phone'] : '',
                'person_address'    => isset($data['person_address']) ? $data['person_address'] : '',
                'address'           => isset($data['pAddress']) ? $data['pAddress'] : '',
                'state'             => isset($data['state']) ? $data['state'] : '',
                'city'              => isset($data['city']) ? $data['city'] : '',
                'zip_code'          => isset($data['zip_code']) ? $data['zip_code'] : '',
                'property_type'     => isset($data['property_type']) ? $data['property_type'] : '',
                'updated_at'        => isset($data['updated_at']) ? $data['updated_at'] : '',
                'created_at'        => isset($data['created_at']) ? $data['created_at'] : '',
                'is_deleted'        => isset($data['is_deleted']) ? $data['is_deleted'] : '',
                'image_one'         => isset($data['image_one']) ? $data['image_one'] : '',
                'image_two'         => isset($data['image_two']) ? $data['image_two'] : '',
                'image_three'       => isset($data['image_three']) ? $data['image_three'] : '',
                'image_four'        => isset($data['image_four']) ? $data['image_four'] : '',
                'amenities'         => isset($data['amenities']) ? json_encode($data['amenities']) : '',
                'status'            => isset($data['status']) ? $data['status'] : '',
                'approvel'          => isset($data['approvel']) ? $data['approvel'] : '',
                'show_in_slider'    => isset($data['show_in_slider']) ? $data['show_in_slider'] : '',
                'show_in_gallery'   => isset($data['show_in_gallery']) ? $data['show_in_gallery'] : '',
                'icon'              => isset($data['icon']) ? $data['icon'] : '',
                'bedrooms'          => isset($data['bedrooms']) ? $data['bedrooms'] : '',
                'sqft'              => isset($data['sqft']) ? $data['sqft'] : '',
                'measureUnit'       => isset($data['measureUnit']) ? $data['measureUnit'] : '',
                'services'          => isset($data['services']) ? $data['services'] : '',
                'verified'          => isset($data['verified']) ? $data['verified'] : '',
                'residential'       => isset($data['residential']) ? $data['residential'] : '',
                'commercial'        => isset($data['commercial']) ? $data['commercial'] : '',
                'hot_deals'         => isset($data['hot_deals']) ? $data['hot_deals'] : '',
                'bhk'               => isset($data['bhk']) ? $data['bhk'] : '',
                'fillter'           => isset($data['fillter']) ? $data['fillter'] : '',
                'json'              => isset($data['json']) ? $data['json'] : '',
                'main_site'         => isset($data['main_site']) ? $data['main_site'] : '',
                'property_url'      => isset($data['property_url']) ? html_entity_decode($data['property_url']) : '',
            ];

            try {
                // Check if property with same name exists
                $this->db->where('property_url', $insertData['property_url']);
                $query = $this->db->get('properties_clone');
				
                if ($query->num_rows() > 0) {
                    // Update existing record
                    $this->db->where('property_url', $insertData['property_url']);
                    $this->db->update('properties_clone', $insertData);
                    $action = 'updated';
                    $status = 'success';
                } else {
                    // Insert new record
                    $this->db->insert('properties_clone', $insertData);
                    $action = 'inserted';
                    $status = 'success';
                }
				
				$logData = 'Date: '.date('d-m-Y H:i').' Action: '.$action.' URL: '.$insertData['property_url']."\n";
				file_put_contents(FCPATH.'/scraper-entry.log',$logData);

                $results[] = [
                    'index' => $index,
                    'status' => $status,
                    'message' => 'Property ' . $action . ' successfully'
                    //'data' => $insertData
                ];
            } catch (Exception $ex) {
                $results[] = [
                    'index' => $index,
                    'status' => 'error',
                    'message' => 'Exception: ' . $ex->getMessage()
                ];
            }
        }

        $return['status'] = 'done';
        $return['message'] = 'Properties processed successfully';
        $return['result'] = $results;

        $this->response($return, REST_Controller::HTTP_OK);

    } catch (Exception $e) {
        $return['message'] = 'Server error: ' . $e->getMessage();
        $this->response($return, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
}


	public function checkPropertyurl_post()
{
    $return = ['status' => 'error', 'message' => 'Invalid input', 'result' => []];

    try {
        $json = file_get_contents("php://input");
        $dataList = json_decode($json, true);

        if (empty($dataList) || !is_array($dataList) || !isset($dataList['property_url']) || !is_array($dataList['property_url'])) {
            $return['message'] = 'No valid input data received';
            $this->response($return, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $results = [];
        foreach ($dataList['property_url'] as $url) {
            $query = $this->db->get_where('properties_clone', ['property_url' => $url]);
            $exists = $query->num_rows() > 0;

            $results[] = [
                'url' => $url,
                'exists_in_db' => $exists ? 'yes' : 'no'
            ];
        }

        $return['status'] = 'success';
        $return['message'] = 'Properties processed successfully';
        $return['result'] = $results;

        $this->response($return, REST_Controller::HTTP_OK);
    } catch (Exception $e) {
        $return['message'] = 'Server error: ' . $e->getMessage();
        $this->response($return, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
}




}