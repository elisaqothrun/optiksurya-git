<?php
defined('BASEPATH') OR exit('No direct script acces allowed');
require 'vendor/autoload.php';

class chat extends CI_Controller {
    public function index()
    {
        $data = array(
            'chat' => $this->db->order_by('id','ASC')->get('chat')result()
        );
        $this->load->view('chat','$data');
    }

    public function store(){
        $data = array(
         'name' => $this->input->post('name'),
         'message' => $this->input->post('message')
        );
    $options = array(
        'cluster' => 'ap1',
        'encrypted' => true 
    );
    $pusher = new Pusher\Pusher(
        '35ed56f5e8a5f1c051c3',
        '0148e7e50f7b6992a48',
        '529213',
    $options
    );

    $push = $this->db->order_by('id','DESC');
    $push = $this->db->get('chat');

    foreach($push as $key){
        $data_pusher[] = $key;
    }

    if($this->db->insert('chat', $data)){
    $pusher->trigger('my-channel', 'my-event', $data_pusher);
           $this->db->insert('chat', $data);
     }

    }