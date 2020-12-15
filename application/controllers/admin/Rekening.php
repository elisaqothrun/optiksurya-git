<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rekening_model');

		//proteksi
		$this->simple_login->cek_login();

	}

	public function index()
	{
		$rekening = $this->rekening_model->listing();
		$data = array(	'title'		=> 'Data Rekening',
						'rekening'	=> $rekening,
						'isi'		=> 'admin/rekening/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	// tambah rekening
	public function tambah()
	{
		// validasi
		$valid = $this->form_validation;

		$valid->set_rules('nama_bank','Nama Rekening','required',
			array( 'required'	=> '%s harus diisi'));


		$valid->set_rules('nama_pemilik','Nama Pemilik Rekening','required',
			array( 'required'	=> '%s harus diisi'));

		$valid->set_rules('no_rekening','Nomor Rekening','required|is_unique[rekening.no_rekening]',
			array( 'required'	=> '%s harus diisi',
				   'is_unique'	=> '%s rekening sudah tersedia. Silahkan buat nomor rekening baru !'));

		
		if ($valid->run()===FALSE) {

		$data = array(	'title' => 'Tambah Rekening ',
						'isi'	=> 'admin/rekening/tambah'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i= $this->input;
			$data= array(	'nama_bank' 		=> $i->post('nama_bank'),
							'no_rekening'		=> $i->post('no_rekening'),
							'nama_pemilik' 		=> $i->post('nama_pemilik')
							);
			$this->rekening_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			redirect(base_url('admin/rekening'),'refresh');				
		}
	}
	// edit
	public function edit($id_rekening)
	{
		$rekening = $this->rekening_model->detail($id_rekening);
		// validasi
		$valid = $this->form_validation;

		$valid->set_rules('nama_bank', 'Nama rekening', 'required',
			array( 'required'	=> '%s harus diisi'));

		if ($valid->run()===FALSE) {

		$data = array(	'title'		 => 'Edit Rekening',
						'rekening'	 =>	$rekening,
						'isi'		 => 'admin/rekening/edit'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i= $this->input;
			$data= array(	'id_rekening'		=> $id_rekening,
							'nama_bank' 		=> $i->post('nama_bank'),
							'no_rekening'		=> $i->post('no_rekening'),
							'nama_pemilik' 		=> $i->post('nama_pemilik')
							);
			$this->rekening_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/rekening'),'refresh');				
		}
	}
	public function delete($id_rekening)
	{
		$data = array('id_rekening'	=> $id_rekening);
		$this->rekening_model->delete($data);
		$this->session->set_flashdata('Sukses', 'Data Berhasil Dihapus');
		redirect(base_url('admin/rekening'), 'refresh');

	}

}
