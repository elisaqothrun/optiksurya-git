<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	//load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('berita_model');
	}
//halaman utama website untuk konsumen/homepage
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$kategori 	= $this->konfigurasi_model->nav_produk();
		$produk 	= $this->produk_model->home();	
		$berita 	= $this->berita_model->home();

		$data=array(	'title'		=> $site->namaweb. '|' .$site->tagline,
						'keyword'	=> $site->keyword,
						'deskripsi'	=> $site->deskripsi,
						'site'		=> $site,
						'kategori'	=> $kategori,
						'produk'	=> $produk,
						'berita'	=> $berita,
						'isi' 		=> 'home/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */