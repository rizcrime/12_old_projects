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
		tampilSyarat_ketentuan();
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

	function tampilSyarat_ketentuan() {
		$.get('<?php echo base_url('Syarat_ketentuan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-syarat_ketentuan').html(data);
			refresh();
		});
	}

	$(document).on("click", ".detail-dataSyaratKetentuan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Syarat_ketentuan/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-syarat_ketentuan').modal('show');
		})
	})

	$(document).on("click", ".update-dataSyaratKetentuan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Syarat_ketentuan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-syarat_ketentuan').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-syarat_ketentuan", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataSyaratKetentuan", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Syarat_ketentuan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSyarat_ketentuan();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-syarat_ketentuan', function(e){
		var formData = new FormData($(this)[0]);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Syarat_ketentuan/prosesUpdate'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSyarat_ketentuan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-syarat_ketentuan").reset();
				$('#update-syarat_ketentuan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#form-tambah-syarat_ketentuan').submit(function(e) {
		var textContent = tinymce.get('sk_deskripsi').getContent();
		$('#sk_deskripsi').html(textContent);

		var formData = new FormData($(this)[0]);
		formData.set("DESKRIPSI", textContent);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Syarat_ketentuan/prosesTambah'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilSyarat_ketentuan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-syarat_ketentuan").reset();
				$('#tambah-syarat_ketentuan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	// $(document).on('hidden.bs.modal', '#update-syarat_ketentuan', function() {
	// 	// tinyMCE.remove('#sk_deskripsi');
	// })

	$('#tambah-syarat_ketentuan').on('show.bs.modal', function () {
	  init_master_tinymce('#sk_deskripsi');
	})
	$('#tambah-syarat_ketentuan').on('hidden.bs.modal', function () {
	  tinyMCE.remove('#sk_deskripsi');
	})
</script>