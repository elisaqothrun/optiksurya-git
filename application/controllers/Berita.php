<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

//load database
	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('berita_model');
	}

	public function index()
	{
		$site 				= $this->konfigurasi_model->listing();
		//ambil data total
		$total 				= $this->berita_model->total_berita();
		//pagination start
		$this->load->library('pagination');
		
		$config['base_url'] 		= base_url().'berita/index/';
		$config['total_rows']		= $total->total;
		$config['use_page_numbers']	= TRUE;
		$config['per_page'] 		= 3;
		$config['uri_segment'] 		= 3;
		$config['num_links'] 		= 5;
		$config['full_tag_open'] 	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_link'] 		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_link'] 		= 'Last';
		$config['last_tag_open'] 	= '<li class="disabled"><li class="active"><a href="#">';
		$config['last_tag_close'] 	= '<span class="sr-only"></a></li></li>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<div>';
		$config['next_tag_close'] 	= '</div>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<div>';
		$config['prev_tag_close'] 	= '</div>';
		$config['cur_tag_open'] 	= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$config['first_url']		= base_url().'/berita/';
		$this->pagination->initialize($config);
		//ambil data berita
		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0; 
		$berita = $this->berita_model->berita($config['per_page'],$page);
		//pagination end 

		$data = array(	'title' 			=> 'Berita '.$site->namaweb, 
						'site'				=> $site,
						'berita'			=> $berita,
						'pagin'				=> $this->pagination->create_links(),
					  	'isi'				=> 'berita/list'
					  );
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail berita
	public function detail($slug_berita)
	{
		$site 			= $this->konfigurasi_model->listing();
		$berita 		= $this->berita_model->read($slug_berita);
		$id_berita 		= $berita->id_berita;
		$berita_related = $this->berita_model->home();

		$data = array(	'title' 			=> $berita->judul_berita, 
						'site'				=> $site,
						'berita'			=> $berita,
						'berita_related'	=> $berita_related,
					  	'isi'				=> 'berita/detail'
					  );
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */