<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bidder extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('t_perusahaan');
		$this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');
		$this->db->order_by('IS_VERIFIED', 'ASC');

		$data = $this->db->get();

		return $data->result();
	}

	public function update($data, $id) {
		$this->db->where("ID_PERUSAHAAN", $id);
		$this->db->update("t_perusahaan", $data);

		return $this->db->affected_rows();
	}

	public function select_all_verified($id) {
		clean_sql($id);
		$sql = "SELECT * FROM t_perusahaan WHERE IS_VERIFIED = 'Y'";

		$data = $this->db->query($sql);
		// var_dump($data->result());die();

		return $data->result();
	}

	public function select_all_unverified() {
		$sql = "SELECT * FROM t_perusahaan WHERE IS_VERIFIED = '' AND IS_DOKUMEN_KOMPLIT = 'Y'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		clean_sql($data);
		$sql = "INSERT INTO t_perusahaan VALUES('', '".$data['NAMA_PERUSAHAAN']."', '', '', '','".$data['EMAIL_PERUSAHAAN']."', '".$data['USERNAME']."', '', '', '', '', '', '', '', 'N', 'PRS')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function select_by_id($id) {
		clean_sql($id);
		$sql = "SELECT t_perusahaan.ID_PERUSAHAAN, t_perusahaan.EMAIL_PERUSAHAAN, t_perusahaan.NAMA_PERUSAHAAN, t_perusahaan.TELEPON, t_perusahaan.FAX, t_perusahaan.ALAMAT, t_perusahaan.IS_VERIFIED, t_perusahaan.ID_KABKOT, t_kabkot.NAMA_KABKOT, t_perusahaan.ID_PROVINSI, t_provinsi.NAMA_PROVINSI, t_perusahaan.WEBSITE, t_perusahaan.STATUS_MODAL, t_perusahaan.LAST_UPDATE, t_perusahaan.IS_VERIFIED, t_perusahaan.ALASAN_PENOLAKAN FROM t_perusahaan LEFT JOIN t_provinsi on t_perusahaan.ID_PROVINSI = t_provinsi.ID_PROVINSI LEFT JOIN t_kabkot ON t_perusahaan.ID_KABKOT = t_kabkot.ID_KABKOT WHERE ID_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}

	public function select_by_id_edit_profile($id) {
		clean_sql($id);
		$sql = "SELECT t_perusahaan.ID_PERUSAHAAN, t_perusahaan.EMAIL_PERUSAHAAN, t_perusahaan.NAMA_PERUSAHAAN, t_perusahaan.TELEPON, t_perusahaan.FAX, t_perusahaan.ALAMAT, t_perusahaan.ID_KABKOT, t_kabkot.NAMA_KABKOT, t_perusahaan.ID_PROVINSI, t_provinsi.NAMA_PROVINSI, t_perusahaan.WEBSITE, t_perusahaan.STATUS_MODAL, t_perusahaan.BIDANG_USAHA, t_perusahaan.LAST_UPDATE, t_perusahaan.IS_VERIFIED, t_perusahaan.ALASAN_PENOLAKAN FROM t_perusahaan LEFT JOIN t_provinsi on t_perusahaan.ID_PROVINSI = t_provinsi.ID_PROVINSI LEFT JOIN t_kabkot ON t_perusahaan.ID_KABKOT = t_kabkot.ID_KABKOT WHERE ID_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}

	public function select_by_id2($id) {
		clean_sql($id);
		$sql = "SELECT EMAIL_PERUSAHAAN, IS_VERIFIED FROM t_perusahaan WHERE ID_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}

	public function check_password($email_perusahaan) {
		// $sql = "SELECT IS_PASSWORD_DEFAULT FROM t_perusahaan WHERE EMAIL_PERUSAHAAN = '{$email_perusahaan}'";

		// $data = $this->db->query($sql);
		// return $data->row();

		$data = $this->db->select("IS_PASSWORD_DEFAULT")
		->from("t_perusahaan")
		->where("EMAIL_PERUSAHAAN", $email_perusahaan)
		->get();

		return $data->row();
	}

	public function check_dok($id) {
		clean_sql($id);
		$sql = "SELECT IS_DOKUMEN_KOMPLIT FROM t_perusahaan WHERE EMAIL_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}

	public function check_password_ubah($id) {
		clean_sql($id);
		$sql = "SELECT PASSWORD FROM t_perusahaan WHERE EMAIL_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}

	public function check_email_ubah($email_perusahaan) {
		// $sql = "SELECT ID_PERUSAHAAN FROM t_perusahaan WHERE EMAIL_PERUSAHAAN = '{$id}'";

		// $data = $this->db->query($sql);
		// return $data->row();

		$data = $this->db->select("ID_PERUSAHAAN")
		->from("t_perusahaan")
		->where("EMAIL_PERUSAHAAN", $email_perusahaan)
		->get();

		return $data->row();
	}
	
	public function check_email_ubah_admin($email_user) {
		// $sql = "SELECT ID_PERUSAHAAN FROM t_perusahaan WHERE EMAIL_PERUSAHAAN = '{$id}'";

		// $data = $this->db->query($sql);
		// return $data->row();

		$data = $this->db->select("ID_USER")
		->from("t_user")
		->where("EMAIL_USER", $email_user)
		->get();

		return $data->row();
	}

 	public function insertToken($id)  
 	{    
		date_default_timezone_set("Asia/Bangkok");
		$tanggal = date('Y-m-d H:i:s');

 		$token = substr(sha1(rand()), 0, 30);   
		$tanggal = date('Y-m-d H:i:s');

 		$string = array(  
 			'token'=> $token,  
 			'id_perusahaan'=>$id,  
 			'created'=>$tanggal  
 		);  
 		$query = $this->db->insert_string('tokens',$string);  
 		$this->db->query($query);  

 		return $token . $id;  

 	}  

 	public function isTokenValid($token)  
 	{  
 		$tkn = substr($token, 0, 30);  
		$uid = substr($token, 30);

		// base64url_decode bug, correct result must be in ASCII encoding
		// return FALSE to avoid database error
		if(mb_detect_encoding($tkn) != "ASCII" || mb_detect_encoding($uid) != "ASCII" ) {
			return FALSE;
		}

		 $q = $this->db->get_where('tokens', 
		 	array(  
				'tokens.token' => $tkn,   
				'tokens.id_perusahaan' => $uid
			), 1);               

 		if($this->db->affected_rows() > 0){  
 			$row = $q->row();         
			date_default_timezone_set("Asia/Bangkok");
 			$created = $row->created;  
 			$createdTS = new DateTime($created);  

			
			$date = date('Y-m-d H:i:s');
 			$todayTS = new DateTime($date);  
 			$diff = $todayTS->diff($createdTS);
			$hours = $diff->h;
			$hours = $hours + ($diff->days*24);

 			if($hours > 24){  
 				return false;  
 			}  
 			
 			$user_info = $this->getUserInfo($row->id_perusahaan);  
 			return $user_info;  

 		}else{  
 			return false;  
 		}  

	 }
	 
	public function isTokenValidAdmin($token)  
 	{  
 		$tkn = substr($token, 0, 30);  
		$uid = substr($token, 30);

		// base64url_decode bug, correct result must be in ASCII encoding
		// return FALSE to avoid database error
		if(mb_detect_encoding($tkn) != "ASCII" || mb_detect_encoding($uid) != "ASCII" ) {
			return FALSE;
		}

		 $q = $this->db->get_where('tokens', 
		 	array(  
				'tokens.token' => $tkn,   
				'tokens.id_perusahaan' => $uid
			), 1);               

 		if($this->db->affected_rows() > 0){  
 			$row = $q->row();         
			date_default_timezone_set("Asia/Bangkok");
 			$created = $row->created;  
 			$createdTS = new DateTime($created);  

			
			$date = date('Y-m-d H:i:s');
 			$todayTS = new DateTime($date);  
 			$diff = $todayTS->diff($createdTS);
			$hours = $diff->h;
			$hours = $hours + ($diff->days*24);

 			if($hours > 24){  
 				return false;  
 			}  
 			
 			$user_info = $this->getUserInfoAdmin($row->id_perusahaan);  
 			return $user_info;  

 		}else{  
 			return false;  
 		}  

	 }
	 
	 public function delete_token($token_full = NULL) {
		$token = substr($token_full, 0, 30);  
		$this->db->where("token", $token);
		return $this->db->delete("tokens");
	 }

 	public function getUserInfo($id)  
 	{  
 		$q = $this->db->get_where('t_perusahaan', array('ID_PERUSAHAAN' => $id), 1);   
 		if($this->db->affected_rows() > 0){  
 			$row = $q->row();  
 			return $row;  
 		}else{  
 			error_log('no user found getUserInfo('.$id.')');  
 			return false;  
 		}  
 	}  
 	
 	public function getUserInfoAdmin($id)  
 	{  
 		$q = $this->db->get_where('t_user', array('ID_USER' => $id), 1);   
 		if($this->db->affected_rows() > 0){  
 			$row = $q->row();  
 			return $row;  
 		}else{  
 			error_log('no user found getUserInfo('.$id.')');  
 			return false;  
 		}  
 	}  

	public function select_doc_by_id($id) {
		clean_sql($id);
		$sql = "SELECT * FROM t_document WHERE ID_PERUSAHAAN = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function tolak($data, $id) {

		// $sql = "UPDATE t_perusahaan SET ALASAN_PENOLAKAN='" .$data['ALASAN_PENOLAKAN'] ."', IS_VERIFIED='N' WHERE ID_PERUSAHAAN = '".$id."'";

		// $this->db->query($sql);

		// return $this->db->affected_rows();

		$new_data = array(
			"ALASAN_PENOLAKAN" => $data['ALASAN_PENOLAKAN'],
			"IS_VERIFIED" => "N",
			"IS_DOKUMEN_KOMPLIT" => NULL,
		);

		$this->db->where("ID_PERUSAHAAN", $id);

		return $this->db->update("t_perusahaan", $new_data);
	}

	public function updateProfile($data) { //TODO: CHECK THIS, IS_VERIFIED reset every profile update
		// $sql = "UPDATE t_perusahaan SET NAMA_PERUSAHAAN='" .$data['NAMA_PERUSAHAAN'] ."', ALAMAT='" .$data['ALAMAT'] ."', ID_PROVINSI='" .$data['ID_PROVINSI'] ."', ID_KABKOT='" .$data['ID_KABKOT'] ."', TELEPON='" .$data['TELEPON'] ."', FAX='" .$data['FAX'] ."', STATUS_MODAL='" .$data['STATUS_MODAL'] ."', WEBSITE='" .$data['WEBSITE'] ."' , IS_VERIFIED='', LAST_UPDATE='" .$data['last_update'] ."' WHERE EMAIL_PERUSAHAAN='" .$data['EMAIL_PERUSAHAAN'] ."'";
		$is_verified = $this->is_verified_by_email($data['EMAIL_PERUSAHAAN']);
		if($is_verified != "Y") {
			// When updating, if the status is not Y, reset.
			// Use case: When fixing a not accepted profile
			$is_verified = "";
		}
		
		// $sql = "UPDATE t_perusahaan SET NAMA_PERUSAHAAN='" .$data['NAMA_PERUSAHAAN'] ."', ALAMAT='" .$data['ALAMAT'] ."', ID_PROVINSI='" .$data['ID_PROVINSI'] ."', ID_KABKOT='" .$data['ID_KABKOT'] ."', TELEPON='" .$data['TELEPON'] ."', FAX='" .$data['FAX'] ."', STATUS_MODAL='" .$data['STATUS_MODAL'] ."', WEBSITE='" .$data['WEBSITE'] ."' , IS_VERIFIED='".$is_verified."', LAST_UPDATE='" .$data['last_update'] ."' WHERE EMAIL_PERUSAHAAN='" .$data['EMAIL_PERUSAHAAN'] ."'";

		// $this->db->query($sql);

		$new = array(
			"NAMA_PERUSAHAAN" => $data['NAMA_PERUSAHAAN'],
			"ALAMAT" => $data['ALAMAT'],
			"ID_PROVINSI" => $data['ID_PROVINSI'],
			"ID_KABKOT" => $data['ID_KABKOT'],
			"TELEPON" => $data['TELEPON'],
			"FAX" => $data['FAX'],
			"STATUS_MODAL" => $data['STATUS_MODAL'],
			"BIDANG_USAHA" => implode(',', $data['BIDANG_USAHA']),
			"WEBSITE" => $data['WEBSITE'],
			"IS_VERIFIED" => $is_verified,
			"LAST_UPDATE" => $data['last_update'],
			"TGL_DAFTAR" => $data['TGL_DAFTAR'],
		);

		$this->db->where("EMAIL_PERUSAHAAN", $data["EMAIL_PERUSAHAAN"]);
		return $this->db->update('t_perusahaan', $new);
	}

	public function ubah_password($email_perusahaan, $data) {
		$data['PASSWORD'] = md5($data['PASSWORD']); // TODO: Ask for salt.

		$this->db->where('EMAIL_PERUSAHAAN', $email_perusahaan);
		$this->db->set('PASSWORD', $data['PASSWORD']);
		$this->db->set('IS_PASSWORD_DEFAULT', 'Y');
		$result = $this->db->update('t_perusahaan');

		// $sql = "UPDATE t_perusahaan SET PASSWORD='" .$data['PASSWORD']."', IS_PASSWORD_DEFAULT='Y' WHERE EMAIL_PERUSAHAAN = '".$data['EMAIL_PERUSAHAAN']."'";

		// $this->db->query($sql);

		return $result;
	}
	
	public function ubah_password_admin($email_user, $data) {
		$data['PASSWORD'] = md5($data['PASSWORD']); // TODO: Ask for salt.

		$this->db->where('EMAIL_USER', $email_user);
		$this->db->set('PASSWORD', $data['PASSWORD']);
		$result = $this->db->update('t_user');

		// $sql = "UPDATE t_perusahaan SET PASSWORD='" .$data['PASSWORD']."', IS_PASSWORD_DEFAULT='Y' WHERE EMAIL_PERUSAHAAN = '".$data['EMAIL_PERUSAHAAN']."'";

		// $this->db->query($sql);

		return $result;
	}

	public function delete($id) {
		clean_sql($id);
		$sql = "DELETE FROM t_perusahaan WHERE ID_PERUSAHAAN='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function verifikasi_email($id, $password) {
		clean_sql($id);
		clean_sql($password);
		// $code = $this->userdata->NIK;
		$tanggal = date('Y-m-d h:i:sa');
		$password = md5($password);	
		$sql = "UPDATE t_perusahaan SET IS_VERIFIED = 'Y', TGL_APPROVE =  '".$tanggal."', PASSWORD =  '".$password."' WHERE ID_PERUSAHAAN = '".$id."' ";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function verifikasi($id_perusahaan) {
		// $code = $this->userdata->NIK;
		// $tanggal = date('Y-m-d h:i:s');
		// $sql = "UPDATE t_perusahaan SET IS_VERIFIED = 'Y', IS_DOKUMEN_KOMPLIT='Y', TGL_APPROVE =  '".$tanggal."' WHERE ID_PERUSAHAAN = '".$id_perusahaan."' ";

		// $this->db->query($sql);

		// return $this->db->affected_rows();

		$tanggal = date('Y-m-d h:i:s');

		$new_data = array(
			'IS_VERIFIED' => "Y",
			'IS_DOKUMEN_KOMPLIT' => "Y",
			'TGL_APPROVE' => $tanggal,
		);

		$this->db->where("ID_PERUSAHAAN", $id_perusahaan);
		return $this->db->update("t_perusahaan", $new_data);
	}

	public function complete_dokumen($id_perusahaan) {
		$this->db->set("IS_DOKUMEN_KOMPLIT", "Y");
		$this->db->where("ID_PERUSAHAAN", $id_perusahaan);
		
		return $this->db->update("t_perusahaan");
	}

	public function nonaktif($id_perusahaan) {
		// clean_sql($id);
		// $sql = "UPDATE t_perusahaan SET IS_VERIFIED = '' WHERE ID_PERUSAHAAN = '".$id."' ";

		// $this->db->query($sql);

		// return $this->db->affected_rows();

		$this->db->set("IS_VERIFIED", '');
		$this->db->set("IS_DOKUMEN_KOMPLIT", NULL);
		$this->db->where("ID_PERUSAHAAN", $id_perusahaan);

		return $this->db->update("t_perusahaan");
	}

	public function ban_perusahaan($id_perusahaan, $alasan_penolakan) {
		$this->db->set("IS_VERIFIED", "B");
		$this->db->set("IS_DOKUMEN_KOMPLIT", NULL);
		$this->db->set("ALASAN_PENOLAKAN", $alasan_penolakan);
		$this->db->where("ID_PERUSAHAAN", $id_perusahaan);
		
		return $this->db->update("t_perusahaan");
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('t_perusahaan');

		return $data->num_rows();
	}

	public function total_rows_unverified() {
		$this->db->select('*');
		$this->db->from('t_perusahaan');
		$this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');
		$this->db->where('IS_VERIFIED', '');
		$data = $this->db->get();

		return $data->num_rows();
	}

	public function is_verified($id_perusahaan) {
		$this->db->select("IS_VERIFIED");
		$this->db->from("t_perusahaan");
		$this->db->where("ID_PERUSAHAAN", $id_perusahaan);

		return $this->db->get()->row()->IS_VERIFIED;
	}

	public function is_verified_by_email($email_perusahaan) {
		$this->db->select("IS_VERIFIED");
		$this->db->from("t_perusahaan");
		$this->db->where("EMAIL_PERUSAHAAN", $email_perusahaan);

		return $this->db->get()->row()->IS_VERIFIED;
	}

	// List db datatable
	private function get_base_query_for_verifikasi($count_result = FALSE) {

		if($count_result) {
			$this->db->select('COUNT(*) as num');
		} else {
			$this->db->select('*');
		}
		
		$this->db->from('t_perusahaan');
		$this->db->order_by('IS_VERIFIED', 'ASC');
	}

	public function get_total_row() {
		// $data = $this->db->select("COUNT(*) as num");

		// $this->db->select('COUNT(*) as num');
		// $this->db->from('t_perusahaan');
		// $this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');
		// $this->db->order_by('IS_VERIFIED', 'ASC');

		$this->get_base_query_for_verifikasi(TRUE);
		$this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');

		$data = $this->db->get();
		
		$result = $data->row();

		if(isset($result)) return $result->num;
		  
		return 0;
	}


	public function select_all_as_get($start, $length, $order = NULL, $dir = NULL) {
		// $this->db->select('*');
		// $this->db->from('t_perusahaan');
		// $this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');
		// $this->db->order_by('IS_VERIFIED', 'ASC');

		$this->get_base_query_for_verifikasi(FALSE);
		$this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');

		$this->db->limit($length, $start);

		if(!is_null($order)) {
			$this->db->order_by($order, $dir);
	   	}

		$data = $this->db->get();

		return $data->result();
	}

	public function get_total_row_blacklist() {
		// $data = $this->db->select("COUNT(*) as num");

		// $this->db->select('COUNT(*) as num');
		// $this->db->from('t_perusahaan');
		// $this->db->where('IS_DOKUMEN_KOMPLIT', 'Y');
		// $this->db->order_by('IS_VERIFIED', 'ASC');

		$this->get_base_query_for_verifikasi(TRUE);
		$this->db->where("IS_VERIFIED", "B");

		$data = $this->db->get();
		
		$result = $data->row();

		if(isset($result)) return $result->num;
		  
		return 0;
	}

	public function get_total_row_decline() {
		$this->get_base_query_for_verifikasi(TRUE);
		$this->db->where("IS_VERIFIED", "N");

		$data = $this->db->get();
		
		$result = $data->row();

		if(isset($result)) return $result->num;
		  
		return 0;
	}

	public function select_all_decline($start, $length, $order = NULL, $dir = NULL) {
		$this->get_base_query_for_verifikasi(FALSE);
		$this->db->where("IS_VERIFIED", "N");

		$this->db->limit($length, $start);

		if(!is_null($order)) {
			$this->db->order_by($order, $dir);
	   	}

		$data = $this->db->get();

		return $data->result();
	}

	public function select_all_blacklist($start, $length, $order = NULL, $dir = NULL) {
		$this->get_base_query_for_verifikasi(FALSE);
		$this->db->where("IS_VERIFIED", "B");

		$this->db->limit($length, $start);

		if(!is_null($order)) {
			$this->db->order_by($order, $dir);
	   	}

		$data = $this->db->get();

		return $data->result();
	}
}