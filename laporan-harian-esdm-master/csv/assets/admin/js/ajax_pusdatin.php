<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": true,
		  "bFilter": true,
          "sDom":"lrtip" 
		});
		
	var MyTable2 = $('#list-data2').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": true,
		  "bFilter": true,
          "sDom":"lrtip" 
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

	$(document).on("click", ".update-dataDraftProdMinyak", function() {

		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html('');
			$.get('<?php echo base_url('Lap_pusdatin/show_form_draft'); ?>/'+ID_JENIS_LAPORAN, function(data) {
				MyTable2.fnDestroy();
				$('#tempat-modal-draft').html(data);
				refresh();
			});
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-prodminyak').modal('show');
		})

		// .error(function(data) {
		// 	console.log(data);
		// })
	})

	$(document).on('submit', '#form-update-draft-prodminyak', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataprodharian = $("#PROD_HARIAN").val();
		var dataprodbulanan = $("#PROD_BULANAN").val();
		var dataprodTahunan = $("#PROD_TAHUNAN").val();
		var dataapbn = $("#APBN").val();
		// var dataLevel = $("#LEVEL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		//alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftProdMinyak'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataprodharian : dataprodharian,
				dataprodbulanan : dataprodbulanan,
				dataprodTahunan : dataprodTahunan,
				dataapbn : dataapbn
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-prodminyak").value = "";
				$('#form-update-draft-prodminyak').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftICP", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		//alert(id);

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-icp').modal('show');
		})
	})

	$(document).on('submit', '#form-update-draft-icp', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftICP'); ?>',
			data : {
				dataKeterangan : dataKeterangan,
				dataIdLaporan : dataIdLaporan

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-icp").value = "";
				$('#form-update-draft-icp').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftProdGas", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-prodgas').modal('show');
		})
	})

	$(document).on('submit', '#form-update-draft-prodgas', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataprodharian = $("#PROD_HARIAN").val();
		var dataprodbulanan = $("#PROD_BULANAN").val();
		var dataprodTahunan = $("#PROD_TAHUNAN").val();
		var dataapbn = $("#APBN").val();
		// var dataLevel = $("#LEVEL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		 //alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftProdGas'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataprodharian : dataprodharian,
				dataprodbulanan : dataprodbulanan,
				dataprodTahunan : dataprodTahunan,
				dataapbn : dataapbn

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-prodgas").value = "";
				$('#form-update-draft-prodgas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftEkuiMigas", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-ekui-migas').modal('show');
		})	
	})

	$(document).on('submit', '#form-update-draft-ekui-migas', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataprodharian = $("#PROD_HARIAN").val();
		var dataprodbulanan = $("#PROD_BULANAN").val();
		var dataprodTahunan = $("#PROD_TAHUNAN").val();
		var dataapbn = $("#APBN").val();
		// var dataLevel = $("#LEVEL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftEkuiMigas'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataprodharian : dataprodharian,
				dataprodbulanan : dataprodbulanan,
				dataprodTahunan : dataprodTahunan,
				dataapbn : dataapbn

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-ekui-migas").value = "";
				$('#form-update-draft-ekui-migas').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftLiftingTB", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-liftingtb').modal('show');
		})	
	})

	$(document).on('submit', '#form-update-draft-liftingtb', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataLiftMB = $("#LIFT_MB").val();
		var dataPosisiStock = $("#POSISI_STOCK").val();
		var dataSalurGas = $("#SALUR_GAS").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftLiftTB'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataLiftMB : dataLiftMB,
				dataPosisiStock : dataPosisiStock,
				dataSalurGas : dataSalurGas

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-liftingtb").value = "";
				$('#form-update-draft-liftingtb').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftHargaBBM", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-hargabbm').modal('show');
		})	
	})

	$(document).on('submit', '#form-update-draft-hargabbm', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBBMTertentu = $("#JENIS_TERTENTU").val();
		var dataBBMUmum = $("#BBM_UMUM").val();
		var dataIndonesiaSatuHarga = $("#PROG_IND_SATU_HRG").val();
		var dataHargaPerNegara = $("#HARGA_PERNEGARA").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftHargaBBM'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataBBMTertentu : dataBBMTertentu,
				dataBBMUmum : dataBBMUmum,
				dataIndonesiaSatuHarga : dataIndonesiaSatuHarga,
				dataHargaPerNegara : dataHargaPerNegara,
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-hargabbm").value = "";
				$('#form-update-draft-hargabbm').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftJamali", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-jamali').modal('show');
		})	
	})

	$(document).on('submit', '#form-update-draft-jamali', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataProgress = $("#PROGRESS").val();
		var dataCatatan = $("#CATATAN").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftJamali'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataProgress : dataProgress,
				dataCatatan : dataCatatan

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-jamali").value = "";
				$('#form-update-draft-jamali').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftOpec", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-opec').modal('show');
		})	
	})

	$(document).on('submit', '#form-update-draft-opec', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataBerita = $("#BERITA").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftOpec'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataBerita : dataBerita

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-opec").value = "";
				$('#form-update-draft-opec').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftBatuBara", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-harga-bb-acuan').modal('show');
		})
	})

	$(document).on('submit', '#form-update-draft-harga-bb-acuan', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataHarga = $("#HARGA").val();
		var dataSumber = $("#SUMBER").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftBBAcuan'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataHarga : dataHarga,
				dataSumber : dataSumber

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-harga-bb-acuan").value = "";
				$('#form-update-draft-harga-bb-acuan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftMineral", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-mineral').modal('show');
		})
	})

	$(document).on('submit', '#form-update-draft-mineral', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftMineralAcuan'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataHarga : dataHarga,
				dataSumber : dataSumber

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-mineral").value = "";
				$('#form-update-draft-mineral').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftGatrik", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_pusdatin/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-draft').html(data);
			$('#form-update-draft-stts-tl').modal('show');
		})
	})

	$(document).on('submit', '#form-update-draft-stts-tl', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		// alert(dataIdLaporan);

		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_pusdatin/updateDraftStatusTL'); ?>',
			data : {
				dataKeterangan : dataKeterangan

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-stts-tl").value = "";
				$('#form-update-draft-stts-tl').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(msg){
				console.log(msg.message);
			}
		})
	});

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

	$('#tambah-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>