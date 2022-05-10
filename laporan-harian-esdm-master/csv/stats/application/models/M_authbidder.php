<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authbidder extends CI_Model {
	public function login($user, $pass) {
		$this->db->select('*');
		$this->db->from('t_perusahaan');
		$this->db->where('EMAIL_PERUSAHAAN', $user);
		$this->db->where('PASSWORD', md5($pass));

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return FALSE;
		}
	}

	public function set_tgl_login($tgl_login, $id_perusahaan) {
		$this->db->set("TGL_LOGIN", $tgl_login);
		$this->db->where('ID_PERUSAHAAN', $id_perusahaan);
		return $this->db->update("t_perusahaan");
	}

	public function get_tgl_login($id_perusahaan) {
		$data = $this->db->select("TGL_LOGIN")
		->where("ID_PERUSAHAAN", $id_perusahaan)
		->from("t_perusahaan")
		->get();

		return $data->row()->TGL_LOGIN;
	}
}