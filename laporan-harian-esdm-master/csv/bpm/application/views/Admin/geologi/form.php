<html>
<head>
	<title>Form Import</title>
	
	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
	
	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>
	
	<a href="<?php echo base_url("csv/format.csv"); ?>">Download Format</a>
	<br>
	<br>


	<form method="post" action="<?php echo site_url("Lap_geologi/importData"); ?>" enctype="multipart/form-data">
		<!-- 
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">
		
		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" value="Preview2">
	</form>
	
</body>
</html>
