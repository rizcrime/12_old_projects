<script src="<?php echo base_url().'assets/js/dataTables.rowsGroup.js'?>"></script>
<script type="text/javascript">

	var listPermohonan = null;
	var MyTableReportIzinPerIzin = $('#list-report-izin-jumlah').dataTable({});
	var MyTableReportIzinPerPermohonan  = $('#list-report-permohonan').dataTable({
			data:listPermohonan,
			columns: [
				{
					data: "no",
					title: '#',
				},
				{
					data: "data_permohonan",
					title: 'Permohonan',
				},
				{
					data: "nama_izin",
					title: 'Jenis Izin',
				},
				{
					data: "proses_step",
					title: 'Proses',
				},
				{
					data: "penanggung_jawab",
					title: 'Nama Penanggung Jawab',
				},
				{
					data: "mulai_proses",
					title: 'Mulai Proses',
				},
				{
					data: "selesai_proses",
					title: 'Selesai Proses',
				},
				{
					data: "waktu_kerja",
					title: 'Waktu Kerja',
				},
				{
					data: "status",
					title: 'Status',
				},
				{
					data: "sop",
					title: 'SOP',
				},
			],
			rowsGroup: [0, 1, 2]
		});

	window.onload = function() {
		// TampilBarChart();
		// TampilBarChartIzinMasuk();

		TampilReportIzinPerPermohonan();
		TampilJudulReportIzinPerPermohonan();

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
	

	function refreshReportIzinPerPermohonan() {
		// MyTableReportIzinPerPermohonan  = $('#list-report-permohonan').dataTable();
		let table_permohonan = $('#list-report-permohonan').DataTable();
		table_permohonan.clear();
		table_permohonan.rows.add(listPermohonan);
		table_permohonan.draw();
	}

	function refreshReportIzinPerIzin() {
		MyTableReportIzinPerIzin = $('#list-report-izin-jumlah').dataTable();
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

	function TampilReportIzinPerPermohonan() {
        var bulan = $("#BULAN").val();
		var tahun = $("#TAHUN").val();
		
		$.get('<?php echo base_url('Summary_izin/TampilReportIzinPerPermohonan/'); ?>'+bulan+'/'+tahun, function(data) {
			// MyTableReportIzinPerPermohonan.fnDestroy();
			listPermohonan = JSON.parse(data);
			console.log(listPermohonan);
			refreshReportIzinPerPermohonan();
		});
	}

	function TampilReportIzinPerIzin() {
        var bulan = $("#BULAN").val();
        var tahun = $("#TAHUN").val();
		$.get('<?php echo base_url('Summary_izin/TampilReportIzinPerIzin/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableReportIzinPerIzin.fnDestroy();
			$('#data-report-izin-per-izin').html(data);
			refreshReportIzinPerIzin();
		});
	}

	function TampilReportIzinPerRole() {
        var bulan = $("#BULAN").val();
        var tahun = $("#TAHUN").val();
		$.get('<?php echo base_url('Summary_izin/TampilReportIzinPerRole/'); ?>'+bulan+'/'+tahun, function(data) {
			MyTableReportIzinPerRole.fnDestroy();
			$('#data-report-izin-per-role').html(data);
			refreshReportIzinPerRole();
		});
	}

	function TampilBarChart() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Summary_izin/bar_chart/'); ?>'+bulan+'/'+tahun, function(data) {
			$('.bar').html(data);
			refreshBarChart();
		});
	}

	function TampilBarChartIzinMasuk() {
        var bulan = $("#BULAN").val()
        var tahun = $("#TAHUN").val()
		$.get('<?php echo base_url('Summary_izin/bar_chart_izin_masuk/'); ?>'+bulan+'/'+tahun, function(data) {
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

	function TampilJudulReportIzinPerPermohonan() {
        var bulan = $("#BULAN").val();
        var month = namaBulan(bulan);
        var tahun = $("#TAHUN").val();
		var html = '';

	    html += '<h4 style="font-family: serif">'+
	    			'<div class="center">'+
	    				'Rekap Permohonan Disetujui<br>'+
	    				'<small>Pada bulan '+ month +' tahun '+ tahun +
	    			'</div>'+
	    		'</h4>';
		$('#judulReportPerPermohonan').html(html);
	}

	function TampilJudulReportIzinPerIzin() {
        var bulan = $("#BULAN").val();
        var month = namaBulan(bulan);
        var tahun = $("#TAHUN").val();
		var html = '';

	    html += '<h4 style="font-family: serif">'+
	    			'<div class="center">'+
	    				'Rekap Perizinan<br>'+
	    				'<small>Pada bulan '+ month +' tahun '+ tahun +
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
			url: "<?php echo base_url('Summary_izin/permohonan_detail_per_perusahaan'); ?>",
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
			url: "<?php echo base_url('Summary_izin/permohonan_detail_per_izin'); ?>",
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
			url: "<?php echo base_url('Summary_izin/permohonan_detail_per_role'); ?>",
			data: "id=" + id + "&tgl=" + tgl
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#permohonan-detail-per-role').modal('show');
			$('#list-report-izin-per-role-detail').dataTable();
		})
	})

    $("#pilihPermohonan").click(function() {
		// TampilBarChart();
		// TampilBarChartIzinMasuk();

		TampilReportIzinPerPermohonan();
		TampilJudulReportIzinPerPermohonan();

		TampilReportIzinPerIzin();
		TampilJudulReportIzinPerIzin();

		// TampilReportIzinPerRole();
		// TampilJudulReportIzinPerRole();

        // refreshBarChart();
        // refreshBarChartIzinMasuk();

        refreshReportIzinPerPermohonan();

        refreshReportIzinPerIzin();
    });
    
</script>