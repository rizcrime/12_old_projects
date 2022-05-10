<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		// $this->load->model('M_admin');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "admin";
		$data['judul'] 		= "Data Admin";
		$data['deskripsi'] 	= "Manage Data Admin";

		$data['modal_add_admin'] = show_my_modal('Admin/Admin/modal_tambah_admin', 'tambah-admin', $data);

		$this->template->views('Admin/Admin/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('Admin/Admin/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['admin'] = $this->M_admin->select_by_id($id);

		echo show_my_modal('Admin/Admin/modal_detail_admin', 'detail-admin', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		$this->form_validation->set_rules('PASSWORD', 'Password', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_admin->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data User Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data User Gagal ditambahkan', '20px');
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
		$data['dataAdmin']	= $this->M_admin->select_by_id($id);

		echo show_my_modal('Admin/Admin/modal_update_admin', 'update-admin', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('NIK', 'NIK', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_admin->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Admin Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Admin Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_admin->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data User Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data User Gagal dihapus', '20px');
		}
	}
}