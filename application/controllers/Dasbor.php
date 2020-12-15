<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {

	//load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
		//diproteksi dengan simple_pelanggan = cek login
		$this->simple_pelanggan->cek_login();
	}

	//halaman dasbor
	public function index()
	{
			//ambil data login id_pelanggan dari session
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$detail_transaksi = $this->detail_transaksi_model->pelanggan($id_pelanggan);
		$data = array('title'				=> 'Halaman Dashboard Pelanggan',
					   'detail_transaksi'	=> $detail_transaksi,
					   'isi'				=> 'dasbor/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	//belanja
	public function belanja()
	{
		//ambil data login id_pelanggan dari session
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$detail_transaksi = $this->detail_transaksi_model->pelanggan($id_pelanggan);

		$data = array('title'				=> 'Riwayat Belanja',
					  'detail_transaksi'	=> $detail_transaksi,
					  'isi'					=> 'dasbor/belanja'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}	

	//detail
	public function detail($kd_transaksi)
	{
		$id_pelanggan		= $this->session->userdata('id_pelanggan');
		$detail_transaksi 	= $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$transaksi 			= $this->transaksi_model->kd_transaksi($kd_transaksi);

		//pastikan bahwa pelanggan hanya mengakses data transaksi
		if($detail_transaksi->id_pelanggan != $id_pelanggan){
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
			redirect(base_url('masuk'));
		}

		$data = array(  'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'transaksi'			=> $transaksi,
						'isi'				=> 'dasbor/detail'
						);
		$this->load->view('layout/wrapper', $data, FALSE);	
	}

	//profil
	public function profile()
	{
		$id_pelanggan 	= $this->session->userdata('id_pelanggan');
		$pelanggan 		= $this->pelanggan_model->detail($id_pelanggan);

		// validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan', 'Nama lengkap', 'required',
			array( 'required'	=> '%s harus diisi'));
		$valid->set_rules('alamat', 'Alamat lengkap', 'required',
			array( 'required'	=> '%s harus diisi'));
		$valid->set_rules('telepon', 'No. Telepon', 'required',
			array( 'required'	=> '%s harus diisi'));

		if ($valid->run()===FALSE) {

			//end validasi


		$data = array(  'title'				=> 'Profil Saya',
					    'pelanggan'			=> $pelanggan,
					    'isi'				=> 'dasbor/profile'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
		//masuk databse
		}else{
			$i= $this->input;

			//kalau password lebih dari 6 karakter, maka password diganti
			if(strlen($i->post('password')) >= 6) {
			$data= array(	'id_pelanggan' 	    => $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'password' 			=> SHA1($i->post('password')),
							'telepon' 			=> $i->post('telepon'),
							'alamat' 			=> $i->post('alamat'),
							);
		}else{
			//kalau data password kurang dari 6 karakter, maka tidak perlu diganti
			$data= array(	'id_pelanggan' 	    => $id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'telepon' 			=> $i->post('telepon'),
							'alamat' 			=> $i->post('alamat'),
							);
		}
		//emd data update
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Update Profil Berhasil');
			redirect(base_url('dasbor/profile'),'refresh');		
		}
		//end masuk database	

	}
	//konfirmasi pembayaran
	public function konfirmasi($kd_transaksi)
	{

		$detail_transaksi 	= $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$rekening 			= $this->rekening_model->listing();

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_bank','Nama Bank','required',
			array('required'	=> '%s harus diisi'));

		$valid->set_rules('rekening_pembayaran','Nomor Rekening','required',
			array('required'	=> '%s harus diisi'));

		$valid->set_rules('rekening_pelanggan','Nama Pemilik Rekening','required',
			array('required'	=> '%s harus diisi'));

		$valid->set_rules('tgl_bayar','Tanggal Pembayaran','required',
			array('required'	=> '%s harus diisi'));

		$valid->set_rules('jumlah_bayar','Jumlah Pembayaran','required',
			array('required'	=> '%s harus diisi'));

		if ($valid->run()) {
		   //cek jika gambar diganti
			if (!empty($_FILES['bukti_pembayaran']['name'])) {
				$config['upload_path']		= './assets/upload/images/';
				$config['allowed_types']	= 'gif|jpg|png|jpeg';
				$config['max_size']			= '2400';
				$config['max_widht']		= '2024';
				$config['max_height']		= '2024';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('bukti_pembayaran')){
					//end validasi
		$data = array('title'				=> 'Konfirmasi Pembayaran',
					   'detail_transaksi' 	=> $detail_transaksi,
					   'rekening'			=> $rekening,
					   	'error'				=> $this->upload->display_errors(),
					   'isi'				=> 'dasbor/konfirmasi'
					   );
		$this->load->view('layout/wrapper', $data, FALSE);

		//masuk database
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
			
			$data= array(	'id_detail_transaksi'		=> $detail_transaksi->id_detail_transaksi,
							'status_bayar'				=> 'Konfirmasi',
							'jumlah_bayar' 				=> $i->post('jumlah_bayar'),
							'rekening_pembayaran' 		=> $i->post('rekening_pembayaran'),
							'rekening_pelanggan' 		=> $i->post('rekening_pelanggan'),
							'bukti_pembayaran' 			=> $upload_gambar['upload_data']['file_name'],
							'id_rekening' 				=> $i->post('id_rekening'),
							'tgl_bayar' 				=> $i->post('tgl_bayar'),
							'nama_bank' 				=> $i->post('nama_bank'),
							);
			$this->detail_transaksi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
			redirect(base_url('dasbor'),'refresh');

		}}else{
			//edt produk tanpa ganti gambar
			$i= $this->input;
		
			$data= array(	'id_detail_transaksi'		=> $detail_transaksi->id_detail_transaksi,
							'status_bayar'				=> 'Konfirmasi',
							'jumlah_bayar' 				=> $i->post('jumlah_bayar'),
							'rekening_pembayaran' 		=> $i->post('rekening_pembayaran'),
							'rekening_pelanggan' 		=> $i->post('rekening_pelanggan'),
							// 'bukti_pembayaran' 			=> $upload_gambar['upload_data']['file_name'],
							'id_rekening' 				=> $i->post('id_rekening'),
							'tgl_bayar' 				=> $i->post('tgl_bayar'),
							'nama_bank' 				=> $i->post('nama_bank'),
							);
			$this->detail_transaksi_model->edit($data);
			$this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran Berhasil');
			redirect(base_url('dasbor'),'refresh');


		}}
		// end masuk database
					//end validasi
		$data = array('title'				=> 'Konfirmasi pembayaran',
					   'detail_transaksi' 	=> $detail_transaksi,
					   'rekening'			=> $rekening,
					   'isi'				=> 'dasbor/konfirmasi'
					   );
		$this->load->view('layout/wrapper', $data, FALSE);
	}

}


/* End of file Dasbor.php */
/* Location: ./application/controllers/Dasbor.php */