<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_geologi extends CI_Model {
	
	public function select_all_jenis_laporan() {
		$this->db->select('ID_JENIS_LAPORAN,URUTAN_LAPORAN,ID_KATEGORI,JENIS_LAPORAN');
		$this->db->from('t_jenis_laporan');
		$this->db->where('ID_KATEGORI', 2);

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

	public function select_geologi_gempa_bumi() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gempa_bumi');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_geologi_gempa_bumi_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gempa_bumi');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_geologi_gerakan_tanah() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gerakan_tanah');
		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		// $this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_geologi_gerakan_tanah_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gerakan_tanah');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

// 	public function select_geologi_gunung_api() {
// 		$this->db->select('*');
// 		$this->db->from('r_lap_geologi_gunung_api');
// 		// $this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
// 		// $this->db->order_by('TANGGAL_LAPORAN', 'DESC');
// 		// $this->db->limit(1);
// //$this->db->where('ID_ROLE', $id);
// 		$data = $this->db->get();
// 		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

// 		// $data = $this->db->query($sql);

// 		return $data->result_array();
// 	}


	public function select_geologi_gunung_api(){
		$this->db->select('r_lap_geologi_gunung_api.*,t_gunung.NAMA_GUNUNG,t_aktivitas.LEVEL');
		$this->db->from('r_lap_geologi_gunung_api');
		$this->db->join('t_gunung', 'r_lap_geologi_gunung_api.ID_GUNUNG = t_gunung.ID_GUNUNG');
		$this->db->join('t_aktivitas', 'r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS');
		// $this->db->where('ID_LAPORAN',$id);
		$datanya = $this->db->get();

		return $datanya->result();
		// echo $this->db->last_query();

	}

	public function select_geologi_gunung_api_last_date() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gunung_api');
		$this->db->where('TANGGAL_LAPORAN <=', date('Y-m-d'));
		$this->db->order_by('TANGGAL_LAPORAN', 'DESC');
		$this->db->limit(1);
//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_gunung_api($id,$table){
		$this->db->select('r_lap_geologi_gunung_api.*,t_gunung.NAMA_GUNUNG,t_aktivitas.LEVEL');
		$this->db->from($table);
		$this->db->join('t_gunung', 'r_lap_geologi_gunung_api.ID_GUNUNG = t_gunung.ID_GUNUNG');
		$this->db->join('t_aktivitas', 'r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS');
		$this->db->where('ID_LAPORAN',$id);
		$datanya = $this->db->get();

		return $datanya->result();
	}	


	public function select_gerakan_tanah($id,$table){
		$this->db->select('*');
		$this->db->from($table);
		// $this->db->join('t_gunung', 'r_lap_geologi_gunung_api.ID_GUNUNG = t_gunung.ID_GUNUNG');
		// $this->db->join('t_aktivitas', 'r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS');
		$this->db->where('ID_LAPORAN',$id);
		$datanya = $this->db->get();

		return $datanya->result();
	}
	public function select_gempa_bumi($id,$table){
		$this->db->select('*');
		$this->db->from($table);
		// $this->db->join('t_gunung', 'r_lap_geologi_gunung_api.ID_GUNUNG = t_gunung.ID_GUNUNG');
		// $this->db->join('t_aktivitas', 'r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS');
		$this->db->where('ID_LAPORAN',$id);
		$datanya = $this->db->get();

		return $datanya->result();
	}
	
	public function select_all_level(){
		$this->db->select('*');
		$this->db->from('t_aktivitas');

		$dataLevel = $this->db->get();
		return $dataLevel->result();
	}

	public function select_all_gunung() {
		$this->db->select('ID_GUNUNG,NAMA_GUNUNG');
		$this->db->from('t_gunung');

		$data = $this->db->get();
		return $data->result();
	}
	
	public function select_all_aktivitas() {
		$this->db->select('ID_AKTIVITAS,LEVEL');
		$this->db->from('t_aktivitas');

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data, $table) {
		$this->db->insert($table, $data);
		// return $this->db->affected_rows();
		$this->db->set('READY_REVIEW', 'Y');
		$this->db->where('ID_ROLE', 17);
		$this->db->update('t_user');
		$this->db->set('HAS_UNPOST', Null);
		$this->db->where('ID_ROLE', 19);
	return	$this->db->update('t_user');
	}



		public function cek_pernah_input($hariini,$table)
	{
		$this->db->like('TANGGAL_ENTRY', $hariini);
		$query = $this->db->get($table);
		return $query->num_rows();
		// echo $this->db->last_query();

	}

	public function cek_pernah_upload_tanah($hariini,$table_tanah)
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
		$query = $this->db->get($table_tanah);
		return $query->num_rows();
		// echo $this->db->last_query();

	}
		public function cek_pernah_upload_gunung($hariini,$table_gunung)
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
		$query = $this->db->get($table_gunung);
		return $query->num_rows();
		// echo $this->db->last_query();

	}	


	public function cek_pernah_upload_gempa($hariini,$table_gempa)
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
		$query = $this->db->get($table_gempa);
		return $query->num_rows();
		// echo $this->db->last_query();

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
	
	public function select_by_jenis_draft($table,$select="",$join="") {
		if(!empty($select)){
			$this->db->select($select);
		}
		if(!empty($join)){
			foreach($join as $key => $value){
				$this->db->join($value["tabel"],$value["idon"],'left');
			}
		}
		
		$this->db->select('a.*');
		$this->db->from($table);
		$this->db->where('a.IS_POST', Null);
		$this->db->where('a.TANGGAL_POST', Null);
		$this->db->where('a.HAS_REVIEW', Null);
		$this->db->where('a.CATATAN_REVIEW', Null);
		$this->db->where('a.TANGGAL_REVIEW', Null);
		$this->db->order_by('a.TANGGAL_LAPORAN','ASC');

		$data = $this->db->get();
		

		return $data->result();
	}

	public function select_by_jenis_draft_has_review($table,$select="",$join="") {
		if(!empty($select)){
			$this->db->select($select);
		}
		if(!empty($join)){
			foreach($join as $key => $value){
				$this->db->join($value["tabel"],$value["idon"],'left');
			}
		}
		
		$this->db->select('a.*');
		$this->db->from($table);
		$this->db->where('a.IS_POST', Null);
		$this->db->where('a.TANGGAL_POST', Null);

		// $this->db->where('a.IS_POST', Null);
		// $this->db->where('TANGGAL_POST', Null);
		// $this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('a.HAS_REVIEW <>', Null);
		$this->db->where('a.TANGGAL_REVIEW <>', Null);
		$this->db->order_by('a.TANGGAL_LAPORAN','ASC');
		$data = $this->db->get();
		

		return $data->result();
	}
	
	public function select_by_jenis_draft_entry($table,$select="",$join="") {
		if(!empty($select)){
			$this->db->select($select);
		}
		if(!empty($join)){
			foreach($join as $key => $value){
				$this->db->join($value["tabel"],$value["idon"],'left');
			}
		}
		$this->db->select('a.*');
		$this->db->from($table);
		$this->db->where('a.IS_POST', Null);
		$this->db->where('a.TANGGAL_POST', Null);
		$this->db->where('CATATAN_REVIEW <>', Null);
		$this->db->where('a.HAS_REVIEW', Null);
		$this->db->where('a.TANGGAL_REVIEW', Null);
		$this->db->order_by('a.TANGGAL_LAPORAN','ASC');

		$data = $this->db->get();
		

		return $data->result();
	}
	

	public function select_by_jenis_history($table,$select,$join,$TANGGAL_AWAL,$TANGGAL_AKHIR) {
		if(!empty($select)){
			$this->db->select($select);
		}
		if(!empty($join)){
			foreach($join as $key => $value){
				$this->db->join($value["tabel"],$value["idon"],'left');
			}
		}
		
		$this->db->select('a.*');
		$this->db->from($table);
		$this->db->where('a.IS_POST', "Y");
		$this->db->where('a.TANGGAL_POST <>', Null);
		if(!empty($TANGGAL_AWAL)){
			$this->db->where('a.TANGGAL_LAPORAN >=', date('Y-m-d',strtotime($TANGGAL_AWAL)));
		}
		if(!empty($TANGGAL_AKHIR)){
			$this->db->where('a.TANGGAL_LAPORAN <=', date('Y-m-d',strtotime($TANGGAL_AKHIR)));
		}
		$data = $this->db->get();
		

		return $data->result();
	}

	/*public function update($data) {
		$this->db->where('ID_ROLE', $data['ID_ROLE']);
		$this->db->update('t_role', $data);
		// $sql = "UPDATE t_role SET ROLE='" .$data['ROLE'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_ROLE = '".$data['ID_ROLE']."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}*/

	public function update($table, $id, $id_user) {
		$this->db->where('ID_LAPORAN', $id);
		$this->db->update($table,$data);
		// $sql = "UPDATE t_role SET ROLE='" .$data['ROLE'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_ROLE = '".$data['ID_ROLE']."'";

		// $this->db->query($sql);

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

		// return $this->db->affected_rows();
			$this->db->set('READY_POST', Null);
		$this->db->set('HAS_POST', 'Y');
		$this->db->where('ID_ROLE', $id_role);
		// $this->db->where('ID_ROLE', 17);
		// $this->db->where('ID_USER', 18);

		
		return	$this->db->update('t_user');
	}


	public function delete($table,$id,$id_user) {
		$this->db->where('ID_LAPORAN', $id);
		$this->db->delete($table);

		return $this->db->affected_rows();
	}

	
	public function hasreview($table, $id, $id_user) {

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

		// return $this->db->affected_rows();


		$this->db->set('HAS_REVIEW', 'Y');
		$this->db->set('READY_REVIEW', Null);
		
		$this->db->where('ID_ROLE', $id_role);
		$this->db->update('t_user');


		
		$this->db->set('READY_POST', 'Y');
		$this->db->where('ID_ROLE', 19);
		// $this->db->where('ID_ROLE', 17);
		// $this->db->where('ID_USER', 18);
		
		return	$this->db->update('t_user');
	}



			public function hasreviewall($id_user) {
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;	
		$this->db->set('r_lap_geologi_gunung_api.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_geologi_gunung_api.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gunung_api.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gunung_api');
		$this->db->set('r_lap_geologi_gempa_bumi.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_geologi_gempa_bumi.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gempa_bumi.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gempa_bumi');
		$this->db->set('r_lap_geologi_gerakan_tanah.HAS_REVIEW', 'Y');
		$this->db->set('r_lap_geologi_gerakan_tanah.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gerakan_tanah.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gerakan_tanah');
			
		// return $this->db->affected_rows();


		$this->db->set('HAS_REVIEW', 'Y');
		$this->db->set('READY_REVIEW', Null);
		
		$this->db->where('ID_ROLE', $id_role);
		$this->db->update('t_user');


		
		$this->db->set('READY_POST', 'Y');
		$this->db->where('ID_ROLE', 19);
		// $this->db->where('ID_ROLE', 17);
		// $this->db->where('ID_USER', 18);
		
		return	$this->db->update('t_user');



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

	public function prosesUpdateDraftGunung($dataUpdate) {
		$table = "r_lap_geologi_gunung_api";
		$keterangan = $dataUpdate['dataKeterangan'];
		$detail = $dataUpdate['dataDetail'];
		$rekomendasi = $dataUpdate['dataRekomendasi'];
		$vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'KETERANGAN' => $keterangan,
			'REKOMENDASI' => $rekomendasi,
			'DETAIL' => $detail,
			'VONA' => $vona,
			'CATATAN_REVIEW' => Null
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}	

	public function prosesReviewDraftGunung($dataReview) {
		$table = "r_lap_geologi_gunung_api";
		$keterangan = $dataReview['dataKeterangan'];
		$detail = $dataReview['dataDetail'];
		$rekomendasi = $dataReview['dataRekomendasi'];
		$vona = $dataReview['dataVona'];
		$catatan_review = $dataReview['dataCatatanReview'];
		$idLaporan = $dataReview['dataIdLaporan'];
		$data = array(
			'KETERANGAN' => $keterangan,
			'REKOMENDASI' => $rekomendasi,
			'DETAIL' => $detail,
			'VONA' => $vona,
			'CATATAN_REVIEW' => $catatan_review
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftGerakanTanah($dataUpdate) {
		$table = "r_lap_geologi_gerakan_tanah";
		$keterangan = $dataUpdate['dataKeterangan'];
		$detail = $dataUpdate['dataDetail'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'KETERANGAN' => $keterangan,
			//'REKOMENDASI' => $rekomendasi,
			'DETAIL' => $detail,
			//'VONA' => $vona
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	public function prosesUpdateDraftGempaBumi($dataUpdate) {
		$table = "r_lap_geologi_gempa_bumi";
		$lokasi = $dataUpdate['dataLokasi'];
		$informasi = $dataUpdate['dataInformasi'];
		$kondisi = $dataUpdate['dataKondisi'];
		$penyebab = $dataUpdate['dataPenyebab'];
		$dampak = $dataUpdate['dataDampak'];
		$rekomendasi = $dataUpdate['dataRekomendasi'];
		//$vona = $dataUpdate['dataVona'];
		$idLaporan = $dataUpdate['dataIdLaporan'];
		$data = array(
			'LOKASI' => $lokasi,
			'INFORMASI' => $informasi,
			'KONDISI_GEOLOGI_DT' => $kondisi,
			'PENYEBAB_GEMPA' => $penyebab,
			'DAMPAK_GEMPA' => $dampak,
			'REKOMENDASI' => $rekomendasi
		);
		$this->db->where('ID_LAPORAN', $idLaporan);
		$this->db->update($table, $data);

		return $this->db->affected_rows();
	}

	public function updateAllPost($id_user){
		$this->db->set('r_lap_geologi_gunung_api.IS_POST', 'Y');
			$this->db->set('r_lap_geologi_gunung_api.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gunung_api.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);

		$this->db->update('r_lap_geologi_gunung_api');


		$this->db->set('r_lap_geologi_gempa_bumi.IS_POST', 'Y');
			$this->db->set('r_lap_geologi_gunung_api.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gunung_api.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);
		$this->db->update('r_lap_geologi_gempa_bumi');


		$this->db->set('r_lap_geologi_gerakan_tanah.IS_POST', 'Y');
			$this->db->set('r_lap_geologi_gerakan_tanah.TANGGAL_POST', date("Y-m-d H:m:s"));
		$this->db->set('r_lap_geologi_gerakan_tanah.USER_POST', $id_user);
				$this->db->where('HAS_REVIEW <>', Null);
		$this->db->where('TANGGAL_REVIEW <>', Null);
		$this->db->update('r_lap_geologi_gerakan_tanah');		
		$this->db->set('HAS_POST', 'Y');
			// $this->db->where('ID_ROLE', 15);
			$this->db->where('ID_ROLE', $id_role);

			return	$this->db->update('t_user');
	}




	public function reviewAllPost($data,$id_user){
		$session = $this->session->all_userdata();
		// print_r($this->session->all_userdata());
		// print_r($this->session->userdata); die();
		$id_role = $session['userdata']->ID_ROLE;
		$username = $session['userdata']->USERNAME;
		// echo $username.'hhe';die();
		$this->db->set('r_lap_geologi_gunung_api.CATATAN_REVIEW', $data);
		// $this->db->set('r_lap_geologi_gunung_api.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_minyak.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gunung_api');
		$this->db->set('r_lap_geologi_gempa_bumi.CATATAN_REVIEW', $data);
		// $this->db->set('r_lap_geologi_gempa_bumi.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_icp.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gempa_bumi');
		$this->db->set('r_lap_geologi_gerakan_tanah.CATATAN_REVIEW', $data);
		// $this->db->set('r_lap_geologi_gerakan_tanah.TANGGAL_REVIEW', date("Y-m-d H:m:s"));
		// $this->db->set('r_lap_pusdatin_prod_gas.USER_REVIEW', $id_user);
		$this->db->update('r_lap_geologi_gerakan_tanah');
			
		return $this->db->affected_rows();
			
				$this->db->set('READY_REVIEW', Null);
		// $this->db->where('ID_ROLE', 15);
		$this->db->where('ID_ROLE', $id_role);

	return	$this->db->update('t_user');
		// 		$this->db->set('READY_REVIEW', Null);
		// $this->db->where('ID_ROLE', 15);
		// $this->db->update('t_user');
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