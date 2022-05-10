<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_paket extends CI_Model {


	public function index(){
	}

	public function GetDataPaket(){
		$this->db->select('');
		$this->db->from('t_paket_pihk');
		$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
		return $data = $this->db->get();
	}

	public function GetDataPaketAndJumlahPramanifest(){
		// if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {
  //           $this->db->select('');
		// 	$this->db->from('t_paket_pihk p, smpihk s');
  //           $this->db->where('p.kd_pihk = s.kd_pihk');
  //       }else{
  //           $this->db->select('');
		// 	$this->db->from('t_paket_pihk');
		// 	$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
  //       }
		// $data = $this->db->get()->result_array();

  //       for ($i=0; $i < count($data); $i++) { 
  //           $this->db->select('');
  //           $this->db->from('t_pra_manifest');
  //           $this->db->where('kd_paket', $data[$i]['kode_paket']);
  //           $data[$i]['jumlah_pramanifest'] = $this->db->get()->num_rows();
  //       }

  //       return $data;

		$this->db->select('s.kd_pihk, s.pihk, p.kode_paket, p.nama_paket, count(pm.kd_pra_manifest) as jumlah_pramanifest');
        $this->db->from('t_paket_pihk p');
        $this->db->join('smpihk s', 'p.kd_pihk = s.kd_pihk', 'inner');
        $this->db->join('t_pra_manifest pm', 'pm.kd_paket = p.kode_paket ', 'inner');
        
		if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
        	$this->db->where('s.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('s.kd_pihk, s.pihk, p.kode_paket, p.nama_paket');

        return $data = $this->db->get();
	}

	public function GetByDataPaket($kode){
		$this->db->select('');
		$this->db->from('t_paket_pihk');
		$this->db->where('kode_paket', $kode);
		return $data = $this->db->get();
	}

	public function GetPaketByKodepihk(){
		$this->db->select('');
		$this->db->from('t_paket_pihk');
		$this->db->where('kode_paket', $this->input->post('kode'));
		return $data = $this->db->get();
	}

	public function InsertPaket(){
		//Insert Tabel User
		$paket_gen=KodePaket();
		
		$data = array(
			'kode_paket' 		=> $paket_gen,
			'nama_paket'		=> $this->input->post('nama_paket'),
			'kd_pihk'			=> $this->session->userdata('kd_pihk'),
			'jenis_paket'		=> $this->input->post('jenis_paket'),
			'program_paket'		=> $this->input->post('program_paket'),
			'kode_tahun' 		=> $this->input->post('kode_tahun'),
			//'nama_airline'		=> $this->input->post('nama_airline'),
			'hp_petugas_1'		=> $this->input->post('hp_petugas_1'),
			'hp_petugas_2'		=> $this->input->post('hp_petugas_2'),
			'hp_petugas_3'		=> $this->input->post('hp_petugas_3'),
			'akomodasi_1'		=> $this->input->post('akomodasi_1'),
			'h_akomodasi_1'		=> $this->input->post('h_akomodasi_1'),
			'akomodasi_2'		=> $this->input->post('akomodasi_2'),
			'h_akomodasi_2'		=> $this->input->post('h_akomodasi_2'),
			'h_akomodasi_8'		=> $this->input->post('h_akomodasi_8'),
			'akomodasi_3'		=> $this->input->post('akomodasi_3'),
			'h_akomodasi_3'		=> $this->input->post('h_akomodasi_3'),
			'tgl_masuk_mekkah' 	=> $this->input->post('tgl_masuk_mekkah'),
			'tgl_keluar_mekkah' => $this->input->post('tgl_keluar_mekkah'),
			'tgl_masuk_madinah' => $this->input->post('tgl_masuk_madinah'),
			'tgl_keluar_madinah'=> $this->input->post('tgl_keluar_madinah'),
			'tgl_masuk_jeddah' 	=> $this->input->post('tgl_masuk_jeddah'),
			'tgl_keluar_jeddah' => $this->input->post('tgl_keluar_jeddah'),
			'komsumsi_1'		=> $this->input->post('komsumsi_1'),
			'komsumsi_2'		=> $this->input->post('komsumsi_2'),
			'komsumsi_3'		=> $this->input->post('komsumsi_3'),
			'komsumsi_4'		=> $this->input->post('komsumsi_4'),
			'transport'			=> $this->input->post('transport'),
			'petugas_as_1'		=> $this->input->post('petugas_as_1'),
			'hp_petugas_as_1'	=> $this->input->post('hp_petugas_as_1'),
			'petugas_as_2'		=> $this->input->post('petugas_as_2'),
			'hp_petugas_as_2'	=> $this->input->post('hp_petugas_as_2'),
			'petugas_as_3'		=> $this->input->post('petugas_as_3'),
			'hp_petugas_as_3'	=> $this->input->post('hp_petugas_as_3'),
			'harga_double'		=> $this->input->post('harga_double'),
			'harga_triple'		=> $this->input->post('harga_triple'),
			'harga_quadra'		=> $this->input->post('harga_quadra'),
			'hotel_transit'		=> $this->input->post('hotel_transit'),
			'kapasitas_kamar_transit'	=> $this->input->post('kapasitas_kamar_transit'),
			'alamat_hotel_transit'		=> $this->input->post('alamat_hotel_transit'),
			'tgl_masuk_transit'	=> $this->input->post('tgl_masuk_transit'),
			'tgl_keluar_transit'=> $this->input->post('tgl_keluar_transit'),
		);
		$ins = $this->db->insert('t_paket_pihk', $data);


		//Ambil nilai user_id
		// $this->db->select('');
		// $this->db->from('user');
		// $this->db->where('username', $this->input->post('username'));
		// $this->db->where('password', md5($this->input->post('password')));
		// $user_id = $this->db->get()->row_array();

		// //Insert Tabel Role
		// $data = array(
		// 	'user_id'			 => $user_id['user_id'],
		// 	'role'			  	=> $this->input->post('role')
		// );
		// $this->db->insert('role', $data);
	}

	public function EditPaket(){
		$data = array(
			'nama_paket'		=> $this->input->post('nama_paket'),
			'kd_pihk'			=> $this->session->userdata('kd_pihk'),
			'jenis_paket'		=> $this->input->post('jenis_paket'),
			'program_paket'		=> $this->input->post('program_paket'),
			'kode_tahun' 		=> $this->input->post('kode_tahun'),
			//'nama_airline'		=> $this->input->post('nama_airline'),
			'hp_petugas_1'		=> $this->input->post('hp_petugas_1'),
			'hp_petugas_2'		=> $this->input->post('hp_petugas_2'),
			'hp_petugas_3'		=> $this->input->post('hp_petugas_3'),
			'akomodasi_1'		=> $this->input->post('akomodasi_1'),
			'h_akomodasi_1'		=> $this->input->post('h_akomodasi_1'),
			'akomodasi_2'		=> $this->input->post('akomodasi_2'),
			'h_akomodasi_2'		=> $this->input->post('h_akomodasi_2'),
			'h_akomodasi_8'		=> $this->input->post('h_akomodasi_8'),
			'akomodasi_3'		=> $this->input->post('akomodasi_3'),
			'h_akomodasi_3'		=> $this->input->post('h_akomodasi_3'),
			'tgl_masuk_mekkah' 	=> $this->input->post('tgl_masuk_mekkah'),
			'tgl_keluar_mekkah' => $this->input->post('tgl_keluar_mekkah'),
			'tgl_masuk_madinah' => $this->input->post('tgl_masuk_madinah'),
			'tgl_keluar_madinah'=> $this->input->post('tgl_keluar_madinah'),
			'tgl_masuk_jeddah' 	=> $this->input->post('tgl_masuk_jeddah'),
			'tgl_keluar_jeddah' => $this->input->post('tgl_keluar_jeddah'),
			'komsumsi_1'		=> $this->input->post('komsumsi_1'),
			'komsumsi_2'		=> $this->input->post('komsumsi_2'),
			'komsumsi_3'		=> $this->input->post('komsumsi_3'),
			'komsumsi_4'		=> $this->input->post('komsumsi_4'),
			'transport'			=> $this->input->post('transport'),
			'petugas_as_1'		=> $this->input->post('petugas_as_1'),
			'hp_petugas_as_1'	=> $this->input->post('hp_petugas_as_1'),
			'petugas_as_2'		=> $this->input->post('petugas_as_2'),
			'hp_petugas_as_2'	=> $this->input->post('hp_petugas_as_2'),
			'petugas_as_3'		=> $this->input->post('petugas_as_3'),
			'hp_petugas_as_3'	=> $this->input->post('hp_petugas_as_3'),
			'harga_double'		=> $this->input->post('harga_double'),
			'harga_triple'		=> $this->input->post('harga_triple'),
			'harga_quadra'		=> $this->input->post('harga_quadra'),
			'hotel_transit'		=> $this->input->post('hotel_transit'),
			'kapasitas_kamar_transit'	=> $this->input->post('kapasitas_kamar_transit'),
			'alamat_hotel_transit'		=> $this->input->post('alamat_hotel_transit'),
			'tgl_masuk_transit'	=> $this->input->post('tgl_masuk_transit'),
			'tgl_keluar_transit'=> $this->input->post('tgl_keluar_transit'),
		);
		$this->db->where('kode_paket', $this->input->post('kode_paket'));
		$this->db->update('t_paket_pihk', $data);
	}

	public function DeletePaket(){
		$c = $this->input->post('kode_paket');

		$this->db->trans_start();

		$this->db->where('kode_paket', $c);
		$this->db->delete('t_paket_pihk');

		$this->db->trans_complete();
	}

	public function EksportPaket($kode){

		$this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kode_paket', $kode);

        return $this->db->get();
	}	

	public function GetDataPaketForExport(){
		$this->db->select('p.kd_pihk, s.pihk, p.kode_tahun, p.jenis_paket, p.program_paket, p.akomodasi_1, p.tgl_masuk_mekkah,
			p.tgl_keluar_mekkah, p.komsumsi_1, p.akomodasi_2, p.tgl_masuk_madinah, p.tgl_keluar_madinah, p.komsumsi_2,
			p.h_akomodasi_8, p.komsumsi_3, p.akomodasi_3, p.tgl_masuk_jeddah, p.tgl_keluar_jeddah, p.komsumsi_4, p.hotel_transit,
			p.tgl_masuk_transit, p.tgl_keluar_transit, p.harga_double, p.harga_triple, p.harga_quadra, count(pd.kd_pihk) as jumlah_jemaah');
		$this->db->from('t_paket_pihk p');
		$this->db->join('smpihk s', 'p.kd_pihk = s.kd_pihk', 'inner');
		$this->db->join('t_pra_manifest pm', 'pm.kd_paket = p.kode_paket', 'inner');
		$this->db->join('t_pra_manifest_detail pd', 'pd.kd_pra_manifest = pm.kd_pra_manifest', 'inner');
		$this->db->group_by('p.kd_pihk, s.pihk, p.kode_tahun, p.jenis_paket, p.program_paket, p.akomodasi_1, p.tgl_masuk_mekkah,
			p.tgl_keluar_mekkah, p.komsumsi_1, p.akomodasi_2, p.tgl_masuk_madinah, p.tgl_keluar_madinah, p.komsumsi_2,
			p.h_akomodasi_8, p.komsumsi_3, p.akomodasi_3, p.tgl_masuk_jeddah, p.tgl_keluar_jeddah, p.komsumsi_4, p.hotel_transit,
			p.tgl_masuk_transit, p.tgl_keluar_transit, p.harga_double, p.harga_triple, p.harga_quadra');
		return $data = $this->db->get();
	}
}
