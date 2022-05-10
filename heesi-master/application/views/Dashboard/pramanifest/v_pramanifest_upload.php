<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

	    	<!-- Page Heading -->
	      	<h1 class="h3 mb-2 text-gray-800">Upload Pra Manifest</h1>

	      	<p>Silahkan pilih file yang akan diupload :</p>
          	<form action="proses_import" method="POST" enctype="multipart/form-data">
	          	<input type="file" name="file" accept="application/vnd.ms-excel">
	          	<input type="submit" value="Upload">
			</form>
			<a href="<?php echo base_url("Dashboard/Pramanifest/download_template") ?>">Download Template</a>
		</div>
        <!-- /.container-fluid -->
      	<!-- End of Main Content -->
</body>
</html>
