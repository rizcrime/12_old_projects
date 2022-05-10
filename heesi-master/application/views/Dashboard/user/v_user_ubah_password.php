<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Ubah Password</h1>
	      	<p class="mb-4">Ubah Password adalah menu untuk mengubah password yang sebelumnya.</p>

			<?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> ', '</div>'); ?>
          
          	<?php echo form_open('') ?>
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
		            </div>
	            	<div class="card-body">
						<div class="form-group">
						    <label for="password_baru" class="col-lg-11 col-form-label">Password Baru</label>
						    <div class="col-md-5">
						      <input type="password" class="form-control" name="password_baru">
						    </div>
						</div>
						<div class="form-group">
						    <label for="konfirmasi_password_baru" class="col-lg-11 col-form-label">Konfirmasi Password Baru</label>
						    <div class="col-md-5">
						      <input type="password" class="form-control" name="konfirmasi_password_baru">
						    </div>
						</div>
						<input type="submit" value="Simpan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="" data-target="">
					</div>
            	</div>
          

			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>
