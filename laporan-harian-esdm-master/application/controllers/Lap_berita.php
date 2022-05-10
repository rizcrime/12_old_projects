<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_berita extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_berita');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "berita";
		$data['judul'] 		= "Entry Laporan berita";
		$data['deskripsi'] 	= "Entry Laporan berita";
		$data['jenis_laporan'] = $this->M_berita->select_all_jenis_laporan();
		$data['modal_add_gunung'] = show_my_modal('Admin/berita/modal_view_all', 'tambah-gunung', $data);
		$data['modal_view_all'] = show_my_modal('Admin/berita/modal_view_all', 'view-all', $data);
		// $data['modal_view_all_has_review'] = show_my_modal('Admin/berita/modal_view_all_has_review', 'view-all-has-review', $data);
		// $data['modal_view_all_has_unposting'] = show_my_modal('Admin/berita/modal_view_all_has_unposting', 'view-all-has-unposting', $data);
		// $data['modal_view_all_kapus'] = show_my_modal('Admin/berita/modal_view_all_kapus', 'view-all-kapus', $data);
			
		// $data['modal_review_all'] = show_my_modal('Admin/berita/modal_review_all', 'review-all', $data);
		// $data['modal_view_all_has_unposting'] = show_my_modal('Admin/berita/modal_view_all_has_unposting', 'view-all-has-unposting', $data);
