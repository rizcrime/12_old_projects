<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
	      	<p class="mb-4">Edit Profile merupakan menu untuk mengubah Profile PIHK.</p>

			<?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> ', '</div>'); ?>
          
          	<form method="POST" action="<?php echo base_url('Dashboard/user/proses_edit_profile') ?>">
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
		            </div>
	            	<div class="card-body">
	            		<?php foreach ($data_pihk as $data_pihk) { ?>
							<div class="form-group">
							    <label for="kode_pihk" class="col-lg-11 col-form-label">Kode PIHK</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="kode_pihk" value="<?php echo $data_pihk->kd_pihk ?>" readonly>
							    </div>
							</div>
							<div class="form-group">
							    <label for="pihk" class="col-lg-11 col-form-label">Nama PIHK</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="pihk" value="<?php echo $data_pihk->pihk ?>" readonly>
							    </div>
							</div>
							<div class="form-group">
							    <label for="no_telp" class="col-lg-11 col-form-label">No. Telp</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="no_telp" value="<?php echo $data_pihk->no_telp ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="no_izin" class="col-lg-11 col-form-label">No. Izin</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="no_izin" value="<?php echo $data_pihk->no_izin ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="no_sk" class="col-lg-11 col-form-label">No. SK</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="no_sk" value="<?php echo $data_pihk->no_sk ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="habis_masa_berlaku" class="col-lg-11 col-form-label">Masa Berlaku SK</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="habis_masa_berlaku" value="<?php echo $data_pihk->habis_masa_berlaku ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="pimpinan" class="col-lg-11 col-form-label">Pimpinan</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="pimpinan" value="<?php echo $data_pihk->pimpinan ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="email" class="col-lg-11 col-form-label">Email</label>
							    <div class="col-md-5">
							      <input type="email" class="form-control" name="email" value="<?php echo $data_pihk->email ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="wilayah" class="col-lg-11 col-form-label">Wilayah</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="wilayah" value="<?php echo $data_pihk->wilayah ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="kota" class="col-lg-11 col-form-label">Kota</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="kota" value="<?php echo $data_pihk->kota ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="alamat" class="col-lg-11 col-form-label">Alamat</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="alamat" value="<?php echo $data_pihk->alamat ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="tgl_penetapan_sk" class="col-lg-11 col-form-label">Tanggal Penetapan SK</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="tgl_penetapan_sk" value="<?php echo $data_pihk->tgl_penetapan_sk ?>" required>
							    </div>
							</div>
							<div class="form-group">
							    <label for="asosiasi" class="col-lg-11 col-form-label">Asosiasi</label>
							    <div class="col-md-5">
							      <input type="text" class="form-control" name="asosiasi" value="<?php echo $data_pihk->asosiasi ?>" required>
							    </div>
							</div>
						<?php } ?>
						<input type="submit" value="Simpan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="" data-target="">
					</div>
            	</div>
			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>
