<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lap_geologi_last_date extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_geologi');
        date_default_timezone_set("Asia/Jakarta");
    }

  
	

	public function index_get()
	{
	
		$response = array(
			'lap_geologi_gempa_bumi' => $this->M_geologi->select_geologi_gempa_bumi_last_date(),
			'lap_geologi_gunung_api' => $this->M_geologi->select_geologi_gunung_api_last_date(),
			'lap_geologi_gerakan_tanah' => $this->M_geologi->select_geologi_gerakan_tanah_last_date()  
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