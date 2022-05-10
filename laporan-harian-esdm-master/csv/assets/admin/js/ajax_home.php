<script type="text/javascript">
	var MyTableSetuju = $('#list-setuju').dataTable({});
	var MyTableTolak = $('#list-tolak').dataTable({});

	window.onload = function() {
		TampilSetuju();
		TampilTolak();
		TampilPieChart();
		TampilBarChart();
		TampilJudulSetuju();
		TampiliJudulTolak();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refreshSetuju() {
		MyTableSetuju = $('#list-setuju').dataTable();
	}

	function refreshTolak() {
		MyTableTolak = $('#list-tolak').dataTable();
	}

	function refreshPieChart() {
		piePermohonan = $('.pie').highcharts();
	}

	function refreshBarChart() {
		barPermohonan = $('.bar').highcharts();
	}

	function effect_msg_form() {
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}
	
	function TampilSetuju() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Home/TampilSetuju/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableSetuju.fnDestroy();
			$('#data-setuju').html(data);
			refreshSetuju();
		});
	}

	function TampilTolak() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Home/TampilTolak/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableTolak.fnDestroy();
			$('#data-tolak').html(data);
			refreshTolak();
		});
	}

	function TampilPieChart() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Home/pie_chart/'); ?>'+bulan+'/'+tahun, function(data) {
			$('.pie').html(data);
			refreshPieChart();
		});
	}

	function TampilBarChart() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Home/bar_chart/'); ?>'+bulan+'/'+tahun, function(data) {
			$('.bar').html(data);
			refreshBarChart();
		});
	}

	function TampilJudulSetuju() {
        var bulan = $("#BULAN").val()
        var month = '';
        if (bulan == 1) { month = 'Januari';
        } else if (bulan == 2) { month = 'Februari';
        } else if (bulan == 3) { month = 'Maret';
        } else if (bulan == 4) { month = 'April';
        } else if (bulan == 5) { month = 'Mei';
        } else if (bulan == 6) { month = 'Juni';
        } else if (bulan == 7) { month = 'Juli';
        } else if (bulan == 8) { month = 'Agustus';
        } else if (bulan == 9) { month = 'September';
        } else if (bulan == 10) { month = 'Oktober';
        } else if (bulan == 11) { month = 'November';
        } else if (bulan == 12) { month = 'Desember';
        }
        var tahun = $("#TAHUN").val()
		var html = '';
	    // html += '<h4 style="font-family: serif"><div class="center">Daftar permohonan yang disetujui pada bulan '+month+' '+tahun+'</div></h4>';
	    html += `<h4 style="font-family: serif"><div class="center">Daftar permohonan bulan ${month} tahun ${tahun} yang disetujui</div></h4>`;
		$('#judulSetuju').html(html);
	}

	function TampiliJudulTolak() {
        var bulan = $("#BULAN").val()
        var month = '';
        if (bulan == 1) { month = 'Januari';
        } else if (bulan == 2) { month = 'Februari';
        } else if (bulan == 3) { month = 'Maret';
        } else if (bulan == 4) { month = 'April';
        } else if (bulan == 5) { month = 'Mei';
        } else if (bulan == 6) { month = 'Juni';
        } else if (bulan == 7) { month = 'Juli';
        } else if (bulan == 8) { month = 'Agustus';
        } else if (bulan == 9) { month = 'September';
        } else if (bulan == 10) { month = 'Oktober';
        } else if (bulan == 11) { month = 'November';
        } else if (bulan == 12) { month = 'Desember';
        }
        var tahun = $("#TAHUN").val()
		var html = '';
		// html += '<h4 style="font-family: serif"><div class="center">Daftar permohonan yang ditolak pada bulan '+month+' '+tahun+'</div></h4>';
		html += `<h4 style="font-family: serif"><div class="center">Daftar permohonan bulan ${month} tahun ${tahun} yang ditolak</div></h4>`;
		$('#judulTolak').html(html);
	}

	$(document).on("click", ".detail-permohonan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Home/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#detail-permohonan').modal('show');
		})
	})

    $("#pilihPermohonan").click(function() {
        TampilSetuju();
		TampilTolak();
		TampilPieChart();
		TampilBarChart();
		TampilJudulSetuju();
		TampiliJudulTolak();

        refreshSetuju();
        refreshTolak();
        refreshPieChart();
        refreshBarChart();
    });
</script>