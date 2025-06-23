<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Properties extends CI_Controller {
 
 public function __construct()
 {
    parent::__construct();
   
    $this->load->library('form_validation'); 
    $this->load->helper('url'); 
     $this->load->helper('headerdata_helper');
    $this->load->library('session'); 
    $this->load->model('AdminModel'); 
    
	$sessionLogin = $this->session->userdata('adminLogged');
	if(!($sessionLogin)) { redirect(base_url('site-admin'));  
	}
 }
/*public function index() {
    $data['title'] = 'Properties';

    $filters = [];
    $like = [];

    // Agent filter
    if (stristr($this->session->userdata('role'), 'Agent')) {
        $filters['userid'] = $this->session->userdata('id');
    }

    // POST filter
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $post = $this->input->post();

        if (!empty($post['name'])) {
            $like['name'] = $post['name'];
        }
        if (!empty($post['bhk'])) {
            $filters['bhk'] = $post['bhk'];
        }
        if (!empty($post['type'])) {
            $filters['type'] = $post['type'];
        }
        if (!empty($post['services'])) {
            $filters['services'] = $post['services'];
        }
           if (!empty($post['description'])) {
            $like['description'] = $post['description'];
        }
    }

    // Get filtered data
    //$data['properties'] = $this->AdminModel->getFilteredProperties($filters, $like, 'properties', '*', 'id', 'desc');
   $data['properties'] = $this->AdminModel->getFilteredProperties(
        $filters,
        $like,
        'properties',
        'properties.*, properties_clone.main_site, properties_clone.property_url',
        'properties.id',
        'desc'
    );

    $data['mainContent'] = 'siteAdmin/properties';
    $this->load->view('includes/admin/template', $data);
}
*/

public function index() {
    $data['title'] = 'Properties';

    $filters = [];
    $like = [];

    // Agent filter
    if (stristr($this->session->userdata('role'), 'Agent')) {
        $filters['properties.userid'] = $this->session->userdata('id');
    }

    // POST filter
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $post = $this->input->post();

        if (!empty($post['name'])) {
            $like['properties.name'] = $post['name'];
        }

        if (!empty($post['address'])) {
            $like['properties.address'] = $post['address'];
        }
        /*if (!empty($post['bhk'])) {
            $filters['properties.bhk'] = $post['bhk'];
        }*/
        // If specific BHK selected
      $or_like = [];  // group OR conditions here

        if (!empty($post['bhk'])) {
            $bhk = $post['bhk'];
            $keyword = $bhk . 'BHK';

            $or_like[] = ['column' => 'properties.bhk', 'value' => $bhk, 'type' => 'where'];
            $or_like[] = ['column' => 'properties.name', 'value' => $keyword, 'type' => 'like'];
        }
        if (!empty($post['type'])) {
            $like['properties.type'] = $post['type'];
        }
       if (!empty($post['property_for'])) {
            $like['properties.property_for'] = $post['property_for'];
        }
       if (!empty($post['min_budget'])) {
            $filters['properties.budget >='] = (int) $post['min_budget'];
        }

        if (!empty($post['max_budget'])) {
            $filters['properties.budget <='] = (int) $post['max_budget'];
        }
        /*if (!empty($post['services'])) {
            $filters['properties.services'] = $post['services'];
        }
        if (!empty($post['description'])) {
            $like['properties.description'] = $post['description'];
        }*/
    }

    // Build full query manually to allow LEFT JOIN
    $this->db->select('properties.*, properties_clone.main_site, properties_clone.property_url');
    $this->db->from('properties');
    $this->db->join('properties_clone', 'properties.clone_id = properties_clone.id', 'left');

    // Apply filters
    if (!empty($filters)) {
        foreach ($filters as $key => $value) {
            $this->db->where($key, $value);
        }
    }

    // Apply like conditions
    if (!empty($like)) {
        foreach ($like as $key => $value) {
            $this->db->like($key, $value);
        }
    }

    $this->db->order_by('properties.id', 'desc');

    $query = $this->db->get();
    $data['properties'] = $query->result();

    $data['mainContent'] = 'siteAdmin/properties';
    $this->load->view('includes/admin/template', $data);
}

  public function updateStatus(){
      
            $id = $this->input->post('list_id');
	        $updateData = array(
				'status'=> $this->input->post('status')
				
			);
			$result = $this->AdminModel->updateTable($id,'id','properties',$updateData);

 } 
 
