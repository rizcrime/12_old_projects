<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_konfigurasi');
	}

	public function index()
	{
		$data['msconfig'] = $this->M_konfigurasi->GetMsconfig()->result();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/konfigurasi/v_konfigurasi', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	// public function detail_pramanifest($id){
	// 	$data['data_pramanifest'] = $this->M_pramanifest->GetPramanifestByID($id)->result();
	// 	$data['data_pramanifest_detail'] = $this->M_pramanifest->GetPramanifestdetailByID($id)->result();

	// 	$this->load->view('Dashboard/layout/template');
	// 	$this->load->view('Dashboard/pramanifest/v_pramanifest_detail', $data);
	// 	$this->load->view('Dashboard/layout/footer');
	// }

	public function tambah_konfigurasi(){
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/konfigurasi/v_konfigurasi_tambah');
		$this->load->view('Dashboard/layout/footer');
	}

	public function insert_to_database(){
		$this->M_konfigurasi->InsertMsconfig();
		redirect('Dashboard/Konfigurasi','refresh');
	}

}

		


		
