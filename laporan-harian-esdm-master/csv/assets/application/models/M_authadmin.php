<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authadmin extends CI_Model {
	public function login($user, $pass) {
		$this->db->select('*');
		$this->db->from('t_user');
		$this->db->where('USERNAME', $user);
		$this->db->where('PASSWORD', md5($pass));

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		}

		
		return false;

	}

	public function is_currently_logged_in($tgl_login) {
		if($tgl_login === NULL) {
			return FALSE;
		}

		$sess_expiration = $this->config->item('sess_expiration');
		$now_date = date("Y-m-d H:i:s");

		return ($this->difference_in_seconds($tgl_login, $now_date) < $sess_expiration);
	}

	public function set_tgl_login($tgl_login, $id_user) {
		$this->db->set("TGL_LOGIN", $tgl_login);
		$this->db->where('ID_USER', $id_user);
		return $this->db->update("t_user");
	}

	public function get_tgl_login($id_user) {
		$data = $this->db->select("TGL_LOGIN")
		->where("ID_USER", $id_user)
		->from("t_user")
		->get();

		return $data->row()->TGL_LOGIN;
	}

	private function difference_in_seconds($timeFirst, $timeSecond) {
		$timeFirst  = strtotime($timeFirst);
		$timeSecond = strtotime($timeSecond);
		return ($timeSecond - $timeFirst);
	}
}