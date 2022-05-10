<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lap_geologi extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_geologi');
    }

  
	

	public function index_get()
	{
	
		$response = array(
			'lap_geologi_gempa_bumi' => $this->M_geologi->select_geologi_gempa_bumi(),
			'lap_geologi_gunung_api' => $this->M_geologi->select_geologi_gunung_api(),
			'lap_geologi_gerakan_tanah' => $this->M_geologi->select_geologi_gerakan_tanah()  
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