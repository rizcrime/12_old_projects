<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_role');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "role";
		$data['judul'] 		= "Data Role";
		$data['deskripsi'] 	= "Manage Data Role";

		$data['modal_add_role'] = show_my_modal('Admin/Role/modal_tambah', 'tambah-role', $data);

		$this->template->views('Admin/Role/home', $data);
	}

	public function tampil() {
		$data['dataRole'] = $this->M_role->select_all();
		$this->load->view('Admin/Role/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['role'] = $this->M_role->select_by_id($id);

		echo show_my_modal('Admin/Role/modal_detail', 'detail-role', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('ROLE', 'Role Harus Diisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_role->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Role Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Role Gagal ditambahkan', '20px');
			}
		} else if($this->M_role->check_id($data['ID_ROLE'])) {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('ID ROLE Sudah Digunakan');
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());			
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['role']	= $this->M_role->select_by_id($id);

		echo show_my_modal('Admin/Role/modal_update', 'update-role', $data);
	}

	public function prosesUpdate() {
		$data = $this->input->post();
		$result = $this->M_role->update($data);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Role Berhasil diupdate', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Role Gagal diupdate', '20px');
		}
		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_role->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Role Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Role Gagal dihapus', '20px');
		}
	}
}