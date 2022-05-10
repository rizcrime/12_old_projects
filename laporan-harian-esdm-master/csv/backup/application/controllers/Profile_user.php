<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_user extends AUTHBIDDER_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_bidder');
		$this->load->model('M_r_permohonan_izin');

		$verivied_status = $this->M_bidder->select_by_id_edit_profile($this->userdata->ID_PERUSAHAAN)->IS_VERIFIED;
		if($verivied_status == "B") {
			http_response_code(403);
			die("Forbidden");
		}
	}

	public function index() {
		$data['userdata'] 		= $this->userdata;
		if(isset($this->userdata->ID_USER)) {
			$data['nama'] = $this->userdata->USERNAME;
			$data['title'] = 'Username';
		} else {
			$data['nama'] = $this->userdata->NAMA_PERUSAHAAN;
			$data['title'] = 'Nama perusahaan';
		}
		
		$data['page'] 			= "profile";
		$data['judul'] 			= "Profile";
		$data['deskripsi'] 		= "Setting Profile";
		$data['sum_unverified_bidder'] = $this->M_bidder->total_rows_unverified();
		if($this->session->userdata('status') == "EVALUATOR"){
			$data['sum_permohonan'] = $this->M_r_permohonan_izin->total_permohonan($this->userdata);
		}
		$this->template->views('profile_user', $data);
	}

	public function update() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[15]');

		$id = $this->userdata->ID_USER;
		$data = $this->input->post();
		
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_user->update($data, $id);
			if ($result > 0) {
				$this->updateProfil();
				$this->session->set_flashdata('msg', show_succ_msg('Data Profile Berhasil diubah'));
				redirect('Profile_user');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Data Profile Gagal diubah'));
				redirect('Profile_user');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile_user');
		}
	}

	public function ubah_password() {
		$this->form_validation->set_rules('passLama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('passKonf', 'Password Konfirmasi', 'trim|required');

		$id = $this->userdata->ID_USER;
		if ($this->form_validation->run() == TRUE) {
			if (md5($this->input->post('passLama')) == $this->userdata->PASSWORD) {
				if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
					$this->session->set_flashdata('msg', show_err_msg('Password Baru dan Konfirmasi Password harus sama'));
					redirect('Profile_user');
				} else {
					$data = [
						'PASSWORD' => md5($this->input->post('passBaru'))
					];
					if(isset($this->userdata->ID_USER)) {
						$result = $this->M_user->update($data, $id);
					} else {
						$id = $this->userdata->ID_PERUSAHAAN;
						$result = $this->M_bidder->update($data, $id);						
					}
					if ($result > 0) {
						// $this->updateProfil();
						$this->session->set_flashdata('msg', show_succ_msg('Password Berhasil diubah'));
						redirect('Profile_user');
					} else {
						$this->session->set_flashdata('msg', show_err_msg('Password Gagal diubah'));
						redirect('Profile_user');
					}
				}
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Password Salah'));
				redirect('Profile_user');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile_user');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */