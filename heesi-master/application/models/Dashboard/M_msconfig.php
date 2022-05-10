<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_msconfig extends CI_Model {


	public function index(){
	}

	public function GetDataMsconfig($var_id){
		$this->db->select('');
		$this->db->from('msconfig');
		$this->db->where('var_id', $var_id);
		$this->db->order_by("description", "ASC");
		return $data = $this->db->get();
	}
}
