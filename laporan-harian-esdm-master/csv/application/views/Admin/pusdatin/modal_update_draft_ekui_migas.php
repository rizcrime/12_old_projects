<form id="form-update-draft-ekui-migas" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_LAPORAN" id="ID_LAPORAN"  value="<?php echo $datanya[0]->ID_LAPORAN; ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Produksi  Harian</div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="PROD_HARIAN" id="PROD_HARIAN" value="<?php echo $datanya[0]->PROD_HARIAN ?>" style="width: 100%;">
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Rata - rata Produksi Bulanan</div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="PROD_BULANAN" id="PROD_BULANAN" value="<?php echo $datanya[0]->PROD_BULANAN ?>" style="width: 100%;">
        </div>
      </div>
      
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Rata - rata Produksi Tahunan</div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="PROD_TAHUNAN" id="PROD_TAHUNAN" value="<?php echo $datanya[0]->PROD_TAHUNAN ?>" style="width: 100%;">
        </div>
      </div>
      
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Target APBN</div>

        <div class="profile-info-value">
          <input class="form-control"  name="APBN" id="APBN" value="<?php echo $datanya[0]->APBN ?>" style="width: 100%;" readonly>
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
