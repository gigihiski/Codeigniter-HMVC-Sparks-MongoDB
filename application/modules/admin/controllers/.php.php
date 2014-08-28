<?php

class Country extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->spark(array('authentication/1.0.0', 'mongodb/1.0.0', 'template/1.0.0'));
		$this->load->model(array('admin/country_model'));
	}
	
	// Country Manager
	public function add(){
		if($this->form_validation->run('country') == FALSE){
			$data['main'] = "country/add";
			$this->load->view("admin/".getAdminTemplate()."/index", $data);
		}else{
			$data = array('name' => $this->input->post('name'),
						'status' => (int)$this->input->post('status'));

			$config['upload_path'] = './cdn/admin/country_contents/icons/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = true;
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$data['icon'] = "";
			if ($this->upload->do_upload('fileupload')){
				$image = $this->upload->data();
				$data['icon'] = $image['file_name'];

				$this->country_model->insert($data);
				$this->session->set_flashdata('success_message', 'Your profile setting have been updated!');
			}else{
				$this->country_model->insert($data);
				if(!empty($_FILES['fileupload']['name'])){
					$this->session->set_flashdata('error_message', $this->upload->display_errors());
				}
			}
			redirect('admin/country/manage');
		}
	}
	
	public function edit($country_id = ""){
		if($this->form_validation->run('country') == FALSE){
			$data['main'] = "country/edit";

			$data['country'] = array();
			$country = $this->country_model->find_by_id(new MongoID($country_id));
			if($country->is_true){
				$data['country'] = $country->row_result;
			}
		
			$this->load->view("admin/".getAdminTemplate()."/index", $data);
		}else{
			$data = array('name' => $this->input->post('name'),
						'status' => (int)$this->input->post('status'));
			
			$config['upload_path'] = './cdn/admin/country_contents/icons/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = true;
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('fileupload')){
				$image = $this->upload->data();
				$data['icon'] = $image['file_name'];

				$this->country_model->update($country_id, $data);
				$this->session->set_flashdata('success_message', 'Your profile setting have been updated!');
			}else{
				$this->country_model->update($country_id, $data);
				if(!empty($_FILES['fileupload']['name'])){
					$this->session->set_flashdata('error_message', $this->upload->display_errors());
					redirect('admin/country/edit/'.$country_id);
				}
			}
			redirect('admin/country/manage');
		}
	}
	
	public function remove($country_id = ""){
		$this->country_model->delete($country_id);
		redirect('admin/country/manage');
	}
	
	public function manage(){
		$data['main'] = "country/manage";

		$data['countries'] = array();
		$user = $this->country_model->all();
		if($user->is_true){
			$data['countries'] = $user->query_result;
		}
		
		$this->load->view("admin/".getAdminTemplate()."/index", $data);		
	}
}