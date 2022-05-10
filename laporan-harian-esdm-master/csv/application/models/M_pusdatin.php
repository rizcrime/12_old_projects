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

	public function prosesUpdateDraftProdMinyak($dataUpdate) {
		$table = "r_lap_pusdatin_prod_minyak";
		$prodharian = $dataUpdate['dataprodharian'];
		$prodbulanan = $dataUpdate['dataprodbulanan'];
		$prodTahunan = $dataUpdate['dataprodTahunan'];
		$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn
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
			'KETERANGAN' => $keterangan
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
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn
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
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}


	public function prosesUpdateDraftLiftTB($dataUpdate) {
		$table = "r_lap_pusdatin_lift_tb";
		$liftmb = $dataUpdate['dataLiftMB'];
		$posisistock = $dataUpdate['dataPosisiStock'];
		$salurgas = $dataUpdate['dataSalurGas'];
		//$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'LIFT_MB' => $liftmb,
			'POSISI_STOCK' => $posisistock,
			// 'DETAIL' => $detail,
			'SALUR_GAS' => $salurgas,
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
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'JENIS_TERTENTU' => $bbmtertentu,
			'BBM_UMUM' => $bbmumum,
			// 'DETAIL' => $detail,
			'PROG_IND_SATU_HRG' => $indonesiasatuharga,
			'HARGA_PERNEGARA' => $hargapernegara
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
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'BERITA' => $berita
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
			'SUMBER' => $sumber
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
			'SUMBER' => $sumber
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}
	public function prosesUpdatDraftStatusTL($dataUpdate) {
		$table = "r_lap_pusdatin_stts_tl";
		$prodharian = $dataUpdate['dataprodharian'];
		$prodbulanan = $dataUpdate['dataprodbulanan'];
		$prodTahunan = $dataUpdate['dataprodTahunan'];
		$apbn = $dataUpdate['dataapbn'];
		// $vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'PROD_HARIAN' => $prodharian,
			'PROD_BULANAN' => $prodbulanan,
			// 'DETAIL' => $detail,
			'PROD_TAHUNAN' => $prodTahunan,
			'APBN' => $apbn
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}
	public function updateAllPost(){
		$this->db->set('r_lap_pusdatin_prod_minyak.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_prod_minyak');
		$this->db->set('r_lap_pusdatin_icp.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_icp');
		$this->db->set('r_lap_pusdatin_prod_gas.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_prod_gas');
		$this->db->set('r_lap_pusdatin_prod_ekui_migas.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_prod_ekui_migas');
		$this->db->set('r_lap_pusdatin_lift_tb.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_lift_tb');
		$this->db->set('r_lap_pusdatin_harga_bbm.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_harga_bbm');
		$this->db->set('r_lap_pusdatin_prog_peny_prem_jamali.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_prog_peny_prem_jamali');
		$this->db->set('r_lap_pusdatin_berita_opec_harian.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_berita_opec_harian');
		$this->db->set('r_lap_pusdatin_harga_bb_acuan.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_harga_bb_acuan');
		$this->db->set('r_lap_pusdatin_harga_mineral_acuan.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_harga_mineral_acuan');
		$this->db->set('r_lap_pusdatin_stts_tl.IS_POST', 'Y');
		$this->db->update('r_lap_pusdatin_stts_tl');		
		return $this->db->affected_rows();
	}
}