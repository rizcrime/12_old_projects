<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Api_test extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->load->model('Dashboard/m_pramanifest');
	}

    public function index_get()
    {
        $data_pramanifest = $this->m_pramanifest->GetPramanifestByIDAndKeberangkatan(97, 1)->result();
        $this->response($data_pramanifest);
    }

    public function index_post()
    {
        $this->response(array(
            "status" => "veryok"
        ));
    }
}