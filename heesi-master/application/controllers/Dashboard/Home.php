<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/Login');
        }
		$this->load->model('Dashboard/M_home');
		// $this->load->model('Dashboard/M_aktual');
	}

	public function index()
	{
		$this->load->view('Dashboard/layout/template');
		// echo var_dump($this->session->userdata('kd_pihk'));die();
		$session = $this->session->userdata('kd_pihk');
		if ($session == 'monitoring' || $session == 'admin' || $session == 'super_monitoring') {
			$data['pihk'] = $this->M_home->GetAllPIHK()->result();
			$this->load->view('Dashboard/dashboard_monitoring', $data);
		}else{
			$this->load->view('Dashboard/dashboard_pihk');
		}
		
		$this->load->view('Dashboard/layout/footer');
	}

	public function getBerangkat()
	{
		$list = $this->M_home->GetBerangkatLimit();
        $data = array();
        foreach ($list as $field) {
        	if ($field->posisi_sekarang == 'KEBERANGKATAN_TANAH_AIR') {
	        	$posisi = 'Berangkat Tanah Air';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MEKKAH'){
	            $posisi = 'Mekkah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MADINAH'){
	            $posisi = 'Madinah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_JEDDAH'){
	            $posisi = 'Jeddah';
	          }elseif($field->posisi_sekarang == 'TARWIYAH'){
	            $posisi = 'Tarwiyah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_ARAFAH'){
	            $posisi = 'Kedatangan Arafah';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_MINA'){
	            $posisi = 'Kepulangan Mina';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_ARAB_SAUDI'){
	            $posisi = 'Pulang Arab Saudi';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_TANAH_AIR'){
	            $posisi = 'Kembali Ke Tanah Air';
	          }elseif($field->posisi_sekarang == 'HOTEL_TRANSIT_MEKKAH'){
	            $posisi = 'Hotel Transit';
	        }
	          
            $row = array();
            $row[] = $field->kd_pihk;
            $row[] = $field->pihk;
            $row[] = $field->kode_paket;
            $row[] = $field->nama_paket;
            $row[] = $field->pemberangkatan_ke;
            $row[] = '<a href="#" onclick="showDetail('.$field->kd_aktual.');">'.$field->jumlah.'</a>';
            $row[] = $posisi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_home->GetBerangkatCountAll(),
            "recordsFiltered" => $this->M_home->GetBerangkatCountFiltered(),
            "data" => $data,
        );

        echo json_encode($output);
	}

	public function getPosisiJamaah()
	{
		$list = $this->M_home->GetPosisiJamaahLimit();
        $data = array();
        foreach ($list as $field) {
        	if ($field->posisi_sekarang == 'KEBERANGKATAN_TANAH_AIR') {
	        	$posisi = 'Berangkat Tanah Air';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MEKKAH'){
	            $posisi = 'Mekkah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MADINAH'){
	            $posisi = 'Madinah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_JEDDAH'){
	            $posisi = 'Jeddah';
	          }elseif($field->posisi_sekarang == 'TARWIYAH'){
	            $posisi = 'Tarwiyah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_ARAFAH'){
	            $posisi = 'Kedatangan Arafah';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_MINA'){
	            $posisi = 'Kepulangan Mina';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_ARAB_SAUDI'){
	            $posisi = 'Pulang Arab Saudi';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_TANAH_AIR'){
	            $posisi = 'Kembali Ke Tanah Air';
	          }elseif($field->posisi_sekarang == 'HOTEL_TRANSIT_MEKKAH'){
	            $posisi = 'Hotel Transit';
	        }
	          
            $row = array();
            $row[] = $field->kd_porsi;
            $row[] = $field->nama_jamaah;
            $row[] = $field->jenis_jamaah;
            $row[] = $field->nomor_hp;
            $row[] = $posisi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_home->GetPosisiJamaahCountAll(),
            "recordsFiltered" => $this->M_home->GetPosisiJamaahCountFiltered(),
            "data" => $data,
        );
        
        //output dalam format JSON
        echo json_encode($output);

		// $getPosisiJamaah = $this->M_home->GetPosisiJamaah()->result();
		// echo json_encode($getPosisiJamaah);
	}

	public function countBerangkatTanahAir()
	{
		$tanah_air = $this->M_home->GetJamaahBerangkatTanahAir()->result();
		echo json_encode($tanah_air);
	}

	public function countMekkah()
	{
		$mekkah = $this->M_home->GetJamaahMekkah()->result();
		echo json_encode($mekkah);
	}

	public function countMadinah()
	{
		$madinah = $this->M_home->GetJamaahMadinah()->result();
		echo json_encode($madinah);
	}

	public function countJeddah()
	{
		$jeddah = $this->M_home->GetJamaahJeddah()->result();
		echo json_encode($jeddah);
	}

	public function countTarwiyah()
	{
		$tarwiyah = $this->M_home->GetJamaahTarwiyah()->result();
		echo json_encode($tarwiyah);
	}

	public function countArafah()
	{
		$arafah = $this->M_home->GetJamaahArafah()->result();
		echo json_encode($arafah);
	}

	public function countMina()
	{
		$mina = $this->M_home->GetJamaahMina()->result();
		echo json_encode($mina);
	}

	public function countPulangas()
	{
		$pulangas = $this->M_home->GetJamaahPulangas()->result();
		echo json_encode($pulangas);
	}

	public function countPulang()
	{
		$pulang = $this->M_home->GetJamaahPulang()->result();
		echo json_encode($pulang);
	}

	public function countTransit()
	{
		$transit = $this->M_home->GetJamaahHotelTransit()->result();
		echo json_encode($transit);
	}

	public function countBerangkat()
	{
		$berangkat = $this->M_home->GetJamaahBerangkat()->result();
		echo json_encode($berangkat);
	}

	public function countBelumBerangkat()
	{
		$belum_berangkat = $this->M_home->GetJamaahBelumBerangkat()->result();
		echo json_encode($belum_berangkat);
	}

	public function countSakit()
	{
		$sakit = $this->M_home->GetJamaahSakit()->result();
		echo json_encode($sakit);
	}

	public function countWafat()
	{
		$file = "http://10.100.88.123:8095/ws/wft_haji_khusus?tahun=".Hijriah()."";
		$konten = file_get_contents($file);
		$wafat = json_decode($konten);
		
		// $wafat = $this->M_home->GetJamaahWafat()->result();
		echo json_encode($wafat);
	}

	public function profilPIHK()
	{
		$profil = $this->M_home->GetDataPIHK()->result();
		echo json_encode($profil);
	}

	public function download_android_apk(){
		$data = file_get_contents(APPPATH.'upload/SIPATUH_Haji_Khusus.apk');
		force_download('SIPATUH_Haji_Khusus.apk', $data);
	}

	public function download_manual_book_web(){
		$data = file_get_contents(APPPATH.'upload/MANUAL_HAJI_KHUSUS_WEB.pdf');
		force_download('MANUAL_HAJI_KHUSUS_WEB.pdf', $data);
	}

	public function download_manual_book_android(){
		$data = file_get_contents(APPPATH.'upload/MANUAL_HAJI_KHUSUS_ANDROID.pdf');
		force_download('MANUAL_HAJI_KHUSUS_ANDROID.pdf', $data);
	}

	public function export_excel_posisi_jamaah(){
		$data = $this->M_home->GetAllPosisiJamaah()->result();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Posisi_Jamaah.xlsx'); 

		//Insert sheet pramanifest
		$count = 2;
		$no = 1;

		//Insert border
		$styleArray = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		foreach ($data as $data) {
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, date('d-m-Y', strtotime($data->tgl_aktual)))
				->setCellValue('C'.$count, $data->kd_porsi)
				->setCellValue('D'.$count, $data->nama_jamaah)
				->setCellValue('E'.$count, $data->jenis_jamaah)
				->setCellValue('F'.$count, $data->kd_pihk)
				->setCellValue('G'.$count, $data->pihk)
				->setCellValue('H'.$count, Posisi($data->jenis));
			$object->getActiveSheet()->getStyle('A'.$count.':H'.$count.'')->applyFromArray($styleArray);
			header('Content-Disposition: attachment;filename="Daftar Jamaah '.$data->pihk.' '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
			$count++;
			$no++;
		}


		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}

	public function export_excel_jamaah_berangkat(){
		$data = $this->M_home->GetAllJamaahBerangkat()->result();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Keberangkatan.xlsx'); 

		//Insert sheet pramanifest
		$count = 2;
		$no = 1;

		//Insert border
		$styleArray = array(
		  'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		  )
		);

		foreach ($data as $data) {
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, date('d-m-Y', strtotime($data->tgl_aktual)))
				->setCellValue('C'.$count, $data->kd_porsi)
				->setCellValue('D'.$count, $data->nama_jamaah)
				->setCellValue('E'.$count, $data->jenis_jamaah)
				->setCellValue('F'.$count, $data->kd_pihk)
				->setCellValue('G'.$count, $data->pihk)
				->setCellValue('H'.$count, 'Berangkat');
			$object->getActiveSheet()->getStyle('A'.$count.':H'.$count.'')->applyFromArray($styleArray);
			$count++;
			$no++;
		}


		header('Content-Disposition: attachment;filename="Daftar Jamaah Berangkat Per '.date("d-m-Y").'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}

	public function getDetailJemaah()
	{
		$getDetailJemaah = $this->M_home->getDetailJemaah()->result();
		echo json_encode($getDetailJemaah);
	}

	public function getTibaMadinah()
	{
		$getTibaMadinah = $this->M_home->getTibaMadinah()->result();
		echo json_encode($getTibaMadinah);
	}

	public function getTibaJeddah()
	{
		$getTibaJeddah = $this->M_home->getTibaJeddah()->result();
		echo json_encode($getTibaJeddah);
	}

	public function getDetailJemaahWafat()
	{
		$file = "http://10.100.88.123:8095/ws/wft_haji_khusus?tahun=".Hijriah()."";
		$konten = file_get_contents($file);
		$getDetailJemaahWafat = json_decode($konten);

		// $getDetailJemaahWafat = $this->M_home->getDetailJemaahWafat()->result();
		echo json_encode($getDetailJemaahWafat);
	}

}
