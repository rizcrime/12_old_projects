<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_pelunasan');
	}

	public function index()
	{
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/pelunasan/v_pelunasan');
		$this->load->view('Dashboard/layout/footer');
	}

	public function getLunas(){
		$result = $this->M_pelunasan->ListJamaahLunas();
		echo json_encode($result);
	}

	public function getBerhakLunas(){
		$result = $this->M_pelunasan->ListJamaahBerhakLunas();
		echo json_encode($result);
	}

	public function getSeluruhJamaah(){
		$result = $this->M_pelunasan->ListSeluruhJamaah();
		echo json_encode($result);
	}

}
