<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_user_details')){
   function get_user_details($user_id=''){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       //$ci->db->select('*');
       //$ci->db->from('category');
       $ci->db->where('parent',0);
       $query = $ci->db->get('category');
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result;
       }else{
           return false;
       }
   }
}
if ( ! function_exists('send_email')){
   function send_email($to,$subject,$message,$from){
        $ci =& get_instance();
        $ci->load->library('email');
        $ci->email->set_mailtype("html");
        $ci->email->set_newline("\r\n");
        $ci->email->from($from);
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($message);
 
   }
}
if ( ! function_exists('getMessageByKey')){
   function getMessageByKey($key){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $ci->db->select('value');
       $ci->db->from('messages');
       $ci->db->where('message_key',$key);
       $query = $ci->db->get();
       
       if($query->num_rows() > 0){
           $result = $query->result_array();
           return $result[0]['value'];
       }else{
           return false;
       }
   }
}
if ( ! function_exists('getProperties')){
   function getProperties(){
       //get main CodeIgniter object
       $ci =& get_instance();
       //load databse library
       $ci->load->database();
       //get data from database
       $ci->db->select('city');
       $ci->db->from('properties');
       $ci->db->group_by('city');
       $query = $ci->db->get();
       $result = $query->result();
       return $result;

   }
}

    function checkForMalware($string,$length='110'){
		$malwareArray = array('000S1sC',' SELECT ','UNION ALL SELECT',' ISNULL ',',CONCAT ',' CONCAT ','JSON_KEYS','database',' WHERE ',' PG_SLEEP ',' CASE ','expr ','exec ',' cmd ','bxss.me','gethostbyname','nslookup');
		$found = 'false';
		foreach($malwareArray as $val){
			if(stristr($string,$val)) {
				$found = 'true';
			}
		}
		if(strlen($string) > $length) { $found = 'true'; }
		
		if($found == 'true') { $string = ''; }
		
		return $string;
	}
    
    function removeAllSpecialCharcter($value){
        $return = preg_replace('/[^a-zA-Z0-9_\-&@% ]/', '', $value);
        $malwareArray = array('000S1sC',' SELECT ','UNION ALL SELECT',' ISNULL ',',CONCAT ',' CONCAT ','JSON_KEYS','database',' PG_SLEEP ',' CASE ','expr ','exec ',' cmd ','bxss.me','gethostbyname','nslookup');
        $return = str_replace($malwareArray,' ',$return);
        $return = str_replace('&&','&',$return);
        $return = str_replace('--','-',$return);
        $return = trim($return);
        return $return;
    }
	
	if ( ! function_exists('rentPropertyType')){
		function rentPropertyType() {
        $property_types = array(
            '1 BHK',
            '2 BHK',
            '3 BHK',
            '1 Room Only',
            '1 Room with Kitchen',
            '2 Rooms Only',
            '2 Rooms with Kitchen',
            'Boys PG',
            'Girls PG',
            'Annex House',
            'Other'
        );

        return $property_types;
		}	
	}
	
	if ( ! function_exists('propertyPropertyType')){
		function propertyPropertyType() {
        $property_types = array(
            'Industrial Property',
            'Factory',
            'Residential Property',
            'Bungalows / Villas',
            'Flats & Apartments',
            'Residential - Others',
            'Individual House/Home',
            'Residential Land / Plot',
            'Commercial Property',
            'Commercial Shops',
            'Commercial Lands & Plots',
            'Hotel & Restaurant'
        );

        return $property_types;
		}	
	}
	
	if (!function_exists('check_permission')) {
    function check_permission($role, $page_name) {
        $permissions = [
            'Admin' => [
                'dashboard',
                'properties',
                'projects',
                'whatsapp',
                'rent',
                'leads',
                'follow-up',
                'meetings',
                'customers',
                'contact',
                'category',
                'tag',
                'deal',
				'users',
				'logout',
            ],
            'Manager' => [
                'dashboard',
                'customers',
                'contact',
                'category',
                'tag',
            ],
            'Agent' => [
                'dashboard',
				'leads',
				 'properties',
				 'whatsapp',
				 'logout',
            ]
        ];

        // Sanitize inputs (just in case)
        $role = ucfirst(strtolower($role));
        $page_name = strtolower($page_name);

        // Check access
        if (isset($permissions[$role])) {
            return in_array($page_name, $permissions[$role]);
        }
        return false;
    }
	}


if (!function_exists('getroll')) {
    function getroll() {
        return [
            'Admin', 'Agent',  'Telecaller', 'Marketing Exec', 'CRM Executive', 'Documentation'
        ];
    }
}

?>
