<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_geologi extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_geologi');
        $this->load->library('Csvimport');
	}
	
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->M_geologi->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$csvreader = PHPExcel_IOFactory::createReader('CSV');
				$loadcsv = $csvreader->load('csv/'.$this->filename.'.csv'); // Load file yang tadi diupload ke folder csv
				$sheet = $loadcsv->getActiveSheet()->getRowIterator();
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam csv yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->load->view('Admin/geologi/form', $data);
		
		//$this->template->views('Admin/geologi/home', $data);
	}
	
	public function importData(){

		//echo "test";die();
		$fileName = $_FILES['file']['name'];

		$config['upload_path'] = FCPATH.'./assets/import'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = $this->upload->data('full_path');;
	
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){            
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data []= array(
					'kolom1'=>$rowData[0][0],
					'kolom2'=>$rowData[0][1],
					'kolom3'=>$rowData[0][2]
					
                );
			}

			//Contoh yg di lempar di view
			//Kolom1 itu id 
			//$rowData[0][0] = Kolom excel pertama dan paling pertama (pojok kiri atas)
			// foreach($data as $r){
			// 	echo "Kolom 1 : ".$r['kolom1']. " NO INVOICE".$r['kolom2'] . "\n";
			// }
			echo json_encode($data);
			// $this->load->view('Admin/geologi/form', $data);
			// exit;
            // $this->db->insert_batch('main_table', $data);
	}


	/*public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$csvreader = PHPExcel_IOFactory::createReader('CSV');
		$loadcsv = $csvreader->load('csv/'.$this->filename.'.csv'); // Load file yang tadi diupload ke folder csv
		$sheet = $loadcsv->getActiveSheet()->getRowIterator();
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// START -->
				// Skrip untuk mengambil value nya
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
				
				$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
				foreach ($cellIterator as $cell) {
					array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
				}
				// <-- END
				
				// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
				$nis = $get[0]; // Ambil data NIS dari kolom A di csv
				$nama = $get[1]; // Ambil data nama dari kolom B di csv
				$jenis_kelamin = $get[2]; // Ambil data jenis kelamin dari kolom C di csv
				$alamat = $get[3]; // Ambil data alamat dari kolom D di csv
				
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'nis'=>$nis, // Insert data nis
					'nama'=>$nama, // Insert data nama
					'jenis_kelamin'=>$jenis_kelamin, // Insert data jenis kelamin
					'alamat'=>$alamat, // Insert data alamat
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->SiswaModel->insert_multiple($data);
		
		redirect("Siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}*/

	

	public function index() {
		$data['userdata'] 	= $this->userdata;

		$data['page'] 		= "geologi";
		$data['judul'] 		= "Entry Laporan Geologi";
		$data['deskripsi'] 	= "Entry Laporan Geologi";
		$data['jenis_laporan'] = $this->M_geologi->select_all_jenis_laporan();
		
		$data['modal_add_gunung'] = show_my_modal('Admin/geologi/modal_view_all', 'tambah-gunung', $data);

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
		$ID_JENIS_LAPORAN = $_POST['jenis'];
		//$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['dataRole'] = $this->M_role->select_all();
//		$data['admin']	= $this->M_admin->select_by_id($id);		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_geologi_gunung_api";
			$data['dataLevel'] = $this->M_geologi->select_all_level();
			$data['datanya'] = $this->M_geologi->select_gunung_api($id,$table);
			echo show_my_modal('Admin/geologi/modal_update_draft_gunungapi', 'form-update-draft-gunungapi', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah";
			$data['datanya'] = $this->M_geologi->select_gerakan_tanah($id,$table);
			echo show_my_modal('Admin/geologi/modal_update_draft_gerakantanah', 'form-update-draft-gerakantanah', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi";
			$data['datanya'] = $this->M_geologi->select_gempa_bumi($id,$table);
			echo show_my_modal('Admin/geologi/modal_update_draft_gempabumi', 'form-update-draft-gempabumi', $data);
		}

		// echo show_my_modal('Admin/geologi/modal_update_draft_gunungapi', 'form-update-draft-gunungapi', $data);				
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

	public function showBeforeDateGerakanTanah()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('KETERANGAN, DETAIL')
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_geologi_gerakan_tanah')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'keterangan' => $query['KETERANGAN'],
			'detail' => $query['DETAIL'],
		));
	}


	public function showBeforeDateGempaBumi()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_geologi_gempa_bumi')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'lokasi' => $query['LOKASI'],
			'informasi' => $query['INFORMASI'],
			'kondisi_dt' => $query['KONDISI_GEOLOGI_DT'],
			'penyebab_gempa' => $query['PENYEBAB_GEMPA'],
			'dampak_gempa' => $query['DAMPAK_GEMPA'],
			'rekomendasi' => $query['REKOMENDASI']
		));
	}



	public function showBeforeDateGunungApi()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_geologi_gunung_api.ID_GUNUNG","LEFT")
						  ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_geologi_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->limit(1)
						  ->get('r_lap_geologi_gunung_api')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'gunung' 	   => $query['NAMA_GUNUNG'],
			'keterangan'   => $query['KETERANGAN'],
			'id_gunung'    => $query['ID_GUNUNG'],
			'id_aktivitas' => $query['ID_AKTIVITAS'],
			'aktivitas'    => $query['LEVEL'],
			'rekomendasi'    => $query['REKOMENDASI'],
			'vona'    	   => $query['VONA'],
			'detail'       => $query['DETAIL']
			// 'informasi' => $query['INFORMASI'],
			// 'kondisi_dt' => $query['KONDISI_GEOLOGI_DT'],
			// 'penyebab_gempa' => $query['PENYEBAB_GEMPA'],
			// 'dampak_gempa' => $query['DAMPAK_GEMPA'],
			// 'rekomendasi' => $query['REKOMENDASI']
		));
	}

	public function updateDraftGunungApi()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_geologi->prosesUpdateDraftGunung($dataUpdate);
		
		// echo json_encode(array(
		// 	'message' => 'berhasil'
		// ));
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftGerakanTanah()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_geologi->prosesUpdateDraftGerakanTanah($dataUpdate);
		
		// echo json_encode(array(
		// 	'message' => 'berhasil'
		// ));
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diedit', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal diedit', '20px');
		}

		echo json_encode($out);
	}

	public function updateDraftGempaBumi()
	{	
		$dataUpdate = $this->input->post();
		$query = $this->M_geologi->prosesUpdateDraftGempaBumi($dataUpdate);
		
		// echo json_encode(array(
		// 	'message' => 'berhasil'
		// ));
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
		
		$result = $this->M_geologi->updateAllPost();

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}
    
    public function prosesUploadGunungApi(){
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
                	$out['ID_GUNUNG'] = $row['ID_GUNUNG'];
                	$out['ID_AKTIVITAS'] = $row['ID_AKTIVITAS'];
                	$TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['KETERANGAN'] = $row['KETERANGAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['REKOMENDASI'] = $row['REKOMENDASI'];
                   
                	
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    //$out['VONA'] = "test";//$row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    $out['VONA'] = str_replace(',', '', $row['VONA']);
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }

    public function prosesUploadGerakanTanah(){
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
                	
                	$out['KETERANGAN'] = $row['KETERANGAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['DETAIL'] = $row['DETAIL'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadGempaBumi(){
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
                	$out['LOKASI'] = $row['LOKASI'];
                	$out['REKOMENDASI'] = $row['REKOMENDASI'];
                	// $TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['KONDISI_GEOLOGI_DT'] = $row['KONDISI_GEOLOGI_DT'];
                
                	$out['INFORMASI'] = $row['INFORMASI'];
                	$out['DAMPAK_GEMPA'] = $row['DAMPAK_GEMPA'];
                	$out['PENYEBAB_GEMPA'] = $row['PENYEBAB_GEMPA'];
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
}

