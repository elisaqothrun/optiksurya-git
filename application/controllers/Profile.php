<?php

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Profile extends REST_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->model('profile_model');
	}
	public function readdetail_post()
	{
		$id_pelanggan 		= $this->input->post('id_pelanggan');
		$response			= $this->profile_model->read($id_pelanggan);
	    echo json_encode($response);
	}
	public function edit_post()
	{
		$id_pelanggan 		= $this->input->post('id_pelanggan');
		$nama_pelanggan     = $this->input->post('nama_pelanggan');
		$alamat 			= $this->input->post('alamat');
		$telepon 			= $this->input->post('telepon');
	    $data 				= $this->profile_model->edit_profile($id_pelanggan, $nama_pelanggan, $alamat, $telepon);
        echo json_encode($data);
	}


}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */