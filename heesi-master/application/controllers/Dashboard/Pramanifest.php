<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pramanifest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_pramanifest');
		$this->load->model('Dashboard/M_msconfig');
		$this->load->model('Dashboard/M_paket');
	}

	public function index()
	{
		$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktual();
		$data['count_pihk'] = $this->M_pramanifest->GetCountPIHKByPramanifest();
		$data['all_counted_pihk'] = $this->M_pramanifest->GetAllCountedPIHKByPramanifest();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest', $data);
		$this->load->view('Dashboard/layout/footer');
	}
	public function tampil()
	{
		$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktual();
		$this->load->view('Dashboard/pramanifest/v_pramanifest_data_list', $data);
	}
	public function detail_pramanifest($id){
		$data['data_pramanifest'] = $this->M_pramanifest->GetPramanifestByID($id)->result();
		$data['data_pramanifest_detail'] = $this->M_pramanifest->GetPramanifestdetailByID($id)->result();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest_detail', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function tambah_pramanifest(){
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

		$this->form_validation->set_rules('kd_tahun', 'Kode Tahun', 'required');
		$this->form_validation->set_rules('kd_pihk', 'Kode PIHK', 'required');
		$this->form_validation->set_rules('kd_paket', 'Kode Paket', 'required');
		$this->form_validation->set_rules('pemberangkatan_ke', 'Pemberangkatan Ke', 'required');
		// $this->form_validation->set_rules('bandara_brkt', 'Bandara Berangkat', 'required');
		// $this->form_validation->set_rules('nm_airline_brkt', 'Nama Airline Berangkat', 'required');
		// $this->form_validation->set_rules('no_flight_brkt', 'No. Flight Berangkat', 'required');
		// $this->form_validation->set_rules('tanggal_berangkat', 'Tanggal Berangkat', 'required');
		// $this->form_validation->set_rules('waktu_berangkat', 'Waktu Berangkat', 'required');
		// $this->form_validation->set_rules('tanggal_pulang', 'Tanggal Pulang', 'required');
		// $this->form_validation->set_rules('nm_airline_pulang', 'Nama Airline Pulang', 'required');
		// $this->form_validation->set_rules('no_flight_pulang', 'No. Flight Pulang', 'required');
		// $this->form_validation->set_rules('waktu_pulang', 'Waktu Pulang', 'required');
		// $this->form_validation->set_rules('jenis_penerbangan', 'Jenis Penerbangan', 'required');
		// $this->form_validation->set_rules('bandara_tujuan_as', 'Bandara Tujuan Arab Saudi', 'required');

		if($this->form_validation->run() == TRUE){
			$this->insert_to_database();
		};

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest_tambah', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function insert_to_database(){

		$this->M_pramanifest->InsertPramanifest();
		redirect('Dashboard/pramanifest','refresh');
	}

	public function edit_pramanifest($id){
		$data['data_pramanifest'] = $this->M_pramanifest->GetPramanifestByID($id)->result();
		$data['data_pramanifest_detail'] = $this->M_pramanifest->GetPramanifestdetailByID($id)->result();
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

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest_edit', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_edit(){
		$result = $this->M_pramanifest->EditPramanifest();
		echo json_encode($result);
	}

	public function detail_edit_pramanifest(){
		$result = $this->M_pramanifest->GetDataPramanifestByPOST()->result();
		echo json_encode($result);
	}

	public function list_jamaah_pramanifest(){
		$result = $this->M_pramanifest->GetPramanifestdetail()->result();
		echo json_encode($result);
	}

	public function list_jamaah_pramanifest_byidpramanifest(){
		$result = $this->M_pramanifest->GetPramanifestdetailbyidpramanifest()->result();
		echo json_encode($result);
	}

	public function list_jamaah_pramanifest_lain(){
		$result = $this->M_pramanifest->GetPramanifestdetailbyexceptingidpramanifest()->result();
		echo json_encode($result);
	}

	public function delete_jamaah_unchecked(){
		$result = $this->M_pramanifest->DeleteJamaahList();
		echo json_encode($result);
	}

	public function delete_pramanifest(){
		$result = $this->M_pramanifest->DeletePramanifest();
		echo json_encode($result);
	}

	public function export(){
		$kd_pra_manifest = $this->input->get('pramanifest');
		$kd_paket = $this->input->get('paket');

		$data = $this->M_pramanifest->GetPramanifestByID($kd_pra_manifest)->result_array();
		$data_detail = $this->M_pramanifest->GetPramanifestdetailByID($kd_pra_manifest)->result();
		$paket = $this->M_paket->EksportPaket($kd_paket)->result_array();
		$pihk = $this->M_pramanifest->GetDataPIHK()->result_array();
		$pengurus = $this->M_pramanifest->GetPengurusFromPramanifestdetail($kd_pra_manifest)->result_array();
		$pembimbing = $this->M_pramanifest->GetPembimbingFromPramanifestdetail($kd_pra_manifest)->result_array();
		$kesehatan = $this->M_pramanifest->GetKesehatanFromPramanifestdetail($kd_pra_manifest)->result_array();

		if ($pengurus == NULL) {
			$pengurus[0]['nama_jamaah'] = '-';
			$pengurus[0]['nomor_hp'] = '-';
		}
		if ($pembimbing == NULL) {
			$pembimbing[0]['nama_jamaah'] = '-';
			$pembimbing[0]['nomor_hp'] = '-';
		}
		if ($kesehatan == NULL) {
			$kesehatan[0]['nama_jamaah'] = '-';
			$kesehatan[0]['nomor_hp'] = '-';
		}

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Pra_Manifest.xlsx'); 

		//Insert sheet paket
		$object->setActiveSheetIndex(0)
			->setCellValue('B5', $paket[0]['kode_tahun'].' H / '.date('Y').' M')
			->setCellValue('K3', $paket[0]['kd_pihk'])
			->setCellValue('D7', $data[0]['pihk'])
			->setCellValue('D8', $data[0]['no_sk'])
			->setCellValue('H8', $data[0]['habis_masa_berlaku'])
			->setCellValue('D9', $data[0]['alamat'])
			->setCellValue('D10', $data[0]['no_telp'])
			->setCellValue('D11', count($data_detail))
			->setCellValue('D12', date('d/m/Y', strtotime($data[0]['tanggal_berangkat'])))
			->setCellValue('D13', date('d/m/Y', strtotime($data[0]['tanggal_pulang_1'])))
			->setCellValue('D14', $data[0]['pimpinan'])
			->setCellValue('D15', $pengurus[0]['nama_jamaah'])
			->setCellValue('H15', $pengurus[0]['nomor_hp'])
			->setCellValue('D16', $pembimbing[0]['nama_jamaah'])
			->setCellValue('H16', $pembimbing[0]['nomor_hp'])
			->setCellValue('D17', $kesehatan[0]['nama_jamaah'])
			->setCellValue('H17', $kesehatan[0]['nomor_hp'])
			->setCellValue('D18', $data[0]['nm_airline_brkt'])
			->setCellValue('D22', $paket[0]['h_akomodasi_2'])
			->setCellValue('D23', $paket[0]['h_akomodasi_1'])
			->setCellValue('D26', $paket[0]['akomodasi_1'])
			->setCellValue('D27', $paket[0]['akomodasi_2'])
			->setCellValue('D28', $paket[0]['akomodasi_3'])
			->setCellValue('D29', $paket[0]['hotel_transit'])
			->setCellValue('D31', $paket[0]['komsumsi_1'])
			->setCellValue('D32', $paket[0]['komsumsi_2'])
			->setCellValue('D33', $paket[0]['komsumsi_4'])
			->setCellValue('D35', $paket[0]['transport'])
			->setCellValue('D37', Usd($paket[0]['harga_double']))
			->setCellValue('D38', Usd($paket[0]['harga_triple']))
			->setCellValue('D39', Usd($paket[0]['harga_quadra']));

		//Insert sheet pramanifest
		$count = 4;
		$jumlah_data_detail = count($data_detail);
		$no = 1;
		foreach ($data_detail as $data_detail) {

			if ($data[0]['tanggal_berangkat'] != NULL) {
				$tanggal_berangkat = date('d/m/Y', strtotime($data[0]['tanggal_berangkat']));
			}else{
				$tanggal_berangkat = '';
			}

			if ($data[0]['tanggal_pulang_1'] != NULL) {
				$tanggal_pulang_1 = date('d/m/Y', strtotime($data[0]['tanggal_pulang_1']));
			}else{
				$tanggal_pulang_1 = '';
			}

			if ($paket[0]['tgl_masuk_mekkah'] != NULL) {
				$tgl_masuk_mekkah = date('d/m/Y', strtotime($paket[0]['tgl_masuk_mekkah']));
			}else{
				$tgl_masuk_mekkah = '';
			}

			if ($paket[0]['tgl_keluar_mekkah'] != NULL) {
				$tgl_keluar_mekkah = date('d/m/Y', strtotime($paket[0]['tgl_keluar_mekkah']));
			}else{
				$tgl_keluar_mekkah = '';
			}

			if ($paket[0]['tgl_masuk_madinah'] != NULL) {
				$tgl_masuk_madinah = date('d/m/Y', strtotime($paket[0]['tgl_masuk_madinah']));
			}else{
				$tgl_masuk_madinah = '';
			}

			if ($paket[0]['tgl_keluar_madinah'] != NULL) {
				$tgl_keluar_madinah = date('d/m/Y', strtotime($paket[0]['tgl_keluar_madinah']));
			}else{
				$tgl_keluar_madinah = '';
			}

			if ($paket[0]['tgl_masuk_transit'] != NULL) {
				$tgl_masuk_transit = date('d/m/Y', strtotime($paket[0]['tgl_masuk_transit']));
			}else{
				$tgl_masuk_transit = '';
			}

			if ($paket[0]['tgl_keluar_transit'] != NULL) {
				$tgl_keluar_transit = date('d/m/Y', strtotime($paket[0]['tgl_keluar_transit']));
			}else{
				$tgl_keluar_transit = '';
			}

			if ($paket[0]['tgl_masuk_jeddah'] != NULL) {
				$tgl_masuk_jeddah = date('d/m/Y', strtotime($paket[0]['tgl_masuk_jeddah']));
			}else{
				$tgl_masuk_jeddah = '';
			}

			if ($paket[0]['tgl_keluar_jeddah'] != NULL) {
				$tgl_keluar_jeddah = date('d/m/Y', strtotime($paket[0]['tgl_keluar_jeddah']));
			}else{
				$tgl_keluar_jeddah = '';
			}
                          
			$object->setActiveSheetIndex(1)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data_detail->kd_porsi)
				->setCellValue('C'.$count, $data_detail->nama_jamaah)
				->setCellValue('D'.$count, $tanggal_berangkat)
				->setCellValue('E'.$count, $tanggal_pulang_1)
				->setCellValue('F'.$count, $data[0]['nm_airline_brkt'])
				->setCellValue('G'.$count, $data[0]['no_flight_brkt'])
				->setCellValue('H'.$count, $paket[0]['akomodasi_1'])
				->setCellValue('I'.$count, $tgl_masuk_mekkah)
				->setCellValue('J'.$count, $tgl_keluar_mekkah)
				->setCellValue('K'.$count, $paket[0]['akomodasi_2'])
				->setCellValue('L'.$count, $tgl_masuk_madinah)
				->setCellValue('M'.$count, $tgl_keluar_madinah)
				->setCellValue('N'.$count, $paket[0]['hotel_transit'])
				->setCellValue('O'.$count, $tgl_masuk_transit)
				->setCellValue('P'.$count, $tgl_keluar_transit)
				->setCellValue('Q'.$count, $paket[0]['akomodasi_3'])
				->setCellValue('R'.$count, $tgl_masuk_jeddah)
				->setCellValue('S'.$count, $tgl_keluar_jeddah)
				->setCellValue('T'.$count, $paket[0]['h_akomodasi_8'])
				->setCellValue('U'.$count, $paket[0]['h_akomodasi_8']);
			$count++;
			$no++;
		}


		header('Content-Disposition: attachment;filename="Pra Manifest - '.$paket[0]['kode_paket'].' - '.$data[0]['pemberangkatan_ke'].'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}

	public function export_all(){
		$data = $this->M_pramanifest->GetDataPramanifestForExport()->result();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Seluruh_Pramanifest.xlsx'); 

		//Insert sheet pramanifest
		$count = 3;
		$no = 1;
		foreach ($data as $data) {

			if ($data->tanggal_berangkat != NULL) {
				$tanggal_berangkat = date('d/m/Y', strtotime($data->tanggal_berangkat));
			}else{
				$tanggal_berangkat = '';
			}

			if ($data->tanggal_pulang_1 != NULL) {
				$tanggal_pulang_1 = date('d/m/Y', strtotime($data->tanggal_pulang_1));
			}else{
				$tanggal_pulang_1 = '';
			}

			if ($data->tanggal_pulang_2 != NULL) {
				$tanggal_pulang_2 = date('d/m/Y', strtotime($data->tanggal_pulang_2));
			}else{
				$tanggal_pulang_2 = '';
			}

			if ($data->tanggal_pulang_3 != NULL) {
				$tanggal_pulang_3 = date('d/m/Y', strtotime($data->tanggal_pulang_3));
			}else{
				$tanggal_pulang_3 = '';
			}
                          
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data->kd_pihk)
				->setCellValue('C'.$count, $data->pihk)
				->setCellValue('D'.$count, $data->kd_tahun)
				->setCellValue('E'.$count, $data->pemberangkatan_ke)
				->setCellValue('F'.$count, Msconfig_generator($data->bandara_brkt))
				->setCellValue('G'.$count, $data->nm_airline_brkt)
				->setCellValue('H'.$count, $data->no_flight_brkt)
				->setCellValue('I'.$count, $tanggal_berangkat)
				->setCellValue('J'.$count, $data->waktu_berangkat)
				->setCellValue('K'.$count, $data->jenis_penerbangan_brkt)
				->setCellValue('L'.$count, $data->bandara_transit_brkt)
				->setCellValue('M'.$count, $data->nm_airline_transit_brkt)
				->setCellValue('N'.$count, $data->no_flight_transit_brkt)
				->setCellValue('O'.$count, Msconfig_generator($data->bandara_tujuan_as))
				->setCellValue('P'.$count, Msconfig_generator($data->bandara_pulang))
				->setCellValue('Q'.$count, $data->nm_airline_pulang)
				->setCellValue('R'.$count, $data->no_flight_pulang)
				->setCellValue('S'.$count, $tanggal_pulang_1)
				->setCellValue('T'.$count, $tanggal_pulang_2)
				->setCellValue('U'.$count, $tanggal_pulang_3)
				->setCellValue('V'.$count, $data->waktu_pulang)
				->setCellValue('W'.$count, $data->jenis_penerbangan_pulang)
				->setCellValue('X'.$count, $data->bandara_transit_pulang)
				->setCellValue('Y'.$count, $data->nm_airline_transit_pulang)
				->setCellValue('Z'.$count, $data->no_flight_transit_pulang)
				->setCellValue('AA'.$count, Msconfig_generator($data->bandara_tujuan_pulang))
				->setCellValue('AB'.$count, $data->jumlah)
				;
			$count++;
			$no++;
		}


		header('Content-Disposition: attachment;filename="Pra Manifest PIHK - '.date("d/m/Y").'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}

	// public function import(){
	// 	$this->load->view('Dashboard/layout/template');
	// 	$this->load->view('Dashboard/pramanifest/v_pramanifest_upload');
	// }

	public function proses_import(){
		$config['upload_path']          = APPPATH.'upload';
        $config['allowed_types']        = 'xlsx|csv|xls';
        $config['max_size']             = 2048;
        $config['overwrite']            = TRUE;
        $config['file_name']			= 'Pramanifest_'.$this->session->userdata('kd_pihk');
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('Dashboard/pramanifest/v_pramanifest_upload', $error);
                echo $this->upload->display_errors();

        }
        else
        {
			$loadexcel = PHPExcel_IOFactory::load(APPPATH.'upload/Pramanifest_'.$this->session->userdata('kd_pihk').'.xls'); 

			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data['pramanifest'] = array(
				'kd_tahun' 			=> $loadexcel->getActiveSheet()->getCell('B2')->getValue(),
				'kd_pihk' 			=> $loadexcel->getActiveSheet()->getCell('B3')->getValue(),
				'kd_paket' 			=> $loadexcel->getActiveSheet()->getCell('B4')->getValue(),
				'pemberangkatan_ke' => $loadexcel->getActiveSheet()->getCell('B5')->getValue(),
				'bandara_brkt' 		=> $loadexcel->getActiveSheet()->getCell('B6')->getValue(),
				'nm_airline_brkt' 	=> $loadexcel->getActiveSheet()->getCell('B7')->getValue(),
				'no_flight_brkt' 	=> $loadexcel->getActiveSheet()->getCell('B8')->getValue(),
				'tanggal_berangkat' => $loadexcel->getActiveSheet()->getCell('B9')->getValue(),
				'waktu_berangkat' 	=> $loadexcel->getActiveSheet()->getCell('B10')->getValue(),
				'jenis_penerbangan' => $loadexcel->getActiveSheet()->getCell('B11')->getValue(),
				'bandara_transit' 	=> $loadexcel->getActiveSheet()->getCell('B12')->getValue(),
				'nm_airline_transit'=> $loadexcel->getActiveSheet()->getCell('B13')->getValue(),
				'no_flight_transit' => $loadexcel->getActiveSheet()->getCell('B14')->getValue(),
				'nm_airline_pulang' => $loadexcel->getActiveSheet()->getCell('B15')->getValue(),
				'no_flight_pulang' 	=> $loadexcel->getActiveSheet()->getCell('B16')->getValue(),
				'tanggal_pulang' 	=> $loadexcel->getActiveSheet()->getCell('B17')->getValue(),
				'waktu_pulang' 		=> $loadexcel->getActiveSheet()->getCell('B18')->getValue(),
				'bandara_tujuan_as' => $loadexcel->getActiveSheet()->getCell('B19')->getValue()
			);     

			for ($i=23; $loadexcel->getActiveSheet()->getCell('A'.$i)->getValue() != NULL ; $i++) { 
				$data['list_jamaah'][] = array(
				'kd_porsi' => $loadexcel->getActiveSheet()->getCell('A'.$i)->getValue(),
				'nama_jamaah' => $loadexcel->getActiveSheet()->getCell('B'.$i)->getValue(),
				'jenis_jamaah' => $loadexcel->getActiveSheet()->getCell('C'.$i)->getValue(),
			); 
			}
			
			$this->M_pramanifest->upload_file_to_database($data);
			$this->load->view('Dashboard/layout/template');
            $this->load->view('Dashboard/pramanifest/v_pramanifest_sukses');
        }
	}

	public function download_template(){
		$data = file_get_contents(APPPATH.'upload/Template_Upload_Pramanifest.xls');
		force_download('Template_Upload_Pramanifest.xls', $data);
	}

	public function get_kode_airline(){
		$result = $this->M_pramanifest->GetKodeAirline()->result();
		echo json_encode($result);
	}

	public function get_available_paket_and_keberangkatan(){
		$result = $this->M_pramanifest->GetDataPaketAndKeberangkatan()->result();
		echo json_encode($result);
	}

	public function get_list_pemberangkatan_ke(){
		$result = $this->M_msconfig->GetDataMsconfig('pemberangkatan_ke')->result();
		echo json_encode($result);
	}
}

		


		
