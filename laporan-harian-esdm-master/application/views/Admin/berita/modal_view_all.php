<form id="form-tambah-gunung" method="POST">
<!--<style type="text/css">
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
</style>-->
<?=get_csrf_token()?>

<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Berita</strong></h4>
  </div>

</div>
<div class="form-msg">
<tr>
	<td class="border">
	<table width="100%" >
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-migas" style="padding:0 5 0 5; font-size:18px" colspan="4"><strong><p align="left"style="color: #FFFF00;">&nbsp; 1. HOTNEWS</p></strong></td>
		</tr>
         <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>

		<table id="collapsemigas" class="collapse out" cellpadding="0" cellspacing="0" border="0">
	<?php
     //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_berita_hot_news");
	
    $no=0;
    foreach ($dataGunung->result_array() as $row)
	{
        //$jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
		if($jenis = $row['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $row['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}
     $no++;  
  ?>
  		
  				
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $no?>.	BERITA</p></strong></td> 
                </tr>
<!--                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
-->                
                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo strtoupper($row['BERITA'])?></td> 
                </tr>
<!--                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
-->                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  URL</p></strong></td>
                </tr>
<!--                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
-->                <tr bgcolor="efefef">
                    <td width="20%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['URL']?></td>
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php } ?>
   		</table>
   
</table>
   
   
   <table width="100%">
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-minerba" style="padding:0 5 0 5; font-size:18px" colspan="4" ><strong><p align="left"style="color: #FFFF00">&nbsp; 2. NEGATIF</p></strong></td>
		</tr>
		
        <tr><td height="1" colspan="0" bgcolor='#aaafff'></td></tr>
        <table id="collapseminerba" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">
   <?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_berita_negatif");
    $no=0;
    foreach ($dataGunung->result_array() as $row)
	{
       	if($jenis = $row['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $row['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}
        $no++;
		
  ?>
  		
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $no?>.	BERITA</p></strong></td> 
                </tr>
                 <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['BERITA']?></td>
                </tr>
 	                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  URL</p></strong></td>
                </tr>
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['URL']?></td>
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php              
	}
   ?>
   		 </table>
   </table>
   
   
   
   
   
   <table width="100%">
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-gatrik" style="padding:0 5 0 5; font-size:18px" colspan="4" ><strong><p align="left"style=" color: #FFFF00;">&nbsp;	3. POSITIF</p></strong></td>
		</tr>
		<tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>

	<table id="collapsegatrik" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
	<?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_berita_positif");
    $no=0;
    foreach ($dataGunung->result_array() as $row)
	{
        if($jenis = $row['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $row['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}
		
		$no++;
  ?>
  		
  				
               <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $no?>.	BERITA</p></strong></td> 
                </tr>
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['BERITA']?></td>
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  URL</p></strong></td>
                </tr>
                 <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $row['URL']?></td>
                </tr>
                <tr><td height="1" colspan="4" bgcolor='#aaafff'></td></tr>
               
  <?php              
	}
   ?>
   			</table> 
   </table>
   
   
   
   
   <table width="100%">
    	<tr >
            <td width="20%" align="center" bgcolor="#222d32" class="border; btn-ebtke" style="padding:0 5 0 5; font-size:18px" colspan="4"><strong><p align="left"style="color: #FFFF00;">&nbsp;	4. NETRAL</p></strong></td>
		</tr>



	<table id="collapseebtke" class="collapse out" cellpadding="0" cellspacing="0" border="0" width="100%">	
	<?php
    //include 'koneksi.php';
   // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
	$dataGunung = $this->db->query("SELECT * from r_lap_berita_netral");
    $no=0;
    foreach ($dataGunung->result_array() as $row)
	{
        if($jenis = $row['JENIS']=='N'){
			$jenis = 'Netral';
		}
		else if($jenis = $row['JENIS']=='T'){
			$jenis = 'Tidak Netral';
		}
		
	$no++	
  ?>
  		
  				
               <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $no ?>.	BERITA</p></strong></td> 
                </tr>
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo strtoupper($row['BERITA'])?></td> 
                </tr>
                
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4"><strong><p align="left" style="color:#000">&nbsp; &nbsp; &nbsp; &nbsp;  URL</p></strong></td>
                </tr>
                <tr bgcolor="efefef">
                    <td width="5%" style="padding:0 5 0 5" colspan="4">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row['URL']?></td>
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
	
	
  $(".btn-migas").click(function() {
		if($("#collapsemigas").hasClass("out")) {
			$("#collapsemigas").addClass("in");
			$("#collapsemigas").removeClass("out");
		} else {
			$("#collapsemigas").addClass("out");
			$("#collapsemigas").removeClass("in");
		}
	});
	
	$(".btn-minerba").click(function() {
		if($("#collapseminerba").hasClass("out")) {
			$("#collapseminerba").addClass("in");
			$("#collapseminerba").removeClass("out");
		} else {
			$("#collapseminerba").addClass("out");
			$("#collapseminerba").removeClass("in");
		}
	});
	
	$(".btn-gatrik").click(function() {
		if($("#collapsegatrik").hasClass("out")) {
			$("#collapsegatrik").addClass("in");
			$("#collapsegatrik").removeClass("out");
		} else {
			$("#collapsegatrik").addClass("out");
			$("#collapsegatrik").removeClass("in");
		}
	});
	
	$(".btn-ebtke").click(function() {
		if($("#collapseebtke").hasClass("out")) {
			$("#collapseebtke").addClass("in");
			$("#collapseebtke").removeClass("out");
		} else {
			$("#collapseebtke").addClass("out");
			$("#collapseebtke").removeClass("in");
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
</script>