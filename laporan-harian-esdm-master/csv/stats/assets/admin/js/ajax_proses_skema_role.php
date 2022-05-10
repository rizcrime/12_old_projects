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
		tampilProsesSkema();
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
	//Proses Skema
	function tampilProsesSkema() {
        var idSkema = $("#skemaID").val()
		$.get('<?php echo base_url('Skema_proses_role/tampil/'); ?>'+idSkema, function(data) {
			MyTable.fnDestroy();
			$('#data-skema_proses').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataSkema_proses", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_proses_role/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-skema_proses').modal('show');
		})
	})

	$(document).on("click", ".update-dataSkema_proses", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_proses_role/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-skema_proses').modal('show');
		})
	})

    var id_proses;
	$(document).on("click", ".konfirmasiHapus-skema_proses", function() {
		id_proses = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataSkema_proses", function() {
		var id = id_proses;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Skema_proses_role/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilProsesSkema();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-skema_proses', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Skema_proses_role/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProsesSkema();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-skema_proses").reset();
				$('#update-skema_proses').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-skema_proses').submit(function(e) {
		var formData = new FormData($(this)[0]);
        var idSkema = $("#skemaID").val();
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Skema_proses_role/prosesTambah/'); ?>' + idSkema,
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProsesSkema();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-skema_proses").reset();
				$('#tambah-skema_proses').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-skema_proses').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-skema_proses').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

    $("#showProsesSkema").click(function() {
        tampilProsesSkema();
        
        refresh();
    });
</script>