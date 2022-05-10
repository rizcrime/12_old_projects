
<form id="formToSave" method="POST" action="">

<!--<form id="form-tambah-gunung" method="POST" action="<?= base_url('Lap_pusdatin/reviewAll');?>">
-->
<!-- <style type="text/css">
/* Inspired by http://stackoverflow.com/a/10150898/724752 */
td:first-child {
  box-shadow:
    inset 0px 11px 8px -10px blue,
    inset 0px -11px 8px -10px black,
    inset 11px 0px 8px -10px black; 
}
td {
  box-shadow:
    inset 0px 11px 8px -10px black,
    inset 0px -11px 8px -10px black;
}
td:last-child {
  box-shadow:
    inset 0px 11px 8px -10px black,
    inset 0px -11px 8px -10px black,
    inset -11px 0px 8px -10px red; 
}

/* Regular table setup, you can ignore this. */
/*table { border-collapse: collapse; }
td { border: 1px solid black; }*/
</style> -->
<?=get_csrf_token()?>

<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Pusdatin</strong></h4>
  </div>

</div>
<div class="form-msg">
<table width="100%" >
    <tr>
      <td bgcolor="#efefef">
        &nbsp; Yth. Bapak Menteri ESDM &
        <br>
        &nbsp; Yth. Bapak Wamen ESDM
        <br>
        &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas 
        <br>
        &nbsp; Bumi, Lifting, ICP, Harga BBM, Premium Reborn, Mineral dan Batubara, 
        <br>
        &nbsp; serta Ketenagalistrikan, per Tanggal <?php echo date('d M Y')?> sebagai berikut :
      </td>
    </tr>
  </table>
<!-- <tr>
	<td class="border">
	<table width="100%">
    	<tr bgcolor="efefef">
                    <td width="100%" style="padding:0 5 0 5; font-size:14px;" colspan="4">Yth. Bapak Menteri ESDM & </td> 
                    
</tr><br />

<tr bgcolor="efefef">
                   
                    <td width="100%" style="padding:0 5 0 5; font-size:14px;" colspan="4">Yth. Bapak Wamen ESDM</td>
</tr>
<br />
<br />
<tr bgcolor="efefef">
                   
                    <td width="100%" style="padding:0 5 0 5; font-size:14px;" colspan="4">Berikut dengan hormat kami laporkan Status Produksi Minyak dan Gas Bumi, Lifting, ICP, Harga BBM, Premium Reborn, Mineral dan Batubara, serta Ketenagalistrikan, per tanggal <?php echo date('d M Y')?> sbb :</td>
</tr>
</table> -->
    

<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-prodminyak_view-all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><p align="left" style="color: #FFFF00;"><strong>&nbsp; 1. PRODUKSI MINYAK</strong></p></td>
	</tr>
		
  <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>
  <table id="collapseminyak_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");

	$kemarin = date('Y-m-d',strtotime("-1 days"));
	
//	$kemarin = date('Y-m-d',strtotime("-1 days"));
	//echo $kemarin.'hehe';
	/*	$this->db->where('HAS_REVIEW', Null);
		$this->db->where('CATATAN_REVIEW', Null);
		$this->db->where('TANGGAL_REVIEW', Null);*/
   $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
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
				//order by TANGGAL_LAPORAN DESC limit 1 ");
