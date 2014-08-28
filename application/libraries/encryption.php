<?php

class encryption {
	var $_salt = "G!g1hiSk1Pr4s3TyAw4N";
	var $_key;
	
	public function __construct() {
		$this->_key = $this->_salt;
	}
	
	public function setKey($key){
		$this->_key = $this->_salt.$key;
	}

	public function encrypt($string){
	     $mcrypt_iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	     $mcrypt_iv = mcrypt_create_iv($mcrypt_iv_size, MCRYPT_RAND);
	     $mcrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->_key, $string, MCRYPT_MODE_ECB, $mcrypt_iv);
	     $encoded = base64_encode($mcrypted);
	     return urlEncode($encoded);
	}

	public function decrypt($hash){
		$hash = urlDecode($hash);
	    $mcrypt_iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	    $mcrypt_iv = mcrypt_create_iv($mcrypt_iv_size, MCRYPT_RAND);
	    $basedecoded = base64_decode($hash);
	    $mcrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->_key, $basedecoded, MCRYPT_MODE_ECB, $mcrypt_iv);
	    return $mcrypted;
	}
	
	public function base64Encode($string){
		return base64_encode($string);
	}

	public function base64Decode($string){
		return base64_decode($string);
	}
}