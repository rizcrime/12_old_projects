<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktivitas extends CI_Model {
	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('t_aktivitas');

		$data = $this->db->get();
		return $data->result();
	}

	public function insert($data) {
		$this->db->insert('t_aktivitas', $data);
		// $sql = "INSERT INTO t_aktivitas VALUES('".$data['ID_AKTIVITAS']."', '".$data['AKTIVITAS']."','".$data['TINGKAT']."')";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function select_by_id($id) {
		$this->db->select('*');
		$this->db->from('t_aktivitas');
		$this->db->where('ID_AKTIVITAS', $id);
		$data = $this->db->get();
		// $sql = "SELECT * FROM t_aktivitas WHERE ID_AKTIVITAS = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}
	
	/*public function select_akses_aktivitas($id_user) {
		$this->db->select('d.KATEGORI_LAPORAN');
		$this->db->from('t_hak_akses_aktivitas a');
		$this->db->join('t_kategori d','a.ID_KATEGORI = d.ID_KATEGORI','left');
		$this->db->join('t_aktivitas b','a.ID_AKTIVITAS = b.ID_AKTIVITAS','left');
		$this->db->join('t_user c','b.ID_AKTIVITAS = c.ID_AKTIVITAS','left');
		$this->db->where('c.ID_USER', $id_user);
		$data = $this->db->get();
		foreach ($data->result() as $row)
		{
			$menu = $row->KATEGORI_LAPORAN;
	    	$menuArr["$menu"] = "Y";
		}
		
		return $menuArr;
	}*/

	/*public function select_aktivitas_by_skema($id) {
		clean_sql($id);

		// $sql = "SELECT * FROM r_aktivitas_skema JOIN t_aktivitas ON ID_AKTIVITAS = WHERE ID_SKEMA = '{$id}'";
		$sql = "SELECT t_aktivitas.ID_AKTIVITAS as TR, t_aktivitas.AKTIVITAS , r_aktivitas_skema.ID_AKTIVITAS as RR  FROM t_aktivitas LEFT JOIN r_aktivitas_skema ON r_aktivitas_skema.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS AND ID_SKEMA = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}*/

	public function update($data) {
		$this->db->where('ID_AKTIVITAS', $data['ID_AKTIVITAS']);
		$this->db->update('t_aktivitas', $data);
		// $sql = "UPDATE t_aktivitas SET AKTIVITAS='" .$data['AKTIVITAS'] ."', TINGKAT='".$data['TINGKAT']."' WHERE ID_AKTIVITAS = '".$data['ID_AKTIVITAS']."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$this->db->where('ID_AKTIVITAS', $id);
		$this->db->delete('t_aktivitas');

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('t_aktivitas');

		return $data->num_rows();
	}

	public function check_id($id) {
		$this->db->where('ID_AKTIVITAS', $id);
		$data = $this->db->get('t_aktivitas');

		return $data->num_rows();
	}

	public function total_rows() {
		$this->db->select('*');
		$this->db->from('t_aktivitas');
		$data = $this->db->get();

		return $data->num_rows();
	}


}