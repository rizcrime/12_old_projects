<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_user');
	}

	public function index()
	{

	}

	public function ubah_password(){
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required');
		$this->form_validation->set_rules('konfirmasi_password_baru', 'Konfirmasi Password Baru', 'required');
		$this->form_validation->set_rules('konfirmasi_password_baru', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		if($this->form_validation->run() == TRUE){
			$this->proses_ubah_password();
		};
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/user/v_user_ubah_password');
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_ubah_password(){
		$this->M_user->UbahPassword();
		session_destroy();
		redirect('Dashboard/login');	
	}

	public function edit_profile(){
		$data['data_pihk'] = $this->M_user->EditProfile();

		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/user/v_user_edit_profile', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function proses_edit_profile(){
		$this->M_user->ProsesEditProfile();
		redirect('Dashboard/Home','refresh');
	}


	
}

		


		
