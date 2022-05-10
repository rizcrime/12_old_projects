<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konfigurasi extends CI_Model {


	public function index(){
	}

	public function GetMsconfig(){
		$this->db->select('');
		$this->db->from('msconfig');
		$this->db->where('var_id', 'hotel_mekkah');
		$this->db->or_like('var_id', 'hotel_madinah');
		$this->db->or_like('var_id', 'hotel_jeddah');
		$this->db->or_like('var_id', 'transport');
		return $data = $this->db->get();
	}

	public function InsertMsconfig(){
		$data = array(
			'noid' 			=> $this->input->post('var_id'),
			'description'		=> $this->input->post('description'),
			'var_id'			=> $this->input->post('var_id')
		);
		$this->db->insert('msconfig', $data);
	}

}
