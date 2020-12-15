<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');

		//proteksi
		$this->simple_login->cek_login();

	}

	public function index()
	{
		$produk = $this->produk_model->listing();
		$data = array(	'title' 	=> 'Data Produk',
						'produk'	=>  $produk,
						'isi'		=> 'admin/produk/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function gambar($id_produk)
	{
		$produk = $this->produk_model->detail($id_produk);
		$gambar = $this->produk_model->gambar($id_produk);
		$valid 	= $this->form_validation;

		$valid->set_rules('judul_gambar', 'Nama Gambar', 'required',
			array( 'required'	=> '%s harus diisi'));

		if ($valid->run()) {
			
			$config['upload_path'] 		= './assets/upload/images/thumbs';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '2400';
			$config['max_width'] 		= '2024';
			$config['max_height']  		= '2024';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){	

				// end validasi
		$data = array(	'title' 	=> 'Tambah Gambar Produk: '.$produk->nama_produk,
						'produk'	=> $produk,
						'gambar'	=> $gambar,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/gambar'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			//create tumbhnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/images/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/uploas/images/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail
			$i= $this->input;
			
			$data= array(	'id_produk'		=> $id_produk,
							'judul_gambar'	=> $i->post('judul_gambar'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							);
			$this->produk_model->tambah_gambar($data);
			$this->session->set_flashdata('sukses', 'Gambar Telah ditambahkan');
			redirect(base_url('admin/produk/gambar/'.$id_produk),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Tambah Gambar Produk: '.$produk->nama_produk,
						'produk'	=> $produk,
						'gambar'	=> $gambar,
						'isi'		=> 'admin/produk/gambar'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	// tambah produk
	public function tambah()
	{
		//ambil data kategori
		$kategori = $this->kategori_model->listing();
		// validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_produk', 'Nama Produk', 'required',
			array( 'required'	=> '%s harus diisi'));
		$valid->set_rules('kd_produk', 'Kode Produk', 'required|is_unique[produk.kd_produk]',
			array( 'required'	=> '%s harus diisi',
					'is_unique'	=> '%s sudah ada. Buat kode produk baru'));

		if ($valid->run()) {
			
			$config['upload_path'] 		= './assets/upload/images/thumbs';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '2400';
			$config['max_width'] 		= '2024';
			$config['max_height']  		= '2024';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){	

				// end validasi
		$data = array(	'title' 	=> 'Tambah Produk',
						'kategori'	=> $kategori,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			//create tumbhnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/images/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/images/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail
			$i= $this->input;
			// slug produk
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kd_produk'), 'dash', TRUE);

			$data= array(	'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kd_produk' 	=> $i->post('kd_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk' 	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							'harga' 		=> $i->post('harga'),
							'stok' 			=> $i->post('stok'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'berat' 		=> $i->post('berat'),
							'status_produk' => $i->post('status_produk'),
							'tgl_post' 		=> date('Y-m-d H:i:s')
							);
			$this->produk_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			redirect(base_url('admin/produk'),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Tambah Produk',
						'kategori'	=> $kategori,
						'isi'		=> 'admin/produk/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	// edit
	public function edit($id_produk)
	{
		//ambil data produk yang akan diedut
		$produk = $this->produk_model->detail($id_produk);
		//ambil data kategori
		$kategori = $this->kategori_model->listing();	
		//fomr validasi
		$valid = $this->form_validation;

		$valid->set_rules('nama_produk', 'Nama Produk', 'required',
			array( 'required'	=> '%s harus diisi'));
		$valid->set_rules('kd_produk', 'Kode Produk', 'required',
			array( 'required'	=> '%s harus diisi'));

		if ($valid->run()) {
			//cek jika gambar diganti
			if(!empty($_FILES['gambar']['name'])){
			$config['upload_path'] 		= './assets/upload/images/thumbs';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  		= '2400';
			$config['max_width'] 		= '2024';
			$config['max_height']  		= '2024';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){	

				// end validasi
		$data = array(	'title' 	=> 'Edit Produk: '.$produk->nama_produk,
						'kategori'	=> $kategori,
						'produk'	=> $produk,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/produk/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			//create tumbhnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/images/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/images/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail
			$i= $this->input;
			// slug produk
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kd_produk'), 'dash', TRUE);

			$data= array(	'id_produk'		=> $id_produk,
							'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kd_produk' 	=> $i->post('kd_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk' 	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							'harga' 		=> $i->post('harga'),
							'stok' 			=> $i->post('stok'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'berat' 		=> $i->post('berat'),
							'status_produk' => $i->post('status_produk'),
							'tgl_post' 		=> date('Y-m-d H:i:s')
							);
			$this->produk_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			redirect(base_url('admin/produk'),'refresh');

		}}else{
			//edt produk tanpa ganti gambar
			$i= $this->input;
			// slug produk
			$slug_produk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kd_produk'), 'dash', TRUE);

			$data= array(	'id_produk'		=> $id_produk,
							'id_user'		=> $this->session->userdata('id_user'),
							'id_kategori'	=> $i->post('id_kategori'),
							'kd_produk' 	=> $i->post('kd_produk'),
							'nama_produk' 	=> $i->post('nama_produk'),
							'slug_produk' 	=> $slug_produk,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							'harga' 		=> $i->post('harga'),
							'stok' 			=> $i->post('stok'),
							//disimpan nama file gmbarnya tidak diganti
							// 'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'berat' 		=> $i->post('berat'),
							'status_produk' => $i->post('status_produk'),
							'tgl_post' 		=> date('Y-m-d H:i:s')
							);
			$this->produk_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			redirect(base_url('admin/produk'),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Edit Produk :'.$produk->nama_produk,
						'kategori'	=> $kategori,
						'produk'	=> $produk,
						'isi'		=> 'admin/produk/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);	
	}
	public function delete($id_produk)
	{
		//hapus gambar
		$produk = $this->produk_model->detail($id_produk);
		unlink('./assets/upload/images/thumbs/'.$produk->gambar);
		//end hapus gambar
		$data = array('id_produk'	=> $id_produk);
		$this->produk_model->delete($data);
		$this->session->set_flashdata('Sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/produk'), 'refresh');

	}
	public function delete_gambar($id_produk,$id_gambar)
	{
		//hapus gambar
		$gambar = $this->produk_model->detail_gambar($id_gambar);
		unlink('./assets/upload/images/'.$gambar->gambar);
		unlink('./assets/upload/images/thumbs/'.$gambar->gambar);
		//end hapus gambar
		$data = array('id_gambar'	=> $id_gambar);
		$this->produk_model->delete_gambar($data);
		$this->session->set_flashdata('sukses', 'Data Gambar Berhasil Dihapus');
		redirect(base_url('admin/produk/gambar/'.$id_produk), 'refresh');

	}

}
