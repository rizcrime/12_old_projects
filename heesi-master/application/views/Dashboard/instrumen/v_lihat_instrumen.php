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
						 <a href="<?php echo base_url().'Dashboard/Instrumen/export/'.$DataPIHK->instrumen_as_id ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">PIHK</label>
									<div class="col-lg-12">
									  <input type="text" class="form-control" name="nama_petugas" readonly value="<?php echo $DataPIHK->pihk ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Nama Petugas / Pengurus PIHK</label>
									<div class="col-lg-12">
									  <input type="text" readonly class="form-control" name="nama_petugas" value="<?php echo $DataPIHK->nama_petugas ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kd_tahun" class="col-lg-12 col-form-label">Nomor Telepon</label>
									<div class="col-lg-12">
									  <input type="text" readonly class="form-control" name="nomor_telepon" value="<?php echo $DataPIHK->no_telepon_petugas ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
										<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 1</label>
										<div class="col-lg-12">
										  <input type="text" readonly class="form-control" name="nomor_telepon" value="<?php echo $DataPIHK->daerah_kerja_1 ?>">
										</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
										<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 2</label>
										<div class="col-lg-12">
										  <input type="text" readonly class="form-control" name="nomor_telepon" value="<?php echo $DataPIHK->daerah_kerja_2 ?>">
										</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
										<label for="kd_tahun" class="col-lg-12 col-form-label">Daerah Kerja 3</label>
										<div class="col-lg-12">
										  <input type="text" readonly class="form-control" name="nomor_telepon" value="<?php echo $DataPIHK->daerah_kerja_3 ?>">
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
									<td></td>
									<td><?php echo $layanan->nama_layanan_detail; ?></td>
									<td><?php echo $InstrumenDetail[$x]->rencana ?></td>
									<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
										<td align='center'>
										</td>
										<td align='center'>
										</td>
										<td align='center'>
										</td>
									<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
										<td align='center'>
											<i class="fas fa-check"></i>
										</td>
										<td align='center'>
										</td>
										<td align='center'>
										</td>
									<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
										<td align='center'>
										</td>
										<td align='center'>
											<i class="fas fa-check"></i>
										</td>
										<td align='center'>
										</td>
									<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
										<td align='center'>
										</td>
										<td align='center'>
										</td>
										<td align='center'>
											<i class="fas fa-check"></i>
										</td>
									<?php endif ?>
										<td>Jumlah Jemaah: <?php echo $KeteranganKetinggal->jumlah_jemaah ?></td>
										</tr>
										<tr>
											<td></td>
											<td colspan="5"></td>
											<td>Alasan :<?php echo $KeteranganKetinggal->alasan ?></td>
										</tr>   
										<tr>
											<td></td>
											<td colspan="5"></td>
											<td>Posisi Jemaah : <?php echo $KeteranganKetinggal->posisi_jemaah; ?></td>
										</tr>     
									<?php elseif ($layanan->instrumen_as_layanan_detail_id == 23 || $layanan->instrumen_as_layanan_detail_id == 41): ?>
										<tr>
													<td></td>
													<td><?php echo $layanan->nama_layanan_detail; ?></td>
													<td><?php echo $InstrumenDetail[$x]->rencana ?></td>
													<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
														<td align='center'>
														</td>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
													<?php endif ?>
													<td>Jumlah : <?php echo $KeteranganSakit[$index_sakit]->jumlah ?></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Lokasi dirawat : <?php echo $KeteranganSakit[$index_sakit]->lokasi_dirawat ?></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Sakit : <?php echo $KeteranganSakit[$index_sakit]->sakit ?></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Penanganan : <?php echo $KeteranganSakit[$index_sakit]->penanganan ?></td>
												</tr>
												<?php $index_sakit++; ?>
									<?php elseif ($layanan->instrumen_as_layanan_detail_id == 24 || $layanan->instrumen_as_layanan_detail_id == 42): ?>
										<tr>
													<td></td>
													<td><?php echo $layanan->nama_layanan_detail; ?></td>
													<td><?php echo $InstrumenDetail[$x]->rencana ?></td>
													<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
														<td align='center'>
														</td>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
														<td align='center'>
														</td>
													<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
														<td align='center'>
														</td>
														<td align='center'>
														</td>
														<td align='center'>
															<i class="fas fa-check"></i>
														</td>
													<?php endif ?>
													<td>Jumlah : <?php echo $KeteranganWafat[$index_wafat]->jumlah ?></td>
												</tr>
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Penanganan : <?php echo $KeteranganWafat[$index_wafat]->penanganan ?></td>
												</tr>   
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>COD : <?php echo $KeteranganWafat[$index_wafat]->cod ?></td>
												</tr>   
												<tr>
													<td></td>
													<td colspan="5"></td>
													<td>Lokasi Pemakaman :<?php echo $KeteranganWafat[$index_wafat]->lokasi_pemakaman ?></td>
												</tr>
												<?php $index_wafat++; ?>
										<?php else: ?>
											<tr>
												<td></td>
												<td><?php echo $layanan->nama_layanan_detail; ?></td>
												<td><?php echo $InstrumenDetail[$x]->rencana ?></td>
												<?php if ($InstrumenDetail[$x]->realisasi == 0): ?>
													<td align='center'>
													</td>
													<td align='center'>
													</td>
													<td align='center'>
													</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 1): ?>
													<td align='center'>
														<i class="fas fa-check"></i>
													</td>
													<td align='center'>
													</td>
													<td align='center'>
													</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 2): ?>
													<td align='center'>
													</td>
													<td align='center'>
														<i class="fas fa-check"></i>
													</td>
													<td align='center'>
													</td>
												<?php elseif ($InstrumenDetail[$x]->realisasi == 3): ?>
													<td align='center'>
													</td>
													<td align='center'>
													</td>
													<td align='center'>
														<i class="fas fa-check"></i>
													</td>
												<?php endif ?>
												<td><?php echo $InstrumenDetail[$x]->keterangan ?></td> 
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
									<td></td>
									<td colspan=6>
										<?php echo $InstrumenDetailMasalah->keterangan ?>
									</td>
								</tr>	
							</tbody>
						</table>
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
		url: "<?php echo base_url('Dashboard/Instrumen/proses_tambah') ?>",
		data: formData,
		processData: false,
		contentType: false
	  })
	  .done(function(data) {
		window.location = "<?php echo base_url('Dashboard/ProfileJemaah'); ?>";
		 $("#loader-wrapper").hide();
	  });

	  e.preventDefault();
	});

</script>
