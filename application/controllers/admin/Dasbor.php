<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	//load model
	public function __construct()
	{
		parent::__construct();
		//proteksi halaman
		$this->simple_login->cek_login();

		//load model
		$this->load->model('grafik_model');
		$this->load->model('transaksi_model');
	}
	// halaman dashboard
	public function index()
	{
	
      $data2 = $this->grafik_model->get_data()->result();
      $x['data'] = json_encode($data2);
					
		$data = array(	'title' 		=> 'Halaman Admin | Grafik Stok',
						'jml_transaksi' => $this->transaksi_model->total_rows(),
						'isi' 			=> 'admin/dasbor/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		$this->load->view('admin/dasbor/Grafik_view',$x);

		
	}
	

}

