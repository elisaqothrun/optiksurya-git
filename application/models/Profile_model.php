<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function read($id_pelanggan)
	{
		$read = $this->db->query("SELECT * 
								FROM pelanggan 
								WHERE id_pelanggan='$id_pelanggan'"); 
		 $response['read']=$read->result();
    	 $response['success'] = "1";
    	 $response['message']="success";
    	 return $response;
	}
	public function edit_profile($id_pelanggan, $nama_pelanggan, $alamat, $telepon)
	{
		$update = $this->db->query("UPDATE pelanggan 
									SET nama_pelanggan ='$nama_pelanggan',
									alamat = '$alamat', telepon = '$telepon'
									WHERE id_pelanggan='$id_pelanggan'");
       if($update){
        $response['success'] = "1";
        $response['message']='Data profil diubah.';
        return $response;
       }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data profil gagal diubah.';
        return $response;
      }
    }

}

/* End of file Profile_model.php */
/* Location: ./application/models/Profile_model.php */