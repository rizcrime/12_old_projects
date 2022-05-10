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
		tampilT_persyaratan_izin();
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
	//T_persyaratan_izin
	function tampilT_persyaratan_izin() {
		$.get('<?php echo base_url('T_persyaratan_izin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-t_persyaratan_izin').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataT_persyaratan_izin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('T_persyaratan_izin/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-t_persyaratan_izin').modal('show');
		})
	})

	$(document).on("click", ".update-dataT_persyaratan_izin", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('T_persyaratan_izin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-t_persyaratan_izin').modal('show');
		})
		.always(function(){
			$.unblockUI();
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-t_persyaratan_izin", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataT_persyaratan_izin", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('T_persyaratan_izin/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilT_persyaratan_izin();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-t_persyaratan_izin', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('T_persyaratan_izin/prosesUpdate'); ?>',
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
				document.getElementById("form-update-t_persyaratan_izin").reset();
				$('#update-t_persyaratan_izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-t_persyaratan_izin').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('T_persyaratan_izin/prosesTambah'); ?>',
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
				document.getElementById("form-tambah-t_persyaratan_izin").reset();
				$('#tambah-t_persyaratan_izin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-t_persyaratan_izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-t_persyaratan_izin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>