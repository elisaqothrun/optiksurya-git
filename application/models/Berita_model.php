<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing berita home
	public function listing()
	{
		$this->db->select('berita.*,
						  user.nama');
		$this->db->from('berita');
		// join
		$this->db->join('user', 'user.id_user = berita.id_user', 'left');
		// $this->db->join('gambar', 'gambar.id_berita = berita.id_berita', 'left');
		// end join
		$this->db->group_by('berita.id_berita');
		$this->db->order_by('id_berita', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing semua berita
	public function home()
	{
		$this->db->select('berita.*,
						  user.nama');
		$this->db->from('berita');
		// join
		$this->db->join('user', 'user.id_user = berita.id_user', 'left');
		// $this->db->join('gambar', 'gambar.id_berita = berita.id_berita', 'left');
		// end join
		$this->db->where('berita.status_berita', 'Publish');
		$this->db->group_by('berita.id_berita');
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}
	//read berita
	public function read($slug_berita)
	{
		$this->db->select('berita.*,
						  user.nama');
		$this->db->from('berita');
		// join
		$this->db->join('user', 'user.id_user = berita.id_user', 'left');
		// $this->db->join('gambar', 'gambar.id_berita = berita.id_berita', 'left');
		// end join
		$this->db->where('berita.status_berita', 'Publish');
		$this->db->where('berita.slug_berita', $slug_berita);
		$this->db->group_by('berita.id_berita');
		$this->db->order_by('id_berita', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function berita($limit,$start)
	{
		$this->db->select('berita.*,
						  user.nama');
		$this->db->from('berita');
		// join
		$this->db->join('user', 'user.id_user = berita.id_user', 'left');
		// end join
		$this->db->where('berita.status_berita', 'Publish');
		$this->db->group_by('berita.id_berita');
		$this->db->order_by('id_berita', 'desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query->result();
	}
	//total berita
	public function total_berita()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('berita');
		$this->db->where('status_berita', 'Publish');
		$query = $this->db->get();
		return $query->row();
	}	
	// detail berita
	public function detail($id_berita)
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('id_berita', $id_berita);
		$this->db->order_by('id_berita', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	// tambah
	public function tambah($data)
	{
		$this->db->insert('berita', $data);
	}
	// edit
	public function edit($data)
	{
		$this->db->where('id_berita', $data['id_berita']);
		$this->db->update('berita', $data);
	}
	// hapus
	public function delete($data)
	{
		$this->db->where('id_berita', $data['id_berita']);
		$this->db->delete('berita', $data);
	}
		
}
