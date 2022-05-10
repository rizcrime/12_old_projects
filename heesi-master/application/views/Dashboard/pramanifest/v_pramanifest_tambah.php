<html>
<body>
	<div id="loader-wrapper">
		<center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
		<h5>SIPATUH Haji Khusus</h5>
	</div>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Tambah Pra Manifest</h1>
	      	<p class="mb-4">Tambah Pra Manifest merupakan tampilan untuk mendaftarkan Pra Manifest berdasarkan Paket yang sudah dimasukkan.</p>

	      	<?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> ', '</div>'); ?>

          	<?php echo form_open('') ?>
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Pra Manifest</h6>
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
						<table class="table table-borderless" width="100%" cellspacing="0">
							<tr>
								<th><h3><b>Keberangkatan</b></h3></th>
								<th width="50%"><h3><b>Kepulangan</b></h3></th>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="bandara_brkt" class="col-lg-11 col-form-label">Bandara Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="bandara_brkt" id="bandara_brkt" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($bandara_berangkat as $bandara_berangkat){ ?>
												<option value="<?php echo $bandara_berangkat->noid ?>"><?php echo $bandara_berangkat->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="bandara_pulang" class="col-lg-11 col-form-label">Bandara Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="bandara_pulang" id="bandara_pulang" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($bandara_pulang as $bandara_pulang){ ?>
												<option value="<?php echo $bandara_pulang->noid ?>"><?php echo $bandara_pulang->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="nm_airline_brkt" class="col-lg-11 col-form-label">Airline Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="nm_airline_brkt" id="nm_airline_brkt" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($airline_berangkat as $airline_berangkat){ ?>
												<option value="<?php echo $airline_berangkat->description ?>"><?php echo $airline_berangkat->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="nm_airline_pulang" class="col-lg-11 col-form-label">Airline Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="nm_airline_pulang" id="nm_airline_pulang" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($airline_pulang as $airline_pulang){ ?>
												<option value="<?php echo $airline_pulang->description ?>"><?php echo $airline_pulang->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="no_flight_brkt" class="col-lg-11 col-form-label">No. Flight Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									    	<div class="input-group">
												<div class="input-group-prepend">
										        	<div class="input-group-text" id="kode_flight_brkt"></div>
										        </div>
										        <input type="text" class="form-control" name="kode_flight_brkt_kirim" id="kode_flight_brkt_kirim" hidden>
									      		<input type="text" class="form-control" name="no_flight_brkt" id="no_flight_brkt" required>
									  		</div>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
										    <label for="no_flight_pulang" class="col-lg-11 col-form-label">No. Flight Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
										    <div class="col-lg-11">
										    	<div class="input-group">
													<div class="input-group-prepend">
											        	<div class="input-group-text" id="kode_flight_pulang"></div>
											        </div>
											        <input type="text" class="form-control" name="kode_flight_pulang_kirim" id="kode_flight_pulang_kirim" hidden>
										      		<input type="text" class="form-control" name="no_flight_pulang" id="no_flight_pulang" required>
										  		</div>
										    </div>
										</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="tanggal_berangkat" class="col-lg-11 col-form-label">Tanggal Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      <input type="text" class="form-control datepicker" name="tanggal_berangkat" id="tanggal_berangkat" required>
									    </div>
									</div>
								</td>
								<td>
									<div class="row">
										<div class="form-group" style="margin-right: -70px;">
										    <label for="tanggal_pulang_1" class="col-lg-9 col-form-label">Tanggal Pulang 1<label class="font-weight-light font-italic text-danger">*</label></label>
										    <div class="col-lg-9">
										      <input type="text" class="form-control datepicker" name="tanggal_pulang_1" id="tanggal_pulang_1" required>
										    </div>
										</div>
										<div class="form-group" style="margin-right: -70px;">
										    <label for="tanggal_pulang_2" class="col-lg-9 col-form-label">Tanggal Pulang 2</label>
										    <div class="col-lg-9">
										      <input type="text" class="form-control datepicker" name="tanggal_pulang_2" id="tanggal_pulang_2">
										    </div>
										</div>
										<div class="form-group" style="margin-right: -70px;">
										    <label for="tanggal_pulang_3" class="col-lg-9 col-form-label">Tanggal Pulang 3</label>
										    <div class="col-lg-9">
										      <input type="text" class="form-control datepicker" name="tanggal_pulang_3" id="tanggal_pulang_3">
										    </div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="waktu_berangkat" class="col-lg-11 col-form-label">Waktu Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      <input type="time" class="form-control" name="waktu_berangkat" id="waktu_berangkat" required>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="waktu_pulang" class="col-lg-11 col-form-label">Waktu Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      <input type="time" class="form-control" name="waktu_pulang" id="waktu_pulang" required>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="jenis_penerbangan_brkt" class="col-lg-11 col-form-label">Jenis Penerbangan Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="jenis_penerbangan_brkt" id="jenis_penerbangan_brkt" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($jenis_penerbangan_brkt as $jenis_penerbangan_brkt){ ?>
												<option value="<?php echo $jenis_penerbangan_brkt->description ?>"><?php echo $jenis_penerbangan_brkt->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="jenis_penerbangan_pulang" class="col-lg-11 col-form-label">Jenis Penerbangan Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="jenis_penerbangan_pulang" id="jenis_penerbangan_pulang" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($jenis_penerbangan_pulang as $jenis_penerbangan_pulang){ ?>
												<option value="<?php echo $jenis_penerbangan_pulang->description ?>"><?php echo $jenis_penerbangan_pulang->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="bandara_transit_brkt" class="col-lg-11 col-form-label">Bandara Transit Berangkat </label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="bandara_transit_brkt" id="bandara_transit_brkt" style="width: 100%">
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($bandara_transit_brkt as $bandara_transit_brkt){ ?>
												<option value="<?php echo $bandara_transit_brkt->description ?>"><?php echo $bandara_transit_brkt->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
								    <label for="bandara_transit_pulang" class="col-lg-11 col-form-label">Bandara Transit Pulang </label>
								    <div class="col-lg-11">
								      	<select class="form-control select2" name="bandara_transit_pulang" id="bandara_transit_pulang" style="width: 100%">
								      		<option value="" disabled selected>Pilih</option>
									    	<?php foreach($bandara_transit_pulang as $bandara_transit_pulang){ ?>
											<option value="<?php echo $bandara_transit_pulang->description ?>"><?php echo $bandara_transit_pulang->description ?></option>
											<?php } ?>
										</select>
								    </div>
								</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="nm_airline_transit_brkt" class="col-lg-11 col-form-label">Airline Transit Berangkat <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="nm_airline_transit_brkt" id="nm_airline_transit_brkt" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($airline_transit_berangkat as $airline_transit_berangkat){ ?>
												<option value="<?php echo $airline_transit_berangkat->description ?>"><?php echo $airline_transit_berangkat->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="nm_airline_transit_pulang" class="col-lg-11 col-form-label">Airline Transit Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="nm_airline_transit_pulang" id="nm_airline_transit_pulang" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($airline_transit_pulang as $airline_transit_pulang){ ?>
												<option value="<?php echo $airline_transit_pulang->description ?>"><?php echo $airline_transit_pulang->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="no_flight_transit_brkt" class="col-lg-11 col-form-label">No. Flight Transit Berangkat </label>
									    <div class="col-lg-11">
									    	<div class="input-group">
												<div class="input-group-prepend">
										        	<div class="input-group-text" id="kode_flight_transit_brkt"></div>
										        </div>
										        <input type="text" class="form-control" name="kode_flight_transit_brkt_kirim" id="kode_flight_transit_brkt_kirim" hidden>
									      		<input type="text" class="form-control" name="no_flight_transit_brkt" id="no_flight_transit_brkt">
									  		</div>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="no_flight_transit_pulang" class="col-lg-11 col-form-label">No. Flight Transit Pulang </label>
									    <div class="col-lg-11">
									    	<div class="input-group">
												<div class="input-group-prepend">
										        	<div class="input-group-text" id="kode_flight_transit_pulang"></div>
										        </div>
										        <input type="text" class="form-control" name="kode_flight_transit_pulang_kirim" id="kode_flight_transit_pulang_kirim" hidden>
									      		<input type="text" class="form-control" name="no_flight_transit_pulang" id="no_flight_transit_pulang">
									  		</div>
									    </div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
									    <label for="bandara_tujuan_as" class="col-lg-11 col-form-label">Bandara Tujuan Arab Saudi <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="bandara_tujuan_as" id="bandara_tujuan_as" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($bandara_tujuan_as as $bandara_tujuan_as){ ?>
												<option value="<?php echo $bandara_tujuan_as->noid ?>"><?php echo $bandara_tujuan_as->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
								<td>
									<div class="form-group">
									    <label for="bandara_tujuan_pulang" class="col-lg-11 col-form-label">Bandara Tujuan Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
									    <div class="col-lg-11">
									      	<select class="form-control select2" name="bandara_tujuan_pulang" id="bandara_tujuan_pulang" style="width: 100%" required>
									      		<option value="" disabled selected>Pilih</option>
										    	<?php foreach($bandara_tujuan_pulang as $bandara_tujuan_pulang){ ?>
												<option value="<?php echo $bandara_tujuan_pulang->noid ?>"><?php echo $bandara_tujuan_pulang->description ?></option>
												<?php } ?>
											</select>
									    </div>
									</div>
								</td>
							</tr>
						</table>	
					</div>
            	</div>
          

          		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		            	<h6 class="m-0 font-weight-bold text-primary">Detail Jamaah</h6>
		            </div>
            		<div class="card-body">
            			<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="check_all_data"><i class="fas fa-check fa-sm text-white-50"></i> Check All Jamaah</button>
            			<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="uncheck_all_data"><i class="fas fa-times fa-sm text-white-50"></i> Uncheck All Jamaah</button>
						<div class="table-responsive">
							<table class="table table-bordered" id="list_jamaah" width="100%" cellspacing="0">
							    <div class="form-group">
							    	<thead>
								    	<tr>
								    		<td>Pilih</td>
								    		<td>Nomor Porsi</td>
								    		<td>Nama Jamaah</td>
								    		<td>Jenis Jamaah</td>
								    	</tr>
							    	</thead>
							    	<tbody>
										<?php foreach($list_jamaah as $list_jamaah){ ?>
											<tr id="<?php echo $list_jamaah->kode_porsi ?>">
												<td><center><input class="form-check-input" type="checkbox" name="list_jamaah[]" value="<?php echo $list_jamaah->kode_porsi ?>"></center></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->kode_porsi ?></label></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->nama_jamaah ?></label></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->JENIS_JEMAAH ?></label></td>
											</tr>
										<?php } ?>
									</tbody>
							    </div>
							</table>
						</div>
						<input type="submit" value="Simpan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
					</div>
				</div>
			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>
	
<script type="text/javascript">

	$(document).ready(function(){
	    $("#bandara_transit_brkt").prop('disabled', true);
	    $("#bandara_transit_pulang").prop('disabled', true);
	    $("#nm_airline_transit_brkt").prop('disabled', true);
	    $("#nm_airline_transit_pulang").prop('disabled', true);
	    $("#no_flight_transit_brkt").prop('disabled', true);
	    $("#no_flight_transit_pulang").prop('disabled', true);
	    $("#pemberangkatan_ke").prop('disabled', true);
	    $("#bandara_brkt").prop('disabled', true);
	    $("#bandara_pulang").prop('disabled', true);
	    $("#nm_airline_brkt").prop('disabled', true);
	    $("#no_flight_brkt").prop('disabled', true);
	    $("#jenis_penerbangan_brkt").prop('disabled', true);
	    $("#jenis_penerbangan_pulang").prop('disabled', true);
	    $("#bandara_tujuan_as").prop('disabled', true);
	    $("#bandara_tujuan_pulang").prop('disabled', true);
	    $("#nm_airline_pulang").prop('disabled', true);
	    $("#no_flight_pulang").prop('disabled', true);
	    $("#tanggal_berangkat").prop('disabled', true);
	    $("#waktu_berangkat").prop('disabled', true);
	    $("#tanggal_pulang_1").prop('disabled', true);
	    $("#tanggal_pulang_2").prop('disabled', true);
	    $("#tanggal_pulang_3").prop('disabled', true);
	    $("#waktu_pulang").prop('disabled', true);

	    $('#list_jamaah').DataTable( {
        	"order": [[ 2, "asc" ]],
        	"paging":   false,
        	"info":     false
      	});

      	$(".select2").select2({
            placeholder: "Pilih"
        });

      	var table = $('#list_jamaah').DataTable();

        $.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/list_jamaah_pramanifest') ?>",
        	dataType: "JSON",
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		table.row('#'+value.kd_porsi).remove().draw();
				});
	        }
    	});

    	$("#loader-wrapper").hide();
	});

	$("form").on('submit', function(e){
		var table = $('#list_jamaah').DataTable();
	   	var $form = $(this);

	   	// Iterate over all checkboxes in the table
	   	table.$('input[type="checkbox"]').each(function(){
	      	// If checkbox doesn't exist in DOM
	      	if(!$.contains(document, this)){
	         	// If checkbox is checked
	         	if(this.checked){
	            	// Create a hidden element 
		            $form.append(
		               $('<input>')
		                  .attr('type', 'hidden')
		                  .attr('name', this.name)
		                  .val(this.value)
		            );
	         	}
	      	} 
	   	});

	   	$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/insert_to_database') ?>",
        	data: data,
        	success : function(data)
	        {
	        	location = '<?php echo base_url('Dashboard/pramanifest') ?>';
	        }
    	});          
	});

	$("#kd_paket").on("change", function() {
		$("#loader-wrapper").show();
		$("#pemberangkatan_ke").prop('disabled', true);
		var kode_paket = $(this).val();

	    $("#bandara_brkt").prop('disabled', false);
	    $("#bandara_pulang").prop('disabled', false);
	    $("#nm_airline_brkt").prop('disabled', false);
	    $("#no_flight_brkt").prop('disabled', false);
	    $("#jenis_penerbangan_brkt").prop('disabled', false);
	    $("#jenis_penerbangan_pulang").prop('disabled', false);
	    $("#bandara_tujuan_as").prop('disabled', false);
	    $("#bandara_tujuan_pulang").prop('disabled', false);
	    $("#nm_airline_pulang").prop('disabled', false);
	    $("#no_flight_pulang").prop('disabled', false);
	    $("#tanggal_berangkat").prop('disabled', false);
	    $("#tanggal_pulang").prop('disabled', false);
	    $("#waktu_berangkat").prop('disabled', false);
	    $("#waktu_pulang").prop('disabled', false);

	    $.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/get_list_pemberangkatan_ke') ?>",
        	dataType: "JSON",
	        success : function(data)
	        {
	        	$.each(data, function(key, value) {
	        		$('#pemberangkatan_ke option[value="'+value.noid+'"]').remove();
	        		$("#pemberangkatan_ke").append('<option value="'+value.description+'">'+value.description+'</option>');
				});
				$.ajax({ 
			    	type: "POST",   
		        	url: "<?php echo base_url('Dashboard/pramanifest/get_available_paket_and_keberangkatan') ?>",
		        	dataType: "JSON",
		        	data: {kd_paket: kode_paket},
			        success : function(data)
			        {
			        	$.each(data, function(key, value) {
			        		$('#pemberangkatan_ke option[value="'+value.pemberangkatan_ke+'"]').remove();
						});
						$("#pemberangkatan_ke").prop('disabled', false);
						$("#loader-wrapper").hide();
			        }
		    	});	
	        }
    	});

	});

	$("#jenis_penerbangan_brkt").on("change", function() {
	    var val = $("#jenis_penerbangan_brkt").val();
	    if (val == 'Transit') {
	        $("#bandara_transit_brkt").prop('disabled', false);
	        $("#nm_airline_transit_brkt").prop('disabled', false);
	        $("#no_flight_transit_brkt").prop('disabled', false);
	    }else{
	    	$("#bandara_transit_brkt, #nm_airline_transit_brkt").val(null).trigger("change"); 
	    	document.getElementById("kode_flight_transit_brkt").innerHTML = '';
	    	$("#no_flight_transit_brkt").val('');
	        $("#bandara_transit_brkt").prop('disabled', true);
	        $("#nm_airline_transit_brkt").prop('disabled', true);
	        $("#no_flight_transit_brkt").prop('disabled', true);
	    }
	});

	$("#jenis_penerbangan_pulang").on("change", function() {
	    var val = $("#jenis_penerbangan_pulang").val();
	    if (val == 'Transit') {
	        $("#bandara_transit_pulang").prop('disabled', false);
	        $("#nm_airline_transit_pulang").prop('disabled', false);
	        $("#no_flight_transit_pulang").prop('disabled', false);
	    }else{
	    	$("#bandara_transit_pulang, #nm_airline_transit_pulang").val(null).trigger("change"); 
	    	document.getElementById("kode_flight_transit_pulang").innerHTML = '';
	    	$("#no_flight_transit_pulang").val('');
	        $("#bandara_transit_pulang").prop('disabled', true);
	        $("#nm_airline_transit_pulang").prop('disabled', true);
	        $("#no_flight_transit_pulang").prop('disabled', true);
	    }
	});

	$("#tanggal_berangkat").datepicker({
	    autoclose: true,
	    todayHighlight: true,
	});

	
	$("#tanggal_berangkat").on("change", function(){
		$("#tanggal_pulang_1, #tanggal_pulang_2, #tanggal_pulang_3").val('');
		$("#tanggal_pulang_1").prop('disabled', false);
	    $("#tanggal_pulang_2").prop('disabled', false);
	    $("#tanggal_pulang_3").prop('disabled', false);

		var currentDate = $("#tanggal_berangkat").val();
		
		$("#tanggal_pulang_1").datepicker({
		    autoclose: true,
		    todayHighlight: true,
		    startDate: currentDate,
	    });

	    $("#tanggal_pulang_2").datepicker({
		    autoclose: true,
		    todayHighlight: true,
		    startDate: currentDate,
	    });

	    $("#tanggal_pulang_3").datepicker({
		    autoclose: true,
		    todayHighlight: true,
		    startDate: currentDate,
	    });
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

	$("#check_all_data").on("click", function(){
		$('input[type="checkbox"]').attr('checked', true);
	});

	$("#uncheck_all_data").on("click", function(){
		$('input[type="checkbox"]').attr('checked', false);
	});

</script>