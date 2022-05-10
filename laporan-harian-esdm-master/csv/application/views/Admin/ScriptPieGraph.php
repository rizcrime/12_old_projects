	<script type="text/javascript">
		var piePermohonan = $('.pie').highcharts({
			chart: {
				style: {
					fontFamily: 'serif'
				},
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie'
		    },
			tooltip: {
        		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
			title: {
				text: <?php echo $title; ?>
			},
			subtitle: {
				text: <?php echo $subtitle; ?>
			},
			plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            },
					colors: ["#f7a35c", "#434348", "#90ed7d"]
		        }
		    },
 	 		series: <?php echo $array_pie; ?>
		});
	</script>
