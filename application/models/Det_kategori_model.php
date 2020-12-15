<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Det_kategori_model extends CI_Model {
public function __construct()
{
	parent::__construct();
	$this->load->database();
}
public function detail($id_kategori)
{
	$read = $this->db->query("SELECT * 
							FROM kategori JOIN produk ON kategori.id_kategori = produk.id_kategori WHERE kategori.id_kategori=$id_kategori");
	$response['detail']=$read->result();
    	 $response['success'] ="200";
    	 $response['message']="success";
    	 return $response;
	

}
}

/* End of file Det_kategori_model.php */
/* Location: ./application/models/Det_kategori_model.php */