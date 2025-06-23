<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cleanEachSpecialCharacter')){
	function cleanEachSpecialCharacter($value){
		$return = str_replace(array('<','>','!','$','^','*','=','|',';','%','?','{','}',"'",'(',')','"'),'',$value);
		//$return = str_replace(array("'",'(',')','"'),'',$return); 
		$return = str_replace('--','-',$return);
		$return = str_replace('&&','&',$return);
		$return = trim($return);
		return $return;
	}
}

    function checkForMalware($string,$length='110'){
		$string = trim($string);
		if($string == '') { return $string; }
		
		$malwareArray = array('000S1sC',' SELECT ','select/*','UNION/**/ALL/**/SELECT','UNION ALL SELECT',' ISNULL ',',CONCAT ',' CONCAT ','JSON_KEYS','database','PG_SLEEP',' CASE ','expr ','exec ',' cmd ','bxss.me','gethostbyname','nslookup','base64','decode64', 'waitfor delay', 'shell_exec','select sleep','sleep(','response.write','syscolumns','exec cmd','<script','SYSMASTER','SYSPAGHDR','DBMS_PIPE','RECEIVE_MESSAGE','sysusers','GET_HOST_ADDRESS','INFORMATION_SCHEMA','#cmd','$cmd','.shell','cmd.exe','bin/bash','_memberAccess','ognlUtil','SYSTEM_USERS','whoami','r87.me','/php','ASCII(','VARCHAR(','../','/apache/','..%2F','execSync','alert(','ping -'); 
		$found = 'false';
		foreach($malwareArray as $val){
			if(stristr($string,$val)) { $found = 'true'; }
		}
		if(strlen($string) > $length) { $found = 'true'; }
		
		if($found == 'true') { $string = ''; }
		
		return $string;
	}
	
	function checkSpecialCharMalware($string,$length='110'){
	    $string = checkForMalware($string,$length);
	    $string = cleanEachSpecialCharacter($string);
	    return $string;
	}
	
	function getIpAddressHelper(){
		if (isset($_SERVER['HTTP_CLIENT_IP'])){ $ipaddress = $_SERVER['HTTP_CLIENT_IP']; } 
		elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']; } 
		elseif(isset($_SERVER['HTTP_X_FORWARDED'])){ $ipaddress = $_SERVER['HTTP_X_FORWARDED']; } 
		elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){ $ipaddress = $_SERVER['HTTP_FORWARDED_FOR']; } 
		elseif(isset($_SERVER['HTTP_FORWARDED'])){ $ipaddress = $_SERVER['HTTP_FORWARDED']; } 
		elseif(isset($_SERVER['REMOTE_ADDR'])){ $ipaddress = $_SERVER['REMOTE_ADDR']; } 
		else { $ipaddress = 'UNKNOWN'; }
		$ipaddress = preg_replace('/[^0-9.:]/', '', $ipaddress);
		$ipaddress = str_replace(array('<','>','!','^','*','=','|',';','?','{','}',"'",'(',')','"','+'),'',$ipaddress);
		return $ipaddress;
	}
?>