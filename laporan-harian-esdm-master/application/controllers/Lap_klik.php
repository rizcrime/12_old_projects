<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_klik extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_klik');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "klik";
		$data['judul'] 		= "Entry Laporan Klik";
		$data['deskripsi'] 	= "Entry Laporan Klik";
		$data['jenis_laporan'] = $this->M_klik->select_all_jenis_laporan();
		$data['modal_add_gunung'] = show_my_modal('Admin/klik/modal_view_all', 'tambah-gunung', $data);
		$this->template->views('Admin/klik/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('Admin/Admin/list_data', $data);
	}
	
	public function show_form($ID_JENIS_LAPORAN="") {
		$data['jenis_berita'] = $this->M_klik->select_all_jenis_berita();
		$this->load->view('Admin/klik/modal_' . $ID_JENIS_LAPORAN, $data);
	}
	
	public function show_form_draft($ID_JENIS_LAPORAN="") {
		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_klik_migas";
			$table = "r_lap_klik_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_klik_negatif";
			// $table = "r_lap_klik_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_klik_gatrik";
			$table = "r_lap_klik_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_klik_ebtke";
			$table = "r_lap_klik_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_klik_geologi";
		// }
		
		$data['dataSet'] = $this->M_klik->select_by_jenis_draft($table);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/klik/lap' . $ID_JENIS_LAPORAN, $data);
	}
	
	public function show_form_history($ID_JENIS_LAPORAN="",$TANGGAL_AWAL="",$TANGGAL_AKHIR="") {
		// if($ID_JENIS_LAPORAN == 1){
		// 	$table = "r_lap_klik_migas";
		// }else if($ID_JENIS_LAPORAN == 2){
		// 	$table = "r_lap_klik_minerba";
		// }else if($ID_JENIS_LAPORAN == 3){
		// 	$table = "r_lap_klik_gatrik";
		// }else if($ID_JENIS_LAPORAN == 4){
		// 	$table = "r_lap_klik_ebtke";
		// }else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_klik_geologi";
		// }

		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_klik_migas";
			$table = "r_lap_klik_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_klik_negatif";
			// $table = "r_lap_klik_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_klik_gatrik";
			$table = "r_lap_klik_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_klik_ebtke";
			$table = "r_lap_klik_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_klik_geologi";
		// }
		
		$data['dataSet'] = $this->M_klik->select_by_jenis_history($table,$TANGGAL_AWAL,$TANGGAL_AKHIR);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/klik/his' . $ID_JENIS_LAPORAN, $data);
	}

	public function prosesTambah() {
		//$this->form_validation->set_rules('ID_JENIS_LAPORAN', 'ID_JENIS_LAPORAN', 'trim|required');

		$data = $this->input->post();
	
		// if($data['ID_JENIS_LAPORAN'] == 1){
		// 	$table = "r_lap_klik_migas";
		// }else if($data['ID_JENIS_LAPORAN'] == 2){
		// 	$table = "r_lap_klik_minerba";
		// }else if($data['ID_JENIS_LAPORAN'] == 3){
		// 	$table = "r_lap_klik_gatrik";
		// }else if($data['ID_JENIS_LAPORAN'] == 4){
		// 	$table = "r_lap_klik_ebtke";
		// }else if($data['ID_JENIS_LAPORAN'] == 5){
		// 	$table = "r_lap_klik_geologi";
		// }

		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_klik_migas";
			$table = "r_lap_klik_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_klik_negatif";
			// $table = "r_lap_klik_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_klik_gatrik";
			$table = "r_lap_klik_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_klik_ebtke";
			$table = "r_lap_klik_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_klik_geologi";
		// }
		

		unset($data["ID_JENIS_LAPORAN"]);
		$stat = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB"
		);
		$data = array_merge($data,$stat);
		$data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		
		$result = $this->M_klik->insert($data,$table);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal ditambahkan', '20px');
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['jenis'];
		// if($ID_JENIS_LAPORAN == 1){
		// 	$table = "r_lap_klik_migas";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_migas', 'form-update-draft-migas', $data);
		// }else if($ID_JENIS_LAPORAN == 2){
		// 	$table = "r_lap_klik_minerba";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_minerba', 'form-update-draft-minerba', $data);
		// }else if($ID_JENIS_LAPORAN == 3){
		// 	$table = "r_lap_klik_gatrik";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_gatrik', 'form-update-draft-gatrik', $data);
		// }else if($ID_JENIS_LAPORAN == 4){
		// 	$table = "r_lap_klik_ebtke";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_ebtke', 'form-update-draft-ebtke', $data);
		// }else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_klik_geologi";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_geologi', 'form-update-draft-geologi', $data);
		// }

		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_klik_hot_news";
			$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/klik/modal_update_draft_hot_news', 'form-update-draft-hot-news', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_klik_negatif";
			$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/klik/modal_update_draft_negatif', 'form-update-draft-negatif', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_klik_positif";
			$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/klik/modal_update_draft_positif', 'form-update-draft-positif', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_klik_netral";
			$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/klik/modal_update_draft_netral', 'form-update-draft-netral', $data);
		}//else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_klik_geologi";
		// 	$data['datanya'] = $this->M_klik->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/klik/modal_update_draft_geologi', 'form-update-draft-geologi', $data);
		// }


		
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

	public function post() {
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['ID_JENIS_LAPORAN'];
		$id_user = $this->session->userdata('userdata')->ID_USER;
		
		// if($ID_JENIS_LAPORAN == 1){
		// 	$table = "r_lap_klik_migas";
		// }else if($ID_JENIS_LAPORAN == 2){
		// 	$table = "r_lap_klik_minerba";
		// }else if($ID_JENIS_LAPORAN == 3){
		// 	$table = "r_lap_klik_gatrik";
		// }else if($ID_JENIS_LAPORAN == 4){
		// 	$table = "r_lap_klik_ebtke";
		// }else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_klik_geologi";
		// }

		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_klik_migas";
			$table = "r_lap_klik_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_klik_negatif";
			// $table = "r_lap_klik_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_klik_gatrik";
			$table = "r_lap_klik_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_klik_ebtke";
			$table = "r_lap_klik_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_klik_geologi";
		// }


		$result = $this->M_klik->post($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal diPosting', '20px');
		}
	}


	public function showBeforeDateMigas()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_migas')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDateHotNews()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_hot_news')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}


	public function showBeforeDateMinerba()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_minerba')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDateNegatif()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_negatif')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDateGatrik()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_gatrik')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDatePositif()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_positif')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}


	public function showBeforeDateEbtke()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_ebtke')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDateNetral()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_netral')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function showBeforeDateGeologi()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_klik_migas')
						  ->row_array();

		if($jenis = $query['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $query['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}				  
		// $data = array();
		echo json_encode(array(
			'berita' 	   => $query['BERITA'],
			'url'   => $query['URL'],
			'jenis'    		=> $jenis
		));
	}

	public function updateDraft()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_klik->prosesUpdateDraft($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftGeologi()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_klik->prosesUpdateDraftGeologi($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftEbtke()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_klik->prosesUpdateDraftEbtke($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftGatrik()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_klik->prosesUpdateDraftGatrik($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftMinerba()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_klik->prosesUpdateDraftMinerba($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function postAll(){
		
		$result = $this->M_klik->updateAllPost();
		//var_dump($result);die;
		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}

	public function prosesUploadMigas(){
        $config['upload_path'] = './uploads/';//base_url() . '/uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '100000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
        	echo json_encode(array('errorMsg'=>'Gagals Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['BERITA'] = $row['BERITA'];
                	$out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                	// $out['REKOMENDASI'] = $row['REKOMENDASI'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }public function prosesUploadMinerba(){
        $config['upload_path'] = './uploads/';//base_url() . '/uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '100000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
        	echo json_encode(array('errorMsg'=>'Gagals Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['BERITA'] = $row['BERITA'];
                	$out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }public function prosesUploadGatrik(){
        $config['upload_path'] = './uploads/';//base_url() . '/uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '100000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
        	echo json_encode(array('errorMsg'=>'Gagals Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['BERITA'] = $row['BERITA'];
                	$out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }public function prosesUploadEBTKE(){
        $config['upload_path'] = './uploads/';//base_url() . '/uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '100000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
        	echo json_encode(array('errorMsg'=>'Gagals Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['BERITA'] = $row['BERITA'];
                	$out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }public function prosesUploadGeologi(){
        $config['upload_path'] = './uploads/';//base_url() . '/uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '100000';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
        	echo json_encode(array('errorMsg'=>'Gagals Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['BERITA'] = $row['BERITA'];
                	$out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
}