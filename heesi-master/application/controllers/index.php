<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
	}

	public function index()
	{
		redirect('Dashboard/Home');
	}
}

		


		
