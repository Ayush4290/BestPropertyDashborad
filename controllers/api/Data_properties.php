
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require APPPATH . 'libraries/REST_Controller.php';
class Data_properties extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Api_model');
          header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
        
    }


/*public function moveFilteredProperties_get()
{
    $return = ['status' => 'error', 'message' => '', 'result' => []];

    try {
        
        $this->db->group_start();
        $this->db->where('live_table !=', 'inserted');
    

        $this->db->group_end();
        $this->db->limit(20);
        $query = $this->db->get('properties_clone');

        if ($query->num_rows() == 0) {
            $return['message'] = 'No new records found in properties_clone';
            $this->response($return, REST_Controller::HTTP_OK);
            return;
        }

        $properties = $query->result_array();
        $results = [];

        foreach ($properties as $property) {
            $original_id = $property['id']; 

            $data = [
                 'clone_id'              => isset($property['id']) ? $property['id'] : '',
                'name'              => isset($property['name']) ? $property['name'] : '',
                'property_for'      => isset($property['property_for']) ? $property['property_for'] : '',
                'description'       => isset($property['description']) ? $property['description'] : '',
                'built'             => isset($property['built']) ? $property['built'] : 0,
                'land'              => isset($property['land']) ? $property['land'] : 0,
                'carpet'            => isset($property['carpet']) ? $property['carpet'] : 0,
                'project_n'         => isset($property['project_n']) ? $property['project_n'] : '',
                'budget'            => isset($property['budget']) ? $property['budget'] : 0,
                'budget_in_words'   => isset($property['budget_in_words']) ? $property['budget_in_words'] : '',
                'additional'        => isset($property['additional']) ? $property['additional'] : '',
                'additional_value'  => isset($property['additional_value']) ? $property['additional_value'] : '',
                'person'            => isset($property['person']) ? $property['person'] : '',
                'phone'             => isset($property['phone']) ? $property['phone'] : '',
                'person_address'    => isset($property['person_address']) ? $property['person_address'] : '',
                'address'           => isset($property['pAddress']) ? $property['pAddress'] : 'Not Available',
                'state'             => isset($property['state']) ? $property['state'] : '',
                'city'              => isset($property['city']) ? $property['city'] : '',
                'zip_code'          => isset($property['zip_code']) ? $property['zip_code'] : '',
                'property_type'     => isset($property['property_type']) ? $property['property_type'] : '',
                'status'            => 'deactivate',
                'approvel'          => 'approvel',
                 'userid'          => 35,
                'updated_at'        => date('Y-m-d H:i:s'),
                'created_at'        => date('Y-m-d H:i:s'),
                'is_deleted'        => 0,
                'image_one'         => isset($property['image_one']) ? $property['image_one'] : '',
                'image_two'         => isset($property['image_two']) ? $property['image_two'] : '',
                'image_three'       => isset($property['image_three']) ? $property['image_three'] : '',
                'image_four'        => isset($property['image_four']) ? $property['image_four'] : '',
                'amenities'         => isset($property['amenities']) ? json_encode($property['amenities']) : '[]',
                'show_in_slider'    => isset($property['show_in_slider']) ? $property['show_in_slider'] : '',
                'show_in_gallery'   => isset($property['show_in_gallery']) ? $property['show_in_gallery'] : '',
                'icon'              => isset($property['icon']) ? $property['icon'] : '',
                'bedrooms'          => isset($property['bedrooms']) ? $property['bedrooms'] : '',
                'sqft'              => isset($property['sqft']) ? $property['sqft'] : '',
                'measureUnit'       => isset($property['measureUnit']) ? $property['measureUnit'] : '',
                'services'          => isset($property['services']) ? $property['services'] : '',
                'verified'          => isset($property['verified']) ? $property['verified'] : '',
                'residential'       => isset($property['residential']) ? $property['residential'] : '',
                'commercial'        => isset($property['commercial']) ? $property['commercial'] : '',
                'hot_deals'         => isset($property['hot_deals']) ? $property['hot_deals'] : '',
                'bhk'               => isset($property['bhk']) ? $property['bhk'] : '',
                'main_site'               => isset($property['main_site']) ? $property['main_site'] : '',
            ];

            $inserted = $this->db->insert('properties', $data);

            if ($inserted) {
         
                $this->db->where('id', $original_id);
                $this->db->update('properties_clone', ['live_table' => 'inserted']);

                $results[] = [
                    'name' => $data['name'],
                    'message' => 'Inserted and marked as inserted in properties_clone'
                ];
            } else {
                $results[] = [
                    'name' => $data['name'],
                    'message' => 'Insert failed'
                ];
            }
        }

        $return['status'] = 'success';
        $return['message'] = 'Processing completed';
        $return['result'] = $results;

        $this->response($return, REST_Controller::HTTP_OK);

    } catch (Exception $e) {
        $return['message'] = 'Server error: ' . $e->getMessage();
        $this->response($return, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
}
*/



    public function moveFilteredProperties_get()
    {
        $return = ['status' => 'error', 'message' => '', 'result' => []];

        try {
            // Step 1: Get latest 10 entries from properties_clone that do NOT exist in properties (by clone_id)
            $this->db->select('pc.*');
            $this->db->from('properties_clone pc');
            $this->db->join('properties p', 'pc.id = p.clone_id', 'left');
            $this->db->where('p.clone_id IS NULL'); // Not yet moved
            $this->db->where('pc.live_table !=', 'inserted'); // Optional: avoid already marked as inserted
            $this->db->order_by('pc.id', 'DESC'); // Latest ones first
            $this->db->limit(10);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                $return['message'] = 'No new records found to move';
                $this->response($return, REST_Controller::HTTP_OK);
                return;
            }

            $properties = $query->result_array();
            $results = [];

            foreach ($properties as $property) {
                $original_id = $property['id'];

                $data = [
                    'clone_id'          => $property['id'],
                    'name'              => $property['name'],
                    'property_for'      => $property['property_for'],
                    'description'       => $property['description'],
                    'built'             => $property['built'],
                    'land'              => $property['land'],
                    'carpet'            => $property['carpet'],
                    'project_n'         => $property['project_n'],
                    'budget'            => $property['budget'],
                    'budget_in_words'   => $property['budget_in_words'],
                    'additional'        => $property['additional'],
                    'additional_value'  => $property['additional_value'],
                    'person'            => $property['person'],
                    'phone'             => $property['phone'],
                    'person_address'    => $property['person_address'],
                    'address'           => $property['pAddress'] ?? 'Not Available',
                    'state'             => $property['state'],
                    'city'              => $property['city'],
                    'zip_code'          => $property['zip_code'],
                    'property_type'     => $property['property_type'],
                    'status'            => 'deactivate',
                    'approvel'          => 'approvel',
                    'userid'            => 35,
                    'updated_at'        => date('Y-m-d H:i:s'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'is_deleted'        => 0,
                    'image_one'         => $property['image_one'],
                    'image_two'         => $property['image_two'],
                    'image_three'       => $property['image_three'],
                    'image_four'        => $property['image_four'],
                    'amenities'         => isset($property['amenities']) ? json_encode($property['amenities']) : '[]',
                    'show_in_slider'    => $property['show_in_slider'],
                    'show_in_gallery'   => $property['show_in_gallery'],
                    'icon'              => $property['icon'],
                    'bedrooms'          => $property['bedrooms'],
                    'sqft'              => $property['sqft'],
                    'measureUnit'       => $property['measureUnit'],
                    'services'          => $property['services'],
                    'verified'          => $property['verified'],
                    'residential'       => $property['residential'],
                    'commercial'        => $property['commercial'],
                    'hot_deals'         => $property['hot_deals'],
                    'bhk'               => $property['bhk'],
                    'main_site'         => $property['main_site'],
                ];

                $inserted = $this->db->insert('properties', $data);

                if ($inserted) {
                    // Mark the original entry as inserted
                    $this->db->where('id', $original_id);
                    $this->db->update('properties_clone', ['live_table' => 'inserted']);

                    $results[] = [
                        'name' => $data['name'],
                        'message' => 'Inserted and marked as inserted in properties_clone'
                    ];
                } else {
                    $results[] = [
                        'name' => $data['name'],
                        'message' => 'Insert failed'
                    ];
                }
            }

            $return['status'] = 'success';
            $return['message'] = 'Processing completed';
            $return['result'] = $results;

            $this->response($return, REST_Controller::HTTP_OK);

        } catch (Exception $e) {
            $return['message'] = 'Server error: ' . $e->getMessage();
            $this->response($return, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}