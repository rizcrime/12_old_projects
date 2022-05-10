<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_list_user extends CI_Model {
	public function select_all($id) {

		$this->db->select("
			u.USERNAME,
			u.NAMA,
			u.EMAIL_USER,
			u.NIP,
			u.JABATAN_STRUKTURAL
		");
		$this->db->from("r_user_izin_instansi uii");
		$this->db->join("t_user u", "uii.ID_USER = u.ID_USER");
		$this->db->join("fgen_t_izin_instansi ii", "uii.ID_FORM = ii.ID_FORM");

		if ($id > 0) // jika ada izin yang dipilih
		{
			$this->db->where("ii.ID_FORM", $id);
		}

		$this->db->order_by("NIP, NAMA");

		$data = $this->db->get();
		return $data->result();
	}

	public function select_all_izin() {
		$this->db->select("
			ID_FORM,
			NAMA_FORM
		");
		$this->db->from("fgen_t_izin_instansi");
		
		$data = $this->db->get();
		return $data->result();
	}
}