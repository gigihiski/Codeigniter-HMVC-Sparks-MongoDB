<?php

if(!function_exists('get_id')) {
	function get_id($array){
		if(isset($array->_id)){
			foreach($array->_id as $key => $value){}
			return $value;
		}else{
			foreach($array as $key => $value){}
			if(isset($value)){
				return $value;
			}
			return false;
		}
		
		return false;
	}
}

if(!function_exists('encrypt_string')) {
	function encrypt_string($string = ''){
		$ci =& get_instance();
		$ci->load->library('encryption');
		return $ci->encryption->encrypt($string);
	}
}

if(!function_exists('decrypt_string')) {
	function decrypt_string($string = ''){
		$ci =& get_instance();
		$ci->load->library('encryption');
		return $ci->encryption->decrypt($string);
		
	}
}

if(!function_exists('report_status')) {
	function report_status($report_status = ''){
		$ci =& get_instance();
		switch($report_status){
			case 0 : return "Unread"; break;
			case 1 : return "Read"; break;
			case 2 : return "On Progress"; break;
			case 3 : return "Solved"; break;
			default : return "Unread";
		}
	}
}

if(!function_exists('time_passed')) {
	function time_passed($timestamp){
	    //type cast, current time, difference in timestamps
	    $timestamp      = (int) $timestamp;
	    $current_time   = time();
	    $diff           = $current_time - $timestamp;
    
	    //intervals in seconds
	    $intervals      = array (
	        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
	    );
    
	    //now we just find the difference
	    if ($diff == 0)
	    {
	        return 'just now';
	    }    

	    if ($diff < 60)
	    {
	        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
	    }        

	    if ($diff >= 60 && $diff < $intervals['hour'])
	    {
	        $diff = floor($diff/$intervals['minute']);
	        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
	    }        

	    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
	    {
	        $diff = floor($diff/$intervals['hour']);
	        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
	    }    

	    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
	    {
	        $diff = floor($diff/$intervals['day']);
	        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
	    }    

	    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
	    {
	        $diff = floor($diff/$intervals['week']);
	        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
	    }    

	    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
	    {
	        $diff = floor($diff/$intervals['month']);
	        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
	    }    

	    if ($diff >= $intervals['year'])
	    {
	        $diff = floor($diff/$intervals['year']);
	        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
	    }
	}
}
