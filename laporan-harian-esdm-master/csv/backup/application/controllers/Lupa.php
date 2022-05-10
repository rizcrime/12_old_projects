<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_bidder');
	}

	public function index() {
		// $data['userdata'] 			= $this->userdata;
		// var_dump($data);die();
		$data['page'] 			= "home";
		$data['judul'] 			= "Home";
		$data['deskripsi'] 		= "lupa password";
		$data['expired'] 		= FALSE;

		$this->load->view('lupa_password', $data);
	}

	public function indexAdmin() {
		// $data['userdata'] 			= $this->userdata;
		// var_dump($data);die();
		$data['page'] 			= "home";
		$data['judul'] 			= "Home";
		$data['deskripsi'] 		= "lupa password";
		$data['expired'] 		= FALSE;

		$this->load->view('lupa_password_admin', $data);
	}
	
	public function token($token = NULL) {
		$t = $this->base64url_decode($token);           
		$cleanToken = $this->security->xss_clean($t);

    	$user_info = $this->M_bidder->isTokenValid($cleanToken); //either false or array();          
         
    	if(!$user_info){ 
        	$this->session->set_flashdata('msg-error', 'Token tidak valid atau kedaluwarsa');
			$data['page'] 			= "home";
			$data['judul'] 			= "Home";
			$data['deskripsi'] 		= "lupa password";
			$data['token']			= $token;
			$data['expired']		= $user_info;
			$this->load->view('lupa_password', $data);
       	} else {
			$data['page'] 			= "home";
			$data['judul'] 			= "Home";
			$data['deskripsi'] 		= "lupa password";
			$data['token']			= $token;
			$data['expired']		= $user_info;
			$this->load->view('lupa_password', $data);
       	}
	}
	
	public function tokenAdmin($token = NULL) {
		$t = $this->base64url_decode($token);           
		$cleanToken = $this->security->xss_clean($t);

    	$user_info = $this->M_bidder->isTokenValidAdmin($cleanToken); //either false or array();          

    	if(!$user_info){ 
        	$this->session->set_flashdata('msg-error', 'Token tidak valid atau kedaluwarsa');
			$data['page'] 			= "home";
			$data['judul'] 			= "Home";
			$data['deskripsi'] 		= "lupa password";
			$data['token']			= $token;
			$data['expired']		= $user_info;
			$this->load->view('lupa_password_admin', $data);
       	} else {
			$data['page'] 			= "home";
			$data['judul'] 			= "Home";
			$data['deskripsi'] 		= "lupa password";
			$data['token']			= $token;
			$data['expired']		= $user_info;
			$this->load->view('lupa_password_admin', $data);
       	}
	}

	public function prosesUbahPass() {
		$data = $this->input->post();

		$input_token = $data['token'];
		$t = $this->base64url_decode($data['token']);           
		$cleanToken = $this->security->xss_clean($t);
		$data['token'] = $cleanToken;

    	$user_info = $this->M_bidder->isTokenValid($data['token']); //either false or array();          
		$password_ulang = $data['PASSWORD_ULANG'];
		$password_baru = $data['PASSWORD'];

		$this->form_validation->set_rules('PASSWORD_ULANG', 'Password', 'required');
		$this->form_validation->set_rules('PASSWORD', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
	       	$post = $this->input->post(NULL, TRUE);          
	       	$cleanPost = $this->security->xss_clean($post);          
	       	$hashed = ($cleanPost['PASSWORD']);          
	       	$cleanPost['PASSWORD'] = $hashed;  
			$cleanPost['EMAIL_PERUSAHAAN'] = $user_info->EMAIL_PERUSAHAAN;  
			   
			$target_redirect_url = "Lupa/token/{$input_token}";

			if(!empty($user_info)){
				if($password_ulang == $password_baru){
			       	unset($cleanPost['PASSWORD_ULANG']);          
					$result = $this->M_bidder->ubah_password($user_info->EMAIL_PERUSAHAAN, $cleanPost);
					$this->M_bidder->delete_token($cleanToken);
					if($result) {
						$this->session->set_flashdata('msg-success', 'Berhasil ubah password');
						redirect('Lupa');
					} else {
						$this->session->set_flashdata('msg-error', 'Gagal ubah password');
						redirect($target_redirect_url);
					}
				} else {
					$this->session->set_flashdata('msg-error', 'Password yang anda masukkan tidak sesuai.');
					redirect($target_redirect_url);
				}
			} else {
				$this->session->set_flashdata('msg-error', 'Token sudah tidak valid.');
				redirect('Lupa');
			}

		} else {
			$this->session->set_flashdata('msg-error', 'Gagal ubah password');
			redirect('Lupa');
		}
		
	}
	
	public function prosesUbahPassAdmin() {
		$data = $this->input->post();

		$input_token = $data['token'];
		$t = $this->base64url_decode($data['token']);           
		$cleanToken = $this->security->xss_clean($t);
		$data['token'] = $cleanToken;

    	$user_info = $this->M_bidder->isTokenValidAdmin($data['token']); //either false or array();          
		$password_ulang = $data['PASSWORD_ULANG'];
		$password_baru = $data['PASSWORD'];

		$this->form_validation->set_rules('PASSWORD_ULANG', 'Password', 'required');
		$this->form_validation->set_rules('PASSWORD', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
	       	$post = $this->input->post(NULL, TRUE);          
	       	$cleanPost = $this->security->xss_clean($post);          
	       	$hashed = ($cleanPost['PASSWORD']);          
	       	$cleanPost['PASSWORD'] = $hashed;  
			$cleanPost['EMAIL_USER'] = $user_info->EMAIL_USER;  
			   
			$target_redirect_url = "Lupa/tokenAdmin/{$input_token}";

			if(!empty($user_info)){
				if($password_ulang == $password_baru){
			       	unset($cleanPost['PASSWORD_ULANG']);          
					$result = $this->M_bidder->ubah_password_admin($user_info->EMAIL_USER, $cleanPost);
					$this->M_bidder->delete_token($cleanToken);
					if($result) {
						$this->session->set_flashdata('msg-success', 'Berhasil ubah password');
						redirect('AuthAdmin');
					} else {
						$this->session->set_flashdata('msg-error', 'Gagal ubah password');
						redirect($target_redirect_url);
					}
				} else {
					$this->session->set_flashdata('msg-error', 'Password yang anda masukkan tidak sesuai.');
					redirect($target_redirect_url);
				}
			} else {
				$this->session->set_flashdata('msg-error', 'Token sudah tidak valid.');
				redirect('AuthAdmin');
			}

		} else {
			$this->session->set_flashdata('msg-error', 'Gagal ubah password');
			redirect('AuthAdmin');
		}
		
	}

	// public function prosesUbahPassLama() {
	// 	$this->form_validation->set_rules('EMAIL_PERUSAHAAN', 'Email', 'required');
	// 	$this->form_validation->set_rules('PASSWORD_ULANG', 'Password', 'required');
	// 	$this->form_validation->set_rules('PASSWORD', 'Password', 'required');

	// 	$data = $this->input->post();
	// 	$password_ulang = $data['PASSWORD_ULANG'];
	// 	$password_baru = $data['PASSWORD'];
	// 	$email = $data['EMAIL_PERUSAHAAN'];

	// 	$check_email = $this->M_bidder->check_email_ubah($email);

	// 	if ($this->form_validation->run() == TRUE) {
	// 		if($check_email->EMAIL_PERUSAHAAN == $email){
	// 			if($password_ulang == $password_baru){
	// 				$result = $this->M_bidder->ubah_password($data['EMAIL_PERUSAHAAN'], $data);
	// 				// var_dump($result, $data);die();
	// 				if($result > 0) {
	// 					redirect('Beranda');
	// 				}
	// 			} else {
	// 				$this->session->set_flashdata('msg', 'Password yang anda masukkan tidak sesuai.');
	// 				redirect('Lupa');
	// 			}
	// 		} else {
	// 			$this->session->set_flashdata('msg', 'Email yang anda masukkan belum terdaftar.');
	// 			redirect('Lupa');
	// 		}

	// 	} else {
	// 		$this->session->set_flashdata('msg', 'Gagal ubah password');
	// 		redirect('Lupa');
	// 	}
		
	// }
   
   public function base64url_encode($data) {   
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
   }   

   public function base64url_decode($data) {   
   	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
   }    
}