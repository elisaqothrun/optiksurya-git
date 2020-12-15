<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('pelanggan_model');
	}
	// fungsi login
	public function login($email,$password)
	{
		$check = $this->CI->pelanggan_model->login($email, $password); 
		//jika ada data user maka create session login
		if($check){
			$id_pelanggan	= $check->id_pelanggan;
			$nama_pelanggan	= $check->nama_pelanggan;
			// create session
			$this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
			$this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);
			$this->CI->session->set_userdata('email', $email);
			//redirect ke halaman admin
			redirect(base_url('dasbor'),'refresh');

			//kalau tidak ada data/ usernam/password salah
		}else{
			$this->CI->session->set_flashdata('warning', 'Username atau Password Anda Salah');
			redirect(base_url('masuk'),'refresh');
		}

	}
	// fungsi cek login
	public function cek_login()
	{
		//menerima apakah session sudah tersedi atau belum, jika belum alihkan k halaman login
		if ($this->CI->session->userdata('email')== "") {
			$this->CI->session->set_flashdata('warning', 'Anda Belum Login');
			redirect(base_url('masuk'),'refresh');
		}
	}
	// fungsi logout
	public function logout()
	{
		//membuang smua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_pelanggan');
		$this->CI->session->unset_userdata('nama_pelanggan');
		$this->CI->session->unset_userdata('email');
		//setelah session dibuang, maka redirect ke halamn login
		$this->CI->session->set_flashdata('sukses', 'Anda Telah Logout');
		redirect(base_url('masuk'),'refresh');
	}

	

}

