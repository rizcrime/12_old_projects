<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": true,
		  "bFilter": true,
          "sDom":"lrtip" // default is lfrtip, where the f is the filter
		});
		
	var MyTable2 = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": true,
		  "bFilter": true,
          "sDom":"lrtip" // default is lfrtip, where the f is the filter
		});

	window.onload = function() {
		//tampilAdmin();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}
	
	function tampilAdmin() {
		$.get('<?php echo base_url('Admin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-admin').html(data);
			refresh();
		});
	}

	$(document).on("click", ".update-dataAdmin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-admin').modal('show');
		})
	})

	var id_admin;
	$(document).on("click", ".konfirmasiHapus-admin", function() {
		id_admin = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAdmin", function() {
		var id = id_admin;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilAdmin();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-admin', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAdmin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-admin").reset();
				$('#update-admin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-admin').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			console.log(data);
			var out = jQuery.parseJSON(data);

			tampilAdmin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-admin").reset();
				$('#tambah-admin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".update-dataDraftKlikMigas", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_klik/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-migas').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-migas', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataJenis = $("#JENIS option:selected").val();  

		var dataUrl = $("#URL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_klik/updateDraft'); ?>',
			data : {
				dataBerita : dataBerita,
				dataJenis : dataJenis,
				dataUrl : dataUrl,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-migas").value = "";
				$('#form-update-draft-migas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftKlikGeologi", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_klik/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-geologi').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-geologi', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataJenis = $("#JENIS option:selected").val();  

		var dataUrl = $("#URL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_klik/updateDraftGeologi'); ?>',
			data : {
				dataBerita : dataBerita,
				dataJenis : dataJenis,
				dataUrl : dataUrl,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-geologi").value = "";
				$('#form-update-draft-geologi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftKlikEbtke", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_klik/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-ebtke').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-ebtke', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataJenis = $("#JENIS option:selected").val();  

		var dataUrl = $("#URL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_klik/updateDraftEbtke'); ?>',
			data : {
				dataBerita : dataBerita,
				dataJenis : dataJenis,
				dataUrl : dataUrl,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-ebtke").value = "";
				$('#form-update-draft-ebtke').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftKlikGatrik", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_klik/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-gatrik').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-gatrik', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataJenis = $("#JENIS option:selected").val();  

		var dataUrl = $("#URL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_klik/updateDraftGatrik'); ?>',
			data : {
				dataBerita : dataBerita,
				dataJenis : dataJenis,
				dataUrl : dataUrl,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-gatrik").value = "";
				$('#form-update-draft-gatrik').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftKlikMinerba", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_klik/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-minerba').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-minerba', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataJenis = $("#JENIS option:selected").val();  

		var dataUrl = $("#URL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_klik/updateDraftMinerba'); ?>',
			data : {
				dataBerita : dataBerita,
				dataJenis : dataJenis,
				dataUrl : dataUrl,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-minerba").value = "";
				$('#form-update-draft-minerba').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$('#tambah-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>