<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gunung extends CI_Model {
	
	// public function select_all() {
	// 	$this->db->select('*');
	// 	$this->db->from('t_gunung');

	// 	$data = $this->db->get();
	// 	return $data->result();
		
	// }

	public function select_all() {
		$data = $this->db->select("t_gunung.ID_GUNUNG, t_gunung.NAMA_GUNUNG, t_gunung.ID_KABKOT, t_gunung.ID_PROVINSI, t_kabkot.NAMA_KABKOT, 
				t_provinsi.NAMA_PROVINSI")
		->from("t_gunung")
		->join("t_provinsi", "t_gunung.ID_PROVINSI = t_provinsi.ID_PROVINSI","LEFT")
		->join("t_kabkot", "t_gunung.ID_KABKOT = t_kabkot.ID_KABKOT","LEFT")
		
		->get();
		
		return $data->result();

		// $this->db->select("t_gunung.ID_GUNUNG, t_gunung.NAMA_GUNUNG, t_gunung.ID_KABKOT, t_gunung.ID_PROVINSI, t_kabkot.NAMA_KABKOT, 
		// 		t_provinsi.NAMA_PROVINSI");
		// $this->db->from("t_gunung");
		// $this->db->join("t_kabkot", "t_gunung.ID_KABKOT = t_kabkot.ID_KABKOT");
		// $this->db->join("t_provinsi", "t_gunung.ID_PROVINSI = t_provinsi.ID_PROVINSI");

		// $data = $this->db->get();
		// return $data->result();
	}

	

	

	public function insert($data) {
		$this->db->insert('t_gunung', $data);
		// $sql = "INSERT INTO t_gunung VALUES('".$data['ID_GUNUNG']."', '".$data['GUNUNG']."','".$data['TINGKAT']."')";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	/*public function select_by_id($id) {
		$this->db->select('*');
		$this->db->from('t_gunung');
		$this->db->where('ID_GUNUNG', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_gunung WHERE ID_GUNUNG = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}*/
	
	
	public function select_by_id($id) {
		clean_sql($id);
		$sql = "SELECT t_gunung.ID_GUNUNG, t_gunung.NAMA_GUNUNG, 
					t_gunung.ID_KABKOT,t_gunung.ID_PROVINSI, 
					t_kabkot.NAMA_KABKOT,t_provinsi.NAMA_PROVINSI 
				FROM t_gunung 
					LEFT JOIN t_provinsi on t_gunung.ID_PROVINSI = t_provinsi.ID_PROVINSI 
					LEFT JOIN t_kabkot ON t_gunung.ID_KABKOT = t_kabkot.ID_KABKOT
				WHERE ID_GUNUNG = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}
	
	
	//public function select_by_id($id) {
//		
//		/*$data = $this->db->select("t_gunung.ID_GUNUNG, t_gunung.NAMA_GUNUNG, t_gunung.ID_KABKOT, t_gunung.ID_PROVINSI, t_kabkot.NAMA_KABKOT, 
//				t_provinsi.NAMA_PROVINSI")
//		->from("t_gunung")
//		->join("t_kabkot", "t_gunung.ID_KABKOT = t_kabkot.ID_KABKOT","LEFT")
//		->join("t_provinsi", "t_gunung.ID_PROVINSI = t_provinsi.ID_PROVINSI","LEFT")
//		->get();
//		
//		return $data->result();*/
//		
//		
//		$this->db->select('
//			t_gunung.ID_GUNUNG, t_gunung.NAMA_GUNUNG, t_gunung.ID_KABKOT, 
//			t_gunung.ID_PROVINSI,t_kabkot.NAMA_KABKOT,t_provinsi.NAMA_PROVINSI
//		');
//		$this->db->from('t_gunung');
//		$this->db->join("t_kabkot", "t_gunung.ID_KABKOT = t_kabkot.ID_KABKOT","LEFT");
//		$this->db->join("t_provinsi", "t_gunung.ID_PROVINSI = t_provinsi.ID_PROVINSI","LEFT");
//		$this->db->where('t_user.ID_GUNUNG', $id);
//		$data = $this->db->get();
//		// $sql = "SELECT t_user.ID_USER, t_user.USERNAME, t_user.ID_ROLE, t_user.NAMA, t_user.JABATAN_STRUKTURAL, t_user.NIP, t_user.IS_ADMIN, t_role.ROLE, t_role.TINGKAT  FROM t_user, t_role WHERE t_user.ID_ROLE = t_role.ID_ROLE AND t_user.ID_USER = '{$id}'";
//
//		// $data = $this->db->query($sql);
//
//		return $data->row();
//	}
	
	
	/*public function select_akses_gunung($id_user) {
		$this->db->select('d.KATEGORI_LAPORAN');
		$this->db->from('t_hak_akses_gunung a');
		$this->db->join('t_kategori d','a.ID_KATEGORI = d.ID_KATEGORI','left');
		$this->db->join('t_gunung b','a.ID_GUNUNG = b.ID_GUNUNG','left');
		$this->db->join('t_user c','b.ID_GUNUNG = c.ID_GUNUNG','left');
		$this->db->where('c.ID_USER', $id_user);
		$data = $this->db->get();
		foreach ($data->result() as $row)
		{
			$menu = $row->KATEGORI_LAPORAN;
	    	$menuArr["$menu"] = "Y";
		}
		
		return $menuArr;
	}*/

	/*public function select_gunung_by_skema($id) {
		clean_sql($id);

		// $sql = "SELECT * FROM r_gunung_skema JOIN t_gunung ON ID_GUNUNG = WHERE ID_SKEMA = '{$id}'";
		$sql = "SELECT t_gunung.ID_GUNUNG as TR, t_gunung.GUNUNG , r_gunung_skema.ID_GUNUNG as RR  FROM t_gunung LEFT JOIN r_gunung_skema ON r_gunung_skema.ID_GUNUNG = t_gunung.ID_GUNUNG AND ID_SKEMA = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}*/

	public function update($data) {
		$this->db->where('ID_GUNUNG', $data['ID_GUNUNG']);
		$this->db->update('t_gunung', $data);
		// $sql = "UPDATE t_gunung SET GUNUNG='" .$data['GUNUNG'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_GUNUNG = '".$data['ID_GUNUNG']."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where('ID_GUNUNG', $id);
		$this->db->delete('t_gunung');

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('t_gunung');

		return $data->num_rows();
	}

	public function check_id($id) {
		$this->db->where('ID_GUNUNG', $id);
		$data = $this->db->get('t_gunung');

		return $data->num_rows();
	}

	public function total_rows() {
		$this->db->select('*');
		$this->db->from('t_gunung');
		$data = $this->db->get();

		return $data->num_rows();
	}


}