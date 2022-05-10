<html>
<body>
	<div id="loader-wrapper">
		<center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
		<h5>SIPATUH Haji Khusus</h5>
	</div>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Edit Pra Manifest</h1>
	      	<p class="mb-4">Edit Pra Manifest merupakan tampilan untuk mengubah Pra Manifest yang sudah dimasukkan.</p>

          	<form id="form-edit">
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Pra Manifest</h6>
		            </div>
	            	<div class="card-body">
	            		<?php foreach ($data_pramanifest as $data_pramanifest) { ?>
	            			<input name="kd_pra_manifest" id="kd_pra_manifest" value="<?php echo $data_pramanifest->kd_pra_manifest; ?>" hidden>
	            			<div class="row">
			            		<div class="form-group">
								    <label for="kd_tahun" class="col-lg-12 col-form-label">Kode Tahun</label>
								    <div class="col-lg-12">
								      <input type="text" class="form-control" name="kd_tahun" value="<?php echo $data_pramanifest->kd_tahun; ?>"readonly>
								    </div>
								</div>
								<div class="form-group">
								    <label for="kd_pihk" class="col-lg-12 col-form-label">Kode PIHK</label>
								    <div class="col-lg-12">
								      <input type="text" class="form-control" name="kd_pihk" value="<?php echo $data_pramanifest->kd_pihk; ?>" readonly>
								    </div>
								</div>
								<div class="form-group">
								    <label for="kd_paket" class="col-lg-12 col-form-label">Kode Paket<!--  <label class="font-weight-light font-italic text-danger">*</label> --></label>
								    <div class="col-lg-12">
								      	<input type="text" class="form-control" name="kd_paket" value="<?php echo $data_pramanifest->kd_paket; ?>" readonly>
								    </div>
								</div>
								<div class="form-group">
									<label for="pemberangkatan_ke" class="col-lg-12 col-form-label">Pemberangkatan Ke <!-- <label class="font-weight-light font-italic text-danger">*</label> --></label>
								    <div class="col-lg-12">
									    <input type="text" class="form-control" name="pemberangkatan_ke" value="<?php echo $data_pramanifest->pemberangkatan_ke; ?>" readonly>
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
										    	<?php
										    		$no_flight_split = $data_pramanifest->no_flight_brkt;
													$arr = str_split($no_flight_split);
													$print = '';
													for ($i=0; $i < count($arr); $i++) { 
														if (is_numeric($arr[$i])) {
															$print = $print.$arr[$i];
														}
													}
										    	?>
										    	<div class="input-group">
													<div class="input-group-prepend">
											        	<div class="input-group-text" id="kode_flight_brkt"></div>
											        </div>
											        <input type="text" class="form-control" name="kode_flight_brkt_kirim" id="kode_flight_brkt_kirim" hidden>
										      		<input type="text" class="form-control" name="no_flight_brkt" id="no_flight_brkt" value="<?php echo $print; ?>" required>
										  		</div>
										    </div>
										</div>
									</td>
									<td>
										<div class="form-group">
										    <label for="no_flight_pulang" class="col-lg-11 col-form-label">No. Flight Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
										    <div class="col-lg-11">
										    	<?php
										    		$no_flight_split = $data_pramanifest->no_flight_pulang;
													$arr = str_split($no_flight_split);
													$print = '';
													for ($i=0; $i < count($arr); $i++) { 
														if (is_numeric($arr[$i])) {
															$print = $print.$arr[$i];
														}
													}
										    	?>
										    	<div class="input-group">
													<div class="input-group-prepend">
											        	<div class="input-group-text" id="kode_flight_pulang"></div>
											        </div>
											        <input type="text" class="form-control" name="kode_flight_pulang_kirim" id="kode_flight_pulang_kirim" hidden>
										      		<input type="text" class="form-control" name="no_flight_pulang" id="no_flight_pulang" value="<?php echo $print; ?>" required>
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
										      <input type="text" class="form-control datepicker" name="tanggal_berangkat" id="tanggal_berangkat" value="<?php echo date('m/d/Y', strtotime($data_pramanifest->tanggal_berangkat)); ?>" required>
										    </div>
										</div>
									</td>
									<td>
										<div class="row">
											<div class="form-group" style="margin-right: -70px;">
											    <label for="tanggal_pulang_1" class="col-lg-9 col-form-label">Tanggal Pulang 1<label class="font-weight-light font-italic text-danger">*</label></label>
											    <div class="col-lg-9">
											      <input type="text" class="form-control datepicker" name="tanggal_pulang_1" id="tanggal_pulang_1" value="<?php echo date('m/d/Y', strtotime($data_pramanifest->tanggal_pulang_1)); ?>" required>
											    </div>
											</div>
											<div class="form-group" style="margin-right: -70px;">
											    <label for="tanggal_pulang_2" class="col-lg-9 col-form-label">Tanggal Pulang 2</label>
											    <?php
											    if ($data_pramanifest->tanggal_pulang_2 != NULL) {
											    	$tanggal_pulang_2 = date('m/d/Y', strtotime($data_pramanifest->tanggal_pulang_2));
											    }else{
											    	$tanggal_pulang_2 = '';
											    }
											    ?>
											    <div class="col-lg-9">
											      <input type="text" class="form-control datepicker" name="tanggal_pulang_2" id="tanggal_pulang_2" value="<?php echo $tanggal_pulang_2; ?>">
											    </div>
											</div>
											<div class="form-group" style="margin-right: -70px;">
											    <label for="tanggal_pulang_3" class="col-lg-9 col-form-label">Tanggal Pulang 3</label>
											    <?php
											    if ($data_pramanifest->tanggal_pulang_3 != NULL) {
											    	$tanggal_pulang_3 = date('m/d/Y', strtotime($data_pramanifest->tanggal_pulang_3));
											    }else{
											    	$tanggal_pulang_3 = '';
											    }
											    ?>
											    <div class="col-lg-9">
											      <input type="text" class="form-control datepicker" name="tanggal_pulang_3" id="tanggal_pulang_3" value="<?php echo $tanggal_pulang_3; ?>">
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
										      <input type="time" class="form-control" name="waktu_berangkat" id="waktu_berangkat" value="<?php echo $data_pramanifest->waktu_berangkat; ?>" required>
										    </div>
										</div>
									</td>
									<td>
										<div class="form-group">
										    <label for="waktu_pulang" class="col-lg-11 col-form-label">Waktu Pulang <label class="font-weight-light font-italic text-danger">*</label></label>
										    <div class="col-lg-11">
										      <input type="time" class="form-control" name="waktu_pulang" id="waktu_pulang" value="<?php echo $data_pramanifest->waktu_pulang; ?>" required>
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
										    	<?php
										    		$no_flight_split = $data_pramanifest->no_flight_transit_brkt;
													$arr = str_split($no_flight_split);
													$print = '';
													for ($i=0; $i < count($arr); $i++) { 
														if (is_numeric($arr[$i])) {
															$print = $print.$arr[$i];
														}
													}
										    	?>
										    	<div class="input-group">
													<div class="input-group-prepend">
											        	<div class="input-group-text" id="kode_flight_transit_brkt"></div>
											        </div>
											        <input type="text" class="form-control" name="kode_flight_transit_brkt_kirim" id="kode_flight_transit_brkt_kirim" hidden>
										      		<input type="text" class="form-control" name="no_flight_transit_brkt" id="no_flight_transit_brkt" value="<?php echo $print; ?>">
										  		</div>
										    </div>
										</div>
									</td>
									<td>
										<div class="form-group">
										    <label for="no_flight_transit_pulang" class="col-lg-11 col-form-label">No. Flight Transit Pulang </label>
										    <div class="col-lg-11">
										    	<?php
										    		$no_flight_split = $data_pramanifest->no_flight_transit_pulang;
													$arr = str_split($no_flight_split);
													$print = '';
													for ($i=0; $i < count($arr); $i++) { 
														if (is_numeric($arr[$i])) {
															$print = $print.$arr[$i];
														}
													}
										    	?>
										    	<div class="input-group">
													<div class="input-group-prepend">
											        	<div class="input-group-text" id="kode_flight_transit_pulang"></div>
											        </div>
											        <input type="text" class="form-control" name="kode_flight_transit_pulang_kirim" id="kode_flight_transit_pulang_kirim" hidden>
										      		<input type="text" class="form-control" name="no_flight_transit_pulang" id="no_flight_transit_pulang" value="<?php echo $print; ?>">
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
											    	<?php foreach($bandara_tujuan_pulang as $bandara_tujuan_pulang){ ?>
													<option value="<?php echo $bandara_tujuan_pulang->noid ?>"><?php echo $bandara_tujuan_pulang->description ?></option>
													<?php } ?>
												</select>
										    </div>
										</div>
									</td>
								</tr>
							</table>
						<?php } ?>	
					</div>
            	</div>
          

          		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		            	<h6 class="m-0 font-weight-bold text-primary">Detail Jamaah</h6>
		            </div>
            		<div class="card-body">
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
												<td><center><input class="form-check-input checkbox" type="checkbox" name="list_jamaah[]" value="<?php echo $list_jamaah->kode_porsi ?>" id="<?php echo $list_jamaah->kode_porsi ?>"></center></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->kode_porsi ?></label></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->nama_jamaah ?></label></td>
												<td><label class="form-check-label" for="list_jamaah[]"><?php echo $list_jamaah->JENIS_JEMAAH ?></label></td>
											</tr>
										<?php } ?>
									</tbody>
							    </div>
							</table>
						</div>
						<br><input id="submit" value="Simpan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
		var data_form = $('#form-edit').serialize();
		$.ajax({ 
	    	type: "POST",   
        	url: "<?php echo base_url('Dashboard/pramanifest/delete_jamaah_unchecked') ?>",
        	dataType: "JSON",
        	data: {kd_porsi: hapus},
        	success : function(data)
	        {
	        	$.ajax({ 
			    	type: "POST",   
		        	url: "<?php echo base_url('Dashboard/pramanifest/proses_edit') ?>",
		        	dataType: "JSON",
		        	data: data_form,
		        	success : function(data)
			        {
			        	$("#loader-wrapper").hide();
			        	location = '<?php echo base_url('Dashboard/pramanifest') ?>';
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
</script>