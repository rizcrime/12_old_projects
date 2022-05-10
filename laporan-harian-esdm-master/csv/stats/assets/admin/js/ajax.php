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

	window.onload = function() {
		tampilVerifikasi_bidder();
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

	//Verifikasi Bidder
	function tampilVerifikasi_bidder() {
		$.get('<?php echo base_url('Verifikasi_bidder/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-verifikasi_bidder').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataVerifikasi_bidder", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-verifikasi_bidder').modal('show');
		})
	})

	$(document).on("click", ".tolak-data-Verifikasi_bidder", function() {
		var id = $(this).attr("data-id");
		$('#detail-verifikasi_bidder').modal('hide');
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/tolak'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			
			$('#tempat-modal').html(data);
			$('#tolak-verifikasi_bidder').modal('show');

		})
	})

	$(document).on("click", ".update-dataVerifikasi_bidder", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-verifikasi_bidder').modal('show');
		})
	})

	var id_verifikasi_bidder;
	$(document).on("click", ".konfirmasiHapus-verifikasi_bidder", function() {
		id_verifikasi_bidder = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataVerifikasi_bidder", function() {
		var id = id_verifikasi_bidder;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilVerifikasi_bidder();
			$('.msg').html(data);
			effect_msg();
		})
	})

	var id_verifikasi_bidder;
	$(document).on("click", ".konfirmasi-verifikasi_bidder", function() {
		id_verifikasi_bidder = $(this).attr("data-id");
	})

	$(document).on("click", ".verifikasi-dataVerifikasi_bidder", function() {
		// var id = id_verifikasi_bidder;
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/verifikasi'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#detail-verifikasi_bidder').modal('hide');
			tampilVerifikasi_bidder();
			$('.msg').html(data);
			effect_msg();
			location.reload();
		})
	})

	$(document).on("submit", "#form-tolak", function() {
		var formData = new FormData($(this)[0]);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/prosesTolak'); ?>",
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilVerifikasi_bidder();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tolak").reset();
				$('#tolak-verifikasi_bidder').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		e.preventDefault();
	})

	$(document).on('submit', '#form-update-verifikasi_bidder', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Verifikasi_bidder/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})

		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilVerifikasi_bidder();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				
				document.getElementById("form-update-verifikasi_bidder").reset();
				$('#update-verifikasi_bidder').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-verifikasi_bidder').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Verifikasi_bidder/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilVerifikasi_bidder();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-verifikasi_bidder").reset();
				$('#tambah-verifikasi_bidder').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-verifikasi_bidder').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-verifikasi_bidder').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Bidder
	function tampilBidder() {
		$.get('<?php echo base_url('Bidder/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-bidder').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataBidder", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Bidder/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-bidder').modal('show');
		})
	})

	$(document).on("click", ".update-dataBidder", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Bidder/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-bidder').modal('show');
		})
	})

	var id_bidder;
	$(document).on("click", ".konfirmasiHapus-bidder", function() {
		id_bidder = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataBidder", function() {
		var id = id_bidder;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Bidder/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilBidder();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-bidder', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Bidder/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBidder();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-bidder").reset();
				$('#update-bidder').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-bidder').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Bidder/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilBidder();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-bidder").reset();
				$('#tambah-bidder').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-bidder').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-bidder').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Izin_Instansi
	function tampilIzin_Instansi() {
		$.get('<?php echo base_url('Izin_Instansi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-izin_instansi').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataIzin_Instansi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Izin_Instansi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-izin_instansi').modal('show');
		})
	})

	$(document).on("click", ".update-dataIzin_Instansi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Izin_Instansi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-izin_instansi').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-izin_instansi", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataIzin_Instansi", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Izin_Instansi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilIzin_Instansi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-izin_instansi', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Izin_Instansi/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin_Instansi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-izin_instansi").reset();
				$('#update-izin_instansi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-izin_instansi').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Izin_Instansi/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilIzin_Instansi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-izin_instansi").reset();
				$('#tambah-izin_instansi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-izin_instansi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-izin_instansi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Mapping_izin
	function tampilMapping_izin() {
		$.get('<?php echo base_url('Mapping_izin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-mapping_izin').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataMapping_izin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapping_izin/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-mapping_izin').modal('show');
		})
	})

	$(document).on("click", ".update-dataMapping_izin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapping_izin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-mapping_izin').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-mapping_izin", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataMapping_izin", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapping_izin/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilMapping_izin();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-mapping_izin', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapping_izin/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMapping_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-mapping_izin").reset();
				$('#update-mapping_izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-mapping_izin').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapping_izin/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilMapping_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-mapping_izin").reset();
				$('#tambah-mapping_izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-mapping_izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-mapping_izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//T_persyaratan_izin

	//Pemohon
	function tampilPemohon() {
		$.get('<?php echo base_url('Pemohon/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pemohon').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataPemohon", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pemohon/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-pemohon').modal('show');
		})
	})

	$(document).on("click", ".update-dataPemohon", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pemohon/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pemohon').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-pemohon", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPemohon", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pemohon/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPemohon();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-pemohon', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pemohon/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPemohon();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pemohon").reset();
				$('#update-pemohon').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-pemohon').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pemohon/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilT_persyaratan_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pemohon").reset();
				$('#tambah-pemohon').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-pemohon').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-pemohon').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	

	//Kabkot
	function tampilKabkot() {
		$.get('<?php echo base_url('Kabkot/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kabkot').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataKabkot", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kabkot/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-kabkot').modal('show');
		})
	})

	$(document).on("click", ".update-dataKabkot", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kabkot/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kabkot').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-kabkot", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKabkot", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kabkot/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKabkot();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-kabkot', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kabkot/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKabkot();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kabkot").reset();
				$('#update-kabkot').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-kabkot').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kabkot/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilT_persyaratan_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kabkot").reset();
				$('#tambah-kabkot').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-kabkot').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-kabkot').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	
	//Provinsi
	function tampilProvinsi() {
		$.get('<?php echo base_url('Provinsi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-provinsi').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataProvinsi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Provinsi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-provinsi').modal('show');
		})
	})

	$(document).on("click", ".update-dataProvinsi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Provinsi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-provinsi').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-provinsi", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataProvinsi", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Provinsi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilProvinsi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-provinsi', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Provinsi/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProvinsi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-provinsi").reset();
				$('#update-provinsi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-provinsi').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Provinsi/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilT_persyaratan_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-provinsi").reset();
				$('#tambah-provinsi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-provinsi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-provinsi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Role
	function tampilRole() {
		$.get('<?php echo base_url('Role/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-role').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataRole", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Role/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-role').modal('show');
		})
	})

	$(document).on("click", ".update-dataRole", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Role/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-role').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-role", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataRole", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Role/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilRole();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-role', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Role/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilRole();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-role").reset();
				$('#update-role').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-role').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Role/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilT_persyaratan_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-role").reset();
				$('#tambah-role').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-role').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-role').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	// jQuery(function($) {

	   $('[data-rel=popover]').popover({html:true});
	    
	 // });

	 //untuk daftar
	//  $('#formDaftar').submit(function(e) {
	// 	var formData = new FormData($(this)[0]);

	// 	$.ajax({
	// 		method: 'POST',
	// 		url: '<?php //echo base_url('Registrasi/register'); ?>',
	// 		data: formData,
	// 		processData: false,
    //         contentType: false
	// 	})
	// 	.done(function(data) {
	// 		var out = jQuery.parseJSON(data);

	// 		if (out.status == 'form') {
	// 			$('.form-msg').html(out.msg);
	// 			$('#modalRegister').modal('show')
	// 			effect_msg_form();
	// 		} else {
	// 			document.getElementById("form-daftar").reset();
	// 			$('#modalRegister').modal('show');
	// 			$('.msg').html(out.msg);
	// 			effect_msg();
	// 		}
	// 	})

	// 	e.preventDefault();
	// });

	 //Skema Izin
	function tampilSkemaIzin() {
		$.get('<?php echo base_url('SkemaIzin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-skemaizin').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataSkemaIzin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SkemaIzin/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-skemaizin').modal('show');
		})
	})

	$(document).on("click", ".update-dataSkemaIzin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SkemaIzin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-skemaizin').modal('show');
		})
	})


	$(document).on('submit', '#form-update-skemaizin', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('SkemaIzin/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKabkot();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-skemaizin").reset();
				$('#update-skemaizin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-skemaizin').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('SkemaIzin/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilT_persyaratan_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-skemaizin").reset();
				$('#tambah-kabkot').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-skemaizin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-skemaizin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Workflow Skema
	function tampilSkemaWorkflow() {
		$.get('<?php echo base_url('Skema_workflow/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-skema_workflow').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataSkema_workflow", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_workflow/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-skema_workflow').modal('show');
		})
	})

	$(document).on("click", ".update-dataSkema_workflow", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_workflow/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-skema_workflow').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-skema_workflow", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataSkema_workflow", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_workflow/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSkemaWorkflow();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-skema_workflow', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Skema_workflow/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSkemaWorkflow();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-skema_workflow").reset();
				$('#update-skema_workflow').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-skema_workflow').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Skema_workflow/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSkemaWorkflow();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-skema_workflow").reset();
				$('#tambah-skema_workflow').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-skema_workflow').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-skema_workflow').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	

</script>