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
		tampilMapping_izin();
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

	$(document).on("click", ".update-dataUrutan_izin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Mapping_izin/urutan'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-urutan_izin').modal('show');
		})
	})

	function f_show(obj) {
		if(obj.value){
			var id = (obj.value);

			$.ajax({
				method: "POST",
				url: "<?php echo base_url('Mapping_izin/test'); ?>",
				data: $('#form-update-mapping_izin').serialize(),
			})
			.done(function(data) {
				var newData = jQuery.parseJSON(data);

				var tableDaftarPersyaratan = $('.daftar-persyaratan').DataTable();

				tableDaftarPersyaratan.clear();
				tableDaftarPersyaratan.rows.add(newData);
				tableDaftarPersyaratan.draw();

				// $('#checklist-holder').html(data);
			})
		} else {        

		}
	}

	function f_show_urutan(obj) {
		if(obj.value){
			var id = (obj.value);

			$.ajax({
				method: "POST",
				url: "<?php echo base_url('Mapping_izin/urutanGet'); ?>",
				data: $('#form-update-urutan_izin').serialize(),
			})
			.done(function(data) {
				// var data = jQuery.parseJSON(data);
				$('#checklist-holder').html(data);
			})
		} else {        

		}
	}

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
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		formData.delete("ID_PERSYARATAN[]"); // Delete will be duplicated data

		var tableDaftarPersyaratan = $('.daftar-persyaratan').DataTable();
		var checkboxData = tableDaftarPersyaratan.$('input[type="checkbox"]').serializeArray();
		for (var i = 0; i < checkboxData.length; i++) {
			formData.append('ID_PERSYARATAN[]', checkboxData[i].value);
		}

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapping_izin/prosesUpdate'); ?>',
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			// tampilMapping_izin();
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

	$(document).on('submit', '#form-update-urutan_izin', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Mapping_izin/prosesUrutan'); ?>',
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			// tampilMapping_izin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-urutan_izin").reset();
				$('#update-urutan_izin').modal('hide');
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
	$(document).on('shown.bs.modal', '#update-mapping_izin', function () {
		$('.daftar-persyaratan').DataTable().columns.adjust().draw();
	})
</script>