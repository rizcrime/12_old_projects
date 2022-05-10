<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lap_berita_last_date extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_berita');
        date_default_timezone_set("Asia/Jakarta");
    }

    


    public function index_get()
    {
			$response = array(
				'lap_berita_hot_news' 	=> $this->M_berita->select_berita_hot_news_last_date(),
				'lap_berita_negatif' 	=> $this->M_berita->select_berita_negatif_last_date(),
				'lap_berita_positif' 	=> $this->M_berita->select_berita_positif_last_date(),
				'lap_berita_netral' 	=> $this->M_berita->select_berita_netral_last_date()
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