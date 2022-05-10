<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pusdatin extends CI_Model {
	
	public function select_all_jenis_laporan() {
		$this->db->select('ID_JENIS_LAPORAN,URUTAN_LAPORAN,ID_KATEGORI,JENIS_LAPORAN');
		$this->db->from('t_jenis_laporan');
		$this->db->where('ID_KATEGORI', 1);

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data, $table) {
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}

	public function select_pusdatin_berita_opec_harian() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_berita_opec_harian');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_harga_bbm() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bbm');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_harga_bb_acuan() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bb_acuan');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_harga_mineral_acuan() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_mineral_acuan');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_icp() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_icp');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_lift_tb() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_lift_tb');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_ekui_migas() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_ekui_migas');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_gas() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_gas');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_minyak() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_minyak');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prog_peny_prem_jamali() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prog_peny_prem_jamali');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_stts_tl() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_stts_tl');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}



	public function select_by_id($id) {
		$this->db->select('*');
		$this->db->from('t_role');
		$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}
	
	public function select_by_jenis_draft($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$data = $this->db->get();
		

		return $data->result();
	}
	
	public function select_by_jenis_history($table,$TANGGAL_AWAL,$TANGGAL_AKHIR) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		if(!empty($TANGGAL_AWAL)){
			$this->db->where('TANGGAL_LAPORAN >=', date('Y-m-d',strtotime($TANGGAL_AWAL)));
		}
		if(!empty($TANGGAL_AKHIR)){
			$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d',strtotime($TANGGAL_AKHIR)));
		}
		$data = $this->db->get();
		

		return $data->result();
	}

	public function select_role_by_skema($id) {
		clean_sql($id);

		// $sql = "SELECT * FROM r_role_skema JOIN t_role ON ID_ROLE = WHERE ID_SKEMA = '{$id}'";
		$sql = "SELECT t_role.ID_ROLE as TR, t_role.ROLE , r_role_skema.ID_ROLE as RR  FROM t_role LEFT JOIN r_role_skema ON r_role_skema.ID_ROLE = t_role.ID_ROLE AND ID_SKEMA = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function update($data) {
		$this->db->where('ID_ROLE', $data['ID_ROLE']);
		$this->db->update('t_role', $data);
		// $sql = "UPDATE t_role SET ROLE='" .$data['ROLE'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_ROLE = '".$data['ID_ROLE']."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function post($table, $id, $id_user) {
		$data = array(
			'IS_POST' => "Y",
			'USER_POST' => $id_user,
			'TANGGAL_POST' => date("Y-m-d H:m:s"),
			'FLATFORM_POST' => "WEB"
		);
		
		$this->db->where('ID_LAPORAN', $id);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('t_role');

		return $data->num_rows();
	}

	public function check_id($id) {
		$this->db->where('ID_ROLE', $id);
		$data = $this->db->get('t_role');

		return $data->num_rows();
	}

	public function total_rows() {
		$this->db->select('*');
		$this->db->from('t_role');
		$data = $this->db->get();

		return $data->num_rows();
	}


}