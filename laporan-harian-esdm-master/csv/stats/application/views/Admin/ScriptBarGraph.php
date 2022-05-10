	<script type="text/javascript">
		var barPermohonan = $('.bar').highcharts({
			chart: {
				style: {
					fontFamily: 'serif'
				},
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 15,
					beta: 15,
					depth: 50,
					viewDistance: 25
				}
			},
			plotOptions: {
				column: {
					depth: 25
				}
			},
			title: {
			  text: <?php echo $title; ?>
			},
			subtitle: {
			  text: <?php echo $subtitle; ?>
			},
			xAxis: {
			  categories: <?php echo $array_kategori; ?>,
			  crosshair: false
			},
			yAxis: {
			  min: 0,
			  title: {
				text: <?php echo $yTitle ?>
			  }
			},
			tooltip: {
				headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
				pointFormat: 	'<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
								'<td style=\"padding:0\"><b>{point.y:.1f} </b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			series: <?php echo $array_series; ?>
		});
	</script>