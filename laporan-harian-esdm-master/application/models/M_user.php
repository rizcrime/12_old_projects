<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	public function select_all() {
		$sql = "SELECT * FROM t_user LEFT join t_role on t_user.ID_ROLE = t_role.ID_ROLE";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id_user) {
		$data = $this->db->select("EMAIL_USER, USERNAME, NAMA, NIP")
		->from("t_user")
		->where("ID_USER", $id_user)
		->get();

		return $data->row();
	}

	public function delete($id) {
		clean_sql($id);
		$sql = "DELETE FROM t_user WHERE ID_USER='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		clean_sql($data);
		$sql = "INSERT INTO t_user VALUES('','" .$data['USERNAME'] ."','" .md5($data['PASSWORD']) ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($username) {
		$this->db->where('USERNAME', $username);
		$data = $this->db->get('user');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('T_USER');

		return $data->num_rows();
	}

	public function update($data, $id) {
		$this->db->where("ID_USER", $id);
		$this->db->update("t_user", $data);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('ID_USER', $id);
		}

		$data = $this->db->get('t_user');

		return $data->row();
	}
}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */