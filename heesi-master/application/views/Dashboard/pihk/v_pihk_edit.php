<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Edit PIHK</h1>
	      	<p class="mb-4">Edit PIHK merupakan tampilan untuk mengubah email dari PIHK yang sudah terdaftar.</p>

	      	<?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> ', '</div>'); ?>
          
          	<?php echo form_open('') ?>
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Pra Manifest</h6>
		            </div>
	            	<div class="card-body">
	            		<?php foreach ($data_pihk as $data_pihk) { ?>
	            			<input name="kd_pihk" value="<?php echo $data_pihk->kd_pihk; ?>" hidden>
							<div class="form-group">
							    <label for="email" class="col-lg-11 col-form-label">Email</label>
							    <div class="col-lg-11">
							      <input type="text" class="form-control" name="email" value="<?php echo $data_pihk->email; ?>">
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
