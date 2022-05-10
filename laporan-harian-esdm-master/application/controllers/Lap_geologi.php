<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_geologi extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_geologi');
        $this->load->library('Csvimport');
        $this->load->library('excel');
	    $this->load->helper('form'); // untuk menangani proses form 

		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
		
		$id_user = $this->session->userdata('userdata')->ID_USER;


		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$data['IS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->IS_REVIEW;
		$data['IS_ENTRY'] = $this->M_admin->select_user_is_post($id_user)->IS_ENTRY;	
		$data['READY_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->READY_REVIEW;	
		$data['HAS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->HAS_REVIEW;	
		
		$data['READY_POST'] = $this->M_admin->select_user_is_post($id_user)->READY_POST;	
		$data['HAS_POST'] = $this->M_admin->select_user_is_post($id_user)->HAS_POST;	
		$data['HAS_UNPOST'] = $this->M_admin->select_user_is_post($id_user)->HAS_UNPOST;	

		$data['modal_view_all'] = show_my_modal('Admin/geologi/modal_view_all', 'view-all', $data);
		$data['modal_view_all_has_review'] = show_my_modal('Admin/geologi/modal_view_all_has_review', 'view-all-has-review', $data);
		// $data['modal_view_all_has_unposting'] = show_my_modal('Admin/geologi/modal_view_all_has_unposting', 'view-all-has-unposting', $data);
		// $data['modal_view_all_kapus'] = show_my_modal('Admin/geologi/modal_view_all_kapus', 'view-all-kapus', $data);
			
		$data['modal_review_all'] = show_my_modal('Admin/geologi/modal_review_all', 'review-all', $data);


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
		
		$data['gunungSet'] = $this->M_geologi->select_all_gunung();
		$data['aktivitasSet'] = $this->M_geologi->select_all_aktivitas();
		$data['dataSet'] = $this->M_geologi->select_by_jenis_draft($table,$select,$join);
		// $id_user = $this->session->userdata('userdata')->ID_USER;
		// $data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		// $this->load->view('Admin/geologi/lap' . $ID_JENIS_LAPORAN, $data);



		// $data['dataSet'] = $this->M_geologi->select_by_jenis_draft($table);
		$data['dataEntry'] = $this->M_geologi->select_by_jenis_draft_entry($table,$select,$join);
		$data['dataHasReview'] = $this->M_geologi->select_by_jenis_draft_has_review($table,$select,$join);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$data['IS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->IS_REVIEW;
		$data['IS_ENTRY'] = $this->M_admin->select_user_is_post($id_user)->IS_ENTRY;
		$this->load->view('Admin/geologi/lap' . $ID_JENIS_LAPORAN, $data);
	}



	public function downloadFileText(){
        // $yourFile = "Sample-CSV-Format.txt";
        // $file = @fopen($yourFile, "rb");
        // // $file = 'asdas';
  //       $data['userdata'] 	= $this->userdata;
		// $id = $_POST['id'];
		// $ID_JENIS_LAPORAN = $_POST['jenis'];

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

		      	// $fields = $this->db->get('r_lap_pusdatin_prod_minyak');
      	$pusdatin = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");

      	$icp = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$prod_gas = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$ekui_migas = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$lift_tb = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$harga_bbm = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$berita_opec = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$bb_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$mineral_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");
      	$stts_tl = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NULL AND TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");

    //  	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_prod_minyak');
    
      	//$fields = $this->db->query('select * from r_lap_pusdatin_prod_minyak where ID_LAPORAN = 35');
		// $this->db->where('ID_LAPORAN', $id);
      	
      	//echo $text;
      	// foreach ($dataGunung->result_array() as $row)
		// foreach ($fields as $field)

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo " \r\n";
		echo "\x20\x20\x20";  
		echo "Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas\r\n";
  		echo "Bumi, Lifting, ICP, Harga BBM, Premium Reborn, Mineral dan Batubara\r\n";
  		echo "serta Ketenagalistrikan, per Tanggal :\r\n";
  		echo "\r\n";
		// echo "\t Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas \r\n";
		// echo "Bumi per Tanggal $tanggal_laporan : \r\n";
	


		if ($pusdatin->num_rows() > 0)
		{
			foreach($pusdatin->result() as $pusdatin_field)	
				{
			  		$pusdatin_harian = $pusdatin_field->PROD_HARIAN;
			  		$pusdatin_bulananan = $pusdatin_field->PROD_BULANAN;
			  		$pusdatin_tanggal_laporan = $pusdatin_field->TANGGAL_LAPORAN;
			   		$pusdatin_tahunan = $pusdatin_field->PROD_TAHUNAN;
			   		$pusdatin_apbn = $pusdatin_field->APBN;

			   			///PROD MINYAK
						$pusdatin_prodharian = 	"Produksi Harian  : ".$pusdatin_harian." BOPD \r\n";
						$pusdatin_prodbulanan = "Produksi Bulanan : ".$pusdatin_bulananan." BOPD \r\n";
						$pusdatin_prodtahunan = "Produksi Tahunan : ".$pusdatin_tahunan." BOPD \r\n";
						$pusdatin_targetapbn = 	"APBN : ".$pusdatin_apbn." BOPD \r\n";

						echo "1. PRODUKSI MINYAK \r\n";
						// echo "\x20\x20\x20";
						echo $pusdatin_prodharian;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodbulanan;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodtahunan;
						// echo "\x20\x20\x20";
						echo $pusdatin_targetapbn;
						echo " \r\n";	


				}
		}		
		else {


						$pusdatin_prodharian = 	"Produksi Harian  : BOPD \r\n";
						$pusdatin_prodbulanan = "Produksi Bulanan : BOPD \r\n";
						$pusdatin_prodtahunan = "Produksi Tahunan : BOPD \r\n";
						$pusdatin_targetapbn = 	"APBN : BOPD \r\n";

						echo "1. PRODUKSI MINYAK \r\n";
						// echo "\x20\x20\x20";
						echo $pusdatin_prodharian;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodbulanan;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodtahunan;
						// echo "\x20\x20\x20";
						echo $pusdatin_targetapbn;
						echo " \r\n";	

		}

		if ($icp->num_rows() > 0)
		{
			
				foreach($icp->result() as $icp_field)	
				{
				
				   $icp_keterangan = $icp_field->KETERANGAN;
				   ///ICP
				   echo "2. ICP \r\n";	
				   echo "Keterangan : \r\n";
				   echo $icp_keterangan."\r\n";
				   echo "\r\n";
				}


		}		
		else {
					echo "2. ICP \r\n";	
					echo "Keterangan : \r\n";
				   echo "\r\n";

		}	

		if ($prod_gas->num_rows() > 0)
		{
			
				foreach($prod_gas->result() as $prod_gas_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   	$prod_gas_harian = $prod_gas_field->PROD_HARIAN;
			   		$prod_gas_bulananan = $prod_gas_field->PROD_BULANAN;
			   		$prod_gas_tanggal_laporan = $prod_gas_field->TANGGAL_LAPORAN;
			   		$prod_gas_tahunan = $prod_gas_field->PROD_TAHUNAN;
			   		$prod_gas_apbn = $prod_gas_field->APBN;

			   			$prod_gas_prodharian = 	"Produksi Harian  : ".$prod_gas_harian." MMSCFD \r\n";
						$prod_gas_prodbulanan = "Produksi Bulanan : ".$prod_gas_bulananan." MMSCFD \r\n";
						$prod_gas_prodtahunan = "Produksi Tahunan : ".$prod_gas_tahunan." MMSCFD \r\n";
						$prod_gas_apbn 		  = "APBN : ".$prod_gas_apbn." MMSCFD \r\n";

				   	echo "3. PRODUKSI GAS \r\n";
					// echo "\x20\x20\x20";
					echo $prod_gas_prodharian ;
					// echo "\x20\x20\x20";
					echo $prod_gas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $prod_gas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $prod_gas_apbn 	   ;
				   echo "\r\n";

				}


		}		
		else {

						$prod_gas_prodharian = 	"Produksi Harian  : MMSCFD \r\n";
						$prod_gas_prodbulanan = "Produksi Bulanan : MMSCFD \r\n";
						$prod_gas_prodtahunan = "Produksi Tahunan : MMSCFD \r\n";
						$prod_gas_apbn 		  = "APBN : MMSCFD \r\n";


							echo "3. PRODUKSI GAS \r\n";
							// echo "\x20\x20\x20";
							echo $prod_gas_prodharian ;
							// echo "\x20\x20\x20";
							echo $prod_gas_prodbulanan ;
							// echo "\x20\x20\x20";
							echo $prod_gas_prodtahunan ;
							// echo "\x20\x20\x20";
							echo $prod_gas_apbn 	   ;
				   echo "\r\n";


		}	


	
		// }    
        // header('Content-Disposition: attachment; filename=DraftProduksiMinyak_'.$id.'.txt');
        header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin.txt');
    
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
	}



	public function downloadFileTextAllKapus(){
        // $yourFile = "Sample-CSV-Format.txt";
        // $file = @fopen($yourFile, "rb");
        // // $file = 'asdas';
  //       $data['userdata'] 	= $this->userdata;
		// $id = $_POST['id'];
		// $ID_JENIS_LAPORAN = $_POST['jenis'];

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

		      	// $fields = $this->db->get('r_lap_pusdatin_prod_minyak');
      	$pusdatin = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL
   				 AND
                PROD_HARIAN != 0 AND PROD_HARIAN IS NOT NULL
                AND
                PROD_BULANAN != 0 AND PROD_BULANAN IS NOT NULL
                AND
                PROD_TAHUNAN  != 0 AND PROD_TAHUNAN IS NOT NULL  
                AND
                APBN  != 0 AND APBN IS NOT NULL
   				and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%' ");

      	$icp = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL	and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$prod_gas = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL
	and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$ekui_migas = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$lift_tb = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$harga_bbm = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$berita_opec = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$bb_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$mineral_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
      	$stts_tl = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NOT NULL AND USER_POST IS NOT NULL  AND TANGGAL_POST IS NOT NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");

    //  	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_prod_minyak');
    
      	//$fields = $this->db->query('select * from r_lap_pusdatin_prod_minyak where ID_LAPORAN = 35');
		// $this->db->where('ID_LAPORAN', $id);
      	
      	//echo $text;
      	// foreach ($dataGunung->result_array() as $row)
		// foreach ($fields as $field)

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo " \r\n";
		echo "\x20\x20\x20";  
		echo "Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas\r\n";
  		echo "Bumi, Lifting, ICP, Harga BBM, Premium Reborn, Mineral dan Batubara\r\n";
  		echo "serta Ketenagalistrikan, per Tanggal :\r\n";
  		echo "\r\n";
		// echo "\t Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas \r\n";
		// echo "Bumi per Tanggal $tanggal_laporan : \r\n";
	


		if ($pusdatin->num_rows() > 0)
		{
			foreach($pusdatin->result() as $pusdatin_field)	
				{
			  		$pusdatin_harian = $pusdatin_field->PROD_HARIAN;
			  		$pusdatin_bulananan = $pusdatin_field->PROD_BULANAN;
			  		$pusdatin_tanggal_laporan = $pusdatin_field->TANGGAL_LAPORAN;
			   		$pusdatin_tahunan = $pusdatin_field->PROD_TAHUNAN;
			   		$pusdatin_apbn = $pusdatin_field->APBN;

			   			///PROD MINYAK
						$pusdatin_prodharian = 	"Produksi Harian  : ".$pusdatin_harian." BOPD \r\n";
						$pusdatin_prodbulanan = "Produksi Bulanan : ".$pusdatin_bulananan." BOPD \r\n";
						$pusdatin_prodtahunan = "Produksi Tahunan : ".$pusdatin_tahunan." BOPD \r\n";
						$pusdatin_targetapbn = 	"APBN : ".$pusdatin_apbn." BOPD \r\n";

						echo "1. PRODUKSI MINYAK \r\n";
						// echo "\x20\x20\x20";
						echo $pusdatin_prodharian;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodbulanan;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodtahunan;
						// echo "\x20\x20\x20";
						echo $pusdatin_targetapbn;
						echo " \r\n";	


				}
		}		
		else {


						$pusdatin_prodharian = 	"Produksi Harian  : BOPD \r\n";
						$pusdatin_prodbulanan = "Produksi Bulanan : BOPD \r\n";
						$pusdatin_prodtahunan = "Produksi Tahunan : BOPD \r\n";
						$pusdatin_targetapbn = 	"APBN : BOPD \r\n";

						echo "1. PRODUKSI MINYAK \r\n";
						// echo "\x20\x20\x20";
						echo $pusdatin_prodharian;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodbulanan;
						// echo "\x20\x20\x20";
						echo $pusdatin_prodtahunan;
						// echo "\x20\x20\x20";
						echo $pusdatin_targetapbn;
						echo " \r\n";	

		}

		if ($icp->num_rows() > 0)
		{
			
				foreach($icp->result() as $icp_field)	
				{
				
				   $icp_keterangan = $icp_field->KETERANGAN;
				   ///ICP
				   echo "2. ICP \r\n";	
				   echo "Keterangan : \r\n";
				   echo $icp_keterangan."\r\n";
				   echo "\r\n";
				}


		}		
		else {
					echo "2. ICP \r\n";	
					echo "Keterangan : \r\n";
				   echo "\r\n";

		}	

		if ($prod_gas->num_rows() > 0)
		{
			
				foreach($prod_gas->result() as $prod_gas_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   	$prod_gas_harian = $prod_gas_field->PROD_HARIAN;
			   		$prod_gas_bulananan = $prod_gas_field->PROD_BULANAN;
			   		$prod_gas_tanggal_laporan = $prod_gas_field->TANGGAL_LAPORAN;
			   		$prod_gas_tahunan = $prod_gas_field->PROD_TAHUNAN;
			   		$prod_gas_apbn = $prod_gas_field->APBN;

			   			$prod_gas_prodharian = 	"Produksi Harian  : ".$prod_gas_harian." MMSCFD \r\n";
						$prod_gas_prodbulanan = "Produksi Bulanan : ".$prod_gas_bulananan." MMSCFD \r\n";
						$prod_gas_prodtahunan = "Produksi Tahunan : ".$prod_gas_tahunan." MMSCFD \r\n";
						$prod_gas_apbn 		  = "APBN : ".$prod_gas_apbn." MMSCFD \r\n";

				   	echo "3. PRODUKSI GAS \r\n";
					// echo "\x20\x20\x20";
					echo $prod_gas_prodharian ;
					// echo "\x20\x20\x20";
					echo $prod_gas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $prod_gas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $prod_gas_apbn 	   ;
				   echo "\r\n";

				}


		}		
		else {

						$prod_gas_prodharian = 	"Produksi Harian  : MMSCFD \r\n";
						$prod_gas_prodbulanan = "Produksi Bulanan : MMSCFD \r\n";
						$prod_gas_prodtahunan = "Produksi Tahunan : MMSCFD \r\n";
						$prod_gas_apbn 		  = "APBN : MMSCFD \r\n";


							echo "3. PRODUKSI GAS \r\n";
							// echo "\x20\x20\x20";
							echo $prod_gas_prodharian ;
							// echo "\x20\x20\x20";
							echo $prod_gas_prodbulanan ;
							// echo "\x20\x20\x20";
							echo $prod_gas_prodtahunan ;
							// echo "\x20\x20\x20";
							echo $prod_gas_apbn 	   ;
				   echo "\r\n";


		}	
	
		// }    
        // header('Content-Disposition: attachment; filename=DraftProduksiMinyak_'.$id.'.txt');
        header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin.txt');
    
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
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
			'FLATFORM_ENTRY' => "WEB",
			'TANGGAL_LAPORAN' => date('Y-m-d',strtotime("-1 days")),
		);
		$data = array_merge($data,$stat);
		$kemarinbanget = date('Y-m-d',strtotime("-1 days"));
		// $data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		
		// $result = $this->M_geologi->insert($data,$table);

		// if ($result > 0) {
		// 	$out['status'] = '';
		// 	$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
		// } else {
		// 	$out['status'] = '';
		// 	$out['msg'] = show_err_msg('Data Draft Laporan Gagal ditambahkan', '20px');
		// }



		$hariini = date('Y-m-d');

		$result = $this->M_geologi->cek_pernah_input($hariini,$table);

		if($result > 0)
		{
			//kalau sudah ada data maka tidak di insert
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal (Hanya 1 per Hari)', '20px');
		}
		else
		{
			//kalau belum ada data di insert
			$result = $this->M_geologi->insert($data,$table);
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
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

	public function delete() {
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

		$result = $this->M_geologi->delete($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil di Delete', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal di Delete', '20px');
		}
	}	

	public function hasreview() {
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

		$result = $this->M_geologi->hasreview($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal diPosting', '20px');
		}
	}
	
	public function hasreviewall(){
		$id_user = $this->session->userdata('userdata')->ID_USER;

		
		$result = $this->M_geologi->hasreviewall($id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}

	public function UnpostAll(){
		$id_user = $this->session->userdata('userdata')->ID_USER;

		
		$result = $this->M_geologi->UnpostAllPost($id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}

	public function reviewAll(){
		$id_user = $this->session->userdata('userdata')->ID_USER;
		// var_dump($id_user);die();
		$data = $this->input->post('CATATAN_REVIEW');
		
		$result = $this->M_geologi->reviewAllPost($data,$id_user);
		// $data['datanya'] = $this->M_geologi->select_review_all();



		if ($result > 0) {
			// echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');

			$this->session->set_flashdata('sukses',"Data Berhasil review");
			redirect('Lap_geologi');
		} else {
			// echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
			$this->session->set_flashdata('error',"Data Gagal review ");
			redirect('Lap_geologi');
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
			$data['gunungSet'] = $this->M_geologi->select_all_gunung();
			$data['aktivitasSet'] = $this->M_geologi->select_all_aktivitas();
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

	public function review() {
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
			echo show_my_modal('Admin/geologi/modal_review_draft_gunungapi', 'form-review-draft-gunungapi', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_geologi_gerakan_tanah";
			$data['datanya'] = $this->M_geologi->select_gerakan_tanah($id,$table);
			echo show_my_modal('Admin/geologi/modal_review_draft_gerakantanah', 'form-review-draft-gerakantanah', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_geologi_gempa_bumi";
			$data['datanya'] = $this->M_geologi->select_gempa_bumi($id,$table);
			echo show_my_modal('Admin/geologi/modal_review_draft_gempabumi', 'form-review-draft-gempabumi', $data);
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
		$kemarinbanget = date('Y-m-d',strtotime("-1 days"));

		$query = $this->db->select('KETERANGAN, DETAIL')
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  // ->limit(1)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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

	public function reviewDraftGunungApi()
	{	
		$dataReview = $this->input->post();
		$query = $this->M_geologi->prosesReviewDraftGunung($dataReview);
		
		// echo json_encode(array(
		// 	'message' => 'berhasil'
		// ));
		if ($query > 0) {
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil di review', '20px');
		} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal di review', '20px');
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
        	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
        } else {
 
            //prosses upload csv berhasil serta memproses insert data ke database mysql
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                	$out['ID_GUNUNG'] = $row['ID_GUNUNG'];
                	$out['ID_AKTIVITAS'] = $row['ID_AKTIVITAS'];
                	// $TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['KETERANGAN'] = $row['KETERANGAN'];
                	$out['DETAIL'] = $row['DETAIL'];
                	$out['REKOMENDASI'] = $row['REKOMENDASI'];
                   
                	
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    $out['VONA'] = $row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    // $out['VONA'] = str_replace(',', '', $row['VONA']);
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


    function downloadFileTextGunungApi($id){

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_geologi_gunung_api');

		foreach($fields->result() as $field)	
		{
		
		   $keterangan = $field->KETERANGAN;
		   $detail = $field->DETAIL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $rekomendasi = $field->REKOMENDASI;
		   $vona = $field->VONA;
		}

		$dataketerangan = "Keterangan : ".$keterangan."\r\n";
		$datadetail = "Detail : ".$detail."\r\n";
		
		$datarekomendasi = "Rekomendasi : ".$rekomendasi."\r\n";
		$datavona = "Vona : ".$vona."\r\n";

		
		echo "Berikut dengan hormat kami laporkan Status Gunung Api per Tanggal $tanggal_laporan :\r\n";
		
		echo " \r\n";
		echo $dataketerangan;
		echo $datadetail;
		echo $datarekomendasi;
		echo $datavona;
	
        header('Content-Disposition: attachment; filename=DraftGunungApi_Lap'.$id.'.txt');
        header('Expires: 0');
    
	}


	function downloadFileTextGerakanTanah($id){
        // $yourFile = "Sample-CSV-Format.txt";
        // $file = @fopen($yourFile, "rb");
        // // $file = 'asdas';
  //       $data['userdata'] 	= $this->userdata;
		// $id = $_POST['id'];
		// $ID_JENIS_LAPORAN = $_POST['jenis'];

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

       
       
        
      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_geologi_gerakan_tanah');
      	//$fields = $this->db->query('select * from r_lap_geologi_prod_minyak where ID_LAPORAN = 35');
		// $this->db->where('ID_LAPORAN', $id);
      	
      	//echo $text;
      	// foreach ($dataGunung->result_array() as $row)
		// foreach ($fields as $field)
		foreach($fields->result() as $field)	
		{
		
		   $keterangan = $field->KETERANGAN;
		   $detail = $field->DETAIL;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   // $rekomendasi = $field->REKOMENDASI;
		   // $vona = $field->VONA;
		}

		$dataketerangan = "Keterangan : ".$keterangan."\r\n";
		$datadetail = "Detail : ".$detail."\r\n";
		// $prodbulanan = "Produksi Bulanan : ".$tanggal_laporan."\r\n";
		// $datarekomendasi = "Rekomendasi : ".$rekomendasi."\r\n";
		// $datavona = "Vona : ".$vona."\r\n";

		// echo "Yth. Bapak Menteri ESDM & \r\n";
		// echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Gerakan Tanah per Tanggal $tanggal_laporan :\r\n";
		// echo "\t Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas \r\n";
		// echo "Bumi per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		echo $dataketerangan;
		echo $datadetail;
		// echo $datarekomendasi;
		// echo $datavona;
		// }    
        header('Content-Disposition: attachment; filename=DraftGerakanTanah_Lap'.$id.'.txt');
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
	}	


	function downloadFileTextGempaBumi($id){
        // $yourFile = "Sample-CSV-Format.txt";
        // $file = @fopen($yourFile, "rb");
        // // $file = 'asdas';
  //       $data['userdata'] 	= $this->userdata;
		// $id = $_POST['id'];
		// $ID_JENIS_LAPORAN = $_POST['jenis'];

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

       
       
        
      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_geologi_gempa_bumi');
      	//$fields = $this->db->query('select * from r_lap_geologi_prod_minyak where ID_LAPORAN = 35');
		// $this->db->where('ID_LAPORAN', $id);
      	
      	//echo $text;
      	// foreach ($dataGunung->result_array() as $row)
		// foreach ($fields as $field)
		foreach($fields->result() as $field)	
		{
		
		   $lokasi = $field->LOKASI;
		   $informasi = $field->INFORMASI;
		   $kondisi_dt = $field->KONDISI_GEOLOGI_DT;
		   $penyebab_gempa = $field->PENYEBAB_GEMPA;
		   $dampak_gempa = $field->DAMPAK_GEMPA;
		   $rekomendasi = $field->REKOMENDASI;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   // $rekomendasi = $field->REKOMENDASI;
		   // $vona = $field->VONA;
		}

		$datalokasi = "Keterangan : ".$lokasi."\r\n";
		$datainformasi = "Detail : ".$informasi."\r\n";
		$datakondisidt = "Produksi Bulanan : ".$kondisi_dt."\r\n";
		$datapenyebabgempa = "Rekomendasi : ".$penyebab_gempa."\r\n";
		$datarekomendasi = "Vona : ".$rekomendasi."\r\n";
		$datadampakgempa = "Vona : ".$dampak_gempa."\r\n";
		// $datavona = "Vona : ".$vona."\r\n";
		// $datavona = "Vona : ".$vona."\r\n";

		// echo "Yth. Bapak Menteri ESDM & \r\n";
		// echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Gempa Bumi per Tanggal $tanggal_laporan :\r\n";
		// echo "\t Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas \r\n";
		// echo "Bumi per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		echo $datalokasi;
		echo $datainformasi;
		echo $datakondisidt;
		echo $datapenyebabgempa;
		echo $datarekomendasi;
		echo $datadampakgempa;
		// echo $datavona;
		// }    
        header('Content-Disposition: attachment; filename=DraftGerakanTanah_Lap'.$id.'.txt');
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
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

			$table_gunung = 'r_lap_geologi_gunung_api' ;
				// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_api = $this->M_geologi->cek_pernah_upload_gunung($hariini,$table_gunung);

			if($result_api > 0)
			{
					//kalau sudah ada data maka tidak di insert
				unlink($inputFileName);
				$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
				redirect('Lap_geologi');
			}

			else
			{	
				//Gunung Api
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();

				$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

				for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
					$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					if ($rowData[0][0]=="" ){
						break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
						redirect('Lap_geologi');
					}

					$data = array(
						'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
						'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
						'FLATFORM_ENTRY' => "WEB",
						"TANGGAL_LAPORAN" => $tanggal_laporan,
						"ID_GUNUNG"=> $rowData[0][0],
						"ID_AKTIVITAS"=> $rowData[0][1],
						"KETERANGAN"=> $rowData[0][2],
						"DETAIL"=> $rowData[0][3],
						"REKOMENDASI"=> $rowData[0][4],
						"VONA"=> $rowData[0][5]
					);

					$result_api = $this->db->insert("r_lap_geologi_gunung_api",$data);				
					$this->db->set('READY_REVIEW', 'Y');
					$this->db->set('HAS_REVIEW', Null);

					$this->db->where('ID_ROLE', 17);
					$this->db->update('t_user');
					$this->db->set('HAS_UNPOST', Null);
					$this->db->where('ID_ROLE', 19);
					// $this->db->where('ID_ROLE', 17);
					// $this->db->where('ID_USER', 18);
					
						$this->db->update('t_user');
				}
			}	


			$table_tanah = 'r_lap_geologi_gerakan_tanah' ;
				// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_tanah = $this->M_geologi->cek_pernah_upload_tanah($hariini,$table_tanah);

			if($result_tanah > 0)
			{
					//kalau sudah ada data maka tidak di insert
				unlink($inputFileName);
				$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
				redirect('Lap_geologi');
			}


			else
			{	
				//Gerakan Tanah
				$sheet_2 = $objPHPExcel->getSheet(1);
				$highestRow = $sheet_2->getHighestRow();
				$highestColumn = $sheet_2->getHighestColumn();

				for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
					$rowData_2 = $sheet_2->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					if ($rowData_2[0][0]=="" ){
						break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
						redirect('Lap_geologi');
					}
					$data_2 = array(
						'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
						'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
						'FLATFORM_ENTRY' => "WEB",
						"TANGGAL_LAPORAN" => $tanggal_laporan,
						"KETERANGAN"=> $rowData_2[0][0],
						"DETAIL"=> $rowData_2[0][1]

						  
					);

					$insert = $this->db->insert("r_lap_geologi_gerakan_tanah",$data_2);
					$this->db->set('READY_REVIEW', 'Y');
					$this->db->set('HAS_REVIEW', Null);

					$this->db->where('ID_ROLE', 17);
					$this->db->update('t_user');
					$this->db->set('HAS_UNPOST', Null);
					$this->db->where('ID_ROLE', 19);
					// $this->db->where('ID_ROLE', 17);
					// $this->db->where('ID_USER', 18);
					
						$this->db->update('t_user');
					
				}
			}	

			
			$table_gempa = 'r_lap_geologi_gempa_bumi' ;
				// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_gempa = $this->M_geologi->cek_pernah_upload_gempa($hariini,$table_gempa);

			if($result_gempa > 0)
			{
					//kalau sudah ada data maka tidak di insert
				// $out['status'] = '';
				// $out['msg'] = show_err_msg('Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)', '20px');
				unlink($inputFileName);
				$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
				redirect('Lap_pusdatin');
			}

			else{
				//Gempa Bumi
				$sheet_3 = $objPHPExcel->getSheet(2);
				$highestRow = $sheet_3->getHighestRow();
				$highestColumn = $sheet_3->getHighestColumn();

				for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
					$rowData_3 = $sheet_3->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					if ($rowData_3[0][0]=="" ){
						break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
						redirect('Lap_geologi');
					}
					$data_3 = array(
						'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
						'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
						'FLATFORM_ENTRY' => "WEB",
						"TANGGAL_LAPORAN" => $tanggal_laporan,
						"LOKASI"=> $rowData_3[0][0],
						"INFORMASI"=> $rowData_3[0][1],
						"KONDISI_GEOLOGI_DT"=> $rowData_3[0][2],
						"PENYEBAB_GEMPA"=> $rowData_3[0][3],
						"DAMPAK_GEMPA"=> $rowData_3[0][4],
						"REKOMENDASI"=> $rowData_3[0][5],
					);

					$insert = $this->db->insert("r_lap_geologi_gempa_bumi",$data_3);
					$this->db->set('READY_REVIEW', 'Y');
					$this->db->set('HAS_REVIEW', Null);

					$this->db->where('ID_ROLE', 17);
					$this->db->update('t_user');
					$this->db->set('HAS_UNPOST', Null);
					$this->db->where('ID_ROLE', 19);
					// $this->db->where('ID_ROLE', 17);
					// $this->db->where('ID_USER', 18);
					
						$this->db->update('t_user');				
				}	
			}
				
			unlink($inputFileName);
			$this->session->set_flashdata('sukses',"Data Berhasil Diimpor");
			redirect('Lap_geologi');
		} else {
			$this->session->set_flashdata('error',"Masukkan file dahulu");
			redirect('Lap_geologi');
		}
    } 	

}

