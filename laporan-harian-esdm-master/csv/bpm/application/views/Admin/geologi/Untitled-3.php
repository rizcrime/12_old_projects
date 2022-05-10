<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table cellpadding="0" cellspacing="0" border="0" width="595" align="center">
	
    <tr>
		<td class="border">
<!-- content begin -->
            <!--<table cellpadding="0" cellspacing="1" border="0" width="100%">-->
               
            <!--<tr>
                <td>
                  <button type="button" class="btn">
                    Click to expand
                  </button>
                </td>
        	</tr>
        	<tr id="collapseme" class="collapse out"><td>okela</td></tr>    -->
            
            <tr >
            <td width="20%" align="center" bgcolor="#D0E4FF" class="border; btn-gn_api" style="padding:0 5 0 5; font-size:14px" colspan="4"><p align="left"style="color: rgb(51,102,255)">1. GUNUNG API</p></td>
			</tr>
            
            <table id="collapsegnapi" class="collapse out" cellpadding="0" cellspacing="1" border="0" width="100%">
            <tr>
            <td>
  <?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_geologi_gunung_api  				  left join t_gunung 
				  on r_lap_geologi_gunung_api.ID_GUNUNG = 	t_gunung.ID_GUNUNG
				  LEFT JOIN t_aktivitas
				  on r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS ");
    $no=1;
    foreach ($dataGunung->result_array() as $row)
	{
        //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
		
		
  ?>
  				
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><?php echo $row['ID_LAPORAN']?>.	<?php echo strtoupper($row['NAMA_GUNUNG'])?></td> 
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">	TINGKAT LEVEL :</td>
                  
                    
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><?php echo $row['LEVEL']?></td>
                  
                    
                </tr>
                
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">KETERANGAN :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5">
					<?php echo $row['KETERANGAN']?>
                    </td>
                   
                </tr>
                
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">DETAIL :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><?php echo $row['DETAIL']?></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">REKOMENDASI :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<?php echo $row['REKOMENDASI']?></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">VONA :</td>
                </tr>

                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<?php echo $row['VONA']?></td>    
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
                
  <?php              
	}
   ?>
   		
   				</td>
                </tr>
                </table>
                
        
            <tr>
            <td width="20%" align="center" bgcolor="#D0E4FF" class="border; btn-tanah" style="padding:0 5 0 5; font-size:14px" colspan="4"><p align="left"style="color: rgb(51,102,255)">2. GERAKAN TANAH</p></td>
			</tr>
                
	<?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_geologi_gerakan_tanah");
    $no=1;
    foreach ($dataGunung->result_array() as $row)
	{
       
        $no++;
		
  ?>
  
  	<table id="collapsetanah" class="collapse out" cellpadding="0" cellspacing="1" border="0" width="100%">
    
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><?php echo $row['ID_LAPORAN']?>.	KETERANGAN :</td>
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">				<?php echo $row['KETERANGAN']?></td>
                </tr>
               
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;DETAIL :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5">
					<?php echo $row['DETAIL']?>
                    </td>
                   
                </tr>
               <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php              
	}
   ?>
   				</table>
                       
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
                
            <tr>
            <td width="20%" align="center" bgcolor="#D0E4FF" class="border; btn-gempa_bumi" style="padding:0 5 0 5; font-size:14px" colspan="4"><p align="left"style="color: rgb(51,102,255)">3. GEMPA BUMI</p></td>
			</tr>
                <?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_geologi_gempa_bumi");
    $no=1;
    foreach ($dataGunung->result_array() as $row)
	{
        //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
		$informasi_gempa = $row['INFORMASI'];
		$kondisi_geologi_gempa = $row['KONDISI_GEOLOGI_DT'];
		$penyebab_gempa = $row['PENYEBAB_GEMPA'];
		$dampak_gempa = $row['DAMPAK_GEMPA'];
        $rekomendasi = $row['REKOMENDASI'];
        $no++;
		
  ?>
  		
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">LOKASI : <?php echo $row['LOKASI']?></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">INFORMASI GEMPA BUMI :</td>
                    
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><?php echo $informasi_gempa?></td>
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">KONDISI GEOLOGI DAERAH TERDEKAT PUSAT GEMPA BUMI :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5">
					<?php echo $kondisi_geologi_gempa?>
                    </td>
                   
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">PENYEBAB GEMPA BUMI :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><?php echo $penyebab_gempa?></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">DAMPAK GEMPA BUMI :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<?php echo $dampak_gempa?></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">REKOMENDASI :</td>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<?php echo $rekomendasi?></td>    
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
  <?php              
	}
   ?>       
            <!--</table>-->
            
<!-- end content begin -->
		</td>
    </tr>
	<!--<tr><td height="25" align="center" bgcolor="#D0E4FF" class="border">
    	
		</td>
	</tr>-->
</table>





</body>
</html>