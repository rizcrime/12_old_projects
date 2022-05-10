<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pusdatin extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_pusdatin');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "pusdatin";
		$data['judul'] 		= "Entry Laporan Pusdatin";
		$data['deskripsi'] 	= "Entry Laporan Pusdatin";
		$data['jenis_laporan'] = $this->M_pusdatin->select_all_jenis_laporan();
		$data['modal_add_gunung'] = show_my_modal('Admin/pusdatin/modal_view_all', 'tambah-gunung', $data);
		$this->template->views('Admin/pusdatin/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('Admin/Admin/list_data', $data);
	}
	
	public function show_form($ID_JENIS_LAPORAN="") {
		$this->load->view('Admin/pusdatin/modal_' . $ID_JENIS_LAPORAN);
	}
	
	public function show_form_draft($ID_JENIS_LAPORAN="") {
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_pusdatin_prod_minyak";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_pusdatin_icp";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_pusdatin_prod_gas";
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
		}else if($ID_JENIS_LAPORAN == 5){
			$table = "r_lap_pusdatin_lift_tb";
		}else if($ID_JENIS_LAPORAN == 6){
			$table = "r_lap_pusdatin_harga_bbm";
		}else if($ID_JENIS_LAPORAN == 7){
			$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		}else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		
		$data['dataSet'] = $this->M_pusdatin->select_by_jenis_draft($table);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/pusdatin/lap' . $ID_JENIS_LAPORAN, $data);
	}
	
	public function show_form_history($ID_JENIS_LAPORAN="",$TANGGAL_AWAL="",$TANGGAL_AKHIR="") {
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_pusdatin_prod_minyak";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_pusdatin_icp";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_pusdatin_prod_gas";
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
		}else if($ID_JENIS_LAPORAN == 5){
			$table = "r_lap_pusdatin_lift_tb";
		}else if($ID_JENIS_LAPORAN == 6){
			$table = "r_lap_pusdatin_harga_bbm";
		}else if($ID_JENIS_LAPORAN == 7){
			$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		}else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		
		$data['dataSet'] = $this->M_pusdatin->select_by_jenis_history($table,$TANGGAL_AWAL,$TANGGAL_AKHIR);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/pusdatin/his' . $ID_JENIS_LAPORAN, $data);
	}

	public function prosesTambah() {
		//$this->form_validation->set_rules('ID_JENIS_LAPORAN', 'ID_JENIS_LAPORAN', 'trim|required');

		$data = $this->input->post();
		
		if($data['ID_JENIS_LAPORAN'] == 1){
			$table = "r_lap_pusdatin_prod_minyak";
		}else if($data['ID_JENIS_LAPORAN'] == 2){
			$table = "r_lap_pusdatin_icp";
		}else if($data['ID_JENIS_LAPORAN'] == 3){
			$table = "r_lap_pusdatin_prod_gas";
		}else if($data['ID_JENIS_LAPORAN'] == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
		}else if($data['ID_JENIS_LAPORAN'] == 5){
			$table = "r_lap_pusdatin_lift_tb";
		}else if($data['ID_JENIS_LAPORAN'] == 6){
			$table = "r_lap_pusdatin_harga_bbm";
		}else if($data['ID_JENIS_LAPORAN'] == 7){
			$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		}else if($data['ID_JENIS_LAPORAN'] == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($data['ID_JENIS_LAPORAN'] == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($data['ID_JENIS_LAPORAN'] == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($data['ID_JENIS_LAPORAN'] == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		
		unset($data["ID_JENIS_LAPORAN"]);
		$stat = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB"
		);
		$data = array_merge($data,$stat);
		$data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		
		$result = $this->M_pusdatin->insert($data,$table);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal ditambahkan', '20px');
		}
		
		/*if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pusdatin->insert($data);

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
		}*/

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
		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_pusdatin_prod_minyak";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_pusdatin_icp";
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_pusdatin_prod_gas";
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
		}else if($ID_JENIS_LAPORAN == 5){
			$table = "r_lap_pusdatin_lift_tb";
		}else if($ID_JENIS_LAPORAN == 6){
			$table = "r_lap_pusdatin_harga_bbm";
		}else if($ID_JENIS_LAPORAN == 7){
			$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		}else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		$result = $this->M_pusdatin->post($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal diPosting', '20px');
		}
	}


	public function showBeforeDateProdMinyak()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_prod_minyak')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'prod_harian' 	 => $query['PROD_HARIAN'],
			'prod_bulanan'   => $query['PROD_BULANAN'],
			'prod_tahunan'    	 => $query['PROD_TAHUNAN'],
			'apbn' => $query['APBN']
			// 'aktivitas'    => $query['LEVEL'],
			// 'rekomendasi'    => $query['REKOMENDASI'],
			// 'vona'    	   => $query['VONA'],
			// 'detail'       => $query['DETAIL']
			// 'informasi' => $query['INFORMASI'],
			// 'kondisi_dt' => $query['KONDISI_GEOLOGI_DT'],
			// 'penyebab_gempa' => $query['PENYEBAB_GEMPA'],
			// 'dampak_gempa' => $query['DAMPAK_GEMPA'],
			// 'rekomendasi' => $query['REKOMENDASI']
		));
	}

	public function showBeforeDateICP()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_icp')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'keterangan' => $query['KETERANGAN']
			// 'informasi' => $query['INFORMASI'],
			// 'kondisi_dt' => $query['KONDISI_GEOLOGI_DT'],
			// 'penyebab_gempa' => $query['PENYEBAB_GEMPA'],
			// 'dampak_gempa' => $query['DAMPAK_GEMPA'],
			// 'rekomendasi' => $query['REKOMENDASI']
		));
	}

	public function showBeforeDateHargaBBM()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_harga_bbm')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			//'liftmb' 	 => $query['JENIS_TERTENTU'],
			'bbm_umum'   				=> $query['BBM_UMUM'],
			//'salurgas'    	 			=> $query['SALUR_GAS'],
			'jenis_tertentu'  			=> $query['JENIS_TERTENTU'],
			'indonesia_satu_harga'    	 => $query['PROG_IND_SATU_HRG'],
			'harga_per_negara'    	 => $query['HARGA_PERNEGARA']
			
		));
	}



	public function showBeforeDateProgJamali()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_prog_peny_prem_jamali')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			//'liftmb' 	 => $query['JENIS_TERTENTU'],
			'progres'   		=> $query['PROGRES'],
			//'salurgas'    	 			=> $query['SALUR_GAS'],
			'catatan'  			=> $query['CATATAN']
			
		));
	}
	
	

	
	public function showBeforeDateBBAcuan()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_harga_bb_acuan')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			// $('input[name="HARGA"]').val(response.harga);
			// $('textarea[name="SUMBER"]').val(response.sumber);
			'harga' => $query['HARGA'],
			'sumber' => $query['SUMBER']
		));
	}


	public function showBeforeDateMineralAcuan()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_harga_mineral_acuan')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			// $('input[name="HARGA"]').val(response.harga);
			// $('textarea[name="SUMBER"]').val(response.sumber);
			'harga' => $query['HARGA'],
			'sumber' => $query['SUMBER']
		));
	}


	public function showBeforeDateStatusGatrik()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_pusdatin_stts_tl')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			// $('input[name="HARGA"]').val(response.harga);
			// $('textarea[name="SUMBER"]').val(response.sumber);
			'status' => $query['STATUS']
		));
	}
		

	


}