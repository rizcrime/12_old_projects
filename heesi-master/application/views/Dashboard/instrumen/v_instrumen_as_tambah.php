<html>
<body>
	<div id="loader-wrapper">
		<center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
		<h5>SIPATUH Haji Khusus</h5>
	</div>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Tambah Instrumen</h1>
	      	<p class="mb-4">Tambah Instrumen merupakan tampilan untuk menambah Instrumen dari setiap PIHK.</p>

          	<form id="form-edit">
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Instrumen</h6>
		            </div>
	            	<div class="card-body">
	            		<div class="row">
		            		<div class="form-group">
							    <label for="kd_tahun" class="col-lg-12 col-form-label">Kode Tahun</label>
							    <div class="col-lg-12">
							      <input type="text" class="form-control" name="kd_tahun" value="<?php echo Hijriah(); ?>"readonly>
							    </div>
							</div>
							<div class="form-group">
							    <label for="kd_pihk" class="col-lg-12 col-form-label">Kode PIHK</label>
							    <div class="col-lg-12">
							      <input type="text" class="form-control" name="kd_pihk" value="<?php echo $this->session->userdata('kd_pihk') ?>" readonly>
							    </div>
							</div>
							<div class="form-group">
							    <label for="kd_paket" class="col-lg-12 col-form-label">Kode Paket <label class="font-weight-light font-italic text-danger">*</label></label>
							    <div class="col-lg-12">
							      	<select class="form-control select2" name="kd_paket" id="kd_paket" style="width: 250px;" required>
							      		<option value="" disabled selected>Pilih</option>
								    	<?php foreach($kode_paket as $kode_paket){ ?>
										<option value="<?php echo $kode_paket->kode_paket ?>"><?php echo $kode_paket->kode_paket ?></option>
										<?php } ?>
									</select>
							    </div>
							</div>
							<div class="form-group">
								<label for="pemberangkatan_ke" class="col-lg-12 col-form-label">Pemberangkatan Ke <label class="font-weight-light font-italic text-danger">*</label></label>
							    <div class="col-lg-12">
								    <select class="form-control select2" name="pemberangkatan_ke" id="pemberangkatan_ke" style="width: 250px;" required>
								    	<option value="" disabled selected>Pilih</option>
								    	<!-- <?php foreach($data_keberangkatanke as $data_keberangkatanke){ ?>
										<option value="<?php echo $data_keberangkatanke->description ?>"><?php echo $data_keberangkatanke->description ?></option>
										<?php } ?> -->
									</select>
							    </div>
							</div>
						</div>
					</div>
            	</div>
			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>
	
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$("#bandara_transit").prop('disabled', true);
	    $("#nm_airline_transit").prop('disabled', true);
	    $("#no_flight_transit").prop('disabled', true);

	    var table = $('#list_jamaah').DataTable( {
        	"order": [[ 2, "asc" ]],
        	"paging":   false,
        	"info":     false
      	});

      	$(".select2").select2({
            placeholder: "Pilih"
        });

      	var kode_pramanifest = $("#kd_pra_manifest").val();
      	//Ajax untuk mengubah value dari select2
        $.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/detail_edit_pramanifest') ?>",
        	dataType: "JSON",
        	data: {kode: kode_pramanifest},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
				    $('#nm_airline_brkt').val(value.nm_airline_brkt);
    				$('#nm_airline_brkt').select2().trigger('change');
    				$('#bandara_brkt').val(value.bandara_brkt);
    				$('#bandara_brkt').select2().trigger('change');
    				$('#bandara_pulang').val(value.bandara_pulang);
    				$('#bandara_pulang').select2().trigger('change');
    				$('#jenis_penerbangan_brkt').val(value.jenis_penerbangan_brkt);
    				$('#jenis_penerbangan_brkt').select2().trigger('change');
    				$('#jenis_penerbangan_pulang').val(value.jenis_penerbangan_pulang);
    				$('#jenis_penerbangan_pulang').select2().trigger('change');
    				$('#bandara_transit_brkt').val(value.bandara_transit_brkt);
    				$('#bandara_transit_brkt').select2().trigger('change');
    				$('#bandara_transit_pulang').val(value.bandara_transit_pulang);
    				$('#bandara_transit_pulang').select2().trigger('change');
    				$('#nm_airline_transit_brkt').val(value.nm_airline_transit_brkt);
    				$('#nm_airline_transit_brkt').select2().trigger('change');
    				$('#nm_airline_transit_pulang').val(value.nm_airline_transit_pulang);
    				$('#nm_airline_transit_pulang').select2().trigger('change');
    				$('#bandara_tujuan_as').val(value.bandara_tujuan_as);
    				$('#bandara_tujuan_as').select2().trigger('change');
    				$('#bandara_tujuan_pulang').val(value.bandara_tujuan_pulang);
    				$('#bandara_tujuan_pulang').select2().trigger('change');
    				$('#nm_airline_pulang').val(value.nm_airline_pulang);
    				$('#nm_airline_pulang').select2().trigger('change');
				});
	        }
    	});

        //Ajax untuk men-checklist data jamaah
    	$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/list_jamaah_pramanifest_byidpramanifest') ?>",
        	dataType: "JSON",
        	data: {kd_pra_manifest: kode_pramanifest},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		$('#'+value.kd_porsi+' input[type="checkbox"]').attr('checked', true);
				});
	        }
    	});

    	//Ajax untuk delete data jamaah dari datatables yang merupakan jamaah manifest lain
    	$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/list_jamaah_pramanifest_lain') ?>",
        	dataType: "JSON",
        	data: {kd_pra_manifest: kode_pramanifest},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		table.row('#'+value.kd_porsi).remove().draw();
				});
				$("#loader-wrapper").hide();
	        }
    	});
    	
	});

	//Untuk memasukkan kedalam array yang di uncheck
	var	hapus = [];
	$(".checkbox").on("change", function() {
		if(this.checked != true){
			hapus.push($(this).val());
	    }
	});

	//Untuk menghapus data dari array yang di check
	$(".checkbox").on("change", function() {
		if(this.checked == true){
			for (var i = hapus.length - 1; i < hapus.length; i++) {
				if (hapus[i] == $(this).val()) {
					hapus.splice(i, 1);
				}
			}
	    }
	});

	//Menghapus data jamaah yang di uncheck dari database
	$("#submit").on('click', function(e){
		$("#loader-wrapper").show();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/delete_jamaah_unchecked') ?>",
        	dataType: "JSON",
        	data: {kd_porsi: hapus}
    	});  

    	var data = $('#form-edit').serialize();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/proses_edit') ?>",
        	data: data,
        	success : function(data)
	        {
	        	$("#loader-wrapper").hide();
	        	location = '<?php echo base_url('Dashboard/pramanifest') ?>';
	        }
    	});      
	});

	$("#jenis_penerbangan_brkt").on("change", function() {
	    var val = $("#jenis_penerbangan_brkt").val();
	    if (val == 'Transit') {
	        $("#bandara_transit_brkt").prop('disabled', false);
	        $("#nm_airline_transit_brkt").prop('disabled', false);
	        $("#no_flight_transit_brkt").prop('disabled', false)
	    }else{
	        $("#bandara_transit_brkt").prop('disabled', true);
	        $("#nm_airline_transit_brkt").prop('disabled', true);
	        $("#no_flight_transit_brkt").prop('disabled', true)
	    }
	});

	$("#jenis_penerbangan_pulang").on("change", function() {
	    var val = $("#jenis_penerbangan_pulang").val();
	    if (val == 'Transit') {
	        $("#bandara_transit_pulang").prop('disabled', false);
	        $("#nm_airline_transit_pulang").prop('disabled', false);
	        $("#no_flight_transit_pulang").prop('disabled', false)
	    }else{
	        $("#bandara_transit_pulang").prop('disabled', true);
	        $("#nm_airline_transit_pulang").prop('disabled', true);
	        $("#no_flight_transit_pulang").prop('disabled', true)
	    }
	});

	$("#tanggal_berangkat").datepicker({
	    autoclose: true,
	    todayHighlight: true,
	});

	$("#tanggal_pulang_1, #tanggal_pulang_2, #tanggal_pulang_3").datepicker({
	    autoclose: true,
	    todayHighlight: true,
    });

    $("#nm_airline_brkt").on("change", function(){
    	$("#loader-wrapper").show();
		var nama_airline = $("#nm_airline_brkt").val();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/get_kode_airline') ?>",
        	dataType: "JSON",
        	data: {nama_airline: nama_airline},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		document.getElementById("kode_flight_brkt").innerHTML = value.noid;
	        		$("#kode_flight_brkt_kirim").val(value.noid);
				});
				$("#loader-wrapper").hide();
	        }
    	});
	});

    $("#nm_airline_pulang").on("change", function(){
    	$("#loader-wrapper").show();
		var nama_airline = $("#nm_airline_pulang").val();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/get_kode_airline') ?>",
        	dataType: "JSON",
        	data: {nama_airline: nama_airline},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		document.getElementById("kode_flight_pulang").innerHTML = value.noid;
	        		$("#kode_flight_pulang_kirim").val(value.noid);
				});
				$("#loader-wrapper").hide();
	        }
    	});
	});

	$("#nm_airline_transit_brkt").on("change", function(){
		$("#loader-wrapper").show();
		var nama_airline = $("#nm_airline_transit_brkt").val();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/get_kode_airline') ?>",
        	dataType: "JSON",
        	data: {nama_airline: nama_airline},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		document.getElementById("kode_flight_transit_brkt").innerHTML = value.noid;
	        		$("#kode_flight_transit_brkt_kirim").val(value.noid);
				});
				$("#loader-wrapper").hide();
	        }
    	});
	});

	$("#nm_airline_transit_pulang").on("change", function(){
		$("#loader-wrapper").show();
		var nama_airline = $("#nm_airline_transit_pulang").val();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/get_kode_airline') ?>",
        	dataType: "JSON",
        	data: {nama_airline: nama_airline},
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		document.getElementById("kode_flight_transit_pulang").innerHTML = value.noid;
	        		$("#kode_flight_transit_pulang_kirim").val(value.noid);
				});
				$("#loader-wrapper").hide();
	        }
    	});
	});
</script> -->