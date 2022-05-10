<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('M_authadmin');
	}

    public function login_post()
    {
        $user = $this->post('username'); // The android one use email as post parameter
        $pass = $this->post('password');


        $data_user = $this->M_authadmin->login($user, $pass);
        //var_dump($user);die();
        if($data_user == false) {
            $hasil = array(
                'Status' => "Gagal",
                'Message'=> 'Invalid Username Or Password'
            );
			//$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
			//redirect('AuthAdmin');
        } 
		
		/*if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('AuthAdmin');
			}*/
			else {
            $hasil['Status'] = 'Sukses';
            //$hasil['Data'] = array(
//                'user_id'       => $data_user->ID_USER,
//                'user'          => $data_user->USERNAME,
//                'name'         => $data_user->NAMA_USER,
//				'user_type_id'  => $data_user->ID_ROLE,
//                /*'user_type'     => "Member", // No admin login at Android now
//                'kode_pihk'     => $data_user->kd_pihk,
//                'profile_pic'   => ""*/
//            );
    
        }
		
		$this->set_response($hasil, REST_Controller::HTTP_CREATED);
        
        //$this->response($hasil);
    }

}