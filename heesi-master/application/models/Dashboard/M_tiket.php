<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tiket extends CI_Model {


	public function index(){
	}

	public function GetDataTiket(){
		$this->db->select('t.tiket_id, t.kelas, t.harga, t.jumlah');
		$this->db->from('tiket t, event e');
		$this->db->where('t.event_id = e.event_id');
		$this->db->where('e.event_id', $this->session->userdata('event_id'));
		$this->db->order_by('t.harga', 'desc');
		return $data = $this->db->get();
	}

	public function GetTiketByID($id){
		$this->db->select('');
		$this->db->from('tiket');
		$this->db->where('tiket_id ='.$id);
		return $data = $this->db->get();
	}

	public function InsertTiket(){
		$data = array(
			'event_id'			=> $this->session->userdata('event_id'),
			'kelas'				=> $this->input->post('kelas'),
			'harga'		  		=> $this->input->post('harga'),
			'jumlah'			=> $this->input->post('jumlah')
		);
		$this->db->insert('tiket', $data);
	}

	public function EditTiket(){
		$data = array(
			'event_id'			=> $this->session->userdata('event_id'),
			'kelas'				=> $this->input->post('kelas'),
			'harga'		  		=> $this->input->post('harga'),
			'jumlah'			=> $this->input->post('jumlah')
		);
		$this->db->where('tiket_id', $this->input->post('id'));
		$this->db->update('tiket', $data);
	}

	public function DeleteTiket($id){
		$this->db->where('tiket_id', $id);
		$this->db->delete('tiket');
	}
}
