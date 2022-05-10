<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_izin_ood extends AUTHADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_bidder');
		$this->load->model('M_r_permohonan_izin');
		$this->load->model('M_r_persyaratan_izin');
		$this->load->model('M_r_template_izin');
		$this->load->model('M_provinsi');
		$this->load->model('M_kabkot');
		$this->load->model('M_izin_instansi');
		$this->load->model('M_Dokumen_Syarat_Perusahaan');
		$this->load->model('M_T_Akta_Perusahaan');
		$this->load->model('M_proses_skema');
	}

	public function index() {
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;
		$data['page'] 		= "permohonan_izin_ood";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);

		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_permohonan_request_dokumen($this->userdata);

		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->get_process_description($data['dataPermohonan_izin']);
		

		foreach ($data['dataPermohonan_izin'] as $permohonan_izin) {
			$url_proses = base_url("Permohonan_izin_ood/proses_permohonan/{$permohonan_izin->ID_PERMOHONAN}");
			$permohonan_izin->LINK_PROSES = "<a href='{$url_proses}' class='btn btn-info btn-minier'><i class='glyphicon glyphicon-info-sign'></i> Periksa</a>";
		}

		$this->session->unset_userdata('idPermohonan');

		$this->template->views('Admin/Permohonan_izin_ood/home_eval', $data);
	}

	public function proses_permohonan($id_permohonan = NULL) {

		if(!$this->is_valid_request_access($id_permohonan)) {
			http_response_code(403);
			die("Forbidden");
		}

		$controller_handler = $this->M_proses_skema->get_permohonan_controller($id_permohonan, $this->userdata->ID_ROLE);

		if(empty($controller_handler)) {
			$controller_handler = "Permohonan_izin_eval\step1";
		}

		$this->session->set_userdata('idPermohonan', $id_permohonan);

		redirect($controller_handler);
	}

	private function is_valid_request_access($id_permohonan) {
		$data_permohonan = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
		
		if($data_permohonan->IS_REQUEST_DOCUMENT == 'Y') {
			return TRUE;
		}

		return FALSE;
	}
}