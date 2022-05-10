<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_provinsi extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('t_provinsi');

		$data = $this->db->get();

		return $data->result();
	}

	public function insert($data) {
		// clean_sql($data);

		// vdd($data);
		// $sql = "INSERT INTO t_provinsi VALUES(null, null, '" .$data['NAMA_PROVINSI'] ."', '" .$data['MULAI_EXIST'] ."', '" .$data['AKHIR_EXIST'] ."', '" .$data['KODE_PROVINSI'] ."', '" .$data['NAMA_PROVINSI_EN'] ."', '" .$data['DATE_MODIFIED'] ."', '" .$data['EDIT_BY'] ."')";

		// $this->db->query($sql);

		// return $this->db->affected_rows();
		$new_data = array(
			"EDIT_BY" => $data["EDIT_BY"],
			"DATE_MODIFIED" => $data["DATE_MODIFIED"],
			"NAMA_PROVINSI" => $data["NAMA_PROVINSI"],
			"NAMA_PROVINSI_EN" => $data["NAMA_PROVINSI_EN"],
			"MULAI_EXIST" => $data["MULAI_EXIST"],
			"AKHIR_EXIST" => $data["AKHIR_EXIST"],
			"KODE_PROVINSI" => $data["KODE_PROVINSI"]
		);
		
		return $this->db->insert('t_provinsi', $new_data);
	}

	public function select_by_id($id) {
		clean_sql($id);
		$sql = "SELECT * FROM t_provinsi WHERE ID_PROVINSI = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		clean_sql($data);
		$sql = "UPDATE t_provinsi SET NAMA_PROVINSI='" .$data['NAMA_PROVINSI'] ."', MULAI_EXIST='" .$data['MULAI_EXIST'] ."', AKHIR_EXIST='" .$data['AKHIR_EXIST'] ."', KODE_PROVINSI='" .$data['KODE_PROVINSI'] ."', NAMA_PROVINSI_EN='" .$data['NAMA_PROVINSI_EN'] ."', DATE_MODIFIED='" .$data['DATE_MODIFIED'] ."', EDIT_BY='" .$data['EDIT_BY'] ."'  WHERE ID_PROVINSI = '" .$data['ID_PROVINSI'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		clean_sql($id);
		$sql = "DELETE FROM t_provinsi WHERE ID_PROVINSI = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('NAMA_PROVINSI', $nama);
		$data = $this->db->get('t_provinsi');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('t_provinsi');

		return $data->num_rows();
	}
}