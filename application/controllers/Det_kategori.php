<?php
require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;
 /**
 * 
 */
 class Det_kategori extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('det_kategori_model');
	}
	public function det_kategori_get()
	{
		$id_kategori	=$this->input->get('id_kategori');
		$response		=$this->det_kategori_model->detail($id_kategori);
		echo json_encode($response);
	}

}

/* End of file Det_kategori.php */
/* Location: ./application/controllers/Det_kategori.php */