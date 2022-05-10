<div class="row">
	<div class="box-body">
		<form method="POST" action="<?php echo base_url('Proses_permohonan/tambahPemohon') ?>">
		<?=get_csrf_token()?>			
			<input type="hidden" name="ID_PEMOHON" value="<?php if($pemohon != '') { echo $pemohon->ID_PEMOHON; } ?>">
			<div class="input-group form-group" style="width: 100%">
				<div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
					<h4><strong>Tambah Data Pemohon</strong></h4>
				</div>
				<div class="profile-user-info profile-user-info-striped">
					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Nama Lengkap
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="NAMA_LENGKAP" value="<?php if($pemohon != '') { echo $pemohon->NAMA_LENGKAP; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Status Hubungan
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<select name="ID_STATUS_HUBUNGAN" class="form-control" onchange="f_status_hubungan(this)">
								<option value="">Pilih</option>
								<option value="1">Status Hubungan 1</option>
								<option value="2">Status Hubungan 2</option>
								<option value="3">Status Hubungan 3</option>
								<option value="4">Status Hubungan 4</option>
							</select>
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							File Surat Kuasa
							
						</div>
						<div class="surat_kuasa profile-info-value" <?php if($pemohon != '') { echo 'style="padding: 0px;display: block;"'; } else { echo 'style="padding: 0px;display: none;"'; } ?>>
							<input type="file" name="FILE_SURAT_KUASA" value="<?php if($pemohon != '') { echo $pemohon->FILE_SURAT_KUASA; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Jenis Identitas
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<select name="ID_JENIS_IDENTITAS" class="form-control" onchange="f_jenis_identitas(this)">
								<option value="">Pilih</option>
								<option value="1">Jenis Identitas 1</option>
								<option value="2">Jenis Identitas 2</option>
								<option value="3">Jenis Identitas 3</option>
								<option value="4">Jenis Identitas 4</option>
							</select>
						</div>
					</div>

					<div class="profile-info-row" style="">
						<div class="profile-info-name" style="min-width: 200PX">
							Nomor Identitas
							
						</div>
						<div class="nomor_identitas profile-info-value" <?php if($pemohon != '') { echo 'style="padding: 0px;display: block;"'; } else { echo 'style="padding: 0px;display: none;"'; } ?>>
							<input type="text" name="NOMOR_IDENTITAS" value="<?php if($pemohon != '') { echo $pemohon->NOMOR_IDENTITAS; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							File Identitas
							
						</div>
						<div class="file_identitas profile-info-value" <?php if($pemohon != '') { echo 'style="padding: 0px;display: block;"'; } else { echo 'style="padding: 0px;display: none;"'; } ?>>
							<input type="file" name="FILE_IDENTITAS" value="<?php if($pemohon != '') { echo $pemohon->FILE_IDENTITAS; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Nomor Telp.
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="text" name="NOMOR_TELP" value="<?php if($pemohon != '') { echo $pemohon->NOMOR_TELP; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							File Foto
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<input type="file" name="FILE_FOTO" value="<?php if($pemohon != '') { echo $pemohon->FILE_FOTO; } ?>" class="form-control" aria-describedby="sizing-addon2">
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name" style="min-width: 200PX">
							Alamat
							
						</div>
						<div class="profile-info-value" style="padding: 0px">
							<textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2"><?php if($pemohon != '') { echo $pemohon->NAMA_LENGKAP; } ?></textarea>
						</div>
					</div>

				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success pull-right">Next</button>
			</form>
			<form method="POST" action="<?php echo base_url('Proses_permohonan') ?>">
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