//    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_minyak where IS_POST IS NULL AND TANGGAL_POST IS NULL AND TANGGAL_LAPORAN = '".$kemarin."' ORDER BY TANGGAL_LAPORAN and ID_LAPORAN DESC ");
      $no=0;
	  
      foreach ($dataGunung->result_array() as $row)
    {
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
      $no++;
    ?>

    <tr>
      <td width="25%" style="padding:0 5 0 5" colspan="4" bgcolor="efefef">&nbsp;  &nbsp; &nbsp; Produksi Minyak Harian Tanggal <?= $row['TANGGAL_LAPORAN'] ?> : <?php echo $row['PROD_HARIAN']?> BOPD</td>
    </tr>
    <tr>
      <td width="25%" style="padding:0 5 0 5" colspan="4" bgcolor="efefef">&nbsp;  &nbsp; &nbsp;  Produksi Minyak Bulanan : <?php echo $row['PROD_BULANAN']?> BOPD</td>
    </tr>
    <tr>
      <td width="25%" style="padding:0 5 0 5" colspan="4" bgcolor="efefef">&nbsp;  &nbsp; &nbsp;  Produksi Minyak Tahunan : <?php echo $row['PROD_TAHUNAN']?> BOPD</td>
    </tr>
    <tr>
      <td width="25%" style="padding:0 5 0 5" colspan="4" bgcolor="efefef">&nbsp;  &nbsp; &nbsp;  APBN : <?php echo $row['APBN']?> BOPD</td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table>
</table>

<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-icp_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong><p align="left"style="color:#FFFF00;)">&nbsp; 2. ICP</p></strong></td>
	</tr>
		
  <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>
  <table id="collapseicp_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_icp ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_icp where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  	order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
        
      $no++;
      
    ?>
  				
    <tr bgcolor="efefef">
      <td width="100%" style="padding:0 5 0 5" colspan="4"><p style="margin-left:20px"><?php echo $row['KETERANGAN']?></p></td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table>
</table>

<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-prodgas_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong><p align="left"style="color:#FFFF00;">&nbsp; 3. PRODUKSI GAS</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsegas_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%" >	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_gas where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL  
	order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
	  $no++;	  
    ?>
			
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">	<div align="left">&nbsp; &nbsp; &nbsp; Produksi Harian Gas Tanggal <?php echo $kemarin?>	:	<?php echo $row['PROD_HARIAN']?> MMSCFD</div></td>                
    </tr>
                            
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Rata - rata Produksi Bulanan : <?php echo $row['PROD_BULANAN']?> MMSCFD</td>
    </tr>
                           
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Rata - rata Produksi Tahunan : <?php echo $row['PROD_TAHUNAN']?> MMSCFD</td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
   
<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-ekvminyakgas_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong><p align="left"style="color:#FFFF00;">&nbsp; 4. PRODUKSI EKUIVALEN MINYAK DAN GAS</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

  <table id="collapseekvminyakgas_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prod_ekui_migas where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
          
      $no++;
      
    ?>
  					
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">	<div align="left">&nbsp; &nbsp; &nbsp; Produksi Harian Tanggal <?php echo $kemarin?> : <?php echo $row['PROD_HARIAN']?> BOEPD</div></td>
    </tr>
            
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Rata - rata Produksi Bulanan : <?php echo $row['PROD_BULANAN']?> BOEPD</td>
    </tr>
            
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Rata - rata Produksi Tahunan : <?php echo $row['PROD_TAHUNAN']?> BOEPD</td>
    </tr>
            
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Target Lifting APBN : <?php echo $row['APBN']?> BOEPD</td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
   
<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-liftingth1" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong><p align="left"style="color:#FFFF00;">&nbsp; 5. LIFTING TAHUN BERJALAN</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

  <table id="collapseliftingth1" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1 ");
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_lift_tb ");
    
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
      
      $no++;
      
    ?>
  					
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; LIFTING MINYAK BUMI :</td>
    </tr>
    <tr bgcolor="efefef">
      <!-- <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['LIFT_MB']?></td> -->
      <td width="25%" style="padding:0 5 0 5" colspan="4"> <p style="margin-left:20px"><?php echo $row['LIFT_MB']?></p></td>
    </tr>
                
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; POSISI STOCK HARI INI :</td>
    </tr>
    <tr bgcolor="efefef">
    <!--   <td width="25%" style="padding:0 5 0 5">
    &nbsp; &nbsp; &nbsp; <?php echo $row['POSISI_STOCK']?>
      </td> -->    
      <td width="25%" style="padding:0 5 0 5"><p style="margin-left:20px"><?php echo $row['POSISI_STOCK']?></p>
      </td>               
    </tr>
                
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; SALUR GAS :</td>
    </tr>
    <tr bgcolor="efefef">
      <!-- <td style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; <?php echo $row['SALUR_GAS']?></td>                 -->
      <td style="padding:0 5 0 5"><p style="margin-left:20px"> <?php echo $row['SALUR_GAS']?></p></td>                
    </tr>
    
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; LIFTING MIGAS :</td>
    </tr>
    <tr bgcolor="efefef">
      <!-- <td style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; <?php echo $row['LIFT_GAS']?></td>                 -->
      <td style="padding:0 5 0 5"><p style="margin-left:20px"> <?php echo $row['LIFT_GAS']?></p></td>                
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
   
<table width="100%">
  <tr >
    <td width="100%" height="16" colspan="4" align="center" bgcolor="#222d32" class="border; btn-hargabbm_view_all" style="padding:0 5 0 5; font-size:14px" ><strong><p align="left"style="color:#FFFF00;">&nbsp; 6. HARGA BBM</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsehargabbm_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_bbm where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
    ?>
			
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; A. JENIS BBM TERTENTU</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['JENIS_TERTENTU']?></td>
    </tr>
                
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; B. JENIS BBM UMUM</td>
    </tr>
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['BBM_UMUM']?>
      </td>               
    </tr>
                
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; C. PROGRAM INDONESIA SATU HARGA</td>
    </tr>
    <tr bgcolor="efefef">
      <td style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['PROG_IND_SATU_HRG']?></td>                
    </tr>
                
    <tr bgcolor="efefef">
      <td width="25%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; D. PER NEGARA:</td>
    </tr>
    <tr bgcolor="efefef">
      <td style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['HARGA_PERNEGARA']?>
      </td>              
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
	</table> 
</table>
   
<!--<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-progpremjamali" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong><p align="left"style="color:#FFFF00;">&nbsp; 7. PROGRES PENYALURAN PREMIUM JAMALI</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapseprogpremjamali" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prog_peny_prem_jamali ");
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_prog_peny_prem_jamali where IS_POST IS NULL AND TANGGAL_POST IS NULL order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
		$no++
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
    ?>
  					
    <tr bgcolor="efefef">
      <td width="10%" style="padding:0 5 0 5" colspan="4">&nbsp; PROGRES :</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="10%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['PROGRES']?></td>
    </tr>
                
    <tr bgcolor="efefef">
      <td width="10%" style="padding:0 5 0 5" colspan="4">&nbsp; CATATAN :</td>
    </tr>
    <tr bgcolor="efefef">
      <td width="10%" style="padding:0 5 0 5">&nbsp; &nbsp; &nbsp; <?php echo $row['CATATAN']?>
      </td>               
    </tr>
	<tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>               
    <?php              
    }
    ?>
  </table> 
