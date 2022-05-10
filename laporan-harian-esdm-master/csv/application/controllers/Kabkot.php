<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkot extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kabkot');
		$this->load->model('M_provinsi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "kabkot";
		$data['judul'] 		= "Data Kabupaten Kota";
		$data['deskripsi'] 	= "Manage Data Kabupaten Kota";
		$data['dataProvinsi'] = $this->M_provinsi->select_all();

		$data['modal_add_kabkot'] = show_my_modal('Admin/Kabkot/modal_tambah', 'tambah-kabkot', $data);

		$this->template->views('Admin/Kabkot/home', $data);
	}

	public function tampil() {
		$data['dataKabkot'] = $this->M_kabkot->select_all();
		$this->load->view('Admin/Kabkot/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['kabkot'] = $this->M_kabkot->select_by_id($id);

		echo show_my_modal('Admin/Kabkot/modal_detail', 'detail-kabkot', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('NAMA_KABKOT', 'Nama Kabupaten Kota', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kabkot->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kabupaten Kota Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Kabupaten Kota Gagal ditambahkan', '20px');
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
		$data['kabkot']	= $this->M_kabkot->select_by_id($id);
		$data['dataProvinsi'] = $this->M_provinsi->select_all();

		echo show_my_modal('Admin/Kabkot/modal_update', 'update-kabkot', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('NAMA_KABKOT', 'Nama Kabupaten Kota', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kabkot->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kabupaten Kota Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kabupaten Kota Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_kabkot->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Kabupaten Kota Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Kabupaten Kota Gagal dihapus', '20px');
		}
	}
}