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
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
	    $(document).ready(function() {
	      var table = $("#list-data").DataTable();

	      if (!table.data().any()) {
	        $("#button-periksa").html('<button class="btn-sm btn-success" title="Tidak ada data akta">Berikutnya <i class="fa fa-chevron-right"></i></button>');
	        $("#button-periksa").bind('click', false);
	      } else {
	        $("#button-periksa").html('<button type="submit" class="btn-sm btn-success">Berikutnya <i class="fa fa-chevron-right"></i></button>');
	        $("#button-periksa").unbind('click', false);      
	      }
	    });
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
</script>