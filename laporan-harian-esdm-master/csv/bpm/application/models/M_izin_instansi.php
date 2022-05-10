<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_izin_instansi extends CI_Model {
	public function select_all() {
		// $sql = "SELECT * FROM fgen_t_izin_instansi ORDER BY NAMA_FORM ASC";

		// $data = $this->db->query($sql);
		
		// return $data->result();

		$data = $this->db->select("*")
		->from("fgen_t_izin_instansi")
		->order_by("NAMA_FORM", "ASC")
		->where("IS_PUBLISH", "Y")
		->get();

		return $data->result();
	}

	public function select_by_id($id) {
		clean_sql($id);
		$sql = "SELECT * FROM fgen_t_izin_instansi WHERE ID_FORM = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function delete($id) {
		clean_sql($id);
		$sql = "DELETE FROM fgen_t_izin_instansi WHERE ID_FORM = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		clean_sql($data);
		$sql = "INSERT INTO fgen_t_izin_instansi VALUES('','".$data['NAMA']."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		clean_sql($data);
		$sql = "UPDATE fgen_t_izin_instansi SET NAMA='" .$data['NAMA'] ."' WHERE ID_FORM='" .$data['ID_FORM'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($username) {
		$this->db->where('USERNAME', $username);
		$data = $this->db->get('fgen_t_izin_instansi');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('fgen_t_izin_instansi');

		return $data->num_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('NIK', $id);
		}

		$data = $this->db->get('fgen_t_izin_instansi');

		return $data->row();
	}

	public function select_list_template($id_form) {
		$data = $this->db->select("*")
		->from("fgen_r_template_izin")
		->where("ID_FORM", $id_form)
		->get();

		return $data->result();
	}

	public function select_template($id_template) {
		$data = $this->db->select("*")
		->from("fgen_r_template_izin")
		->where("ID_TEMPLATE", $id_template)
		->get();

		return $data->row();
	}
}