<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {


	public function index(){
	}

	public function GetDataTransaksi(){
		$this->db->select('');
		$this->db->from('pesanan p, event e');
		$this->db->where('p.event_id = e.event_id');
		$this->db->where('e.event_id', $this->session->userdata('event_id'));
		return $data = $this->db->get();
	}

	public function GetNoTiket($kode_pesanan){
		$this->db->select('');
		$this->db->from('pesanan p, event e');
		$this->db->where('p.event_id = e.event_id');
		$this->db->where('e.event_id', $this->session->userdata('event_id'));
		$this->db->where('p.kode_pesanan', $kode_pesanan);
		$data = $this->db->get();
		return $data->num_rows();
	}

	public function GetTiketByID($id){
		$this->db->select('');
		$this->db->from('tiket');
		$this->db->where('tiket_id ='.$id);
		return $data = $this->db->get();
	}

	public function InsertTransaksi(){
		//Insert kedalam tabel Pesanan
		$data = array(
			'event_id'			=> $this->session->userdata('event_id'),
			'no_identitas'		=> $this->input->post('no_identitas'),
			'jenis_identitas'	=> $this->input->post('jenis_identitas'),
			'nama_pelanggan'	=> $this->input->post('nama_pelanggan'),
			'tgl_pembelian'		=> $this->input->post('tgl_pembelian'),
			'metode'			=> $this->input->post('metode'),
			'status'			=> $this->input->post('status'),
			// 'pic'				=> $this->input->post('tgl_pembelian'),
			'isDatang'			=> "N"
		);
		$this->db->insert('pesanan', $data);
		$id = $this->db->insert_id();

		//Generate no tiket dengan memanggil helper kode_tiket
		$no_tiket = KodeTiket();

		//Memasukkan kode_pesanan dengan update table pesanan sesuai dengan id terakhir
		$data = array(
			'kode_pesanan'		=> $no_tiket
		);
		$this->db->where('pesanan_id', $id);
		$this->db->update('pesanan', $data);

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
