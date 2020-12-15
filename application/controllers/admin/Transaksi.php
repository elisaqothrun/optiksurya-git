<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
	}

	public function index()
	{
		$detail_transaksi = $this->detail_transaksi_model->listing();
		$data = array(	'title' 			=> 'Data Transaksi',
					    'detail_transaksi'	=>  $detail_transaksi,
					    'isi'				=> 'admin/transaksi/list'
				);
	   $this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function detail($kd_transaksi)
	{
		$detail_transaksi = $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$transaksi 		  = $this->transaksi_model->kd_transaksi($kd_transaksi);

		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'transaksi'			=> $transaksi,
						'isi'				=> 'admin/transaksi/detail'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//cetak
	public function cetak($kd_transaksi)
	{
		$detail_transaksi = $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$transaksi 		  = $this->transaksi_model->kd_transaksi($kd_transaksi);
		$site 			  = $this->konfigurasi_model->listing(); 
 
		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'site'				=> $site,
						'transaksi'			=> $transaksi,
						);
		$this->load->view('admin/transaksi/cetak', $data, FALSE);
	}
	//unduh pdf
	public function pdf($kd_transaksi)
	{
		$detail_transaksi = $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$transaksi 		  = $this->transaksi_model->kd_transaksi($kd_transaksi);
		$site 			  = $this->konfigurasi_model->listing(); 
 
		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'site'				=> $site,
						'transaksi'			=> $transaksi,
						);
		// $this->load->view('admin/transaksi/cetak', $data, FALSE);
		$html = $this->load->view('admin/transaksi/cetak', $data, true);

		$mpdf = new \Mpdf\Mpdf();

		// Write some HTML code:
		$mpdf->WriteHTML($html);

		// Output a PDF file directly to the browser
		$mpdf->Output();
	}
	//cetak untuk pengiriman
	public function kirim($kd_transaksi)
	{
		$detail_transaksi = $this->detail_transaksi_model->kd_transaksi($kd_transaksi);
		$transaksi 		  = $this->transaksi_model->kd_transaksi($kd_transaksi);
		$site 			  = $this->konfigurasi_model->listing(); 
 
		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'site'				=> $site,
						'transaksi'			=> $transaksi,
						);
		// $this->load->view('admin/transaksi/kirim', $data, FALSE);
		$html = $this->load->view('admin/transaksi/kirim', $data, true);

		$mpdf = new \Mpdf\Mpdf();
		//setting header dan footer
		$mpdf->SetHTMLHeader('
		<div style="text-align: left; font-weight: bold;">
		    <img src="'.base_url('assets/upload/images/'.$site->logo).'" style="height: 50px; width= auto;">
		</div>');
		$mpdf->SetHTMLFooter('
			<div style = "padding: 12px 10px; background-color:grey; color:white; font-size: 12px;">
				Alamat: '.$site->namaweb.'('.$site->alamat.')<br>
				Telepon: '.$site->telepon.'
			</div>
		');
		//end setting header dan footer 
		// Write some HTML code:
		$mpdf->WriteHTML($html);
		// Output dengan nama baru
		$nama_file_pdf = url_title($site->namaweb,'dash','true').'-'.$kd_transaksi.'.pdf';
		$mpdf->Output($nama_file_pdf, 'I');

	}
	public function get_tot(){
		$tot = $this->Transaksi_model->toral_rows();
		$resut['tot'] = $tot;
		$resut['msg'] = "Berhasil di Refresh secara realtime";
		echo json_encode($resut);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/admin/Transaksi.php */