public function updateBulkStatus() {
    $ids_string = $this->input->post('property_ids');
    $status = $this->input->post('status');

    if (!empty($ids_string)) {
        $ids = explode(',', $ids_string);
        $this->AdminModel->updatePropertyStatusBulk($ids, $status);
        echo 'success';
    } else {
        echo 'error';
    }
}


   public function updateApprovel() {
      
            $id = $this->input->post('list_id');
	        $updateData = array(
				'approvel'=> $this->input->post('approvel')
			);
			$result = $this->AdminModel->updateTable($id,'id','properties',$updateData);

 } 
 
public function addProperties() {
    $data['title'] = 'Add Property';
    $data['projects'] = $this->AdminModel->getProjects();

    $sessionLogin = $this->session->userdata('adminLogged');
    if (!($sessionLogin)) {
        redirect(base_url('site-admin'));
    }

    if ($this->input->post('save')) {
        $this->form_validation->set_rules('rName', 'property name','trim|required|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('property_for', 'property for','trim|required|min_length[1]|max_length[30]');
        $this->form_validation->set_rules('type', 'type','trim|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('property_builder', 'property builder','trim|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('built', 'built','trim|numeric');
        $this->form_validation->set_rules('land', 'land','trim|numeric');
        $this->form_validation->set_rules('carpet', 'carpet','trim|numeric');
        $this->form_validation->set_rules('project_n', 'project n');
        $this->form_validation->set_rules('budget', 'budget','trim|numeric');
        $this->form_validation->set_rules('budget in Words', 'budget In Words','trim');
        $this->form_validation->set_rules('additional', 'additional','trim|max_length[250]');
        $this->form_validation->set_rules('address', 'property address','trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('state', 'state','trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('city', 'city','trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('zip_code', 'zip code','trim|max_length[40]');
        $this->form_validation->set_rules('property_type', 'property type','trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('pName', 'person name','trim');
        $this->form_validation->set_rules('pPhone', 'person phone','trim');
        $this->form_validation->set_rules('pAddress', 'person address','trim');
        $this->form_validation->set_rules('bathrooms', 'bathrooms','trim');
        $this->form_validation->set_rules('bedrooms', 'bedrooms','trim');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() != FALSE) {
            $amenities_value = $this->input->post('amenities');
            $amenities = is_array($amenities_value) ? implode('~-~', $amenities_value) : '';

            $image = $imageTwo = $imageThree = $imageFour = $icon = '';

            $config['upload_path'] = FCPATH.'assets/properties/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = date('YmdHis').rand(10,99);

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadImg = $this->upload->data();
                $image = $uploadImg['file_name'];
            }
            if ($this->upload->do_upload('image2')) {
                $uploadImg = $this->upload->data();
                $imageTwo = $uploadImg['file_name'];
            }
            if ($this->upload->do_upload('image3')) {
                $uploadImg = $this->upload->data();
                $imageThree = $uploadImg['file_name'];
            }
            if ($this->upload->do_upload('image4')) {
                $uploadImg = $this->upload->data();
                $imageFour = $uploadImg['file_name'];
            }
            if ($this->upload->do_upload('icon')) {
                $uploadImg = $this->upload->data();
                $icon = $uploadImg['file_name'];
            }

            $approvel = '';
            if (stristr($this->session->userdata('role'), 'Agent')) {
                $approvel = 'not approvel';
            }

            $insertData = array(
                'userid'            => $this->session->userdata('id'),
                'name'              => $this->input->post('rName'),
                'property_builder'  => $this->input->post('property_builder'),
                'property_type'     => $this->input->post('property_type'),
                'type'              => $this->input->post('type'),
                'bhk'               => $this->input->post('BHK'),
                'property_for'      => $this->input->post('property_for'),
                'project_n'         => $this->input->post('project_n'),
                'built'             => $this->input->post('built'),
                'land'              => $this->input->post('land'),
                'carpet'            => $this->input->post('carpet'),
                'additional'        => $this->input->post('additional'),
                'additional_value'  => $this->input->post('custom_value'),
                'address'           => $this->input->post('address'),
                'city'              => $this->input->post('city'),
                'state'             => $this->input->post('state'),
                'services'          => $this->input->post('service'),
                'status'            => 'deactive',
                'approvel'          => $approvel,
                'zip_code'          => $this->input->post('zip_code'),
                'budget'            => $this->input->post('budget'),
                'budget_in_words'   => $this->input->post('budget_in_words'),
                'description'       => $this->input->post('note'),
                'person'            => $this->input->post('pName'),
                'phone'             => $this->input->post('pPhone'),
                'person_address'    => $this->input->post('pAddress'),
                'bathrooms'         => $this->input->post('bathrooms'),
                'bedrooms'          => $this->input->post('bedrooms'),
                'sqft'              => '',
                'image_one'         => $image,
                'image_two'         => $imageTwo,
                'image_three'       => $imageThree,
                'image_four'        => $imageFour,
                'icon'              => $icon,
                'amenities'         => $amenities
            );

            $result = $this->AdminModel->addDataInTable($insertData, 'properties');
            if ($result) {
                $last_id = $this->db->insert_id();

                // CITY CODE Matching
                $city = strtolower(trim($this->input->post('city')));
                $cityCode = '';
                switch ($city) {
                    case 'chandigarh': $cityCode = 'CH'; break;
                    case 'punjab':     $cityCode = 'PB'; break;
                    case 'panchkula':  $cityCode = 'PA'; break;
                    case 'mohali':     $cityCode = 'MO'; break;
                    case 'kharar':     $cityCode = 'KH'; break;
                    case 'pinjor':     $cityCode = 'PJ'; break;
                    case 'zirakpur':   $cityCode = 'ZP'; break;
                    default:           $cityCode = '';  break;
                }

                // Lead source code logic
                $lead_source = strtolower($this->input->post('main_site'));
                if (strpos($lead_source, '99') !== false) {
                    $leadCode = '99';
                } elseif (strpos($lead_source, 'magic') !== false) {
                    $leadCode = 'MG';
                } else {
                    $leadCode = 'BP';
                }

                // Property ID creation only if city code is matched
                $new_property_id = ($cityCode != '') ? ($cityCode . $leadCode . $last_id) : '';

                if ($new_property_id != '') {
                    $this->db->where('id', $last_id);
                    $this->db->update('properties', ['new_properties_id' => $new_property_id]);
                }

                $this->session->set_flashdata('message', 'Properties added successfully.');
                redirect(base_url('admin/properties/add'));
            }
        }
    }

    $data['mainContent'] = 'siteAdmin/propertiesAdd';
    $this->load->view('includes/admin/template', $data);
}


public function editProperties() {
    $data['title'] = 'Property Edit'; 
    $data['projects'] = $this->AdminModel->getProjects();
 
    $id = $this->uri->segment('4');
    $data['properties'] = $this->AdminModel->getDataFromTableByField($id, 'properties', 'id');
    $clone_id = $data['properties'][0]->clone_id;

    if ($clone_id != 0) {
        $data['clone_data'] = $this->AdminModel->getCloneData($clone_id);
    } else {
        $data['clone_data'] = null;
    }

    $role = $this->session->userdata('role');
    if ($data['properties'] && stristr($role, 'Agent')) {
        if ($data['properties'][0]->userid != $this->session->userdata('id')) {
            redirect(base_url('admin/dashboard'));
        }
    }

    if ($this->input->post('save')) {
        $this->form_validation->set_rules('rName', 'property name', 'trim|required|min_length[3]|max_length[250]');
        $this->form_validation->set_rules('property_for', 'property for', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('built', 'built', 'trim|numeric');
        $this->form_validation->set_rules('property_builder', 'property_builder', 'trim|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('land', 'land', 'trim|numeric');
        $this->form_validation->set_rules('carpet', 'carpet', 'trim|numeric');
        $this->form_validation->set_rules('budget', 'budget', 'trim|required|numeric');
        $this->form_validation->set_rules('budget In Words', 'budget in Words', 'trim');
        $this->form_validation->set_rules('project_n', 'project n');
        $this->form_validation->set_rules('address', 'property address', 'trim|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('state', 'state', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('city', 'city', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('zip_code', 'zip code', 'trim|max_length[40]');
        $this->form_validation->set_rules('property_type', 'property type', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('type', 'type', 'trim|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('pName', 'person name', 'trim');
        $this->form_validation->set_rules('pPhone', 'person phone', 'trim');
        $this->form_validation->set_rules('pAddress', 'person address', 'trim');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() != FALSE) {
            $additionalsLabel = $this->input->post('additional');
            $additionaln_label = ($additionalsLabel) ? implode('~~--~~', $additionalsLabel) : "";

            $additionals_value = $this->input->post('custom_value'); 
            $additional_value = ($additionals_value) ? implode('~~--~~', $additionals_value) : "";

            $amenities_value = $this->input->post('amenities'); 
            $amenities = ($amenities_value) ? implode('~-~', $amenities_value) : "";

            $verified_value = $this->input->post('verified'); 
            $verified = ($verified_value) ? implode('~-~', $verified_value) : "";

            $image = $this->input->post('imageOld');
            $imageTwo = $this->input->post('imageOldTwo');
            $imageThree = $this->input->post('imageOldThree');
            $imageFour = $this->input->post('imageOldFour');
            $icon = $this->input->post('icon');

            $config['upload_path'] = FCPATH.'assets/properties/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = date('YmdHis').rand(10,99);
            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                if ($image != '' && is_file(FCPATH.'assets/properties/'.$image)) {
                    unlink(FCPATH.'assets/properties/'.$image);
                }
                $uploadImg = $this->upload->data();
                $image = $uploadImg['file_name'];
            }

            if ($this->upload->do_upload('image2')) {
                if ($imageTwo != '' && is_file(FCPATH.'assets/properties/'.$imageTwo)) {
                    unlink(FCPATH.'assets/properties/'.$imageTwo);
                }
                $uploadImg = $this->upload->data();
                $imageTwo = $uploadImg['file_name'];
            }

            if ($this->upload->do_upload('image3')) {
                if ($imageThree != '' && is_file(FCPATH.'assets/properties/'.$imageThree)) {
                    unlink(FCPATH.'assets/properties/'.$imageThree);
                }
                $uploadImg = $this->upload->data();
                $imageThree = $uploadImg['file_name'];
            }

            if ($this->upload->do_upload('image4')) {
                if ($imageFour != '' && is_file(FCPATH.'assets/properties/'.$imageFour)) {
                    unlink(FCPATH.'assets/properties/'.$imageFour);
                }
                $uploadImg = $this->upload->data();
                $imageFour = $uploadImg['file_name'];
            }

            if ($this->upload->do_upload('icon')) {
                if ($icon != '' && is_file(FCPATH.'assets/properties/'.$icon)) {
                    unlink(FCPATH.'assets/properties/'.$icon);
                }
                $uploadImg = $this->upload->data();
                $icon = $uploadImg['file_name'];
            }

            // ----------- new_properties_id Generate ----------
           // City Code
}
$city_name = strtolower(trim($this->input->post('city')));
$city_code = '';
switch ($city_name) {
    case 'chandigarh': $city_code = 'CH'; break;
    case 'punjab':     $city_code = 'PB'; break;
    case 'panchkula':  $city_code = 'PA'; break;
    case 'mohali':     $city_code = 'MO'; break;
    case 'kharar':     $city_code = 'KH'; break;
    case 'pinjor':     $city_code = 'PJ'; break;
    case 'zirakpur':   $city_code = 'ZP'; break;
    default:           $city_code = '';   break;
}

$source_raw = strtolower($data['properties'][0]->main_site ?? '');
if (strpos($source_raw, '99acres') !== false) {
    $source_code = '99';
} elseif (strpos($source_raw, 'magicbricks') !== false) {
    $source_code = 'MG';
} else {
    $source_code = 'BP';
}

$new_properties_id = $city_code . $source_code . $id;


            // --------------------------------------------------

            $updateData = array(
                'name'=> $this->input->post('rName'),
                'property_for'=> $this->input->post('property_for'),
                'built'=> $this->input->post('built'),
                'land'=> $this->input->post('land'),
                'carpet'=> $this->input->post('carpet'),
                'additional'=> $additionaln_label,
                'additional_value'=> $additional_value,
                'address'=> $this->input->post('address'),
                'property_builder'=> $this->input->post('property_builder'),
                'city'=> $this->input->post('city'),
                'state'=> $this->input->post('state'),
                'services'=> $this->input->post('servicess'),
                'project_n' => $this->input->post('project_n'),
                'zip_code'=> $this->input->post('zip_code'),
                'property_type'=> $this->input->post('property_type'),	
                'bhk'=> $this->input->post('BHK'),	
                'type'=> $this->input->post('type'),
                'budget'=> $this->input->post('budget'),
                'budget_in_words'=> $this->input->post('budget_in_words'),
                'description'=> $this->input->post('note'),
                'person'=> $this->input->post('pName'),
                'phone'=> $this->input->post('pPhone'),
                'hot_deals'=>$this->input->post('hot_deals'),
                'status'=>$this->input->post('status'),
                'person_address'=> $this->input->post('pAddress'),
                'show_in_slider'=>$this->input->post('show_in_slider'),
                'show_in_gallery'=>$this->input->post('show_in_gallery'),
                'bathrooms'=>$this->input->post('bathrooms'),
                'bedrooms'=>$this->input->post('bedrooms'),
                'sqft'=>$this->input->post('area_in_sq_ft'),
                'measureUnit'=>$this->input->post('unit'),
                'verified'=>$verified,
                'image_one'=> $image,
                'image_two'=> $imageTwo,
                'image_three'=> $imageThree,
                'image_four'=> $imageFour,
                'icon'=> $icon,
                'amenities'=> $amenities
               
            );
          if (!empty($city_code)) {
    $updateData['new_properties_id'] = $new_properties_id;
}
            $result = $this->AdminModel->updateTable($id, 'id', 'properties', $updateData);
            if ($result) {
                $this->session->set_flashdata('message', 'Property updated successfully.');
                redirect(base_url('admin/properties/edit').'/'.$id);
            }
        }
    

    $data['mainContent'] = 'siteAdmin/propertiesEdit'; 
    $this->load->view('includes/admin/template', $data);
}



public function export_page()
{
    $role = $this->session->userdata('role');
    if (!check_permission($role, 'contact')) {
    redirect(base_url('admin/dashboard'));
}

    $data['title'] = 'Export Properties Data';
    $data['mainContent'] = 'siteAdmin/export_form'; // View path: views/siteAdmin/export_form.php
    $this->load->view('includes/admin/template', $data);
}

public function export_data()
{
    $role = $this->session->userdata('role');
    if (!check_permission($role, 'contact')) {
        redirect(base_url('admin/dashboard'));
    }

    $table = $this->input->post('table_name');
    $from = $this->input->post('from_date');
    $to = $this->input->post('to_date');

    // Validate inputs
    if (empty($table) || empty($from) || empty($to)) {
        $this->session->set_flashdata('message', 'All fields are required.');
        redirect('admin/properties/export_page');
    }

    // Check valid table
    $allowed_tables = ['properties', 'properties_clone'];
    if (!in_array($table, $allowed_tables)) {
        $this->session->set_flashdata('message', 'Invalid table selected.');
        redirect('admin/properties/export_page');
    }

    // Fetch records
    $this->load->dbutil();
    $this->db->from($table);

    // Apply date filter based on table name
    if ($table === 'properties') {
        $this->db->where('DATE(created_at) >=', $from);
        $this->db->where('DATE(created_at) <=', $to);
    } else { // properties_clone
        $this->db->where('DATE(created_at) >=', $from);
        $this->db->where('DATE(created_at) <=', $to);
    }

    $query = $this->db->get();

    if ($query->num_rows() == 0) {
        $this->session->set_flashdata('message', 'No data found for the selected date range.');
        redirect('admin/properties/export_page');
    }

    // Create CSV
    $delimiter = ",";
    $newline = "\r\n";
    $filename = "{$table}_export_" . date('Ymd_His') . ".csv";
    $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline);

    // Download helper
    $this->load->helper('download');
    force_download($filename, $csv_data);
}

public function import_page()
{
    $data['title'] = 'Import Properties Data';
    $data['mainContent'] = 'siteAdmin/import_form';  // same folder as export_form.php
    $this->load->view('includes/admin/template', $data);
}

public function import_data()
{
    $table = $this->input->post('table_name');

    $allowed_tables = ['properties', 'properties_clone'];
    if (empty($table) || !in_array($table, $allowed_tables)) {
        $this->session->set_flashdata('message', 'Please select a valid table.');
        redirect('admin/properties/import_page');
        return;
    }

    if (empty($_FILES['import_file']['name'])) {
        $this->session->set_flashdata('message', 'Please select a CSV file to upload.');
        redirect('admin/properties/import_page');
        return;
    }

    $file = $_FILES['import_file']['tmp_name'];
    $handle = fopen($file, 'r');

    if ($handle === false) {
        $this->session->set_flashdata('message', 'Unable to read uploaded file.');
        redirect('admin/properties/import_page');
        return;
    }

    // Get table columns from database
    $table_columns = array_column($this->db->list_fields($table), ''); // Or simply:
    $table_columns = $this->db->list_fields($table);  // list_fields returns an array of column names

    // Read headers
    $headers = fgetcsv($handle);
    if (!$headers) {
        $this->session->set_flashdata('message', 'Invalid CSV file.');
        redirect('admin/properties/import_page');
        return;
    }

    $headers = array_map('trim', $headers);
    $headers = array_map('strtolower', $headers); // Normalize header names

    $rowCount = 0;
    while (($data = fgetcsv($handle)) !== false) {
        $row = [];
        foreach ($headers as $index => $field) {
            $value = isset($data[$index]) ? $data[$index] : null;

            // Only add the field if it exists in DB table columns
            if (in_array($field, $table_columns)) {
                $row[$field] = $value;
            }
        }

        if (!empty($row)) {
            $this->db->replace($table, $row);
            $rowCount++;
        }
    }

    fclose($handle);

    $this->session->set_flashdata('message', "CSV Import successful. Imported $rowCount rows.");
    redirect('admin/properties/import_page');
}


 public function deleteProperties(){
     $role = $this->session->userdata('role');
    if (!check_permission($role, 'contact')) {
    redirect(base_url('admin/dashboard'));
}
        $id = $this->uri->segment('4');
    $role = $this->session->userdata('role');
    $properties = $this->AdminModel->getDataFromTableByField($id,'properties','id');
	if($properties && $role == 'Agent'){
	    if($properties[0]->userid != $this->session->userdata('id')) { redirect(base_url('admin/dashboard')); }
	}
	
 
        $result =  $this->AdminModel->deleteRow($id,'properties','id');
        if($result){
            $this->session->set_flashdata('message','Property deleted successfully.');
        } else {
            $this->session->set_flashdata('message','property not delete please try again.');
        }
        redirect(base_url('admin/properties'));
 }
 public function contact() {
     $role = $this->session->userdata('role');
    if (!check_permission($role, 'contact')) {
    redirect(base_url('admin/dashboard'));
}
    $data['title'] = 'Contact Us'; 
  
	$data['contacts'] = $this->AdminModel->getDataFromTable('contact','fname,subject,email,phone,message,property_url');
	$data['mainContent'] = 'siteAdmin/contactUs'; 
    $this->load->view('includes/admin/template', $data);
 }
public function approve() {
    $role = $this->session->userdata('role');
    if (!check_permission($role, 'contact')) {
    redirect(base_url('admin/dashboard'));
}

    $data['title'] = 'Properties Approval';
    
    // Condition to fetch only properties with 'not approved' status
    $where = array('id >' => '1', 'approvel' => 'not approvel');
    
    // If the user role is 'Agent', filter by userid
    if(stristr($this->session->userdata('role'), 'Agent')) { 
        $where['userid'] = $this->session->userdata('id'); 
    }

    // Fetch properties based on the conditions
    $data['properties'] = $this->AdminModel->getDataByMultipleColumns(
        $where,
        'properties',
        '*',
        $orderBy = 'id',
        $orderByValue = 'desc'
    );
    
    // Load the view
    $data['mainContent'] = 'siteAdmin/propertiesApproval';
    $this->load->view('includes/admin/template', $data);
}

}
?>