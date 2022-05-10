<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pusdatin extends CI_Model {
	
	public function select_all_jenis_laporan() {
		$this->db->select('ID_JENIS_LAPORAN,URUTAN_LAPORAN,ID_KATEGORI,JENIS_LAPORAN');
		$this->db->from('t_jenis_laporan');
		$this->db->where('ID_KATEGORI', 1);
		$this->db->where('JENIS_LAPORAN <>', 'Progres Penyaluran Premium Jamali');

		$data = $this->db->get();
		return $data->result();
	}

	public function cek_pusdatin_minyak() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_minyak');
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->like('TANGGAL_ENTRY', date('Y-m-d'));
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));

		$data = $this->db->get();
		// return $data->result();	
		// echo $this->db->last_query();


		// $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");

		// $data = $this->db->get();
		// return $data->result();
		// echo $this->db->last_query();

	}

	public function select_tugas_entry() {
		$this->db->select('
							(SELECT COUNT(*) FROM r_lap_pusdatin_berita_opec_harian WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_berita_opec_harianCount, 

							(SELECT COUNT(*) FROM r_lap_pusdatin_harga_bbm WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_harga_bbmCount, 

							(SELECT COUNT(*) FROM r_lap_pusdatin_harga_bb_acuan WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL  ) as r_lap_pusdatin_harga_bb_acuanCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_harga_mineral_acuan WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_harga_mineral_acuanCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_icp WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_icpCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_lift_tb WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_lift_tbCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_prod_ekui_migas WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_prod_ekui_migasCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_prod_gas WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_prod_gasCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_prod_minyak WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_prod_minyakCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_prog_peny_prem_jamali WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL ) as r_lap_pusdatin_prog_peny_prem_jamaliCount,

							(SELECT COUNT(*) FROM r_lap_pusdatin_stts_tl WHERE IS_POST IS NULL AND TANGGAL_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND TANGGAL_REVIEW IS NULL) as r_lap_pusdatin_stts_tlCount


							');
		// $this->db->from('t_jenis_laporan');
		// $this->db->where('ID_KATEGORI', 1);
		// $this->db->where('JENIS_LAPORAN <>', 'Progres Penyaluran Premium Jamali');

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data, $table) {
		$this->db->insert($table, $data);
		// $this->db->limit(1);

		// return $this->db->affected_rows();
		
		$this->db->set('READY_REVIEW', 'Y');
		$this->db->where('ID_ROLE', 15);
		$this->db->update('t_user');
		$this->db->set('HAS_REVIEW', Null);
		$this->db->where('ID_ROLE', 15);
		$this->db->update('t_user');
		$this->db->set('READY_POST', Null);
		$this->db->where('ID_ROLE', 8);
		$this->db->update('t_user');
		$this->db->set('HAS_POST', Null);
		$this->db->where('ID_ROLE', 8);
		$this->db->set('HAS_UNPOST', Null);
		$this->db->where('ID_ROLE', 8);
	return	$this->db->update('t_user');
		
		// return $this->db->affected_rows();
		// echo $this->db->last_query();

	}

	public function select_pusdatin_berita_opec_harian() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_berita_opec_harian');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_berita_opec_harian_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_berita_opec_harian');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_harga_bbm() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bbm');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_harga_bbm_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bbm');
		date_default_timezone_set("Asia/Jakarta");
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_harga_bb_acuan() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bb_acuan');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_harga_bb_acuan_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_bb_acuan');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_harga_mineral_acuan() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_mineral_acuan');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_harga_mineral_acuan_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_harga_mineral_acuan');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_pusdatin_icp() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_icp');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_icp_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_icp');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_lift_tb() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_lift_tb');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_lift_tb_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_lift_tb');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_ekui_migas() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_ekui_migas');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_ekui_migas_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_ekui_migas');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_gas() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_gas');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_gas_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_gas');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_minyak() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_minyak');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prod_minyak_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prod_minyak');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prog_peny_prem_jamali() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prog_peny_prem_jamali');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_prog_peny_prem_jamali_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_prog_peny_prem_jamali');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_stts_tl() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_stts_tl');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_pusdatin_stts_tl_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_pusdatin_stts_tl');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	// public function select_prod_minyak($id,$table){
	// 	$this->db->select('r_lap_pusdatin_prod_minyak');
	// 	$this->db->from($table);
	// 	$this->db->join('t_gunung', 'r_lap_geologi_gunung_api.ID_GUNUNG = t_gunung.ID_GUNUNG');
	// 	$this->db->join('t_aktivitas', 'r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS');
	// 	$this->db->where('ID_LAPORAN',$id);
	// 	$datanya = $this->db->get();

	// 	return $datanya->result();
	// }

	public function select_prod_minyak($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}

	public function select_icp($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}


	public function select_prod_gas($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_ekui_migas($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_lift_tb($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_harga_bbm($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_jamali($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_opec($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_bb_acuan($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}
	public function select_mineral_acuan($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
	}

	public function select_stts_tl($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN', $id);
		$datanya = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $datanya->result();
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
	
	public function cek_pernah_input($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
	

		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}
	public function cek_pernah_upload_prod_minyak($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');

				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_icp($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_prod_gas($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_prod_ekui_migas($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_lift_tb($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
			$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		$this->db->where('USER_UNPOST', 'IS NOT NULL');

				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_harga_bbm($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');

				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_berita_opec($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_bb_acuan($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}public function cek_pernah_upload_mineral_acuan($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');


				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}
	public function cek_pernah_upload_sttl($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		// 	$this->db->where('TANGGAL_UNPOST', 'IS NOT NULL');
		// $this->db->where('USER_UNPOST', 'IS NOT NULL');

				$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('USER_POST', Null);
		
		$this->db->where('TANGGAL_UNPOST', Null);
		// $this->db->where('TANGGAL_UNPOST', 'IS  NULL');
		$this->db->where('USER_UNPOST', Null);
		// $this->db->where('TANGGAL_REVIEW', 'IS NOT NULL');
		// $this->db->where('USER_REVIEW', 'IS NOT NULL');
		$this->db->where('CATATAN_REVIEW', Null);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}

	public function select_by_jenis_draft($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('HAS_REVIEW', Null);
		$this->db->where('CATATAN_REVIEW', Null);
		$this->db->where('TANGGAL_REVIEW', Null);
		$this->db->order_by('TANGGAL_LAPORAN','ASC');
	//	$this->db->limit(1);
		// ORDER BY `TANGGAL_LAPORAN` ASC LIMIT 1
		$data = $this->db->get();
		

		return $data->result();
		// echo $this->db->last_query();
	}

	public function select_by_jenis_draft_entry($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('HAS_REVIEW', Null);
		$this->db->where('TANGGAL_REVIEW', Null);
		$this->db->order_by('TANGGAL_LAPORAN','ASC');
		// $this->db->limit(1);
		$data = $this->db->get();
		

		return $data->result();
	}

	// public function select_by_jenis_draft_entry($table) {
	// 	$this->db->select('*');
	// 	$this->db->from($table);
	// 	$this->db->where('IS_POST', Null);
	// 	$this->db->where('TANGGAL_POST', Null);
	// 	$this->db->where('CATATAN_REVIEW <>', Null);
	// 	$this->db->where('HAS_REVIEW', Null);
	// 	$this->db->where('TANGGAL_REVIEW', Null);
	// 	$this->db->order_by('TANGGAL_LAPORAN','ASC');
	// 	// $this->db->limit(1);
	// 	$data = $this->db->get();
		

	// 	return $data->result();
	// }

	// public function select_tugas_draft_entry($table) {
	// 	$this->db->select('*');
	// 	$this->db->from($table);
	// 	$this->db->where('IS_POST', Null);
	// 	$this->db->where('TANGGAL_POST', Null);
	// 	$this->db->where('CATATAN_REVIEW <>', Null);
	// 	$this->db->where('HAS_REVIEW', Null);
	// 	$this->db->where('TANGGAL_REVIEW', Null);
	// 	$data = $thdatais->db->get();
	// 	$rowcount = $data->num_rows();

	// 	return $rowcount->result();
	// }

	public function select_by_jenis_draft_has_review($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		// $this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);
		$this->db->order_by('TANGGAL_LAPORAN','ASC');
		// $this->db->limit(1);
		$data = $this->db->get();
		

		return $data->result();
		// echo $this->db->last_query();

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
		// echo $this->db->last_query();

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

	public function delete($table,$id,$id_user) {
		$this->db->where('ID_LAPORAN', $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	public function post($table, $id, $id_user) {
			$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;
		$data = array(
			'IS_POST' => "Y",
			'USER_POST' => $id_user,
			'TANGGAL_POST' => date("Y-m-d H:m:s"),
			'FLATFORM_POST' => "WEB"
		);
		
		$this->db->where('ID_LAPORAN', $id);
		$this->db->update($table, $data);


		return $this->db->affected_rows();

		// $this->db->set('READY_POST', Null);
		// $this->db->set('HAS_POST', 'Y');
		// $this->db->where('ID_ROLE', $id_role);
		// // $this->db->where('ID_ROLE', 17);
		// // $this->db->where('ID_USER', 18);
		
		// return	$this->db->update('t_user');
	}

	public function hasreview($table, $id, $id_user) {
				// print_r($this->session->userdata); die();
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;

		$data = array(
			'HAS_REVIEW' => "Y",
			'USER_REVIEW' => $id_user,
			'TANGGAL_REVIEW' => date("Y-m-d H:m:s"),
			'FLATFORM_REVIEW' => "WEB"
		);
		
		$this->db->where('ID_LAPORAN', $id);
		$this->db->update($table, $data);

		return $this->db->affected_rows();





		// $this->db->set('HAS_REVIEW', 'Y');
		// $this->db->set('READY_REVIEW', Null);
		
		// $this->db->where('ID_ROLE', $id_role);
		// $this->db->update('t_user');


		
		// $this->db->set('READY_POST', 'Y');
		// $this->db->where('ID_ROLE', 8);
		// // $this->db->where('ID_ROLE', 17);
		// // $this->db->where('ID_USER', 18);
		
		// return	$this->db->update('t_user');


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

	public function prosesUpdateDraftProdMinyak($dataUpdate) {
		$table = "r_lap_pusdatin_prod_minyak";
		$prodharian = $dataUpdate['dataprodharian'];
		$prodbulanan = $dataUpdate['dataprodbulanan'];
		$prodTahunan = $dataUpdate['dataprodTahunan'];
		$apbn = $dataUpdate['dataapbn'];
		$catatan = $dataUpdate['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN' => $catatan,
		    'CATATAN_REVIEW' => Null,
		);
		// var_dump($data);die;
		// echo($data).'hehe';
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
		// echo $this->db->last_query();

	}

	public function prosesReviewDraftProdMinyak($dataReview) {
		$table = "r_lap_pusdatin_prod_minyak";
		$prodharian = $dataReview['dataprodharian'];
		$prodbulanan = $dataReview['dataprodbulanan'];
		$prodTahunan = $dataReview['dataprodTahunan'];
		$apbn = $dataReview['dataapbn'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$catatan = $dataReview['dataCatatan'];
		// var_dump($catatan_review);die;
		// echo $catatan_review.'123';
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN_REVIEW' => $catatan_review,
			'CATATAN' => $catatan
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	


	public function prosesUpdateDraftICP($dataUpdate) {
		$table = "r_lap_pusdatin_icp";
		$keterangan = $dataUpdate['dataKeterangan'];
		// $prodbulanan = $dataUpdate['dataprodbulanan'];
		// $prodTahunan = $dataUpdate['dataprodTahunan'];
		// $apbn = $dataUpdate['dataapbn'];
		// // $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'KETERANGAN' => $keterangan,
			'CATATAN_REVIEW' => Null,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}


	public function prosesReviewDraftICP($dataReview) {
		$table = "r_lap_pusdatin_icp";
		$keterangan = $dataReview['dataKeterangan'];
		$catatan_review = $dataReview['dataCatatanReview'];
		// echo $catatan_review.'123';
		// var_dump($catatan_review);die;
		// $prodbulanan = $dataUpdate['dataprodbulanan'];
		// $prodTahunan = $dataUpdate['dataprodTahunan'];
		// $apbn = $dataUpdate['dataapbn'];
		// // $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'KETERANGAN' => $keterangan,
			'CATATAN_REVIEW' => $catatan_review,

			
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}



	public function prosesUpdateDraftProdGas($dataUpdate) {
		$table = "r_lap_pusdatin_prod_gas";
		$prodharian = $dataUpdate['dataprodharian'];
		$prodbulanan = $dataUpdate['dataprodbulanan'];
		$prodTahunan = $dataUpdate['dataprodTahunan'];
		$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$catatan = $dataUpdate['dataCatatan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => Null,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}

	public function prosesReviewDraftProdGas($dataReview) {
		$table = "r_lap_pusdatin_prod_gas";
		$prodharian = $dataReview['dataprodharian'];
		$prodbulanan = $dataReview['dataprodbulanan'];
		$prodTahunan = $dataReview['dataprodTahunan'];
		$apbn = $dataReview['dataapbn'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$catatan = $dataReview['dataCatatan'];
		// echo $catatan_review.'123';
		// var_dump($catatan_review);die;
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN_REVIEW' => $catatan_review,
			'CATATAN' => $catatan

		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}



	public function prosesUpdateDraftEkuiMigas($dataUpdate) {
		$table = "r_lap_pusdatin_prod_ekui_migas";
		$prodharian = $dataUpdate['dataprodharian'];
		$prodbulanan = $dataUpdate['dataprodbulanan'];
		$prodTahunan = $dataUpdate['dataprodTahunan'];
		$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$catatan = $dataUpdate['dataCatatan'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN_REVIEW' => Null,
			'CATATAN' => $catatan
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}
	public function prosesReviewDraftEkuiMigas($dataReview) {
		$table = "r_lap_pusdatin_prod_ekui_migas";
		$prodharian = $dataReview['dataprodharian'];
		$prodbulanan = $dataReview['dataprodbulanan'];
		$prodTahunan = $dataReview['dataprodTahunan'];
		$apbn = $dataReview['dataapbn'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$catatan = $dataReview['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}


	public function prosesUpdateDraftLiftTB($dataUpdate) {
		$table = "r_lap_pusdatin_lift_tb";
		$liftmb = $dataUpdate['dataLiftMB'];
		// $posisistock = $dataUpdate['dataPosisiStock'];
		$salurgas = $dataUpdate['dataSalurGas'];
		$liftgas = $dataUpdate['dataLiftGas'];
		//$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'LIFT_MB' => $liftmb,
			// 'POSISI_STOCK' => $posisistock,
			// 'DETAIL' => $detail,
			'SALUR_GAS' => $salurgas,
			'LIFT_GAS' => $liftgas,
			'CATATAN_REVIEW' => Null,
			//'APBN' => $apbn
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}

	public function prosesReviewDraftLiftTB($dataReview) {
		$table = "r_lap_pusdatin_lift_tb";
		$liftmb = $dataReview['dataLiftMB'];
		// $posisistock = $dataReview['dataPosisiStock'];
		$salurgas = $dataReview['dataSalurGas'];
		$liftgas = $dataReview['dataLiftGas'];
		$catatan = $dataReview['dataCatatan'];
		$catatan_review = $dataReview['dataCatatanReview'];
		// echo $catatan_review.'123';
		// var_dump($catatan_review);die;
		//$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'LIFT_MB' => $liftmb,
			// 'POSISI_STOCK' => $posisistock,
			// 'DETAIL' => $detail,
			'SALUR_GAS' => $salurgas,
			'LIFT_GAS' => $liftgas,
			// 'CATATAN_REVIEW' => Null,
			'CATATAN' => $catatan,

			'CATATAN_REVIEW' => $catatan_review,
			//'APBN' => $apbn
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftHargaBBM($dataUpdate) {
		$table = "r_lap_pusdatin_harga_bbm";
		$bbmtertentu = $dataUpdate['dataBBMTertentu'];
		$bbmumum = $dataUpdate['dataBBMUmum'];
		$indonesiasatuharga = $dataUpdate['dataIndonesiaSatuHarga'];
		$hargapernegara = $dataUpdate['dataHargaPerNegara'];
		// $vona = $dataUpdate['dataVona'];
		$catatan = $dataUpdate['dataCatatan'];

		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'JENIS_TERTENTU' => $bbmtertentu,
			'BBM_UMUM' => $bbmumum,
			// 'DETAIL' => $detail,
			'PROG_IND_SATU_HRG' => $indonesiasatuharga,
			'HARGA_PERNEGARA' => $hargapernegara,
			'CATATAN' => $catatan,

			'CATATAN_REVIEW' => Null,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}
	

	public function prosesReviewDraftHargaBBM($dataReview) {
		$table = "r_lap_pusdatin_harga_bbm";
		$bbmtertentu = $dataReview['dataBBMTertentu'];
		$bbmumum = $dataReview['dataBBMUmum'];
		$indonesiasatuharga = $dataReview['dataIndonesiaSatuHarga'];
		$hargapernegara = $dataReview['dataHargaPerNegara'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$catatan = $dataReview['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'JENIS_TERTENTU' => $bbmtertentu,
			'BBM_UMUM' => $bbmumum,
			// 'DETAIL' => $detail,
			'PROG_IND_SATU_HRG' => $indonesiasatuharga,
			'HARGA_PERNEGARA' => $hargapernegara,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => $catatan_review,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}


	public function prosesUpdateDraftJamali($dataUpdate) {
		$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		$progress = $dataUpdate['dataProgress'];
		$catatan = $dataUpdate['dataCatatan'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROGRESS' => $progress,
			'CATATAN' => $catatan
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}


	public function prosesUpdateDraftOpec($dataUpdate) {
		$table = "r_lap_pusdatin_berita_opec_harian";
		$berita = $dataUpdate['dataBerita'];
		$catatan = $dataUpdate['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'BERITA' => $berita,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => Null
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	
	}

	public function prosesReviewDraftOpec($dataReview) {
		$table = "r_lap_pusdatin_berita_opec_harian";
		$berita = $dataReview['dataBerita'];
		$catatan = $dataReview['dataCatatan'];

		// $vona = $dataUpdate['dataVona'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'BERITA' => $berita,
			'CATATAN' => $catatan,

			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	// public function prosesUpdateDraft($dataUpdate) {
	// 	$table = "r_lap_pusdatin_prod_minyak";
	// 	$prodharian = $dataUpdate['dataprodharian'];
	// 	$prodbulanan = $dataUpdate['dataprodbulanan'];
	// 	$prodTahunan = $dataUpdate['dataprodTahunan'];
	// 	$apbn = $dataUpdate['dataapbn'];
	// 	// $vona = $dataUpdate['dataVona'];
	// 	$idLaporan = $dataUpdate['dataIdLaporan'];
	// 	$data = array(
	// 		'PROD_HARIAN' => $prodharian,
	// 		'PROD_BULANAN' => $prodbulanan,
	// 		// 'DETAIL' => $detail,
	// 		'PROD_TAHUNAN' => $prodTahunan,
	// 		'APBN' => $apbn
	// 	);
	// 	$this->db->where('ID_LAPORAN', $idLaporan);
	// 	$this->db->update($table, $data);

	// 	return $this->db->affected_rows();
	// }
	public function prosesUpdateDraftBBAcuan($dataUpdate) {
		$table = "r_lap_pusdatin_harga_bb_acuan";
		$harga = $dataUpdate['dataHarga'];
		$sumber = $dataUpdate['dataSumber'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'HARGA' => $harga,
			'SUMBER' => $sumber,
			'CATATAN_REVIEW' => Null
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	
	}
	public function prosesReviewDraftBBAcuan($dataReview) {
		$table = "r_lap_pusdatin_harga_bb_acuan";
		$harga = $dataReview['dataHarga'];
		$sumber = $dataReview['dataSumber'];
		// $vona = $dataReview['dataVona'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'HARGA' => $harga,
			'SUMBER' => $sumber,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}
	public function prosesUpdateDraftMineralAcuan($dataUpdate) {
		$table = "r_lap_pusdatin_harga_mineral_acuan";
		$harga = $dataUpdate['dataHarga'];
		$sumber = $dataUpdate['dataSumber'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'HARGA' => $harga,
			'SUMBER' => $sumber,
			'CATATAN_REVIEW' => Null

		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();

	}

	public function prosesReviewDraftMineralAcuan($dataReview) {
		$table = "r_lap_pusdatin_harga_mineral_acuan";
		$catatan_review = $dataReview['dataCatatanReview'];
		// var_dump($catatan_review);die();
		$harga = $dataReview['dataHarga'];
		$sumber = $dataReview['dataSumber'];
		$idLaporan = $dataReview['dataIdLaporan'];

		$data = array(
			'HARGA' => $harga,
			'SUMBER' => $sumber,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}
	public function prosesUpdateDraftStatusTL($dataUpdate) {
		$table = "r_lap_pusdatin_stts_tl";
	
		$status = $dataUpdate['dataStatus'];
		
		$catatan = $dataUpdate['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'STATUS' => $status,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => Null
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
		// $this->db->set('HAS_REVIEW', 'Y');
		// $this->db->where('ID_ROLE', 15);
		// $this->db->update('t_user');
		// $this->db->set('HAS_REVIEW', 'Y');
		// $this->db->where('ID_ROLE', 17);
		// $this->db->update('t_user');
		// $this->db->set('HAS_REVIEW', 'Y');
		// $this->db->where('ID_ROLE', 18);
		// $this->db->where('ID_ROLE', 17);
		// $this->db->where('ID_USER', 18);
		
		// return	$this->db->update('t_user');
	}

	public function prosesReviewDraftStatusTL($dataReview) {
		$table = "r_lap_pusdatin_stts_tl";
		$status = $dataReview['dataStatus'];
		
		$catatan = $dataReview['dataCatatan'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'STATUS' => $status,
			'CATATAN' => $catatan,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}
	public function UnpostAllPost($id_user){
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;
		$this->db->set('r_lap_pusdatin_prod_minyak.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_minyak.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_minyak.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_minyak.CATATAN_REVIEW', Null);

		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_prod_minyak');
		$this->db->set('r_lap_pusdatin_icp.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_icp.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_icp.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_icp.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
				$this->db->set('r_lap_pusdatin_icp.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_icp.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_icp.CATATAN_REVIEW', Null);
				$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);	
		$this->db->update('r_lap_pusdatin_icp');


		$this->db->set('r_lap_pusdatin_prod_gas.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_gas.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_gas.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_gas.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_prod_gas');

		$this->db->set('r_lap_pusdatin_prod_ekui_migas.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_prod_ekui_migas');

		$this->db->set('r_lap_pusdatin_lift_tb.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_lift_tb.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_lift_tb.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_lift_tb.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_lift_tb');

		$this->db->set('r_lap_pusdatin_harga_bbm.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_bbm.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bbm.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_bbm.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_harga_bbm');

		
		$this->db->set('r_lap_pusdatin_berita_opec_harian.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_berita_opec_harian.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
				$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_berita_opec_harian');

		$this->db->set('r_lap_pusdatin_harga_bb_acuan.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.CATATAN_REVIEW', Null);
		$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);	
		$this->db->update('r_lap_pusdatin_harga_bb_acuan');

		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.CATATAN_REVIEW', Null);
			$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		$this->db->update('r_lap_pusdatin_harga_mineral_acuan');

		$this->db->set('r_lap_pusdatin_stts_tl.IS_POST', Null);
		$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_POST', Null);
		$this->db->set('r_lap_pusdatin_stts_tl.USER_UNPOST', $id_user);
		$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_UNPOST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_stts_tl.HAS_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_REVIEW', Null);
		$this->db->set('r_lap_pusdatin_stts_tl.CATATAN_REVIEW', Null);
			$this->db->where('IS_POST', 'Y');
		$this->db->where('USER_POST <>', Null);
		$this->db->where('TANGGAL_POST <>', Null);
		// $this->db->update('r_lap_pusdatin_stts_tl');

		$test = $this->db->update('r_lap_pusdatin_stts_tl');		

		if ($test) {
				$this->db->affected_rows();
				
				$this->db->set('HAS_UNPOST', 'Y');
				// $this->db->set('HAS_POST', Null);
				$this->db->where('HAS_POST', 'Y');
				$this->db->where('ID_ROLE', $id_role);
				$this->db->update('t_user');
				// return $this->db->affected_rows();
			
			// if ($test2) {
			// 	$this->db->affected_rows();
			// 	// $this->db->set('HAS_REVIEW', 'Y');
			// 	$this->db->set('READY_POST', 'Y');
				
			// 	$this->db->where('ID_ROLE', 8);
			// 	$this->db->update('t_user');
			// } else {
			// 	echo "error";
			// }
			} else{
			echo "error";
			}

				// var_dump($this->db->affected_rows());die();

			return $this->db->affected_rows();

	}	

	// public function updateAllPost($id_user){
	// 	$session = $this->session->all_userdata();
	// 	var_dump($session);
	// 	die();
	// 	$id_role = $session['userdata']->ID_ROLE;
	// 	$this->db->set('r_lap_pusdatin_prod_minyak.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_prod_minyak.USER_POST', $id_user);
	// 			$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_prod_minyak');
	// 	// return $this->db->affected_rows();

	// 	$this->db->set('r_lap_pusdatin_icp.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_icp.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_icp.USER_POST', $id_user);
	// 			$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_icp');


	// 	$this->db->set('r_lap_pusdatin_prod_gas.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_prod_gas.USER_POST', $id_user);
	// 			$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_prod_gas');


	// 	$this->db->set('r_lap_pusdatin_prod_ekui_migas.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_POST', $id_user);
	// 			$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_prod_ekui_migas');


	// 	$this->db->set('r_lap_pusdatin_lift_tb.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_lift_tb.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_lift_tb');


	// 	$this->db->set('r_lap_pusdatin_harga_bbm.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_harga_bbm.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_harga_bbm');


	// 	$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');



	// 	$this->db->set('r_lap_pusdatin_berita_opec_harian.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_berita_opec_harian.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_berita_opec_harian');


	// 	$this->db->set('r_lap_pusdatin_harga_bb_acuan.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_harga_bb_acuan');


	// 	$this->db->set('r_lap_pusdatin_harga_mineral_acuan.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	$this->db->update('r_lap_pusdatin_harga_mineral_acuan');


	// 	$this->db->set('r_lap_pusdatin_stts_tl.IS_POST', 'Y');
	// 	$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_POST', date("Y-m-d H:m:s"));
	// 	$this->db->set('r_lap_pusdatin_stts_tl.USER_POST', $id_user);
	// 	$this->db->where('HAS_REVIEW <>', Null);
	// 	$this->db->where('TANGGAL_REVIEW <>', Null);

	// 	// $this->db->update('r_lap_pusdatin_stts_tl');	
	// 	$test = $this->db->update('r_lap_pusdatin_stts_tl');		


	// 	if ($test) {
	// 			$this->db->affected_rows();
	// 			$this->db->set('READY_POST', Null);
	// 			$this->db->set('HAS_POST', 'Y');
	// 			$this->db->where('ID_ROLE', $id_role);
	// 			$this->db->update('t_user');
	// 			// return $this->db->affected_rows();
			
	// 		// if ($test2) {
	// 		// 	$this->db->affected_rows();
	// 		// 	// $this->db->set('HAS_REVIEW', 'Y');
	// 		// 	$this->db->set('READY_POST', 'Y');
				
	// 		// 	$this->db->where('ID_ROLE', 8);
	// 		// 	$this->db->update('t_user');
	// 		// } else {
	// 		// 	echo "error";
	// 		// }
	// 		} else{
	// 		echo "error";
	// 		}

	// 			// var_dump($this->db->affected_rows());die();

	// 					return $this->db->affected_rows();


	// 			// echo $this->db->last_query();
	// }


		public function updateAllPost($id_user){
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;
		// $query=
		$this->db->set('r_lap_pusdatin_prod_minyak.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_minyak.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_prod_minyak');
		// return $this->db->affected_rows();

		$this->db->set('r_lap_pusdatin_icp.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_icp.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_icp.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_icp');


		$this->db->set('r_lap_pusdatin_prod_gas.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_gas.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_prod_gas');


		$this->db->set('r_lap_pusdatin_prod_ekui_migas.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_prod_ekui_migas');


		$this->db->set('r_lap_pusdatin_lift_tb.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_lift_tb.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_lift_tb');


		$this->db->set('r_lap_pusdatin_harga_bbm.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bbm.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_harga_bbm');


		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');



		$this->db->set('r_lap_pusdatin_berita_opec_harian.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_berita_opec_harian.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_berita_opec_harian');


		$this->db->set('r_lap_pusdatin_harga_bb_acuan.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_harga_bb_acuan');


		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_pusdatin_harga_mineral_acuan');


		$this->db->set('r_lap_pusdatin_stts_tl.IS_POST', 'Y');
		$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_stts_tl.USER_POST', $id_user);
		$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		 $this->db->update('r_lap_pusdatin_stts_tl');	
	

			$this->db->set('HAS_POST', 'Y');
			// $this->db->where('ID_ROLE', 15);
			$this->db->where('ID_ROLE', $id_role);

			return	$this->db->update('t_user');
				
				// echo $this->db->last_query();
					

				// return $query;
	}		


		public function hasreviewall($id_user) {
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;	
		$this->db->set('r_lap_pusdatin_prod_minyak.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_minyak.USER_REVIEW', $id_user);

		$this->db->update('r_lap_pusdatin_prod_minyak');
		// $this->db->affected_rows();
				// return $this->db->affected_rows();
		// echo $this->db->last_query();

		$this->db->set('r_lap_pusdatin_icp.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_icp.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_icp.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_icp');
		// $this->db->affected_rows();
				// return $this->db->affected_rows();

		$this->db->set('r_lap_pusdatin_prod_gas.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_gas.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_prod_gas');

		$this->db->set('r_lap_pusdatin_prod_ekui_migas.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_prod_ekui_migas');

		$this->db->set('r_lap_pusdatin_lift_tb.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_lift_tb.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_lift_tb');

		$this->db->set('r_lap_pusdatin_harga_bbm.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bbm.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_harga_bbm');

		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');

		$this->db->set('r_lap_pusdatin_berita_opec_harian.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_berita_opec_harian.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_berita_opec_harian');

		$this->db->set('r_lap_pusdatin_harga_bb_acuan.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_harga_bb_acuan');

		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_harga_mineral_acuan');

		$this->db->set('r_lap_pusdatin_stts_tl.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_pusdatin_stts_tl.USER_REVIEW', $id_user);
		$this->db->update('r_lap_pusdatin_stts_tl');

		$this->db->set('HAS_REVIEW', 'Y');
		$this->db->set('READY_REVIEW', Null);
		
		$this->db->where('ID_ROLE', $id_role);
		// $this->db->where('READY_REVIEW', 'Y');
			
		return $this->db->update('t_user');
		// $this->db->affected_rows();

				// return $this->db->affected_rows();

		// echo $this->db->last_query();die();		

		// $this->db->set('r_lap_pusdatin_icp.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_icp.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_icp.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_icp');
		// $this->db->affected_rows();
		// 		return $this->db->affected_rows();

		// $this->db->set('HAS_REVIEW', 'Y');
		// $this->db->set('READY_REVIEW', Null);
		
		// $this->db->where('ID_ROLE', $id_role);
		// // $this->db->where('READY_REVIEW', 'Y');
			
		// $this->db->update('t_user');
		// $this->db->affected_rows();
		// 		return $this->db->affected_rows();

		// $this->db->set('r_lap_pusdatin_prod_gas.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_gas.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_prod_gas');

		// $this->db->set('r_lap_pusdatin_prod_ekui_migas.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_prod_ekui_migas');

		// $this->db->set('r_lap_pusdatin_lift_tb.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_lift_tb.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_lift_tb');

		// $this->db->set('r_lap_pusdatin_harga_bbm.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_bbm.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_harga_bbm');

		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');

		// $this->db->set('r_lap_pusdatin_berita_opec_harian.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_berita_opec_harian.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_berita_opec_harian');

		// $this->db->set('r_lap_pusdatin_harga_bb_acuan.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_harga_bb_acuan');

		// $this->db->set('r_lap_pusdatin_harga_mineral_acuan.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_harga_mineral_acuan');

		// $this->db->set('r_lap_pusdatin_stts_tl.HAS_REVIEW', 'Y');
		// $this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_stts_tl.USER_REVIEW', $id_user);
		// $this->db->update('r_lap_pusdatin_stts_tl');



		// return $this->db->affected_rows();
		// var_dump($this->db->affected_rows());die();
		// if ($test) {
		// 	$this->db->affected_rows();
		// 	$this->db->set('HAS_REVIEW', 'Y');
		// 	$this->db->set('READY_REVIEW', Null);
			
		// 	$this->db->where('ID_ROLE', $id_role);
		// 	$this->db->where('READY_REVIEW', 'Y');
			
		// 	$test2 = $this->db->update('t_user');
		// 		// return $this->db->affected_rows();

		// 	if ($test2) {
		// 		$this->db->affected_rows();
		// 		// $this->db->set('HAS_REVIEW', 'Y');
		// 		$this->db->set('READY_POST', 'Y');
				
		// 		$this->db->where('ID_ROLE', 8);
		// 		$this->db->update('t_user');
		// 	} else {
		// 		echo "error";
		// 	}
		// } else{
		// 	echo "error";
		// }

		
		// var_dump($this->db->affected_rows());die();



		



	}



	public function reviewAllPost($data,$id_user){
		$session = $this->session->all_userdata();
		// print_r($this->session->all_userdata());
		// print_r($this->session->userdata); die();
		$id_role = $session['userdata']->ID_ROLE;
		$username = $session['userdata']->USERNAME;
		// echo $username.'hhe';die();
		// $this->db->set('r_lap_pusdatin_prod_minyak.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_minyak.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_prod_minyak.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_prod_minyak');
		// $this->db->set('r_lap_pusdatin_icp.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_icp.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_icp.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_icp');
		// $this->db->set('r_lap_pusdatin_prod_gas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_gas.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_prod_gas.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_prod_gas');
		// $this->db->set('r_lap_pusdatin_prod_ekui_migas.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_ekui_migas.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_prod_ekui_migas');
		// $this->db->set('r_lap_pusdatin_lift_tb.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_lift_tb.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_lift_tb.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_lift_tb');
		// $this->db->set('r_lap_pusdatin_harga_bbm.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_bbm.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_harga_bbm.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_harga_bbm');
		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.USER_REVIEW', $id_user);
		// $this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.CATATAN_REVIEW', $data);
		// $this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');
		// $this->db->set('r_lap_pusdatin_berita_opec_harian.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_berita_opec_harian.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_berita_opec_harian.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_berita_opec_harian');
		// $this->db->set('r_lap_pusdatin_harga_bb_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_bb_acuan.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_harga_bb_acuan');
		// $this->db->set('r_lap_pusdatin_harga_mineral_acuan.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_harga_mineral_acuan.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_harga_mineral_acuan');
		// $this->db->set('r_lap_pusdatin_stts_tl.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_stts_tl.USER_REVIEW', $id_user);
		$this->db->set('r_lap_pusdatin_stts_tl.CATATAN_REVIEW', $data);
		$this->db->update('r_lap_pusdatin_stts_tl');				
			
		return $this->db->affected_rows();
		
				$this->db->set('READY_REVIEW', Null);
		// $this->db->where('ID_ROLE', 15);
		$this->db->where('ID_ROLE', $id_role);

	return	$this->db->update('t_user');
		// $this->db->set('READY_REVIEW', Null);
		// $this->db->where('ID_ROLE', 17);
		// $this->db->update('t_user');
		// $this->db->set('READY_REVIEW', Null);
		// $this->db->where('ID_ROLE', 18);
		// // $this->db->where('ID_ROLE', 17);
		// // $this->db->where('ID_USER', 18);
		
		// return	$this->db->update('t_user');
		// echo $this->db->last_query();

	}
}