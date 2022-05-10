<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/M_login');
	}

    public function login_post()
    {
        $username = $this->post('email'); // The android one use email as post parameter
        $password = $this->post('password');
        $data_user = $this->M_login->check_user($username, $password);

        if(empty($data_user)) {
            $data_user = $this->M_login->check_non_pihk_login($username, $password);
        }

        if(empty($data_user)) {
            $hasil = array(
                'Status' => "Gagal",
                'Message'=> 'Invalid Username Or Password'
            );
        } else {
            $hasil['Status'] = 'Success';

            if(isset($data_user->pihk)) {
                $hasil['Data'] = array(
                    'user_id'       => $data_user->id,
                    'name'          => $data_user->pihk,
                    'email'         => $data_user->email,
                    'user_type'     => "Member", // No admin login at Android now
                    'kode_pihk'     => $data_user->kd_pihk,
                    'profile_pic'   => ""
                );
            } else {
                $hasil['Data'] = array(
                    'user_id'       => $data_user->id,
                    'name'          => "",
                    'email'         => "",
                    'user_type'     => "Admin", // No admin login at Android now
                    'kode_pihk'     => $data_user->kd_pihk,
                    'profile_pic'   => ""
                );
            }            
    
        }
        
        $this->response($hasil);
    }

}