</table>-->
   
<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-opec_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong>
    <p align="left"style="color:#FFFF00;">&nbsp; 7. BERITA OPEC HARIAN</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapseopec_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_berita_opec_harian where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
    //  $no=0;
//    $queryResult = $db->query($dataGunung);
//	$count = $queryResult->fetchColumn();
//	echo $count.'lele';
	  foreach ($dataGunung->result_array() as $row)
    {
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
          $no++;
    ?>
			
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; BERITA :</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['BERITA']?></td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>

<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-batubracuan_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong>
    <p align="left"style="color:#FFFF00;">&nbsp; 8. HARGA BATUBARA ACUAN</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsebatubracuan_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan ");
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_bb_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
      $no=0;
    $urutan='A';
      foreach ($dataGunung->result_array() as $row)
    {
          
      $urutan++;
      
    ?>

    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Harga : <?php echo $row['HARGA']?></td>                
    </tr>
                
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Sumber :</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['SUMBER']?></td>
    </tr>
    <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
   
<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" clabgcolor="#222d32" class="border; btn-mineralacuan_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong>
    <p align="left"style="color:#FFFF00;">&nbsp; 9. HARGA MINERAL ACUAN</p></strong></td>
	</tr>
	  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsemineralacuan_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
   $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
	    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_harga_mineral_acuan ");

      $no=0;
    $urutan='A';
      foreach ($dataGunung->result_array() as $row)
    {
          
      $no++;
      
    ?>
  					
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Harga : <?php echo $row['HARGA']?></td>                
    </tr>
                
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; Sumber :</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['SUMBER']?></td>
    </tr>
    <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
     
<table width="100%">
  <tr >
    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-stsgatrik_view_all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><strong>
    <p align="left"style="color:#FFFF00;">&nbsp; 10. STATUS KETENAGALISTRIKAN</p></strong></td>
	</tr>
  <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsestsgatrik_view_all" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
    <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $kemarin = date('Y-m-d',strtotime("-1 days"));    
    $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl where IS_POST IS NULL AND CATATAN_REVIEW IS  NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and
				TANGGAL_POST IS NULL   order by TANGGAL_LAPORAN DESC limit 1");
    // $dataGunung = $this->db->query("SELECT * from r_lap_pusdatin_stts_tl ");
      $no=0;
      foreach ($dataGunung->result_array() as $row)
    {
		$no++
          //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
    ?>
  		           
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; STATUS :</td>                
    </tr>
    <tr bgcolor="efefef">
      <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $row['STATUS']?></td>
    </tr>
    <tr><td height="4" colspan="4" bgcolor='#aaafff'></td></tr>
               
    <?php              
    }
    ?>
  </table> 
</table>
    
    </td>
</tr>
</div>
    <p>
<!--    <button type="submit"> Save as TXT</button>
-->    <a target="_blank" href="<?php echo base_url().'Lap_pusdatin/downloadFileText';?>">Save As TXT</a>

    </p>

</form>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
<script type="text/javascript">



$(document).ready(function(){

//  tampilProfile_perusahaan();
  get_kabkot($('#PROVINSI'));
  
  $('#PROVINSI').change(function(){
    get_kabkot(this);
  });
});

function get_kabkot(provinsi_data) {
  var id=$(provinsi_data).val();
  var curr_id_kabkot = "<?=isemptyor($gunung->ID_KABKOT, '')?>";

  $.ajax({
    url : "<?php echo base_url();?>Gunung/get_kabkot",
    method : "POST",
    data : {id: id},
    async : false,
    dataType : 'json',
    success: function(data){
      if(data.length != 0) {
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          var is_selected = "";
          if(data[i].ID_KABKOT == curr_id_kabkot) {
            is_selected = "selected";
          }

          html += '<option ' + is_selected +' value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
        }
        $('.KABKOT').html(html);
      } else {
        var html = '<option value="">--PILIH PROVINSI DAHULU--</option>';
        $('.KABKOT').html(html);
      }
    }
  });
}


// This will generate the text file content based on the form data
function buildData(){
    var txtData = "Name: "+$("#nameField").val()+
            "\r\nLast Name: "+$("#lastNameField").val()+
            "\r\nGender: "+($("#genderMale").is(":checked")?"Male":"Female");

    return txtData;
}
// This will be executed when the document is ready
$(function(){
    // This will act when the submit BUTTON is clicked
    $("#formToSave").submit(function(event){
        event.preventDefault();
        var txtData = buildData();
        window.location.href="data:application/octet-stream;base64,"+Base64.encode(txtData);
    });

    // This will act when the submit LINK is clicked
    $("#submitLink").click(function(event){
        var txtData = buildData();
        $(this).attr('download','sugguestedName.txt')
            .attr('href',"data:application/octet-stream;base64,"+Base64.encode(txtData));
    });
});
//-->

	
	
	
	 $(".btn-prodminyak_view-all").click(function() {
		if($("#collapseminyak_view_all").hasClass("out")) {
			$("#collapseminyak_view_all").addClass("in");
			$("#collapseminyak_view_all").removeClass("out");
		} else {
			$("#collapseminyak_view_all").addClass("out");
			$("#collapseminyak_view_all").removeClass("in");
		}
	});
	
	$(".btn-icp_view_all").click(function() {
		if($("#collapseicp_view_all").hasClass("out")) {
			$("#collapseicp_view_all").addClass("in");
			$("#collapseicp_view_all").removeClass("out");
		} else {
			$("#collapseicp_view_all").addClass("out");
			$("#collapseicp_view_all").removeClass("in");
		}
	});
	
	$(".btn-prodgas_view_all").click(function() {
		if($("#collapsegas_view_all").hasClass("out")) {
			$("#collapsegas_view_all").addClass("in");
			$("#collapsegas_view_all").removeClass("out");
		} else {
			$("#collapsegas_view_all").addClass("out");
			$("#collapsegas_view_all").removeClass("in");
		}
	});
	
	$(".btn-ekvminyakgas_view_all").click(function() {
		if($("#collapseekvminyakgas_view_all").hasClass("out")) {
			$("#collapseekvminyakgas_view_all").addClass("in");
			$("#collapseekvminyakgas_view_all").removeClass("out");
		} else {
			$("#collapseekvminyakgas_view_all").addClass("out");
			$("#collapseekvminyakgas_view_all").removeClass("in");
		}
	});
	
	
	 $(".btn-liftingth1").click(function() {
		if($("#collapseliftingth1").hasClass("out")) {
			$("#collapseliftingth1").addClass("in");
			$("#collapseliftingth1").removeClass("out");
		} else {
			$("#collapseliftingth1").addClass("out");
			$("#collapseliftingth1").removeClass("in");
		}
	});
	
	$(".btn-hargabbm_view_all").click(function() {
		if($("#collapsehargabbm_view_all").hasClass("out")) {
			$("#collapsehargabbm_view_all").addClass("in");
			$("#collapsehargabbm_view_all").removeClass("out");
		} else {
			$("#collapsehargabbm_view_all").addClass("out");
			$("#collapsehargabbm_view_all").removeClass("in");
		}
	});
	
	$(".btn-progpremjamali").click(function() {
		if($("#collapseprogpremjamali").hasClass("out")) {
			$("#collapseprogpremjamali").addClass("in");
			$("#collapseprogpremjamali").removeClass("out");
		} else {
			$("#collapseprogpremjamali").addClass("out");
			$("#collapseprogpremjamali").removeClass("in");
		}
	});
	
	$(".btn-opec_view_all").click(function() {
		if($("#collapseopec_view_all").hasClass("out")) {
			$("#collapseopec_view_all").addClass("in");
			$("#collapseopec_view_all").removeClass("out");
		} else {
			$("#collapseopec_view_all").addClass("out");
			$("#collapseopec_view_all").removeClass("in");
		}
	});
	
	
	$(".btn-batubracuan_view_all").click(function() {
		if($("#collapsebatubracuan_view_all").hasClass("out")) {
			$("#collapsebatubracuan_view_all").addClass("in");
			$("#collapsebatubracuan_view_all").removeClass("out");
		} else {
			$("#collapsebatubracuan_view_all").addClass("out");
			$("#collapsebatubracuan_view_all").removeClass("in");
		}
	});
	
	$(".btn-mineralacuan_view_all").click(function() {
		if($("#collapsemineralacuan_view_all").hasClass("out")) {
			$("#collapsemineralacuan_view_all").addClass("in");
			$("#collapsemineralacuan_view_all").removeClass("out");
		} else {
			$("#collapsemineralacuan_view_all").addClass("out");
			$("#collapsemineralacuan_view_all").removeClass("in");
		}
	});
	
	$(".btn-stsgatrik_view_all").click(function() {
		if($("#collapsestsgatrik_view_all").hasClass("out")) {
			$("#collapsestsgatrik_view_all").addClass("in");
			$("#collapsestsgatrik_view_all").removeClass("out");
		} else {
			$("#collapsestsgatrik_view_all").addClass("out");
			$("#collapsestsgatrik_view_all").removeClass("in");
		}
	});
	
  // Datepicker
  $('.tgl_dokumen_datepicker').datepicker({
    format: 'yyyy-mm-dd',
    endDate: '<?=date("Y-m-d")?>'
  });

  $('.tgl_dokumen_datepicker').on('changeDate show', function(e) {
    this.setCustomValidity('');
  });

  $('.tgl_kedaluarsa_datepicker').on('changeDate show', function(e) {
    this.setCustomValidity('');
  });

  $('.tgl_kedaluarsa_datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '<?=date("Y-m-d")?>'
  });
  
<!--    $('#notifikasi').slideDown('slow').delay(3000).slideUp('slow');
-->
</script>