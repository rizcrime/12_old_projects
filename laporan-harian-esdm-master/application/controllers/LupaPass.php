<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LupaPass extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_register');
		$this->load->model('M_bidder');
		$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->library('mailer');
	}

    public function index()
    {
        $data['page'] = "lupapass";
        $data = array(
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );

        $this->load->view('header2', $data);
        $this->load->view('lupaPass', $data);
        $this->load->view('footer');
    }


    public function lupa() {
      $this->form_validation->set_rules('EMAIL_PERUSAHAAN', 'Email Perusahaan', 'required|min_length[3]|max_length[50]');
      $recaptcha = $this->input->post('g-recaptcha-response');
      $response = $this->recaptcha->verifyResponse($recaptcha);

      $data = $this->input->post();

      $lupa_pass_wording = 'Jika e-mail terdaftar, silahkan cek email anda untuk mengubah password.';

      if(!isset($response['success']) || $response['success'] <> true) {
        $this->session->set_flashdata('error_msg', 'Captcha harus diisi!');
        // redirect('Beranda');
        $out['status'] = '';
        $out['msg'] = err_capca('Captcha harus diisi!', '20px');
      } else {
        $clean = $this->security->xss_clean($data['EMAIL_PERUSAHAAN']);  
        $email_is_exist = $this->M_bidder->check_email_ubah($clean);

        if(is_null($email_is_exist)) {
            $out['status'] = '';
            $out['msg'] = sukses_daftar($lupa_pass_wording, '20px');
        }
        else {
            $token = $this->M_bidder->insertToken($email_is_exist->ID_PERUSAHAAN);              
            $qstring = $this->base64url_encode($token);           
            $url = site_url() . 'Lupa/token/' . $qstring;  
            $link = '<a href="' . $url . '">' . $url . '</a>';   

            $message = '';
            $message .= '<strong>Yth. Pemohon,<br>';
            $message .= 'Anda menerima email ini karena ada permintaan untuk memperbaharui  
            password anda.<br>';  
            $message .= 'Link untuk memperbaharui password Anda hanya berlaku 24 jam.<br>';         
            $message .= 'Silakan klik link ini:</strong> ' . $link;

            if($this->sendMail($data, $message)) {
                $out['status'] = 'sukses';
                $out['msg'] = sukses_daftar($lupa_pass_wording, '20px');
            } else {
                $out['status'] = 'sukses';
                // $error = $this->email->print_debugger();
                // $out['msg'] = err_capca('Email lupa password gagal dikirim.<br>'.$error, '20px');                
                $out['msg'] = err_capca('Mohon coba lagi', '20px');                
            }
        }
      }

      echo json_encode($out);
}

public function lupaAdmin() {
      $this->form_validation->set_rules('EMAIL_ADMIN', 'Email Admin', 'required|min_length[3]|max_length[50]');
      $recaptcha = $this->input->post('g-recaptcha-response');
      $response = $this->recaptcha->verifyResponse($recaptcha);

      $data = $this->input->post();

      $lupa_pass_wording = 'Jika e-mail terdaftar, silahkan cek email anda untuk mengubah password.';

      if(!isset($response['success']) || $response['success'] <> true) {
        $this->session->set_flashdata('error_msg', 'Captcha harus diisi!');
        // redirect('Beranda');
        $out['status'] = '';
        $out['msg'] = err_capca('Captcha harus diisi!', '20px');
      } else {
        $clean = $this->security->xss_clean($data['EMAIL_ADMIN']);  
        $email_is_exist = $this->M_bidder->check_email_ubah_admin($clean);

        if(is_null($email_is_exist)) {
            $out['status'] = '';
            $out['msg'] = sukses_daftar("Email anda tidak terdaftar", '20px');
        }
        else {
            $token = $this->M_bidder->insertToken($email_is_exist->ID_USER);              
            $qstring = $this->base64url_encode($token);           
            $url = site_url() . 'Lupa/tokenAdmin/' . $qstring;  
            $link = '<a href="' . $url . '">' . $url . '</a>';   

            $message = '';
            $message .= '<strong>Yth. Pemohon,<br>';
            $message .= 'Anda menerima email ini karena ada permintaan untuk memperbaharui  
            password anda.<br>';  
            $message .= 'Link untuk memperbaharui password Anda hanya berlaku 24 jam.<br>';         
            $message .= 'Silakan klik link ini:</strong> ' . $link;
			
            if($this->sendMail($data, $message)) {
                $out['status'] = 'sukses';
                $out['msg'] = sukses_daftar($lupa_pass_wording, '20px');
            } else {
                $out['status'] = 'sukses';
                $error = $this->email->print_debugger();
                $out['msg'] = err_capca('Email lupa password gagal dikirim.<br>'.$error, '20px');                
                $out['msg'] = err_capca('Mohon coba lagi', '20px');                
            }
        }
      }

      echo json_encode($out);
}

public function sendMail($data, $message) {
    $ci = get_instance();
    $ci->load->library('email');
    $config = get_smtp_config();

    $ci->email->initialize($config);

    $ci->email->from(get_current_email(), 'Minerba');
    $to = $data['EMAIL_ADMIN'];
    $ci->email->to($to);
    $ci->email->subject('Lupa Password');
    $ci->email->message($message);

    return $this->email->send();
} 

   public function base64url_encode($data) {   
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
   }   
}
