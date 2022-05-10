<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "admin";
		$data['judul'] 		= "Data Admin";
		$data['deskripsi'] 	= "Manage Data Admin";
		$data['dataRole'] = $this->M_role->select_all();

		$data['modal_add_admin'] = show_my_modal('Admin/Admin/modal_tambah_admin', 'tambah-admin', $data);

		$this->template->views('Admin/Admin/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('Admin/Admin/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		$this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		$this->form_validation->set_rules('NAMA_USER', 'Nama', 'trim|required');
		$this->form_validation->set_rules('IS_POST', 'Admin', 'trim|required');

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
		$data['dataRole'] = $this->M_role->select_all();
		$data['admin']	= $this->M_admin->select_by_id($id);

		echo show_my_modal('Admin/Admin/modal_update_admin', 'update-admin', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		//$this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		$this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		$this->form_validation->set_rules('NAMA_USER', 'Nama', 'trim|required');
		//$this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		//$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('IS_POST', 'Post', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_admin->update($data);

			if ($result === TRUE) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data User Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data User Gagal diupdate', '20px');
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