<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('berita_model');
		//proteksi
		$this->simple_login->cek_login();

	}

	public function index()
	{
		$berita = $this->berita_model->listing();
		$data = array(	'title' 	=> 'Data Berita',
						'berita'	=>  $berita,
						'isi'		=> 'admin/berita/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function gambar($id_berita)
	{
		$berita = $this->berita_model->detail($id_berita);
		$gambar = $this->berita_model->gambar($id_berita);
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
		$data = array(	'title' 	=> 'Tambah Gambar Berita: '.$berita->jenis_berita,
						'berita'	=> $berita,
						'gambar'	=> $gambar,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/berita/gambar'
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
			
			$data= array(	'id_berita'		=> $id_berita,
							'judul_gambar'	=> $i->post('judul_gambar'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							);
			$this->berita_model->tambah_gambar($data);
			$this->session->set_flashdata('sukses', 'Gambar Telah ditambahkan');
			redirect(base_url('admin/berita/gambar/'.$id_berita),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Tambah Gambar Berita: '.$berita->jenis_berita,
						'berita'	=> $berita,
						'gambar'	=> $gambar,
						'isi'		=> 'admin/berita/gambar'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	// tambah berita
	public function tambah()
	{
	  // validasi input
		$valid = $this->form_validation;

		$valid->set_rules('jenis_berita', 'Nama Berita', 'required',
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
		$data = array(	'title' 	=> 'Tambah Berita',
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/berita/tambah'
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
			// slug berita
			$slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('tgl_update'), 'dash', TRUE);

			$data= array(	'id_user'		=> $this->session->userdata('id_user'),
							'jenis_berita' 	=> $i->post('jenis_berita'),
							'judul_berita' 	=> $i->post('judul_berita'),

							'slug_berita' 	=> $slug_berita,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'status_berita' => $i->post('status_berita'),
							'tgl_post' 		=> date('Y-m-d H:i:s'),
							'tgl_update'	=> date('Y-m-d H:i:s')

							);
			$this->berita_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			redirect(base_url('admin/berita'),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Tambah Berita',
						'isi'		=> 'admin/berita/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	// edit
	public function edit($id_berita)
	{
		//ambil data berita yang akan diedut
		$berita = $this->berita_model->detail($id_berita);	
		//fomr validasi
		$valid = $this->form_validation;

		$valid->set_rules('jenis_berita', 'Nama Berita', 'required',
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
		$data = array(	'title' 	=> 'Edit Berita: '.$berita->jenis_berita,
						'berita'	=> $berita,
						'error'		=> $this->upload->display_errors(),
						'isi'		=> 'admin/berita/edit'
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
			// slug berita
			$slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('judul_berita'), 'dash', TRUE);

			$data= array(	'id_berita'		=> $id_berita,
							'id_user'		=> $this->session->userdata('id_user'),
							'jenis_berita' 	=> $i->post('jenis_berita'),
							'slug_berita' 	=> $slug_berita,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							//disimpan nama file gmbarnya
							'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'status_berita' => $i->post('status_berita'),
							'tgl_post' 		=> date('Y-m-d H:i:s')
							);
			$this->berita_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			redirect(base_url('admin/berita'),'refresh');

		}}else{
			//edt berita tanpa ganti gambar
			$i= $this->input;
			// slug berita
			$slug_berita = url_title($this->input->post('jenis_berita').'-'.$this->input->post('judul_berita'), 'dash', TRUE);

			$data= array(	'id_berita'		=> $id_berita,
							'id_user'		=> $this->session->userdata('id_user'),
							'jenis_berita' 	=> $i->post('jenis_berita'),
							'judul_berita' 	=> $i->post('judul_berita'),

							'slug_berita' 	=> $slug_berita,
							'keterangan' 	=> $i->post('keterangan'),
							'keyword' 		=> $i->post('keyword'),
							//disimpan nama file gmbarnya tidak diganti
							// 'gambar' 		=> $upload_gambar['upload_data']['file_name'],
							'status_berita' => $i->post('status_berita'),
							'tgl_post' 		=> date('Y-m-d H:i:s')
							);
			$this->berita_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			redirect(base_url('admin/berita'),'refresh');

		}}
		// end masuk database
		$data = array(	'title' 	=> 'Edit Berita :'.$berita->jenis_berita,
						'berita'	=> $berita,
						'isi'		=> 'admin/berita/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);	
	}
	public function delete($id_berita)
	{
		//hapus gambar
		$berita = $this->berita_model->detail($id_berita);
		unlink('./assets/upload/images/thumbs/'.$berita->gambar);
		//end hapus gambar
		$data = array('id_berita'	=> $id_berita);
		$this->berita_model->delete($data);
		$this->session->set_flashdata('Sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/berita'), 'refresh');

	}
	public function delete_gambar($id_berita, $id_gambar)
	{
		//hapus gambar
		$gambar = $this->berita_model->detail_gambar($id_gambar);
		unlink('./assets/upload/images/thumbs/'.$gambar->gambar);
		//end hapus gambar
		$data = array('id_gambar'	=> $id_gambar);
		$this->berita_model->delete_gambar($data);
		$this->session->set_flashdata('Sukses', 'Data Gambar Berhasil Dihapus');
		redirect(base_url('admin/berita/gambar/'.$id_berita), 'refresh');

	}

}
