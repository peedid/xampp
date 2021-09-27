<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_data extends CI_Controller {
    public function index() {
	   redirect(home_url());
    }

    public function detail_barang($kode_barcode) {
    	$this->load->library('session');
		$this->load->model('model');
		if ($this->model->_CekUsername($this->session->userdata('username'), $this->session->userdata('password')) < 1) {
			redirect(home_url());
			return;
		} 
		echo "test";
    }

    public function cek_adapesanan_aktif() {
    	$this->load->library('session');
		$this->load->model('model');
		 $trading = $this->model->load_trading();
         $this->db = $trading;
		$token_hash = $this->security->get_csrf_hash();
		$hasil = '{"token_hash":"'.$token_hash.'", "result_code":0, "message":""}';
    	$ds_hasil = $this->db->query("select first 1 kode_antrian, nomer_antrian, status_antrian from mst_antrian_layanan where kode_customer = ? and tanggal = current_date and status_antrian <> 'CANCEL' and status_antrian <> 'SELESAI'",array($this->session->userdata('kode_buildup')));
    	if ($ds_hasil){
	    	foreach ($ds_hasil->result() as $result) {
		       if ($result->KODE_ANTRIAN != "")
		          $hasil = '{"token_hash":"'.$token_hash.'", "result_code":1, "message":"Pesanan Anda Nomer '.$result->NOMER_ANTRIAN.' dalam Proses '.$result->STATUS_ANTRIAN.'. silahkan selesaikan terlebih dahulu !"}';
		    }
    	} 
	    echo $hasil;
    }
}

