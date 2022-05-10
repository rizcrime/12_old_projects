<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_paket');
		$this->load->model('Dashboard/M_msconfig');
	}

	public function index()
	{
		$data['data_paket'] = $this->M_paket->GetDataPaketAndJumlahPramanifest()->result();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/paket/v_paket', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function detail_paket($kode){
		$data['data_paket'] = $this->M_paket->GetByDataPaket($kode)->result();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/paket/v_paket_detail', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function detail_paket_pramanifest(){
		$result = $this->M_paket->GetPaketByKodepihk()->result();
		// echo var_dump(json_encode($result));die();
		echo json_encode($result);
	}

	public function tambah_paket(){
		show_succ_msg('Berhasil', '20px');
		$data['jenis'] = $this->M_msconfig->GetDataMsconfig('jenis_paket')->result();
		$data['program'] = $this->M_msconfig->GetDataMsconfig('program_paket')->result();
		$data['armani'] = $this->M_msconfig->GetDataMsconfig('h_akomodasi_8')->result();
		$data['mekkah'] = $this->M_msconfig->GetDataMsconfig('hotel_mekkah')->result();
		$data['madinah'] = $this->M_msconfig->GetDataMsconfig('hotel_madinah')->result();
		$data['jeddah'] = $this->M_msconfig->GetDataMsconfig('hotel_jeddah')->result();
		$data['komsumsi'] = $this->M_msconfig->GetDataMsconfig('komsumsi')->result();
		$data['kasur'] = $this->M_msconfig->GetDataMsconfig('jumlah_kasur')->result();
		$data['nama_airline'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
		$data['transport'] = $this->M_msconfig->GetDataMsconfig('transport')->result();

		//$this->form_validation->set_message('required', '%s harus diisi');

		$this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required');
		// $this->form_validation->set_rules('hp_petugas_1', 'No. HP Dokter', 'required');
		// $this->form_validation->set_rules('hp_petugas_2', 'No. HP Pembimbing', 'required');
		// $this->form_validation->set_rules('hp_petugas_3', 'No. HP Tour Leader', 'required');
		// $this->form_validation->set_rules('akomodasi_1', 'Mekkah', 'required');
		// $this->form_validation->set_rules('akomodasi_2', 'Madinah', 'required');
		// $this->form_validation->set_rules('akomodasi_3', 'Jeddah', 'required');
		// $this->form_validation->set_rules('h_akomodasi_1', 'Hari', 'required');
		// $this->form_validation->set_rules('h_akomodasi_2', 'Hari', 'required');
		// $this->form_validation->set_rules('h_akomodasi_3', 'Hari', 'required');
		// $this->form_validation->set_rules('petugas_as_1', 'Mutawif 1', 'required');
		// $this->form_validation->set_rules('petugas_as_2', 'Mutawif 2', 'required');
		// $this->form_validation->set_rules('petugas_as_3', 'Mutawif 3', 'required');
		// $this->form_validation->set_rules('hp_petugas_as_1', 'No. HP', 'required');
		// $this->form_validation->set_rules('hp_petugas_as_2', 'No. HP', 'required');
		// $this->form_validation->set_rules('hp_petugas_as_3', 'No. HP', 'required');
		// $this->form_validation->set_rules('harga_paket', 'Harga Paket', 'required');

		if($this->form_validation->run() == TRUE){
			$this->insert_to_database();
		};

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/paket/v_paket_tambah', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function insert_to_database(){
		$this->M_paket->InsertPaket();
		redirect('Dashboard/paket','refresh');
	}

	public function edit_paket($kode){
		$data['data_paket'] = $this->M_paket->GetByDataPaket($kode)->result();
		$data['jenis'] = $this->M_msconfig->GetDataMsconfig('jenis_paket')->result();
		$data['airline'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
		$data['program'] = $this->M_msconfig->GetDataMsconfig('program_paket')->result();
		$data['armani'] = $this->M_msconfig->GetDataMsconfig('h_akomodasi_8')->result();
		$data['mekkah'] = $this->M_msconfig->GetDataMsconfig('hotel_mekkah')->result();
		$data['transit'] = $this->M_msconfig->GetDataMsconfig('hotel_mekkah')->result();
		$data['madinah'] = $this->M_msconfig->GetDataMsconfig('hotel_madinah')->result();
		$data['jeddah'] = $this->M_msconfig->GetDataMsconfig('hotel_jeddah')->result();
		$data['komsumsi'] = $this->M_msconfig->GetDataMsconfig('komsumsi')->result();
		$data['kasur'] = $this->M_msconfig->GetDataMsconfig('jumlah_kasur')->result();
		$data['nama_airline'] = $this->M_msconfig->GetDataMsconfig('nama_airline')->result();
		$data['transport'] = $this->M_msconfig->GetDataMsconfig('transport')->result();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/paket/v_paket_edit', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_edit(){
		$this->M_paket->EditPaket();
		redirect('Dashboard/paket','refresh');
	}

	public function delete_paket(){
		$result = $this->M_paket->DeletePaket();
		echo json_encode($result);
	}

	public function action($kode){
		$query = $this->M_paket->EksportPaket($kode)->result();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Paket_PIHK.xlsx'); 
		foreach($query as $query){
			$object->setActiveSheetIndex(0)->setCellValue('B5', $query->kode_tahun.' H / '.date('Y').' M')
				->setCellValue('K3', $query->kd_pihk)
				->setCellValue('D22', $query->h_akomodasi_2)
				->setCellValue('D23', $query->h_akomodasi_1)
				->setCellValue('D24', $query->h_akomodasi_8)
				->setCellValue('D26', $query->akomodasi_1)
				->setCellValue('D27', $query->akomodasi_2)
				->setCellValue('D28', $query->akomodasi_3)
				->setCellValue('D31', $query->komsumsi_1)
				->setCellValue('D32', $query->komsumsi_2)
				->setCellValue('D33', $query->komsumsi_4)
				->setCellValue('D36', $query->harga_paket);

				$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Data Paket - '.$query->kode_paket.'.xls"');		
		}
		$object_writer->save('php://output');
	}

	public function export_all(){
		$data = $this->M_paket->GetDataPaketForExport()->result();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Seluruh_Paket.xlsx'); 

		//Insert sheet pramanifest
		$count = 3;
		$no = 1;
		foreach ($data as $data) {

			if ($data->tgl_masuk_mekkah != NULL) {
				$tgl_masuk_mekkah = date('d/m/Y', strtotime($data->tgl_masuk_mekkah));
			}else{
				$tgl_masuk_mekkah = '';
			}

			if ($data->tgl_keluar_mekkah != NULL) {
				$tgl_keluar_mekkah = date('d/m/Y', strtotime($data->tgl_keluar_mekkah));
			}else{
				$tgl_keluar_mekkah = '';
			}

			if ($data->tgl_masuk_madinah != NULL) {
				$tgl_masuk_madinah = date('d/m/Y', strtotime($data->tgl_masuk_madinah));
			}else{
				$tgl_masuk_madinah = '';
			}

			if ($data->tgl_keluar_madinah != NULL) {
				$tgl_keluar_madinah = date('d/m/Y', strtotime($data->tgl_keluar_madinah));
			}else{
				$tgl_keluar_madinah = '';
			}

			if ($data->tgl_masuk_jeddah != NULL) {
				$tgl_masuk_jeddah = date('d/m/Y', strtotime($data->tgl_masuk_jeddah));
			}else{
				$tgl_masuk_jeddah = '';
			}

			if ($data->tgl_keluar_jeddah != NULL) {
				$tgl_keluar_jeddah = date('d/m/Y', strtotime($data->tgl_keluar_jeddah));
			}else{
				$tgl_keluar_jeddah = '';
			}

			if ($data->tgl_masuk_transit != NULL) {
				$tgl_masuk_transit = date('d/m/Y', strtotime($data->tgl_masuk_transit));
			}else{
				$tgl_masuk_transit = '';
			}

			if ($data->tgl_keluar_transit != NULL) {
				$tgl_keluar_transit = date('d/m/Y', strtotime($data->tgl_keluar_transit));
			}else{
				$tgl_keluar_transit = '';
			}
                          
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data->kd_pihk)
				->setCellValue('C'.$count, $data->pihk)
				->setCellValue('D'.$count, $data->kode_tahun)
				->setCellValue('E'.$count, $data->jenis_paket)
				->setCellValue('F'.$count, $data->program_paket)
				->setCellValue('G'.$count, $data->akomodasi_1)
				->setCellValue('H'.$count, $tgl_masuk_mekkah)
				->setCellValue('I'.$count, $tgl_keluar_mekkah)
				->setCellValue('J'.$count, $data->komsumsi_1)
				->setCellValue('K'.$count, $data->akomodasi_2)
				->setCellValue('L'.$count, $tgl_masuk_madinah)
				->setCellValue('M'.$count, $tgl_keluar_madinah)
				->setCellValue('N'.$count, $data->komsumsi_2)
				->setCellValue('O'.$count, $data->h_akomodasi_8)
				->setCellValue('P'.$count, $data->komsumsi_3)
				->setCellValue('Q'.$count, $data->akomodasi_3)
				->setCellValue('R'.$count, $tgl_masuk_jeddah)
				->setCellValue('S'.$count, $tgl_keluar_jeddah)
				->setCellValue('T'.$count, $data->komsumsi_4)
				->setCellValue('U'.$count, $data->hotel_transit)
				->setCellValue('V'.$count, $tgl_masuk_transit)
				->setCellValue('W'.$count, $tgl_keluar_transit)
				->setCellValue('X'.$count, $data->harga_double)
				->setCellValue('Y'.$count, $data->harga_triple)
				->setCellValue('Z'.$count, $data->harga_quadra)
				->setCellValue('AA'.$count, $data->jumlah_jemaah)
				;
			$count++;
			$no++;
		}


		header('Content-Disposition: attachment;filename="Paket PIHK - '.date("d/m/Y").'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}
}

		


		
