<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->order_by('id_transaksi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	//listing all transaksi berdasarkan detail transaksi
	public function kd_transaksi($kd_transaksi)
	{
		$this->db->select('transaksi.*,
							produk.nama_produk,
							produk.kd_produk');
		$this->db->from('transaksi');
		//join dg tb produk
		$this->db->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
		//end join
		$this->db->where('kd_transaksi', $kd_transaksi);
		$this->db->order_by('id_transaksi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// detail transaksi
	public function detail($id_transaksi)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->order_by('id_transaksi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail slug transaksi
	public function read($slug_transaksi)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where('slug_transaksi', $slug_transaksi);
		$this->db->order_by('id_transaksi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	// login
	public function login($transaksi, $password)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where(array('transaksi'	=> $transaksi,
						 	   'password'	=> SHA1($password)));
		$this->db->order_by('id_transaksi', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	// tambah
	public function tambah($data)
	{
		$this->db->insert('transaksi', $data);
	}
	// edit
	public function edit($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('transaksi', $data);
	}
	// hapus
	public function delete($data)
	{
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->delete('transaksi', $data);
	}
	//notif
	public function total_rows($q = NULL)
	{
		$this->db->like('id_transaksi', $q);
		$this->db->or_like('kd_transaksi', $q);
		$this->db->or_like('harga', $q);
		$this->db->or_like('total_harga', $q);
		$this->db->or_like('tgl_transaksi', $q);
		$this->db->from('transaksi');
		return $this->db->count_all_results();
	}
		

}
