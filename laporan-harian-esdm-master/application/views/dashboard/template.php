<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <?php
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    ?>
    <title>Aplikasi Perizinan dan Non-perizinan EBTKE</title>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo config_item('asset_back'); ?>images/logo.png">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/main.css" id="color-switcher-link">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/fonts.css">
    <?php if(isset($script_css)) echo $script_css; ?>
	<script src="<?php echo base_url('assets/frontend/'); ?>js/vendor/modernizr-2.6.2.min.js"></script>

	<!--[if lt IE 9]>
		<script src="<?php echo base_url('assets/frontend/'); ?>js/vendor/html5shiv.min.js"></script>
		<script src="<?php echo base_url('assets/frontend/'); ?>js/vendor/respond.min.js"></script>
		<script src="<?php echo base_url('assets/frontend/'); ?>js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>
	<section class="cs black">
		<div class="container">
			<div class="row container-datetime">
				<div class="col-md-6">
					<p></p>
				</div>
				<div class="col-md-6">
					<a href="">
						<img title="Call Center 136" class="logo-call-center img-rounded" src="<?php echo base_url('assets/frontend/'); ?>img/logo-cs.png">
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas texture">
		<div id="box_wrapper">

			<!-- template sections -->

			<section class="page_toplogo ds table_section section_padding_25 columns_margin_0">
				<div class="container" style="padding-top: 0; padding-bottom: 0;">
					<div class="row">
						<div class="col-sm-6 text-center text-sm-left">
							<a href="<?=base_url()?>" class="logo">
								<img src="<?php echo base_url('assets/frontend/'); ?>images/xlogo-esdm-web.png" alt="" style="float:left">
							</a>
						</div>

						<div class="col-sm-8 text-right darklinks">
						<a id="#btn-login1" href="#" data-toggle="modal" data-target="#form-login" class="btn btn-login btn-primary dropdown-toggle get-started-btn mt-2 mb-2">LOGIN</a>
					</div>
				</div>
			</section>
			<hr>
			<div class="scroll-left">
				<p>Aplikasi Perizinan EBTKE tidak dipungut biaya dalam bentuk apapun.</p>
			</div>
			<!-- <div class="stamp-badges"><br>
				<p>
					<span class="secondLine">FREE</span> <br>
					<span class="firstLine">TIDAK</span> <br>
					<span class="thirdLine">DIPUNGUT</span> <br>
					<span class="secondLine">BIAYA</span> <br>
				</p>
			</div> -->
			<div class="bg-ebtke">
				<div class="container">
					<?php if(isset($content)) echo $content; ?>
				</div>
			</div>

			<?php echo $modal_login; ?>
			<?php echo $modal_login2; ?>
			<?php echo $modal_register; ?>
			<?php echo $modal_lupa; ?>
			<?php echo $modal_sk; ?>
			<?php if (isset($modal_pengumuman)) { echo $modal_pengumuman; }?>
			
			<section class="page_copyright ds ms parallax table_section section_padding_25" style="background-color: black !important;">
			<section class="cs black" style="height: 5px;">
			<div class="container">
				<p>&nbsp</p>
			</div>
			</section class="footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 black text-center">
							<div class="sosMed text-center add10MarginBottom">
								<a title="Facebook" class="black" target="_blank" href="https://www.facebook.com/kesdm/?ref=ts&amp;fref=ts"><i class="fa fa-facebook"></i></a>
								<a title="Twitter" class="black" target="_blank" href="https://twitter.com/kementerianesdm"><i class="fa fa-twitter"></i></a>
								<a title="Instagram" class="black" target="_blank" href="https://www.instagram.com/kesdm/"><i class="fa fa-instagram"></i></a>
								<a title="Youtube" class="black" target="_blank" href="https://www.youtube.com/channel/UC7Qv2sjGxCK27xWJ90_fUfw"><i class="fa fa-youtube-play"></i></a>
							</div>
							<p class="darklinks fontsize_12" style="line-height: 1.5em">
								<span class="text-uppercase" style="color: #fee50f"><b>HAK CIPTA © <?=date('Y')?> KEMENTERIAN ENERGI DAN SUMBER DAYA MINERAL</b></span><br>
								<span style="color: #ffffff">Jl. Pegangsaan Timur, No.1, Menteng Jakarta Pusat 10320 , Jakarta</span><br>
								<span style="color: #ffffff"><i class="fa fa-phone"></i> 021-39830077,  <i class="fa fa-print"></i> 021-31901087</span><br>
								<span style="color: #ffffff"><i class="fa fa-envelope"></i> ebtke@esdm.go.id</span>
							</p>
						</div>
					</div>
				</div>
			</section>

		</div>
		<!-- eof #box_wrapper -->
	</div>
	<!-- eof #canvas -->

	<script src="<?php echo base_url('assets/frontend/'); ?>js/compressed.js"></script>
	<script src="<?php echo base_url('assets/frontend/'); ?>js/main.js"></script>
	<?php if(isset($script_js)) echo $script_js; ?>
	
</body>

</html>