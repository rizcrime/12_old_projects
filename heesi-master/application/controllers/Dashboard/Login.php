<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/M_login');
	}

	public function index()
	{
		$this->load->view('Dashboard/login/v_login');
	}

	public function prosesLogin()
	{
		$check = $this->M_login->CheckLogin();
		if ($check->num_rows() > 0) {
			$data = $check->row_array();
			$this->session->set_userdata('kd_pihk', $data['kd_pihk']);
			$this->session->set_userdata('username', $data['username']);
			redirect('Dashboard/Home');
		} else {
			redirect('Dashboard/login');
		}
		
	}

	public function logout()
	{
		session_destroy();
		redirect('Dashboard/login');
	}

}

		


		
