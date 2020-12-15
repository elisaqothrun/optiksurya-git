<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller{
    function __construct(){
      parent::__construct();
      //load chart_model from model
      $this->load->model('grafik_model');
    }
 
    function index(){
      $data2 = $this->Grafik_model->get_data()->result();
      $x['data'] = json_encode($data2);
      $this->load->view('admin/dasbor/Grafik_view',$x);
    }
}