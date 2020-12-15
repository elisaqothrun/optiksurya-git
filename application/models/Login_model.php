<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function login($email,$password)
	{
		$result = $this->db->query("SELECT * FROM pelanggan 
									 WHERE email= '$email'
									 AND password ='$password'
									 ");

    	 // $response['login']=$result->result();
    	 // $response['success'] = "1";
    	 // $response['message']="success";
    	 // return $response;
		if($result->result()){
        $response['login'] = $result->result();
        $response['success']= "1";
        $response['message']= "success";
        return $response;
       }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']= "Password Atau Username Anda Salah";
        return $response;
      }
	}
	public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }
	

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */