<div class="row">
	<div class="box-body">
		<form>
		<?=get_csrf_token()?>			
			<div class="input-group form-group" style="width: 100%">
				<div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
					<h4><strong>Tambah Data Permohonan Izin</strong></h4>
				</div>
				<div class="profile-user-info profile-user-info-striped">
					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Izin Instansi
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="ID_FORM" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Template Izin Instansi
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="ID_TEMPLATE" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Pemohon
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="ID_PEMOHON" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Tanggal Pengajuan
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="TGL_PENGAJUAN" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Tanggal Disetujui
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="TGL_DISETUJUI" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Status
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="ID_CURR_PROSES" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Nomor Izin
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="NOMOR_IZIN" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Nomor Tahunan
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="NOMOR_TAHUNAN" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							TTD
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="ID_TEKS_TTD" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success pull-right">Next</button>
		</form>
		<form method="POST" action="<?php echo base_url('Proses_permohonan/step2') ?>">
		<?=get_csrf_token()?>
				<button type="submit" class="btn pull-right">Previous</button>
		</form>
			</div>
	</div>
</div>
<script>
	function f_status_hubungan(obj) {
		if(obj.value){
			$(".surat_kuasa").attr("style","display:block;padding: 0px;");
		} else {        
			$(".surat_kuasa").attr("style","display:none;padding: 0px;");
		}
	}

	function f_jenis_identitas(obj) {
		if(obj.value){
			$(".nomor_identitas").attr("style","display:block;padding: 0px;");
			$(".file_identitas").attr("style","display:block;padding: 0px;");
		} else {        
			$(".nomor_identitas").attr("style","display:none;padding: 0px;");
			$(".file_identitas").attr("style","display:none;padding: 0px;");
		}
	}
</script>