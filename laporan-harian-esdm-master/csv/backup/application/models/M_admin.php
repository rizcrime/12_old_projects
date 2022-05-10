<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function select_all() {
		$data = $this->db->select("t_user.ID_USER, t_user.USERNAME, t_user.ID_ROLE, t_user.NAMA_USER, t_user.IS_POST, t_role.ROLE")
		->from("t_user")
		->join("t_role", "t_user.ID_ROLE = t_role.ID_ROLE")
		->get();
		
		return $data->result();
	}

	public function select_by_id($id) {
		$this->db->select('
			t_user.ID_USER, 
			t_user.USERNAME, 
			t_user.PASSWORD,
			t_user.ID_ROLE, 
			t_user.NAMA_USER, 
			t_user.IS_POST, 
			t_role.ROLE
		');
		$this->db->from('t_user');
		$this->db->join('t_role', 't_user.ID_ROLE = t_role.ID_ROLE');
		$this->db->where('t_user.ID_USER', $id);
		$data = $this->db->get();
		// $sql = "SELECT t_user.ID_USER, t_user.USERNAME, t_user.ID_ROLE, t_user.NAMA, t_user.JABATAN_STRUKTURAL, t_user.NIP, t_user.IS_ADMIN, t_role.ROLE, t_role.TINGKAT  FROM t_user, t_role WHERE t_user.ID_ROLE = t_role.ID_ROLE AND t_user.ID_USER = '{$id}'";

		// $data = $this->db->query($sql);

		return $data->row();
	}
	
	public function select_user_is_post($id) {
		$this->db->select('
			t_user.IS_POST
		');
		$this->db->from('t_user');
		$this->db->where('t_user.ID_USER', $id);
		$data = $this->db->get();

		return $data->row();
	}

	public function delete($id) {
		$this->db->where('ID_USER', $id);
		$this->db->delete('t_user');
		// $sql = "DELETE FROM t_user WHERE ID_USER='" .$id ."'";

		// $this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		$val = array(
			'USERNAME' => $data['USERNAME'],
			'PASSWORD' => md5($data['PASSWORD']),
			'ID_ROLE' => $data['ID_ROLE'],
			'NAMA_USER' => $data['NAMA_USER'],
			'IS_POST' => $data['IS_POST']
		);
		$this->db->insert('t_user', $val);
		
		// $sql = "INSERT INTO t_user VALUES('','".$data['USERNAME']."','".md5($data['PASSWORD'])."','".$data['ID_ROLE']."','".$data['NAMA']."','".$data['JABATAN_STRUKTURAL']."','".$data['NIP']."','".$data['IS_ADMIN']."')";

		// $this->db->query($sql);
		
		//$this->db->insert('t_user', $data);

		return $this->db->affected_rows();
	}

	public function update($data) {
		if(!empty($data['PASSWORD'])) {
			$val = array(
				'USERNAME' => $data['USERNAME'],
				
				'PASSWORD' => md5($data['PASSWORD']),
				'ID_ROLE' => $data['ID_ROLE'],
				'NAMA_USER' => $data['NAMA_USER'],
				'IS_POST' => $data['IS_POST']
			);
			// $this->db->where('ID_USER', $data['ID_USER']);
			// $this->db->update('t_user', $val);
		// $sql = "UPDATE t_user SET USERNAME='" .$data['USERNAME'] ."', PASSWORD='" .md5($data['PASSWORD']) ."', ID_ROLE='" .$data['ID_ROLE'] ."', NAMA='" .$data['NAMA'] ."', JABATAN_STRUKTURAL='" .$data['JABATAN_STRUKTURAL'] ."', NIP='" .$data['NIP'] ."', IS_ADMIN='" .$data['IS_ADMIN'] ."' WHERE ID_USER='" .$data['ID_USER'] ."'";			
		} else {
			$val = array(
				'USERNAME' => $data['USERNAME'],
				
				//'PASSWORD' => md5($data['PASSWORD']),
				'ID_ROLE' => $data['ID_ROLE'],
				'NAMA_USER' => $data['NAMA_USER'],
				
				'IS_POST' => $data['IS_POST']
			);
			// $this->db->where('ID_USER', $data['ID_USER']);
			// $this->db->update('t_user', $val);
		// $sql = "UPDATE t_user SET USERNAME='" .$data['USERNAME'] ."', ID_ROLE='" .$data['ID_ROLE'] ."', NAMA='" .$data['NAMA'] ."', JABATAN_STRUKTURAL='" .$data['JABATAN_STRUKTURAL'] ."', NIP='" .$data['NIP'] ."', IS_ADMIN='" .$data['IS_ADMIN'] ."' WHERE ID_USER='" .$data['ID_USER'] ."'";						
		}

		$this->db->where('ID_USER', $data['ID_USER']);
		return $this->db->update('t_user', $val);

		// $this->db->query($sql);

		// return $this->db->affected_rows();
	}

	public function check_nama($username) {
		$this->db->where('NAMA', $username);
		$data = $this->db->get('t_user');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('t_user');

		return $data->num_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('ID_USER', $id);
		}

		$data = $this->db->get('t_user');

		return $data->row();
	}
	
	public function select_hak_akses($id_role) {
		$id_role = $this->db->escape($id_role);
		
		$sub = "(select ID_KATEGORI, 'Y' as akses FROM t_hak_akses_role where ID_ROLE = ".$id_role.") ";

		$data = $this->db->select("a.*, b.akses")
		->from("t_kategori a")
		->join("$sub b", "a.ID_KATEGORI = b.ID_KATEGORI", "left")
		->order_by("a.ID_KATEGORI", "ASC")
		->get();

		return $data->result();
    }
    
    public function update_for_user($id_role, $list_id_form) {
		// Using Delete ALL x Insert method
        // If slow, use something else.

        // This is an atomic transaction
        $this->db->trans_start();

        // Delete
        $this->db->where('ID_ROLE', $id_role);
        $this->db->delete('t_hak_akses_role');

        // Insert

        // Won't change much, reuse.
        $new = array(
            "ID_ROLE" => $id_role,
            "ID_KATEGORI" => NULL
        );

        foreach($list_id_form as $id_form) {
            $new['ID_KATEGORI'] = $id_form;
            $this->db->insert("t_hak_akses_role", $new);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}