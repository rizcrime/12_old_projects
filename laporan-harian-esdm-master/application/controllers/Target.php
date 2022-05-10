<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_target');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "target";
		$data['judul'] 		= "Data Target";
		$data['deskripsi'] 	= "Manage Data Target";
		$data['dataTahunTarget'] = $this->M_target->select_all();

		$data['modal_add_target'] = show_my_modal('Admin/Target/modal_tambah', 'tambah-target', $data);

		$this->template->views('Admin/Target/home', $data);
	}

	public function tampil() {
		$data['dataTarget'] = $this->M_target->select_all();
		$this->load->view('Admin/Target/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['target'] = $this->M_target->select_by_id($id);

		echo show_my_modal('Admin/target/modal_detail', 'detail-target', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('APBN_PROD_MINYAK', 'Target Harus Diisi', 'trim|required');
		$this->form_validation->set_rules('APBN_PROD_GAS', 'Target Harus Diisi', 'trim|required');
		$this->form_validation->set_rules('APBN_EKV_MIGAS', 'Target Harus Diisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_target->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Target Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Target Gagal ditambahkan', '20px');
			}
		} else if($this->M_target->check_id($data['ID_TARGET'])) {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('ID TARGET Sudah Digunakan');
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());			
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['target']	= $this->M_target->select_by_id($id);

		echo show_my_modal('Admin/Target/modal_update', 'update-target', $data);
	}

	public function prosesUpdate() {
		$data = $this->input->post();
		$result = $this->M_target->update($data);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Target Berhasil diupdate', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Target Gagal diupdate', '20px');
		}
		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_target->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Target Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Target Gagal dihapus', '20px');
		}
	}
}