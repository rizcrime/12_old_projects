<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_izin_both extends AUTHADMIN_Controller {
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
		$this->load->model('M_dokumen_pelengkap');
		$this->load->model('M_r_user_izin_instansi');


		if($this->userdata->ID_ROLE == "EVAL") {
			$this->role_url = "Permohonan_izin_eval";
		} else {
			$this->role_url = "Permohonan_izin_atas";
		}
    }

	// Alasan pengembalian
    public function riwayat_alasan_pengembalian() {
		$data['userdata'] 	= $this->userdata;

		$id_permohonan		= trim($this->input->post("id"));
		$data['catatan'] 	= $this->M_r_permohonan_izin->select_riwayat_alasan_pengembalian_permohonan($id_permohonan);

		echo show_my_modal('Admin/Permohonan_izin_both/modal_riwayat_alasan_pengembalian', 'riwayat-alasan-pengembalian', $data);
	}
    
	public function pengembalian_quick() {
		$data['userdata'] 		= $this->userdata;
		$data['id_permohonan'] 	= $this->session->userdata('idPermohonan');
		$data['latest_alasan']	= $this->M_r_permohonan_izin->get_latest_alasan_pengembalian($data['id_permohonan']);

		echo show_my_modal('Admin/Permohonan_izin_both/modal_pengembalian_quick', 'pengembalian-permohonan-quick', $data);
	}

    public function tambah_alasan_pengembalian() {
		if($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('ALASAN_PENGEMBALIAN', 'Alasan Kesimpulan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$id_permohonan = $this->session->userdata("idPermohonan");

				if(!$this->is_valid_access_right($id_permohonan)) {
					redirect('Permohonan_izin_eval');
					return;
				}
				$tracking_data = $this->M_r_permohonan_izin->select_tracking($this->userdata->ID_USER, $id_permohonan);
				$id_tracking = $tracking_data->ID_TRACKING_PROSES;

				$alasan_pengembalian = $this->input->post("ALASAN_PENGEMBALIAN");
				$result = $this->M_r_permohonan_izin->update_alasan_pengembalian($id_tracking, $alasan_pengembalian);

				if($result === TRUE) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Alasan Berhasil disimpan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Alasan Gagal disimpan', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}

			echo json_encode($out);
		}
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
	// End of alasan pengembalian

	// Arsip
	public function arsip() {
		$data['deskripsi'] 	= "Arsip Produk Izin";
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;
		$data['page'] 		= "arsip_izin";
		$data['judul'] 		= "Arsip Produk Izin";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);
		$data['role_url'] = $this->role_url;
		
		$this->session->unset_userdata('idPermohonan');
		$this->template->views('Admin/Permohonan_izin_both/arsip_produk_izin', $data);
	}
	
	public function arsip_detail($id_permohonan = NULL) {
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
		$data['dataPermohonan_izin'] 	= $this->M_r_permohonan_izin->select_permohonan_by_id($id);
		$data['data_template']			= $this->M_r_template_izin->select_by_id($data['dataPermohonan_izin']->ID_TEMPLATE);
		$data['id_permohonan']			= $id;
		
		$data['bidder'] 				= $this->M_bidder->select_by_id_edit_profile($id_perusahaan->ID_PERUSAHAAN);
		$data['dataProvinsi'] 			= $this->M_provinsi->select_all();
		$data['dataIzinInstansi'] 		= $this->M_izin_instansi->select_all();
		$data['dataDokumen'] 			= $this->M_Dokumen_Syarat_Perusahaan->selectAllActiveRequirementDocuments($id_perusahaan->ID_PERUSAHAAN);
		$data['dataAkta'] 				= $this->M_T_Akta_Perusahaan->select_by_perusahaan($id_perusahaan->ID_PERUSAHAAN);
		$data['everApproved']			= $this->M_r_permohonan_izin->everApproved($id);
		$data['dataDokumenEval'] 		= $this->M_r_persyaratan_izin->select_by_id_eval($id_perusahaan->ID_PERUSAHAAN, $id_perusahaan->ID_PERMOHONAN);
		
		$data_catatan = $this->M_r_permohonan_izin->select_latest_catatan_perusahaan($id);
		$data['data_catatan'] = $data_catatan;
		$data['tambah_kesimpulan_url'] = $this->role_url;
		$data['cat_kesimpulan']			= $this->M_r_permohonan_izin->get_latest_catatan_kesimpulan($id);
		$data['role_url'] = $this->role_url;

		$data = $this->prepare_alasan_data($data, FALSE, FALSE);

		$this->template->views('Admin/Permohonan_izin_both/detail_arsip', $data);
	}

	function get_arsip() {
		// added by rendra
		$data['userdata'] 	= $this->userdata;
		$id_role = $this->userdata->ID_ROLE;

		// added by rendra
		if ($id_role == 'ADM' || $id_role == 'ADVE') {
			$list_id_form = NULL;
		} else {
			$list_id_form = $this->M_r_user_izin_instansi->get_list_id_form_by_id_user($this->userdata->ID_USER);
		}
		
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
			$detail_izin_link = "<a class='btn btn-info btn-minier' href='".base_url("Permohonan_izin_both/arsip_detail/{$field->ID_PERMOHONAN}")."'><i class='glyphicon glyphicon-info-sign'></i> Detail</a>";
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
	// Enf of arsip

	// Data pelengkap
	public function dowload_pelengkap() {
		$id_permohonan 		= $this->session->userdata("idPermohonan");
		$data_perusahaan = $this->M_r_permohonan_izin->select_idPerusahaan($id_permohonan);
		$id_perusahaan = $data_perusahaan->ID_PERUSAHAAN;
		
		$requested_id_file_pelengkap = $this->input->get("id", TRUE);

		$data_file = $this->M_dokumen_pelengkap->select_detail_file($requested_id_file_pelengkap);

		$path_to_file = get_path_upload_permohonan_tambahan($id_perusahaan, $id_permohonan, $data_file->NAMA_FILE);
		$requested_file_name = $data_file->NAMA_FILE;
		set_file_download($path_to_file, $requested_file_name);
	}
	// End of pelengkap

	// Catatan kesimpulan
	private function select_catatan_dokumen() {
		$id_permohonan = $this->session->userdata('idPermohonan');

		$data_permohonan_izin = $this->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);
		$id_perusahaan = $data_permohonan_izin->ID_PERUSAHAAN;

		$data_catatan		= $this->M_r_persyaratan_izin->select_by_id_eval($id_perusahaan, $id_permohonan);

		$uraian_keterangan = "";
		foreach ($data_catatan as $catatan) {
			$data_uraian = $catatan->data_uraian;

			if(!is_null($data_uraian)) {
				$data_uraian_keterangan = issetor($data_uraian->URAIAN);
				$data_uraian_keterangan .= issetor($data_uraian->KETERANGAN);

				$uraian_keterangan .= $data_uraian_keterangan;
				// $uraian_keterangan .= "<br>----------";
			}
		}

		return $uraian_keterangan;
	}

	public function get_catatan_kesimpulan(){
		$uraian_keterangan = $this->select_catatan_dokumen();

		echo json_encode($uraian_keterangan);
	}

	public function get_kesimpulan() {
		$id_permohonan = $this->session->userdata('idPermohonan');

		$cat_kesimpulan		= $this->M_r_permohonan_izin->get_latest_catatan_kesimpulan($id_permohonan);

		if(is_null($cat_kesimpulan)) {
			$uraian_keterangan = $this->select_catatan_dokumen();

			// $cat_kesimpulan->CATATAN_SIMPULAN  = "";
			// $cat_kesimpulan->CATATAN_SIMPULAN .= "<br>----------";
			$cat_kesimpulan->CATATAN_SIMPULAN = $uraian_keterangan;
		}

		echo json_encode($cat_kesimpulan);
	}
	// End of catatan kesimpulan
}