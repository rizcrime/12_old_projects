<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instrumen extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
			redirect('Dashboard/login');
		}
		$this->load->model('Dashboard/M_instrumen');
		$this->load->model('Dashboard/M_msconfig');
		$this->load->model('Dashboard/M_paket');
	}

	public function index()
	{
		$data['DataInstrumen'] = $this->M_instrumen->GetAllData();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/Home',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function detail($id)
	{
		$data['DataPIHK'] = $this->M_instrumen->GetDataById($id);
		$data['InstrumenDetail'] = $this->M_instrumen->GetDetailById($id);
		$data['KeteranganSakit'] = $this->M_instrumen->GetKeteranganSakitById($id);
		$data['KeteranganWafat'] = $this->M_instrumen->GetKeteranganWafatById($id);
		$data['KeteranganKetinggal'] = $this->M_instrumen->GetKeteranganKetinggalById($id);
		$data["JudulAkumodasi"] = $this->M_instrumen->GetJudulById(4);
		$data["JudulPermasalahan"] = $this->M_instrumen->GetJudulById(6);
		$data['InstrumenDetailMasalah'] = $this->M_instrumen->GetLastDetailById($id);
		$data['Layanan'] = $this->M_instrumen->GetLayanan();
		$data['PIHK'] = $this->M_instrumen->GetPIHK();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_lihat_instrumen',$data);
		$this->load->view('Dashboard/layout/footer');
	}
	
	public function tambah()
	{
		$data['Layanan'] = $this->M_instrumen->GetLayanan();
		$data["JudulAkumodasi"] = $this->M_instrumen->GetJudulById(4);
		$data["JudulPermasalahan"] = $this->M_instrumen->GetJudulById(6);
		$data['PIHK'] = $this->M_instrumen->GetPIHK();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_tambah_instrumen',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function ubah($id)
	{
		$data['DataPIHK'] = $this->M_instrumen->GetDataById($id);
		$data['InstrumenDetail'] = $this->M_instrumen->GetDetailById($id);
		// var_dump($data['InstrumenDetail']);die();
		$data['KeteranganSakit'] = $this->M_instrumen->GetKeteranganSakitById($id);
		$data['KeteranganWafat'] = $this->M_instrumen->GetKeteranganWafatById($id);
		$data['KeteranganKetinggal'] = $this->M_instrumen->GetKeteranganKetinggalById($id);
		$data["JudulAkumodasi"] = $this->M_instrumen->GetJudulById(4);
		$data["JudulPermasalahan"] = $this->M_instrumen->GetJudulById(6);
		$data['InstrumenDetailMasalah'] = $this->M_instrumen->GetLastDetailById($id);
		$data['Layanan'] = $this->M_instrumen->GetLayanan();
		$data['PIHK'] = $this->M_instrumen->GetPIHK();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_ubah_instrumen',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_tambah()
	{
		$datapihk = array(
			'kd_pihk'			=> $this->input->post('kd_pihk'),
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'no_telepon_petugas' => $this->input->post('nomor_telepon'),
			'daerah_kerja_1'	=> $this->input->post('daerah_kerja_1'),
			'daerah_kerja_2'	=> $this->input->post('daerah_kerja_2'),
			'daerah_kerja_3'	=> $this->input->post('daerah_kerja_3')
			);
		$instrumen_as_id = $this->M_instrumen->input_instrumen_id($datapihk);
		$datalayanan = $this->M_instrumen->GetLayanan();
		foreach ($datalayanan as $layanan) {
			if($layanan->instrumen_as_layanan_detail_id == 23 || $layanan->instrumen_as_layanan_detail_id == 41){
				$datadetail = array(
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $instrumen_as_id
					);
				$id = $this->M_instrumen->input_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'jumlah'	=> $this->input->post("jumlah_sakit")[$layanan->instrumen_as_layanan_detail_id],
					'sakit'		=> $this->input->post("sakit")[$layanan->instrumen_as_layanan_detail_id],
					'penanganan'=> $this->input->post("penanganan_sakit")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_detail_id' => $id,
					'lokasi_dirawat' => $this->input->post("lokasi_dirawat")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id
					);
				$this->M_instrumen->input_detail_keterangan_sakit($datadetailketerangan);
			}elseif($layanan->instrumen_as_layanan_detail_id == 24 || $layanan->instrumen_as_layanan_detail_id == 42){
				$datadetail = array(
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $instrumen_as_id
					);
				$id = $this->M_instrumen->input_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'cod'		=> $this->input->post("cod")[$layanan->instrumen_as_layanan_detail_id],
					'lokasi_pemakaman'=> $this->input->post("lokasi_pemakaman")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_detail_id' => $id,
					'jumlah'	=> $this->input->post('jumlah_wafat')[$layanan->instrumen_as_layanan_detail_id]	,
					'penanganan'=> $this->input->post("penangan_wafat")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id 
					);
				$this->M_instrumen->input_detail_keterangan_wafat($datadetailketerangan);
			}elseif ($layanan->instrumen_as_layanan_detail_id == 6) {
				$datadetail = array(
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $instrumen_as_id 
					);
				$id = $this->M_instrumen->input_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'jumlah_jemaah'		=> $this->input->post("jumlah_jemaah"),
					'alasan'=> $this->input->post("alasan"),
					'posisi_jemaah'=> $this->input->post("posisi_jemaah"),
					'instrumen_as_detail_id' => $id
					);
				$this->M_instrumen->input_detail_keterangan_tertinggal($datadetailketerangan);
			}else{
				$datadetail = array(
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'keterangan'=> $this->input->post("keterangan")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $instrumen_as_id 
					);
				$id = $this->M_instrumen->input_instrumen_as_detail($datadetail);
			}
		}
				$datadetail = array(
					'keterangan'=> $this->input->post("keterangan_masalah_penanganan"),
					'instrumen_as_layanan_detail_id' => 99,
					'instrumen_as_id' => $instrumen_as_id 
					);	
				$id = $this->M_instrumen->input_instrumen_as_detail($datadetail);
	}

	public function proses_ubah()
	{	
		$datapihk = array(
			'instrumen_as_id'	=> $this->input->post('instrumen_as_id'),
			'kd_pihk'			=> $this->input->post('kd_pihk'),
			'nama_petugas'		=> $this->input->post('nama_petugas'),
			'no_telepon_petugas' => $this->input->post('nomor_telepon'),
			'daerah_kerja_1'	=> $this->input->post('daerah_kerja_1'),
			'daerah_kerja_2'	=> $this->input->post('daerah_kerja_2'),
			'daerah_kerja_3'	=> $this->input->post('daerah_kerja_3')
			);
		$instrumen_as_id = $this->M_instrumen->update_instrumen_id($datapihk);
		$datalayanan = $this->M_instrumen->GetLayanan();
		foreach ($datalayanan as $layanan) {
			if($layanan->instrumen_as_layanan_detail_id == 23 || $layanan->instrumen_as_layanan_detail_id == 41){
				$datadetail = array(
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $this->input->post('instrumen_as_id')
					);
				$id = $this->M_instrumen->update_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'jumlah'	=> $this->input->post("jumlah_sakit")[$layanan->instrumen_as_layanan_detail_id],
					'sakit'		=> $this->input->post("sakit")[$layanan->instrumen_as_layanan_detail_id],
					'penanganan'=> $this->input->post("penanganan_sakit")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'lokasi_dirawat' => $this->input->post("lokasi_dirawat")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id
					);
				$this->M_instrumen->update_detail_keterangan_sakit($datadetailketerangan);
			}elseif($layanan->instrumen_as_layanan_detail_id == 24 || $layanan->instrumen_as_layanan_detail_id == 42){
				$datadetail = array(
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $this->input->post('instrumen_as_id')
					);
				$id = $this->M_instrumen->update_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'cod'		=> $this->input->post("cod")[$layanan->instrumen_as_layanan_detail_id],
					'lokasi_pemakaman'=> $this->input->post("lokasi_pemakaman")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'jumlah'	=> $this->input->post('jumlah_wafat')[$layanan->instrumen_as_layanan_detail_id]	,
					'penanganan'=> $this->input->post("penangan_wafat")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id 
					);
				$this->M_instrumen->update_detail_keterangan_wafat($datadetailketerangan);
			}elseif ($layanan->instrumen_as_layanan_detail_id == 6) {
				$datadetail = array(
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $this->input->post('instrumen_as_id')
					);
				$id = $this->M_instrumen->update_instrumen_as_detail($datadetail);
				$datadetailketerangan = array(
					'jumlah_jemaah'		=> $this->input->post("jumlah_jemaah"),
					'alasan'=> $this->input->post("alasan"),
					'posisi_jemaah'=> $this->input->post("posisi_jemaah"),
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id]
					);
				$this->M_instrumen->update_detail_keterangan_tertinggal($datadetailketerangan);
			}else{
				$datadetail = array(
					'instrumen_as_detail_id' => $this->input->post("instrumen_as_detail_id")[$layanan->instrumen_as_layanan_detail_id],
					'rencana'	=> $this->input->post("rencana")[$layanan->instrumen_as_layanan_detail_id],
					'realisasi'	=> $this->input->post("realisasi")[$layanan->instrumen_as_layanan_detail_id],
					'keterangan'=> $this->input->post("keterangan")[$layanan->instrumen_as_layanan_detail_id],
					'instrumen_as_layanan_detail_id' => $layanan->instrumen_as_layanan_detail_id,
					'instrumen_as_id' => $this->input->post('instrumen_as_id') 
					);
				$id = $this->M_instrumen->update_instrumen_as_detail($datadetail);
			}
		}
				$datadetail = array(
					'instrumen_as_detail_id' => $this->input->post("id_keteranagan_masalah"),
					'keterangan'=> $this->input->post("keterangan_masalah_penanganan"),
					'instrumen_as_layanan_detail_id' => 99,
					'instrumen_as_id' => $this->input->post('instrumen_as_id') 
					);
				$id = $this->M_instrumen->update_instrumen_as_detail($datadetail);
	}

	public function export($id)
	{
		// Data Instrumen Orangnya
		$DataPIHK = $this->M_instrumen->GetDataById($id);
		// Data Instrumen layanannya
		$Layanan = $this->M_instrumen->GetLayanan();
		// Data Instrumen Penilaiannya
		$DataInstrumen = $this->M_instrumen->GetDetailById($id);
		// Data Instrumen keterangan Sakit
		$KeteranganSakit = $this->M_instrumen->GetKeteranganSakitById($id);
		// Data Instrumen Keterangan Wafat
		$KeteranganWafat = $this->M_instrumen->GetKeteranganWafatById($id);
		// Data Instrumen Keteranga Tertinggal
		$KeteranganKetinggal = $this->M_instrumen->GetKeteranganKetinggalById($id);
		// Untuk Judul Akomodasi (Akomodasi Transit Makkah)
		$JudulAkumodasi = $this->M_instrumen->GetJudulById(4);
		// Untuk Judul Permasalahan
		$JudulPermasalahan = $this->M_instrumen->GetJudulById(6);
		// Keterangan Masalah
		$InstrumenDetailMasalah = $this->M_instrumen->GetLastDetailById($id);
		// Index InstrumenDetail
		$x = 0;
		// Insdek keterangan sakit
		$index_sakit = 0;
		// Index wafat
		$index_wafat = 0;
		// index excel sheet 1
		$count = 13;
		// variabel judul
		$nama_judul = "";
		// variabel layanan
		$nama_layanan = "";
		// variabel penomoran untuk angka
		$no = 1; 
		// variabel penomoran untuk huruf besar
		$abc = 'A';
		// variabel penomoran untuk huruf kecil
		$xyz = 'a';
		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Instrumen.xlsx'); 
		// insert data PIHK di sheet 0
		$object->setActiveSheetIndex(0)
			->setCellValue('E4', $DataPIHK->pihk)
			->setCellValue('E5', $DataPIHK->nama_petugas)
			->setCellValue('E6', $DataPIHK->no_telepon_petugas)
			->setCellValue('E7', $DataPIHK->daerah_kerja_1)
			->setCellValue('E8', $DataPIHK->daerah_kerja_2)
			->setCellValue('E9', $DataPIHK->daerah_kerja_3);

		// Insert data instrumen di sheet 1
		//looping data layanan
		foreach ($Layanan as $layanan) {
			//untuh cetak judul layanan
			if ($layanan->nama_judul == NULL && $abc == "D") {
				$nama_judul = $layanan->nama_judul;
				$object->setActiveSheetIndex(0)
					->setCellValue("A".$count, $abc)
					->setCellValue("B".$count, $JudulAkumodasi->nama_judul);
				$abc++;
				$no = 1;
				$count++;
			}elseif($layanan->nama_judul != $nama_judul){
				$nama_judul = $layanan->nama_judul;
				$object->setActiveSheetIndex(0)
					->setCellValue("A".$count, $abc)
					->setCellValue("B".$count, $nama_judul);
				$abc++;
				$no = 1;
				$count++;
			}
			//untuk cetak menu layanan
			if ($layanan->nama_layanan != $nama_layanan && $layanan->nama_layanan != NULL){
			 	$nama_layanan = $layanan->nama_layanan;
			 	$object->setActiveSheetIndex(0)
			 	->setCellValue("A".$count, $no)
			 	->setCellValue("B".$count, $nama_layanan);
			 	$no++;
			 	$count++;
			 	$xyz = 'a';
			}
			 // Untuk cetak data layanan
			if ($layanan->instrumen_as_layanan_detail_id == 6) {// Untuk kondisi jemaah tertinggal 
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("B".$count, $xyz)
			 		->setCellValue("C".$count, $layanan->nama_layanan_detail)
			 		->setCellValue("D".$count, $DataInstrumen[$x]->rencana);
			 		if ($DataInstrumen[$x]->realisasi == 0) { // Untuk Belum isi realisasi
			 			
			 		}elseif($DataInstrumen[$x]->realisasi == 1){// Untuk yang realisasi sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("F".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 2){//  Untuk yang realisasi sebagian sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("G".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 3){// Untuk yang realisasi tidak sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("H".$count, "√");
			 		}
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "jumlah jemaah : ".$KeteranganKetinggal->jumlah_jemaah);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Alasan : ".$KeteranganKetinggal->alasan);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Posisi jemaah : ".$KeteranganKetinggal->posisi_jemaah);
			 	$count++;
			 	$xyz++;
			}elseif ($layanan->instrumen_as_layanan_detail_id == 23 || $layanan->instrumen_as_layanan_detail_id == 41) {// Untuk kondisi jemaah sakit 
			 	$object->setActiveSheetIndex(0)
				 	->setCellValue("B".$count, $xyz)
			 		->setCellValue("C".$count, $layanan->nama_layanan_detail)
			 		->setCellValue("D".$count, $DataInstrumen[$x]->rencana);
			 		if ($DataInstrumen[$x]->realisasi == 0) { // Untuk Belum isi realisasi
			 			
			 		}elseif($DataInstrumen[$x]->realisasi == 1){// Untuk yang realisasi sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("F".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 2){//  Untuk yang realisasi sebagian sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("G".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 3){// Untuk yang realisasi tidak sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("H".$count, "√");
			 		}
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "jumlah : ".$KeteranganSakit[$index_sakit]->jumlah);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Lokasi Dirawat : ".$KeteranganSakit[$index_sakit]->lokasi_dirawat);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Sakit : ".$KeteranganSakit[$index_sakit]->sakit);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Penanganan : ".$KeteranganSakit[$index_sakit]->penanganan);
			 	$count++;
			 	$index_sakit++;
			 	$xyz++;
			}elseif ($layanan->instrumen_as_layanan_detail_id == 24 || $layanan->instrumen_as_layanan_detail_id == 42) {// Untuk kondisi jemaah wafat 
			 	$object->setActiveSheetIndex(0)
				 	->setCellValue("B".$count, $xyz)
			 		->setCellValue("C".$count, $layanan->nama_layanan_detail)
			 		->setCellValue("D".$count, $DataInstrumen[$x]->rencana);
			 		if ($DataInstrumen[$x]->realisasi == 0) { // Untuk Belum isi realisasi
			 			
			 		}elseif($DataInstrumen[$x]->realisasi == 1){// Untuk yang realisasi sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("F".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 2){//  Untuk yang realisasi sebagian sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("G".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 3){// Untuk yang realisasi tidak sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("H".$count, "√");
			 		}
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "jumlah : ".$KeteranganWafat[$index_wafat]->jumlah);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Penanganan : ".$KeteranganWafat[$index_wafat]->penanganan);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "COD : ".$KeteranganWafat[$index_wafat]->cod);
			 	$count++;
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, "Lokasi pemakaman : ".$KeteranganWafat[$index_wafat]->lokasi_pemakaman);
			 	$count++;
			 	$index_wafat++;
			 	$xyz++;
			}else{// Untuk kondisi yang biasa 
			 	$object->setActiveSheetIndex(0)
				 	->setCellValue("B".$count, $xyz)
			 		->setCellValue("C".$count, $layanan->nama_layanan_detail)
			 		->setCellValue("D".$count, $DataInstrumen[$x]->rencana);
			 		if ($DataInstrumen[$x]->realisasi == 0) { // Untuk Belum isi realisasi
			 			
			 		}elseif($DataInstrumen[$x]->realisasi == 1){// Untuk yang realisasi sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("F".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 2){//  Untuk yang realisasi sebagian sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("G".$count, "√");
			 		}elseif($DataInstrumen[$x]->realisasi == 3){// Untuk yang realisasi tidak sesuai
			 			$object->setActiveSheetIndex(0)
			 				->setCellValue("H".$count, "√");
			 		}
			 	$object->setActiveSheetIndex(0)
			 		->setCellValue("I".$count, $DataInstrumen[$x]->keterangan);
			 	$count++;	
			 	$xyz++;
			}
			$x++;			
		}
		// Untuk insrtumen permasalahan dan penanganannya
		$object->setActiveSheetIndex(0)
			->setCellValue('A100', $abc)
			->setCellValue("B100", $JudulPermasalahan->nama_judul)
			->setCellValue("B101", $InstrumenDetailMasalah->keterangan);
		// format nama file
		$nama_file = 'Instrumen - '.$DataPIHK->instrumen_as_id.'.xls';
		header('Content-Disposition: attachment;filename="'.$nama_file.'";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
	
		$object_writer->save('php://output');		
	}

	// gak tau function buat apa, mau dihapus takut dipake !!!
	public function tambah_instrumen_as(){
        // ini_set('max_execution_time', 0);
        // $data['data_keberangkatanke'] = $this->M_msconfig->GetDataMsconfig('pemberangkatan_ke')->result();
        $data['kode_paket'] = $this->M_paket->GetDataPaket()->result();
        $data['bandara_berangkat'] = $this->M_msconfig->GetDataMsconfig('bandara_indo')->result();
        $data['bandara_pulang'] = $this->M_msconfig->GetDataMsconfig('bandara_tujuan_as')->result();
        $data['airline_berangkat'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
        $data['airline_pulang'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
        $data['jenis_penerbangan_brkt'] = $this->M_msconfig->GetDataMsconfig('jenis_penerbangan')->result();
        $data['jenis_penerbangan_pulang'] = $this->M_msconfig->GetDataMsconfig('jenis_penerbangan')->result();
        $data['bandara_transit_brkt'] = $this->M_msconfig->GetDataMsconfig('bandara_transit')->result();
        $data['bandara_transit_pulang'] = $this->M_msconfig->GetDataMsconfig('bandara_transit')->result();
        $data['airline_transit_berangkat'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
        $data['airline_transit_pulang'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
        $data['bandara_tujuan_as'] = $this->M_msconfig->GetDataMsconfig('bandara_tujuan_as')->result();
        $data['bandara_tujuan_pulang'] = $this->M_msconfig->GetDataMsconfig('bandara_indo')->result();
        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."&status_lunas=1";
        $konten = file_get_contents($file);
        $data['list_jamaah'] = json_decode($konten);

        //Untuk mengambil nama jamaah yang sudah masuk database
        $data['data_pramanifest'] = $this->M_pramanifest->GetPramanifestdetail()->result();
    }
}





