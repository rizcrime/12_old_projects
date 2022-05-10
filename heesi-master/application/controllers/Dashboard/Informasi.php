<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_pramanifest');
		$this->load->model('Dashboard/M_informasi');
		$this->load->model('Dashboard/M_msconfig');
		$this->load->model('Dashboard/M_paket');
	}

	public function index()
	{
		$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktual();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function tanggal_berangkat()
	{
		$data['jenis'] = $this->M_msconfig->GetDataMsconfig('jenis_paket')->result();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/informasi/v_tanggal_berangkat', $data);
		$this->load->view('Dashboard/layout/footer');
	}
	public function tampilallberangkat($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		$this->load->view('Dashboard/informasi/v_data_filter_berangkat', $data);
	}

	public function tampilallberangkatforcountjemaah($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$countjemaah = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$countjemaah = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		echo json_encode($countjemaah);
	}

	public function tampilallberangkatforexport($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$data = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$data = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		
		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Keberangkatan_Per_Tanggal.xlsx'); 

		$count = 3;
		$no = 1;
		// echo var_dump($data[0]['pihk']);die();
		for ($i=0; $i < count($data); $i++) { 
			// echo var_dump($data[$i]);die();
			if ($data[$i]['jumlah_aktual'] > 0) {
				$status = "Berangkat";
			}else{
				$status = "Belum Berangkat";
			} 
		//Insert sheet paket
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data[$i]['pihk'])
				->setCellValue('C'.$count, date("d-m-Y",strtotime($data[$i]['tanggal_berangkat'])))
				->setCellValue('D'.$count, $data[$i]['bandara_brkt'])
				->setCellValue('E'.$count, $data[$i]['waktu_berangkat'])
				->setCellValue('F'.$count, $data[$i]['no_flight_brkt'])
				->setCellValue('H'.$count, $data[$i]['bandara_tujuan_as'])
				->setCellValue('J'.$count, $data[$i]['akomodasi_1'])
				->setCellValue('K'.$count, $data[$i]['akomodasi_2'])
				->setCellValue('L'.$count, $data[$i]['hotel_transit'])
				->setCellValue('M'.$count, $data[$i]['jumlah'])
				->setCellValue('N'.$count, $status);
				$count++;
				$no++;
		}

		if ($tgl == 0) {
			header('Content-Disposition: attachment;filename="Data Seluruh Keberangkatan Per Tanggal '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		}else{
			header('Content-Disposition: attachment;filename="Data Keberangkatan Tanggal - '.date("d-m-Y",strtotime($tgl)).'.xls";Content-Type: application/vnd.ms-excel');
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$object_writer->save('php://output');
	}

	public function tampilallpulang($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		$this->load->view('Dashboard/informasi/v_data_filter_pulang', $data);
	}

	public function tampilallpulangforcountjemaah($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$countjemaah = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$countjemaah = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		echo json_encode($countjemaah);
	}

	public function tampilallpulangforexport($filter='',$tgl=0)
	{
		if ($filter == 'all') {
			$data = $this->M_pramanifest->GetDataPramanifestForFilterData();
		}else{
			$tanggal = date("Y-m-d",strtotime($tgl));
			$data = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal);	
		}
		
		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Kepulangan_Per_Tanggal.xlsx'); 

		$count = 3;
		$no = 1;
		// echo var_dump($data);die();
		for ($i=0; $i < count($data); $i++) { 
			// echo var_dump($data[$i]);die();
			if ($data[$i]['jumlah_aktual'] > 0) {
				$status = "Berangkat";
			}else{
				$status = "Belum Berangkat";
			} 
		//Insert sheet paket
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data[$i]['pihk'])
				->setCellValue('C'.$count, date("d-m-Y",strtotime($data[$i]['tanggal_pulang_1'])))
				->setCellValue('D'.$count, $data[$i]['bandara_pulang'])
				->setCellValue('E'.$count, $data[$i]['waktu_pulang'])
				->setCellValue('F'.$count, $data[$i]['no_flight_pulang'])
				->setCellValue('H'.$count, $data[$i]['bandara_tujuan_pulang'])
				->setCellValue('J'.$count, $data[$i]['jumlah']);
				$count++;
				$no++;
		}

		if ($tgl == 0) {
			header('Content-Disposition: attachment;filename="Data Seluruh Kepulangan Per Tanggal '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		}else{
			header('Content-Disposition: attachment;filename="Data Kepulangan Tanggal - '.date("d-m-Y",strtotime($tgl)).'.xls";Content-Type: application/vnd.ms-excel');
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$object_writer->save('php://output');
	}

	public function tampilalljenispaket($filter='',$jenis_paket='')
	{
		if ($filter == 'all') {
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndPaket();
		}else{
			$data['data_pramanifest'] = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByJenisPaket($filter, $jenis_paket);	
		}
		$this->load->view('Dashboard/informasi/v_data_filter_jenis_paket', $data);
	}

	public function tampilalljenispaketforcountjemaah($filter='',$jenis_paket='')
	{
		if ($filter == 'all') {
			$countjemaah = $this->M_pramanifest->GetDataPramanifestAndPaket();
		}else{
			$countjemaah = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByJenisPaket($filter, $jenis_paket);	
		}
		echo json_encode($countjemaah);
	}

	public function tampilalljenispaketforexport($filter='',$jenis_paket='')
	{
		if ($filter == 'all') {
			$data = $this->M_pramanifest->GetDataPramanifestAndPaket();
		}else{
			$data = $this->M_pramanifest->GetDataPramanifestAndJumlahAktualByJenisPaket($filter, $jenis_paket);	
		}
		
		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Jenis_Paket_Per_Tanggal.xlsx'); 

		$count = 3;
		$no = 1;
		// echo var_dump($jenis_paket);die();
		for ($i=0; $i < count($data); $i++) { 
		//Insert sheet paket
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data[$i]['kd_pihk'])
				->setCellValue('C'.$count, $data[$i]['pihk'])
				->setCellValue('D'.$count, $data[$i]['kd_paket'])
				->setCellValue('E'.$count, $data[$i]['kd_tahun'])
				->setCellValue('F'.$count, $data[$i]['pemberangkatan_ke'])
				->setCellValue('G'.$count, $data[$i]['jenis_paket'])
				->setCellValue('H'.$count, $data[$i]['jumlah']);
				$count++;
				$no++;
		}

		if ($jenis_paket == '0') {
			header('Content-Disposition: attachment;filename="Data Seluruh Jenis Paket Per Tanggal '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		}elseif ($jenis_paket == 'Arbain'){
			header('Content-Disposition: attachment;filename="Data Paket Arbain.xls";Content-Type: application/vnd.ms-excel');
		}else{
			header('Content-Disposition: attachment;filename="Data Paket Non-Arbain.xls";Content-Type: application/vnd.ms-excel');
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$object_writer->save('php://output');
	}

	public function tampilallpihkperdaker($filter='',$jenis='')
	{
		if ($filter == 'all') {
			$data['data_pramanifest'] = $this->M_pramanifest->GetPIHKPerDaker();
		}else{
			$data['data_pramanifest'] = $this->M_pramanifest->GetPIHKPerDakerByDaker($filter, $jenis);	
		}
		$this->load->view('Dashboard/informasi/v_data_filter_pihk_per_daker', $data);
	}

	public function tampilallpihkperdakerforcountpihk($filter='',$jenis='')
	{
		if ($filter == 'all') {
			$countjemaah = $this->M_pramanifest->GetPIHKPerDaker();
		}else{
			$countjemaah = $this->M_pramanifest->GetPIHKPerDakerByDaker($filter, $jenis);	
		}
		echo json_encode($countjemaah);
	}

	public function tampilallpihkperdakerforexport($filter='',$jenis='')
	{
		if ($filter == 'all') {
			$data = $this->M_pramanifest->GetPIHKPerDaker();
		}else{
			$data = $this->M_pramanifest->GetPIHKPerDakerByDaker($filter, $jenis);	
		}
		
		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_PIHK_Per_Daker.xlsx'); 

		$count = 3;
		$no = 1;
		// echo var_dump($jenis_paket);die();
		foreach ($data as $data) {
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data->kd_pihk)
				->setCellValue('C'.$count, $data->pihk)
				->setCellValue('D'.$count, $data->jumlah_jemaah);
				$count++;
				$no++;
		}

		if ($jenis == '0') {
			header('Content-Disposition: attachment;filename="Data PIHK Di Seluruh Daker Per Tanggal '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		}else{
			if ($jenis == 'KEBERANGKATAN_TANAH_AIR') {
				$print = 'Berangkat Tanah Air';
			}elseif ($jenis == 'KEDATANGAN_MEKKAH') {
				$print = 'Mekkah';
			}elseif ($jenis == 'KEDATANGAN_MADINAH') {
				$print = 'Madinah';
			}elseif ($jenis == 'KEDATANGAN_JEDDAH') {
				$print = 'Jeddah';
			}elseif ($jenis == 'TARWIYAH') {
				$print = 'Tarwiyah';
			}elseif ($jenis == 'KEDATANGAN_ARAFAH') {
				$print = 'Kedatangan Arafah';
			}elseif ($jenis == 'KEPULANGAN_MINA') {
				$print = 'Kepulangan Mina';
			}elseif ($jenis == 'KEPULANGAN_ARAB_SAUDI') {
				$print = 'Kepulangan dari Arab Saudi';
			}elseif ($jenis == 'KEDATANGAN_TANAH_AIR') {
				$print = 'Kembali Ke Tanah Air';
			}
			header('Content-Disposition: attachment;filename="Data PIHK '.$print.' Per Tanggal '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		$object_writer->save('php://output');
	}

	public function detail_pramanifest($id){
		$data['data_pramanifest'] = $this->M_pramanifest->GetPramanifestByID($id)->result();
		$data['data_pramanifest_detail'] = $this->M_pramanifest->GetPramanifestdetailByID($id)->result();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pramanifest/v_pramanifest_detail', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function getDetailJemaah()
	{
		$getDetailJemaah = $this->M_informasi->getDetailJemaah()->result();
		echo json_encode($getDetailJemaah);
	}

	public function export(){
		$kd_pra_manifest = $this->input->get('pramanifest');
		$kd_paket = $this->input->get('paket');

		$data = $this->M_pramanifest->GetPramanifestByID($kd_pra_manifest)->result_array();

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


		header('Content-Disposition: attachment;filename="Pra Manifest - '.$paket[0]['kode_paket'].' - '.$data[0]['pemberangkatan_ke'].'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}
}

		


		