//		$data['modal_view_all_kapus'] = show_my_modal('Admin/berita/modal_view_all_kapus', 'view-all-kapus', $data);
		$this->template->views('Admin/berita/home', $data);
	}

	public function tampil() {
		$data['dataAdmin'] = $this->M_admin->select_all();
		$this->load->view('Admin/Admin/list_data', $data);
	}
	
	public function show_form($ID_JENIS_LAPORAN="") {
		// $data['jenis_berita'] = $this->M_berita->select_all_jenis_berita();
		$this->load->view('Admin/berita/modal_' . $ID_JENIS_LAPORAN);
	}
	
	public function show_form_draft($ID_JENIS_LAPORAN="") {
		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_berita_migas";
			$table = "r_lap_berita_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			// $table = "r_lap_berita_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_berita_gatrik";
			$table = "r_lap_berita_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_berita_ebtke";
			$table = "r_lap_berita_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_berita_geologi";
		// }
		
		$data['dataSet'] = $this->M_berita->select_by_jenis_draft($table);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;

		$data['dataEntry'] = $this->M_berita->select_by_jenis_draft_entry($table);
		$data['dataHasReview'] = $this->M_berita->select_by_jenis_draft_has_review($table);
		// $id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$data['IS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->IS_REVIEW;
		$data['IS_ENTRY'] = $this->M_admin->select_user_is_post($id_user)->IS_ENTRY;
		$this->load->view('Admin/berita/lap' . $ID_JENIS_LAPORAN, $data);
	}
	
	public function show_form_history($ID_JENIS_LAPORAN="",$TANGGAL_AWAL="",$TANGGAL_AKHIR="") {
	
		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_berita_migas";
			$table = "r_lap_berita_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			// $table = "r_lap_berita_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_berita_gatrik";
			$table = "r_lap_berita_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_berita_ebtke";
			$table = "r_lap_berita_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_berita_geologi";
		// }
		
		$data['dataSet'] = $this->M_berita->select_by_jenis_history($table,$TANGGAL_AWAL,$TANGGAL_AKHIR);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$this->load->view('Admin/berita/his' . $ID_JENIS_LAPORAN, $data);
	}

	public function prosesTambah() {
		//$this->form_validation->set_rules('ID_JENIS_LAPORAN', 'ID_JENIS_LAPORAN', 'trim|required');

		$data = $this->input->post();
	
		if($data['ID_JENIS_LAPORAN'] == 1){
			$table = "r_lap_berita_hot_news";
		}else if($data['ID_JENIS_LAPORAN'] == 2){
			$table = "r_lap_berita_negatif";
		}else if($data['ID_JENIS_LAPORAN'] == 3){
			$table = "r_lap_berita_positif";
		}else if($data['ID_JENIS_LAPORAN'] == 4){
			$table = "r_lap_berita_netral";
		}else if($data['ID_JENIS_LAPORAN'] == 5){
			$table = "r_lap_berita_geologi";
		}
		

		unset($data["ID_JENIS_LAPORAN"]);
		$stat = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			'IMAGE' => $this->image = $this->_uploadImage()
		);
		$data = array_merge($data,$stat);
		$data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		// $this->image = $this->_uploadImage();
        
		$result = $this->M_berita->insert($data,$table);
		 // var_dump($result);die;	

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


		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_berita_hot_news";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_update_draft_hot_news', 'form-update-draft-hot-news', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_update_draft_negatif', 'form-update-draft-negatif', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_berita_positif";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_update_draft_positif', 'form-update-draft-positif', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_berita_netral";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_update_draft_netral', 'form-update-draft-netral', $data);
		}//else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_berita_geologi";
		// 	$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/berita/modal_update_draft_geologi', 'form-update-draft-geologi', $data);
		// }


		
	}


	public function review() {
		$data['userdata'] 	= $this->userdata;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['jenis'];


		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_berita_hot_news";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_review_draft_hot_news', 'form-review-draft-hot-news', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_review_draft_negatif', 'form-review-draft-negatif', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_berita_positif";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_review_draft_positif', 'form-review-draft-positif', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_berita_netral";
			$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
			echo show_my_modal('Admin/berita/modal_review_draft_netral', 'form-review-draft-netral', $data);
		}//else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_berita_geologi";
		// 	$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/berita/modal_update_draft_geologi', 'form-update-draft-geologi', $data);
		// }


		
	}

	public function delete() {
		// $data['userdata'] 	= $this->userdata;
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['ID_JENIS_LAPORAN'];
		// var_dump($ID_JENIS_LAPORAN);die;
		

		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_berita_hot_news";
			// $data['datanya'] = $this->M_berita->delete($id,$table);
			// echo show_my_modal('Admin/berita/modal_update_draft_hot_news', 'form-update-draft-hot-news', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			// $data['datanya'] = $this->M_berita->delete($id,$table);
			// echo show_my_modal('Admin/berita/modal_update_draft_negatif', 'form-update-draft-negatif', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_berita_positif";
			// $data['datanya'] = $this->M_berita->delete($id,$table);
			// echo show_my_modal('Admin/berita/modal_update_draft_positif', 'form-update-draft-positif', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_berita_netral";
			// $data['datanya'] = $this->M_berita->delete($id,$table);
			// echo show_my_modal('Admin/berita/modal_update_draft_netral', 'form-update-draft-netral', $data);
		}//else if($ID_JENIS_LAPORAN == 5){
		// 	$table = "r_lap_berita_geologi";
		// 	$data['datanya'] = $this->M_berita->select_by_id_draft($id,$table);
		// 	echo show_my_modal('Admin/berita/modal_update_draft_geologi', 'form-update-draft-geologi', $data);
		// }
		$result = $this->M_berita->delete($table, $id, $id_user);	

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil di Delete', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal di Delete', '20px');
		}	


		
	}

	private function _uploadImage()
	{
		$config['upload_path']          = './image_upload/berita/';
		$config['allowed_types']        = 'gif|jpg|png';
		// $config['file_name']            = $_FILES['userfile'];
		$config['overwrite']			= true;
		$config['max_size']             = '10000'; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('userfile')) {
			return $this->upload->data("file_name");
		}
		
		// return "default.jpg";
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
			//$table = "r_lap_berita_migas";
			$table = "r_lap_berita_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			// $table = "r_lap_berita_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_berita_gatrik";
			$table = "r_lap_berita_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_berita_ebtke";
			$table = "r_lap_berita_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_berita_geologi";
		// }


		$result = $this->M_berita->post($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal diPosting', '20px');
		}
	}

	public function hasreview() {
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['ID_JENIS_LAPORAN'];
		$id_user = $this->session->userdata('userdata')->ID_USER;

		if($ID_JENIS_LAPORAN == 1){
			//$table = "r_lap_berita_migas";
			$table = "r_lap_berita_hot_news";
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_berita_negatif";
			// $table = "r_lap_berita_minerba";
		}else if($ID_JENIS_LAPORAN == 3){
			// $table = "r_lap_berita_gatrik";
			$table = "r_lap_berita_positif";
		}else if($ID_JENIS_LAPORAN == 4){
			// $table = "r_lap_berita_ebtke";
			$table = "r_lap_berita_netral";
		 }//else if($ID_JENIS_LAPORAN == 5){
		// 	// $table = "r_lap_berita_geologi";
		// }


		$result = $this->M_berita->hasreview($table, $id, $id_user);

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
						  ->get('r_lap_berita_migas')
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
						  ->get('r_lap_berita_hot_news')
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
			'url'   => $query['URL']
			// 'jenis'    		=> $jenis
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
						  ->get('r_lap_berita_minerba')
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
						  ->get('r_lap_berita_negatif')
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
			'url'   => $query['URL']
			// 'jenis'    		=> $jenis
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
						  ->get('r_lap_berita_gatrik')
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
						  ->get('r_lap_berita_positif')
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
			'url'   => $query['URL']
			// 'jenis'    		=> $jenis
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
						  ->get('r_lap_berita_ebtke')
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
						  ->get('r_lap_berita_netral')
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
			'url'   => $query['URL']
			// 'jenis'    		=> $jenis
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
						  ->get('r_lap_berita_migas')
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

	public function updateDraftHotNews()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesUpdateDraftHotNews($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function reviewDraftHotNews()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesReviewDraftHotNews($dataReview);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}
	public function updateDraftNegatif()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesUpdateDraftNegatif($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function reviewDraftNegatif()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesReviewDraftNegatif($dataReview);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}
	public function updateDraftPositif()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesUpdateDraftPositif($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function reviewDraftPositif()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesReviewDraftPositif($dataReview);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}
	public function updateDraftNetral()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesUpdateDraftNetral($dataUpdate);
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function reviewDraftNetral()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_berita->prosesReviewDraftNetral($dataReview);
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
		$query = $this->M_berita->prosesUpdateDraftGeologi($dataUpdate);
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
		$query = $this->M_berita->prosesUpdateDraftEbtke($dataUpdate);
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
		$query = $this->M_berita->prosesUpdateDraftGatrik($dataUpdate);
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
		$query = $this->M_berita->prosesUpdateDraftMinerba($dataUpdate);
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
		
		$result = $this->M_berita->updateAllPost();
		//var_dump($result);die;
		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}

	public function prosesUploadMinerba(){
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
    public function prosesUploadPositif(){
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
                	// $out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }

     public function prosesUploadNegatif(){
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
                	// $out['JENIS'] = $row['JENIS'];
                	$out['URL'] = $row['URL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }

    public function prosesUploadGatrik(){
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
	
	public function upload_all_excel()
    {
    	if ($_FILES['file']['name']) {
			$fileName = time().$_FILES['file']['name'];

			$config['upload_path'] = FCPATH .'uploads';
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size'] = 10000;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file') )
			$this->upload->display_errors();

			$media = $this->upload->data('file');
			$inputFileName = $this->upload->data('full_path');

			try {
				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			//Gunung Api
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

				$data = array(
					'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
					'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
					'FLATFORM_ENTRY' => "WEB",
					"TANGGAL_LAPORAN" => $tanggal_laporan,
					"BERITA"=> $rowData[0][0],
					"URL"=> $rowData[0][1],
					
				);

				$insert = $this->db->insert("r_lap_berita_hot_news",$data);				
				
			}

			//Gerakan Tanah
			$sheet_2 = $objPHPExcel->getSheet(1);
			$highestRow = $sheet_2->getHighestRow();
			$highestColumn = $sheet_2->getHighestColumn();

			for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
				$rowData_2 = $sheet_2->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

				$data_2 = array(
					'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
					'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
					'FLATFORM_ENTRY' => "WEB",
					"TANGGAL_LAPORAN" => $tanggal_laporan,
					"BERITA"=> $rowData_2[0][0],
					"URL"=> $rowData_2[0][1]

					  
				);

				$insert = $this->db->insert("r_lap_berita_negatif",$data_2);
				
			}

			//Gempa Bumi
			$sheet_3 = $objPHPExcel->getSheet(2);
			$highestRow = $sheet_3->getHighestRow();
			$highestColumn = $sheet_3->getHighestColumn();

			for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
				$rowData_3 = $sheet_3->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

				$data_3 = array(
					'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
					'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
					'FLATFORM_ENTRY' => "WEB",
					"TANGGAL_LAPORAN" => $tanggal_laporan,
					"BERITA"=> $rowData_3[0][0],
					"URL"=> $rowData_3[0][1],
					
				);

				$insert = $this->db->insert("r_lap_berita_positif",$data_3);				
			}	
				//netral
		$sheet_4 = $objPHPExcel->getSheet(2);
		$highestRow = $sheet_4->getHighestRow();
		$highestColumn = $sheet_4->getHighestColumn();

		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
			$rowData_4 = $sheet_4->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

			$data_4 = array(
				'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
				'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
				'FLATFORM_ENTRY' => "WEB",
				"TANGGAL_LAPORAN" => $tanggal_laporan,
				"BERITA"=> $rowData_3[0][0],
				"URL"=> $rowData_3[0][1],
				
			);

			$insert = $this->db->insert("r_lap_berita_netral",$data_4);				
		}	
			unlink($inputFileName);
			$this->session->set_flashdata('sukses',"Data Berhasil Diimpor");
			redirect('Lap_berita');
		} else {
			$this->session->set_flashdata('error',"Masukkan file dahulu");
			redirect('Lap_berita');
		}
		
	} 	
	
	function downloadFileTextHotNews($id){

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_berita_hot_news');

		foreach($fields->result() as $field)	
		{
		
		   $berita = $field->BERITA;
		   $url = $field->URL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		}

		$dataBerita = "Berita : ".$berita."\r\n";
		$dataUrl = "Url : ".$url."\r\n";

		
		echo "Berikut dengan hormat kami laporkan Status Berita per Tanggal $tanggal_laporan :\r\n";
		
		echo " \r\n";
		echo $dataBerita;
		echo $dataUrl;
	
        header('Content-Disposition: attachment; filename=DraftHotNews_Lap'.$id.'.txt');
        header('Expires: 0');
    
	}

	function downloadFileTextNegatif($id){

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_berita_negatif');

		foreach($fields->result() as $field)	
		{
		
		   $berita = $field->BERITA;
		   $url = $field->URL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		}

		$dataBerita = "Berita : ".$berita."\r\n";
		$dataUrl = "Url : ".$url."\r\n";

		
		echo "Berikut dengan hormat kami laporkan Status Negatif per Tanggal $tanggal_laporan :\r\n";
		
		echo " \r\n";
		echo $dataBerita;
		echo $dataUrl;
	
        header('Content-Disposition: attachment; filename=DrafNegatif_Lap'.$id.'.txt');
        header('Expires: 0');
    
	}

	function downloadFileTextPositif($id){

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_berita_positif');

		foreach($fields->result() as $field)	
		{
		
		   $berita = $field->BERITA;
		   $url = $field->URL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		}

		$dataBerita = "Berita : ".$berita."\r\n";
		$dataUrl = "Url : ".$url."\r\n";

		
		echo "Berikut dengan hormat kami laporkan Status Positif per Tanggal $tanggal_laporan :\r\n";
		
		echo " \r\n";
		echo $dataBerita;
		echo $dataUrl;
	
        header('Content-Disposition: attachment; filename=DrafPositif_Lap'.$id.'.txt');
        header('Expires: 0');
    
	}

	function downloadFileTextNetral($id){

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_berita_netral');

		foreach($fields->result() as $field)	
		{
		
		   $berita = $field->BERITA;
		   $url = $field->URL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		}

		$dataBerita = "Berita : ".$berita."\r\n";
		$dataUrl = "Url : ".$url."\r\n";

		
		echo "Berikut dengan hormat kami laporkan Status Netral per Tanggal $tanggal_laporan :\r\n";
		
		echo " \r\n";
		echo $dataBerita;
		echo $dataUrl;
	
        header('Content-Disposition: attachment; filename=DrafNetral_Lap'.$id.'.txt');
        header('Expires: 0');
    
	}

}