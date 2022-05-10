<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Kasus extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/M_kasus');
	}

    public function input_post()
    {
        $tanggal = $this->post('tanggal');
        $waktu = $this->post('waktu');
        $tempat = $this->post('tempat');
        $kejadian = $this->post('kejadian');

        $combined_date  = $tanggal . " " . $waktu;
        $timestamp = date("Y-m-d H:i:s", strtotime($combined_date));

        $insert_id = $this->M_kasus->input_data($timestamp, $tempat, $kejadian);

        if($insert_id === FALSE) {
            $this->response(array(
                'status' => FALSE
            ));
        } else {
            $this->response(array(
                'status' => TRUE,
                'id'     => $insert_id
            ));
        }
    }

}