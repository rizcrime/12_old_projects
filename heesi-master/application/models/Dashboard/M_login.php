<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {


	public function index(){
	}

	public function CheckLogin(){
		$this->db->select('');
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('auth_key', md5($this->input->post('password')));
		$this->db->limit(1);
		return $data = $this->db->get();
	}

	public function check_user($username, $password) {
		$this->db->select('');
		$this->db->from('user');
		$this->db->join('smpihk', 'user.kd_pihk = smpihk.kd_pihk');
		$this->db->where('username', $username);
		$this->db->where('auth_key', md5($password));
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	public function check_non_pihk_login($username, $password) {
		$this->db->select('');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('auth_key', md5($password));
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	public function GetDataPelangganByID($id){
		$this->db->select('');
		$this->db->from('data_pelanggan');
		$this->db->where('id ='.$id);
		return $data = $this->db->get();
	}

	public function InsertPelanggan(){
		$data = array(
			'nama'			  => $this->input->post('nama_pelanggan'),
			'alamat'		  => $this->input->post('alamat'),
			'email'			  => $this->input->post('email'),
			'no_handphone'	  => $this->input->post('no_handphone'),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'no_telepon'	  => $this->input->post('no_telepon')
		);
		$this->db->insert('data_pelanggan', $data);
	}

	public function EditPelanggan(){
		$data = array(
			'nama'			  => $this->input->post('nama_pelanggan'),
			'alamat'		  => $this->input->post('alamat'),
			'email'			  => $this->input->post('email'),
			'no_handphone'	  => $this->input->post('no_handphone'),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'no_telepon'	  => $this->input->post('no_telepon')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('data_pelanggan', $data);
	}

	public function DeletePelanggan($id){
		$this->db->where('id', $id);
		$this->db->delete('data_pelanggan');
	}
}
