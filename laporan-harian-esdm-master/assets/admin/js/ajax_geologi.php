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

	
	
	/*$(document).on("click", ".update-dataGeologiGunung", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/update'); ?>",
			//data: "id=" +id
			data: "id=" +id + "&ID_JENIS_LAPORAN=" +ID_JENIS_LAPORAN,
		})
		.done(function(data) {
			
			$('#tempat-modal').html(data);
			$('#update-geologi-gunung').modal('show');
			
			var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_DRAFT").val();
				$('#tempat-modal-draft').html('');
				$.get('<?php echo base_url('Lap_geologi/show_form_draft'); ?>/'+ID_JENIS_LAPORAN, function(data) {
					MyTable.fnDestroy();
					$('#tempat-modal-draft').html(data);
					refresh();
				});
			
			  $('.msg').html(data);
			  effect_msg();
	
		})
		
		.error(function(data) {
		  console.log(data);
		})
		
		
	})*/
	
	
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
		
		// .error(function (data) {
		// 	console.error(data);
		// 	effect_msg(msg);
				
		// })

		.error(function(data) {
			console.log(data);
			//effect_msg(msg);
		})

		e.preventDefault();
	});

	$(document).on("click", ".update-dataDraftGunungapi", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-update-draft').html(data);
			$('#form-update-draft-gunungapi').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-gunungapi', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataDetail = $("#DETAIL").val();
		var dataRekomendasi = $("#REKOMENDASI").val();
		var dataVona = $("#VONA").val();
		var dataLevel = $("#LEVEL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/updateDraftGunungApi'); ?>',
			data : {
				dataKeterangan : dataKeterangan,
				dataDetail : dataDetail,
				dataRekomendasi : dataRekomendasi,
				dataVona : dataVona,
				dataLevel : dataLevel,
				dataIdLaporan : dataIdLaporan

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-gunungapi").value = "";
				$('#form-update-draft-gunungapi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".review-dataDraftGunungapi", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/review'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-review-draft').html(data);
			$('#form-review-draft-gunungapi').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-review-draft-gunungapi', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataDetail = $("#DETAIL").val();
		var dataRekomendasi = $("#REKOMENDASI").val();
		var dataVona = $("#VONA").val();
		var dataLevel = $("#LEVEL").val();
		var dataCatatanReview = $("#CATATAN_REVIEW").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/reviewDraftGunungApi'); ?>',
			data : {
				dataKeterangan : dataKeterangan,
				dataDetail : dataDetail,
				dataRekomendasi : dataRekomendasi,
				dataVona : dataVona,
				dataLevel : dataLevel,
				dataCatatanReview : dataCatatanReview,
			
				dataIdLaporan : dataIdLaporan

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-review-draft-gunungapi").value = "";
				$('#form-review-draft-gunungapi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftGerakanTanah", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-update-draft').html(data);
			$('#form-update-draft-gerakantanah').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-gerakantanah', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataDetail = $("#DETAIL").val();
		// var dataRekomendasi = $("#REKOMENDASI").val();
		// var dataVona = $("#VONA").val();
		// var dataLevel = $("#LEVEL").val();
		var dataCatatanReview = $("#CATATAN_REVIEW").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/updateDraftGerakanTanah'); ?>',
			data : {
				dataKeterangan : dataKeterangan,
				dataDetail : dataDetail,
				//dataRekomendasi : dataRekomendasi,
				//dataVona : dataVona,
				//dataLevel : dataLevel,
				dataCatatanReview : dataCatatanReview,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-gerakantanah").value = "";
				$('#form-update-draft-gerakantanah').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});


	$(document).on("click", ".review-dataDraftGerakanTanah", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/review'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-review-draft').html(data);
			$('#form-review-draft-gerakantanah').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-review-draft-gerakantanah', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataKeterangan = $("#KETERANGAN").val();
		var dataDetail = $("#DETAIL").val();
		// var dataRekomendasi = $("#REKOMENDASI").val();
		// var dataVona = $("#VONA").val();
		// var dataLevel = $("#LEVEL").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/reviewDraftGerakanTanah'); ?>',
			data : {
				dataKeterangan : dataKeterangan,
				dataDetail : dataDetail,
				//dataRekomendasi : dataRekomendasi,
				//dataVona : dataVona,
				//dataLevel : dataLevel,
				dataIdLaporan : dataIdLaporan
			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-review-draft-gerakantanah").value = "";
				$('#form-reivew-draft-gerakantanah').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});

	$(document).on("click", ".update-dataDraftGempaBumi", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/update'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-update-draft').html(data);
			$('#form-update-draft-gempabumi').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-update-draft-gempabumi', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataLokasi = $("#LOKASI").val();
		var dataInformasi = $("#INFORMASI").val();
		var dataKondisi = $("#KONDISI_GEOLOGI_DT").val();
		var dataPenyebab = $("#PENYEBAB_GEMPA").val();
		var dataDampak = $("#DAMPAK_GEMPA").val();
		var dataRekomendasi = $("#REKOMENDASI").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/updateDraftGempaBumi'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataLokasi : dataLokasi,
				dataInformasi : dataInformasi,
				dataKondisi : dataKondisi,
				dataPenyebab : dataPenyebab,
				dataDampak : dataDampak,
				dataRekomendasi : dataRekomendasi
				

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-draft-gempabumi").value = "";
				$('#form-update-draft-gempabumi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
			},
			error:function(response){
				console.log(response.message);
			}
		})
	});


	$(document).on("click", ".review-dataDraftGempaBumi", function() {
		var id = $(this).attr("data-id");
		var jenis = $(this).attr("data-jenis");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Lap_geologi/review'); ?>",
			data: {
				"id" : id,
				"jenis" :jenis
			}
			
		})
		.done(function(data) {
			$('#tempat-modal-review-draft').html(data);
			$('#form-review-draft-gempabumi').modal('show');
		})

		.error(function(data) {
			console.log(data);
		})	
	})

	$(document).on('submit', '#form-review-draft-gempabumi', function(e){
		e.preventDefault();
    	e.stopImmediatePropagation();
		var dataLokasi = $("#LOKASI").val();
		var dataInformasi = $("#INFORMASI").val();
		var dataKondisi = $("#KONDISI_GEOLOGI_DT").val();
		var dataPenyebab = $("#PENYEBAB_GEMPA").val();
		var dataDampak = $("#DAMPAK_GEMPA").val();
		var dataRekomendasi = $("#REKOMENDASI").val();
		var dataIdLaporan = $("#ID_LAPORAN").val();
		
		$.ajax({
			method: 'POST',
			dataType:'json',
			url: '<?php echo base_url('Lap_geologi/reviewDraftGempaBumi'); ?>',
			data : {
				dataIdLaporan : dataIdLaporan,
				dataLokasi : dataLokasi,
				dataInformasi : dataInformasi,
				dataKondisi : dataKondisi,
				dataPenyebab : dataPenyebab,
				dataDampak : dataDampak,
				dataRekomendasi : dataRekomendasi
				

			},
			success : function(response)
			{ 
			var out = jQuery.parseJSON(JSON.stringify(response));
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-review-draft-gempabumi").value = "";
				$('#form-review-draft-gempabumi').modal('hide');
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
	$('#form-update-draft-gunungapi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>