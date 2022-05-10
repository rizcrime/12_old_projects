<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_provinsi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "provinsi";
		$data['judul'] 		= "Data Provinsi";
		$data['deskripsi'] 	= "Manage Data Provinsi";

		$data['modal_add_provinsi'] = show_my_modal('Admin/Provinsi/modal_tambah', 'tambah-provinsi', $data);

		$this->template->views('Admin/Provinsi/home', $data);
	}

	public function tampil() {
		$data['dataProvinsi'] = $this->M_provinsi->select_all();
		$this->load->view('Admin/Provinsi/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['provinsi'] = $this->M_provinsi->select_by_id($id);

		echo show_my_modal('Admin/Provinsi/modal_detail', 'detail-provinsi', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('NAMA_PROVINSI', 'Nama Provinsi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_provinsi->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Provinsi Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Provinsi Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['provinsi']	= $this->M_provinsi->select_by_id($id);

		echo show_my_modal('Admin/Provinsi/modal_update', 'update-provinsi', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('NAMA_PROVINSI', 'Nama Provinsi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_provinsi->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Provinsi Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Provinsi Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_provinsi->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Provinsi Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Provinsi Gagal dihapus', '20px');
		}
	}
}