<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {


	public function index(){
	}

	public function UbahPassword(){
		$data = array(
            'auth_key'         => md5($this->input->post('password_baru'))
        );
		$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
		$this->db->update('user', $data);
	}

	public function EditProfile(){
		$this->db->select('');
		$this->db->from('smpihk');
		$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
		return $this->db->get()->result();
	}

	public function ProsesEditProfile(){
		$data = array(
			'no_telp'			=> $this->input->post('no_telp'),
			'no_izin'			=> $this->input->post('no_izin'),
			'no_sk'				=> $this->input->post('no_sk'),
			'habis_masa_berlaku'=> $this->input->post('habis_masa_berlaku'),
			'pimpinan' 			=> $this->input->post('pimpinan'),
			'email'				=> $this->input->post('email'),
			'wilayah'			=> $this->input->post('wilayah'),
			'kota'				=> $this->input->post('kota'),
			'alamat'			=> $this->input->post('alamat'),
			'tgl_penetapan_sk'	=> $this->input->post('tgl_penetapan_sk'),
			'asosiasi'			=> $this->input->post('asosiasi'),
		);
		$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
		$this->db->update('smpihk', $data);
	}
}
