<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout {
	public $ID_LAYOUT;
	public $ID_PERMOHONAN;
	public $URUTAN;
	public $LAYOUT;
	public $PAGE_SIZE;
	public $ORIENTATION;
}

class Permohonan_izin_atas extends AUTHADMIN_Controller {
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
		$this->load->model('M_dokumen_pelengkap');
		$this->load->model('M_minerba_bkpm');

		if($this->userdata->ID_ROLE == "EVAL") {
			redirect("Permohonan_izin_eval");
			return;
		}

		// commented by rendra
		// if($this->userdata->ID_ROLE == "ADM") {
		// 	http_response_code(403);
		// 	die("Forbidden");
		// 	redirect("Beranda");
		// }
	}

	public function index() {
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;
		$data['id_role'] = $id_role;
		$data['page'] 		= "permohonan_izin_atas";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);

		if (isset($_POST['NAMA_PERUSAHAAN']) && $_POST['NAMA_PERUSAHAAN'] != NULL) {
			$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_nama($this->userdata, $_POST['NAMA_PERUSAHAAN']);
		} else if (isset($_POST['BULAN']) && $_POST['BULAN'] != NULL) {
			$data1 = $_POST['TAHUN'];
			$data2 = $_POST['BULAN'];

			$date = $data1 . ' ' . $data2;

			$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_tanggal($this->userdata, $date);
		} else if (isset($_POST['NAMA_PERUSAHAAN']) && $_POST['NAMA_PERUSAHAAN'] != NULL && isset($_POST['BULAN']) && $_POST['BULAN'] != NULL) {
			$data1 = $_POST['TAHUN'];
			$data2 = $_POST['BULAN'];

			$date = $data1 . ' ' . $data2;

			$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_nama_tahun($id_role, $date, $_POST['NAMA_PERUSAHAAN']);
		} else {
			$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan_eval($this->userdata);
		}

		$this->re_order_current_job($data['dataPermohonan_izin']);
		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->get_process_description($data['dataPermohonan_izin']);
		$this->get_sla_left($data['dataPermohonan_izin']);

		$current_job_data = $this->M_r_permohonan_izin->current_job($this->userdata);
		$data['periksa_string'] = empty($current_job_data) ? "Evaluasi Permohonan" : "Lanjutkan Evaluasi Permohonan";		

		$this->session->unset_userdata('idPermohonan');

		$this->template->views('Admin/Permohonan_izin_atas/home_eval', $data);
	}

	private function get_sla_left(&$list_permohonan) {
		$this->M_r_permohonan_izin->get_sla_left($list_permohonan);

		foreach($list_permohonan as $permohonan) {
			if($permohonan->SLA_DATA->IS_LATE == TRUE) {
				$permohonan->SLA_DATA->SLA_STRING = "<span class='label bg-red'>Melebihi - {$permohonan->SLA_DATA->DIFF_DATE} Hari</span>";
			} else if($permohonan->SLA_DATA->DIFF_DATE == 0) {
				$permohonan->SLA_DATA->SLA_STRING = "<span class='label bg-yellow'>Hari ini</span>";
			} else if($permohonan->SLA_DATA->DIFF_DATE < 4) {
				$permohonan->SLA_DATA->SLA_STRING = "<span class='label bg-yellow'>Kurang - {$permohonan->SLA_DATA->DIFF_DATE} Hari</span>";
			} else {
				$permohonan->SLA_DATA->SLA_STRING = "{$permohonan->SLA_DATA->DIFF_DATE} Hari";
			}
		}
	}

	private function re_order_current_job(&$work_list) {
		$current_job_data = $this->M_r_permohonan_izin->current_job($this->userdata);

		if(empty($current_job_data)) {
			return;
		}

		foreach ($work_list as $key => $work) {
			if($work->ID_PERMOHONAN == $current_job_data->ID_PERMOHONAN) {
				move_element_to_top($work_list, $key);
				return;
			}
		}
	}

	function get_arsip() {
		$list_id_form = $this->M_r_user_izin_instansi->get_list_id_form_by_id_user($this->userdata->ID_USER);
		$list = $this->M_r_permohonan_izin->get_datatables($list_id_form);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			// $row[] = $field->ID_PERMOHONAN; // DEBUG
			$base_izin_url = get_izin_pdf_url();
			$file_izin_link = "<a target='_blank' href='{$base_izin_url}{$field->FILE_IZIN}'>{$field->NOMOR_IZIN}</a>";
			$row[] = $file_izin_link;
			$row[] = $field->TGL_DISETUJUI;
			$row[] = $field->NAMA_PERUSAHAAN;
			$row[] = $field->NAMA_FORM;
			$detail_izin_link = "<a class='btn btn-info btn-minier' href='".base_url("Permohonan_izin_atas/arsip_detail/{$field->ID_PERMOHONAN}")."'><i class='glyphicon glyphicon-info-sign'></i> Detail</a>";
			$row[] = $detail_izin_link;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_r_permohonan_izin->count_all(),
			"recordsFiltered" => $this->M_r_permohonan_izin->count_filtered($list_id_form),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function arsip_detail($id_permohonan = NULL) {
		if(!$this->is_valid_arsip_access($id_permohonan)) {
			redirect("Permohonan_izin_atas/arsip");
			return;
		}

		$id = $id_permohonan;
		$this->session->set_userdata('idPermohonan', $id);
		$data['page'] 		= "arsip_izin";
		$data['judul'] 		= "Detail Permohonan Izin";
		$data['deskripsi'] 	= "Arsip Permohonan Izin / Non perizinan";

		$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
		$id_perusahaan 					= $this->M_r_permohonan_izin->select_idPerusahaan($id);

		$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
		$data['userdata'] 				= $this->userdata;
		$data['dataDokumenSyarat'] 		= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan->ID_PERUSAHAAN);
		$data['dataPermohonan_izin'] 	= $this->M_r_permohonan_izin->select_by_perusahaan($id);
		$data['id_permohonan']			= $id;
		
		$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id_perusahaan->ID_PERUSAHAAN);
		$data['dataProvinsi'] 			= $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] 		= $this->M_izin_instansi->select_all();
		$data['dataDokumen'] 			= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan->ID_PERUSAHAAN);
		$data['dataAkta'] 				= $this->M_T_Akta_Perusahaan->select_by_perusahaan($id_perusahaan->ID_PERUSAHAAN);
		$data['everApproved']			= $this->M_r_permohonan_izin->everApproved($id);
		$data['dataDokumenEval'] 		= $this->M_r_persyaratan_izin->select_by_id_eval($id_perusahaan->ID_PERUSAHAAN, $id_perusahaan->ID_PERMOHONAN);

		//check apakah id tracking sudah ada
		// $tracking_data 					= $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id);
		// var_dump($tracking_data); die();
		
		// $id_curr_proses 				= $this->M_r_permohonan_izin->getIdCurrProses($id);

		// var_dump($this->session->userdata());
		// TODO: Move this somewhere else?
		// $id_check_proses = $this->M_r_permohonan_izin->select_current_role_proses($this->userdata->ID_ROLE, $id);
		
		$data_catatan = $this->M_r_permohonan_izin->select_latest_catatan_perusahaan($id);
		$data['data_catatan'] = $data_catatan;
		$data['tambah_kesimpulan_url'] = "Permohonan_izin_atas";
		$data['cat_kesimpulan']			= $this->M_r_permohonan_izin->get_latest_catatan_kesimpulan($id);
		
		// if(empty($tracking_data)) {
		// 	$dataTracking = array(
		// 		'ID_PROSES' 		=> $id_check_proses,
		// 		'ID_USER' 			=> $this->userdata->ID_USER,
		// 		'ID_PERMOHONAN' 	=> $id, 
		// 		'TGL_MULAI_PROSES' 	=> date("Y-m-d H:i:s"), // TODO: At least this.
		// 	);

		// 	$result = $this->M_r_permohonan_izin->insert_tracking($dataTracking);
		// } else {
		// 	// $dataTracking = array(
		// 	// 	'ID_TRACKING_PROSES' 	=> $tracking_data->ID_TRACKING_PROSES,
		// 	// 	'ID_PROSES' 			=> $id_check_proses,
		// 	// 	'ID_USER' 				=> $this->userdata->ID_USER,
		// 	// 	'ID_PERMOHONAN' 		=> $id, 
		// 	// 	// 'TGL_MULAI_PROSES' 		=> date("Y-m-d H:i:s"), // TODO: At least this. TODO: Ini gak usah di update kan?
		// 	// );
			
		// 	// $result = $this->M_r_permohonan_izin->update_tracking($dataTracking);
		// 	$result = 1; // Assume OK.
		// }

		$data = $this->prepare_alasan_data($data, FALSE, FALSE);

		$this->template->views('Admin/Permohonan_izin_atas/detail_arsip', $data);
	}

	public function arsip() {
		$data['deskripsi'] 	= "Arsip Produk Izin";
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;
		$data['page'] 		= "arsip_izin";
		$data['judul'] 		= "Arsip Produk Izin";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);

		// if (isset($_POST['NAMA_PERUSAHAAN']) && $_POST['NAMA_PERUSAHAAN'] != NULL) {
		// 	$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_nama($this->userdata, $_POST['NAMA_PERUSAHAAN']);
		// } else if (isset($_POST['BULAN']) && $_POST['BULAN'] != NULL) {
		// 	var_dump($_POST);
		// 	$data1 = $_POST['TAHUN'];
		// 	$data2 = $_POST['BULAN'];
		// 	$date = $data1 . ' ' . $data2;

		// 	$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_tanggal($this->userdata, $date);
		// } else if (isset($_POST['NAMA_PERUSAHAAN']) && $_POST['NAMA_PERUSAHAAN'] != NULL && isset($_POST['BULAN']) && $_POST['BULAN'] != NULL) {
		// 	$data1 = $_POST['TAHUN'];
		// 	$data2 = $_POST['BULAN'];

		// 	$date = $data1 . ' ' . $data2;

		// 	$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->filter_nama_tahun($id_role, $date, $_POST['NAMA_PERUSAHAAN']);
		// } else {
		// 	$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_all_disetujui();
		// }
		
		$this->session->unset_userdata('idPermohonan');
		// var_dump($_POST);die();
		// // echo $_POST['TAHUN'];
		$this->template->views('Admin/Permohonan_izin_atas/arsip_produk_izin', $data);
	}

	public function tampil2() {
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;
		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan_eval($this->userdata);

		$data['dataPermohonan_izin'] = $this->M_r_permohonan_izin->select_by_perusahaan_eval($this->userdata);

		// $this->session->unset_userdata('idPermohonan'); TODO: Ask this.

		$this->load->view('Admin/Permohonan_izin_atas/list_data', $data);
	}

	public function periksa_perizinan() {
		$current_job_data = $this->M_r_permohonan_izin->current_job($this->userdata);

		if(!empty($current_job_data)) {
			$id_permohonan_target = $current_job_data->ID_PERMOHONAN;
		} else {
			$job_list = $this->M_r_permohonan_izin->select_by_perusahaan_eval($this->userdata);
			
			if(empty($job_list)) {
				$this->session->set_flashdata('msg', show_err_msg('Tidak ada permohonan izin yang siap diperiksa.'));
				redirect("Permohonan_izin_atas");
				return;
			}

			$first_job = $job_list[0]; // First job will be currently taken/new one
			$id_permohonan_target = $first_job->ID_PERMOHONAN;
		}

		$this->session->set_userdata('idPermohonan', $id_permohonan_target);

		$controller_handler = $this->M_proses_skema->get_permohonan_controller($id_permohonan_target, $this->userdata->ID_ROLE);

		if(empty($controller_handler)) {
			$controller_handler = "Permohonan_izin_atas/step1";
		}

		redirect($controller_handler);
	}

	public function pengembalian() {
		$data['userdata'] 		= $this->userdata;
		$data['id_permohonan'] 	= $this->session->userdata('idPermohonan');
		$data['latest_alasan']	= $this->M_r_permohonan_izin->get_latest_alasan_pengembalian($data['id_permohonan']);

		echo show_my_modal('Admin/Permohonan_izin_atas/modal_pengembalian', 'pengembalian-permohonan', $data);
	}

	public function kembalikan_permohonan() {
		$id_permohonan = $this->session->userdata("idPermohonan");

		if(!$this->is_valid_access_right($id_permohonan)) {
			redirect('Permohonan_izin_atas');
			return;
		}
		$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		// Call BPM
		$this->load->helper('bpm');
		$bpm_status = bpm_process($permohonan_izin->ID_PROSES_BPM, $this->userdata->ID_ROLE, FALSE, TRUE);

		if($bpm_status === FALSE) {
			$this->session->set_flashdata('msg', show_err_msg('Sistem BPM mengalami gangguan, mohon ulangi perintah!'));

			redirect("Permohonan_izin_atas/step1?page=2");
			return;
		}

		$tracking_data = $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
		$id_tracking = $tracking_data->ID_TRACKING_PROSES;

		$alasan_pengembalian = $this->input->post("ALASAN_PENGEMBALIAN");
		$result = $this->M_r_permohonan_izin->kembalikan_permohonan_ke_eval($id_permohonan, $id_tracking, $alasan_pengembalian);
		$this->sendEmailKembalikan($id_permohonan);

		if($result === TRUE) {
			$this->session->set_flashdata('msg', show_succ_msg('Permohonan Izin Berhasil Dikembalikan Ke Evaluator Yang Bersangkutan.'));
			redirect("Permohonan_izin_atas");
			return;
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Permohonan Izin Gagal Dikembalikan Ke Evaluator Yang Bersangkutan.'));
			redirect("Permohonan_izin_atas");
			return;
		}
	}

	private function sendEmailKembalikan($id_permohonan) {
		$curr_iteration = $this->M_r_permohonan_izin->get_current_iteration($id_permohonan);
		$list_user = $this->M_r_permohonan_izin->select_list_approving_iteration($id_permohonan, $curr_iteration - 1); // -1 because in the current state, the curr_iteration have been updated to the next iteration. The updating function is kembalikan_permohonan_ke_eval()

		$subject = "Pengembalian perizinan ke Evaluator";
		$message = "Dengan email ini diinformasikan bahwa ada permohonan izin yang telah anda periksa, dikembalikan ke evaluator.";

		foreach ($list_user as $user) {
			sendEmail($user->EMAIL_USER, $subject, $message);
		}
	}

	/**
	 * @param ID_PERMOHONAN
	 */
	public function step1() {
		$id = $this->session->userdata('idPermohonan'); // ID_PERMOHONAN
		// var_dump($id);
		if(!$this->is_valid_access_right($id)) {
			redirect('Permohonan_izin_atas');
			return;
		}
		
		$data['page'] 		= "permohonan_izin_atas";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";

		$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
		$id_perusahaan 					= $this->M_r_permohonan_izin->select_idPerusahaan($id);

		$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
		$data['userdata'] 				= $this->userdata;
		$data['dataDokumenSyarat'] 		= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan->ID_PERUSAHAAN);
		$data['dataPermohonan_izin'] 	= $this->M_r_permohonan_izin->select_by_perusahaan($id);
		$data['id_permohonan']			= $id;
		$this->session->set_userdata('idPermohonan', $id);
		
		$data['modal_add_akta'] 		= show_my_modal('Admin/Permohonan_izin_atas/Profile_perusahaan/modal_tambah_akta', 'tambah-akta', $data);
		$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id_perusahaan->ID_PERUSAHAAN);
		$data['dataProvinsi'] 			= $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] 		= $this->M_izin_instansi->select_all();
		$data['dataDokumen'] 			= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsBU($id_perusahaan->ID_PERUSAHAAN);
		$data['dataNarahubung'] 		= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocumentsNarahubung($id_perusahaan->ID_PERUSAHAAN);
		$data['dataAkta'] 				= $this->M_T_Akta_Perusahaan->select_by_perusahaan($id_perusahaan->ID_PERUSAHAAN);
		$data['everApproved']			= $this->M_r_permohonan_izin->everApproved($id);
		$data['dataDokumenEval'] 			= $this->M_r_persyaratan_izin->select_by_id_eval($id_perusahaan->ID_PERUSAHAAN, $id_perusahaan->ID_PERMOHONAN);
		
		$data['guide_bg_color'] = $this->M_r_permohonan_izin->getParameterGuide("color",1,$this->userdata->ID_ROLE,$id);
		$data['guide_description'] = str_replace(array("\r","\n")," ",$this->M_r_permohonan_izin->getParameterGuide("description",1,$this->userdata->ID_ROLE,$id));
		
		$data['guide_bg_color2'] = $this->M_r_permohonan_izin->getParameterGuide("color",2,$this->userdata->ID_ROLE,$id);
		$data['guide_description2'] = str_replace(array("\r","\n")," ",$this->M_r_permohonan_izin->getParameterGuide("description",2,$this->userdata->ID_ROLE,$id));
		
		//check apakah id tracking sudah ada
		$tracking_data 					= $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id);
		// var_dump($tracking_data); die();
		
		// $id_curr_proses 				= $this->M_r_permohonan_izin->getIdCurrProses($id);

		// var_dump($this->session->userdata());
		// TODO: Move this somewhere else?
		$id_check_proses = $this->M_r_permohonan_izin->select_current_role_proses($this->userdata->ID_ROLE, $id);
		
		$data_catatan = $this->M_r_permohonan_izin->select_latest_catatan_perusahaan($id);
		$data['data_catatan'] = $data_catatan;
		
		if(empty($tracking_data)) {
			$dataTracking = array(
				'ID_PROSES' 		=> $id_check_proses,
				'ID_USER' 			=> $this->userdata->ID_USER,
				'ID_PERMOHONAN' 	=> $id, 
				'TGL_MULAI_PROSES' 	=> date("Y-m-d H:i:s"), // TODO: At least this.
			);

			$result = $this->M_r_permohonan_izin->insert_tracking($dataTracking);
		} else {
			// $dataTracking = array(
			// 	'ID_TRACKING_PROSES' 	=> $tracking_data->ID_TRACKING_PROSES,
			// 	'ID_PROSES' 			=> $id_check_proses,
			// 	'ID_USER' 				=> $this->userdata->ID_USER,
			// 	'ID_PERMOHONAN' 		=> $id, 
			// 	// 'TGL_MULAI_PROSES' 		=> date("Y-m-d H:i:s"), // TODO: At least this. TODO: Ini gak usah di update kan?
			// );
			
			// $result = $this->M_r_permohonan_izin->update_tracking($dataTracking);
			$result = 1; // Assume OK.
		}
		
		$data['modal_tambah_catatan']		= show_my_modal('Admin/Permohonan_izin_atas/Profile_perusahaan/modal_tambah_catatan', 'tambah-catatan', $data);

		$data['tambah_kesimpulan_url'] = "Permohonan_izin_atas";
		$data['cat_kesimpulan']			= $this->M_r_permohonan_izin->get_latest_catatan_kesimpulan($id);
		$data['modal_tambah_kesimpulan']		= show_my_modal('Admin/modal_tambah_catatan_kesimpulan', 'modal-catatan-kesimpulan', $data, 'lg');

		$data = $this->prepare_detail_permohonan($data, $id);
		$data = $this->prepare_alasan_data($data, TRUE);
		$data = $this->prepare_data_tambahan($data);

		if ($result > 0) {
			$this->template->views('Admin/Permohonan_izin_atas/Profile_perusahaan/home', $data);
		}
	}

	public function step1_page2() {
		$id_permohonan = $this->session->userdata('idPermohonan');

		if(!$this->is_valid_access_right($id_permohonan)) {
			redirect('Permohonan_izin_atas');
			return;
		}

		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$data['enkriptedQS'] = get_enkriptedQS($id_permohonan, "view_pdf");

		$ongoing_proses 				= $this->M_r_permohonan_izin->select_ongoing_process($id_permohonan);
		$data_proses 					= $this->M_r_persyaratan_izin->select_final_ttd($ongoing_proses[0]->ID_PROSES); // Only test at the first proses. When finalizing, the process should only be one.

		if($data_proses->IS_FINAL_TTD != 'Y'){
			$data['button'] = '<button class="btn btn-md btn-success setuju">Proses Selanjutnya</button>';
		} else {
			$data['button'] = '<button class="btn btn-md btn-success pengesahan">Pengesahan</button>';
		}

		$this->load->view('Admin/Permohonan_izin_atas/step1_page2', $data);
	}

	public function riwayatCatatanKesimpulan() {

		$data['userdata'] 	= $this->userdata;

		$id_permohonan		= trim($this->input->post("id"));
		$data['catatan'] 	= $this->M_r_permohonan_izin->select_riwayat_catatan_kesimpulan_permohonan($id_permohonan);

		echo show_my_modal('Admin/modal_riwayat_catatan_kesimpulan', 'riwayat-catatan-kesimpulan', $data);
	}

	public function tambahCatatanKesimpulan() {
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('CATATAN_SIMPULAN', 'Catatan Kesimpulan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$id_permohonan = $this->session->userdata('idPermohonan');
				$post_data = $this->input->post();
		
				$tracking_data = $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
				$id_tracking = $tracking_data->ID_TRACKING_PROSES;

				$data = array(
					"CATATAN_SIMPULAN" =>  $post_data["CATATAN_SIMPULAN"],
				);

				$result = $this->M_r_permohonan_izin->update_catatan_kesimpulan($id_tracking, $data);
				
				if($result === TRUE) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Catatan Berhasil disimpan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Catatan Gagal disimpan', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}

			echo json_encode($out);
		}
	}

	public function tambahCatatanPerusahaan() {
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$id_permohonan = $this->session->userdata('idPermohonan');
			if(!$this->is_valid_access_right($id_permohonan)) {
				$out['status'] = 'EVAL_TAKEN';
				$out['msg'] = show_err_msg('Catatan Gagal disimpan, karena telah dievaluasi oleh Evaluator lain.', '20px');
				$this->session->set_flashdata('msg', show_err_msg('Permohonan Izin, telah dievaluasi oleh Evaluator lain.'));        
				echo json_encode($out);
				return;
			}
			
			$this->form_validation->set_rules('URAIAN', 'Uraian', 'trim|required');

			$post_data = $this->input->post();
			if ($this->form_validation->run() == TRUE) {

				$tracking_data = $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
				$id_tracking = $tracking_data->ID_TRACKING_PROSES;

				$data = array(
					"URAIAN_CAT_DOK_PRSHN" =>  $post_data["URAIAN"],
					"KETERANGAN_CAT_DOK_PRSHN" => $post_data["KETERANGAN"]
				);

				$result = $this->M_r_permohonan_izin->update_catatan_perusahaan_tracking($id_tracking, $data);
				
				if($result === TRUE) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Catatan Berhasil disimpan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Catatan Gagal disimpan', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}

			echo json_encode($out);
		}
	}

	public function riwayatCatatanPerusahaan() {

		$data['userdata'] 	= $this->userdata;

		$id_permohonan		= trim($this->input->post("id"));
		$data['catatan'] 	= $this->M_r_permohonan_izin->select_catatan_riwayat_permohonan($id_permohonan);

		echo show_my_modal('Admin/Permohonan_izin_atas/Profile_perusahaan/modal_riwayat_catatan_perusahaan', 'riwayat-catatan', $data);
	}

	// /**
	//  * @param ID_PERUSAHAAN
	//  */
	// public function step3($id) {
	// 	$id_permohonan 					= $this->session->userdata('idPermohonan');
	// 	$check = $this->is_valid_flow($id_permohonan);
	// 	if(!$check["is_valid"]) {
	// 		redirect($check["redirect_target"]);
	// 		return;
	// 	}

	// 	$data['userdata'] 				= $this->userdata;
	// 	$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
	// 	$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
	// 	$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id);
	// 	$data['page'] 					= "permohonan_izin_atas";
	// 	$data['judul'] 					= "Data Permohonan Izin";
	// 	$data['deskripsi'] 				= "Pengajuan Permohonan Izin / Non perizinan";
	// 	$data['id_permohonan'] 			= $id_permohonan;
	// 	$data['everApproved']			= $this->M_r_permohonan_izin->everApproved($id_permohonan);

	// 	// var_dump($id_permohonan,$data['id_permohonan'] );die();

	// 	$data['dataDokumen'] 			= $this->M_r_persyaratan_izin->select_by_id_eval($id, $id_permohonan);

	// 	$this->template->views('Admin/Permohonan_izin_atas/step3', $data);
	// }

	public function riwayatCatatan() {

		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dokumen'] 	= $this->M_r_permohonan_izin->select_by_dokumen($id);
		$data['catatan'] 	= $this->M_r_permohonan_izin->getCatatanEvaluasi($id);
		// var_dump($data['catatan']);die();
		echo show_my_modal('Admin/Permohonan_izin_atas/modal_riwayat_catatan', 'riwayat-catatan', $data);
	}

	public function catatanEval() {
		$data['userdata'] 		= $this->userdata;

		$id 					= trim($_POST['data']); // ID_DOKUMEN_PERMOHONAN
		$id_permohonan 			= $this->session->userdata('idPermohonan');

		$data['id_dokumen_permohonan'] 	= trim($_POST['id_permohonan']);
		$data['id_perusahaan'] 	= trim($_POST['id_perusahaan']);
		$data['catatan'] 		= $this->M_r_permohonan_izin->select_by_dokumen($id);
		$data['evaluasi']		= $this->M_r_permohonan_izin->get_evaluasi_dokumen_latest($id_permohonan, $id);
		$data['data_persyaratan'] 	= $this->M_r_permohonan_izin->select_by_dokumen($id);
		$data['dokumen_permohonan'] = $this->M_r_persyaratan_izin->select_by_dokumen_permohonan($id);

		echo show_my_modal('Admin/Permohonan_izin_atas/modal_catatan_evaluasi', 'evaluasi-catatan', $data, 'xl');
	}

	public function prosesEvaluasi() {
		$id_perusahaan 			= $this->input->post("ID_PERUSAHAAN");

		$this->form_validation->set_rules('URAIAN', 'Uraian', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$data 					= $this->input->post();
			unset($data["ID_PERUSAHAAN"]);
			
			$id_permohonan			= $this->session->userdata('idPermohonan');
			$tracking_data 			= $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
			$data['ID_TRACKING_PROSES'] = $tracking_data->ID_TRACKING_PROSES;

			$result 				= $this->M_r_permohonan_izin->catatEvaluasi($data);

			if($result === TRUE) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Berhasil Menambahkan Evaluasi', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Gagal Menambahkan Evaluasi', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	// /**
	//  * @param ID_PERUSAHAAN
	//  */
	// public function step4($id) {
	// 	$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
	// 	$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
	// 	$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id);
	// 	$data['userdata'] 				= $this->userdata;
	// 	$data['page'] 					= "permohonan_izin_atas";
	// 	$data['judul'] 					= "Data Permohonan Izin";
	// 	$data['deskripsi'] 				= "Pengajuan Permohonan Izin / Non perizinan";

	// 	/**
	// 	 * edited rendra 14:27, 03/07/2018
	// 	 * menambahkan variabel id_permohonan dan menambahkan array list
	// 	 */
	// 	$id_permohonan 					= $this->session->userdata('idPermohonan');
	// 	$data['id_permohonan'] 			= $id_permohonan;

	// 	// persiapkan queryString yang akan dienktip dan dikirim via web service
	// 	//------------------------------------------------------------------------

	// 	$data['enkriptedQS'] = get_enkriptedQS($id_permohonan, "view_data");

	// 	$this->template->views('Admin/Permohonan_izin_atas/step4', $data);
	// }

	// /**
	//  * @param ID_PERUSAHAAN
	//  */
	// public function step5($id) {
	// 	$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
	// 	$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
	// 	$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id);
	// 	$data['userdata'] 				= $this->userdata;
	// 	$data['page'] 					= "permohonan_izin_atas";
	// 	$data['judul'] 					= "Data Permohonan Izin";
	// 	$data['deskripsi'] 				= "Pengajuan Permohonan Izin / Non perizinan";
	// 	$id_permohonan 					= $this->session->userdata('idPermohonan');
	// 	$id_perusahaan 					= $id;
	// 	$data['dataDokumenSyaratIzin'] 			= $this->M_r_persyaratan_izin->select_by_id_eval($id, $id_permohonan);
	// 	$data['dataDokumenSyaratPerusahaan'] 			= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan);

	// 	/**
	// 	 * edited rendra 14:27, 03/07/2018
	// 	 * menambahkan variabel id_permohonan dan menambahkan array list
	// 	 */
	// 	$id_permohonan 					= $this->session->userdata('idPermohonan');
	// 	$data['id_permohonan'] 			= $id_permohonan;

	// 	// persiapkan queryString yang akan dienktip dan dikirim via web service
	// 	//------------------------------------------------------------------------
	// 	$data['enkriptedQS'] = get_enkriptedQS($id_permohonan, "view_pdf");

	// 	$this->template->views('Admin/Permohonan_izin_atas/step5', $data);
	// }

	// /**
	//  * @param ID_PERUSAHAAN
	//  */
	// public function step6($id) {
	// 	$data['sum_unverified_bidder'] 	= $this->M_bidder->total_rows_unverified();
	// 	$data['sum_permohonan'] 		= $this->M_r_permohonan_izin->total_permohonan($this->userdata);
	// 	$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id);
	// 	$data['userdata'] 				= $this->userdata;
	// 	$data['page'] 					= "permohonan_izin_atas";
	// 	$data['judul'] 					= "Data Permohonan Izin";
	// 	$data['deskripsi'] 				= "Pengajuan Permohonan Izin / Non perizinan";
	// 	$id_permohonan 					= $this->session->userdata('idPermohonan');	 
	// 	$data['id_permohonan'] 			= $id_permohonan;
	// 	$data['dataDokumen'] 			= $this->M_r_persyaratan_izin->select_catatan_dokumen($id_permohonan);
	// 	$id_perusahaan 					= $id;
	// 	$data['dataDokumenSyaratIzin'] 			= $this->M_r_persyaratan_izin->select_by_id_eval($id, $id_permohonan);
	// 	$data['dataDokumenSyaratPerusahaan'] 			= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan);
		
	// 	$ongoing_proses 				= $this->M_r_permohonan_izin->select_ongoing_process($id_permohonan);
	// 	$data_proses 					= $this->M_r_persyaratan_izin->select_final_ttd($ongoing_proses[0]->ID_PROSES); // Only test at the first proses. When finalizing, the process should only be one.

	// 	if($data_proses->IS_FINAL_TTD != 'Y'){
	// 		$data['button'] = '<button class="btn-sm btn-success setuju">Setuju</button>';
	// 	} else {
				
	// 		$data['button'] = '<button class="btn-sm btn-success pengesahan">Pengesahan</button>';
	// 	}

	// 	$this->template->views('Admin/Permohonan_izin_atas/step6', $data);
	// }

	public function tolak() {
		$data['userdata'] 		= $this->userdata;
		$data['id_permohonan'] 	= $this->session->userdata('idPermohonan');
		// $data['catatan_simpulan']		= full_clean($this->input->post("catatan_simpulan"));
		// var_dump($data['id_permohonan']);die();

		echo show_my_modal('Admin/Permohonan_izin_atas/modal_tolak', 'tolak-permohonan', $data);
	}

	public function prosesTolak() {
		$this->form_validation->set_rules('ALASAN_PENOLAKAN', 'Alasan Penolakan', 'trim|required');

		$data  = array(
			'ALASAN' 		=> $this->input->post('ALASAN_PENOLAKAN'),
			// 'CATATAN_SIMPULAN' 	=> $this->input->post('catatan_simpulan'),
			'ID_USER' 		=> $this->userdata->ID_USER,
			'TGL_PENOLAKAN' => date('Y-m-d'),
		);
		$id_permohonan = $this->session->userdata('idPermohonan');
		$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		// Call BPM
		$this->load->helper('bpm');
		$bpm_status = bpm_process($permohonan_izin->ID_PROSES_BPM, $this->userdata->ID_ROLE, TRUE);

		if($bpm_status === FALSE) {
			$this->session->set_flashdata('msg', show_err_msg('Sistem BPM mengalami gangguan, mohon ulangi perintah!'));

			redirect("Permohonan_izin_atas/step1?page=2");
			return;
		}

		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_r_permohonan_izin->tolak($id_permohonan, $this->userdata, $data);

			if ($result === TRUE) {
				$this->session->set_flashdata('msg', show_succ_msg('Permohonan berhasil ditolak'));

				$dataEmail 	= $this->M_r_permohonan_izin->select_permohonan_tolak_by_id($this->session->userdata('idPermohonan'));
				$IZIN		= $this->M_r_permohonan_izin->get_nama_template($id_permohonan);

				$this->notifyPerizinanTolak($this->session->userdata('idPermohonan'), full_clean($this->input->post('ALASAN_PENOLAKAN')));
				$this->tolakPermohonanEmail($dataEmail,$IZIN);
			} else {
				$error_msg = "Terjadi Kesalahan";
			}
		} else {
			$error_msg = validation_errors();
		}

		if(isset($error_msg)) {
			$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
			$id_perusahaan = $permohonan_izin->ID_PERUSAHAAN;
			$this->session->set_flashdata('msg', show_err_msg($error_msg));

			redirect("Permohonan_izin_atas");
		} else {
			redirect("Permohonan_izin_atas");
		}
	}

	private function notifyPerizinanTolak($id_permohonan, $alasan_penolakan) {
		$list_user = $this->M_r_permohonan_izin->select_list_approving_iteration($id_permohonan, 0);

		$subject = "Penolakan perizinan";
		$message = "Dengan email ini diinformasikan bahwa ada permohonan izin yang telah anda periksa, ditolak dengan alasan: {$alasan_penolakan}";
		sendEmails($list_user, $subject, $message);
	}

	function tolakPermohonanEmail($data,$IZIN) {
        $ci = get_instance();
        $ci->load->library('email');
        $config = get_smtp_config();
        
        $ci->email->initialize($config);

        $ci->email->from(get_current_email(), 'EBTKE');
        $to = $data->EMAIL_PERUSAHAAN;
        // $list = array('mnurtannio25@gmail.com');
        $ci->email->to($to);
        $ci->email->subject('Penolakan Perizinan '.$IZIN);
        $ci->email->message('Dengan email ini diinformasikan bahwa permohonan izin '.$IZIN.' kami tolak dengan alasan : '.$data->ALASAN_PENOLAKAN.', Nomor Tracking : '.$data->NO_TRACKING. 'Tanggal Submit : '.$data->TGL_PENOLAKAN);
        if ($this->email->send()) {
            //redirect('Permohonan_izin_atas');
        } else {
            //show_error($this->email->print_debugger());
        }
    }

	public function setuju() {
		$data['userdata'] 				= $this->userdata;
		$data['id_permohonan'] 			= $this->session->userdata('idPermohonan');
		// $data['catatan_simpulan']		= full_clean($this->input->post("catatan_simpulan"));

		echo show_my_modal('Admin/Permohonan_izin_atas/modal_setuju', 'setuju-permohonan', $data);
	}

	public function prosesSetuju() {
		// $post_data = $this->input->post();
		// $data['CATATAN_SIMPULAN'] = $post_data["catatan_simpulan"];

		$id_permohonan = $this->session->userdata('idPermohonan');
		$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		$list_next_process_id = $this->M_r_permohonan_izin->get_next_process($id_permohonan);

		// Check if BKPM
		$data_next_process = $this->M_proses_skema->get_by_id_proses($list_next_process_id[0]->ID_PROSES); // TO BKPM no paralel process!
		$is_bkpm_next= ($data_next_process->IS_BKPM === 'Y');

		if($is_bkpm_next) {
			$bkpm_result = $this->send_to_bkpm($id_permohonan);

			if($bkpm_result === FALSE) {
				$this->session->set_flashdata('msg', show_err_msg('Sistem BKPM mengalami gangguan, mohon ulangi perintah!'));

				redirect("Permohonan_izin_atas/step1?page=2");
				return;
			}
		}

		// Call BPM
		$this->load->helper('bpm');
		$bpm_status = bpm_process($permohonan_izin->ID_PROSES_BPM, $this->userdata->ID_ROLE, FALSE);

		if($bpm_status === FALSE) {
			$this->session->set_flashdata('msg', show_err_msg('Sistem BPM mengalami gangguan, mohon ulangi perintah!'));

			redirect("Permohonan_izin_atas/step1?page=2");
			return;
		}

		$result = $this->M_r_permohonan_izin->approve_permohonan($id_permohonan, $this->userdata);

		// Auto track if BKPM
		if($is_bkpm_next) {
			$current_process_list = $this->M_r_permohonan_izin->get_ongoing_process_id($id_permohonan);
			$single_proses = $current_process_list[0]->ID_PROSES;

			$role_bkpm_next = $this->M_r_permohonan_izin->get_role_for_process($single_proses);
			$id_user_bkpm_next = $this->M_r_permohonan_izin->get_user_id_by_role($role_bkpm_next->ID_ROLE);

			$tracking_data = $this->M_r_permohonan_izin->select_tracking($id_user_bkpm_next->ID_USER, $id_permohonan);

			if(empty($tracking_data)) {

				$dataTracking = array(
					'ID_PROSES' 		=> $single_proses,
					'ID_USER' 			=> $id_user_bkpm_next->ID_USER,
					'ID_PERMOHONAN' 	=> $id_permohonan, 
					'TGL_MULAI_PROSES' 	=> date("Y-m-d H:i:s"), // TODO: At least this.
				);
	
				$this->M_r_permohonan_izin->insert_tracking($dataTracking); // TODO: Check if failed
			}
		}

		if($result === TRUE){
			$this->session->set_flashdata('msg', show_succ_msg('Permohonan berhasil disetujui'));

			$list_user = $this->M_r_permohonan_izin->select_list_user_for_permohonan($id_permohonan);
			$this->setujuPermohonanEmail($list_user);
		}

		redirect('Permohonan_izin_atas');
	}

	function setujuPermohonanEmail($list_user) {
		$subject = "Permohonan izin baru";
		$message = "Ada permohonan izin baru disetujui, mohon segera diperiksa.";

        sendEmails($list_user, $subject, $message);
    }

	public function pengesahan() {

		$data['userdata'] 				= $this->userdata;
		$data['id_permohonan'] 			= $this->session->userdata('idPermohonan');
		// $data['catatan_simpulan']		= full_clean($this->input->post("catatan_simpulan"));
		// $id_curr_proses 				= $this->M_r_permohonan_izin->getIdCurrProses($this->session->userdata('idPermohonan'));
		// $id_skema 						= $this->M_r_permohonan_izin->getIdSkema($id_curr_proses->ID_CURR_PROSES);
		// $urutan 						= $this->M_r_persyaratan_izin->select_curr_proses($id_curr_proses->ID_CURR_PROSES);
		// $data['id_curr_proses_next'] 	= $this->M_r_persyaratan_izin->select_id_skema_nextProses($id_skema->ID_SKEMA, $id_curr_proses->ID_CURR_PROSES); //TODO: Check function signature

		// var_dump($this->session->userdata('idPermohonan'),$id_curr_proses,$id_skema, $urutan, $data['id_curr_proses_next']);die();

		echo show_my_modal('Admin/Permohonan_izin_atas/modal_pengesahan', 'pengesahan-permohonan', $data);
	}

	public function prosesPengesahan() {
		if(!$this->isAllowedPengesahan()) {
			redirect('Permohonan_izin_atas');
			return;
		}

		$id_permohonan = $this->session->userdata('idPermohonan');
		$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		// Call BPM
		$this->load->helper('bpm');
		$bpm_status = bpm_process($permohonan_izin->ID_PROSES_BPM, $this->userdata->ID_ROLE, FALSE);

		if($bpm_status === FALSE) {
			$this->session->set_flashdata('msg', show_err_msg('Sistem BPM mengalami gangguan, mohon ulangi perintah!'));

			redirect("Permohonan_izin_atas/step1?page=2");
			return;
		}

		$this->requestPengesahan();
		$pengesahan_data = $this->session->userdata("pengesahan_data");

		if($pengesahan_data->status == "success") {
			$this->recordPengesahan();

			$dataEmail 	= $this->M_r_permohonan_izin->select_permohonan_disetujui_by_id($this->session->userdata('idPermohonan'));
			$IZIN		= $this->M_r_permohonan_izin->get_nama_template($id_permohonan);
			$this->pengesahanPermohonanEmail($dataEmail, $IZIN);
		}

		redirect('Permohonan_izin_atas/hasil_pengesahan');
	}

	public function stepPersetujuan($id) {
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id);
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "permohonan_izin_atas";
		$data['judul'] 		= "Data Permohonan Izin";
		$data['deskripsi'] 	= "Pengajuan Permohonan Izin / Non perizinan";

		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$data['enkriptedQS'] = get_enkriptedQS($id_permohonan, "form_data");

		$this->template->views('Admin/Permohonan_izin_atas/formPersetujuan', $data);
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

	public function tampil() {
		$id = $this->session->userdata['userdata'];
		$data['bidder'] = $this->M_bidder->select_by_id_edit_profile($id->ID_PERUSAHAAN);
		$data['dataAkta'] = $this->M_T_Akta_Perusahaan->select_by_perusahaan($id->ID_PERUSAHAAN);
		$this->load->view('Admin/Permohonan_izin_atas/Profile_perusahaan/list_data', $data);
	}

	private function isAllowedPengesahan() {
		$id_permohonan 	= $this->session->userdata('idPermohonan');

		$ongoing_proses = $this->M_r_permohonan_izin->select_ongoing_process($id_permohonan);
		$id_proses 		= $ongoing_proses[0]->ID_PROSES; // Only test at the first proses. When finalizing, the process should only be one.	
		$id_role		= $this->userdata->ID_ROLE;

		$is_allowed = $this->M_r_permohonan_izin->isAllowedPengesahan($id_role, $id_proses);

		return $is_allowed;
	}

	private function recordPengesahan() {
		$id_permohonan 	= $this->session->userdata('idPermohonan');
		
		$result = $this->M_r_permohonan_izin->pengesahan($id_permohonan, $this->userdata);

		return $result;
	}

	private function requestPengesahan() {
		$JAVA_HOME = "/usr/java/jdk1.7.0_80/bin";

		$PATH = "/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin:/usr/java/jdk1.7.0_80/bin";
		
		$PATH = "PATH:$PATH";
				
		putenv("JAVA_HOME=$JAVA_HOME");
				
		putenv("PATH=$PATH");

		$cmd = shell_exec("java -version 2>&1");

		// persiapkan queryString yang akan dienktip dan dikirim via web service
		//------------------------------------------------------------------------
		$id_permohonan 					= $this->session->userdata('idPermohonan');
		$permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
		$id_form = $permohonan_izin->ID_FORM;
		$id_template = $permohonan_izin->ID_TEMPLATE;
		$id_perusahaan = $permohonan_izin->ID_PERUSAHAAN;
		$id_skema = $this->M_izin_instansi->select_by_id($permohonan_izin->ID_FORM)->ID_SKEMA;
		
		// $id_permohonan = 1;
		// $id_form = 2;
		// $id_template = 2;
		// $id_perusahaan = 1;
		// $id_skema = 3;
		$enkriptor_jar = get_enkriptor_loc();
		$qs			= urlencode("idInstansi-15~idForm-{$id_form}~idTemplate-{$id_template}~idPermohonan-{$id_permohonan}~idPerusahaan-{$id_perusahaan}~idSkema-{$id_skema}~action-print");
		$command 	= "java -jar {$enkriptor_jar} ". $qs . " 2>&1";
		// var_dump($command);
		exec($command, $output);
		// var_dump($output);die();
		$enkriptedQS = $output[0];
		$pengesahan_sess_id = "?sessID=".$enkriptedQS;
		
		$this->load->config('form_url_config');
		$base_pengesahan_url = $this->config->item("pengesahan_url"); 
        // $base_izin_url = get_izin_pdf_url();		
		// $base_pengesahan_url = "{$base_izin_url}AJAXHandler/htmlAjaxPengesahanIzin.jsp"; 
		// $base_pengesahan_url = "http://10.1.35.139:8080/IzinMinerba/AJAXHandler/htmlAjaxPengesahanIzin.jsp"; 
		
		$pengesahanURL = $base_pengesahan_url.$pengesahan_sess_id;
		// $pengesahanURL = "https://7aefc309-5bcf-4f75-b07c-87f704fa2054.mock.pstmn.io/testPengesahan";
		// $pengesahanURL = base_url("beranda/testJSON");

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $pengesahanURL);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$output = curl_exec($ch);

		curl_close($ch);

		$output = json_decode($output);

		if(!isset($output)) {
			$output = new stdClass();
			$output->status = "CURL_ERROR";
			$output->message = "Mohon maaf, server pengesahan untuk sementara tidak dapat diakses.";
			$output->urlIzin = "";
			$output->fileIzin = "";
		}

		$this->session->set_userdata("pengesahan_data", $output);
	}

	public function hasil_pengesahan() {
		$data['deskripsi'] 	= "Pengesahan";
		$data['userdata'] 	= $this->userdata;
		$data['page'] 		= "hasil_pengesahan_izin_eval";
		$data['judul'] 		= "Pengesahan";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);

		$data['pengesahan_data'] = $this->session->userdata("pengesahan_data");

		if(is_null($data['pengesahan_data'])) {
			redirect('Permohonan_izin_atas');
			return;
		}

		$this->session->unset_userdata("pengesahan_data");
		$this->template->views('Admin/Permohonan_izin_atas/hasil_pengesahan', $data);
	}

	public function download_perusahaan() {
		$requested_id_dok_syarat = $this->input->get("file", TRUE);

		$id_permohonan = $this->session->userdata('idPermohonan');
		$data_perusahaan = $this->M_r_permohonan_izin->select_idPerusahaan($id_permohonan);
		$id_perusahaan = $data_perusahaan->ID_PERUSAHAAN;
		$requested_file_data = $this->M_Dokumen_Syarat_Perusahaan->select_detail_dokumen($id_perusahaan, $requested_id_dok_syarat);

		if(is_null($requested_file_data)) {
			redirect("Permohonan_izin_atas");
			return;
		}

		$requested_file_name = $requested_file_data->DOKUMEN_PERSYARATAN;
		$path_to_file = get_path_upload_dokumen_syarat_perusahaan($id_perusahaan, $requested_file_name);

		set_file_download($path_to_file, $requested_file_name);
	}

	public function download_dokumen($type = NULL) {
		$type = full_clean($type);

		if(empty($type)) {
			redirect("Permohonan_izin_atas");
			return;
		}

		$requested_id_akta = $this->input->get("file", TRUE);

		$id_permohonan = $this->session->userdata('idPermohonan');
		$data_perusahaan = $this->M_r_permohonan_izin->select_idPerusahaan($id_permohonan);
		$id_perusahaan = $data_perusahaan->ID_PERUSAHAAN;
		$requested_file_data = $this->M_T_Akta_Perusahaan->select_by_akta_perusahaan($requested_id_akta, $id_perusahaan);

		if(is_null($requested_file_data)) {
			redirect("Permohonan_izin_atas");
			return;
		}

		if($type === "akta") {
			$requested_file_name = $requested_file_data->FILE_AKTA;
		} else {
			$requested_file_name = $requested_file_data->FILE_PENGESAHAN;
		}

		$path_to_file = get_path_upload_akta_and_pengesahan($id_perusahaan, $requested_file_name);

		set_file_download($path_to_file, $requested_file_name);
	}

	public function download_persyaratan() {
		$id_permohonan 		= $this->session->userdata("idPermohonan");
		
		$requested_id_persyaratan = $this->input->get("file", TRUE);
		$requested_file_data 	= $this->M_r_permohonan_izin->get_file_data($id_permohonan, $requested_id_persyaratan);

		if(is_null($requested_file_data)) {
			redirect("Permohonan_izin");
			return;
		}

		$id_permohonan = $this->session->userdata('idPermohonan');
		$data_perusahaan = $this->M_r_permohonan_izin->select_idPerusahaan($id_permohonan);
		$id_perusahaan = $data_perusahaan->ID_PERUSAHAAN;
		$requested_file_name 	= $requested_file_data->FILE_PERSYARATAN;
		$path_to_file = get_path_upload_permohonan($id_perusahaan, $id_permohonan, $requested_file_name);
		
		// $file_alias = substr($requested_file_name, 6); //TODO: Mask this?
		$file_alias = explode("/", $requested_file_name);
		set_file_download($path_to_file, $file_alias[1]);
	}

	private function is_valid_access_right($id_permohonan) {
		if(is_null($id_permohonan)) {
			$this->session->set_flashdata('msg', show_err_msg('Mohon coba lagi.'));        
			return FALSE;
		}

		$is_exclusive_role = ($this->userdata->ID_ROLE == "EVAL" || $this->userdata->ID_ROLE == "ESLN");
		if($is_exclusive_role) {
			$current_job_data = $this->M_r_permohonan_izin->current_job($this->userdata);

			if(!empty($current_job_data)
				&& $current_job_data->ID_PERMOHONAN != $id_permohonan) {
				$this->session->set_flashdata('msg', show_err_msg('Anda harus menyelesaikan permohonan izin yang sedang anda periksa terlebih dahulu.'));        
				return FALSE;
			}
			$is_taken = $this->M_r_permohonan_izin->is_taken_by_another($this->userdata, $id_permohonan);
			
			if($is_taken) {
				$this->session->set_flashdata('msg', show_err_msg('Permohonan Izin, telah dievaluasi oleh Evaluator lain.'));        
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * Check is a valid flow, especially for step 3.
	 * Early Exit style.
	 */
	private function is_valid_flow($id_permohonan) {
		$result["is_valid"] = TRUE;

		if(!$this->is_valid_access_right($id_permohonan)) {
			// Taken by another eval
			$this->session->set_flashdata('msg', show_err_msg('Permohonan Izin, telah dievaluasi oleh Evaluator lain.'));        
			$result["is_valid"] = FALSE;
			$result["redirect_target"] = "Permohonan_izin_atas";
			return $result;
		}

		$tracking_data 	= $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
		$data_catatan 	= $this->M_r_permohonan_izin->select_catatan_perusahaan_tracking($tracking_data->ID_TRACKING_PROSES);

		$uraian_catatan = trim($data_catatan->URAIAN_CAT_DOK_PRSHN);

		if(empty($uraian_catatan)) {
			// No uraian inserted
			$this->session->set_flashdata('msg', show_err_msg('Mohon masukkan uraian evaluasi.'));
			$result["is_valid"] = FALSE;
			$result["redirect_target"] = "Permohonan_izin_atas/step1";

			return $result;
		}
		
		return $result;
	}

	private function is_valid_arsip_access($id_permohonan) {
		return TRUE;
	}

	function pengesahanPermohonanEmail($data, $IZIN) {
        $ci = get_instance();
        $ci->load->library('email');
        $config = get_smtp_config();
        
        $ci->email->initialize($config);

        $ci->email->from(get_current_email(), 'EBTKE');
        $to = $data->EMAIL_PERUSAHAAN;
        // $list = array('mnurtannio25@gmail.com');
        $ci->email->to($to);
		$ci->email->subject('Perizinan Disetujui '.$IZIN);
        $base_izin_url = get_izin_pdf_url();		
        $ci->email->message("Data permohonan anda kami setujui. Silahkan download produk perizinan '.$IZIN.' anda di link berikut: {$base_izin_url}{$data->FILE_IZIN}");
        if ($this->email->send()) {
			// Oke
            // redirect('Permohonan_izin_atas');
        } else {
            //show_error($this->email->print_debugger());
        }
	}
	
	private function prepare_alasan_data($data, $open_default = FALSE, $allowAddPengembalian = TRUE) {
		$id_permohonan = $this->session->userdata('idPermohonan'); // ID_PERMOHONAN
		$data['controller_url']				= "Permohonan_izin_both";
		$data['alasan_pengembalian']		= $this->M_r_permohonan_izin->get_latest_alasan_pengembalian($id_permohonan);
		$data['open_default']				= ($open_default ? "in" : "");
		$data['allowAddPengembalian']		= $allowAddPengembalian;

		if(!empty($data['alasan_pengembalian'])) {
			$data['data_alasan_pengembalian']	= $this->load->view('Admin/Permohonan_izin_both/catatan_pengembalian', $data, TRUE);
		} else {
			$data['data_alasan_pengembalian']	= "";
		}

		return $data;
	}

	private function prepare_data_tambahan($data, $open_default = TRUE) {
		$id_permohonan = $this->session->userdata('idPermohonan'); // ID_PERMOHONAN
		$data['data_kelengkapan'] = $this->M_dokumen_pelengkap->select_id_permohonan($id_permohonan);
		$data['open_default']				= ($open_default ? "in" : "");

		if(!empty($data['data_kelengkapan'])) {
			$data['accordion_data_kelengkapan'] = $this->load->view('Lengkapi_data/accordion_kelengkapan_data', $data, TRUE);
		} else {
			$data['accordion_data_kelengkapan']	= "";
		}
		return $data;
	}

	// BKPM
	private function send_to_bkpm($id_permohonan = NULL) {
		$data_permohonan = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		if(empty($data_permohonan)) {
			$this->kill_access();
		}

		$ongoing_proses = $this->M_r_permohonan_izin->select_ongoing_process($data_permohonan->ID_PERMOHONAN);
		$curr_id_proses = (!empty($ongoing_proses) ? intval($ongoing_proses[0]->ID_PROSES) : 0);

		$dokumen_perusahaan = $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($data_permohonan->ID_PERUSAHAAN);

		$npwp_index = array_search("NPWP", array_map(function($item){
				return $item->DOKUMEN_PERSYARATAN;
			}, $dokumen_perusahaan)
		);

		$data_npwp = $dokumen_perusahaan[$npwp_index];

		$now_date = date("d/m/Y");

		$data_catatan_kesimpulan = $this->M_r_permohonan_izin->get_latest_catatan_kesimpulan($id_permohonan);

		$catatan_kesimpulan = (!empty($data_catatan_kesimpulan) ? $data_catatan_kesimpulan->CATATAN_SIMPULAN : "");

		$data_catatan_pengembalian = $this->M_r_permohonan_izin->get_latest_alasan_pengembalian($id_permohonan);

		$catatan_pengembalian = (!empty($data_catatan_pengembalian) ? $data_catatan_pengembalian->ALASAN_PENGEMBALIAN : "");


		$layouts_data = $this->M_minerba_bkpm->select_layouts($data_permohonan->ID_TEMPLATE);
		$final_layout_data = $this->M_minerba_bkpm->select_final_layouts($id_permohonan);

		$final_layout_array = array_group_by("ID_PAGE", $final_layout_data);

		$id_download = enc_dec_id_permohonan("encrypt", $id_permohonan);

		$layouts = array();

		foreach($layouts_data as $item) {
			$layout_new = new Layout();
			$layout_new->ID_LAYOUT = $item->ID_PAGE;
			$layout_new->ID_PERMOHONAN = $id_permohonan;
			$layout_new->URUTAN = $item->URUTAN;
			$layout_new->LAYOUT = $final_layout_array[$item->ID_PAGE][0]["LAYOUT_FINAL"];
			$layout_new->PAGE_SIZE = $item->PAGE_SIZE;
			$layout_new->ORIENTATION = $item->ORIENTATION;

			$layouts[] = $layout_new;
		}

		$layouts_json = json_encode($layouts);

		$api_key = "ayamgoreng";

		$post_fields = <<<EOT
[
	{
		"API_KEY":"{$api_key}"
	},
	{
		"ID_PERMOHONAN":"{$data_permohonan->ID_PERMOHONAN}",
		"ID_DOWNLOAD":"{$id_download}",
		"ID_FORM":"{$data_permohonan->ID_FORM}",
		"ID_TEMPLATE":"{$data_permohonan->ID_TEMPLATE}",
		"ID_PEMOHON":"{$data_permohonan->ID_PERUSAHAAN}",
		"NAMA_PEMOHON":"{$data_permohonan->NAMA_PERUSAHAAN}",
		"ALAMAT_PEMOHON":"{$data_permohonan->ALAMAT}",
		"ID_PERUSAHAAN":"{$data_permohonan->ID_PERUSAHAAN}",
		"NAMA_PERUSAHAAN":"{$data_permohonan->NAMA_PERUSAHAAN}",
		"ALAMAT_PERUSAHAAN":"{$data_permohonan->ALAMAT}",
		"NPWP_PERUSAHAAN":"{$data_npwp->NOMOR}",
		"KODE_POS":"",
		"STATUS_INVESTASI":"{$data_permohonan->STATUS_MODAL}",
		"NO_TELP":"{$data_permohonan->TELEPON}",
		"EMAIL_PERUSAHAAN":"{$data_permohonan->EMAIL_PERUSAHAAN}",
		"TGL_KIRIM_BKPM":"{$now_date}",
		"TGL_DISETUJUI":null,
		"ID_CURR_PROSES":"3",
		"CATATAN_PERBAIKAN":"{$catatan_kesimpulan}",
		"NOMOR_TAHUNAN":null,
		"NOMOR_LENGKAP":null,
		"RESPON_PERBAIKAN":"{$catatan_pengembalian}",
		"LAYOUTS": {$layouts_json}
	}
]
EOT;

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_PORT => "444",
		CURLOPT_URL => "https://spipise.bkpm.go.id:444/MinerbaService20181221_version_2/sendPermohonanMinerbaToBKPM",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $post_fields,
		CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			"cache-control: no-cache",
			"content-type: application/json",
			"postman-token: 388e6d51-8e9f-efb2-8807-6f1cc85ac58e"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		if ($err) {
			// echo "cURL Error #:" . $err;
		} else {
			if($httpcode == 200) {
				return TRUE;
			}
		}

		return FALSE;
	}

	private function kill_access($error_code = 403) {
        http_response_code($error_code);
        die();
	}
	
	private function prepare_detail_permohonan($data, $id_permohonan) {
		$data_permohonan_izin = $this->M_r_permohonan_izin->select_by_id_permohonan($id_permohonan);		

		$data['kode_tracking'] = encrypted_id_permohonan($data_permohonan_izin->ID_PERMOHONAN);
		$data['tanggal_pengajuan'] =$data_permohonan_izin->TGL_PENGAJUAN;

		$data['detail_data_permohonan'] = $this->load->view('Admin/Permohonan_izin_eval/data_permohonan_detail', $data, TRUE);		

		return $data;
	}
}