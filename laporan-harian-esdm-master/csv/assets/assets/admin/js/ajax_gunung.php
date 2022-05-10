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
		tampilGunung();
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
	//Gunung
	function tampilGunung() {
		$.get('<?php echo base_url('Gunung/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-gunung').html(data);
			refresh();

			
		});

		
	}


	$(document).on("click", ".detail-dataGunung", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Gunung/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-gunung').modal('show');
		})
	})

	$(document).on("click", ".update-dataGunung", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Gunung/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-gunung').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-gunung", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataGunung", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Gunung/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilGunung();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-gunung', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Gunung/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilGunung();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-gunung").reset();
				$('#update-gunung').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		

		e.preventDefault();
	});

	$('#form-tambah-gunung').submit(function(e) {
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Gunung/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilGunung();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-gunung").reset();
				$('#tambah-gunung').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		

		e.preventDefault();
	});

	$('#tambah-gunung').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-gunung').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>