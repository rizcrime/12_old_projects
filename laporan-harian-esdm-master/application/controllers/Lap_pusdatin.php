<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pusdatin extends AUTH_SUPER_ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	    $this	->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	    $this->output->set_header('Pragma: no-cache');
	    $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	    $this->load->helper('form'); // untuk menangani proses form 
      	//$this->load->library('cfpdf');
		$this->load->model('M_admin');
		$this->load->model('M_role');
		$this->load->model('M_pusdatin');
		$this->load->library('Csvimport');
		$this->load->model('M_target');
		//$this->load->library('excel_reader2');
		// $this->load->model('excel_import_model');
		$this->load->library('excel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		// var_dump($data['userdata']);die;
		$data['page'] 		= "pusdatin";
		$data['judul'] 		= "Entry Laporan Pusdatin";
		$data['deskripsi'] 	= "Entry Laporan Pusdatin";
		$data['jenis_laporan'] = $this->M_pusdatin->select_all_jenis_laporan();
		$data['notif_tugas_entry'] = $this->M_pusdatin->select_tugas_entry();

		$id_user = $this->session->userdata('userdata')->ID_USER;
		$ready_review = $this->session->userdata('userdata')->READY_REVIEW;

		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$data['IS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->IS_REVIEW;
		$data['IS_ENTRY'] = $this->M_admin->select_user_is_post($id_user)->IS_ENTRY;	
		$data['READY_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->READY_REVIEW;	
		$data['HAS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->HAS_REVIEW;	
		
		$data['READY_POST'] = $this->M_admin->select_user_is_post($id_user)->READY_POST;	
		$data['HAS_POST'] = $this->M_admin->select_user_is_post($id_user)->HAS_POST;	
		$data['HAS_UNPOST'] = $this->M_admin->select_user_is_post($id_user)->HAS_UNPOST;	

		$data['modal_view_all'] = show_my_modal('Admin/pusdatin/modal_view_all', 'view-all', $data);
		$data['modal_view_all_entry'] = show_my_modal('Admin/pusdatin/modal_view_all_entry', 'view-all-entry', $data);
		
		$data['modal_view_all_has_review'] = show_my_modal('Admin/pusdatin/modal_view_all_has_review', 'view-all-has-review', $data);
		$data['modal_view_all_has_unposting'] = show_my_modal('Admin/pusdatin/modal_view_all_has_unposting', 'view-all-has-unposting', $data);
		$data['modal_view_all_kapus'] = show_my_modal('Admin/pusdatin/modal_view_all_kapus', 'view-all-kapus', $data);
			
		$data['modal_review_all'] = show_my_modal('Admin/pusdatin/modal_review_all', 'review-all', $data);
	
		$this->template->views('Admin/pusdatin/home', $data);


	}

	   //  public function upload(){
    //     $fileName = time().$_FILES['file']['name'];
         
    //     $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
    //     $config['file_name'] = $fileName;
    //     $config['allowed_types'] = 'xls|xlsx|csv';
    //     $config['max_size'] = 10000;
         
    //     $this->load->library('upload');
    //     $this->upload->initialize($config);
         
    //     if(! $this->upload->do_upload('file') )
    //     $this->upload->display_errors();
             
    //     $media = $this->upload->data('file');
    //     $inputFileName = './assets/'.$media['file_name'];
         
    //     try {
    //             $inputFileType = IOFactory::identify($inputFileName);
    //             $objReader = IOFactory::createReader($inputFileType);
    //             $objPHPExcel = $objReader->load($inputFileName);
    //         } catch(Exception $e) {
    //             die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    //         }
 
    //         $sheet = $objPHPExcel->getSheet(0);
    //         $highestRow = $sheet->getHighestRow();
    //         $highestColumn = $sheet->getHighestColumn();
             
    //         for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
    //             $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
    //                                             NULL,
    //                                             TRUE,
    //                                             FALSE);
                                                 
    //             //Sesuaikan sama nama kolom tabel di database                                
    //              $data = array(
    //                 "PROD_HARIAN"=> $rowData[0][0],
    //                 "PROD_BULANAN"=> $rowData[0][1]
    //                 // "alamat"=> $rowData[0][2],
    //                 // "kontak"=> $rowData[0][3]
    //             );
                 
    //             //sesuaikan nama dengan nama tabel
    //             $insert = $this->db->insert("r_lap_pusdatin_prod_minyak",$data);
    //             delete_files($media['file_path']);
                     
    //         }
    //     redirect('excel/');
    // }

	// function import()
	// {
	// 	if(isset($_FILES["file"]["name"]))
	// 	{
	// 		$path = $_FILES["file"]["tmp_name"];
	// 		$object = PHPExcel_IOFactory::load($path);
	// 		foreach($object->getWorksheetIterator() as $worksheet)
	// 		{
	// 			$highestRow = $worksheet->getHighestRow();
	// 			$highestColumn = $worksheet->getHighestColumn();
	// 			for($row=2; $row<=$highestRow; $row++)
	// 			{
	// 				$customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
	// 				$address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
	// 				$city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
	// 				$postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
	// 				$country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
	// 				$data[] = array(
	// 					'CustomerName'		=>	$customer_name,
	// 					'Address'			=>	$address,
	// 					'City'				=>	$city,
	// 					'PostalCode'		=>	$postal_code,
	// 					'Country'			=>	$country
	// 					'PROD_HARIAN'			=>	$harian
	// 					'PROD_BULANAN'			=>	$bulanan

	// 					// "PROD_HARIAN"=> $rowData[0][0],
	// 	    //                 "PROD_BULANAN"=> $rowData[0][1]
	// 				);
	// 			}
	// 		}
	// 		$this->excel_import_model->insert($data);
	// 		echo 'Data Imported successfully';
	// 	}	
	// }

	// public function upload_all(){
		
	// 		// mysql_connect('hostname', 'username', 'password');
	// 		// mysql_select_db('db_laphar');

	// 		error_reporting(E_ALL ^ E_NOTICE);
	// 			// require_once 'excel_reader2.php';

	// 		// proses assigning baca data file 'data.xls'
	// 		// $data = new Spreadsheet_Excel_Reader("data.xls");
	// 		$data = new Spreadsheet_Excel_Reader;

	// 		//-------- import dari sheet 1 ----------

	// 		// baca jumlah baris dalam sheet 1
	// 		$jmlbaris = $data->rowcount(0);

	// 		for ($i=2; $i<=$jmlbaris; $i++)
	// 		{
	// 			// baca data pada baris ke-i, kolom ke-1, pada sheet 1
	// 			$datakolom1 = $data->val($i, 1, 0);
	// 			// baca data pada baris ke-i, kolom ke-2, pada sheet 1
	// 			$datakolom2 = $data->val($i, 2, 0);
	// 			// insert data ke tabel mhs
	// 			$query = "INSERT INTO mhs (nim, namamhs) VALUES ('$datakolom1', '$datakolom2')";
	// 			mysql_query($query);
	// 		}

	// 		//-------- import dari sheet 2 ----------

	// 		// baca jumlah baris dalam sheet 2
	// 		$jmlbaris = $data->rowcount(1);

	// 		for ($i=2; $i<=$jmlbaris; $i++)
	// 		{
	// 			// baca data pada baris ke-i, kolom ke-1, pada sheet 2
	// 			$datakolom1 = $data->val($i, 1, 1);
	// 			// baca data pada baris ke-i, kolom ke-2, pada sheet 2
	// 			$datakolom2 = $data->val($i, 2, 1);
	// 			// insert data ke tabel dosen
	// 			$query = "INSERT INTO dosen (kodedosen, namadosen) VALUES ('$datakolom1', '$datakolom2')";
	// 			mysql_query($query);
	// 		}

	// 		//-------- import dari sheet 3 ----------

	// 		// baca jumlah baris dalam sheet 3
	// 		$jmlbaris = $data->rowcount(2);

	// 		for ($i=2; $i<=$jmlbaris; $i++)
	// 		{
	// 			// baca data pada baris ke-i, kolom ke-1, pada sheet 3
	// 			$datakolom1 = $data->val($i, 1, 2);
	// 			// baca data pada baris ke-i, kolom ke-2, pada sheet 3
	// 			$datakolom2 = $data->val($i, 2, 2);
	// 			// insert data ke tabel mk
	// 			$query = "INSERT INTO mk (kodemk, namamk) VALUES ('$datakolom1', '$datakolom2')";
	// 			mysql_query($query);
	// 		}

	// 		echo "<p>Proses import selesai</p>";
	// }

	public function upload_all(){
		
			$this->load->view('Admin/pusdatin/import_file_excel');
	}

	public  function read_file(){
    // include_once ( APPPATH."libraries/excel_reader2.php");
    $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
        
	// <!--     $j = -1;
	//     for ($i=2; $i <= ($data->rowcount($sheet_index=0)); $i++){ 
	//       $j++;
	//       $nama[$j]   = $data->val($i, 1);
	//       $nim[$j]    = $data->val($i, 2);
	//       $kelas[$j]  = $data->val($i, 3);
	//     } -->

      // baca jumlah baris dalam sheet 1
    $jmlbaris = $data->rowcount(0);

    for ($i=2; $i<=$jmlbaris; $i++)
    {
        // baca data pada baris ke-i, kolom ke-1, pada sheet 1
        $datakolom1 = $data->val($i, 1, 0);
        // baca data pada baris ke-i, kolom ke-2, pada sheet 1
        $datakolom2 = $data->val($i, 2, 0);
        // insert data ke tabel mhs
        // $query = "INSERT INTO mhs (nim, namamhs) VALUES ('$datakolom1', '$datakolom2')";
        // mysql_query($query);
        $this->db->insert("INSERT INTO r_lap_pusdatin_prod_minyak (PROD_HARIAN, 	PROD_BULANAN) VALUES ('$datakolom1', '$datakolom2')");
    }
     

	//-------- import dari sheet 2 ----------

	// baca jumlah baris dalam sheet 2
	$jmlbaris = $data->rowcount(1);

			for ($i=2; $i<=$jmlbaris; $i++)
	{
				// baca data pada baris ke-i, kolom ke-1, pada sheet 2
				$datakolom1 = $data->val($i, 1, 1);
				// baca data pada baris ke-i, kolom ke-2, pada sheet 2
				$datakolom2 = $data->val($i, 2, 1);
				// insert data ke tabel dosen
		$this->db->insert("INSERT INTO r_lap_pusdatin_prod_gas (PROD_HARIAN, 	PROD_BULANAN) VALUES ('$datakolom1', '$datakolom2')");
	}

// <!--     $xdata['nama']  = $nama;
//     $xdata['nim']  = $nim;
//     $xdata['kelas']  = $kelas;
//     $this->load->view('message_import_file_excel', $xdata); -->

      echo "<p>Proses import selesai</p>";
  }

	// public function laporanpusdatin(){

	// 	// if ($this->session->userdata('login') == TRUE){
        
 //        $pdf = new FPDF();
 //        $pdf->AddPage();
 //        $pdf->SetFont('Arial','B',14);
 //        $pdf->Cell(45);
 //        $pdf->Cell(100,0,'Laporan Data Pusdatin (Produksi Minyak)',0,0,'C');
 //        $pdf->Ln(5);
 //        $pdf->SetFont('Arial','',7);
 //        $pdf->SetFillColor(100,0,0);
 //        $pdf->SetTextColor(255);
 //        $pdf->SetDrawColor(0,0,0);
 //        // $header = array('No', 'ID Laporan', 'Tanggal', 'Produksi Minyak Harian (BOPD)', 'Rata - rata Produksi Bulanan (BOPD)', 'Rata - rata Produksi Tahunan (BOPD)', 'Target APBN (BOPD)');
 //        $header = array('ID Laporan', 'Tanggal', 'Produksi Minyak Harian (BOPD)', 'Rata - rata Produksi Bulanan (BOPD)', 'Rata - rata Produksi Tahunan (BOPD)',);
 //        // Lebar Header Sesuaikan Jumlahnya dengan Jumlah Field Tabel Database
 //        $w = array(18, 20, 46, 46, 46);
 //        for($i=0;$i<count($header);$i++)
 //        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
 //        $pdf->Ln();
 //        // Data
 //        $fill = false;
 //        $pdf->SetFillColor(224,235,255);
 //        $pdf->SetTextColor(0);
 //        $pdf->SetFont('');
 //     foreach ($this->M_pusdatin->select_by_jenis_draft() as $row):
 //        $pdf->Cell($w[0],6,$row->PROD_HARIAN,'LR',0,'L',$fill); 
 //        $pdf->Cell($w[1],6,'30 JULI 2019','LR',0,'L',$fill);
 //        $pdf->Cell($w[2],6,'12345','LR',0,'L',$fill);
 //        $pdf->Cell($w[3],6,'12345','LR',0,'L',$fill);
 //        $pdf->Cell($w[4],6,'12345','LR',0,'L',$fill);
 //        // $pdf->Cell($w[5],6,$row->totalharga,'LR',0,'L',$fill);
 //        $pdf->Ln();
 //        $fill = !$fill;
 //    endforeach;
 //    $pdf->Cell(array_sum($w),0,'','T');
        
 //        $pdf->Output();
        
 //    // } else { redirect('Lap_pusdatin'); }
	// }




	public function downloadFileTextKamu(){
        

		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

		echo "Sayang Kamu";

		// header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin.txt');
    
  //   	header('Expires: 0');
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
      	$pusdatin = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL 
   				 AND
                PROD_HARIAN != 0 AND PROD_HARIAN IS NOT NULL
                AND
                PROD_BULANAN != 0 AND PROD_BULANAN IS NOT NULL
                AND
                PROD_TAHUNAN  != 0 AND PROD_TAHUNAN IS NOT NULL  
                AND
                APBN  != 0 AND APBN IS NOT NULL
				order by TANGGAL_LAPORAN DESC
   				limit 1");

      	$icp = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$prod_gas = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  
		order by TANGGAL_LAPORAN DESC limit 1");
      	$ekui_migas = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$lift_tb = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$harga_bbm = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$berita_opec = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$bb_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$mineral_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      	$stts_tl = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");

    

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

		if ($ekui_migas->num_rows() > 0)
		{
			
				foreach($ekui_migas->result() as $ekui_migas_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   	$ekui_migas_harian = $ekui_migas_field->PROD_HARIAN;
				   $ekui_migas_bulananan = $ekui_migas_field->PROD_BULANAN;
				   $ekui_migas_tanggal_laporan = $ekui_migas_field->TANGGAL_LAPORAN;
				   $ekui_migas_tahunan = $ekui_migas_field->PROD_TAHUNAN;
				   $ekui_migas_apbn = $ekui_migas_field->APBN;
				   $note_ekui_migas = $ekui_migas_field->CATATAN;

			   		///EKui Migas
					$ekui_migas_prodharian =  "Produksi Harian  : ".$ekui_migas_harian." BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : ".$ekui_migas_bulananan." BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : ".$ekui_migas_tahunan." BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : ".$ekui_migas_apbn." BOEPD \r\n";
					$data_note_ekui_migas   = "Note : ".$note_ekui_migas." \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";
				}


		}		
		else {

					$ekui_migas_prodharian  = "Produksi Harian  : BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : BOEPD \r\n";
					$data_note_ekui_migas   = "Note : \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";

		}

		if ($lift_tb->num_rows() > 0)
		{
			
				foreach($lift_tb->result() as $lift_tb_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $lift_tb_mb = $lift_tb_field->LIFT_MB;
				   $lift_tb_gas = $lift_tb_field->LIFT_GAS;
				   $lift_tb_salur_gas = $lift_tb_field->SALUR_GAS;

			   		///Lifting 
					$keterangan_lift_tb_mb 	         =	$lift_tb_mb."\r\n";
					$keterangan_lift_tb_gas 		 =	$lift_tb_gas."\r\n";
					$keterangan_lift_tb_salur_gas    =	$lift_tb_salur_gas."\r\n";

				   	echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo $keterangan_lift_tb_mb."\r\n";
					echo "SALUR GAS : \r\n";
					echo $keterangan_lift_tb_salur_gas."\r\n";
					echo "LIFTING GAS : \r\n";
					echo $keterangan_lift_tb_gas."\r\n";
						echo " \r\n";	

				}


		}		
		else {

					echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo "\r\n";
					echo "SALUR GAS : \r\n";
				   echo "\r\n";
					echo "LIFTING GAS : \r\n";
				   echo "\r\n";
				   echo "\r\n";


		}

		if ($harga_bbm->num_rows() > 0)
		{
			
				foreach($harga_bbm->result() as $harga_bbm_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $jenis_tertentu = $harga_bbm_field->JENIS_TERTENTU;
				   $bbm_umum = $harga_bbm_field->BBM_UMUM;
				   $ind_satu_harga = $harga_bbm_field->PROG_IND_SATU_HRG;
				   $harga_per_negara = $harga_bbm_field->HARGA_PERNEGARA;
				   $note_bbm = $harga_bbm_field->CATATAN;

			   		///Lifting 
					$data_jenis_tertentu 	         =	$jenis_tertentu."\r\n";
					$data_bbm_umum 		 =	$bbm_umum."\r\n";
					$data_ind_satu_harga    =	$ind_satu_harga."\r\n";
					$data_harga_per_negara    =	$harga_per_negara."\r\n";
					$data_note_bbm   		=	$note_bbm."\r\n";

				   	echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_jenis_tertentu."\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo $data_bbm_umum."\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo $data_ind_satu_harga."\r\n";
					echo "Note : \r\n";
					echo $data_note_bbm."\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo $data_harga_per_negara."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo "\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo "\r\n";
					echo "Note : \r\n";
					echo "\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}



		if ($berita_opec->num_rows() > 0)
		{
			
				foreach($berita_opec->result() as $berita_opec_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $berita = $berita_opec_field->BERITA;
				  

			   		///Lifting 
					$data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					///Lifting 
					// $data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($bb_acuan->num_rows() > 0)
		{
			
				foreach($bb_acuan->result() as $bb_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $bb_acuan_field->HARGA;
				   $sumber = $bb_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($mineral_acuan->num_rows() > 0)
		{
			
				foreach($mineral_acuan->result() as $mineral_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $mineral_acuan_field->HARGA;
				   $sumber = $mineral_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}

		if ($stts_tl->num_rows() > 0)
		{
			
				foreach($stts_tl->result() as $stts_tl_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $status = $stts_tl_field->STATUS;
				   // $sumber = $stts_tl_field->SUMBER;
				  

			   		///Lifting 
					$data_status 	         =	$status."\r\n";
					// $data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_status."\r\n";
					// echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					// echo "\r\n";
						echo " \r\n";	
					


		}	


		if ($pusdatin->num_rows() > 0)
		{
			foreach($pusdatin->result() as $pusdatin_field)	
				{
			  		
			   		$catatan_minyak = $pusdatin_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n".$catatan_minyak."\r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";		

		}	
		if ($prod_gas->num_rows() > 0)
		{
			foreach($prod_gas->result() as $prod_gas_field)	
				{
			  		
			   		$catatan_gas = $prod_gas_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n".$catatan_gas."\r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";		

		}

		if ($stts_tl->num_rows() > 0)
		{
			foreach($stts_tl->result() as $stts_tl_field)	
				{
			  		
			   		$catatan_stts_tl = $stts_tl_field->CATATAN;

			   			///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n".$catatan_stts_tl."\r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";		

		}


	
        header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin(Reviewer).txt');
    
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
	}

	public function downloadFileTextEntry(){
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
      	$pusdatin = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL 
   				 AND
                PROD_HARIAN != 0 AND PROD_HARIAN IS NOT NULL
                AND
                PROD_BULANAN != 0 AND PROD_BULANAN IS NOT NULL
                AND
                PROD_TAHUNAN  != 0 AND PROD_TAHUNAN IS NOT NULL  
                AND
                APBN  != 0 AND APBN IS NOT NULL
				order by TANGGAL_LAPORAN DESC
   				limit 1");

      	$icp = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$prod_gas = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$ekui_migas = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$lift_tb = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$harga_bbm = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$berita_opec = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$bb_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$mineral_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      	$stts_tl = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NULL AND CATATAN_REVIEW IS NOT NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");

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

		if ($ekui_migas->num_rows() > 0)
		{
			
				foreach($ekui_migas->result() as $ekui_migas_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   	$ekui_migas_harian = $ekui_migas_field->PROD_HARIAN;
				   $ekui_migas_bulananan = $ekui_migas_field->PROD_BULANAN;
				   $ekui_migas_tanggal_laporan = $ekui_migas_field->TANGGAL_LAPORAN;
				   $ekui_migas_tahunan = $ekui_migas_field->PROD_TAHUNAN;
				   $ekui_migas_apbn = $ekui_migas_field->APBN;
				   $note_ekui_migas = $ekui_migas_field->CATATAN;

			   		///EKui Migas
					$ekui_migas_prodharian =  "Produksi Harian  : ".$ekui_migas_harian." BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : ".$ekui_migas_bulananan." BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : ".$ekui_migas_tahunan." BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : ".$ekui_migas_apbn." BOEPD \r\n";
					$data_note_ekui_migas   = "Note : ".$note_ekui_migas." \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";
				}


		}		
		else {

					$ekui_migas_prodharian  = "Produksi Harian  : BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : BOEPD \r\n";
					$data_note_ekui_migas   = "Note : \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";

		}

		if ($lift_tb->num_rows() > 0)
		{
			
				foreach($lift_tb->result() as $lift_tb_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $lift_tb_mb = $lift_tb_field->LIFT_MB;
				   $lift_tb_gas = $lift_tb_field->LIFT_GAS;
				   $lift_tb_salur_gas = $lift_tb_field->SALUR_GAS;

			   		///Lifting 
					$keterangan_lift_tb_mb 	         =	$lift_tb_mb."\r\n";
					$keterangan_lift_tb_gas 		 =	$lift_tb_gas."\r\n";
					$keterangan_lift_tb_salur_gas    =	$lift_tb_salur_gas."\r\n";

				   	echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo $keterangan_lift_tb_mb."\r\n";
					echo "SALUR GAS : \r\n";
					echo $keterangan_lift_tb_salur_gas."\r\n";
					echo "LIFTING GAS : \r\n";
					echo $keterangan_lift_tb_gas."\r\n";
						echo " \r\n";	

				}


		}		
		else {

					echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo "\r\n";
					echo "SALUR GAS : \r\n";
				   echo "\r\n";
					echo "LIFTING GAS : \r\n";
				   echo "\r\n";
				   echo "\r\n";


		}

		if ($harga_bbm->num_rows() > 0)
		{
			
				foreach($harga_bbm->result() as $harga_bbm_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $jenis_tertentu = $harga_bbm_field->JENIS_TERTENTU;
				   $bbm_umum = $harga_bbm_field->BBM_UMUM;
				   $ind_satu_harga = $harga_bbm_field->PROG_IND_SATU_HRG;
				   $harga_per_negara = $harga_bbm_field->HARGA_PERNEGARA;
				   $note_bbm = $harga_bbm_field->CATATAN;

			   		///Lifting 
					$data_jenis_tertentu 	         =	$jenis_tertentu."\r\n";
					$data_bbm_umum 		 =	$bbm_umum."\r\n";
					$data_ind_satu_harga    =	$ind_satu_harga."\r\n";
					$data_harga_per_negara    =	$harga_per_negara."\r\n";
					$data_note_bbm   		=	$note_bbm."\r\n";

				   	echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_jenis_tertentu."\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo $data_bbm_umum."\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo $data_ind_satu_harga."\r\n";
					echo "Note : \r\n";
					echo $data_note_bbm."\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo $data_harga_per_negara."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo "\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo "\r\n";
					echo "Note : \r\n";
					echo "\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}



		if ($berita_opec->num_rows() > 0)
		{
			
				foreach($berita_opec->result() as $berita_opec_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $berita = $berita_opec_field->BERITA;
				  

			   		///Lifting 
					$data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					///Lifting 
					// $data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($bb_acuan->num_rows() > 0)
		{
			
				foreach($bb_acuan->result() as $bb_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $bb_acuan_field->HARGA;
				   $sumber = $bb_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($mineral_acuan->num_rows() > 0)
		{
			
				foreach($mineral_acuan->result() as $mineral_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $mineral_acuan_field->HARGA;
				   $sumber = $mineral_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}

		if ($stts_tl->num_rows() > 0)
		{
			
				foreach($stts_tl->result() as $stts_tl_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $status = $stts_tl_field->STATUS;
				   // $sumber = $stts_tl_field->SUMBER;
				  

			   		///Lifting 
					$data_status 	         =	$status."\r\n";
					// $data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_status."\r\n";
					// echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					// echo "\r\n";
						echo " \r\n";	
					


		}	


		if ($pusdatin->num_rows() > 0)
		{
			foreach($pusdatin->result() as $pusdatin_field)	
				{
			  		
			   		$catatan_minyak = $pusdatin_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n".$catatan_minyak."\r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";		

		}	
		if ($prod_gas->num_rows() > 0)
		{
			foreach($prod_gas->result() as $prod_gas_field)	
				{
			  		
			   		$catatan_gas = $prod_gas_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n".$catatan_gas."\r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";		

		}

		if ($stts_tl->num_rows() > 0)
		{
			foreach($stts_tl->result() as $stts_tl_field)	
				{
			  		
			   		$catatan_stts_tl = $stts_tl_field->CATATAN;

			   			///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n".$catatan_stts_tl."\r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";		

		}


	
        header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin(Entry).txt');
    
        header('Expires: 0');
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
	}







	public function downloadFileTextHasReview(){
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
      	$pusdatin = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL 
				 
				AND
				 
                PROD_HARIAN != 0 AND PROD_HARIAN IS NOT NULL
                AND
                PROD_BULANAN != 0 AND PROD_BULANAN IS NOT NULL
                AND
                PROD_TAHUNAN  != 0 AND PROD_TAHUNAN IS NOT NULL  
                AND
                APBN  != 0 AND APBN IS NOT NULL
				order by TANGGAL_LAPORAN DESC
   				limit 1");

      	$icp = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$prod_gas = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$ekui_migas = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$lift_tb = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$harga_bbm = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$berita_opec = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$bb_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$mineral_acuan = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");
      	$stts_tl = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NULL  AND HAS_REVIEW IS NOT NULL AND  TANGGAL_REVIEW IS NOT NULL and
				TANGGAL_POST IS NULL  
				order by TANGGAL_LAPORAN DESC limit 1");

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

		if ($ekui_migas->num_rows() > 0)
		{
			
				foreach($ekui_migas->result() as $ekui_migas_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   	$ekui_migas_harian = $ekui_migas_field->PROD_HARIAN;
				   $ekui_migas_bulananan = $ekui_migas_field->PROD_BULANAN;
				   $ekui_migas_tanggal_laporan = $ekui_migas_field->TANGGAL_LAPORAN;
				   $ekui_migas_tahunan = $ekui_migas_field->PROD_TAHUNAN;
				   $ekui_migas_apbn = $ekui_migas_field->APBN;
				   $note_ekui_migas = $ekui_migas_field->CATATAN;

			   		///EKui Migas
					$ekui_migas_prodharian =  "Produksi Harian  : ".$ekui_migas_harian." BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : ".$ekui_migas_bulananan." BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : ".$ekui_migas_tahunan." BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : ".$ekui_migas_apbn." BOEPD \r\n";
					$data_note_ekui_migas   = "Note : ".$note_ekui_migas." \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";
				}


		}		
		else {

					$ekui_migas_prodharian  = "Produksi Harian  : BOEPD \r\n";
					$ekui_migas_prodbulanan = "Produksi Bulanan : BOEPD \r\n";
					$ekui_migas_prodtahunan = "Produksi Tahunan : BOEPD \r\n";
					$ekui_migas_prodapbn    = "APBN : BOEPD \r\n";
					$data_note_ekui_migas   = "Note : \r\n";

				   	echo "4. PRODUKSI EKUIVALEN MINYAK DAN GAS \r\n";
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodharian ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodbulanan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodtahunan ;
					// echo "\x20\x20\x20";
					echo $ekui_migas_prodapbn ;
					echo " \r\n";
					echo $data_note_ekui_migas ;

					echo " \r\n";
		}

		if ($lift_tb->num_rows() > 0)
		{
			
				foreach($lift_tb->result() as $lift_tb_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $lift_tb_mb = $lift_tb_field->LIFT_MB;
				   $lift_tb_gas = $lift_tb_field->LIFT_GAS;
				   $lift_tb_salur_gas = $lift_tb_field->SALUR_GAS;

			   		///Lifting 
					$keterangan_lift_tb_mb 	         =	$lift_tb_mb."\r\n";
					$keterangan_lift_tb_gas 		 =	$lift_tb_gas."\r\n";
					$keterangan_lift_tb_salur_gas    =	$lift_tb_salur_gas."\r\n";

				   	echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo $keterangan_lift_tb_mb."\r\n";
					echo "SALUR GAS : \r\n";
					echo $keterangan_lift_tb_salur_gas."\r\n";
					echo "LIFTING GAS : \r\n";
					echo $keterangan_lift_tb_gas."\r\n";
						echo " \r\n";	

				}


		}		
		else {

					echo "5. LIFTING TAHUN BERJALAN \r\n";
				//	echo "\x20\x20\x20";
					echo "LIFTING MINYAK BUMI : \r\n";
					echo "\r\n";
					echo "SALUR GAS : \r\n";
				   echo "\r\n";
					echo "LIFTING GAS : \r\n";
				   echo "\r\n";
				   echo "\r\n";


		}

		if ($harga_bbm->num_rows() > 0)
		{
			
				foreach($harga_bbm->result() as $harga_bbm_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $jenis_tertentu = $harga_bbm_field->JENIS_TERTENTU;
				   $bbm_umum = $harga_bbm_field->BBM_UMUM;
				   $ind_satu_harga = $harga_bbm_field->PROG_IND_SATU_HRG;
				   $harga_per_negara = $harga_bbm_field->HARGA_PERNEGARA;

			   		///Lifting 
					$data_jenis_tertentu 	         =	$jenis_tertentu."\r\n";
					$data_bbm_umum 		 =	$bbm_umum."\r\n";
					$data_ind_satu_harga    =	$ind_satu_harga."\r\n";
					$data_harga_per_negara    =	$harga_per_negara."\r\n";

				   	echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_jenis_tertentu."\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo $data_bbm_umum."\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo $data_ind_satu_harga."\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo $data_harga_per_negara."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					echo "6. HARGA BBM \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "B. Jenis BBM Umum : \r\n";
					echo "\r\n";
					echo "C. Lokasi BBM Satu Harga : \r\n";
					echo "\r\n";
					echo "D. Harga Per-negara : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}



		if ($berita_opec->num_rows() > 0)
		{
			
				foreach($berita_opec->result() as $berita_opec_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $berita = $berita_opec_field->BERITA;
				  

			   		///Lifting 
					$data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

					///Lifting 
					// $data_berita 	         =	$berita."\r\n";
				   	echo "7. BERITA OPEC HARIAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($bb_acuan->num_rows() > 0)
		{
			
				foreach($bb_acuan->result() as $bb_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $bb_acuan_field->HARGA;
				   $sumber = $bb_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "8. HARGA BATUBARA ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($mineral_acuan->num_rows() > 0)
		{
			
				foreach($mineral_acuan->result() as $mineral_acuan_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $harga = $mineral_acuan_field->HARGA;
				   $sumber = $mineral_acuan_field->SUMBER;
				  

			   		///Lifting 
					$data_harga 	         =	$harga."\r\n";
					$data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_harga."\r\n";
					echo $data_sumber."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "9. HARGA MINERAL ACUAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					echo "\r\n";
						echo " \r\n";	
					


		}

		if ($stts_tl->num_rows() > 0)
		{
			
				foreach($stts_tl->result() as $stts_tl_field)	
				{
				
				   // $icp_keterangan = $icp_field->KETERANGAN;
				   // ///ICP
				   // echo "2. ICP \r\n";	
				   // echo "Keterangan : \r\n";
				   // echo $icp_keterangan."\r\n";\


				   $status = $stts_tl_field->STATUS;
				   // $sumber = $stts_tl_field->SUMBER;
				  

			   		///Lifting 
					$data_status 	         =	$status."\r\n";
					// $data_sumber 	         =	$sumber."\r\n";
				   	
				   	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo $data_status."\r\n";
					// echo $berita."\r\n";
						echo " \r\n";	
					
				}


		}		
		else {

				  	echo "10. STATUS KETENAGALISTRIKAN \r\n";
				//	echo "\x20\x20\x20";
				   	// echo "\r\n";
					// echo "A. Jenis BBM Tertentu : \r\n";
					echo "\r\n";
					// echo "\r\n";
						echo " \r\n";	
					


		}	

		if ($pusdatin->num_rows() > 0)
		{
			foreach($pusdatin->result() as $pusdatin_field)	
				{
			  		
			   		$catatan_minyak = $pusdatin_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n".$catatan_minyak."\r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_miyak = "Catatan Produksi Minyak : \r\n";
					
						echo $catatan_prod_miyak;
						echo " \r\n";		

		}	
		if ($prod_gas->num_rows() > 0)
		{
			foreach($prod_gas->result() as $prod_gas_field)	
				{
			  		
			   		$catatan_gas = $prod_gas_field->CATATAN;

			   			///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n".$catatan_gas."\r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$catatan_prod_gas = "Catatan Produksi Gas : \r\n";
					
						echo $catatan_prod_gas;
						echo " \r\n";		

		}

		if ($stts_tl->num_rows() > 0)
		{
			foreach($stts_tl->result() as $stts_tl_field)	
				{
			  		
			   		$catatan_stts_tl = $stts_tl_field->CATATAN;

			   			///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n".$catatan_stts_tl."\r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";	


				}
		}		
		else {


						///PROD MINYAK
						$data_catatan_stts_tl = "Catatan Status Ketenagalistrikan : \r\n";
					
						echo $data_catatan_stts_tl;
						echo " \r\n";		

		}

		header('Content-Disposition: attachment; filename=DraftlAP_Pusdatin(Approval).txt');
    
        header('Expires: 0');
	}    
        // header('Content-Disposition: attachment; filename=DraftProduksiMinyak_'.$id.'.txt');
      
        // header('Content-Length: ' . filesize($yourFile));
      
        // while (!feof($file)) {
        // 	var_dump($file);die();
        //     print(@fread($file, 1024 * 8));
        //     ob_flush();
        //     flush();
        // }
	






	




	public function downloadFileTextICP($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_icp');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $keterangan = $field->KETERANGAN;
		}

		$ket = $keterangan."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status ICP per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		echo $ket;
		
        header('Content-Disposition: attachment; filename=DraftICP_'.$id.'.txt');
        header('Expires: 0');
        
	}

	public function downloadFileTextProdGas($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_prod_gas');
      	
		foreach($fields->result() as $field)	
		{
		
		   $harian = $field->PROD_HARIAN;
		   $bulananan = $field->PROD_BULANAN;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $tahunan = $field->PROD_TAHUNAN;
		   $apbn = $field->APBN;
		}

		$prodharian = "Produksi Harian : ".$harian."\r\n";
		$prodbulanan = "Produksi Bulanan : ".$bulananan."\r\n";
		$prodtahunan = "Produksi Tahunan : ".$tahunan."\r\n";
		$targetapbn = "APBN : ".$apbn."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Produksi Gas Bumi per Tanggal $tanggal_laporan :\r\n";
		echo " \r\n";

		echo $prodharian;
		echo $prodbulanan;
		echo $prodtahunan;
		echo $targetapbn;
		
        header('Content-Disposition: attachment; filename=DraftProduksiGas_'.$id.'.txt');
        header('Expires: 0');        
	}

	public function downloadFileTextProdEkuiMigas($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_prod_ekui_migas');
      	
		foreach($fields->result() as $field)	
		{
		
		   $harian = $field->PROD_HARIAN;
		   $bulananan = $field->PROD_BULANAN;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $tahunan = $field->PROD_TAHUNAN;
		   $apbn = $field->APBN;
		}

		$prodharian = "Produksi Harian : ".$harian."\r\n";
		$prodbulanan = "Produksi Bulanan : ".$bulananan."\r\n";
		$prodtahunan = "Produksi Tahunan : ".$tahunan."\r\n";
		$targetapbn = "APBN : ".$apbn."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Produksi Ekuivalen Minyak dan Gas Bumi per Tanggal $tanggal_laporan :\r\n";
		echo " \r\n";

		echo $prodharian;
		echo $prodbulanan;
		echo $prodtahunan;
		echo $targetapbn;
		
        header('Content-Disposition: attachment; filename=DraftProduksiEkuivalenMigas_'.$id.'.txt');
        header('Expires: 0');        
	}

	public function downloadFileTextLiftingTB($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_lift_tb');
      	
		foreach($fields->result() as $field)	
		{
		
		   $lift_mb = $field->LIFT_MB;
		   $posisi_stock = $field->POSISI_STOCK;
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $salur_gas = $field->SALUR_GAS;
		   $lift_gas = $field->LIFT_GAS;
		}

		$liftmb = "Lifting minyak bumi : ".$lift_mb."\r\n";
		$liftgas = "Lifting gas : ".$lift_gas."\r\n";
		$posisistock = "Posisi Stock : ".$posisi_stock."\r\n";
		$salurgas = "Salur Gas : ".$salur_gas."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Lifting Tahun Berjalan per Tanggal $tanggal_laporan :\r\n";
		echo " \r\n";

		echo $liftmb;
		echo $liftgas;
		echo $posisistock;
		echo $salurgas;
		
        header('Content-Disposition: attachment; filename=DraftLiftingTahunBerjalan_'.$id.'.txt');
        header('Expires: 0');        
	}

	public function downloadFileTextHargaBBM($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_harga_bbm');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $jenis_tertentu = $field->JENIS_TERTENTU;
		   $bbm_umum = $field->BBM_UMUM;
		   $prog_ind_satu_hrg = $field->PROG_IND_SATU_HRG;
		   $harga_per_negara = $field->HARGA_PERNEGARA;
		}

		$jenis_tertentu = "Lifting minyak bumi : ".$jenis_tertentu."\r\n";
		$bbm_umum = "Lifting gas : ".$bbm_umum."\r\n";
		$prog_ind_satu_hrg = "Posisi Stock : ".$prog_ind_satu_hrg."\r\n";
		$harga_per_negara = "Salur Gas : ".$harga_per_negara."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Harga BBM per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		
		echo $jenis_tertentu;
		echo $bbm_umum;
		echo $prog_ind_satu_hrg;
		echo $harga_per_negara;
		
        header('Content-Disposition: attachment; filename=DraftHargaBBM_'.$id.'.txt');
        header('Expires: 0');
        
	}

	public function downloadFileTextBeritaOpecHarian($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_berita_opec_harian');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $berita = $field->BERITA;
		}

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Berita OPEC Harian per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		echo $berita;
		
        header('Content-Disposition: attachment; filename=DraftBeritaOPECHarian_'.$id.'.txt');
        header('Expires: 0');
        
	}

	function downloadFileTextStatusKetenagalistrikan($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_stts_tl');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $status = $field->STATUS;
		}

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Status Ketenagalistrikan per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		echo $status;
		
        header('Content-Disposition: attachment; filename=DraftStatus Ketenagalistrikan_'.$id.'.txt');
        header('Expires: 0');
        
	}

	public function downloadFileTextHargaBBAcuan($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_harga_bb_acuan');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $harga = $field->HARGA;
		   $sumber = $field->SUMBER;
		}

		$harga = "Harga : ".$harga."\r\n";
		$sumber = "Sumber : ".$sumber."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Harga Batubara Acuan per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		
		echo $harga;
		echo $sumber;
		
        header('Content-Disposition: attachment; filename=DraftHargaBBAcuan_'.$id.'.txt');
        header('Expires: 0');
        
	}

	public function downloadFileTextHargaMineralAcuan($id){
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
        header('Content-Type: application/octet-stream');

      	$fields = $this->db->where('ID_LAPORAN', $id)->get('r_lap_pusdatin_harga_mineral_acuan');
      	
		foreach($fields->result() as $field)	
		{
		
		   $tanggal_laporan = $field->TANGGAL_LAPORAN;
		   $harga = $field->HARGA;
		   $sumber = $field->SUMBER;
		}

		$harga = "Harga : ".$harga."\r\n";
		$sumber = "Sumber : ".$sumber."\r\n";

		echo "Yth. Bapak Menteri ESDM & \r\n";
		echo "Yth. Bapak Wamen  ESDM \r\n";
		echo "Berikut dengan hormat kami laporkan Harga Mineral Acuan per Tanggal $tanggal_laporan : \r\n";
		echo " \r\n";
		
		echo $harga;
		echo $sumber;
		
        header('Content-Disposition: attachment; filename=DraftHargaMineralAcuan_'.$id.'.txt');
        header('Expires: 0');
        
	}

	// function text($value=''){
 //        // $yourFile = "Sample-CSV-Format.txt";
 //        // $file = @fopen($yourFile, "rb");
 //          // $this->load->model('M_pusdatin');
 //        // $file = 'asdas';

 //        header('Content-Description: File Transfer');
 //        header('Content-Type: text/plain');
 //        header('Content-Disposition: attachment; filename=Lap_pusdatin.txt');
 //        header('Expires: 0');
 //        header('Cache-Control: no-store, no-cache, must-revalidate');
 //        header('Cache-Control: post-check=0, pre-check=0');
 //        header('Pragma: no-cache');
 //        header('Expires:0')

 //        // $handle = fopen('php://output', 'w')
      


 //        header('Content-Length: ' . filesize($yourFile));
 //        while (!feof($file)) {
 //        	var_dump($file);die();
 //            print(@fread($file, 1024 * 8));
 //            ob_flush();
 //            flush();
 //        }
	// }
	
	
	public function show_form($ID_JENIS_LAPORAN="") {
		$data['dataTahunTargetProdMinyak'] = $this->M_target->select_by_apbn_tahun_prod_minyak();
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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		
		$data['dataSet'] = $this->M_pusdatin->select_by_jenis_draft($table);
		$data['dataEntry'] = $this->M_pusdatin->select_by_jenis_draft_entry($table);
		$data['dataHasReview'] = $this->M_pusdatin->select_by_jenis_draft_has_review($table);
		$id_user = $this->session->userdata('userdata')->ID_USER;
		$data['IS_POST'] = $this->M_admin->select_user_is_post($id_user)->IS_POST;
		$data['IS_REVIEW'] = $this->M_admin->select_user_is_post($id_user)->IS_REVIEW;
		$data['IS_ENTRY'] = $this->M_admin->select_user_is_post($id_user)->IS_ENTRY;
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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		else if($ID_JENIS_LAPORAN == 8){
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
		}
		// else if($data['ID_JENIS_LAPORAN'] == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($data['ID_JENIS_LAPORAN'] == 8){
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
			'FLATFORM_ENTRY' => "WEB",
			'TANGGAL_LAPORAN' => date('Y-m-d',strtotime("-1 days")),
		);
		$data = array_merge($data,$stat);
		$kemarinbanget = date('Y-m-d',strtotime("-1 days"));
		// $data["TANGGAL_LAPORAN"] = date("Y-m-d",strtotime($data["TANGGAL_LAPORAN"]));
		
		// $result = $this->M_pusdatin->insert($data,$table);

		// if ($result > 0) {
		// 	$out['status'] = '';
		// 	$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
		// } else {
		// 	$out['status'] = '';
		// 	$out['msg'] = show_err_msg('Data Draft Laporan Gagal ditambahkan', '20px');
		// }
		

		$hariini = date('Y-m-d');

		$result = $this->M_pusdatin->cek_pernah_input($hariini,$table);

		if($result > 0)
		{
			//kalau sudah ada data maka tidak di insert
			$out['status'] = '';
			$out['msg'] = show_err_msg('Data Draft Laporan Gagal (Hanya 1 per Hari)', '20px');
		}
		else
		{
			//kalau belum ada data di insert
			$result = $this->M_pusdatin->insert($data,$table);
			$out['status'] = '';
			$out['msg'] = show_succ_msg('Data Draft Laporan Berhasil ditambahkan', '20px');
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

	// public function update() {
	// 	$data['userdata'] 	= $this->userdata;

	// 	$id 				= trim($_POST['id']);
	// 	$data['dataRole'] = $this->M_role->select_all();
	// 	$data['admin']	= $this->M_admin->select_by_id($id);

	// 	echo show_my_modal('Admin/Admin/modal_update_admin', 'update-admin', $data);
	// }


	public function update() {
		$data['userdata'] 	= $this->userdata;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['jenis'];
		//$id_user = $this->session->userdata('userdata')->ID_USER;
		//var_dump($ID_JENIS_LAPORAN);exit;
		$data['dataRole'] = $this->M_role->select_all();
//		$data['admin']	= $this->M_admin->select_by_id($id);		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_pusdatin_prod_minyak";
			// $data['dataLevel'] = $this->M_pusdatin->select_alselect_prod_minyakl_level();
			$data['datanya'] = $this->M_pusdatin->select_prod_minyak($id,$table);

			echo show_my_modal('Admin/pusdatin/modal_update_draft_prod_minyak', 'form-update-draft-prodminyak', $data);
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_pusdatin_icp";
			$data['datanya'] = $this->M_pusdatin->select_icp($id,$table);
			//var_dump($data);exit;
			echo show_my_modal('Admin/pusdatin/modal_update_draft_icp', 'form-update-draft-icp', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_pusdatin_prod_gas";
			$data['datanya'] = $this->M_pusdatin->select_prod_gas($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_gas', 'form-update-draft-prodgas', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
			$data['datanya'] = $this->M_pusdatin->select_ekui_migas($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_ekui_migas', 'form-update-draft-ekui-migas', $data);
		}else if($ID_JENIS_LAPORAN == 5){
			$table = "r_lap_pusdatin_lift_tb";
			$data['datanya'] = $this->M_pusdatin->select_lift_tb($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_lift_tb', 'form-update-draft-liftingtb', $data);
		}else if($ID_JENIS_LAPORAN == 6){
			$table = "r_lap_pusdatin_harga_bbm";
			$data['datanya'] = $this->M_pusdatin->select_harga_bbm($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_drat_harga_bbm', 'form-update-draft-hargabbm', $data);
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// 	$data['datanya'] = $this->M_pusdatin->select_jamali($id,$table);
		// 	echo show_my_modal('Admin/pusdatin/modal_update_draft_jamali', 'form-update-draft-jamali', $data);
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
			$data['datanya'] = $this->M_pusdatin->select_opec($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_opec', 'form-update-draft-opec', $data);
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
			$data['datanya'] = $this->M_pusdatin->select_bb_acuan($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_harga_bb_acuan', 'form-update-draft-harga-bb-acuan', $data);
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
			$data['datanya'] = $this->M_pusdatin->select_mineral_acuan($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_harga_mineral_acuan', 'form-update-draft-mineral', $data);
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
			$data['datanya'] = $this->M_pusdatin->select_stts_tl($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_update_draft_stts_tl', 'form-update-draft-stts-tl', $data);
		}

		// echo show_my_modal('Admin/pusdatin/modal_update_draft_pusdatin', 'form-update-draft-pusdatin', $data);				
	}

	public function review() {
		$data['userdata'] 	= $this->userdata;
		$id = $_POST['id'];
		$ID_JENIS_LAPORAN = $_POST['jenis'];
		//$id_user = $this->session->userdata('userdata')->ID_USER;
		//var_dump($ID_JENIS_LAPORAN);exit;
		$data['dataRole'] = $this->M_role->select_all();
//		$data['admin']	= $this->M_admin->select_by_id($id);		
		if($ID_JENIS_LAPORAN == 1){
			$table = "r_lap_pusdatin_prod_minyak";
			// $data['dataLevel'] = $this->M_pusdatin->select_alselect_prod_minyakl_level();
			$data['datanya'] = $this->M_pusdatin->select_prod_minyak($id,$table);

			echo show_my_modal('Admin/pusdatin/modal_review_draft_prod_minyak', 'form-review-draft-prodminyak', $data);
			// // dapatkan output html
   //      $html = $this->output->get_output();
   //      // Load/panggil library dompdfnya
   //      $this->load->library('dompdf_gen');
   //      // Convert to PDF
   //      $this->dompdf->load_html($html);
   //      $this->dompdf->render();
   //      //utk menampilkan preview pdf
   //      $this->dompdf->stream("welcome.pdf", array('Attachment' => 0));
   //      //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
   //      //$this->dompdf->stream("welcome.pdf");
		}else if($ID_JENIS_LAPORAN == 2){
			$table = "r_lap_pusdatin_icp";
			$data['datanya'] = $this->M_pusdatin->select_icp($id,$table);
			//var_dump($data);exit;
			echo show_my_modal('Admin/pusdatin/modal_review_draft_icp', 'form-review-draft-icp', $data);
		}else if($ID_JENIS_LAPORAN == 3){
			$table = "r_lap_pusdatin_prod_gas";
			$data['datanya'] = $this->M_pusdatin->select_prod_gas($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_gas', 'form-review-draft-prodgas', $data);
		}else if($ID_JENIS_LAPORAN == 4){
			$table = "r_lap_pusdatin_prod_ekui_migas";
			$data['datanya'] = $this->M_pusdatin->select_ekui_migas($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_ekui_migas', 'form-review-draft-ekui-migas', $data);
		}else if($ID_JENIS_LAPORAN == 5){
			$table = "r_lap_pusdatin_lift_tb";
			$data['datanya'] = $this->M_pusdatin->select_lift_tb($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_lift_tb', 'form-review-draft-liftingtb', $data);
		}else if($ID_JENIS_LAPORAN == 6){
			$table = "r_lap_pusdatin_harga_bbm";
			$data['datanya'] = $this->M_pusdatin->select_harga_bbm($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_drat_harga_bbm', 'form-review-draft-hargabbm', $data);
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// 	$data['datanya'] = $this->M_pusdatin->select_jamali($id,$table);
		// 	echo show_my_modal('Admin/pusdatin/modal_update_draft_jamali', 'form-update-draft-jamali', $data);
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
			$data['datanya'] = $this->M_pusdatin->select_opec($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_opec', 'form-review-draft-opec', $data);
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
			$data['datanya'] = $this->M_pusdatin->select_bb_acuan($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_harga_bb_acuan', 'form-review-draft-harga-bb-acuan', $data);
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
			$data['datanya'] = $this->M_pusdatin->select_mineral_acuan($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_harga_mineral_acuan', 'form-review-draft-mineral', $data);
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
			$data['datanya'] = $this->M_pusdatin->select_stts_tl($id,$table);
			echo show_my_modal('Admin/pusdatin/modal_review_draft_stts_tl', 'form-review-draft-stts-tl', $data);
		}

		// echo show_my_modal('Admin/pusdatin/modal_update_draft_pusdatin', 'form-update-draft-pusdatin', $data);				
	}

	public function cetak($ID_JENIS_LAPORAN="") {
		

		$id = $_POST['id'];
		// var_dump($id);
		$ID_JENIS_LAPORAN = $_POST['jenis'];      	
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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		
		$data['dataSet'] = $this->M_pusdatin->select_by_jenis_draft($table);
		 // var_dump($data['dataSet']);die();
		

		$pdfFilePath = "suratketerangan.pdf";
		ob_clean();
		$this->load->library('m_pdf');
        ini_set('memory_limit', '256M');
        $pdf 			= $this->m_pdf->load();
		

			$pdf->SetHTMLHeader($htmlheader, '0', true);
	    	$pdf->SetHTMLFooter($htmlfooter);
	        $pdf->AddPageByArray([
				    'sheet-size'	=> 'A4',
				    'margin-header' => 0,
					'margin-footer' => 0,
					'margin-top'	=> 30,
				    'margin-bottom' => 30
				]);
    		$htmlisi 	= $this->load->view('Admin/pusdatin/cetak_contoh', $data, true);
    		$pdf->WriteHTML($htmlisi); 
    		// var_dump($htmlisi);die();
    	$pdf->SetDisplayMode('fullpage');
		$pdf->list_indent_first_level = 0; 
    	error_reporting(0); 
    	$pdf->Output($pdfFilePath, "I");
		ob_end_flush();

		echo json_encode($pdfFilePath);
	}

	public function previewSurat($kode) {
        $pdfFilePath = "suratketerangan.pdf";
        ob_clean();
        $this->load->library('m_pdf');
        ini_set('memory_limit', '256M');
        $pdf = $this->m_pdf->load();
        $htmlheader = $this->load->view('PKL/HeaderSurat', '', true);
        $htmlfooter = $this->load->view('PKL/FooterSurat', '', true);
       
        $data['isi']        = $this->model->templateSurat($kode);
        $pdf->SetHTMLHeader($htmlheader, '0', true);
        $pdf->SetHTMLFooter($htmlfooter);
        $pdf->AddPageByArray([
                'sheet-size'    => 'A4',
                'margin-header' => 0,
                'margin-footer' => 0,
                'margin-top' => 30,
                'margin-bottom' => 30
            ]);
        $htmlisi    = $this->load->view('PKL/IsiSuratPreview', $data, true);
        $pdf->WriteHTML($htmlisi); 
        
        $pdf->SetDisplayMode('fullpage');
        $pdf->list_indent_first_level = 0; 
        error_reporting(0); 
        $pdf->Output($pdfFilePath, "I");
        ob_end_flush();
    }




	public function updateDraftProdMinyak() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftProdMinyak($dataUpdate);
		// var_dump($dataUpdate);exit;
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftProdMinyak() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftProdMinyak($dataReview);
		//var_dump($dataUpdate);exit;
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftICP() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftICP($dataReview);
		//var_dump($dataUpdate);exit;
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}


	public function updateDraftICP() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftICP($dataUpdate);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function updateDraftProdGas() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftProdGas($dataUpdate);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftProdGas() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftProdGas($dataReview);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}


	public function updateDraftEkuiMigas() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftEkuiMigas($dataUpdate);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftEkuiMigas() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftEkuiMigas($dataReview);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftLiftTB() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftLiftTB($dataReview);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	

	public function updateDraftLiftTB() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftLiftTB($dataUpdate);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//$query = $this->M_pusdatin->prosesUpdateDraftLiftTB($dataUpdate);
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}


	public function updateDraftHargaBBM() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftHargaBBM($dataUpdate);
		
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}


	public function reviewDraftHargaBBM() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftHargaBBM($dataReview);
		
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}



	public function updateDraftJamali() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftJamali($dataUpdate);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function updateDraftOpec() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftOpec($dataUpdate);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftOpec() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftOpec($dataReview);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}


	public function updateDraftBBAcuan() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftBBAcuan($dataUpdate);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftBBAcuan() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftBBAcuan($dataReview);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}
	
	public function updateDraftMineralAcuan() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftMineralAcuan($dataUpdate);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}	

	public function reviewDraftMineralAcuan() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftMineralAcuan($dataReview);
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function updateDraftStatusTL() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataUpdate = $this->input->post();
		$query = $this->M_pusdatin->prosesUpdateDraftStatusTL($dataUpdate);

		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil diupdate', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal diupdate', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	public function reviewDraftStatusTL() {
		// $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
		// $this->form_validation->set_rules('EMAIL', 'E-Mail', 'trim|required');
		// $this->form_validation->set_rules('ID_ROLE', 'Role', 'trim|required');
		// $this->form_validation->set_rules('NAMA', 'Nama', 'trim|required');
		// $this->form_validation->set_rules('JABATAN_STRUKTURAL', 'Jabatan Struktural', 'trim|required');
		// $this->form_validation->set_rules('NIP', 'NIP', 'trim|required');
		// $this->form_validation->set_rules('IS_ADMIN', 'Admin', 'trim|required');

		$dataReview = $this->input->post();
		$query = $this->M_pusdatin->prosesReviewDraftStatusTL($dataReview);
		
		// if ($this->form_validation->run() == TRUE) {
		// 	$result = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);

		if ($query > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Berhasil direview', '20px');
		} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal direview', '20px');
			}
		// } else {
		// 	$out['status'] = 'form';
		// 	$out['msg'] = show_err_msg(validation_errors());
		// }
		//echo "<script>alert('behasil')</script>";

		echo json_encode($out);
	}

	// public function updateDraft()
	// {	
	// 	$dataUpdate = $this->input->post();
	// 	$query = $this->M_geologi->prosesUpdateDraft($dataUpdate);
		
	// 	echo "<script>alert('behasil')</script>";
	// }

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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($ID_JENIS_LAPORAN == 8){
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

	public function delete() {
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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		$result = $this->M_pusdatin->delete($table, $id, $id_user);

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
		}
		// else if($ID_JENIS_LAPORAN == 7){
		// 	$table = "r_lap_pusdatin_prog_peny_prem_jamali";
		// }
		else if($ID_JENIS_LAPORAN == 8){
			$table = "r_lap_pusdatin_berita_opec_harian";
		}else if($ID_JENIS_LAPORAN == 9){
			$table = "r_lap_pusdatin_harga_bb_acuan";
		}else if($ID_JENIS_LAPORAN == 10){
			$table = "r_lap_pusdatin_harga_mineral_acuan";
		}else if($ID_JENIS_LAPORAN == 11){
			$table = "r_lap_pusdatin_stts_tl";
		}
		$result = $this->M_pusdatin->hasreview($table, $id, $id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan siap diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan tidak siap diPosting', '20px');
		}
	}


	public function showBeforeDateProdMinyak()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));
		$kemarinbanget = date('Y-m-d',strtotime("-1 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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
			// 'kondisi_dt' => $query['KONDISI_pusdatin_DT'],
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
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
						  // ->limit(1)
						  ->limit(1)
						  ->get('r_lap_pusdatin_icp')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'keterangan' => $query['KETERANGAN']
			// 'informasi' => $query['INFORMASI'],
			// 'kondisi_dt' => $query['KONDISI_pusdatin_DT'],
			// 'penyebab_gempa' => $query['PENYEBAB_GEMPA'],
			// 'dampak_gempa' => $query['DAMPAK_GEMPA'],
			// 'rekomendasi' => $query['REKOMENDASI']
		));
	}
	public function showBeforeDateLiftingBj()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
						  // ->limit(1)
						  ->limit(1)
						  ->get('r_lap_pusdatin_lift_tb')
						  ->row_array();
		// $data = array();
		echo json_encode(array(
			'keterangan' => $query['LIFT_MB'],
			'keterangan' => $query['KETERANGAN'],
			'keterangan' => $query['KETERANGAN']
			// 'informasi' => $query['INFORMASI'],
			// 'kondisi_dt' => $query['KONDISI_pusdatin_DT'],
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
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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



	// public function showBeforeDateProgJamali()
	// {
	// 	$date = $this->input->get('tanggal');
	// 	$kemarin = date("Y-m-d", strtotime($date));


	// 	$yesterday = date('Y-m-d',strtotime("-2 days"));

	// 	$query = $this->db->select('*')
	// 					  // ->join('t_gunung')
	// 					  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
	// 					  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
	// 					  ->where('TANGGAL_LAPORAN = ', $yesterday)
	// 					  ->limit(1)
	// 					  ->get('r_lap_pusdatin_prog_peny_prem_jamali')
	// 					  ->row_array();
	// 	// $data = array();
	// 	echo json_encode(array(
	// 		//'liftmb' 	 => $query['JENIS_TERTENTU'],
	// 		'progres'   		=> $query['PROGRES'],
	// 		//'salurgas'    	 			=> $query['SALUR_GAS'],
	// 		'catatan'  			=> $query['CATATAN']
			
	// 	));
	// }
	
	

	
	public function showBeforeDateBBAcuan()
	{
		$date = $this->input->get('tanggal');
		$kemarin = date("Y-m-d", strtotime($date));


		$yesterday = date('Y-m-d',strtotime("-2 days"));

		$query = $this->db->select('*')
						  // ->join('t_gunung')
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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
						  // ->join("t_gunung", "t_gunung.ID_GUNUNG = r_lap_pusdatin_gunung_api.ID_GUNUNG","LEFT")
						  // ->join("t_aktivitas", "t_aktivitas.ID_AKTIVITAS = r_lap_pusdatin_gunung_api.ID_AKTIVITAS","LEFT")
						  // ->where('TANGGAL_LAPORAN = ', $yesterday)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->where('IS_POST <> ', Null)
						  ->where('TANGGAL_POST <>', Null)
						  ->where('TANGGAL_LAPORAN < ', $kemarinbanget)
						  ->order_by("TANGGAL_LAPORAN", "DESC")
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
		

	
	// public function updateDraft()
	// {	
	// 	$dataUpdate = $this->input->post();
	// 	$query = $this->M_pusdatin->prosesUpdateDraft($dataUpdate);
		
	// 	echo "<script>alert('behasil')</script>";
	// }
	public function postAll(){
		$id_user = $this->session->userdata('userdata')->ID_USER;

		
		$result = $this->M_pusdatin->updateAllPost($id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
		}
	}
	public function hasreviewall(){
		$id_user = $this->session->userdata('userdata')->ID_USER;

		
		$result = $this->M_pusdatin->hasreviewall($id_user);

		if ($result > 0) {
			echo show_succ_msg('Data Laporan Siap di Posting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal Di Has Review !', '20px');
		}
	}

	public function UnpostAll(){
		$id_user = $this->session->userdata('userdata')->ID_USER;

		
		$result = $this->M_pusdatin->UnpostAllPost($id_user);
// var_dump($result);die();
		if ($result > 0) {
			echo show_succ_msg('Data Laporan Berhasil di Unposting', '20px');
		} else {
			echo show_err_msg('Data Laporan Gagal di Unposting!', '20px');
		}
	}

	public function reviewAll(){
		$id_user = $this->session->userdata('userdata')->ID_USER;
		// var_dump($id_user);die();
		$data = $this->input->post('CATATAN_REVIEW');
		
		$result = $this->M_pusdatin->reviewAllPost($data,$id_user);
		// $data['datanya'] = $this->M_pusdatin->select_review_all();



		if ($result > 0) {
			// echo show_succ_msg('Data Laporan Berhasil diPosting', '20px');

			$this->session->set_flashdata('sukses',"Data Berhasil review");
			redirect('Lap_pusdatin');
		} else {
			// echo show_err_msg('Data Laporan Gagal Di Posting!', '20px');
			$this->session->set_flashdata('error',"Data Gagal review ");
			redirect('Lap_pusdatin');
		}
	}
    

	public function prosesUploadProdMinyak(){
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
                	$out['PROD_HARIAN'] = $row['PROD_HARIAN'];
                	$out['PROD_BULANAN'] = $row['PROD_BULANAN'];
                	//$TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['PROD_TAHUNAN'] = $row['PROD_TAHUNAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['APBN'] = $row['APBN'];
                   
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadICP(){
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
                   
                	
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadProdGas(){
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
                	$out['PROD_HARIAN'] = $row['PROD_HARIAN'];
                	$out['PROD_BULANAN'] = $row['PROD_BULANAN'];
                	//$TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['PROD_TAHUNAN'] = $row['PROD_TAHUNAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['APBN'] = $row['APBN'];
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadEkv(){
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
                	$out['PROD_HARIAN'] = $row['PROD_HARIAN'];
                	$out['PROD_BULANAN'] = $row['PROD_BULANAN'];
                	//$TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	$out['PROD_TAHUNAN'] = $row['PROD_TAHUNAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['APBN'] = $row['APBN'];
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadLT(){
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
                	
                	$out['LIFT_MB'] = $row['LIFT_MB'];
                	$out['LIFT_GAS'] = $row['LIFT_GAS'];
                	$out['SALUR_GAS'] = $row['SALUR_GAS'];
                	// $out['POSISI_STOCK'] = $row['POSISI_STOCK'];
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    //$out['VONA'] = "test";//$row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    // $out['VONA'] = str_replace(',', '', $row['VONA']);
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadBBM(){
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
                	$out['HARGA_PERNEGARA'] = $row['HARGA_PERNEGARA'];
                	$out['JENIS_TERTENTU'] = $row['JENIS_TERTENTU'];
                	$out['PROG_IND_SATU_HRG'] = $row['PROG_IND_SATU_HRG'];
                	// $TANGGAL_LAPORAN = $row['TANGGAL_LAPORAN'];
                	// $out['KETERANGAN'] = $row['KETERANGAN'];
                	//$DETAIL = $row['DETAIL'];
                	$out['BBM_UMUM'] = $row['BBM_UMUM'];
                   

                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadJamali(){
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
                	
                	$out['PROGRES'] = $row['PROGRES'];
                	//$DETAIL = $row['DETAIL'];
                	$out['CATATAN'] = $row['REKOMENDASI'];
                   
                }
                $out['status'] = true;
                echo json_encode($out);
            } else {
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadOpec(){
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
                   
                	
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    //$out['VONA'] = "test";//$row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    // $out['VONA'] = str_replace(',', '', $row['VONA']);
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadBBAcuan(){
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
                	$out['HARGA'] = $row['HARGA'];
                	$out['SUMBER'] = $row['SUMBER'];
                   
                	
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    //$out['VONA'] = "test";//$row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    // $out['VONA'] = str_replace(',', '', $row['VONA']);
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }
    public function prosesUploadMineral(){
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
                	$out['HARGA'] = $row['HARGA'];
                	$out['SUMBER'] = $row['SUMBER'];
                   
                	
//                    if(substr($VONA,strlen($VONA)-1,1) == "."){
//                        $VONA = substr($VONA,0,strlen($VONA)-1);
//                    }
                    //$out['VONA'] = "test";//$row['VONA'];
                   // $out['VONA'] = $row['VONA'];
                    // $out['VONA'] = str_replace(',', '', $row['VONA']);
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
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
                	
                	$out['STATUS'] = $row['STATUS'];
                   
                }
                $out['status'] = true;
                unlink($file_path);
                echo json_encode($out);
            } else {
                unlink($file_path);
            	echo json_encode(array('errorMsg'=>'Gagal Upload Data'));
			}
    
        } 
    }

	

	public function upload_all_excel()
	{
		$session = $this->session->all_userdata();
		// var_dump($session['userdata']->ID_ROLE);
		// die();
		$id_role = $session['userdata']->ID_ROLE;
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

			$table_minyak = 'r_lap_pusdatin_prod_minyak' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_minyak = $this->M_pusdatin->cek_pernah_upload_prod_minyak($hariini,$table_minyak);

			if($result_minyak > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);

			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}

			else
			{
			//Produksi Minyak
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData[0][0]=="" && $rowData[0][1]=="" && $rowData[0][2]=="" && $rowData[0][3]=="" ){
			break;
			}
			$data = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"PROD_HARIAN"=> $rowData[0][0],
			"PROD_BULANAN"=> $rowData[0][1],
			"PROD_TAHUNAN"=> $rowData[0][2],
			"APBN"=> $rowData[0][3],
			"CATATAN"=> $rowData[0][4]

			);

			$result_minyak = $this->db->insert($table_minyak,$data);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');
			}
			}


			// $insert = $this->db->insert("r_lap_pusdatin_icp",$data_2);

			$table_icp = 'r_lap_pusdatin_icp' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_icp = $this->M_pusdatin->cek_pernah_upload_icp($hariini,$table_icp);

			if($result_icp > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);

			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}

			else
			{
			//ICP
			$sheet_2 = $objPHPExcel->getSheet(1);
			$highestRow = $sheet_2->getHighestRow();
			$highestColumn = $sheet_2->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_2 = $sheet_2->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_2[0][0]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_2 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"PROD_01"=> $rowData_2[0][0],
			"PROD_02"=> $rowData_2[0][1],
			"PROD_03"=> $rowData_2[0][2],
			"PROD_04"=> $rowData_2[0][3],
			"PROD_05"=> $rowData_2[0][4],
			"PROD_06"=> $rowData_2[0][5],
			"PROD_07"=> $rowData_2[0][6],
			"PROD_08"=> $rowData_2[0][7],
			"PROD_09"=> $rowData_2[0][8],
			"PROD_10"=> $rowData_2[0][9],
			"PROD_11"=> $rowData_2[0][10],
			"PROD_12"=> $rowData_2[0][11],
			"RATARATA"=> $rowData_2[0][11],
			"CATATAN"=> $rowData_2[0][11],
			
			);
			$result_icp = $this->db->insert($table_icp,$data_2);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);


			$this->db->update('t_user');

			}
			}

			 

			// $insert = $this->db->insert("r_lap_pusdatin_prod_gas",$data_3);


			$table_gas = 'r_lap_pusdatin_prod_gas' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_gas = $this->M_pusdatin->cek_pernah_upload_prod_gas($hariini,$table_gas);

			if($result_gas > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);

			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}

			else
			{

			//Produksi Gas
			$sheet_3 = $objPHPExcel->getSheet(2);
			$highestRow = $sheet_3->getHighestRow();
			$highestColumn = $sheet_3->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_3 = $sheet_3->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_3[0][0]=="" && $rowData_3[0][1]=="" && $rowData_3[0][2]=="" && $rowData_3[0][3]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_3 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"PROD_HARIAN"=> $rowData_3[0][0],
			"PROD_BULANAN"=> $rowData_3[0][1],
			"PROD_TAHUNAN"=> $rowData_3[0][2],
			"APBN"=> $rowData_3[0][3],
			"CATATAN"=> $rowData_3[0][4]

			);
			$result_gas = $this->db->insert($table_gas,$data_3);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}

			// $insert = $this->db->insert("r_lap_pusdatin_prod_ekui_migas",$data_4);


			$table_ekv_migas = 'r_lap_pusdatin_prod_ekui_migas' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_migas = $this->M_pusdatin->cek_pernah_upload_prod_ekui_migas($hariini,$table_ekv_migas);

			if($result_migas > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);

			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{
			//kalau belum ada data di insert
			//Produksi Ekuivalen Migas
			$sheet_4 = $objPHPExcel->getSheet(3);
			$highestRow = $sheet_4->getHighestRow();
			$highestColumn = $sheet_4->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_4 = $sheet_4->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_4[0][0]=="" && $rowData_4[0][1]=="" && $rowData_4[0][2]=="" && $rowData_4[0][3]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_4 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"PROD_HARIAN"=> $rowData_4[0][0],
			"PROD_BULANAN"=> $rowData_4[0][1],
			"PROD_TAHUNAN"=> $rowData_4[0][2],
			"APBN"=> $rowData_4[0][3],
			"CATATAN"=> $rowData_4[0][4]

			);
			$result_migas = $this->db->insert($table_ekv_migas,$data_4);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			$this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}

			 

			$table_lift_tb = 'r_lap_pusdatin_lift_tb' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_lift_tb = $this->M_pusdatin->cek_pernah_upload_prod_ekui_migas($hariini,$table_lift_tb);

			if($result_lift_tb > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);

			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}

			else
			{
			//Lifting Tahun Berjalan
			$sheet_5 = $objPHPExcel->getSheet(4);
			$highestRow = $sheet_5->getHighestRow();
			$highestColumn = $sheet_5->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_5 = $sheet_5->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_5[0][0]=="" && $rowData_5[0][1]=="" && $rowData_5[0][2]=="" && $rowData_5[0][3]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_5 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"LIFT_MB"=> $rowData_5[0][0],
			"SALUR_GAS"=> $rowData_5[0][1],
			"LIFT_GAS"=> $rowData_5[0][2]
			);
			$result_lift_tb = $this->db->insert($table_lift_tb,$data_5);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}


			// $insert = $this->db->insert("r_lap_pusdatin_harga_bbm",$data_6);

			$table_bbm = 'r_lap_pusdatin_harga_bbm' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_bbm = $this->M_pusdatin->cek_pernah_upload_harga_bbm($hariini,$table_bbm);

			if($result_bbm > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);
			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{

			//Harga BBM
			$sheet_6 = $objPHPExcel->getSheet(5);
			$highestRow = $sheet_6->getHighestRow();
			$highestColumn = $sheet_6->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_6 = $sheet_6->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_6[0][0]=="" && $rowData_6[0][1]=="" && $rowData_6[0][2]=="" && $rowData_6[0][3]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_6 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"JENIS_TERTENTU"=> $rowData_6[0][0],
			"BBM_UMUM"=> $rowData_6[0][1],
			"PROG_IND_SATU_HRG"=> $rowData_6[0][2],
			"HARGA_PERNEGARA"=> $rowData_6[0][3],
			"CATATAN"=> $rowData_6[0][4]

			);
			$result_bbm = $this->db->insert($table_bbm,$data_6);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}


			// $insert = $this->db->insert("r_lap_pusdatin_berita_opec_harian",$data_7);

			 

			$table_opec = 'r_lap_pusdatin_berita_opec_harian' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_opec = $this->M_pusdatin->cek_pernah_upload_berita_opec($hariini,$table_opec);

			if($result_opec > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);
			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{
			//kalau belum ada data di insert


			//Berita OPEC Harian
			$sheet_7 = $objPHPExcel->getSheet(6);
			$highestRow = $sheet_7->getHighestRow();
			$highestColumn = $sheet_7->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_7 = $sheet_7->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_7[0][0]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_7 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"BERITA"=> $rowData_7[0][0],
			"CATATAN"=> $rowData_7[0][1]
			);
			$result_opec = $this->db->insert($table_opec,$data_7);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');
			}
			}

			 

			// $insert = $this->db->insert("r_lap_pusdatin_harga_bb_acuan",$data_8);


			$table_bb_acuan = 'r_lap_pusdatin_harga_bb_acuan' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_bb_acuan = $this->M_pusdatin->cek_pernah_upload_bb_acuan($hariini,$table_bb_acuan);

			if($result_bb_acuan > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);
			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{
			//kalau belum ada data di insert
			// $result = $this->M_pusdatin->insert($data,$table_bb_acuan);

			// $out['status'] = '';
			// $out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diUpload / tambahkan', '20px');

			//Harga Batubara Acuan
			$sheet_8 = $objPHPExcel->getSheet(7);
			$highestRow = $sheet_8->getHighestRow();
			$highestColumn = $sheet_8->getHighestColumn();
			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_8 = $sheet_8->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_8[0][0]=="" && $rowData_8[0][1]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_8 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"HARGA"=> $rowData_8[0][0],
			"SUMBER"=> $rowData_8[0][1],
			"CATATAN"=> $rowData_8[0][2]

			);
			$result_bb_acuan = $this->db->insert($table_bb_acuan,$data_8);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');
			}
			}

			 

			// $insert = $this->db->insert("r_lap_pusdatin_harga_mineral_acuan",$data_9);

			 

			$table_mineral = 'r_lap_pusdatin_harga_mineral_acuan' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_mineral = $this->M_pusdatin->cek_pernah_upload_mineral_acuan($hariini,$table_mineral);

			if($result_mineral > 0)
			{
			//kalau sudah ada data maka tidak di insert
			// $out['status'] = '';
			// $out['msg'] = show_err_msg('Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)', '20px');
			unlink($inputFileName);
			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{
			//kalau belum ada data di insert
			// $result = $this->M_pusdatin->insert($data,$table);

			// $out['status'] = '';
			// $out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diUpload / tambahkan', '20px');
			//Harga Mineral Acuan
			$sheet_9 = $objPHPExcel->getSheet(8);
			$highestRow = $sheet_9->getHighestRow();
			$highestColumn = $sheet_9->getHighestColumn();

			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_9 = $sheet_9->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_9[0][0]=="" && $rowData_9[0][1]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_9 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"HARGA"=> $rowData_9[0][0],
			"SUMBER"=> $rowData_9[0][1]
			);

			$result_mineral = $this->db->insert($table_mineral,$data_9);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}


			// $insert = $this->db->insert("r_lap_pusdatin_stts_tl",$data_10);

			$table_stts_tl = 'r_lap_pusdatin_stts_tl' ;
			// echo $table.'hehe';die();
			$hariini = date('Y-m-d');

			$result_stts_tl = $this->M_pusdatin->cek_pernah_upload_sttl($hariini,$table_stts_tl);
			//var_dump($result_stts_tl);die();
			if($result_stts_tl > 0)
			{
			//kalau sudah ada data maka tidak di insert
			unlink($inputFileName);
			$this->session->set_flashdata('error',"Data Draft Laporan Gagal di Upload (Hanya 1 per Hari)");
			redirect('Lap_pusdatin');
			}
			else
			{
			//kalau belum ada data di insert
			// $result = $this->M_pusdatin->insert($data,$table_stts_tl);

			// $out['status'] = '';
			// $out['msg'] = show_succ_msg('Data Draft Laporan Berhasil diUpload / tambahkan', '20px');
			//Status Ketenagalistrikan
			$sheet_10 = $objPHPExcel->getSheet(9);
			$highestRow = $sheet_10->getHighestRow();
			$highestColumn = $sheet_10->getHighestColumn();

			$tanggal_laporan = date('Y-m-d', strtotime(" -1 day"));
			for ($row = 2; $row <= $highestRow; $row++){ // Read a row of data into an array
			$rowData_10 = $sheet_10->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			if ($rowData_10[0][0]=="" ){
			break; $this->session->set_flashdata('error',"Data Gagal Diimpor");
			redirect('Lap_pusdatin');
			}
			$data_10 = array(
			'USER_ENTRY' => $this->session->userdata('userdata')->ID_USER,
			'TANGGAL_ENTRY' => date("Y-m-d H:m:s"),
			'FLATFORM_ENTRY' => "WEB",
			"TANGGAL_LAPORAN" => $tanggal_laporan,
			"STATUS"=> $rowData_10[0][0],
			"CATATAN"=> $rowData_10[0][1]


			);

			$result_stts_tl = $this->db->insert($table_stts_tl,$data_10);
			$this->db->set('READY_REVIEW', 'Y');
			$this->db->set('HAS_REVIEW', Null);
			// $this->db->where('ID_ROLE', $id_role);
			$this->db->where('ID_ROLE', 15,1);
			$this->db->update('t_user');
			$this->db->set('HAS_UNPOST', Null);
			$this->db->where('ID_ROLE', 8);
			// $this->db->where('ID_ROLE', 17);
			// $this->db->where('ID_USER', 18);

			$this->db->update('t_user');

			}
			}


			unlink($inputFileName);
			$this->session->set_flashdata('sukses',"Data Berhasil Diimpor");
			redirect('Lap_pusdatin');
		} else {
		$this->session->set_flashdata('error',"Masukkan file dahulu");
		redirect('Lap_pusdatin');
		}
	}		    
}