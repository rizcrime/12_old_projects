<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_klik extends CI_Model {
	
	public function select_all_jenis_laporan() {
		$this->db->select('ID_JENIS_LAPORAN,URUTAN_LAPORAN,ID_KATEGORI,JENIS_LAPORAN');
		$this->db->from('t_jenis_laporan');
		$this->db->where('ID_KATEGORI', 3);

		$data = $this->db->get();
		return $data->result();
	}
	
	public function select_klik_ebtke() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_ebtke');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_klik_gatrik() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_gatrik');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_klik_geologi() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_geologi');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_klik_migas() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_migas');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_klik_hot_news() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_hot_news');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_klik_minerba() {
		$this->db->select('*');
		$this->db->from('r_lap_klik_minerba');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_all_jenis_berita() {
		$this->db->select('ID_JENIS_BERITA,JENIS_BERITA');
		$this->db->from('t_jenis_berita');

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data, $table) {
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
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

	public function select_by_id_draft($id,$table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('ID_LAPORAN',$id);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$data = $this->db->get();
		
		return $data->result();
	}

	public function prosesUpdateDraft($dataUpdate) {
		$table = "r_lap_klik_migas";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	public function prosesUpdateDraftHotNews($dataUpdate) {
		$table = "r_lap_klik_hot_news";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftGeologi($dataUpdate) {
		$table = "r_lap_klik_geologi";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftEbtke($dataUpdate) {
		$table = "r_lap_klik_ebtke";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	
	public function prosesUpdateDraftGatrik($dataUpdate) {
		$table = "r_lap_klik_gatrik";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftMinerba($dataUpdate) {
		$table = "r_lap_klik_minerba";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		$jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			'JENIS' => $jenis,
			'URL' => $url,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function updateAllPost(){
		// $this->db->set('r_lap_klik_migas.IS_POST', 'Y');
		// $this->db->update('r_lap_klik_migas')
		$this->db->set('r_lap_klik_hot_news.IS_POST', 'Y');
		$this->db->update('r_lap_klik_hot_news');
		$this->db->set('r_lap_klik_minerba.IS_POST', 'Y');
		$this->db->update('r_lap_klik_minerba');
		$this->db->set('r_lap_klik_gatrik.IS_POST', 'Y');
		$this->db->update('r_lap_klik_gatrik');
		$this->db->set('r_lap_klik_ebtke.IS_POST', 'Y');
		$this->db->update('r_lap_klik_ebtke');
		$this->db->set('r_lap_klik_geologi.IS_POST', 'Y');
		$this->db->update('r_lap_klik_geologi');		
		return $this->db->affected_rows();
	}
}