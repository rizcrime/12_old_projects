<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_password extends AUTHBIDDER_Free_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_bidder');
	}

	public function index() {
		$data['userdata'] 			= $this->userdata;
		
		$data['page'] 			= "ubah_password";
		$data['judul'] 			= "Ubah Password";
		$data['deskripsi'] 		= "Manage PAssword";
		$this->load->view('ubah_password', $data);
	}

	public function prosesUbahPass() {
		$this->form_validation->set_rules('PASSWORD_LAMA', 'Password Lama', 'required');
		$this->form_validation->set_rules('PASSWORD_ULANG', 'Password', 'required');
		$this->form_validation->set_rules('PASSWORD', 'Password', 'required');
		
		$data = $this->input->post();
		$data['userdata'] = $this->userdata;
		
		$email_perusaahaan = $this->userdata->EMAIL_PERUSAHAAN;
		$password = md5($data['PASSWORD_LAMA']);
		$password_ulang = $data['PASSWORD_ULANG'];
		$password_baru = $data['PASSWORD'];
		
		// var_dump($username,$password);die();
		
		$check_password = $this->M_bidder->check_password_ubah($email_perusaahaan);
		// var_dump($check_password,$password);die();
		if ($this->form_validation->run() == TRUE) {
			// var_dump($check_password,$password);die();
			if($check_password->PASSWORD == $password){
				if($password_ulang == $password_baru){
					// var_dump($this->session->userdata());die();
					$result = $this->M_bidder->ubah_password($email_perusaahaan, $data);
					// var_dump($result);die();
					$data['userdata']->IS_PASSWORD_DEFAULT = "Y";
					$session = [
						'userdata' => $data['userdata'],
					];
					$this->session->set_userdata($session);
					$this->session->set_flashdata('msg', 'Berhasil Ubah Password');
					// echo "<script>alert('Sukses!');</script>";
					redirect('Home_perusahaan');
				} else {
					$this->session->set_flashdata('msg', 'Password yang anda masukkan tidak sesuai.');
					redirect('Ubah_password');
				}
				
			} else{
				echo "<script>alert('Password Salah!');</script>";
				$this->session->set_flashdata('msg', 'Password Salah!');
				redirect('Ubah_password');
			}
			
		} else {
			$this->session->set_flashdata('msg', 'Gagal ubah password');
			redirect('Ubah_password');
		}
	}
}