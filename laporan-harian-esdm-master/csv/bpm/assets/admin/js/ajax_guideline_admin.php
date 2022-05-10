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
		tampilGuideline();
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
	//Dok_syarat_perusahaan
	function tampilGuideline() {
		$.get('<?php echo base_url('Guideline_admin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-guideline').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataDok_syarat_perusahaan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Guideline_admin/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-dok_syarat_perusahaan').modal('show');
		})
		.fail(function(data) {
			console.log(data);
		})
	})

	$(document).on("click", ".update-data_guideline", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Guideline_admin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-data_guideline').modal('show');
		})
	})

	var id_gl;
	$(document).on("click", ".konfirmasiHapus-data_guideline", function() {
		id_gl = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-data_guideline", function() {
		var id = id_gl;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Guideline_admin/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilGuideline();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-guideline', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Guideline_admin/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilGuideline();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-guideline").reset();
				$('#update-data_guideline').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-guideline').submit(function(e) {
		var formData = new FormData($(this)[0]);
		
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Guideline_admin/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			
			tampilGuideline();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-guideline").reset();
				$('#tambah-guideline').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		.fail(function(data) {
			alert("test");
		})
		e.preventDefault();
	});

	$('#tambah-guideline').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-data_guideline').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>