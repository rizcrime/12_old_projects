<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_role extends CI_Model {
	
	// public function select_all() {
	// 	$this->db->select('*');
	// 	$this->db->from('t_role');
	// 	$this->db->where('ROLE <>', 'KLIK');


	// 	$data = $this->db->get();
	// 	return $data->result();
	// }


	public function select_all() {


		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;
		// echo $id_role.'hehe';die();	
		if ( $id_role=='9' || $id_role =='10' || $id_role =='15' || $id_role =='8' ){
			// $this->db->where('ROLE <>', 'KLIK');
			// ->where('ROLE <>', 'KLIK');
		
			// $this->db->where('ID_ROLE', $id_role);	

			$role = 'PUSDATIN';			
			// echo $role_pusdatin.'woy';die();
		}
		else if ( $id_role=='13' || $id_role =='11' || $id_role =='17' || $id_role =='19'){
			// $this->db->where('ROLE <>', 'KLIK');
			// ->where('ROLE <>', 'KLIK');
		
			// $this->db->where('ID_ROLE', $id_role);	

			$role = 'GEO';		
			// echo $role.'hehe';die();
			// echo $id_role.'oy';die();	
		}
		else if ( $id_role=='14' || $id_role =='12' || $id_role =='20' || $id_role =='18'){
			// $this->db->where('ROLE <>', 'KLIK');
			// ->where('ROLE <>', 'KLIK');
		
			// $this->db->where('ID_ROLE', $id_role);	

			$role = 'BERITA';		
			// echo $role.'woy';die();		
		}

		 $this->db->select("t_user.ID_USER, t_user.USERNAME, t_user.ID_ROLE, t_user.NAMA_USER, t_user.IS_POST, t_role.ROLE");
		$this->db->from("t_role");
		$this->db->join("t_user", "t_user.ID_ROLE = t_role.ID_ROLE");

		// $this->db->select('*');
		// $this->db->from('t_role');
		if($id_role=='1'){
			// $this->db->like('t_role.ROLE', $role);

		}
		else {

			// $role = 'SUPER_ADMIN';
			// $this->db->where('ROLE <>', 'KLIK');
			$this->db->like('t_role.ROLE', $role);

		}	


		$data = $this->db->get();
		return $data->result();
		// echo $this->db->last_query();
		
	}


	public function insert($data) {
		$this->db->insert('t_role', $data);
		// $sql = "INSERT INTO t_role VALUES('".$data['ID_ROLE']."', '".$data['ROLE']."','".$data['TINGKAT']."')";

		// $this->db->query($sql);

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
	
	public function select_akses_role($id_user) {
		$this->db->select('d.KATEGORI_LAPORAN');
		$this->db->from('t_hak_akses_role a');
		$this->db->join('t_kategori d','a.ID_KATEGORI = d.ID_KATEGORI','left');
		$this->db->join('t_role b','a.ID_ROLE = b.ID_ROLE','left');
		$this->db->join('t_user c','b.ID_ROLE = c.ID_ROLE','left');
		$this->db->where('c.ID_USER', $id_user);
		$data = $this->db->get();
		if($data->result() == NULL){
			$menuArr = NULL;
		}else{
			foreach ($data->result() as $row)
			{
				$menu = $row->KATEGORI_LAPORAN;
				$menuArr["$menu"] = "Y";
			}
		}
				
		return $menuArr;
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

	public function delete($id) {
		$this->db->where('ID_ROLE', $id);
		$this->db->delete('t_role');

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