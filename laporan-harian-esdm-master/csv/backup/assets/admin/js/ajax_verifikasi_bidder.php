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
	
	//Verifikasi Bidder
	function tampilVerifikasi_bidder() {

	}

	$(document).on("click", ".detail-dataVerifikasi_bidder", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
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
		.always(function(){
        	$.unblockUI();
    	})
	})
	var npwp_ajax = null;
	$(document).on('shown.bs.modal', '#detail-verifikasi_bidder', function() {
		var id = $("#npwp-data").attr("data-id");

		npwp_ajax = $.ajax({
			method: "GET",
			url: "<?php echo base_url('Verifikasi_bidder/check_npwp'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#npwn-data-content').html(data);
		})
		.fail(function() {
			$('#npwn-data-content').html("Request Error. Silakan refresh halaman ini.");
		})
	});

	$(document).on('hide.bs.modal', '#detail-verifikasi_bidder', function() {
		npwp_ajax.abort();
	});

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

	$(document).on("click", ".ban-perusahaan-Verifikasi_bidder", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
		var id = $(this).attr("data-id");
		$('#detail-verifikasi_bidder').modal('hide');
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/ban_perusahaan'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$.unblockUI();			
			$('#tempat-modal').html(data);
			$('#ban-perusahaan-modal').modal('show');

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

	$(document).on("click", ".verifikasi-dataVerifikasi_bidder", function(e) {
		// var id = id_verifikasi_bidder;
		e.preventDefault();
		$('#detail-verifikasi_bidder').modal('hide');
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Verifikasi_bidder/verifikasi'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			tampilVerifikasi_bidder();
			$('.msg').html(data);
			effect_msg();
			location.reload(); 
		})
		.always(function() {
			$.unblockUI();
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

	$('#list-need-ver').DataTable({
		"pageLength" : 10,
		"serverSide": true,
		"searching": false,
		"columns": [
            { orderable: false},
            null,
            null,
            null,
            { orderable: false}
        ],
		"ajax": {
			url : "<?=base_url("Verifikasi_bidder/tampil_need_verfivication") ?>",
			type : 'GET'
		},
	});

	$('#list-blacklist').DataTable({
		"pageLength" : 10,
		"serverSide": true,
		"searching": false,
		"columns": [
            { orderable: false},
            null,
            null
        ],
		"ajax": {
			url : "<?=base_url("Verifikasi_bidder/tampil_blacklist") ?>",
			type : 'GET'
		},
	});

	$('#list-decline').DataTable({
		"pageLength" : 10,
		"serverSide": true,
		"searching": false,
		"columns": [
            { orderable: false},
            null,
            null
        ],
		"ajax": {
			url : "<?=base_url("Verifikasi_bidder/tampil_decline") ?>",
			type : 'GET'
		},
	});
</script>
