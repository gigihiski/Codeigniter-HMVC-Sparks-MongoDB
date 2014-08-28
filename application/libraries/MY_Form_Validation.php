<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	
	public function is_unique($str, $field) {
		$ci =& get_instance();
		if (substr_count($field, '.') == 3){
			list($table, $field, $id_field, $id_val) = explode('.', $field);
			
			$ci->mongo_db->clear();
			if($id_field == '_id'){
				$ci->mongo_db->where_not_in($id_field, array(new MongoID($id_val)));				
			}else{
				$ci->mongo_db->where_not_in($id_field, array($id_val));
			}
			
			$ci->mongo_db->where(array($field => $str));
			$result = $ci->mongo_db->get($table);
			
		} else {
			list($table, $field) = explode('.', $field);
			
			$ci->mongo_db->clear();
			$ci->mongo_db->where(array($field => $str));
			$result = $ci->mongo_db->get($table);
			
		}

		return count($result) === 0;
	}
	
	public function exists($str, $field) {
		$ci =& get_instance();
		if (substr_count($field, '.') == 3){
			list($table, $field, $id_field, $id_val) = explode('.', $field);
			
			$ci->mongo_db->clear();
			$ci->mongo_db->where_not($id_field, $id_val);
			$ci->mongo_db->where(array($field => $str));
			$result = $ci->mongo_db->get($table);
			
		} else {
			list($table, $field) = explode('.', $field);
			
			$ci->mongo_db->clear();
			$ci->mongo_db->where(array($field => $str));
			$result = $ci->mongo_db->get($table);
			
		}

		return count($result) !== 0;
	}
}
// END MY Form Validation Class

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */