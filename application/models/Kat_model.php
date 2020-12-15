<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kat_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function read()
	{
		$read = $this->db->query("SELECT * 
								FROM kategori"); 
		 $response['data']=$read->result();
    	 $response['success'] ="200";
    	 $response['message']="success";
    	 return $response;
	}
	

}

/* End of file Kat_model.php */
/* Location: ./application/models/Kat_model.php */