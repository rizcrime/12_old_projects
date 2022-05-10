<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_berita extends CI_Model {
	
	public function select_all_jenis_laporan() {
		$this->db->select('ID_JENIS_LAPORAN,URUTAN_LAPORAN,ID_KATEGORI,JENIS_LAPORAN');
		$this->db->from('t_jenis_laporan');
		$this->db->where('ID_KATEGORI', 4);

		$data = $this->db->get();
		return $data->result();
	}
	
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	

	public function select_berita_gatrik() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_gatrik');
				$this->db->where('TANGGAL_LAPORAN', date('Y-m-d'));
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_berita_geologi() {
		$this->db->select('*');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_berita_migas() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_migas');$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_berita_hot_news() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_hot_news');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_berita_hot_news_last_date() {
		// $between = 
		$tujuhdata = date('Y-m-d',strtotime("-7 days")); 
		$this->db->select('*');
		$this->db->from('r_lap_berita_hot_news');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->where('TANGGAL_LAPORAN >=', $tujuhdata);
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(7);//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);
		 // echo $this->db->last_query();

		return $data->result_array();
	}
	public function select_berita_negatif() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_negatif');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


		public function select_berita_negatif_last_date() {
		$tujuhdata = date('Y-m-d',strtotime("-7 days")); 

		$this->db->select('*');
		$this->db->from('r_lap_berita_negatif');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->where('TANGGAL_LAPORAN >=', $tujuhdata);
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}
	public function select_berita_positif() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_positif');
				// $this->db->where('TANGGAL_LAPORAN', date('Y-m-d'));
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_berita_positif_last_date() {
		$tujuhdata = date('Y-m-d',strtotime("-7 days")); 
	
		$this->db->select('*');
		$this->db->from('r_lap_berita_positif');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->where('TANGGAL_LAPORAN >=', $tujuhdata);
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}


	public function select_berita_netral() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_netral');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_berita_netral_last_date() {
		$tujuhdata = date('Y-m-d',strtotime("-7 days")); 
	
		$this->db->select('*');
		$this->db->from('r_lap_berita_netral');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->where('TANGGAL_LAPORAN >=', $tujuhdata);
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);
		// echo $this->db->last_query();
			
		return $data->result_array();
	}

	public function select_berita_minerba() {
		$this->db->select('*');
		$this->db->from('r_lap_berita_minerba');
$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);//$this->db->where('ID_ROLE', $id);
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
		// echo $this->db->last_query();
	}

	// public function insert_foto($foto, $table_hot_news) {
	// 	$this->db->insert($table_hot_news, $foto);
	// 	return $this->db->affected_rows();
	// }

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
	public function select_by_jenis_draft_entry($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		$this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('HAS_REVIEW', Null);
		$this->db->where('TANGGAL_REVIEW', Null);
		$data = $this->db->get();
		

		return $data->result();
	}

	public function select_by_jenis_draft_has_review($table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('IS_POST', Null);
		$this->db->where('TANGGAL_POST', Null);
		// $this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('HAS_REVIEW <>', Null);
		// $this->db->where('TANGGAL_REVIEW', Null);
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

		public function hasreview($table, $id, $id_user) {
		$data = array(
			'HAS_REVIEW' => "Y",
			'USER_REVIEW' => $id_user,
			'TANGGAL_REVIEW' => date("Y-m-d H:m:s"),
			'FLATFORM_REVIEW' => "WEB"
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

	public function delete($table,$id,$id_user) {
		$this->db->where('ID_LAPORAN', $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	public function prosesUpdateDraft($dataUpdate) {
		$table = "r_lap_berita_migas";
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
		$table = "r_lap_berita_hot_news";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
		    'CATATAN_REVIEW' => Null,

		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}	

	public function prosesReviewDraftHotNews($dataReview) {
		$table = "r_lap_berita_hot_news";
		$idLaporan = $dataReviewdataReviewdataReview['dataIdLaporan'];
		$berita = $dataReviewdataReview['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$catatan_review = $dataReview['dataCatatanReview'];

		$url = $dataReview['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW' => $catatan_review
	
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	public function prosesUpdateDraftNegatif($dataUpdate) {
		$table = "r_lap_berita_negatif";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
		    'CATATAN_REVIEW' => Null,
	
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesReviewDraftNegatif($dataReview) {
		$table = "r_lap_berita_negatif";
		$idLaporan = $dataReview['dataIdLaporan'];
		$berita = $dataReview['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataReview['dataUrl'];
		$catatan_review = $dataReview['dataCatatanReview'];
		
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW => $catatan_review'
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	public function prosesUpdateDraftPositif($dataUpdate) {
		$table = "r_lap_berita_positif";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW' => Null,
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesReviewDraftPositif($dataReview) {
		$table = "r_lap_berita_positif";
		$idLaporan = $dataReview['dataIdLaporan'];
		$berita = $dataReview['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataReview['dataUrl'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftNetral($dataUpdate) {
		$table = "r_lap_berita_netral";
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$berita = $dataUpdate['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataUpdate['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW' => Null
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesReviewDraftNetral($dataReview) {
		$table = "r_lap_berita_netral";
		$idLaporan = $dataReview['dataIdLaporan'];
		$berita = $dataReview['dataBerita'];
		// $jenis = $dataUpdate['dataJenis'];
		$url = $dataReview['dataUrl'];
		$data = array(
			'BERITA' => $berita,
			// 'JENIS' => $jenis,
			'URL' => $url,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftGeologi($dataUpdate) {
		$table = "r_lap_berita_geologi";
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
		$table = "r_lap_berita_ebtke";
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
		$table = "r_lap_berita_gatrik";
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
		$table = "r_lap_berita_minerba";
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
		// $this->db->set('r_lap_berita_migas.IS_POST', 'Y');
		// $this->db->update('r_lap_berita_migas')
		$this->db->set('r_lap_berita_hot_news.IS_POST', 'Y');
		$this->db->update('r_lap_berita_hot_news');
		$this->db->set('r_lap_berita_minerba.IS_POST', 'Y');
		$this->db->update('r_lap_berita_minerba');
		$this->db->set('r_lap_berita_gatrik.IS_POST', 'Y');
		$this->db->update('r_lap_berita_gatrik');
		$this->db->set('r_lap_berita_ebtke.IS_POST', 'Y');
		$this->db->update('r_lap_berita_ebtke');
		$this->db->set('r_lap_berita_geologi.IS_POST', 'Y');
		$this->db->update('r_lap_berita_geologi');		
		return $this->db->affected_rows();
	}
}