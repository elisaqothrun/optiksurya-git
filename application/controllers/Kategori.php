<?php

require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
 /**
 * 
 */
 class Kategori extends REST_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('kat_model');
 		$this->load->helper('url');
 	}
 	public function kategori_get()
 	{
 		$response			= $this->kat_model->read();
	    echo json_encode($response);
 	}	
 }