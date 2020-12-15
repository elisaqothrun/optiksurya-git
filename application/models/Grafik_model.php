<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_model extends CI_Model {

	function get_data(){
		$this->db->select('nama_produk, stok');
		$result = $this->db->get('produk');
		return $result;
	
	}
}