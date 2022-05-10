<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstrumenIndo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
			redirect('Dashboard/login');
		}
		$this->load->model('Dashboard/M_instrumen_indo');
		$this->load->model('Dashboard/M_msconfig');
		$this->load->model('Dashboard/M_paket');
	}

	public function index()
	{
		$data['DataInstrumen'] = $this->M_instrumen_indo->GetAllData();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_home_indo',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function tambah()
	{
		$data['DataInstrumen'] = $this->M_instrumen_indo->GetAllPertanyaan();
		// var_dump($data['DataInstrumen']);die();
		$data['PIHK'] = $this->M_instrumen_indo->GetPIHK();
		$data['Bandara'] = $this->M_instrumen_indo->GetDataBandara("bandara_indo");
		$data['Maskapai'] = $this->M_instrumen_indo->GetDataBandara("nama_airline");
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_tambah_instrumen_indo',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function ubah($id)
	{
		$data['DataInstrumenDetail'] = $this->M_instrumen_indo->GetDataById($id);
		$data['DataInstrumen'] = $this->M_instrumen_indo->GetAllPertanyaan();
		$data['PIHK'] = $this->M_instrumen_indo->GetPIHK();
		$data['Bandara'] = $this->M_instrumen_indo->GetDataBandara("bandara_indo");
		$data['Maskapai'] = $this->M_instrumen_indo->GetDataBandara("nama_airline");
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_ubah_instrumen_indo',$data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function detail($id)
	{
		$data['DataInstrumenDetail'] = $this->M_instrumen_indo->GetDataById($id);
		$data['DataInstrumen'] = $this->M_instrumen_indo->GetAllPertanyaan();
		$data['PIHK'] = $this->M_instrumen_indo->GetPIHK();
		$data['Bandara'] = $this->M_instrumen_indo->GetDataBandara("bandara_indo");
		$data['Maskapai'] = $this->M_instrumen_indo->GetDataBandara("nama_airline");
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/instrumen/v_lihat_instrumen_indo',$data);
		$this->load->view('Dashboard/layout/footer');
	}
	
	public function export($id)
	{
		// Data pegawai
		$DataInstrumenDetail = $this->M_instrumen_indo->GetDataById($id);
		// Data instrumen
		$DataInstrumen = $this->M_instrumen_indo->GetAllPertanyaan();
		// Data PIHK
		$PIHK = $this->M_instrumen_indo->GetPIHK();
		// Data Bandara
		$Bandara = $this->M_instrumen_indo->GetDataBandara("bandara_indo");
		// Data airline
		$Maskapai = $this->M_instrumen_indo->GetDataBandara("nama_airline");
		// nomor
		$no = 1;
		// huruf (a,b,c)
		$abc = 'a';
		// index array
		$index = 0;
		// nomor buat excel
		$excel = 14;

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Instrumen_indo.xlsx');
		foreach ($PIHK as $key) {
			if ($DataInstrumenDetail[0]->kode_pihk == $key->kd_pihk){
				$object->setActiveSheetIndex(0)
					->setCellValue('E4', $key->pihk);
			}
		}
		$object->setActiveSheetIndex(0)
			->setCellValue('E5', $DataInstrumenDetail[0]->nama_petugas)
			->setCellValue('E6', $DataInstrumenDetail[0]->no_telepon_petugas);
		foreach ($Bandara as $key) {
			 if ($DataInstrumenDetail[0]->kode_bandara == $key->noid){
				$object->setActiveSheetIndex(0)
					->setCellValue('E7', $key->description); 	
			 }
		}
		$object->setActiveSheetIndex(0)
			->setCellValue('E8', $DataInstrumenDetail[0]->jumlah_jemaah)
			->setCellValue('E9', $DataInstrumenDetail[0]->jadwal_keberangkatan);
		foreach ($Maskapai as $key) {
			 if ($DataInstrumenDetail[0]->kode_maskapai == $key->noid){
				$object->setActiveSheetIndex(0)
					->setCellValue('E10', $key->description); 	
			 }
		}	

		 foreach ($DataInstrumen as $data) {
			 if ($no >= 3 && $abc <= 'g'){ // untuk yang perlengakapan
			 	if($no == 3){
			 		$object->setActiveSheetIndex(0)
						->setCellValue('A'.$excel, $no)
						->setCellValue('C'.$excel, $data->nama_pertnyaan);
						$no++;
						$excel++;
			 	}else{
			 		$object->setActiveSheetIndex(0)
						->setCellValue('B'.$excel, $abc)
						->setCellValue('C'.$excel, $data->nama_pertnyaan);
						$abc++;
					if($DataInstrumenDetail[$index]->realisasi == 99){ // jika pertanyaan belum diisi
						
					}elseif($DataInstrumenDetail[$index]->realisasi == 0){// jika peretanyaan tidak sesuai
						$object->setActiveSheetIndex(0)
							->setCellValue('F'.$excel, "√");
					}else{// jika pertanyaan sesuai / sudah ada
						$object->setActiveSheetIndex(0)
							->setCellValue('E'.$excel, "√");
					}
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel, $DataInstrumenDetail[$index]->keterangan); 
						$index++;
						$abc++;
						$excel++;
				}
			 }elseif($data->instrumen_indo_pertanyaan_id == 13){// untuk yang Jumlah jemaah yang tidak jadi berangkat	
			 		$object->setActiveSheetIndex(0)
						->setCellValue('A'.$excel, $no)
						->setCellValue('C'.$excel, $data->nama_pertnyaan);
						if($DataInstrumenDetail[$index]->realisasi == 99){ // jika pertanyaan belum diisi
						
						}elseif($DataInstrumenDetail[$index]->realisasi == 0){// jika peretanyaan tidak sesuai
							$object->setActiveSheetIndex(0)
								->setCellValue('F'.$excel, "√");
						}else{ // jika pertanyaan sesuai / sudah ada
							$object->setActiveSheetIndex(0)
								->setCellValue('E'.$excel, "√");
						}
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel,"Jumlah Jemaah : ". $DataInstrumenDetail[$index]->jumlah_jemaah_tidak_jadi_berangkat);
						$excel++;
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel,"Alasan : ". $DataInstrumenDetail[$index]->alasan); 
						$no++;
						$index++;
						$excel++;
			 }elseif($data->instrumen_indo_pertanyaan_id == 14){ // untuk Jemaah resiko tinggi
			 		$object->setActiveSheetIndex(0)
						->setCellValue('A'.$excel, $no)
						->setCellValue('C'.$excel, $data->nama_pertnyaan);
						if($DataInstrumenDetail[$index]->realisasi == 99){ // jika pertanyaan belum diisi
						
						}elseif($DataInstrumenDetail[$index]->realisasi == 0){// jika peretanyaan tidak sesuai
							$object->setActiveSheetIndex(0)
								->setCellValue('F'.$excel, "√");
						}else{ // jika pertanyaan sesuai / sudah ada
							$object->setActiveSheetIndex(0)
								->setCellValue('E'.$excel, "√");
						}
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel,"Jumlah Jemaah : ". $DataInstrumenDetail[$index]->jumlah_jemaah_resiko_tinggi);
						$excel++;
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel,"Keterangan Sakit : ". $DataInstrumenDetail[$index]->keterangan_sakit); 
						$no++;
						$index++;
						$excel++;
			 }else{
			 		$object->setActiveSheetIndex(0)
						->setCellValue('A'.$excel, $no)
						->setCellValue('C'.$excel, $data->nama_pertnyaan);
						if($DataInstrumenDetail[$index]->realisasi == 99){ // jika pertanyaan belum diisi
						
						}elseif($DataInstrumenDetail[$index]->realisasi == 0){// jika peretanyaan tidak sesuai
							$object->setActiveSheetIndex(0)
								->setCellValue('F'.$excel, "√");
						}else{ // jika pertanyaan sesuai / sudah ada
							$object->setActiveSheetIndex(0)
								->setCellValue('E'.$excel, "√");
						}
						$object->setActiveSheetIndex(0)
							->setCellValue('G'.$excel,"keterangan : ". $DataInstrumenDetail[$index]->keterangan);
						$excel++;
						$no++;
						$index++;
			 }
		}

		// format nama file
		$nama_file = 'Instrumen Indonesia - '.$DataInstrumenDetail[0]->instrumen_indo_id.'.xls';
		header('Content-Disposition: attachment;filename="'.$nama_file.'";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
	
		$object_writer->save('php://output');	

	}

	public function proses_tambah()
	{
		$jadwal_keberangkatan=date('Y-m-d',strtotime($this->input->post('jadwal_keberangkat')));
		$DataPegawai = array(
				'kode_pihk' => $this->input->post('kd_pihk'),
				'nama_petugas' => $this->input->post('nama_petugas'),
				'no_telepon_petugas' => $this->input->post('no_telepon_petugas'),
				'kode_bandara' => $this->input->post("kode_bandara"),
				'jumlah_jemaah' => $this->input->post("jumlah_jemaah"),
				'jadwal_keberangkatan' => $jadwal_keberangkatan,
				'kode_maskapai' => $this->input->post("kode_maskapai")
				 );
		$instrumen_indo_id = $this->M_instrumen_indo->input_data_instrumen_indo($DataPegawai);

		$DataPertanyaan = $this->M_instrumen_indo->GetAllPertanyaan();
		foreach ($DataPertanyaan as $data) {
			if ($data->instrumen_indo_pertanyaan_id != 3) {
				if ($data->instrumen_indo_pertanyaan_id == 13) {
					$DataInsert = array(
						'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
						'instrumen_indo_id' => $instrumen_indo_id
					);
					$id = $this->M_instrumen_indo->input_data_instrumen_indo_penilaian($DataInsert);
					$DataInsertdll = array(
						'jumlah_jemaah_tidak_jadi_berangkat' => $this->input->post('jumlah_jemaah_tidak_jadi_berangkat'),
						'alasan' => $this->input->post('alasan'),
						'instrumen_indo_penilaian_id' => $id
					);
					$this->M_instrumen_indo->input_tabel_lain("t_keterangan_tidak_jadi_berangkat_indo", $DataInsertdll);
				}elseif($data->instrumen_indo_pertanyaan_id == 14){
					$DataInsert = array(
						'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
						'instrumen_indo_id' => $instrumen_indo_id
					);
					$id = $this->M_instrumen_indo->input_data_instrumen_indo_penilaian($DataInsert);
					$DataInsertdll = array(
						'jumlah_jemaah_resiko_tinggi' => $this->input->post('jumlah_jemaah_resiko_tinggi'),
						'keterangan_sakit' => $this->input->post('keterangan_sakit'),
						'instrumen_indo_penilaian_id' => $id
					);
					$this->M_instrumen_indo->input_tabel_lain("t_keterangan_resiko_tinggi_indo", $DataInsertdll);
				}else{					
					$DataInsert = array(
						'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
						'keterangan' 	=> $this->input->post('keterangan')[$data->instrumen_indo_pertanyaan_id],
						'instrumen_indo_id' => $instrumen_indo_id
					);
					$this->M_instrumen_indo->input_data_instrumen_indo_penilaian($DataInsert);
				}
			}
		}
	}

	public function proses_ubah()
	{
		
		$jadwal_keberangkatan=date('Y-m-d',strtotime($this->input->post('jadwal_keberangkat')));
		$DataPegawai = array(
				'instrumen_indo_id'	=> $this->input->post('instrumen_indo_id'),
				'kode_pihk' => $this->input->post('kd_pihk'),
				'nama_petugas' => $this->input->post('nama_petugas'),
				'no_telepon_petugas' => $this->input->post('no_telepon_petugas'),
				'kode_bandara' => $this->input->post("kode_bandara"),
				'jumlah_jemaah' => $this->input->post("jumlah_jemaah"),
				'jadwal_keberangkatan' => $jadwal_keberangkatan,
				'kode_maskapai' => $this->input->post("kode_maskapai")
				 );
		$this->M_instrumen_indo->update_data_instrumen_indo('instrumen_indo','instrumen_indo_id',$DataPegawai);
		$instrumen_indo_id = $this->input->post('instrumen_indo_id');
		$DataPertanyaan = $this->M_instrumen_indo->GetAllPertanyaan();
		foreach ($DataPertanyaan as $data) {
			if ($data->instrumen_indo_pertanyaan_id != 3) {
				if ($data->instrumen_indo_pertanyaan_id == 13) {
					$DataInsert = array(
						'instrumen_indo_penilaian_id' => $this->input->post('instrumen_indo_penilaian_id')[$data->instrumen_indo_pertanyaan_id],
						'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
						'instrumen_indo_id' => $instrumen_indo_id
					);
					$this->M_instrumen_indo->update_data_instrumen_indo('instrumen_indo_penilaian','instrumen_indo_penilaian_id',$DataInsert);
					$id = $this->input->post('instrumen_indo_penilaian_id')[$data->instrumen_indo_pertanyaan_id];
					$DataInsertdll = array(
						'jumlah_jemaah_tidak_jadi_berangkat' => $this->input->post('jumlah_jemaah_tidak_jadi_berangkat'),
						'alasan' => $this->input->post('alasan'),
						'instrumen_indo_penilaian_id' => $id
					);
					$this->M_instrumen_indo->update_data_instrumen_indo("t_keterangan_tidak_jadi_berangkat_indo",'instrumen_indo_penilaian_id', $DataInsertdll);
				}elseif($data->instrumen_indo_pertanyaan_id == 14){
					$DataInsert = array(
							'instrumen_indo_penilaian_id' => $this->input->post('instrumen_indo_penilaian_id')[$data->instrumen_indo_pertanyaan_id],
							'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
							'instrumen_indo_id' => $instrumen_indo_id
					);
					$this->M_instrumen_indo->update_data_instrumen_indo('instrumen_indo_penilaian','instrumen_indo_penilaian_id',$DataInsert);
					$id = $this->input->post('instrumen_indo_penilaian_id')[$data->instrumen_indo_pertanyaan_id];
					$DataInsertdll = array(
						'jumlah_jemaah_resiko_tinggi' => $this->input->post('jumlah_jemaah_resiko_tinggi'),
						'keterangan_sakit' => $this->input->post('keterangan_sakit'),
						'instrumen_indo_penilaian_id' => $id
					);
					$this->M_instrumen_indo->update_data_instrumen_indo("t_keterangan_resiko_tinggi_indo", 'instrumen_indo_penilaian_id', $DataInsertdll);
				}else{					
					$DataInsert = array(
						'instrumen_indo_penilaian_id' => $this->input->post('instrumen_indo_penilaian_id')[$data->instrumen_indo_pertanyaan_id],
						'realisasi' 	=> $this->input->post('realisasi')[$data->instrumen_indo_pertanyaan_id],
						'keterangan' 	=> $this->input->post('keterangan')[$data->instrumen_indo_pertanyaan_id],
						'instrumen_indo_id' => $instrumen_indo_id
					);
					$this->M_instrumen_indo->update_data_instrumen_indo('instrumen_indo_penilaian','instrumen_indo_penilaian_id',$DataInsert);
				}
			}
		}
	}
}





