<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pihk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_pihk');
	}

	public function index()
	{
		$data['data_user'] = $this->M_pihk->GetDataPihk();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pihk/v_pihk', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function export()
	{
		$data = $this->M_pihk->GetDataPihk();

		$object = new PHPExcel();
		$object = PHPExcel_IOFactory::load(APPPATH.'upload/Template_Seluruh_PIHK.xlsx'); 

		//Insert sheet pramanifest
		$count = 2;
		$no = 1;
		for ($i=0; $i < count($data); $i++) {      
			$object->setActiveSheetIndex(0)
				->setCellValue('A'.$count, $no)
				->setCellValue('B'.$count, $data[$i]['kd_pihk'])
				->setCellValue('C'.$count, $data[$i]['pihk'])
				->setCellValue('D'.$count, $data[$i]['jumlah_paket'])
				->setCellValue('E'.$count, $data[$i]['jumlah_pramanifest'])
				;
			$count++;
			$no++;
		}

		header('Content-Disposition: attachment;filename="PIHK - '.date("d/m/Y").'.xls";Content-Type: application/vnd.ms-excel');
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// header('Content-Type: application/vnd.ms-excel');
		$object_writer->save('php://output');
	}

	public function non_aktif($kd_pihk){
		$this->M_pihk->non_active($kd_pihk);

		redirect('Dashboard/Pihk','refresh');
	}

	public function aktif($kd_pihk){
		$password = PasswordGenerator();
		$data['data_user'] = $this->M_pihk->activate($kd_pihk, $password);

        // Load library email dan konfigurasinya
        $this->load->library('email');

        // Email dan nama pengirim
        $this->email->from('no-reply@kemenag.go.id', 'Kementrian Agama Republik Indonesia');

        // Email penerima
        $this->email->to($data['data_user'][0]['email']); // Ganti dengan email tujuan kamu

        // Subject email
        $this->email->subject('Informasi Akun SIPATUH Haji Khusus');

        // Isi email
        $this->email->message("Kepada Yth.<br><b>".$data['data_user'][0]['pihk']."</b><br><br>Dengan Hormat,<br><br> Dibawah ini kami sampaikan informasi akun anda. Silahkan login menggunakan akun dibawah ini :<br><br>Username : <b>PIHK".$data['data_user'][0]['kd_pihk']."</b><br>Password : <b>".$password."</b><br><br>Password diatas merupakan password default. Harap segera ubah password anda pada menu Ubah Password.<br><br> Terima Kasih.");
        
        $this->email->send();

		redirect('Dashboard/Pihk','refresh');
	}

	public function edit_pihk($kd_pihk){
		$data['data_pihk'] = $this->M_pihk->GetDataPihkByKode($kd_pihk)->result();

		$this->form_validation->set_rules('email', 'Email', 'required');

		if($this->form_validation->run() == TRUE){
			$this->proses_edit();
		};

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pihk/v_pihk_edit', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_edit(){
		$this->M_pihk->EditPihk();
		redirect('Dashboard/Pihk','refresh');
	}

	
}

		


		
