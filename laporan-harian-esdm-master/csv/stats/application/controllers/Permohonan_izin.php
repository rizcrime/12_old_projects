<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Cmixin\BusinessDay;

class KSWPResponse {
	public $status;
	public $messages;

	public function __construct($status, $messages, $human_readable) {
		$this->status = $status;
		$this->messages = $messages;
		$this->human_readable = $human_readable;
	}
}

class Permohonan_izin extends AUTHBIDDER_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_bidder');
		$this->load->model('M_provinsi');
		$this->load->model('M_kabkot');
		$this->load->model('M_r_permohonan_izin');
		$this->load->model('M_izin_instansi');
		$this->load->model('M_r_persyaratan_izin');
		$this->load->model('M_r_template_izin');
		$this->load->model('M_Dokumen_Syarat_Perusahaan');
		$this->load->model('M_T_Akta_Perusahaan');
		$this->load->model('M_formgen');
		$this->load->model('M_syarat_ketentuan');
		$this->load->model('M_proses_skema');
		$this->load->model('M_skema_izin');
		$this->load->model('M_r_user_izin_instansi');
		$this->load->model('M_working_hours');
		$this->load->helper('chunkupload');
		$this->load->library('mailer');
	
		if(!$this->is_verified()) {
			redirect("Home");
			return;
		}
	}

	private function is_verified() {
		$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;
		$is_verified = $this->M_bidder->is_verified($id_perusahaan);

		return $is_verified == "Y";
	}

	public function index() {
		$id = $this->session->userdata['userdata'];
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['list_izin'] 	= $this->M_r_template_izin->get_daftar_izin_form();;
		$list_expired = $this->M_r_permohonan_izin->hapus_permohonan_expired($id->ID_PERUSAHAAN);
		foreach ($list_expired as $row) {
			$this->hapus($row);
		}
		
		if (isset($_POST['STATUS']) && $_POST['STATUS'] != NULL) {
			if ($_POST['STATUS'] == "Y"){
				$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan_status_disetujui($id->ID_PERUSAHAAN);
			} else if ($_POST['STATUS'] == "N") {
				$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan_status_ditolak($id->ID_PERUSAHAAN);
			} else {
				$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan($id->ID_PERUSAHAAN);
			}
		} else {
			$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan($id->ID_PERUSAHAAN);
		}

		foreach($data['dataPermohonan_izin'] as $permohonan_izin) {

			// Encyrpypt ID
			// $permohonan_izin->KODE_TRACKING = encrypted_id_permohonan($permohonan_izin->ID_PERMOHONAN) . " " . $permohonan_izin->ID_PERMOHONAN;
			$kode_tracking = encrypted_id_permohonan($permohonan_izin->ID_PERMOHONAN);
			$track_url = base_url("Permohonan_izin/track/{$kode_tracking}");
			$permohonan_izin->KODE_TRACKING = "<a href='{$track_url}' target='_blank'>{$kode_tracking}</a>";

			// Tanggal pengajuan
			if ($permohonan_izin->TGL_PENGAJUAN == NULL) {
				$permohonan_izin->TGL_PENGAJUAN_STRING = '-';
			} else {                        
				$permohonan_izin->TGL_PENGAJUAN_STRING = tgl_indo($permohonan_izin->TGL_PENGAJUAN);
			}

			// Status
			$list_process = $this->M_r_permohonan_izin->get_ongoing_process_id($permohonan_izin->ID_PERMOHONAN);
			$role_list = array();
			$current_process_id = -1;

			foreach($list_process as $curr_process_data) {
				$role_holder = $this->M_r_permohonan_izin->get_process_role($curr_process_data->ID_PROSES);
			  
				foreach($role_holder as $role_holder_data) {
				  array_push($role_list, $role_holder_data->ID_ROLE);
				}
				  
				$have_role = $this->M_r_permohonan_izin->is_process_have_role($curr_process_data->ID_PROSES);

				if(!$have_role) { // Is current process for perusahaan
					$current_process_id = $curr_process_data->ID_PROSES;
				}
			}	

			$is_need_perusahaan_process = (!empty($list_process) && empty($role_list) && !is_null($permohonan_izin->TGL_PENGAJUAN));

			$is_need_dokumen_kelengkapan = ($permohonan_izin->IS_REQUEST_DOCUMENT == 'Y');

			if($is_need_dokumen_kelengkapan) {
				$permohonan_izin->STATUS_STRING = "Butuh kelengkapan";
			} else if($is_need_perusahaan_process) {
				$current_process_data = $this->M_proses_skema->get_by_id_proses($current_process_id);

				$permohonan_izin->STATUS_STRING = $current_process_data->NAMA_PROSES;
			} else if ($permohonan_izin->TGL_PENGAJUAN == NULL) {
				date_default_timezone_set("Asia/Bangkok");
				$created = $permohonan_izin->TGL_ENTRY;  
				$createdTS = new dateTime($created);

				date_default_timezone_set("Asia/Bangkok");
				$date = date('Y-m-d');
				$todayTS = new dateTime($date);  
				$diff = $todayTS->diff($createdTS);
				$diff = $diff->days;

				$permohonan_izin->STATUS_STRING = 'Draft';
				if($diff > 7) {
					$permohonan_izin->STATUS_STRING .= ' (Kedaluwarsa)';                          
				} else {
					$timeleft = 7 - $diff;

					if ($timeleft == 0) {
						$permohonan_izin->STATUS_STRING .= ' (Kedaluwarsa: Besok)';
					} else {
						$permohonan_izin->STATUS_STRING .= ' (Kedaluwarsa: '.$timeleft.' Hari)';
					}
				}
			} else if ($permohonan_izin->TGL_DISETUJUI != NULL) {
				$base_izin_url = get_izin_pdf_url();
				$permohonan_izin->STATUS_STRING = "Disetujui (<a target='_blank' href='{$base_izin_url}{$kode_tracking}/{$permohonan_izin->FILE_IZIN}'>{$permohonan_izin->NOMOR_IZIN}</a>)";
				//$permohonan_izin->STATUS_STRING = "Disetujui (<a target='_blank' href='{$base_izin_url}{$permohonan_izin->FILE_IZIN}'>{$permohonan_izin->NOMOR_IZIN}</a>)";
			} else if ($permohonan_izin->TGL_PENOLAKAN != NULL) {
				$permohonan_izin->STATUS_STRING = 'Ditolak';
			} else {
				$permohonan_izin->STATUS_STRING = "Proses Evaluasi";
			}

			$base_url = base_url();
			// Edit string
			if($is_need_dokumen_kelengkapan) {
				$lengkapi_url = "Lengkapi_data/process";

				$permohonan_izin->EDIT_STRING = "<a href='{$base_url}{$lengkapi_url}/{$permohonan_izin->ID_PERMOHONAN}'>Lengkapi</a>";   
			} else if($is_need_perusahaan_process) {
				$lengkapi_url = $this->M_proses_skema->get_permohonan_controller_for_perusahaan($permohonan_izin->ID_PERMOHONAN);

				$permohonan_izin->EDIT_STRING = "<a href='{$base_url}{$lengkapi_url}/{$permohonan_izin->ID_PERMOHONAN}'>Proses</a>";              
			} else if ($permohonan_izin->TGL_PENGAJUAN == NULL && $permohonan_izin->TGL_DISETUJUI == NULL) {
				$permohonan_izin->EDIT_STRING = "<a href='{$base_url}Permohonan_izin/edit/{$permohonan_izin->ID_PERMOHONAN}'>Lanjutkan</a>";              
			} else { 
				$permohonan_izin->EDIT_STRING = '-';
			}

			// Hapus string
			if ($permohonan_izin->TGL_PENGAJUAN == NULL && $permohonan_izin->TGL_DISETUJUI == NULL) {
				$permohonan_izin->HAPUS_STRING = "<a href='{$base_url}Permohonan_izin/hapus/{$permohonan_izin->ID_PERMOHONAN}' class='delete-draft'>Batal</a>";  
			} else { 
				$permohonan_izin->HAPUS_STRING = '-';
			}
		}

		// untuk dapat menjaga page next dan back tidak double insert
		//--------------------------------------------------------
		// $this->session->unset_userdata('idPermohonanInserted');

		$this->template->views('Admin/Permohonan_izin/home', $data);
	}

	public function track($kode_track = NULL) {
		$kode_track = full_clean($kode_track);

		$id_permohonan = decrypt_id_permohonan($kode_track);


		if(!$this->is_correct_access_right($id_permohonan)) {
			// If empty, id_permohonan does not belong to id_perusahaan
			http_response_code(403);
			die("Forbidden");
		}

		$this->session->set_flashdata('bypass_captcha_search', TRUE);
		$this->session->set_flashdata('kode_tracking_search', $kode_track);

		redirect("TrackPermohonan/searchLogin");
	}
	
	public function kuesioner($kode_track = NULL, $type = NULL, $file_izin = NULL) {
		$kode_track = full_clean($kode_track);

		$id_permohonan = decrypt_id_permohonan($kode_track);

		if(!$this->is_correct_access_right($id_permohonan)) {
			http_response_code(403);
			die("Forbidden");
		}

		$this->session->set_flashdata('bypass_captcha_search', TRUE);
		$this->session->set_flashdata('kode_tracking_search', $kode_track);
		$this->session->set_flashdata('type', $type);
		$this->session->set_flashdata('file_izin', $file_izin);

		redirect("Kuesioner/doKuesioner");
	}

	public function hari_libur() {
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Jam Kerja";
		$data['deskripsi'] 	= "Jam Kerja";

		$data['work_hour'] = $this->M_working_hours->get_latest_working_hours();

		$this->template->views('Admin/Permohonan_izin/hari_libur', $data);
	}

	public function kswp_error() {
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "KSWP";
		$data['deskripsi'] 	= "KSWP";

		$data['error_messages'] = $this->session->flashdata('kswp_msg');

		if(empty($data['error_messages'])) {
			redirect("Permohonan_izin");
		}

		$this->template->views('Admin/Permohonan_izin/kswp_error', $data);
	}

	public function step1() {
		$id = $this->session->userdata['userdata'];
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['dataDokumenSyarat'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id->ID_PERUSAHAAN);
		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan($id->ID_PERUSAHAAN);
		// $data['modal_add_akta'] = show_my_modal('Admin/Permohonan_izin/Profile_perusahaan/modal_tambah_akta', 'tambah-akta', $data);
		$data['modal_add_akta'] = show_my_modal('Admin/Profile_perusahaan/modal_tambah_akta', 'tambah-akta', $data);
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['dataProvinsi'] = $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] = $this->M_izin_instansi->select_all();
		$data['dataDokumen'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsBU($id->ID_PERUSAHAAN);
		$data['dataNarahubung'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsNarahubung($id->ID_PERUSAHAAN);
		// var_dump($data['userdata']);die();
		$data['allowed_ace_input'] = "['jpg', 'jpeg', 'png', 'pdf']";
		$data['sk_submit_profile'] = $this->M_syarat_ketentuan->get_sk("PROFILE");
		
		$data['profile_form_content'] = $this->load->view('Admin/Profile_perusahaan/profile_form_content', $data, TRUE);

		$this->session->unset_userdata('idPermohonanInserted');
		$this->session->unset_userdata('currentIDPermohonanEdit');
		$this->template->views('Admin/Permohonan_izin/Profile_perusahaan/home', $data);
	}

	public function step2() {
		$currentIDPermohonanEdit = $this->session->userdata("currentIDPermohonanEdit");
		if(!$this->is_valid_add_flow() || !is_null($currentIDPermohonanEdit)) {
			redirect("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}");
		}

		$id = $this->session->userdata['userdata'];

		/*if(!$this->is_kswp_valid($id->ID_PERUSAHAAN)) {
			redirect("Permohonan_izin/kswp_error");
		}*/

		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['dataProvinsi'] = $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] = $this->M_izin_instansi->select_all();
		$data['dataTemplate'] = $this->M_r_template_izin->select_all();
		$data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_izin_instansi();
		$data['dataPrasyarat'] = $this->M_r_persyaratan_izin->select_prayarat_template_izin();
		$data['sk_izin'] = $this->M_syarat_ketentuan->get_sk("IZIN");
		
		$data['modal_sk_permohonan_izin'] = show_my_modal('modal_sk_permohonan_izin', 'form-sk', $data);

		$this->template->views('Admin/Permohonan_izin/step2', $data);

	}



	public function step3() {
		if(!$this->is_valid_add_flow()) {
			$currentIDPermohonanEdit = $this->session->userdata("currentIDPermohonanEdit");
			redirect("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}");
		}

		$data['ID'] = $_POST;
		$post = $this->input->post();

		$id_template = $post['ID_TEMPLATE'];

		$this->session->set_userdata('idTemplate', $id_template);

		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_id($this->session->userdata('idTemplate'));
		
		foreach ($data['dataDokumen'] as $row) {
			$id_skema = $row->ID_SKEMA;
		}
		
		//session untuk menyimpan id_skema
		$this->session->set_userdata('idSkema', $id_skema);

		$data['proses_data'] =  $this->M_r_persyaratan_izin->select_id_skema($id_skema);

		//set id curr proses
		// $this->session->set_userdata('idCurrProses', $data['proses_data']->ID_PROSES);
		// var_dump($id_skema,$this->session->userdata('idCurrProses'));
		// var_dump($data['ID'], $id_skema, $post, $data['id_skema']);die();
		if($this->session->userdata('idPermohonanInserted') == NULL) {
			$new_id_permohonan = $this->M_r_permohonan_izin->insert($data);

			if (!is_null($new_id_permohonan)) {
			//setelah insert berhasil, kita simpan id_permohonan yang baru di insert ke session
			//ambil dulu id_permohonan yang baru di insert 
				$this->session->set_userdata('idPermohonanInserted', $new_id_permohonan);
				$this->session->set_userdata('currentIDPermohonanEdit', $new_id_permohonan);
				
			// var_dump($this->session);
			// echo '</pre>';die();
			}
		}

		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		$data['allowed_ace_input'] = "['pdf']";

		$this->session->set_userdata('currentProsesEdit', 3);

		// Forever redirect, use new view instead
		$currentIDPermohonanEdit = $data['currentIDPermohonanEdit'];
		redirect("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}");
		// $this->template->views('Admin/Permohonan_izin/step3', $data);
	}

	/**
	 * @deprecated Use step4_edit instead.
	 */
	public function step4() {
		if(!$this->is_valid_add_flow()) {
			$currentIDPermohonanEdit = $this->session->userdata("currentIDPermohonanEdit");
			redirect("Permohonan_izin/step4_edit/{$currentIDPermohonanEdit}");
		}

		$post = $this->input->post();
		$data['userdata'] 	= $this->userdata;
		$id = $this->session->userdata['userdata'];
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		// $data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_id($post['ID_FORM']);
		
		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$data['enkriptedQS'] = get_enkriptedQS($data['currentIDPermohonanEdit'], "form_data");

		// var_dump($data['enkriptedQS']);die();

		$this->session->set_userdata('currentProsesEdit', 4);
		$this->template->views('Admin/Permohonan_izin/step4', $data);
	}

	/**
	 * @deprecated use step5_edit instead.
	 */
	public function step5() {
		if(!$this->is_valid_add_flow()) {
			$currentIDPermohonanEdit = $this->session->userdata("currentIDPermohonanEdit");
			redirect("Permohonan_izin/step5_edit/{$currentIDPermohonanEdit}");
		}

		$post = $this->input->post();
		$data['userdata'] 	= $this->userdata;
		// var_dump();die();
		$id = $this->session->userdata['userdata'];
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		$data['sk_permohonan'] = $this->M_syarat_ketentuan->get_sk("PERMOHONAN");
		// $data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_id($post['ID_FORM']);

		$this->session->set_userdata('currentProsesEdit', 5);
		$this->template->views('Admin/Permohonan_izin/step5', $data);
	}

	public function kirimPermohonan(){
		// $id_curr_proses = $this->M_r_persyaratan_izin->select_curr_proses($this->session->userdata('idCurrProses'));
		// $id_proses =  $this->M_r_persyaratan_izin->select_id_skema_nextProses($this->session->userdata('idSkema'), $id_curr_proses);
		
		// var_dump($this->session->userdata('idCurrProses'), $id_proses);die();
		
		// date_default_timezone_set("Asia/Jakarta");
		// $data = array(
			// 	'id_permohonan' => $this->session->userdata('idPermohonanInserted'),
			// 	'tanggal_pengajuan' => date("Y-m-d"),
			// 	// 'id_proses' => $id_proses->urutan
			// 	// 'id_proses' => $id_curr_proses
			// );
			
			
		// $result = $this->M_r_permohonan_izin->updatePermohonan($data);

		if(!$this->is_at_business_day()) {
			redirect("Permohonan_izin/hari_libur");
		}

		/*if(!$this->is_kswp_valid($this->userdata->ID_PERUSAHAAN)) {
			redirect("Permohonan_izin/kswp_error");
		} ==> ditutup sementara selama proses testing */
			
		$id_skema = $this->session->userdata('idSkema');
		// $id_curr_proses = $this->session->userdata('idCurrProses');
		// $id_next_current_proses = $this->M_r_persyaratan_izin->select_id_skema_nextProses($id_skema, $id_curr_proses);

		$id_permohonan = $this->session->userdata('idPermohonanInserted');
		date_default_timezone_set("Asia/Jakarta");
		$tgl_pengajuan = date('Y-m-d H:i:s');

		$id_proses_bpm = $this->send_to_bpm($id_permohonan, $tgl_pengajuan);

		if($id_proses_bpm === FALSE) {
			$this->session->set_flashdata('msg', show_err_msg('Pengiriman gagal, mohon coba lagi.'));	
			redirect("Permohonan_izin/step5_edit/{$id_permohonan}");
			return;
		} else if ($id_proses_bpm === TRUE) {
			$id_proses_bpm = NULL;
		}
		
		$user_info = $this->user_info();
		
		$result = $this->M_r_permohonan_izin->kirim_permohonan($id_permohonan, $tgl_pengajuan, $id_proses_bpm, $user_info);

		if($result == TRUE){
			$dataEmail = array(
				'EMAIL_PERUSAHAAN' => $this->userdata->EMAIL_PERUSAHAAN, 
				'IZIN' => $this->M_r_permohonan_izin->get_nama_template($id_permohonan),
			);

			//$this->kirimEmailPegajuanIzin($dataEmail);
			//$this->notifyInternalUser($id_permohonan);

			$this->session->set_flashdata('msg', show_succ_msg('Permohonan Berhasil dikirim'));	
			redirect('Permohonan_izin');
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Pengiriman gagal, mohon coba lagi.'));	
			redirect("Permohonan_izin/step5_edit/{$id_permohonan}");
			// var_dump($result);
		}
	}

	private function user_info() {
		$this->load->library('user_agent');

		if ($this->agent->is_browser())
		{
		        $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		        $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		        $agent = $this->agent->mobile();
		}
		else
		{
		        $agent = 'Unidentified User Agent';
		}
		
		$user_info['IP_ADDRESS'] = $this->input->ip_address();
		$user_info['BROWSER'] = $agent;
		$user_info['SISTEM_OPERASI'] = $this->agent->platform();
		
		return $user_info;
	}
	
	private function send_to_bpm($id_permohonan, $tgl_pengajuan) {
		$this->load->helper('bpm');
		$data_permohonan = $this->M_r_permohonan_izin->select_by_id_permohonan($id_permohonan);

		// Sementara hanya bisa KIM dulu
		// if($data_permohonan->ID_FORM != '13') {
		// 	return TRUE;
		// }

		//call service
		// $bpdId = "25.4d157674-ea38-4c9c-b8ae-1dc1ac0e78ef"; // Unique per izin
		// $bpdId = "25.94e8c42d-2315-45b5-bd2c-590bb26ddd91"; // KIM
		$bpdId = $this->M_skema_izin->get_bpm_id($data_permohonan->ID_FORM); // UN-COMMENT WHEN READY
		// $branchId = "2063.cea29001-7378-4484-8e24-8ce25aed66e3"; // Sama semua (konstan)
		// $appId = "2066.960b0111-9fbb-4d9d-b173-62a594a21aa0"; // Sama semua (konstan) 
		// $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw=="; // // Sama semua (konstan)
		// vdd($bpdId);
		
		if(empty($bpdId)) {
			return TRUE; // Currently not ready, bypass
		}

		$data = new Permohonan();
		$data->idPermohonan = $data_permohonan->ID_PERMOHONAN; // Wajib
		$data->namaPerusahaan = $this->session->userdata('userdata')->NAMA_PERUSAHAAN; // Wajib
		$data->idPerusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;; // Wajib
		
		$iso_tgl_pengajuan = $tgl_pengajuan;
		$iso_tgl_pengajuan = new DateTime($iso_tgl_pengajuan);
		$iso_tgl_pengajuan->setTimezone(new DateTimeZone('UTC'));
		// $iso_tgl_pengajuan = $iso_tgl_pengajuan->format(DateTime::ISO8601);
		$iso_tgl_pengajuan = $iso_tgl_pengajuan->format('Y-m-d\TH:i:s\Z');;
		
		$data->tglPengajuan = $iso_tgl_pengajuan; // Wajib

		$request = callStartProcessWithData($bpdId, $data);

		if ($request->status == "200") {	
			// echo "Data has been submited<br/>";	
			// echo "Instance ID = ".$request->piid."<br/>";
			// echo "Task ID = ".$request->tkiid."<br/>";
			// echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			return $request->piid;
		} else {
			// echo "Error dari BPM<br>";
			// echo "<font color='red'>";
			// echo $request->status;
			// echo $request->exceptionType;
			// echo $request->errorMessage;
			// echo "</font>";
			return FALSE;
		}
	}

	private function notifyInternalUser($id_permohonan) {
		$data_permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
		$id_form = $data_permohonan_izin->ID_FORM;

		$list_eval = $this->M_r_user_izin_instansi->get_list_user_by_id_form_and_role($id_form, array("EVAL"));
		$list_esln = $this->M_r_user_izin_instansi->get_list_user_by_id_form_and_role($id_form, array("ESLN"));

		sendSingleEmails($list_eval, $list_esln, "Permohonan Izin Baru", "Ada permohonan izin baru diajukan, mohon segera diproses.");
	}

	function kirimEmailPegajuanIzin($data) {
        $ci = get_instance();
        $ci->load->library('email');
        $config = get_smtp_config();
        
        $ci->email->initialize($config);

        $ci->email->from(get_current_email(), 'EBTKE');
        $to = $data['EMAIL_PERUSAHAAN'];
        // $list = array('mnurtannio25@gmail.com');
        $ci->email->to($to);
        $ci->email->subject('Permohonan Izin '.$data['IZIN']);
        $ci->email->message('Data permohonan izin '.$data['IZIN'].' anda telah kami terima, selanjutnya akan diproses oleh evaluator.');
        if ($this->email->send()) {
            // redirect('Permohonan_izin');
        } else {
			// show_error($this->email->print_debugger());
        }
    }

	function get_kabkot(){
		$id=$this->input->post('id');
		$data=$this->M_kabkot->select_by_provinsi($id);
		echo json_encode($data);
	}

	function get_template(){
		$id=$this->input->post('id');
		$data=$this->M_r_template_izin->select_by_izin_instansi($id);
		echo json_encode($data);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_T_Akta_Perusahaan->delete($id);
		// var_dump($this->db->last_query());die();

		if ($result > 0) {
			echo show_succ_msg('Data Akta Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Akta Gagal dihapus', '20px');
		}
	}

	// public function uploadDokumen() {
	// 	$id = $this->session->userdata['userdata'];
	// 	$data = $this->input->post();
	// 	// $id_permohonan = $this->M_r_permohonan_izin->getIdPermohonan($id->ID_PERUSAHAAN);
	// 	$id_permohonan = $this->session->userdata('idPermohonanInserted');
	// 	$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;

	// 	$hitung = count($_FILES['UPLOAD_DOK_SYARAT']['name']);
	// 	$filesArray = $_FILES['UPLOAD_DOK_SYARAT'];
	// 	$z = 0;
	// 	for($i = 0; $i < $hitung; $i++){
	// 		if($filesArray['name'][$i] != ""){
	// 			$unique_key = randomKey(5);
	// 			$_FILES['UPLOAD_DOK_SYARAT']['name'] = $unique_key."_".$filesArray['name'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['type'] = $filesArray['type'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['tmp_name'] = $filesArray['tmp_name'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['error'] = $filesArray['error'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['size'] = $filesArray['size'][$i];			

	// 			$user_folder = "FILE_UPLOAD/".$id_perusahaan."/PERMOHONAN_".$id_permohonan;
	// 			if(!is_dir($user_folder)){
	// 				mkdir($user_folder, 0757, true);
	// 			}

	// 			// $config['upload_path'] 		= './images/';
	// 			$config['upload_path'] 		= $user_folder;
	// 			$config['allowed_types'] 	= 'pdf';

	// 			$this->load->library('upload', $config);

	// 			if (!$this->upload->do_upload('UPLOAD_DOK_SYARAT')){
	// 				$error = array('error' => $this->upload->display_errors());

	// 			}
	// 			else{
	// 				$file = $this->upload->data();
	// 				$document['ID_DOK_SYARAT'][$z] = $data['ID_DOK_SYARAT'][$i];
	// 				$document['ID_PERMOHONAN'] = $id_permohonan;
	// 				$document['DOKUMEN_PERSYARATAN'][$z] = $file['file_name'];
	// 			}
	// 			$z++;
	// 		}
	// 	}
	// 	// var_dump($document, $id_permohonan);die();
	// 	$dok_persyaratan = $this->M_r_permohonan_izin->insertBatch($document);
	// 	// var_dump($document, $dok_persyaratan);die();
	// 	if ($dok_persyaratan > 0 && !isset($error)) {
	// 		// $out['status'] = '';
	// 		$this->session->set_flashdata('msg', show_succ_msg('Data dokumen berhasil diupdate'));	
	// 		redirect('Permohonan_izin/step4');
	// 	} else {
	// 		// $out['status'] = '';
	// 		$this->session->set_flashdata('msg', show_err_msg('Data dokumen gagal diupdate'));		
	// 		redirect("Permohonan_izin/step3_edit/{$id_permohonan}");
	// 	}
	// }

	public function uploadDokumenPersyaratan() {
		$id_permohonan = $this->session->userdata('idPermohonanInserted');
		$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;
		$user_folder = get_path_upload_permohonan($id_perusahaan, $id_permohonan);

		if(!is_dir($user_folder)){
			mkdir($user_folder, 0757, true);
		}

		$this->doUpload($id_permohonan, $id_perusahaan, $user_folder);
	}

	private function doUpload($id_permohonan, $id_perusahaan, $user_folder) {
		$uploader = getUploaderInstance($id_perusahaan);

		header("Content-Type: text/plain");

		// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
		$result = $uploader->handleUpload($user_folder);

		$this->recordPersyaratanUpload($result, $uploader);

		echo json_encode($result);
	}

	public function doneUploadingChunks() {
		if (isset($_GET["done"])) {
			$id_permohonan = $this->session->userdata('idPermohonanInserted');
			$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;

			$uploader = getUploaderInstance($id_perusahaan);

			$user_folder = get_path_upload_permohonan($id_perusahaan, $id_permohonan);

			$result = $uploader->combineChunks($user_folder);

			$this->recordPersyaratanUpload($result, $uploader);

			echo json_encode($result);
		}
	}

	private function recordPersyaratanUpload(&$result, $uploader) {
		$file_name = $uploader->getUploadName();
		if(!is_null($file_name) && $result['success'] == TRUE) { // Upload finish and successful
			$id_permohonan = $this->session->userdata('idPermohonanInserted');
			$id_persyaratan = $this->input->post("id");
			$file_name = $result['uuid']."/".$file_name;

			$is_syarat_already_uploaded = $this->M_r_persyaratan_izin->check_if_exist($id_permohonan, $id_persyaratan);

			if($is_syarat_already_uploaded) {
				$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;
				$user_folder = get_path_upload_permohonan($id_perusahaan, $id_permohonan);

				$this->M_r_persyaratan_izin->update_uploded_dokumen($id_permohonan, $id_persyaratan, $file_name, $user_folder);
			} else {
				$this->M_r_persyaratan_izin->insert_dokumen($id_permohonan, $id_persyaratan, $file_name);
			}
		}
	}

	function edit($id_permohonan) {
		// Check if valid id
		if(!$this->is_valid_access($id_permohonan)) {
			redirect('Permohonan_izin');
			return;
		}
		
		$id = $this->session->userdata['userdata'];
		// Set current session
		$this->session->set_userdata('currentIDPermohonanEdit', $id_permohonan);

		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['dataDokumenSyarat'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id->ID_PERUSAHAAN);
		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan($id->ID_PERUSAHAAN);
		$data['modal_add_akta'] = show_my_modal('Admin/Permohonan_izin/Profile_perusahaan/modal_tambah_akta', 'tambah-akta', $data);
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['dataProvinsi'] = $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] = $this->M_izin_instansi->select_all();
		$data['dataDokumen'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsBU($id->ID_PERUSAHAAN);
		$data['dataNarahubung'] = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsNarahubung($id->ID_PERUSAHAAN);
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		// var_dump($data['userdata']);die();
		$data['allowed_ace_input'] = "['jpg', 'jpeg', 'png', 'pdf']";
		$data['sk_submit_profile'] = $this->M_syarat_ketentuan->get_sk("PROFILE");
		
		$data['profile_form_content'] = $this->load->view('Admin/Profile_perusahaan/profile_form_content', $data, TRUE);

		$this->session->set_userdata('currentProsesEdit', 1);
		$this->template->views('Admin/Permohonan_izin/Profile_perusahaan/home', $data);
	}

	public function prosesUpdateEdit($id_permohonan) {
		if(!$this->is_valid_flow($id_permohonan, 2)) {
			redirect('Permohonan_izin');
			return;
		}

		$data = $this->input->post();
		$data['last_update'] = date("Y-m-d H:i:s");
		$result = $this->M_bidder->updateProfile($data);

		$hitung = count($_FILES['DOKUMEN_PERSYARATAN']['name']);
		$filesArray = $_FILES['DOKUMEN_PERSYARATAN'];
		$z = 0;
		for($i = 0; $i < $hitung; $i++){
			if($filesArray['name'][$i] != ""){
				$_FILES['DOKUMEN_PERSYARATAN']['name'] = $filesArray['name'][$i];
				$_FILES['DOKUMEN_PERSYARATAN']['type'] = $filesArray['type'][$i];
				$_FILES['DOKUMEN_PERSYARATAN']['tmp_name'] = $filesArray['tmp_name'][$i];
				$_FILES['DOKUMEN_PERSYARATAN']['error'] = $filesArray['error'][$i];
				$_FILES['DOKUMEN_PERSYARATAN']['size'] = $filesArray['size'][$i];			

				$config['upload_path'] 		= "FILE_UPLOAD/".$data['ID_PERUSAHAAN']."/DOKUMEN_PERUSAHAAN/DOKUMEN_PERSYARATAN";
				$config['allowed_types'] 	= 'pdf|png|jpg|jpeg';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('DOKUMEN_PERSYARATAN')){
					$error = array('error' => $this->upload->display_errors());

				}
				else{
					$file = $this->upload->data();
					$document['DOKUMEN_PERSYARATAN'][$z] = $file['file_name'];
					$document['ID_PERUSAHAAN'] = $data['ID_PERUSAHAAN'];
					$document['NOMOR'][$z] = $data['NOMOR'][$i];
					$document['TGL_DOKUMEN'][$z] = $data['TGL_DOKUMEN'][$i];
					$document['TGL_KEDALUARSA'][$z] = $data['TGL_KEDALUARSA'][$i];
					$document['ID_DOK_SYARAT'][$z] = $data['ID_DOK_SYARAT'][$i];
					$document['TGL_UPLOAD'][$z] = $data['TGL_UPLOAD'][$i];
				}
				$z++;
			}
		}
		$dok_persyaratan = $this->M_Dokumen_Syarat_Perusahaan->insertBatch($document);
		$data_dokumen = $this->M_Dokumen_Syarat_Perusahaan->update($data);

		if ($dok_persyaratan > 0 && $result > 0 && !isset($error)) {
			// $out['status'] = '';
			$this->session->set_flashdata('msg', show_succ_msg('Data Perusahaan Berhasil diupdate'));	
			redirect("Permohonan_izin/step2_edit/{$id_permohonan}");
		} else {
			// $out['status'] = '';
			$this->session->set_flashdata('msg', show_err_msg('Data Perusahaan Gagal diupdate'));		
			redirect('Permohonan_izin/step1');
		}
	}

	public function step2_edit($id_permohonan) {
		if(!$this->is_valid_flow($id_permohonan, 2)) {
			redirect('Permohonan_izin');
			return;
		}

		$id = $this->session->userdata['userdata'];

		/*if(!$this->is_kswp_valid($id->ID_PERUSAHAAN)) {
			redirect("Permohonan_izin/kswp_error");
		}*/

		$id_permohonan = $this->session->userdata("currentIDPermohonanEdit");
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['dataProvinsi'] = $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] = $this->M_izin_instansi->select_all();
		$data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_izin_instansi();
		$data['dataDokumenPrs'] = $this->M_r_permohonan_izin->select_by_id_permohonan($id_permohonan);
		$idForm = $data['dataDokumenPrs']->ID_FORM;
		$data['dataTemplate'] = $this->M_r_template_izin->select_by_izin_instansi($idForm);
		$data['dataTemplateAll'] = $this->M_r_template_izin->select_all();;
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		$data['sk_izin'] = $this->M_syarat_ketentuan->get_sk("IZIN");

		$data['modal_sk_permohonan_izin'] = show_my_modal('modal_sk_permohonan_izin', 'form-sk', $data);

		$this->session->set_userdata('currentProsesEdit', 2);
		$this->template->views('Admin/Permohonan_izin/step2_edit', $data);

	}

	public function step3_edit($id_permohonan) {
		if(!$this->is_valid_flow($id_permohonan, 3)) {
			redirect('Permohonan_izin');
			return;
		}
		
		$current_id_template = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan)->ID_TEMPLATE;

		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$post = $this->input->post();
			$id_template = $post["ID_TEMPLATE"];

			if($id_template != $current_id_template) {
				$id_skema = $this->M_izin_instansi->select_by_id($post["ID_FORM"])->ID_SKEMA;
				$curr_urutan_proses =  $this->M_r_persyaratan_izin->select_id_skema($id_skema)->URUTAN;
				
				$updateData = array(
					"ID_FORM" => $post["ID_FORM"],
					"ID_TEMPLATE" => $id_template,
					"CURR_URUTAN_PROSES" => $curr_urutan_proses
				);
				$result = $this->M_r_permohonan_izin->update_jenis_izin($id_permohonan, $updateData);

				if($result === TRUE) {
					$this->delete_permohonan_dokumen($id_permohonan);
				}
			}

		}

		if(!isset($id_template)) { // If not submiting step 2, above POST code will not be called
			$id_template = $current_id_template;
		}

		$id_permohonan = $this->session->userdata("currentIDPermohonanEdit");
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['dataDokumen'] = $this->M_r_persyaratan_izin->select_current_dokumen_list_by_id_permohonan($id_permohonan, $id_template);
		
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		// $data['ID'] = $_POST;
		
		// foreach($data['dataDokumen'] as $syarat) {
		// 	if($data['currentDataDokumen'])
		// }
		
		// var_dump($data['dataDokumen']);die();
		// if($this->session->userdata('idPermohonanInserted') == NULL) {
		// 	// $result = $this->M_r_permohonan_izin->insert($data);

		// 	if ($result === FALSE) {
		// 	//TODO: Print error message here
		// 	//setelah insert berhasil, kita simpan id_permohonan yang baru di insert ke session
		// 	//ambil dulu id_permohonan yang baru di insert 
		// 		// $id_permohonan = $this->db->insert_id();

		// 		// $this->session->set_userdata('idPermohonanInserted', $id_permohonan);
		// 	// echo '<pre>';
		// 	// var_dump($this->session);
		// 	// echo '</pre>';die();
		// 	}
		// }
		
		// Session set
		// if(!isset($id_curr_proses) || !isset($id_skema) ) { // If not submiting step 2, above POST code will not be called
		if(!isset($id_skema) ) { // If not submiting step 2, above POST code will not be called
			$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
			$id_skema = $this->M_izin_instansi->select_by_id($permohonan_izin->ID_FORM)->ID_SKEMA;
			// $id_curr_proses = $permohonan_izin->ID_CURR_PROSES;
		}

		$data['allowed_ace_input'] = "['pdf']";

		// $this->session->set_userdata('idCurrProses', $id_curr_proses);
		$this->session->set_userdata('idSkema', $id_skema);
		$this->session->set_userdata('idPermohonanInserted', $id_permohonan);

		$this->session->set_userdata('currentProsesEdit', 3);

		$data = $this->prepare_detail_permohonan($data, $id_permohonan);	

		$this->template->views('Admin/Permohonan_izin/step3_edit', $data);
	}

	public function step4_edit($id_permohonan) {
		if(!$this->is_valid_flow($id_permohonan, 4)) {
			redirect('Permohonan_izin');
			return;
		}

		if(!$this->all_syarat_uploaded($id_permohonan)) {
			$this->session->set_flashdata('msg', show_err_msg('Mohon lengkapi file persyaratan terlebih dahulu.'));		
			$currentIDPermohonanEdit = $this->session->userdata("currentIDPermohonanEdit");
			redirect("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}");
			return;
		}

		$post = $this->input->post();
		$data['userdata'] 	= $this->userdata;
		$id = $this->session->userdata['userdata'];
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		// $data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_id($post['ID_FORM']);

		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$data['enkriptedQS'] = get_enkriptedQS($data['currentIDPermohonanEdit'], "form_data");

		$this->session->set_userdata('currentProsesEdit', 4);

		$data = $this->prepare_detail_permohonan($data, $id_permohonan);

		$this->template->views('Admin/Permohonan_izin/step4_edit', $data);
	}

	
	public function step5_edit($id_permohonan) {
		if(!$this->is_valid_flow($id_permohonan, 5)) {
			redirect('Permohonan_izin');
			return;
		}

		if(!$this->M_formgen->data_is_filled($id_permohonan)) {
			$this->session->set_flashdata('msg', show_err_msg('Mohon lengkapi data terlebih dahulu.'));		
			redirect("Permohonan_izin/step4_edit/{$id_permohonan}");
			return;
		}

		$post = $this->input->post();
		$data['userdata'] 	= $this->userdata;
		// var_dump();die();
		$id = $this->session->userdata['userdata'];
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['page'] 		= "permohonan_izin";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['currentIDPermohonanEdit'] = $this->session->userdata("currentIDPermohonanEdit");
		$data['sk_permohonan'] = $this->M_syarat_ketentuan->get_sk("PERMOHONAN");
		// $data['dataDokumen'] = $this->M_r_persyaratan_izin->select_by_id($post['ID_FORM']);
		
		// var_dump($this->session->userdata());
		$this->session->set_userdata('currentProsesEdit', 5);
		
		$data = $this->prepare_detail_permohonan($data, $id_permohonan);
		$this->template->views('Admin/Permohonan_izin/step5_edit', $data);
	}

	function hapus($id_permohonan = NULL) {
		//TODO: Check if ID belong to user. DONE.
		// Check if valid id
		if(!$this->is_valid_access($id_permohonan)) {
			redirect('Permohonan_izin');
			return;
		}

		$this->delete_permohonan_dokumen($id_permohonan);

		$result = $this->M_r_permohonan_izin->hapusPermohonan($id_permohonan);

		if ($result >0){
			redirect('Permohonan_izin');
		}
	}

	// public function uploadDokumenEdit($id_permohonan) {
	// 	if(!$this->is_valid_flow($id_permohonan, 4)) {
	// 		redirect('Permohonan_izin');
	// 		return;
	// 	}

	// 	$id = $this->session->userdata['userdata'];
	// 	$post_data = $this->input->post();
	// 	// $id_permohonan = $this->M_r_permohonan_izin->getIdPermohonan($id->ID_PERUSAHAAN);
	// 	$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;

	// 	// Prepare data list
	// 	$id_template = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan)->ID_TEMPLATE;
	// 	$izin_data = $this->M_r_persyaratan_izin->select_current_dokumen_list_by_id_permohonan($id_permohonan, $id_template);
		
	// 	$currently_uploaded_id_persyaratan = array();
	// 	$currently_uploaded_name = array();
	// 	foreach($izin_data as $document) {
	// 		if(!is_null($document->ID_DOKUMEN_PERMOHONAN)) {
	// 			array_push($currently_uploaded_id_persyaratan, $document->ID_PERSYARATAN);
	// 			$currently_uploaded_name[$document->ID_PERSYARATAN] = $document->FILE_PERSYARATAN;
	// 		}
	// 	}

	// 	$update_list = array();
	// 	// $new_list = array();

	// 	$hitung = count($_FILES['UPLOAD_DOK_SYARAT']['name']);
	// 	$filesArray = $_FILES['UPLOAD_DOK_SYARAT'];
	// 	for($i = 0; $i < $hitung; $i++){
	// 		if($filesArray['name'][$i] != "") {
	// 			$upload_id_persyaratan = $post_data["ID_DOK_SYARAT"][$i];

	// 			// $new_data = array($upload_id_persyaratan, $filesArray['name'][$i]);
	// 			$new_data = $upload_id_persyaratan;
	// 			if(in_array($upload_id_persyaratan, $currently_uploaded_id_persyaratan)) {
	// 				array_push($update_list, $new_data);
	// 			} /*else {
	// 				array_push($new_list, $new_data);
	// 			}*/
	// 		}
	// 	}

	// 	// var_dump($update_list);
	// 	// var_dump($new_list);
	// 	// var_dump($_FILES['UPLOAD_DOK_SYARAT']);
		
	// 	$hitung = count($_FILES['UPLOAD_DOK_SYARAT']['name']);
	// 	$filesArray = $_FILES['UPLOAD_DOK_SYARAT'];
		
	// 	for($i = 0; $i < $hitung; $i++){
	// 		if($filesArray['name'][$i] != ""){
	// 			$unique_key = randomKey(5);
	// 			$new_file_name = $unique_key."_".$filesArray['name'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['name'] = $new_file_name;
	// 			$_FILES['UPLOAD_DOK_SYARAT']['type'] = $filesArray['type'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['tmp_name'] = $filesArray['tmp_name'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['error'] = $filesArray['error'][$i];
	// 			$_FILES['UPLOAD_DOK_SYARAT']['size'] = $filesArray['size'][$i];

	// 			$user_folder = "FILE_UPLOAD/".$id_perusahaan."/PERMOHONAN_".$id_permohonan;
	// 			if(!is_dir($user_folder)){
	// 				mkdir($user_folder, 0757, true);
	// 			}

	// 			$config['upload_path'] 		= $user_folder;
	// 			$config['allowed_types'] 	= 'pdf';

	// 			$this->load->library('upload', $config);

	// 			if (!$this->upload->do_upload('UPLOAD_DOK_SYARAT')){
	// 			// if (false){
	// 				$error = array('error' => $this->upload->display_errors());
	// 				// var_dump($error);
	// 			}
	// 			else{
	// 				$file = $this->upload->data();
	// 				// var_dump($post_data['ID_DOK_SYARAT'][$i]);
	// 				$uploaded_id_persyaratan = $post_data['ID_DOK_SYARAT'][$i];

	// 				if(in_array($uploaded_id_persyaratan, $update_list)) {
	// 					unlink("{$user_folder}/{$currently_uploaded_name[$uploaded_id_persyaratan]}");
	// 					$this->M_r_persyaratan_izin->update_uploded_dokumen($id_permohonan, $uploaded_id_persyaratan, $file['file_name']);
	// 					// var_dump("Update", $id_persyaratan, $file_name);
	// 				} else {
	// 					$new_insert_data['ID_DOK_SYARAT'] = $uploaded_id_persyaratan;
	// 					$new_insert_data['ID_PERMOHONAN'] = $id_permohonan;
	// 					$new_insert_data['DOKUMEN_PERSYARATAN'] = $file['file_name'];
	// 					$this->M_r_permohonan_izin->insert_dokumen($new_insert_data);
	// 					// var_dump($new_insert_data);
	// 				}
	// 			}
	// 		}
	// 	}
		
	// 	// die();
	// 	// Update and Delete file

	// 	// Insert
	// 	// $dok_persyaratan = $this->M_r_permohonan_izin->insert_dokumen($document);

	// 	if (!isset($error)) {
	// 		// $out['status'] = '';
	// 		$this->session->set_flashdata('msg', show_succ_msg('Data dokumen berhasil diupdate'));	
	// 		redirect("Permohonan_izin/step4_edit/{$id_permohonan}");
	// 	} else {
	// 		// $out['status'] = '';
	// 		$this->session->set_flashdata('msg', show_err_msg('Data dokumen gagal diupdate'));		
	// 		redirect("Permohonan_izin/step3_edit/{$id_permohonan}");
	// 	}
	// }

	// Private helper class

	private function all_syarat_uploaded($id_permohonan) {
		// Prepare data list
		$id_template = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan)->ID_TEMPLATE;
		$izin_data = $this->M_r_persyaratan_izin->select_current_dokumen_list_by_id_permohonan($id_permohonan, $id_template);

		$currently_uploaded_id_persyaratan = array();
		$required_list = array();
		foreach($izin_data as $document) {
			if(!is_null($document->ID_DOKUMEN_PERMOHONAN)) {
				array_push($currently_uploaded_id_persyaratan, $document->ID_PERSYARATAN);
			}

			if($document->IS_MANDATORY == "Y") {
				array_push($required_list, $document->ID_PERSYARATAN);
			}
		}
		$containAllNeeded = empty(array_diff($required_list, $currently_uploaded_id_persyaratan));

		return $containAllNeeded;
	}

	private function is_valid_add_flow() {
		return ($this->session->userdata('idPermohonanInserted') == NULL);
	}

	// This also check IF the permohonan is not yet subbmited!
	private function is_valid_access($id_permohonan) {
		$id_perusahaan = $this->session->userdata['userdata']->ID_PERUSAHAAN;
		$check = $this->M_r_permohonan_izin->check_permohonan($id_perusahaan, $id_permohonan);
		return !empty($check);
	}

	private function is_correct_access_right($id_permohonan) {
		$id_perusahaan = $this->session->userdata['userdata']->ID_PERUSAHAAN;
		$check = $this->M_r_permohonan_izin->check_access_right($id_perusahaan, $id_permohonan);
		return !empty($check);
	}

	private function is_valid_flow($id_permohonan, $target_page) {
		$id_permohonan_session = $this->session->userdata("currentIDPermohonanEdit");
		
		$is_null = is_null($id_permohonan_session);
		if($is_null) {
			// Session is not set
			return false;
		}

		if($id_permohonan_session != $id_permohonan) {
			// Session and URL does not match
			return false;
		}

		if(!$this->is_valid_access($id_permohonan)) {
			// If empty, id_permohonan does not belong to id_perusahaan
			return false;
		}
		
		$current_page = $this->session->userdata('currentProsesEdit');

		if($target_page - 1 > $current_page) {
			// Page jump forward not allowed
			// -1 is next page. Allow.
			return false;
		}

		return true;
	}

	private function delete_permohonan_dokumen($id_permohonan) {
		$userdata = $this->session->userdata['userdata'];
		$folder_perusahaan = get_path_upload_permohonan($userdata->ID_PERUSAHAAN, $id_permohonan);

		try {
			deleteAllInsideDirectory($folder_perusahaan);
			// array_map('unlink', glob("$folder_perusahaan/*"));

			if(is_dir($folder_perusahaan)) {
				rmdir($folder_perusahaan);
			}

			$delete_status = $this->M_r_permohonan_izin->delete_dokumen($id_permohonan);

			if($delete_status != FALSE) {
				// Ok.
			}
		} catch (Exception $err) {
			// Not a directory
		}
	}

	private function delete_specific_dokumen($id_permohonan, $id_persyaratan) {
		$userdata = $this->session->userdata['userdata'];
		$file_data = $this->M_r_permohonan_izin->get_file_data($id_permohonan, $id_persyaratan);
		$id_dokumen_permohonan = $file_data->ID_DOKUMEN_PERMOHONAN;
		$file_name = $file_data->FILE_PERSYARATAN;

		$path_file = get_path_upload_permohonan($userdata->ID_PERUSAHAAN, $id_permohonan, $file_name);
		
		$result = unlink($path_file);
		
		if($result == FALSE) {
			return FALSE;
		}

		$delete_status = $this->M_r_permohonan_izin->delete_permohonan_dokumen($id_dokumen_permohonan);

		// $delete_status will return an object on success
		if($delete_status != FALSE) {
			return TRUE;
		}

		return FALSE;
	}

	public function hapus_file_persyaratan($id_permohonan, $id_persyaratan) {
		if(!$this->is_valid_flow($id_permohonan, 3)) {
			redirect('Permohonan_izin');
			return;
		}

		$status = $this->delete_specific_dokumen($id_permohonan, $id_persyaratan);
		
		echo $status;

		redirect("Permohonan_izin/step3_edit/{$id_permohonan}");
	}

	public function download_persyaratan() {
		$id_permohonan 		= $this->session->userdata("currentIDPermohonanEdit");
		// Check if valid id
		if(!$this->is_valid_access($id_permohonan)) {
			redirect('Permohonan_izin');
			return;
		}
		
		$requested_id_persyaratan = $this->input->get("file", TRUE);
		$requested_file_data 	= $this->M_r_permohonan_izin->get_file_data($id_permohonan, $requested_id_persyaratan);

		if(is_null($requested_file_data)) {
			redirect("Permohonan_izin");
			return;
		}

		$id_perusahaan 		= $this->session->userdata('userdata')->ID_PERUSAHAAN;
		$requested_file_name 	= $requested_file_data->FILE_PERSYARATAN;
		$path_to_file = get_path_upload_permohonan($id_perusahaan, $id_permohonan, $requested_file_name);
		
		// $file_alias = substr($requested_file_name, 6); //TODO: Mask this?
		$file_alias = explode("/", $requested_file_name);
		set_file_download($path_to_file, $file_alias[1]);
	}

	private function is_kswp_valid($id_perusahaan) {
		$npwp = $this->get_npwp($id_perusahaan);

		if($npwp === FALSE) {
			return FALSE;
		}

		$kswp_response = $this->check_kswp($npwp);

		if($kswp_response->status === TRUE) {
			return TRUE;
		} else {
			$this->session->set_flashdata('kswp_msg', $kswp_response->human_readable);
			return FALSE;
		}
	}

	private function get_npwp($id_perusahaan) {
		$data_dokumen = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan);
		
		$npwp_data = NULL;
		foreach($data_dokumen as $key => $value) {
			if(strtoupper($value->DOKUMEN_PERSYARATAN) == "NPWP") {
				$npwp_data = $data_dokumen[$key];
				break;
			} 
		}

		if(is_null($npwp_data)) {
			// echo "Tidak ada data NPWP.";
			// return new KSWPResponse(FALSE, "NO NPWP", "Mohon masukkan nomor NPWP");
			return FALSE;
		}

		$nomor_npwp = $npwp_data->NOMOR;
		$nomor_npwp = preg_replace("/[^0-9]/", "", $nomor_npwp);

		return $nomor_npwp;
	}

	// KSWP
	private function check_kswp($npwp = NULL) {
		$curl = curl_init();

		$this->load->config('minerba_service');

		$username = $this->config->item("kswp_username");
		$pasword = $this->config->item("kswp_password");
		$kswp_service_port = $this->config->item("kswp_port");
		$kswp_service_url = $this->config->item("kswp_url");
		
		$npwp = preg_replace("/[^0-9]/", "", $npwp);

		$request_body = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ksw=\"http://KswpService\">\r\n   <soapenv:Header/>\r\n   <soapenv:Body>\r\n      <ksw:CekDataKswp>\r\n         <parameterInput>\r\n            <username>%s</username>\r\n            <password>%s</password>\r\n            <npwp>%s</npwp>\r\n            <kode_izin></kode_izin>\r\n         </parameterInput>\r\n      </ksw:CekDataKswp>\r\n   </soapenv:Body>\r\n</soapenv:Envelope>";
		$request_body = sprintf($request_body, $username, $pasword, $npwp);

		curl_setopt_array($curl, array(
		CURLOPT_PORT => $kswp_service_port,
		CURLOPT_URL => $kswp_service_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $request_body,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: text/xml",
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		// Debug mode
		ini_set('xdebug.var_display_max_depth', '-1');
		ini_set('xdebug.var_display_max_children', '-1');
		ini_set('xdebug.var_display_max_data', '-1');

		$kswp_response = new KSWPResponse(FALSE, "Unknown Error", "Mohon maaf, terdapat gangguan pada sistem KSWP");

		if ($err) {
			// echo "cURL Error #:" . $err;
			$kswp_response = new KSWPResponse(FALSE, $err, "Mohon maaf, sistem KSWP tidak dapat diakses");
		} else if($http_code != 200) {
			$kswp_response = new KSWPResponse(FALSE, "HTTP STATUS : {$http_code}", "Mohon maaf, sistem KSWP mengalami gangguan");
		} else {
			// echo $response;
			// return new KSWPResponse(FALSE, $err);
			$clean_xml = str_ireplace(['soapenv:', 'NS1:', 'xmlns:'], '', $response);
			$result = simplexml_load_string($clean_xml);
			$paramater_output = $result->Body->CekDataKswpResponse->parameterOutput;
			$status = (string)$paramater_output->status;

			if($status == 'true') {
				$data_kswp = $paramater_output->DataKswp;

				$valid_status = (string)$data_kswp->status;
				$nama_wajib_pajak = (string)$data_kswp->nama;

				if($valid_status == 'VALID') {
					$kswp_response = new KSWPResponse(TRUE, "KSWP VALID", "KSWP anda valid");
				} else if($valid_status == "NOT VALID" && !empty($nama_wajib_pajak)){
					$kswp_response = new KSWPResponse(FALSE, "KSWP REGISTERED BUT KSWP STATUS NOT VALID", "Status NPWP Anda Tidak Valid, Mohon Menghubungi Kantor Pajak Terdekat");
				} else {
					$kswp_response = new KSWPResponse(FALSE, "KSWP NOT REGISTERED", "NPWP Anda tidak terdaftar");
				}
			}
		}

		return $kswp_response;
	}

	private function is_at_business_day() {
		enable_carbon();

		$carbon_now = Carbon::now();

		if(!$carbon_now->isBusinessDay()) {
			return FALSE;
		}

		$hours_data = $this->M_working_hours->get_latest_working_hours();

		$start_hour = Carbon::createFromTimeString($hours_data->START_HOUR, 'Asia/Jakarta');
		$end_hour = Carbon::createFromTimeString($hours_data->END_HOUR, 'Asia/Jakarta');

		if($carbon_now->greaterThan($start_hour) && $carbon_now->lessThan($end_hour)) {
			return TRUE;
		}

		return FALSE;
	}

	private function prepare_detail_permohonan($data, $id_permohonan) {
		$data_permohonan_izin = $this->M_r_permohonan_izin->select_by_id_permohonan($id_permohonan);		
		$data_template = $this->M_izin_instansi->select_template($data_permohonan_izin->ID_TEMPLATE);
		$data_form = $this->M_izin_instansi->select_by_id($data_template->ID_FORM);

		$data['data_template'] = $data_template;
		$data['data_form'] = $data_form;

		$data['detail_data_permohonan'] = $this->load->view('Admin/Permohonan_izin/data_pengajuan_permohonan', $data, TRUE);		

		return $data;
	}
}