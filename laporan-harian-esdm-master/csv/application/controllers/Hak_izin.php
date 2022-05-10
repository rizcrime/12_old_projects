<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hak_izin extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		//$this->load->model('M_r_user_izin_instansi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "hak_izin";
		$data['judul'] 		= "Data Hak Izin";
		$data['deskripsi'] 	= "Manage Data Hak Izin";

		$this->template->views('Admin/Hak_izin/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_role->select_all();

		$this->load->view('Admin/Hak_izin/list_data', $data);
	}

	public function update() {
        $id_role = $this->input->post('id');
		$data['role']	= $this->M_role->select_by_id($id_role);
		$data['data_izin']	= $this->M_admin->select_hak_akses($id_role);

        echo show_my_modal('Admin/Hak_izin/modal_update', 'update-hak_izin', $data);
	}
	
	public function prosesUpdate() {
        $this->form_validation->set_rules('ID_ROLE', 'ID_ROLE', 'trim|required|integer');
        
        $data = $this->input->post();

        if(!isset($data['ID_FORM'])) {
            $list_id_form = array();
        } else {
			$list_id_form = $data['ID_FORM'];
		}

        if ($this->form_validation->run() == TRUE) {
            $id_role = $data["ID_ROLE"];
			$result = $this->M_admin->update_for_user($id_role, $list_id_form);
			
			if ($result === TRUE) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Hak Akses  Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Hak Akses  Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
    }
}