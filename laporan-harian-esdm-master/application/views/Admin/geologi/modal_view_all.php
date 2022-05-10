<?php 
        $data=$this->session->flashdata('sukses');
        if($data!=""){ ?>
        <div id="notifikasi" class="alert alert-success" style="width: 90%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Sukses! </strong> <?=$data;?></div>
        <?php } ?>

        <?php 
        $data2=$this->session->flashdata('error');
        if($data2!=""){ ?>
        <div id="notifikasi" class="alert alert-danger" style="width: 90%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong> Error! </strong> <?=$data2;?></div>
        <?php } ?>

<!--<form id="form-tambah-gunung" method="POST">
-->
<form id="form-review-all" method="POST" action="<?= base_url('Lap_pusdatin/reviewAll');?>">
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
    <h4 class="modal-title" style="text-align: center;"><strong>Geologi</strong></h4>
  </div>

</div>
<div class="form-msg">
<tr>
	<td class="border">
	<table width="100%">
    	
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-gn_api" style="padding:0 5 0 5; font-size:18px" colspan="4" ><p align="left"style="color: #FFFF00;"><strong>&nbsp; 1. GUNUNG API</strong></p></td>
		</tr>
         <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>

		<table id="collapsegnapi" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">
	<?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
  // $dataGunung = $this->db->query("SELECT * from r_lap_geologi_gunung_api            left join t_gunung 
  //         on r_lap_geologi_gunung_api.ID_GUNUNG =   t_gunung.ID_GUNUNG
  //         LEFT JOIN t_aktivitas
  //         on r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS ");	
 //  // $kemarin = date("d-m-Y", mktime(0,0,0, date("m"), date("d")-1, date("Y")));
    // $kemarin = date('Y-m-d',strtotime("-1 days")); 
    $kemarin = date('Y-m-d',strtotime("-1 days")); 

  $dataGunung = $this->db->query("SELECT * from r_lap_geologi_gunung_api  				  left join t_gunung 
				  on r_lap_geologi_gunung_api.ID_GUNUNG = 	t_gunung.ID_GUNUNG
				  LEFT JOIN t_aktivitas
				  on r_lap_geologi_gunung_api.ID_AKTIVITAS = t_aktivitas.ID_AKTIVITAS where IS_POST IS NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
    $no=0;
	
    foreach ($dataGunung->result_array() as $row)
	{
       $no++;
  ?>
  		
  				<thead class="thead-dark">
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; <?php echo $no?>. <?php echo strtoupper($row['NAMA_GUNUNG'])?></p></strong></td> 
                </tr>
				</thead>
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TINGKAT LEVEL :</td></strong>
                  
                    
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['LEVEL']?></td>
                  
                    
                </tr>
                
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; KETERANGAN :</td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5"><p style="margin-left:33px"><?php echo $row['KETERANGAN']?></p>
                    </td>
                   
                </tr>
                
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DETAIL :</td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><p style="margin-left:33px"><?php echo $row['DETAIL']?></p></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  REKOMENDASI :</td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><p style="margin-left:33px"><?php echo $row['REKOMENDASI']?></p></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VONA :</td></strong>
                </tr>

                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><p style="margin-left:33px"><?php echo $row['VONA']?></p></td>    
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php } ?>
   		</table>
   
</table>



   
   
   <table width="100%">
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-tanah" style="padding:0 5 0 5; font-size:18px" colspan="4"><p align="left"style="color: #FFFF00;"><strong>&nbsp; 2. GERAKAN TANAH</strong></p></td>
		</tr>
		
        <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>
        <table id="collapsetanah" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">
  <?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
  // $dataGunung = $this->db->query("SELECT * from r_lap_geologi_gerakan_tanah");
   // $kemarin = date("d-m-Y", mktime(0,0,0, date("m"), date("d")-1, date("Y")));
    $kemarin = date('Y-m-d',strtotime("-1 days")); 

	$dataGunung = $this->db->query("SELECT * from r_lap_geologi_gerakan_tanah where IS_POST IS NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
    $no=0;
    foreach ($dataGunung->result_array() as $row)
	{
       
        $no++;
        //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
		
		
  ?>
  		
  				
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4">&nbsp; &nbsp; &nbsp; <?php echo $no?>.	KETERANGAN :</td></strong>
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5" colspan="4"><p style="margin-left:33px"><?php echo $row['KETERANGAN']?></p></td></strong>
                </tr>
               
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">DETAIL : </p></td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5">
					<p style="margin-left:33px"><?php echo $row['DETAIL']?></p>
                    </td>
                   
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php              
	}
   ?>
   		 </table>
   </table>
   
   
   
   
   
   <table width="100%">
    	<tr >
        
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-gempa_bumi" style="padding:0 5 0 5; font-size:18px" colspan="4" ><p align="left"style="color: #FFFF00;"><strong>&nbsp; 3. GEMPA BUMI</strong></p></td>
		</tr>

	<table id="collapsegempa" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
	  <?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
  // $dataGunung = $this->db->query("SELECT * from r_lap_geologi_gempa_bumi");
   // $kemarin = date("d-m-Y", mktime(0,0,0, date("m"), date("d")-1, date("Y")));
    $kemarin = date('Y-m-d',strtotime("-1 days")); 

	$dataGunung = $this->db->query("SELECT * from r_lap_geologi_gempa_bumi where IS_POST IS NULL AND HAS_REVIEW IS NULL AND  TANGGAL_REVIEW IS NULL and TANGGAL_POST IS NULL and TANGGAL_ENTRY LIKE '%".date('Y-m-d')."%'");
    $no=0;
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
                    <strong><td width="20%" style="padding:0 5 0 5; color:#000; font-size:16px" colspan="4" ><p style="margin-left:20px"><?php echo $no?>.	LOKASI : </p></td></strong>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#000; font-size:16px" colspan="4" ><p style="margin-left:33px"><?php echo $row['LOKASI']?></p></td></strong>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">INFORMASI GEMPA BUMI :</td></p></strong>
                    
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4"><p style="margin-left:33px"><?php echo $informasi_gempa?></p></td>
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">KONDISI GEOLOGI DAERAH TERDEKAT PUSAT GEMPA BUMI :</td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5">
					<p style="margin-left:33px"><?php echo $kondisi_geologi_gempa?></p>
                    </td>
                   
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">PENYEBAB GEMPA BUMI : </p></td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5"><p style="margin-left:33px"><?php echo $penyebab_gempa?></p></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">DAMPAK GEMPA BUMI : </p></td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<p style="margin-left:33px"><?php echo $dampak_gempa?></p></td>
                    
                </tr>
                
                <tr bgcolor="efefef">
                    <strong><td width="20%" style="padding:0 5 0 5; color:#00F" colspan="4"><p style="margin-left:33px">REKOMENDASI : </p></td></strong>
                </tr>
                <tr bgcolor="efefef">
                    <td style="padding:0 5 0 5">
					<p style="margin-left:33px"><?php echo $rekomendasi?></p></td>    
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php              
	}
   ?>
		  </table> 
   </table>
   			


    
    
    
    
    
    
    </td>
</tr>










</div>
</form>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
<script type="text/javascript">


$(document).ready(function(){

  tampilProfile_perusahaan();
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

// Profile perusahaan
function tampilProfile_perusahaan() {
		$.get('<?php echo base_url('Profile_perusahaan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-akta').html(data);
			refresh();
            check_akta();
		});
	}

	$(document).on("click", ".update-dataAkta", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Profile_perusahaan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-akta').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-dataAkta", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAkta", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Profile_perusahaan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilProfile_perusahaan();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-akta', function(e){
		var formData = new FormData($(this)[0]);

		$('#update-akta').modal('hide');

    	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Profile_perusahaan/updateAkta'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProfile_perusahaan();
			if (out.status == 'form') {
				$.unblockUI(); 
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$.unblockUI(); 
				document.getElementById("form-update-akta").reset();
				$('#update-akta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-tambah-akta', function(e) {
		var formData = new FormData($(this)[0]);

		$('#tambah-akta').modal('hide');

    	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Profile_perusahaan/tambahAkta'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProfile_perusahaan();
			if (out.status == 'form') {
				$.unblockUI(); 
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$.unblockUI(); 
				document.getElementById("form-tambah-akta").reset();
				$("#form-tambah-akta input[flag='input-file']").ace_file_input('reset_input');
				$('#tambah-akta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-akta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-akta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

    function check_akta() {
      var table = $("#list-data").DataTable();

      if (!table.data().any()) {
        if(typeof akta_empty_callback === "function") {
          akta_empty_callback();
        }
      } else {
        if(typeof akta_exists_callback === "function") {
          akta_exists_callback();
        }     
      }
    }
	
	$(document).on('submit', '#form-submit-profile', function(e) {
		
		return false;
	});
	
	
	
	$(".btn-gn_api").click(function() {
		if($("#collapsegnapi").hasClass("out")) {
			$("#collapsegnapi").addClass("in");
			$("#collapsegnapi").removeClass("out");
		} else {
			$("#collapsegnapi").addClass("out");
			$("#collapsegnapi").removeClass("in");
		}
	});
	
	$(".btn-tanah").click(function() {
		if($("#collapsetanah").hasClass("out")) {
			$("#collapsetanah").addClass("in");
			$("#collapsetanah").removeClass("out");
		} else {
			$("#collapsetanah").addClass("out");
			$("#collapsetanah").removeClass("in");
		}
	});
	
	$(".btn-gempa_bumi").click(function() {
		if($("#collapsegempa").hasClass("out")) {
			$("#collapsegempa").addClass("in");
			$("#collapsegempa").removeClass("out");
		} else {
			$("#collapsegempa").addClass("out");
			$("#collapsegempa").removeClass("in");
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
  
  $('#notifikasi').slideDown('slow').delay(3000).slideUp('slow');
</script>