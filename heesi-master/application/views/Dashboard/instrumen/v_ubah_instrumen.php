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
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input hidden type="text" name="instrumen_as_id"  value="<?php echo $DataPIHK->instrumen_as_id ?>">
									<label for="kd_tahun" class="col-lg-12 col-form-label">PIHK</label>
									<div class="col-lg-12">
										<select name='kd_pihk' class='form-control pihk'>
								    		<?php foreach ($PIHK as $key): ?>
								    			<?php if ($DataPIHK->kd_pihk == $key->kd_pihk): ?>
								    				<option selected value='<?php echo $key->kd_pihk ?>'><?php echo $key->pihk ?></option>
								    			<?php else: ?>
								    				<option value='<?php echo $key->kd_pihk ?>'><?php echo $key->pihk ?></option>
								    			<?php endif ?>
								    		<?php endforeach ?>
								    	</select>
								    </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Nama Petugas / Pengurus PIHK</label>
									<div class="col-lg-12">
									  <input type="text" class="form-control" name="nama_petugas" value="<?php echo $DataPIHK->nama_petugas ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Nomor Telepon</label>
									<div class="col-lg-12">
									  <input type="text" class="form-control" name="nomor_telepon" value="<?php echo $DataPIHK->no_telepon_petugas ?>">
									</div>
								</div>
							</div>
						</div>
						<!-- array daerah kerja -->
						<?php $daerah_kerja = array('','Bandara','Mekkah','Madinah'); ?>
						<?php $daerah_kerja_view =  array('--Silahkan Pilih--','Bandara','Mekkah','Madinah');?>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 1</label>
									<div class="col-lg-12">
										<select name="daerah_kerja_1" class="form-control">
											<?php for ($i=0; $i < count($daerah_kerja); $i++) { 
												if ($daerah_kerja[$i] == $DataPIHK->daerah_kerja_1) {
													echo "<option selected value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}else{
													echo "<option value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}
											} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 2</label>
									<div class="col-lg-12">
										<select name="daerah_kerja_2" class="form-control">
											<?php for ($i=0; $i < count($daerah_kerja); $i++) { 
												if ($daerah_kerja[$i] == $DataPIHK->daerah_kerja_2) {
													echo "<option selected value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}else{
													echo "<option value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}
											} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 3</label>
									<div class="col-lg-12">
										<select name="daerah_kerja_3" class="form-control">
											<?php for ($i=0; $i < count($daerah_kerja); $i++) { 
												if ($daerah_kerja[$i] == $DataPIHK->daerah_kerja_3) {
													echo "<option selected value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}else{
													echo "<option value='".$daerah_kerja[$i]."'>".$daerah_kerja_view[$i]."</option>";
												}
											} ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-bordered">
							<tr ALIGN="CENTER">
								<th ROWSPAN="2">NO</th>
								<th ROWSPAN="2">STANDARD PELAYANAN MINIMAL HAJI KHUSUS</th>
								<TH ROWSPAN="2">RENCANA PELAYANAN SESUAI KONTRAK</TH>
								<TH COLSPAN="3">REALISASI</TH>
								<TH ROWSPAN="2">KETERANGAN KETIDAKSESUAIAN ANTAR SPM, RENCANA KONTRAK DAN REALISASI</TH>
							</tr>
							<TR align='center'>
								<TH>
									SESUAI
								</TH>
								<TH> SEBAGIAN SESUAI</TH>
								<TH> TIDAK SESUAI</TH>
							</TR>
							<tbody>
								<?php $x = 0; ?>
								<?php $no = 1; ?>
								<?php $nama_layanan = "" ?>
								<?php $nama_judul = "" ?>
								<?php $abc = 'A' ?>
								<?php $index_wafat = 0 ?>
								<?php $index_sakit = 0 ?>
								<?php foreach ($Layanan as $layanan): ?>
									<?php if ($layanan->nama_judul == NULL && $abc == "D"): ?>
										<tr>
										<th><?php echo $abc ?></th>
											<th colspan="6">
												<?php echo $JudulAkumodasi->nama_judul; ?>
											</th>
										</tr>
										<?php $abc++; ?>
										<?php $no = 1; ?>
										<?php $nama_judul = $layanan->nama_judul?>
									<?php elseif ($layanan->nama_judul != $nama_judul): ?>
										<?php $nama_judul = $layanan->nama_judul; ?>
										<tr>
										<th><?php echo $abc ?></th>
											<th colspan="6">
												<?php echo $nama_judul; ?>
											</th>
										</tr>
										<?php $abc++; ?>
										<?php $no = 1; ?>
									<?php endif ?>
									<?php if ($layanan->nama_layanan != $nama_layanan && $layanan->nama_layanan != NULL): ?>
										<?php $nama_layanan = $layanan->nama_layanan; ?>
										<tr>
										<td><?php echo $no ?></td>
											<td colspan="6">
												<?php echo $nama_layanan; ?>
											</td>
										</tr>
										<?php $no++; ?>
								<?php endif ?>
								<?php if ($layanan->instrumen_as_layanan_detail_id == 6): ?>
								<tr>
									<td><input hidden value="<?php echo $InstrumenDetail[$x]->instrumen_as_detail_id ?>" name="instrumen_as_detail_id[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]"></td>
									<td><?php echo $layanan->nama_layanan_detail; ?></td>
									<td><input name="rencana[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $InstrumenDetail[$x]->rencana ?>" class="form-control"></td>
											<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
												 	<input class="sub-menu" checked hidden name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='0' type='radio'></input>
													<td align='center'>
														 <div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='1' type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
														</div>
													</td>
											<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
													<td align='center'>
													 <div class="m-radio-inline">
													 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
													</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
														</div>
													</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
													<td align='center'>
													 <div class="m-radio-inline">
													 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
													</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
														</div>
													</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
													<td align='center'>
													 <div class="m-radio-inline">
													 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
													</div>
													</td>	
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
														</div>
													</td>
													<td align='center'>
														<div class="m-radio-inline">
														 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
														</div>
													</td>
												<?php endif ?>
												<td>Jumlah Jemaah: <input type='number' class="form-control" name='jumlah_jemaah' value="<?php echo $KeteranganKetinggal->jumlah_jemaah ?>"></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Alasan :<textarea name="alasan" class="form-control"><?php echo $KeteranganKetinggal->alasan ?></textarea></td>
												</tr>   
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Posisi Jemaah : <input type="text" class="form-control" name="posisi_jemaah" value="<?php echo $KeteranganKetinggal->posisi_jemaah; ?>"> </td>
												</tr>     
											<?php elseif ($layanan->instrumen_as_layanan_detail_id == 23 || $layanan->instrumen_as_layanan_detail_id == 41): ?>
												<tr>
													<td><input hidden value="<?php echo $InstrumenDetail[$x]->instrumen_as_detail_id ?>" name="instrumen_as_detail_id[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]"></td>
													<td><?php echo $layanan->nama_layanan_detail; ?></td>
													<td><input name="rencana[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $InstrumenDetail[$x]->rencana ?>" class="form-control"></td>
													<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
														 	<input class="sub-menu" checked hidden name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='0' type='radio'></input>
															<td align='center'>
																 <div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='1' type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>	
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php endif ?>
													<td>Jumlah :  <input type='number' value="<?php echo $KeteranganSakit[$index_sakit]->jumlah ?>" class="form-control" name='jumlah_sakit[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]'></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Lokasi dirawat : <input type="text" class="form-control" name="lokasi_dirawat[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganSakit[$index_sakit]->lokasi_dirawat ?>"> </td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Sakit :  <input type="text" class="form-control" name="sakit[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganSakit[$index_sakit]->sakit ?>"></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Penanganan : <input type="text" class="form-control" name="penanganan_sakit[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganSakit[$index_sakit]->penanganan ?>"></td>
												</tr>
												<?php $index_sakit++; ?>
									<?php elseif ($layanan->instrumen_as_layanan_detail_id == 24 || $layanan->instrumen_as_layanan_detail_id == 42): ?>
												<tr>
													<td><input hidden value="<?php echo $InstrumenDetail[$x]->instrumen_as_detail_id ?>" name="instrumen_as_detail_id[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]"></td>
													<td><?php echo $layanan->nama_layanan_detail; ?></td>
													<td><input name="rencana[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $InstrumenDetail[$x]->rencana ?>" class="form-control"></td>
													<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
														 	<input class="sub-menu" checked hidden name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='0' type='radio'></input>
															<td align='center'>
																 <div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='1' type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
															<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
															</div>
															</td>	
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
																</div>
															</td>
															<td align='center'>
																<div class="m-radio-inline">
																 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
																</div>
															</td>
														<?php endif ?>
													<td>Jumlah :  <input type='number' class="form-control" name='jumlah_wafat[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]'value="<?php echo $KeteranganWafat[$index_wafat]->jumlah ?>"></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Penanganan : <input type="text" class="form-control" name="penangan_wafat[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganWafat[$index_wafat]->penanganan ?>"></td>
												</tr>   
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>COD : <input type="text" class="form-control" name="cod[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganWafat[$index_wafat]->cod ?>"></td>
												</tr>   
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Lokasi Pemakaman : <input type="text" class="form-control" name="lokasi_pemakaman[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $KeteranganWafat[$index_wafat]->lokasi_pemakaman ?>"></td>
												</tr>
												<?php $index_wafat++; ?>
										<?php else: ?>
											<tr>
												<td><input hidden value="<?php echo $InstrumenDetail[$x]->instrumen_as_detail_id ?>" name="instrumen_as_detail_id[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]"></td>
												<td><?php echo $layanan->nama_layanan_detail; ?></td>
												<td><input type="text" class="form-control" name="rencana[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="<?php echo $InstrumenDetail[$x]->rencana?>"></td>
												<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
													 	<input class="sub-menu" checked hidden name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='0' type='radio'></input>
														<td align='center'>
															 <div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value='1' type='radio'></input>
															</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
															</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
															</div>
														</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
														<td align='center'>
														 <div class="m-radio-inline">
														 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
														</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
															</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
															</div>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
														<td align='center'>
														 <div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
														</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
															</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
															</div>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
														<td align='center'>
														 <div class="m-radio-inline">
														 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="1" type='radio'></input>
														</div>
														</td>	
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="2" type='radio'></input>
															</div>
														</td>
														<td align='center'>
															<div class="m-radio-inline">
															 	<input class="sub-menu" checked name="realisasi[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" value="3" type='radio'></input>
															</div>
														</td>
													<?php endif ?>
												<td><textarea name="keterangan[<?php echo $layanan->instrumen_as_layanan_detail_id ?>]" class="form-control"><?php echo $InstrumenDetail[$x]->keterangan ?></textarea></td> 
											</tr>
										<?php endif ?>
										<?php $x++; ?>
								<?php endforeach ?>
								<tr>
									<th>
										<?php echo $abc ?>
									</th>
									<th colspan='6'>
										<?php echo $JudulPermasalahan->nama_judul ?>
									</th>
								</tr>
								<tr>
									<td><input hidden value="<?php echo $InstrumenDetailMasalah->instrumen_as_detail_id ?>" name="id_keteranagan_masalah"></td>
									<td colspan=6>
										<textarea class='form-control' name="keterangan_masalah_penanganan" placeholder='Masukkan permasalahan dan penanganannya disini...'><?php echo $InstrumenDetailMasalah->keterangan ?></textarea>
									</td>
								</tr>	
							</tbody>
						</table>
						<center><button type='submit' id="submit" class='btn btn-primary'><i class='fas fa-save'></i> Simpan</button></center>
					</div>
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
				placeholder: "Pilih PIHK",
				width: '100%'
			});
		});
	}
	$(document).on('submit', '#form-input-instrumen', function(e){
	   $("#loader-wrapper").show();
	  var formData = new FormData($(this)[0]);
	  $.ajax({
		method: 'POST',
		url: "<?php echo base_url('Dashboard/Instrumen/proses_ubah') ?>",
		data: formData,
		processData: false,
		contentType: false
	  })
	  .done(function(data) {
		window.location = "<?php echo base_url('Dashboard/Instrumen'); ?>";
		 $("#loader-wrapper").hide();
	  });

	  e.preventDefault();
	});

</script>
