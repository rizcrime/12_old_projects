<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gunung extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_gunung');
		$this->load->model('M_role');
		$this->load->model('M_kabkot');
		$this->load->model('M_provinsi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "gunung";
		$data['judul'] 		= "Data Gunung";
		$data['deskripsi'] 	= "Manage Data Gunung";
		$data['dataRole'] = $this->M_role->select_all();
		$data['dataKabkot'] = $this->M_kabkot->select_all();
		$data['dataProvinsi'] = $this->M_provinsi->select_all();

		$data['modal_add_gunung'] = show_my_modal('Admin/Gunung/modal_tambah', 'tambah-gunung', $data);

		$this->template->views('Admin/Gunung/home', $data);
	}

	function get_kabkot(){
		$id=$this->input->post('id');
		$id = clean_data($id);
		$data=$this->M_kabkot->select_by_provinsi($id);
		echo json_encode($data);
	}
	
	public function tampil() {
		$data['dataGunung'] = $this->M_gunung->select_all();
		$this->load->view('Admin/Gunung/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['gunung'] = $this->M_gunung->select_by_id($id);

		echo show_my_modal('Admin/Gunung/modal_detail', 'detail-gunung', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('NAMA_GUNUNG', 'Gunung Harus Diisi', 'trim|required');
		
		$this->form_validation->set_rules('ID_PROVINSI', 'Provinsi Harus Diisi', 'trim|required');
		
		$this->form_validation->set_rules('ID_KABKOT', 'Kabupaten / Kota Harus Diisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_gunung->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Gunung Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gunung Gagal ditambahkan', '20px');
			}
		} else if($this->M_gunung->check_id($data['ID_GUNUNG'])) {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('ID GUNUNG Sudah Digunakan');
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());			
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['gunung']	= $this->M_gunung->select_by_id($id);
		$data['dataKabkot'] = $this->M_kabkot->select_all();
		$data['dataProvinsi'] = $this->M_provinsi->select_all();

		echo show_my_modal('Admin/Gunung/modal_update', 'update-gunung', $data);
	}

	public function prosesUpdate() {
		$data = $this->input->post();
		$result = $this->M_gunung->update($data);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Gunung Berhasil diupdate', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Gunung Gagal diupdate', '20px');
		}
		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_gunung->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Gunung Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Gunung Gagal dihapus', '20px');
		}
	}
}