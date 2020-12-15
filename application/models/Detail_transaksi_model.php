<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_transaksi_model extends CI_Model {
 public function __construct()
 {
 	parent::__construct();
 	$this->load->database();
 }

 //listing all detail_transaksi
 public function listing()
 {
 	
	$this->db->select('detail_transaksi.*,
						pelanggan.nama_pelanggan,
						SUM(transaksi.jumlah) AS total_item');
	$this->db->from('detail_transaksi');
	//join
	$this->db->join('transaksi','transaksi.kd_transaksi = detail_transaksi.kd_transaksi', 'left');
	$this->db->join('pelanggan', 'pelanggan.id_pelanggan = detail_transaksi.id_pelanggan', 'left');
	//end join
	$this->db->group_by('detail_transaksi.id_detail_transaksi');
 	$this->db->order_by('id_detail_transaksi','desc');
 	$query=$this->db->get();
 	return $query->result();
 }

 //listing all detail_transaksi
	public function pelanggan($id_pelanggan)
	{
		$this->db->select('detail_transaksi.*,
							SUM(transaksi.jumlah) AS total_item');
		$this->db->from('detail_transaksi');
		$this->db->where('detail_transaksi.id_pelanggan', $id_pelanggan);
		//join
		$this->db->join('transaksi','transaksi.kd_transaksi = detail_transaksi.kd_transaksi', 'left');
		//end join
		$this->db->group_by('detail_transaksi.id_detail_transaksi');
		$this->db->order_by('id_detail_transaksi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
//kode transaksi
public function kd_transaksi($kd_transaksi)
 {
 	$this->db->select('detail_transaksi.*,
						pelanggan.nama_pelanggan,
						rekening.nama_bank AS bank,
						rekening.no_rekening,
						rekening.nama_pemilik,
						SUM(transaksi.jumlah) AS total_item');
	$this->db->from('detail_transaksi');
	//join
	$this->db->join('transaksi','transaksi.kd_transaksi = detail_transaksi.kd_transaksi', 'left');
	$this->db->join('pelanggan', 'pelanggan.id_pelanggan = detail_transaksi.id_pelanggan', 'left');
	$this->db->join('rekening', 'rekening.id_rekening = detail_transaksi.id_rekening', 'left');
	//end join
	$this->db->group_by('detail_transaksi.id_detail_transaksi');
 	$this->db->where('transaksi.kd_transaksi', $kd_transaksi);
 	$this->db->order_by('id_detail_transaksi','desc');
 	$query=$this->db->get();
 	return $query->row();
 }

//detail detail_transaksi
 public function detail($id_detail_transaksi)
 {
 	$this->db->select('*');
 	$this->db->from('detail_transaksi');
 	$this->db->where('id_detail_transaksi', $id_detail_transaksi);
 	$this->db->order_by('id_detail_transaksi','desc');
 	$query=$this->db->get();
 	return $query->row();
 }


 //detail_transaksi sudah login
//  public function sudah_login($email,$nama_detail_transaksi)
// {
// 	$this->db->select('*');
//  	$this->db->from('detail_transaksi');
//  	$this->db->where('email', $email);
//  	$this->db->where('nama_detail_transaksi', $nama_detail_transaksi);
//  	$this->db->order_by('id_detail_transaksi','desc');
//  	$query=$this->db->get();
//  	return $query->row();	
// }


// //login detail_transaksi
//  public function login($email,$password)
//  {
//  	$this->db->select('*');
//  	$this->db->from('detail_transaksi');
//  	$this->db->where(array('email' => $email,
//  							'password' => sha1($password)));
//  	$this->db->order_by('id_detail_transaksi','desc');
//  	$query=$this->db->get();
//  	return $query->row();
//  }


 //Tambah data
 public function tambah($data)
{
	$this->db->insert('detail_transaksi',$data);
}
//Edit

public function edit($data)
{
	$this->db->where('id_detail_transaksi',$data['id_detail_transaksi']);
	$this->db->update('detail_transaksi',$data);
}

//delete
public function delete($data)
{
	$this->db->where('id_detail_transaksi',$data['id_detail_transaksi']);
	$this->db->delete('detail_transaksi',$data);
}

}

