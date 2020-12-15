<?php

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Daftar extends REST_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_model');
		$this->load->helper('url');
	}
	public function daftar_post()
	{
		$nama_pelanggan =  $this->input->post('nama_pelanggan');
		$email 			=  $this->input->post('email');
		$password		=  $this->input->post('password');
		$alamat 		=  $this->input->post('alamat');
		$telepon		=  $this->input->post('telepon');

		$result     	= $this->daftar_model->daftar($nama_pelanggan, $email, $password, $alamat, $telepon);
        echo json_encode($result);
	}
}