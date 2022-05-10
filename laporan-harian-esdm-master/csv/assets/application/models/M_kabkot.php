<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kabkot extends CI_Model {
	public function select_all() {
		$sql = "SELECT t_provinsi.NAMA_PROVINSI, t_provinsi.NAMA_PROVINSI_EN, t_kabkot.ID_KABKOT, t_kabkot.ID_PROVINSI, t_kabkot.NAMA_KABKOT, t_kabkot.MULAI_EXIST, t_kabkot.AKHIR_EXIST, t_kabkot.IS_KOTA, t_kabkot.KODE_NEGARA, t_kabkot.NAMA_KABKOT_EN, t_kabkot.DATE_MODIFIED, t_kabkot.EDIT_BY FROM t_kabkot, t_provinsi WHERE t_kabkot.ID_PROVINSI = t_provinsi.ID_PROVINSI";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		// clean_sql($data);
		// vdd($data);
		// $sql = "INSERT INTO t_kabkot VALUES(null, '" .$data['ID_PROVINSI'] ."', '" .$data['NAMA_KABKOT'] ."', '" .$data['MULAI_EXIST'] ."', '" .$data['AKHIR_EXIST'] ."', '" .$data['IS_KOTA'] ."', '" .$data['KODE_NEGARA'] ."', '" .$data['NAMA_KABKOT_EN'] ."', '" .$data['DATE_MODIFIED'] ."', '" .$data['EDIT_BY'] ."')";

		// $this->db->query($sql);

		// return $this->db->affected_rows();

		$new_data = array(
			"EDIT_BY" => $data["EDIT_BY"],
			"DATE_MODIFIED" => $data["DATE_MODIFIED"],
			"NAMA_KABKOT" => $data["NAMA_KABKOT"],
			"NAMA_KABKOT_EN" => $data["NAMA_KABKOT_EN"],
			"MULAI_EXIST" => $data["MULAI_EXIST"],
			"AKHIR_EXIST" => $data["AKHIR_EXIST"],
			"KODE_NEGARA" => $data["KODE_NEGARA"],
			"ID_PROVINSI" => $data["ID_PROVINSI"],
			"IS_KOTA" => $data["IS_KOTA"]
		);

		return $this->db->insert('t_kabkot', $new_data);
	}

	public function select_by_provinsi($id) {
		clean_sql($id);
		$hasil=$this->db->query("SELECT * FROM t_kabkot WHERE ID_PROVINSI = '{$id}'");
		return $hasil->result();
	}

	public function select_by_id($id) {
		clean_sql($id);
		$sql = "SELECT t_provinsi.NAMA_PROVINSI, t_provinsi.NAMA_PROVINSI_EN, t_kabkot.ID_KABKOT, t_kabkot.ID_PROVINSI, t_kabkot.NAMA_KABKOT, t_kabkot.MULAI_EXIST, t_kabkot.AKHIR_EXIST, t_kabkot.IS_KOTA, t_kabkot.KODE_NEGARA, t_kabkot.NAMA_KABKOT_EN, t_kabkot.DATE_MODIFIED, t_kabkot.EDIT_BY FROM t_kabkot, t_provinsi WHERE t_kabkot.ID_PROVINSI = t_provinsi.ID_PROVINSI AND t_kabkot.ID_KABKOT = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		clean_sql($data);
		$sql = "UPDATE t_kabkot SET ID_PROVINSI='" .$data['ID_PROVINSI'] ."', NAMA_KABKOT='" .$data['NAMA_KABKOT'] ."', MULAI_EXIST='" .$data['MULAI_EXIST'] ."', AKHIR_EXIST='" .$data['AKHIR_EXIST'] ."', IS_KOTA='" .$data['IS_KOTA'] ."', KODE_NEGARA='" .$data['KODE_NEGARA'] ."', NAMA_KABKOT_EN='" .$data['NAMA_KABKOT_EN'] ."', DATE_MODIFIED='" .$data['DATE_MODIFIED'] ."', EDIT_BY='" .$data['EDIT_BY'] ."'  WHERE ID_KABKOT = '" .$data['ID_KABKOT'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		clean_sql($id);
		$sql = "DELETE FROM t_kabkot WHERE ID_KABKOT = '" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('NAMA_KABKOT', $nama);
		$data = $this->db->get('t_kabkot');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('t_kabkot');

		return $data->num_rows();
	}
}