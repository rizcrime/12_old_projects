<script type="text/javascript">
	var MyTable = $('#list-user').dataTable({
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
		tampilUserByIzin();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-user').dataTable();
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
	
	function tampilUserByIzin() {
		var idIzin = $("#idIzin").val()
		$.get('<?php echo base_url('List_user/tampil/'); ?>'+idIzin, function(data) {
			MyTable.fnDestroy();
			$('#list-data').html(data);
			refresh();
		});
	}

	$("#showUserByIzin").click(function() {
        tampilUserByIzin();
        
        refresh();
    });
</script>