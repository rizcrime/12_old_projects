<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pramanifest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/m_aktual');
	}

	public function index()
	{
	}

}

		


		
