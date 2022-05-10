<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthAdmin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		check_maintenance();
		$this->load->model('M_authadmin');
		$this->load->library(array('form_validation', 'Recaptcha'));
	}
	
	public function index() {
		$data = array(
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
		$session = $this->session->userdata('status');

		$is_double_login = $this->session->flashdata('double_session');
		if(!is_null($is_double_login)) {
			$this->session->set_flashdata('error_msg', 'Anda telah login di tempat lain, session anda sekarang dihentikan. Apabila yang login di session lain bukan Anda, segera hubungi Administrator.');
			$this->session->sess_destroy();
			$this->load->view('Admin/login', $data);
			return;			
		}
		
		$data['modal_lupa_admin'] = show_my_modal('modal_lupa_admin', 'form-lupa-admin', $data);
		
		if ($session == '') {
			$this->load->view('Admin/login', $data);
		} else {
			redirect('Home');
		}
	}

	public function login() {
		// $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('error_msg', 'Captcha Harus Diisi.');
			die("minta_capcha");
			redirect('AuthAdmin');
		}

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_authadmin->login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('AuthAdmin');
			} else {
				$tgl_login = date("Y-m-d H:i:s");
				$data->TGL_LOGIN = $tgl_login;

				$res_set_tgl = $this->M_authadmin->set_tgl_login($tgl_login, $data->ID_USER);
				
				if($data->ID_ROLE == 1) {
					$status_user = "SUPER_ADMIN";
				}
				$status = "SUPER_ADMIN";
				
				$session = [
					'userdata' => $data,
					'status' => $status,
					'status_user' => $status_user
				];
				$this->session->set_userdata($session);
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('AuthAdmin');
		}
	}

	public function logout() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			redirect('AuthAdmin');
		}

		$id_user = $this->session->userdata('userdata')->ID_USER;
		$this->M_authadmin->set_tgl_login(NULL, $id_user);

		$this->session->sess_destroy();
		redirect('AuthAdmin');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */