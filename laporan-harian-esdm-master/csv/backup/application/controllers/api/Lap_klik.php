<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lap_klik extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_klik');
    }

    


    public function index_get()
    {
			$response = array(
				'lap_klik_ebtke' 		=> $this->M_klik->select_klik_ebtke(),
				'lap_klik_gatrik' 	=> $this->M_klik->select_klik_gatrik(),
				'lap_klik_geologi' 	=> $this->M_klik->select_klik_geologi(),
				'lap_klik_migas' 		=> $this->M_klik->select_klik_migas(),
				'lap_klik_minerba'	=> $this->M_klik->select_klik_minerba()  
			);
	
				
			$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
			exit;


		

    }

    
}

?>