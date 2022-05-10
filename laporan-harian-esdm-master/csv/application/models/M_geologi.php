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
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_geologi_gerakan_tanah() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gerakan_tanah');
		//$this->db->where('ID_ROLE', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_role WHERE ID_ROLE = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->result_array();
	}

	public function select_geologi_gunung_api() {
		$this->db->select('*');
		$this->db->from('r_lap_geologi_gunung_api');
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
			'VONA' => $vona
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

	public function updateAllPost(){
		$this->db->set('r_lap_geologi_gunung_api.IS_POST', 'Y');
		$this->db->update('r_lap_geologi_gunung_api');
		$this->db->set('r_lap_geologi_gempa_bumi.IS_POST', 'Y');
		$this->db->update('r_lap_geologi_gempa_bumi');
		$this->db->set('r_lap_geologi_gerakan_tanah.IS_POST', 'Y');
		$this->db->update('r_lap_geologi_gerakan_tanah');		
		return $this->db->affected_rows();
	}
}