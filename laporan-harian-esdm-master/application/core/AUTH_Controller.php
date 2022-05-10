<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AUTHADMIN_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_admin');
		$this->load->model('M_authadmin');

		$this->userdata = $this->session->userdata('userdata');

		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

		if ($this->session->userdata('status') == '') {
			http_response_code(404);
			redirect('AuthAdmin');
			return;
		}

		if ($this->session->userdata('status') == "INVESTOR"){
			http_response_code(403);
			die("Forbidden");
			redirect("AuthAdmin");
		}

		// Always check if not verified
		// if ($this->session->userdata('status') == "INVESTOR"
		// 	&& !is_null($this->session->userdata('isVerified'))
		// 	&& $this->session->userdata('isVerified')->IS_VERIFIED != "Y") {
		// 	$this->load->model('M_r_permohonan_izin');
		// 	$is = $this->M_r_permohonan_izin->check_verified($this->userdata->ID_PERUSAHAAN);
		// 	$this->session->set_userdata('isVerified', $is);
		// } 
		
		// Check 1 user = 1 session
		// if ($this->session->userdata('status') != "INVESTOR"){
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$tgl_login = $this->M_authadmin->get_tgl_login($id_user);

		$session_tgl_login = $this->session->userdata('userdata')->TGL_LOGIN;

		if($tgl_login != $session_tgl_login) {
			$this->session->set_flashdata('double_session', TRUE);
			redirect('/AuthAdmin/double_login');
			return;
		}
		// }
	}

	public function updateProfil() {
		if ($this->userdata != '') {
			$data = $this->M_user->select($this->userdata->ID_USER);
			

			$this->session->set_userdata('userdata', $data);
			$this->userdata = $this->session->userdata('userdata');
		}
	}
}

class AUTH_SUPER_ADMIN_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_admin');
		$this->load->model('M_authadmin');

		$this->userdata = $this->session->userdata('userdata');

		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

		if ($this->session->userdata('status') == '') {
			http_response_code(404);
			redirect('AuthAdmin');
			return;
		}

		if ($this->session->userdata('status') != "SUPER_ADMIN"){
			http_response_code(403);
			die("Forbidden");
			redirect("AuthAdmin");
		}

		
		// Check 1 user = 1 session
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$tgl_login = $this->M_authadmin->get_tgl_login($id_user);

		$session_tgl_login = $this->session->userdata('userdata')->TGL_LOGIN;

		if($tgl_login != $session_tgl_login) {
			$this->session->set_flashdata('double_session', TRUE);
			redirect('/Beranda/double_login');
			return;
		}


		if($this->session->userdata("userdata")->ID_ROLE == "ADVE" && $this->uri->segment(1) != "Verifikasi_bidder") {
			redirect("Verifikasi_bidder");
		}
	}

	public function updateProfil() {
		if ($this->userdata != '') {
			$data = $this->M_user->select($this->userdata->ID_USER);
			

			$this->session->set_userdata('userdata', $data);
			$this->userdata = $this->session->userdata('userdata');
		}
	}
}

class AUTHBIDDER_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		check_maintenance();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_bidder');
		$this->load->model('M_admin');
		$this->load->model('M_authadmin');
		$this->load->model('M_authbidder');

		$this->userdata = $this->session->userdata('userdata');
		
		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

		if ($this->session->userdata('status') == '') {
			redirect('AuthAdmin');
		}

		if ($this->session->userdata('status') != "INVESTOR"){
			http_response_code(403);
			die("Forbidden");
			redirect("AuthAdmin");
		}

		// Always check if not verified
		if ($this->session->userdata('status') == "INVESTOR"
			&& !is_null($this->session->userdata('isVerified'))
			&& $this->session->userdata('isVerified')->IS_VERIFIED != "Y") {
			$this->load->model('M_r_permohonan_izin');
			$is = $this->M_r_permohonan_izin->check_verified($this->userdata->ID_PERUSAHAAN);
			$this->session->set_userdata('isVerified', $is);
		}

		// Check 1 user = 1 session
		if ($this->session->userdata('status') == "INVESTOR"){
			$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;
			$tgl_login = $this->M_authbidder->get_tgl_login($id_perusahaan);

			$session_tgl_login = $this->session->userdata('userdata')->TGL_LOGIN;

			if($tgl_login != $session_tgl_login) {
				$this->session->set_flashdata('double_session', TRUE);
				redirect('/AuthAdmin/double_login');
				return;
			}
		}
		
		if (is_null($this->session->userdata('userdata')->IS_PASSWORD_DEFAULT)){
			redirect("Ubah_password");
		}		
	}

	public function updateProfil() {
		if ($this->userdata != '') {
			$data = $this->M_user->select($this->userdata->ID_USER);
			

			$this->session->set_userdata('userdata', $data);
			$this->userdata = $this->session->userdata('userdata');
		}
	}

	// public function updateProfil() {
	// 	if ($this->userdata != '') {
	// 		$data = $this->M_bidder->select($this->userdata->id);

	// 		$this->session->set_userdata('userdata', $data);
	// 		$this->userdata = $this->session->userdata('userdata');
	// 	}
	// }
}

class AUTHBIDDER_Free_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		check_maintenance();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('M_bidder');
		$this->load->model('M_admin');
		$this->load->model('M_authadmin');
		$this->load->model('M_authbidder');

		$this->userdata = $this->session->userdata('userdata');
		
		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

		if ($this->session->userdata('status') == '') {
			redirect('AuthAdmin');
		}

		if ($this->session->userdata('status') != "INVESTOR"){
			http_response_code(403);
			die("Forbidden");
			redirect("AuthAdmin");
		}

		// Always check if not verified
		if ($this->session->userdata('status') == "INVESTOR"
			&& !is_null($this->session->userdata('isVerified'))
			&& $this->session->userdata('isVerified')->IS_VERIFIED != "Y") {
			$this->load->model('M_r_permohonan_izin');
			$is = $this->M_r_permohonan_izin->check_verified($this->userdata->ID_PERUSAHAAN);
			$this->session->set_userdata('isVerified', $is);
		}

		// Check 1 user = 1 session
		if ($this->session->userdata('status') == "INVESTOR"){
			$id_perusahaan = $this->session->userdata('userdata')->ID_PERUSAHAAN;
			$tgl_login = $this->M_authbidder->get_tgl_login($id_perusahaan);

			$session_tgl_login = $this->session->userdata('userdata')->TGL_LOGIN;

			if($tgl_login != $session_tgl_login) {
				$this->session->set_flashdata('double_session', TRUE);
				redirect('/AuthAdmin/double_login');
				return;
			}
		}
		
		if (!is_null($this->session->userdata('userdata')->IS_PASSWORD_DEFAULT)) {
			redirect("AuthAdmin");
		}
	}
}