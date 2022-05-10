<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_aktivitas');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "aktivitas";
		$data['judul'] 		= "Data Aktivitas";
		$data['deskripsi'] 	= "Manage Data Aktivitas";

		$data['modal_add_aktivitas'] = show_my_modal('Admin/Aktivitas/modal_tambah', 'tambah-aktivitas', $data);

		$this->template->views('Admin/Aktivitas/home', $data);
	}

	public function tampil() {
		$data['dataAktivitas'] = $this->M_aktivitas->select_all();
		$this->load->view('Admin/Aktivitas/list_data', $data);
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['aktivitas'] = $this->M_aktivitas->select_by_id($id);

		echo show_my_modal('Admin/Aktivitas/modal_detail', 'detail-aktivitas', $data, 'lg');
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('LEVEL', 'Aktivitas Harus Diisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_aktivitas->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Aktivitas Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Aktivitas Gagal ditambahkan', '20px');
			}
		} else if($this->M_aktivitas->check_id($data['ID_AKTIVITAS'])) {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('ID AKTIVITAS Sudah Digunakan');
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());			
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['aktivitas']	= $this->M_aktivitas->select_by_id($id);

		echo show_my_modal('Admin/Aktivitas/modal_update', 'update-aktivitas', $data);
	}

	public function prosesUpdate() {
		$data = $this->input->post();
		$result = $this->M_aktivitas->update($data);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Aktivitas Berhasil diupdate', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Aktivitas Gagal diupdate', '20px');
		}
		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_aktivitas->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Aktivitas Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Aktivitas Gagal dihapus', '20px');
		}
	}
}