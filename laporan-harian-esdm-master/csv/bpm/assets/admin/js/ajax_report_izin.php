<script type="text/javascript">
	// var MyTableSetuju = $('#list-setuju').dataTable({});
	// var MyTableTolak = $('#list-tolak').dataTable({});
	var MyTableReportIzinPerPerusahaan = $('#list-report-izin-per-perusahaan').dataTable({});
	var MyTableReportIzinPerIzin = $('#list-report-izin-per-izin').dataTable({});
	// var MyTableReportIzinPerRole = $('#list-report-izin-per-role').dataTable({});

	window.onload = function() {
		TampilBarChart();
		TampilBarChartIzinMasuk();

		TampilReportIzinPerPerusahaan();
		TampilJudulReportIzinPerPerusahaan();

		TampilReportIzinPerIzin();
		TampilJudulReportIzinPerIzin();

		// TampilReportIzinPerRole();
		// TampilJudulReportIzinPerRole();

		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refreshReportIzinPerPerusahaan() {
		MyTableReportIzinPerPerusahaan = $('#list-report-izin-per-perusahaan').dataTable();
	}

	function refreshReportIzinPerIzin() {
		MyTableReportIzinPerIzin = $('#list-report-izin-per-izin').dataTable();
	}

	function refreshReportIzinPerRole() {
		MyTableReportIzinPerRole = $('#list-report-izin-per-role').dataTable();
	}

	function refreshBarChart() {
		barPermohonan = $('.bar').highcharts();
	}

	function refreshBarChartIzinMasuk() {
		barPermohonanIzinMasuk = $('.bar-izin-masuk').highcharts();
	}

	function effect_msg_form() {
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function TampilReportIzinPerPerusahaan() {
        var bulan = $("#BULAN").val();
        var tahun = $("#TAHUN").val();
		$.get('<?php echo base_url('Report_izin/TampilReportIzinPerPerusahaan/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableReportIzinPerPerusahaan.fnDestroy();
			$('#data-report-izin-per-perusahaan').html(data);
			refreshReportIzinPerPerusahaan();
		});
	}

	function TampilReportIzinPerIzin() {
        var bulan = $("#BULAN").val();
        var tahun = $("#TAHUN").val();
		$.get('<?php echo base_url('Report_izin/TampilReportIzinPerIzin/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableReportIzinPerIzin.fnDestroy();
			$('#data-report-izin-per-izin').html(data);
			refreshReportIzinPerIzin();
		});
	}

	function TampilReportIzinPerRole() {
        var bulan = $("#BULAN").val();
        var tahun = $("#TAHUN").val();
		$.get('<?php echo base_url('Report_izin/TampilReportIzinPerRole/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableReportIzinPerRole.fnDestroy();
			$('#data-report-izin-per-role').html(data);
			refreshReportIzinPerRole();
		});
	}

	function TampilBarChart() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Report_izin/bar_chart/'); ?>'+bulan+'/'+tahun, function(data) {
			$('.bar').html(data);
			refreshBarChart();
		});
	}

	function TampilBarChartIzinMasuk() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Report_izin/bar_chart_izin_masuk/'); ?>'+bulan+'/'+tahun, function(data) {
			$('.bar-izin-masuk').html(data);
			refreshBarChartIzinMasuk();
		});
	}

	function namaBulan(bulan) {
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

        return month;
	}

	function TampilJudulReportIzinPerPerusahaan() {
        var bulan = $("#BULAN").val();
        var month = namaBulan(bulan);
        var tahun = $("#TAHUN").val();
		var html = '';

	    html += '<h4 style="font-family: serif">'+
	    			'<div class="center">'+
	    				'Daftar Permohonan Dalam Proses per Perusahaan<br>'+
	    				'<small>Dari '+ month +' tahun '+ tahun +' sampai setahun ke belakang</small>'+
	    			'</div>'+
	    		'</h4>';
		$('#judulReportIzinPerPerusahaan').html(html);
	}

	function TampilJudulReportIzinPerIzin() {
        var bulan = $("#BULAN").val();
        var month = namaBulan(bulan);
        var tahun = $("#TAHUN").val();
		var html = '';

	    html += '<h4 style="font-family: serif">'+
	    			'<div class="center">'+
	    				'Daftar Permohonan Dalam Proses per Izin<br>'+
	    				'<small>Dari '+ month +' tahun '+ tahun +' sampai setahun ke belakang</small>'+
	    			'</div>'+
	    		'</h4>';
		$('#judulReportIzinPerIzin').html(html);
	}

	function TampilJudulReportIzinPerRole() {
        var bulan = $("#BULAN").val();
        var month = namaBulan(bulan);
        var tahun = $("#TAHUN").val();
		var html = '';

	    html += '<h4 style="font-family: serif">'+
	    			'<div class="center">'+
	    				'Daftar Permohonan Dalam Proses per Role<br>'+
	    				'<small>Dari '+ month +' tahun '+ tahun +' sampai setahun ke belakang</small>'+
	    			'</div>'+
	    		'</h4>';
		$('#judulReportIzinPerRole').html(html);
	}

	$(document).on("click", ".permohonan-detail-per-perusahaan", function() {
		var id	= $(this).attr("data-id");
		$('#permohonan-detail-per-izin').modal('hide');
		$('#permohonan-detail-per-role').modal('hide');

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Report_izin/permohonan_detail_per_perusahaan'); ?>",
			data: "id=" + id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#permohonan-detail-per-perusahaan').modal('show');
		})
	})

	$(document).on("click", ".permohonan-detail-per-izin", function() {
		var id	= $(this).attr("data-id");
		var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()

		let parameter = {
			"id":id,
			"end_m":bulan,
			"end_y":tahun,
		};

		$.ajax({
			method: "GET",
			url: "<?php echo base_url('Report_izin/permohonan_detail_per_izin'); ?>",
			// data: "id=" + id + "&end_m=" + 1 + "&end_y=" + 2019
			data: $.param(parameter)
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#permohonan-detail-per-izin').modal('show');
			$('#list-report-izin-per-izin-detail').dataTable();
		})
	})

	$(document).on("click", ".permohonan-detail-per-role", function() {
		var id	= $(this).attr("data-id");
		var tgl	= $(this).attr("data-tgl");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Report_izin/permohonan_detail_per_role'); ?>",
			data: "id=" + id + "&tgl=" + tgl
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#permohonan-detail-per-role').modal('show');
			$('#list-report-izin-per-role-detail').dataTable();
		})
	})

    $("#pilihPermohonan").click(function() {
		TampilBarChart();
		TampilBarChartIzinMasuk();

		TampilReportIzinPerPerusahaan();
		TampilJudulReportIzinPerPerusahaan();

		TampilReportIzinPerIzin();
		TampilJudulReportIzinPerIzin();

		// TampilReportIzinPerRole();
		// TampilJudulReportIzinPerRole();

        refreshBarChart();
        refreshBarChartIzinMasuk();

        refreshReportIzinPerPerusahaan();

        refreshReportIzinPerIzin();
    });
    
</script>