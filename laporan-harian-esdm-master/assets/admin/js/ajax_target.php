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
		tampilTarget();
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
	//Target
	function tampilTarget() {
		$.get('<?php echo base_url('Target/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-target').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataTarget", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Target/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-target').modal('show');
		})
	})

	$(document).on("click", ".update-dataTarget", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Target/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-target').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-target", function() {
		alert('hehe');
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataTarget", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Target/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilTarget();
			$('.msg').html(data);
			effect_msg();
		})
		
	})

	$(document).on('submit', '#form-update-target', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Target/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTarget();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-target").reset();
				$('#update-target').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		

		e.preventDefault();
	});

	$('#form-tambah-target').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Target/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTarget();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-target").reset();
				$('#tambah-target').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		

		e.preventDefault();
	});

	$('#tambah-target').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-target').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>