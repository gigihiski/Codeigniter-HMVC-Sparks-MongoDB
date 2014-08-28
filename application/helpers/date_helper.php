<?php

if(!function_exists('date_to_time')) {
	function date_to_time($date = ''){
		return strtotime($date);
	}
}

if(!function_exists('get_age')) {
	function get_age($time = ''){
		if(!empty($time)){
			$diff = (time() - $time);
			return floor($diff / (60 * 60 * 24 * 365));
		}
		return false;
	}
}
