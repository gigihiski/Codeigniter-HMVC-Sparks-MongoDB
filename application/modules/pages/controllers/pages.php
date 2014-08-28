<?php

class Pages extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->spark('vivliooSDK/1.0.0');
		$this->load->library('vivlioo');
	}
	
	public function index(){
		$this->load->view('pages/pages');
	}
}