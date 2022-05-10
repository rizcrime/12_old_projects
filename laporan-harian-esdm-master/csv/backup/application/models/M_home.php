<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	public function permohonan_izin($year, $month, $id_form_limit = array()){
		$this->db->select('count(TGL_PENGAJUAN) as PENGAJUAN, count(TGL_DISETUJUI) as SETUJU, count(TGL_PENOLAKAN) as TOLAK')
		->from('r_permohonan_izin')
		->where('YEAR(TGL_PENGAJUAN)', $year)
		->where('MONTH(TGL_PENGAJUAN)', $month)
		->group_by('YEAR(TGL_PENGAJUAN)')
		->group_by('MONTH(TGL_PENGAJUAN)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}

		$data = $this->db->get();

		return $data->row();
	}

	public function permohonan_masuk($start, $end, $id_form_limit = array()){
		$this->db->select('count(TGL_PENGAJUAN) as JUMLAH_MASUK, CONCAT(YEAR(TGL_PENGAJUAN), "-", MONTH(TGL_PENGAJUAN)) as TGL_PENGAJUAN')
		->from('r_permohonan_izin')
		->where('TGL_PENGAJUAN >', $start)
		->where('TGL_PENGAJUAN <', $end)
		->group_by('YEAR(TGL_PENGAJUAN)')
		->group_by('MONTH(TGL_PENGAJUAN)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}

		$data = $this->db->get();

		return $data->result();
	}

	public function permohonan_disetujui($start, $end, $id_form_limit = array()){
		$this->db->select('count(TGL_DISETUJUI) as JUMLAH_SETUJU, CONCAT(YEAR(TGL_PENGAJUAN), "-", MONTH(TGL_PENGAJUAN)) as TGL_PENGAJUAN')
		->from('r_permohonan_izin')
		->where('TGL_PENGAJUAN >', $start)
		->where('TGL_PENGAJUAN <', $end)
		->where('TGL_DISETUJUI IS NOT NULL', NULL, FALSE)
		->group_by('YEAR(TGL_PENGAJUAN)')
		->group_by('MONTH(TGL_PENGAJUAN)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}
		
		$data = $this->db->get();

		return $data->result();
	}

	public function permohonan_ditolak($start, $end, $id_form_limit = array()){
		$this->db->select('count(TGL_PENOLAKAN) as JUMLAH_TOLAK, CONCAT(YEAR(TGL_PENGAJUAN), "-", MONTH(TGL_PENGAJUAN)) as TGL_PENGAJUAN')
		->from('r_permohonan_izin')
		->where('TGL_PENGAJUAN >', $start)
		->where('TGL_PENGAJUAN <', $end)
		->where('TGL_PENOLAKAN IS NOT NULL', NULL, FALSE)
		->group_by('YEAR(TGL_PENGAJUAN)')
		->group_by('MONTH(TGL_PENGAJUAN)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}

		$data = $this->db->get();

		return $data->result();
	}

	public function total_permohonan_masuk(){
		$data = $this->db->get('r_permohonan_izin');

		return $data->num_rows();
	}

	public function total_permohonan_disetujui(){
		$this->db->where('TGL_DISETUJUI IS NOT NULL', NULL, FALSE);
		$data = $this->db->get('r_permohonan_izin');

		return $data->num_rows();
	}

	public function total_permohonan_ditolak(){
		$this->db->where('TGL_PENOLAKAN IS NOT NULL', NULL, FALSE);
		$data = $this->db->get('r_permohonan_izin');

		return $data->num_rows();
	}

	public function select_permohonan_masuk(){
		$data = $this->db->get('r_permohonan_izin');

		return $data->result();
	}

	public function select_permohonan_disetujui($year, $month, $id_form_limit = array()){
		$this->db->select('t_perusahaan.NAMA_PERUSAHAAN, r_permohonan_izin.ID_PERMOHONAN, r_permohonan_izin.TGL_PENGAJUAN, fgen_t_izin_instansi.NAMA_FORM, r_permohonan_izin.NOMOR_IZIN')
		->from('r_permohonan_izin')
		->join('t_perusahaan', 'r_permohonan_izin.ID_PERUSAHAAN = t_perusahaan.ID_PERUSAHAAN')
		->join('fgen_t_izin_instansi', 'r_permohonan_izin.ID_FORM = fgen_t_izin_instansi.ID_FORM')
		->where('TGL_DISETUJUI IS NOT NULL', NULL, FALSE)
		->where('YEAR(TGL_PENGAJUAN)', $year)
		->where('MONTH(TGL_PENGAJUAN)', $month);
		// ->group_by('YEAR(TGL_DISETUJUI)')
		// ->group_by('MONTH(TGL_DISETUJUI)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}

		$data = $this->db->get();

		return $data->result();
	}

	public function select_permohonan_ditolak($year, $month, $id_form_limit = array()){
		$this->db->select('t_perusahaan.NAMA_PERUSAHAAN, r_permohonan_izin.ID_PERMOHONAN, r_permohonan_izin.TGL_PENGAJUAN, fgen_t_izin_instansi.NAMA_FORM, t_user.NAMA')
		->from('r_permohonan_izin')
		->join('t_perusahaan', 'r_permohonan_izin.ID_PERUSAHAAN = t_perusahaan.ID_PERUSAHAAN')
		->join('fgen_t_izin_instansi', 'r_permohonan_izin.ID_FORM = fgen_t_izin_instansi.ID_FORM')
		->join("t_user", "r_permohonan_izin.ID_USER_PENOLAK = t_user.ID_USER")
		->where('TGL_PENOLAKAN IS NOT NULL', NULL, FALSE)
		->where('YEAR(TGL_PENGAJUAN)', $year)
		->where('MONTH(TGL_PENGAJUAN)', $month);
		// ->group_by('YEAR(TGL_PENOLAKAN)')
		// ->group_by('MONTH(TGL_PENOLAKAN)');

		if(!empty($id_form_limit)) {
			$this->db->where_in("r_permohonan_izin.ID_FORM", $id_form_limit);
		}

		$data = $this->db->get();

		return $data->result();
	}

	public function catatan_evaluasi($id_permohonan) {
		$data = $this->db->select("NAMA, URAIAN_CAT_DOK_PRSHN, KETERANGAN_CAT_DOK_PRSHN, TGL_CAT_DOK_PRSHN")
		->from("r_tracking_proses")
		->join("t_user", "r_tracking_proses.ID_USER = t_user.ID_USER")
		->where("URAIAN_CAT_DOK_PRSHN IS NOT", NULL)
		->where("ID_PERMOHONAN", $id_permohonan)
		->order_by("TGL_CAT_DOK_PRSHN", "DESC")
		->order_by("ID_TRACKING_PROSES", "DESC")
		->get();

		return $data->row();
	}
}