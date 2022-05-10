<div class="alert alert-info alert-dismissible" style="margin-top: 5px;">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<p><i class="glyphicon glyphicon-info-sign"></i><strong> Disarankan untuk menggunakan browser Google Chrome versi terbaru untuk kenyamanan Anda</strong></p>
</div>
<?php if(!isset($this->userdata->ID_ROLE)) { ?>
	<?php if(isset($permohonan_disetujui_today)): ?>
		<div class="alert alert-info alert-dismissible" style="margin-top: 5px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><i class="glyphicon glyphicon-info-sign"></i><strong> Permohonan Anda telah disetujui.</strong></p>
		</div>
	<?php endif; ?>
	<?php if($this->session->flashdata('msg')): ?>
		<div class="alert alert-info alert-dismissible" style="margin-top: 5px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p><i class="glyphicon glyphicon-info-sign"></i><strong> <?php echo $this->session->flashdata('msg'); ?></strong></p>
		</div>
	<?php endif; ?>
	<?php if($this->userdata->IS_DOKUMEN_KOMPLIT == ''){ ?>
		<div class="row">
			<div class="col-lg-6 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>Update Profile</h3>

						<p>Mohon Isi Data Perusahaan Dahulu!</p>
					</div>
					<div class="icon">
						<i class="ion ion-ios-contact"></i>
					</div>
					<a href="<?php echo base_url('Profile_perusahaan') ?>" class="small-box-footer">Edit data Perusahaan <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	<?php } ?>
<?php } else { ?>
	<center>
		Bulan
		<select id="BULAN">
			<?php
				$tgl = intval(date('m'));
				$val = '';
				for ($i=1; $i <= 12 ; $i++) {
					if ($i == 1) {
						$bulan = 'Januari';
					} elseif ($i == 2) {
						$bulan = 'Febuari';
					} elseif ($i == 3) {
						$bulan = 'Maret';
					} elseif ($i == 4) {
						$bulan = 'April';
					} elseif ($i == 5) {
						$bulan = 'Mei';
					} elseif ($i == 6) {
						$bulan = 'Juni';
					} elseif ($i == 7) {
						$bulan = 'Juli';
					} elseif ($i == 8) {
						$bulan = 'Agustus';
					} elseif ($i == 9) {
						$bulan = 'September';
					} elseif ($i == 10) {
						$bulan = 'Oktober';
					} elseif ($i == 11) {
						$bulan = 'November';
					} elseif ($i == 12) {
						$bulan = 'Desember';
					}

					if ($i == $tgl) {
						echo '<option value="'.$i.'" selected>'.$bulan.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$bulan.'</option>';
					}
				}
			?>
		</select>
		<select id="TAHUN">
			<?php
				$year = date('Y');
				$yearpast = $year - 10;
				$val = '';
				for ($i=1; $i <= 10 ; $i++) {
					$temp = $yearpast + $i;
					if ($temp == $year) {
						echo '<option value="'.$temp.'" selected>'.$temp.'</option>';
					} else {
						echo '<option value="'.$temp.'">'.$temp.'</option>';
					}
				}
			?>
		</select>
		<button id="pilihPermohonan">Submit</button>
	</center>
	<br>
	<div class="row">
		<div class="col-md-6">
			<div class="bar" style="width:100%; height:400px;"></div>
		</div>
		<div class="col-md-6">
			<div class="pie" style="width:100%; height:400px;"></div>      
		</div>
	</div>
	<br>
	<div class="box-body" style="background-color: white">
		<div id="judulSetuju"></div>
		<table id="list-setuju" class="display" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NAMA PERUSAHAAN</th>
					<th>TGL PENGAJUAN</th>
					<th>JENIS IZIN</th>
					<th>FILE IZIN</th>
					<th>EVALUASI</th>
				</tr>
			</thead>
			<tbody id="data-setuju">

			</tbody>
		</table>
	</div>
	<br>
	<div class="box-body" style="background-color: white">
		<div id="judulTolak"></div>
		<table id="list-tolak" class="display" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NAMA PERUSAHAAN</th>
					<th>TGL PENGAJUAN</th>
					<th>JENIS IZIN</th>
					<th>PENOLAK</th>
					<th>EVALUASI</th>
				</tr>
			</thead>
			<tbody id="data-tolak">

			</tbody>
		</table>
	</div>
<?php } ?>
<!-- DIPROSES -->
<div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Permohonan Izin Dalam Proses</strong></h4>
          </div>

		<table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
		<thead>
		<tr>
			<td width="5%">No</td>
			<td width="20%">No Tracking</td>
			<td width="20%">Tgl Pengajuan</td>
			<td width="55%">Jenis Izin</td>
		</tr>
		</thead>
		<tbody>
		<?php 
		$i = 1;
		foreach ($list_permohonan_diproses as $row): 
		?>
			<tr>
			<td><?=$i++?></td>
			<td><a href='<?=base_url("Home_perusahaan/track/".encrypted_id_permohonan($row->ID_PERMOHONAN)) ?>' target="_blank"><?=encrypted_id_permohonan($row->ID_PERMOHONAN)?></td>
			<td><?=tgl_indo($row->TGL_PENGAJUAN)?></td>
			<td><?=$row->NAMA_TEMPLATE ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	</div>
<!-- ./DIPROSES -->
<br/>

<!-- DISETUJUI -->
<div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Permohonan Izin Disetujui</strong></h4>
          </div>

		<table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
		<thead>
		<tr>
			<td width="5%">No</td>
			<td width="20%">No Tracking</td>
			<td width="20%">Tgl Pengajuan</td>
			<td width="55%">Jenis Izin</td>
		</tr>
		</thead>
		<tbody>
		<?php 
		$i = 1;
		foreach ($list_permohonan_disetujui as $row): 
		?>
			<tr>
			<td><?=$i++?></td>
			<td><a href='<?=base_url("Home_perusahaan/track/".encrypted_id_permohonan($row->ID_PERMOHONAN)) ?>' target="_blank"><?=encrypted_id_permohonan($row->ID_PERMOHONAN)?></td>
			<td><?=tgl_indo($row->TGL_PENGAJUAN)?></td>
			<td><?=$row->NAMA_TEMPLATE ?></td>
			</tr>
		<?php endforeach; ?>

		</tbody>
		</table>
	</div>
<!-- ./DISETUJUI -->
<br/>

<!-- DITOLAK -->
<div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Permohonan Izin Ditolak</strong></h4>
          </div>

		<table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
		<thead>
		<tr>
			<td width="5%">No</td>
			<td width="20%">No Tracking</td>
			<td width="20%">Tgl Pengajuan</td>
			<td width="55%">Jenis Izin</td>
		</tr>
		</thead>
		<tbody>
		<?php 
		$i = 1;
		foreach ($list_permohonan_ditolak as $row): 
		?>
			<tr>
			<td><?=$i++?></td>
			<td><a href='<?=base_url("Home_perusahaan/track/".encrypted_id_permohonan($row->ID_PERMOHONAN)) ?>' target="_blank"><?=encrypted_id_permohonan($row->ID_PERMOHONAN)?></td>
			<td><?=tgl_indo($row->TGL_PENGAJUAN)?></td>
			<td><?=$row->NAMA_TEMPLATE ?></td>
			</tr>
		<?php endforeach; ?>

		</tbody>
		</table>
	</div>
<!-- ./DITOLAK -->

<div id="tempat-modal"></div>
