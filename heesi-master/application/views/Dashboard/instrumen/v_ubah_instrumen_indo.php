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

          	<form id="form-input-instrumen">
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Instrumen</h6>
		            </div>
	            	<div class="card-body">
	            		<!-- id -->
	            		<input name="instrumen_indo_id" type="text" hidden value="<?php echo $DataInstrumenDetail[0]->instrumen_indo_id ?>">
	            		<div class="row">
		            		<div class="form-group">
							    <label for="kd_tahun" class="col-lg-12 col-form-label">PIHK</label>
							    <div class="col-lg-12">
							    	<select name='kd_pihk' class='form-control pihk'>
							    		<?php foreach ($PIHK as $key): ?>
							    			<?php if ($DataInstrumenDetail[0]->kode_pihk == $key->kd_pihk): ?>
							    				<option selected value='<?php echo $key->kd_pihk ?>'><?php echo $key->pihk ?></option>
							    			<?php else: ?>
							    				<option value='<?php echo $key->kd_pihk ?>'><?php echo $key->pihk ?></option>
							    			<?php endif ?>
							    		<?php endforeach ?>
							    	</select>
							    </div>
							</div>
							<div class="form-group">
							    <label for="kd_tahun" class="col-lg-12 col-form-label">Nama Petugas / Pengurus PIHK</label>
							    <div class="col-lg-12">
							      <input type="text" class="form-control" name="nama_petugas" value="<?php echo $DataInstrumenDetail[0]->nama_petugas ?>">
							    </div>
							</div>
						
							<div class="form-group">
							    <label for="kd_tahun" class="col-lg-12 col-form-label">Nomor Telepon</label>
							    <div class="col-lg-12">
							      <input type="text" class="form-control" name="no_telepon_petugas" value="<?php echo $DataInstrumenDetail[0]->no_telepon_petugas ?>">
							    </div>
							</div>
							<div class="form-group">
								 	<label for="kd_tahun" class="col-lg-12 col-form-label">Bandara Keberangkatan</label>
								    <div class="col-lg-12">
									  	<select name='kode_bandara' class='form-control pihk'>
								    		<?php foreach ($Bandara as $key): ?>
								    			<?php if ($DataInstrumenDetail[0]->kode_bandara == $key->noid): ?>
								    				<option selected value='<?php echo $key->noid ?>'><?php echo $key->description ?></option>
								    			<?php else: ?>
								    				<option value='<?php echo $key->noid ?>'><?php echo $key->description ?></option>
								    			<?php endif ?>
								    		<?php endforeach ?>
								    	</select>
								    </div>
							</div>
							<div class="card-body">
		            			<div class="row">
								<div class="form-group">
								    <label for="kd_tahun" class="col-lg-12 col-form-label">Jumlah Jemaah</label>
								    <div class="col-lg-12">
								      <input type="number" name="jumlah_jemaah" class="form-control" name="nama_petugas" value="<?php echo $DataInstrumenDetail[0]->jumlah_jemaah ?>">
								    </div>
								</div>
							
								<div class="form-group">
								    <label for="kd_tahun" class="col-lg-12 col-form-label">Jadwal Keberangkatan</label>
								    <div class="col-lg-12">
								      <input type="text" class="form-control typetanggal" name="jadwal_keberangkat" value="<?php echo date('d-m-Y',strtotime($DataInstrumenDetail[0]->jadwal_keberangkatan ))?>">
								    </div>
								</div>
								<div class="form-group">
									 	<label for="kd_tahun" class="col-lg-12 col-form-label">Nomor Penerbangan dan Maskapai</label>
									    <div class="col-lg-12">
										  	<select name='kode_maskapai' class='form-control pihk'>
									    		<?php foreach ($Maskapai as $key): ?>
									    			<?php if ($DataInstrumenDetail[0]->kode_maskapai == $key->noid): ?>
									    				<option selected value='<?php echo $key->noid ?>'><?php echo $key->description ?></option>
									    			<?php else: ?>
									    				<option value='<?php echo $key->noid ?>'><?php echo $key->description ?></option>
									    			<?php endif ?>
									    		<?php endforeach ?>
									    	</select>
									    </div>
								</div>
							</div>
						</div>
						<table class="table table-bordered">
							<tr ALIGN="CENTER">
								<th ROWSPAN="2">NO</th>
								<th ROWSPAN="2" colspan="2">DAFTAR PERTANYAAN</th>
								<TH COLSPAN="2">REALISASI</TH>
								<TH ROWSPAN="2">KETERANGAN</TH>
							</tr>
							<tr>
								<th>
									ADA / SUDAH
								</th>
								<th>
									TIDAK ADA / BELUM
								</th>
							</tr>
							<tbody>
								<?php $no = 1; ?>
								<?php $index = 0; ?>
								<?php $abc = 'a'; ?>
								<?php foreach ($DataInstrumen as $data): ?>
									<tr>
										<?php if ($no >= 3 && $abc <= 'g'): ?>
											<?php if ($no == 3): ?>
												<td><?php echo $no ?></td>
												<td colspan='5'><?php echo $data->nama_pertnyaan; ?></td>
												<?php $no++; ?>
											<?php else: ?>	
												<td></td>
												<td width="1%"><?php echo $abc ?></td>
												<td><?php echo $data->nama_pertnyaan ?></td>
												<input name="instrumen_indo_penilaian_id[<?php echo $data->instrumen_indo_pertanyaan_id ?>]	" type="text" hidden value="<?php echo $DataInstrumenDetail[$index]->instrumen_indo_penilaian_id ?>">
												<?php if ($DataInstrumenDetail[$index]->realisasi == 99): ?>
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="99" hidden type='radio'></input>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php elseif ($DataInstrumenDetail[$index]->realisasi == 0): ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php else: ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  value="0" type='radio'></input>
														</div>
													</td>	
												<?php endif ?>
												<td><textarea name="keterangan[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  class="form-control"><?php echo $DataInstrumenDetail[$index]->keterangan ?></textarea></td>	
												<?php $index++; ?>
												<?php $abc++; ?>
											<?php endif ?>
										<?php elseif($data->instrumen_indo_pertanyaan_id == 13): ?>
											<td><?php echo $no ?></td>
											<td colspan='2'><?php echo $data->nama_pertnyaan; ?></td>
												<input name="instrumen_indo_penilaian_id[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" type="text" hidden value="<?php echo $DataInstrumenDetail[$index]->instrumen_indo_penilaian_id ?>">
												<?php if ($DataInstrumenDetail[$index]->realisasi == 99): ?>
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="99" hidden type='radio'></input>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php elseif ($DataInstrumenDetail[$index]->realisasi == 0): ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php else: ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  value="0" type='radio'></input>
														</div>
													</td>	
												<?php endif ?>
											<td>Jumlah Jemaah : <input type="number" name="jumlah_jemaah_tidak_jadi_berangkat" value="<?php echo $DataInstrumenDetail[$index]->jumlah_jemaah_tidak_jadi_berangkat ?>" class='form-control'>
												Alasan : <textarea class="form-control" name="alasan"><?php echo $DataInstrumenDetail[$index]->alasan ?></textarea>
											</td>		
											<?php $index++; ?>
											<?php $no++; ?>
										<?php elseif ($data->instrumen_indo_pertanyaan_id == 14):?>
											<td><?php echo $no ?></td>
											<td colspan='2'><?php echo $data->nama_pertnyaan; ?></td>
												<input name="instrumen_indo_penilaian_id[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" type="text" hidden value="<?php echo $DataInstrumenDetail[$index]->instrumen_indo_penilaian_id ?>">
												<?php if ($DataInstrumenDetail[$index]->realisasi == 99): ?>
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="99" hidden type='radio'></input>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php elseif ($DataInstrumenDetail[$index]->realisasi == 0): ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php else: ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  value="0" type='radio'></input>
														</div>
													</td>	
												<?php endif ?>
											<td>Jumlah Jemaah : <input type="number" name="jumlah_jemaah_resiko_tinggi" value="<?php echo $DataInstrumenDetail[$index]->jumlah_jemaah_resiko_tinggi ?>" class='form-control'>
												Keterangan Sakit : <textarea name="keterangan_sakit" class="form-control"><?php echo $DataInstrumenDetail[$index]->keterangan_sakit ?></textarea>
											</td>		
											<?php $index++; ?>
											<?php $no++; ?>
										<?php else: ?>
											<td><?php echo $no ?></td>
											<td colspan='2'><?php echo $data->nama_pertnyaan; ?></td>
												<input name="instrumen_indo_penilaian_id[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" type="text" hidden value="<?php echo $DataInstrumenDetail[$index]->instrumen_indo_penilaian_id ?>">
												<?php if ($DataInstrumenDetail[$index]->realisasi == 99): ?>
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="99" hidden type='radio'></input>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php elseif ($DataInstrumenDetail[$index]->realisasi == 0): ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="0" type='radio'></input>
														</div>
													</td>
												<?php else: ?>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" checked name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]" value="1"  type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
															<input class="sub-menu" name="realisasi[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  value="0" type='radio'></input>
														</div>
													</td>	
												<?php endif ?>
											<td><textarea name="keterangan[<?php echo $data->instrumen_indo_pertanyaan_id ?>]"  class="form-control"><?php echo $DataInstrumenDetail[$index]->keterangan ?></textarea></td>		
											<?php $index++; ?>
											<?php $no++; ?>
										<?php endif ?>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
						<center><button type='submit' id="submit" class='btn btn-primary'><i class='fas fa-save'></i> Simpan</button></center>
            	</div>
			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>

<script>
	$(document).ready(function(){
		$("#loader-wrapper").hide();
		select2();
	});
	function select2() {
        $('select.pihk').each(function(){
            $(this).select2({
                //dropdownParent: $(this),
                placeholder: "Pilih",
                width: '100%'
            });
        });
    }
    $(document).on('submit', '#form-input-instrumen', function(e){
	   $("#loader-wrapper").show();
	  var formData = new FormData($(this)[0]);
	  // alert(formData);
	  $.ajax({
	    method: 'POST',
	    url: "<?php echo base_url('Dashboard/InstrumenIndo/proses_ubah') ?>",
	    data: formData,
	    processData: false,
	    contentType: false
	  })
	  .done(function(data) {
	    window.location = "<?php echo base_url('Dashboard/InstrumenIndo'); ?>";
	     $("#loader-wrapper").hide();
	  });

	  e.preventDefault();
	});
$('.typetanggal').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
});  
</script>
	