<?php

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api_login extends REST_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
	}
	public function login_post()
	{
		$email 		= $this->input->post('email');
        $password   = $this->input->post('password');
        $result     = $this->login_model->login($email, $password);
        echo json_encode($result);
	}

}