<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function daftar($nama_pelanggan, $email, $password, $alamat, $telepon)
	{
		 $read = $this->db->query("INSERT INTO pelanggan (nama_pelanggan, email, password, alamat, telepon) VALUES ('$nama_pelanggan', '$email', '$password', '$alamat', '$telepon')"); 
		if($read){
        $response['success']= "1";
        $response['message']= "success";
        return $response;
       }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']= "Email Sudah Tersedia";
        return $response;
      }
	
  } 
}

/* End of file Daftar_model.php */
/* Location: ./application/models/Daftar_model.php */