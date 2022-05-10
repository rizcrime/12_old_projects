<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_target extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('t_target');

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data) {
		$this->db->insert('t_target', $data);
		// $sql = "INSERT INTO t_target VALUES('".$data['ID_TARGET']."', '".$data['TARGET']."','".$data['TINGKAT']."')";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function select_by_id($id) {
		$this->db->select('*');
		$this->db->from('t_target');
		$this->db->where('ID_TARGET', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_target WHERE ID_TARGET = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}
	
	public function select_by_apbn_tahun_prod_minyak() {
		$this->db->select('APBN_PROD_MINYAK');
		$this->db->from('t_target');
		$this->db->where('TAHUN =', date('Y'));
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_target WHERE ID_TARGET = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}
	/*public function select_akses_target($id_user) {
		$this->db->select('d.KATEGORI_LAPORAN');
		$this->db->from('t_hak_akses_target a');
		$this->db->join('t_kategori d','a.ID_KATEGORI = d.ID_KATEGORI','left');
		$this->db->join('t_target b','a.ID_TARGET = b.ID_TARGET','left');
		$this->db->join('t_user c','b.ID_TARGET = c.ID_TARGET','left');
		$this->db->where('c.ID_USER', $id_user);
		$data = $this->db->get();
		foreach ($data->result() as $row)
		{
			$menu = $row->KATEGORI_LAPORAN;
	    	$menuArr["$menu"] = "Y";
		}
		
		return $menuArr;
	}*/

	/*public function select_target_by_skema($id) {
		clean_sql($id);

		// $sql = "SELECT * FROM r_target_skema JOIN t_target ON ID_TARGET = WHERE ID_SKEMA = '{$id}'";
		$sql = "SELECT t_target.ID_TARGET as TR, t_target.TARGET , r_target_skema.ID_TARGET as RR  FROM t_target LEFT JOIN r_target_skema ON r_target_skema.ID_TARGET = t_target.ID_TARGET AND ID_SKEMA = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}*/

	public function update($data) {
		$this->db->where('ID_TARGET', $data['ID_TARGET']);
		$this->db->update('t_target', $data);
		// $sql = "UPDATE t_target SET TARGET='" .$data['TARGET'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_TARGET = '".$data['ID_TARGET']."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where('ID_TARGET', $id);
		$this->db->delete('t_target');

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('t_target');

		return $data->num_rows();
	}

	public function check_id($id) {
		$this->db->where('ID_TARGET', $id);
		$data = $this->db->get('t_target');

		return $data->num_rows();
	}

	public function total_rows() {
		$this->db->select('*');
		$this->db->from('t_target');
		$data = $this->db->get();

		return $data->num_rows();
	}


}