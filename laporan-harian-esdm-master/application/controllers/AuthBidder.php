<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthBidder extends CI_Controller {
	public function __construct() {
		parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_authbidder');
		$this->load->model('M_bidder');
		$this->load->model('M_register');
		$this->load->library(array('form_validation', 'Recaptcha'));
	}
	
	public function login() {
		$this->form_validation->set_rules('EMAIL_PERUSAHAAN', 'EMAIL PERUSAHAAN', 'required|min_length[4]|max_length[50]');
		$this->form_validation->set_rules('PASSWORD', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$out['status'] = '';
			$out['msg'] = err_capca('Captcha harus diisi!', '20px');
			echo json_encode($out);
			return;
		}
		
		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['EMAIL_PERUSAHAAN']);
			$password = trim($_POST['PASSWORD']);

			$is_password = $this->M_bidder->check_password($username);

			// var_dump($is_password); die();
			$data = $this->M_authbidder->login($username, $password);
			
			// if (!isset($response['success']) || $response['success'] <> true) {
			// 	// $this->session->set_flashdata('error_msg', 'Email / Password Anda Salah.');
			// 	$out['status'] = '';
			// 	$out['msg'] = err_capca('Captcha harus diisi!', '20px');
			// } else
			if ($data === FALSE){
				// $this->session->set_flashdata('error_msg', 'Captcha harus diisi!');
				$out['status'] = '';
				$out['msg'] = err_capca('Email / Password Anda Salah.', '20px');
			} else {
				// var_dump($is_password->IS_PASSWORD_DEFAULT);
				$tgl_login = date("Y-m-d H:i:s");
				$data->TGL_LOGIN = $tgl_login;

				$res_set_tgl = $this->M_authbidder->set_tgl_login($tgl_login, $data->ID_PERUSAHAAN);

				if ($is_password->IS_PASSWORD_DEFAULT == "") {
					if($this->M_register->isExpiredFirstPassword($data->TGL_DAFTAR)) {
						$this->M_register->delete($data->ID_PERUSAHAAN);
						$out['status'] = '';
						$out['msg'] = err_capca('Password sementara anda kedaluwarsa, silakan melakukan daftar ulang lagi.', '20px');
						echo json_encode($out);

						return;
					}

					$out['status'] = 'is_password';
					$session = [
						'userdata' => $data,
						'status' => "INVESTOR"
					];
					$this->session->set_userdata($session);
					// redirect('Ubah_password');
				} else {
					$session = [
						'userdata' => $data,
						'status' => "INVESTOR"
					];
					$this->session->set_userdata($session);

					// $dokumen= $data['IS_DOKUMEN_KOMPLIT'];
					// $is_dok = $this->M_bidder->check_dok($dokumen);

					$out['status'] = 'login';
				}
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			$out['status'] = 'form';
			$out['msg'] = err_capca(validation_errors());
		} 
		echo json_encode($out);
	}

	// private function isExpiredFirstPassword($data) {
	// 	// date_default_timezone_set("Asia/Jakarta");
	// 	$tgl_daftar = $data->TGL_DAFTAR;
	// 	$tgl_daftar = new DateTime($tgl_daftar);

	// 	$now_date = date('Y-m-d H:i:s');
	// 	$now_date = new DateTime($now_date);

	// 	$diff = $now_date->diff($tgl_daftar);

	// 	return ($diff->days >= 1);
	// 	// $diff_total_h = $diff->h;
	// 	// $diff_total_h = $diff_total_h + ($diff->days * 24);

	// 	// var_dump($diff);
	// 	// vdd($diff_total_h);

		
	// // 	$created = $row->created;  
	// // 	$createdTS = new DateTime($created);  

	// //    date_default_timezone_set("Asia/Bangkok");
	// //    $date = date('Y-m-d H:i:s');
	// // 	$todayTS = new DateTime($date);  
	// // 	$diff = $todayTS->diff($createdTS);
	// //    $hours = $diff->h;
	// //    $hours = $hours + ($diff->days*24);

	// 	// $second_between = ;
	// }

	public function ubahPassword () {
		$data['page'] 		= "ubahpassword";
		$data['userdata'] 	= $this->userdata;
		// var_dump($data['userdata']);die();
		$this->load->view('ubah_password', $data);
	}


	public function logout() {
		$this->session->sess_destroy();
		redirect('Beranda');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */