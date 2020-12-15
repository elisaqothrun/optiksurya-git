<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('konfigurasi_model');
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
		$this->load->model('pelanggan_model');
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');

		//load helper random string untuk kode transaksi
		$this->load->helper('string');
	}

	public function index()
	{
	        $this->simple_pelanggan->cek_login();

		$keranjang = $this->cart->contents();

		$data  = array(	'title' 	=> 'Keranjang Belanja',
						'keranjang'	=>  $keranjang,
						'isi'		=> 'belanja/list'
						 );
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	// public function get_provinsi()
	// {
	// 	$provinces= $this->rajaongkir->province();
	// 	$this->output->set_content_type('application/json')->set_output($provinces);
	// }
	// public function get_kota($id_provinsi)
	// {
	// 	$kota= $this->rajaongkir->city($id_provinsi);
	// 	$this->output->set_content_type('application/json')->set_output($kota);
	// }
	// public function get_biaya($asal,$tujuan,$berat,$kurir)
	// {
	// 	$ongkir= $this->rajaongkir->cost($asal,$tujuan,$berat,$kurir);
	// 	$this->output->set_content_type('application/json')->set_output($ongkir);
	// }
	//sukses belanja
	public function sukses()
	{
		$data = array(	'title'		=> 'Belanja Berhasil',
						'isi'		=> 'belanja/sukses'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function provinsi()
	{
		$curl = curl_init();

		  curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 3ebe61d860b643c1c0fbab81286029cb"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $array_response = json_decode($response, TRUE);
		  $data_provinsi = $array_response["rajaongkir"]["results"];

		  echo "<option value=''>--Pilih Provinsi--</option>";

		  foreach ($data_provinsi as $key => $tiap_provinsi) {
		  	echo "<option value='".$tiap_provinsi['province_id']."' id_provinsi= '".$tiap_provinsi['province_id']."'>";
		  	echo $tiap_provinsi["province"];
		  	echo "</option>";
		  }
		}
	}
	public function kota(){
		$id_provinsi_terpilih =  $this->input->post('id_provinsi');
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 3ebe61d860b643c1c0fbab81286029cb"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			//jadikan array agar dapat digunakan dalam bentuk php
		  //echo $response;
		  $array_response = json_decode($response, TRUE);
		  $data_kota 	  = $array_response["rajaongkir"]["results"];

		  // echo "<pre>";
		  // print_r($data_kota);
		  // echo "</pre>";

		  echo "<option value=''>--Pilih Kota--</option>";

		  foreach ($data_kota as $key => $tiap_kota) 
		  {
		  	echo "<option value='' 
		  	id_kota='".$tiap_kota["city_id"]."' 
		  	nama_provinsi='".$tiap_kota["province"]."' 
		  	nama_kota='".$tiap_kota["city_name"]."' 
		  	tipe_distrik='".$tiap_kota["type"]."' 
		  	kodepos ='".$tiap_kota["postal_code"]."'   >";
		  	echo $tiap_kota["type"]." ";
		  	echo $tiap_kota["city_name"];
		  	echo "</option>";
		  }
		}
	}
	public function ekspedisi(){
		echo "<option value=''>--Pilih Ekspedisi--</option>";
		echo "<option value='pos'>POS Indonesia</option>";
		echo "<option value='tiki'>TIKI</option>";
		echo "<option value='jne'>JNE</option>";
		echo "</option>";
	}
	public function paket(){
		$kota = $this->input->post('kota');
		$berat = $this->input->post('berat');
		$ekspedisi = $this->input->post('ekspedisi');
		// $belanja = $_POST["total"];
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
	  CURLOPT_SSL_VERIFYHOST => 0,
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=160&destination=".$kota."&weight=".$berat."&courier=".$ekspedisi,
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: 3ebe61d860b643c1c0fbab81286029cb"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $array_response = json_decode($response, true);

	  $paket = $array_response["rajaongkir"]["results"]["0"]["costs"];


	  echo "<option value=''>--Pilih Paket--</option>";
	  foreach ($paket as $key => $tiap_paket) {
	  	echo "<option  
	  	paket='".$tiap_paket['service']."' 
	  	ongkir='".$tiap_paket["cost"]["0"]["value"]."'
	  	estimasi='".$tiap_paket["cost"]["0"]["etd"]."' >";
	  	echo $tiap_paket["service"]." ";
	  	echo $tiap_paket["cost"]["0"]["value"]." ";
	  	echo $tiap_paket["cost"]["0"]["etd"];
	  	echo "</option>";
	  }

	}
}
	//checkout
	public function checkout()
	{
		"ongkir = " . $this->uri->segment(3);
		"Total harga = " . $this->uri->segment(4);
		$ongkir = $this->uri->segment(3);
		$total = $this->uri->segment(4);
		// $total = $this->uri->segment('3');
		// $data['query'] = $this->transaksi_model->tambah($total);
		//cek pelanggan sudah login atau belum jika belum maka tidak bisa melakukan proses checkout dan harus login terselbih dahulu
		//cek login dengan menggunakan session
		if($this->session->userdata('email')){
			$email     		= $this->session->userdata('email');
			$nama_pelanggan = $this->session->userdata('nama_pelanggan');
			$pelanggan 		= $this->pelanggan_model->sudah_login($email, $nama_pelanggan);

			$keranjang 		= $this->cart->contents();

			// validasi input
			$valid = $this->form_validation;

			$valid->set_rules('nama_pelanggan', 'Nama lengkap', 'required',
				array( 'required'	=> '%s harus diisi'));
			$valid->set_rules('telepon', 'Nomor Telepon', 'required',
				array( 'required'	=> '%s harus diisi'));
			$valid->set_rules('alamat', 'Alamat', 'required',
				array( 'required'	=> '%s harus diisi'));

			$valid->set_rules('email', 'Email', 'required|valid_email',
				array(	'required'		=> '%s harus diisi',
						'valid_email' 	=> '%s tidak valid',
						'is_unique'		=> '%s sudah terdaftar.'));
			if ($valid->run()===FALSE) {
				//end validasi
			$data = array(	'title'		=> 'Checkout',
							'keranjang'	=> $keranjang,
							'pelanggan'	=> $pelanggan,
							'isi'		=> 'belanja/checkout',
						);
		$this->load->view('layout/wrapper', $data, FALSE);
		//masuk database
		}else{
			$i= $this->input;
			$data= array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
							'nama_pelanggan'	=> $i->post('nama_pelanggan'),
							'email' 			=> $i->post('email'),
							'telepon' 			=> $i->post('telepon'),
							'alamat' 			=> $i->post('alamat'),
							'detail_pesanan' 	=> $i->post('detail_pesanan'),
							'kd_transaksi' 		=> $i->post('kd_transaksi'),
							'tgl_transaksi' 	=> $i->post('tgl_transaksi'),
							'jumlah_transaksi' 	=> $total,
							'status_bayar' 		=> 'Belum Bayar',
							'tgl_post'			=> date('Y-m-d H:i:s')
							);
			//proses masuk ke detail transaksi
			$this->detail_transaksi_model->tambah($data);
			//proses masuk ke transaksi
			foreach ($keranjang as $keranjang) {
				$subtotal = $keranjang['price'] * $keranjang['qty'];
				// $ongkir = $this->ongkir_model->listing();
				$data = array(	'id_pelanggan'		=> $pelanggan->id_pelanggan,
								'kd_transaksi'		=> $i->post('kd_transaksi'),
								'id_produk'			=> $keranjang['id'],
								'harga'				=> $keranjang['price'],
								'jumlah'			=> $keranjang['qty'],
								'subtotal'			=> $subtotal,
								'tarif'				=> $ongkir,
								'total_harga'		=> $total,
								'tgl_transaksi'		=> $i->post('tgl_transaksi')
								);
			$this->transaksi_model->tambah($data);
			}
			//end masuk ke tabel transaksi
			//setelah masuk ke tabel transaksi, maaka keranjang di kosongkan 
			$this->cart->destroy();
			//end destroy
			$this->session->set_flashdata('sukses', 'Checkout Berhasil');
			redirect(base_url('belanja/sukses'),'refresh');		
		}
		//end masuk database
		}else{
			//kalau belum maka harus registrasi
			$this->session->set_flashdata('sukses', 'Silahkan Log In atau Registrasi terlebih dahulu');
			redirect(base_url('masuk'),'refresh');
		}

	}
	//tambahkan keranjang bealanja
	public function add()
	{
		//ambil data dari form
		$id 			= $this->input->post('id');
		$qty 			= $this->input->post('qty');
		$price			= $this->input->post('price');
		$name 			= $this->input->post('name');
		$redirect_page 	= $this->input->post('redirect_page');
		//proses mmasukan ke keranjang belanja
		$data = array(  'id'      	=> $id,
        				'qty'     	=> $qty,
        				'price'   	=> $price,
        				'name'    	=> $name,
						);
		$this->cart->insert($data);
		// redirect page
		redirect($redirect_page,'refresh');

	}
	//update cart
	public function update_cart($rowid)
	{
		if($rowid) {
			$data = array(	'rowid'	=> $rowid,
							'qty'	=> $this->input->post('qty')
				);
			$this->cart->update($data);
			$this->session->flashdata('sukses', 'Data keranjang telah diupdate');
			redirect(base_url('belanja'),'refresh');
		}else{
			//jika tidak ada row id
			redirect(base_url('belanja'),'refresh');
		}
	}
	//hapus semua keranjang belanja 
	public function hapus($rowid='')
	{
		//hapus salah satu
		if($rowid){
		$this->cart->remove($rowid);
		$this->session->set_flashdata('sukses', 'Produk telah dihapus dari keranjang');
		redirect(base_url('belanja'),'refresh');
		}else{
		//hapus semua
		$this->cart->destroy();
		$this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
		redirect(base_url('belanja'),'refresh');
		}
	}
}

/* End of file Belanja.php */
/* Location: ./application/controllers/Belanja.php */
