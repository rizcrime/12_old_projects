	<script type="text/javascript">
		var barPermohonanIzinMasuk = $('.bar-izin-masuk').highcharts({
			chart: {
	            type: 'column'
	        },
	        title: {
	            text: <?php echo $title; ?>
	        },
	        subtitle: {
			  text: <?php echo $subtitle; ?>
			},
	        xAxis: {
	            categories: <?php echo $array_kategori; ?>
	        },
	        yAxis: {
				title: {
					text: <?php echo $yTitle ?>
				}
	        },
	        series: <?php echo $array_series; ?>
		});
	</script>