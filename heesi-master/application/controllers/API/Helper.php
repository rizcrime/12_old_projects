<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Helper extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/M_msconfig');
	}

    public function msconfig_get()
    {
        $var_id = $this->get('var_id');
        
        $data_msconfig = $this->M_msconfig->GetDataMsconfig($var_id)->result();

        $this->response($data_msconfig);
    }

}