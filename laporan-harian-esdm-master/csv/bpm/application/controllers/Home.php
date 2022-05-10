<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTHADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_bidder');
		$this->load->model('M_home');
	}

	public function index() {
		$data['userdata'] 			= $this->userdata;
	
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$data['page'] 			= "home";
		$data['judul'] 			= "Home";
		$data['deskripsi'] 		= "Aplikasi Laporan Harian";
		$this->template->views('Admin/home', $data);
	}
	
	function bulan($m) {
		if ($m == 1) {
			$bulan = 'Januari';
		} elseif ($m == 2) {
			$bulan = 'Febuari';						
		} elseif ($m == 3) {
			$bulan = 'Maret';						
		} elseif ($m == 4) {
			$bulan = 'April';						
		} elseif ($m == 5) {
			$bulan = 'Mei';						
		} elseif ($m == 6) {
			$bulan = 'Juni';						
		} elseif ($m == 7) {
			$bulan = 'Juli';						
		} elseif ($m == 8) {
			$bulan = 'Agustus';						
		} elseif ($m == 9) {
			$bulan = 'September';						
		} elseif ($m == 10) {
			$bulan = 'Oktober';						
		} elseif ($m == 11) {
			$bulan = 'November';						
		} elseif ($m == 12) {
			$bulan = 'Desember';						
		}

		return $bulan;
	}
}