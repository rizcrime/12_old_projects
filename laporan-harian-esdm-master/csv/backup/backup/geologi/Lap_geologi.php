<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_geologi extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_geologi');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "geologi";
		$data['judul'] 		= "Entry Laporan Geologi";
		$data['deskripsi'] 	= "Entry Laporan Geologi";
		$data['jenis_laporan'] = $this->M_geologi->select_all_jenis_laporan();

		$this->template->views('Admin/geologi/home', $data);
	}

	public function show_form($ID_JENIS_LAPORAN="") {
		$data['gunungSet'] = $this->M_geologi->select_all_gunung();
		$data['aktivitasSet'] = $this->M_geologi->select_all_aktivitas();
		$this->load->view('Admin/geologi/modal_' . $ID_JENIS_LAPORAN,$data);
	}
	
	public function tampil() {
		$data['dataGunung'] = $this->M_gunung->select_all();
		$this->load->view('Admin/Lap_geologi/home', $data);
	}
	
	public function show_form_draft($ID_JENIS_LAPORAN="") {
		$select = "";
		$join ="";
		if($ID_JENIS_LAPORAN == 1){
			$join = array();
			$table = "r_lap_geologi_gunung_api a";
			$select  = "b.NAMA_GUNUNG, c.LEVEL";
			$stat = array(
				'tabel' => "t_gunung b",
				'idon' => "a.ID_GUNUNG = b.ID_GUNUNG",
			);
			array_push($join, $stat);
			$stat = array(
				'tabel' => "t_aktivitas c",
				'idon' => "a.ID_AKTIVITAS = c.ID_AKTIVITAS",
			);
			array_push($join, $stat);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah a";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi a";
		}
		
		$data['dataSet'] = $this->M_geologi->select_by_jenis_draft($table,$select,$join);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/geologi/lap' . $ID_JENIS_LAPORAN, $data);
	}


	public function show_form_draft_json($ID_JENIS_LAPORAN="") {
		$select = "";
		$join ="";
		if($ID_JENIS_LAPORAN == 1){
			$join = array();
			$table = "r_lap_geologi_gunung_api a";
			$select  = "b.NAMA_GUNUNG, c.LEVEL";
			$stat = array(
				'tabel' => "t_gunung b",
				'idon' => "a.ID_GUNUNG = b.ID_GUNUNG",
			);
			array_push($join, $stat);
			$stat = array(
				'tabel' => "t_aktivitas c",
				'idon' => "a.ID_AKTIVITAS = c.ID_AKTIVITAS",
			);
			array_push($join, $stat);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah a";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi a";
		}
		
		$data['dataSet'] = $this->M_geologi->select_by_jenis_draft_json($table,$select,$join);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post_json($id_user)->IS_POST;
		$this->load->view('Admin/geologi/lap' . $ID_JENIS_LAPORAN, $data);
	}
	
	public function show_form_history($ID_JENIS_LAPORAN="",$TANGGAL_AWAL="",$TANGGAL_AKHIR="") {
		$select = "";
		$join ="";
		if($ID_JENIS_LAPORAN == 1){
			$join = array();
			$table = "r_lap_geologi_gunung_api a";
			$select  = "b.NAMA_GUNUNG, c.LEVEL";
			$stat = array(
				'tabel' => "t_gunung b",
				'idon' => "a.ID_GUNUNG = b.ID_GUNUNG",
			);
			array_push($join, $stat);
			$stat = array(
				'tabel' => "t_aktivitas c",
				'idon' => "a.ID_AKTIVITAS = c.ID_AKTIVITAS",
			);
			array_push($join, $stat);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah a";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi a";
		}
		
		$data['dataSet'] = $this->M_geologi->select_by_jenis_history($table,$select,$join,$TANGGAL_AWAL,$TANGGAL_AKHIR);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/geologi/his' . $ID_JENIS_LAPORAN, $data);
	}

	public function prosesTambah() {
		//$this->form_validation->set_rules('ID_JENIS_LAPORAN', 'ID_JENIS_LAPORAN', 'trim|required');

		$data = $this->input->post();
		
		if($data['ID_JENIS_LAPORAN'] == 1){
			$table = "r_lap_geologi_gunung_api";
		}else if($data['ID_JENIS_LAPORAN'] == 2){
			$table = "r_lap_geologi_gerakan_tanah";
		}else if($data['ID_JENIS_LAPORAN'] == 3){
			$table = "r_lap_geologi_gempa_bumi";
		}
		
		unset($data["ID_JENIS_LAPORAN"]);
		$stat = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB"
		);
		$data = array_merge($data,$stat);
		$data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		
		$result = $this->M_geologi->insert($data,$table);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal ditambahkan', '20px');
		}

		echo json_encode($out);
	}


	
	
	/*public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataRole'] = $this->M_role->select_all();
		$data['admin']	= $this->M_admin->select_by_id($id);

		echo show_my_modal('Admin/Admin/modal_update_admin', 'update-admin', $data);
	}*/

	

	public function post() {
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['ID_JENIS_LAPORAN'];
		$id_user = $this->session->userdata('userdata')->ID_USER;
		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_geologi_gunung_api a";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah a";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi a";
		}

		$result = $this->M_geologi->post($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal diPosting', '20px');
		}
	}
	
	
	
	public function update() {
		$data['userdata'] 	= $this->userdata;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['ID_JENIS_LAPORAN'];
		//$id_user = $this->session->userdata('userdata')->ID_USER;
		
		$data['dataRole'] = $this->M_role->select_all();
//		$data['admin']	= $this->M_admin->select_by_id($id);
		
		
		
		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_geologi_gunung_api a";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah a";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi a";
		}

		
		

		echo show_my_modal('Admin/geologi/modal_update_geologi_gunung', 'update-geologi-gunung', $data);
		
		//echo json_encode($out);
		
		
	}
	
	
	public function prosesUpdate() {
		$this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		$this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		$this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		$this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		$this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		$this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

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
}