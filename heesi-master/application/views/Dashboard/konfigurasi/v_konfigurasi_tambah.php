<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Entry Hotel dan Transportasi</h1>
	      	<p class="mb-4">Entry Hotel dan Transportasi merupakan tampilan untuk menambahkan data Hotel atau Transportasi yang belum ada pada database.</p>

	      	<form method="post" action="<?php echo base_url('Dashboard/Konfigurasi/insert_to_database') ?>">
	          	<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">Hotel dan Transportasi</h6>
		            </div>
	            	<div class="card-body">
	            		<div class="form-group">
						    <label for="var_id" class="col-lg-12 col-form-label">Jenis Konfigurasi <label class="font-weight-light font-italic text-danger">*</label></label>
						    <div class="col-lg-12">
						      	<select class="form-control select2" name="var_id" id="var_id" required>
						      		<option value="" disabled selected>Pilih</option>
						      		<option value="hotel_mekkah">Hotel Mekkah / Hotel Transit</option>
						      		<option value="hotel_madinah">Hotel Madinah</option>
						      		<option value="hotel_jeddah">Hotel Jeddah</option>
						      		<option value="transport">Syarikah Transportasi</option>
								</select>
						    </div>
						</div>
						<div class="form-group">
						    <label for="description" class="col-lg-12 col-form-label">Nama Hotel / Transportasi <label class="font-weight-light font-italic text-danger">*</label></label>
						    <div class="col-lg-12">
						      	<input type="text" class="form-control" name="description" id="description" required>
						    </div>
						</div>
						<input type="submit" value="Simpan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
					</div>
            	</div>
			</form>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>