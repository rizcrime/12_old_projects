<form id="form-update-gunung" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_GUNUNG" value="<?php echo $gunung->ID_GUNUNG ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          GUNUNG
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="NAMA_GUNUNG" value="<?php echo $gunung->NAMA_GUNUNG ?>" style="width: 100%;">
        </div>
      </div>
      
      
      <div class="profile-info-row">
          <div class="profile-info-name">
            PROVINSI
          </div>

		 		

		
			
          <div class="profile-info-value">
            <!--<select required class="form-control" name="ID_PROVINSI" id="ID_PROVINSI">
              <?php foreach($dataProvinsi as $provinsi): ?>  
                <option <?php if($provinsi->ID_PROVINSI == "$gunung->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
              <?php endforeach ?>
            </select>-->
            
            <select name="ID_PROVINSI" id="PROVINSI_update" class="form-control" onchange="get_kabkot(13)" required>
                  <option value="">--PILIH--</option>
                  <?php foreach($dataProvinsi as $provinsi): ?>
                    <?php if($gunung->ID_PROVINSI == $provinsi->ID_PROVINSI) { ?>
                      <option <?php if($provinsi->ID_PROVINSI == "$gunung->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php } else { ?>
                      <option value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php } ?>              
                  <?php endforeach ?>
             </select>

          </div>
        </div>
      
      
      <div class="profile-info-row">
          <div class="profile-info-name">
            KABUPATEN / KOTA
          </div>

          <div class="profile-info-value">
            <!--<select required class="KABKOT form-control" name="ID_KABKOT">
              <?php foreach($dataKabkot as $kabkot): ?>  
                <option <?php if($kabkot->ID_KABKOT == "$gunung->ID_KABKOT"){ echo 'selected="selected"'; } ?> value="<?php echo $kabkot->ID_KABKOT ?>"><?php echo $kabkot->NAMA_KABKOT?> --PILIH PROVINSI DAHULU--</option>
              <?php endforeach ?>
            </select>-->

			<select name="ID_KABKOT" class="KABKOT form-control" required>
                    <option value="">--PILIH PROVINSI DAHULU--</option>
            </select>
          </div>
        </div>
      
        
        
        
      
        
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Save
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Cancel
    </button>
  </div>
</div>
</form>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js" ></script>
<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>




<script type="text/javascript">


$(document).ready(function(){

  tampilProfile_perusahaan();
  //get_kabkot($('#PROVINSI'));
  get_kabkot();
  //alert(get_kabkot);
  
  /*$('#PROVINSI').change(function(){
    get_kabkot(this);
  });*/
});

function get_kabkot(provinsi_data) {
  //var id=$(provinsi_data).val();
 // var curr_id_kabkot = "<?=isemptyor($gunung->ID_PROVINSI, '')?>";
  var curr_id_kabkot = document.getElementById('PROVINSI_update').value;
  
  <?php /*?><?php echo $gunung->ID_GUNUNG ?><?php */?>
	
  //confirm(curr_id_kabkot);	  

  $.ajax({
    //url : "<?php echo base_url();?>Gunung/get_kabkot",
	url : "<?php echo base_url('Gunung/get_kabkot'); ?>",
	//url: "<?php echo base_url('Profile_perusahaan/delete'); ?>",
    method : "POST",
    data : {id: curr_id_kabkot},
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
