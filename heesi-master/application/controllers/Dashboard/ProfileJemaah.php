<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileJemaah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('kd_pihk') != TRUE){
            redirect('Dashboard/login');
        }
		$this->load->model('Dashboard/M_ProfileJemaah');
		$this->load->model('Dashboard/M_msconfig');
		$this->load->model('Dashboard/M_paket');
	}

	public function index()
	{
		$data['DataJemaah']	= $this->M_ProfileJemaah->get_data_jemaah();
		// var_dump($data['DataJemaah']);die();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/ProfileJemaah/v_profile_jemaah', $data);
		$this->load->view('Dashboard/layout/footer');
	}

	public function update($id)
	{
		$data['DataJemaah']	= $this->M_ProfileJemaah->get_data_jemaah_by_id($id);
		// var_dump($data);
		// var_dump($data['DataJemaah']);die();
		$this->load->view('Dashboard/layout/template');
		$this->load->view('Dashboard/ProfileJemaah/v_update_jemaah', $data);
		$this->load->view('Dashboard/layout/footer');
			
	}
	public function proses_edit()
	{
		$this->M_ProfileJemaah->do_update();
		// var_dump($this->input->post());
		// die();
		redirect('Dashboard/ProfileJemaah','refresh');
	}
}

		


		
