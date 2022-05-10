<!DOCTYPE html>
<html>
<head>
	<?php if(isset($this->userdata->ID_ROLE)) { ?>
		<title>Admin | Dashboard</title>
	<?php } else { ?>
		<title>Investor | Dashboard</title>
	<?php } ?>
	<!-- meta -->
	<?php echo @$_meta; ?>

	<!-- css --> 
	<?php echo @$_css; ?>

	<!-- jQuery 2.2.3 -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>


	<!--[if !IE]> -->
	<!-- <![endif]-->

	<!--[if !IE]> -->
	<script type="text/javascript">
		window.jQuery || document.write("<script src='https://code.jquery.com/jquery-2.2.4.min.js'>"+"<"+"/script>");
	</script>
	<!-- <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- header -->
		<?php echo @$_header; ?> <!-- nav -->

		<!-- sidebar -->
		<?php
			/*if(isset($this->userdata->ID_ROLE)) {
				if($this->userdata->ID_ROLE == 'ADM') {
					echo @$_sidebar_super_admin;
				} elseif($this->userdata->ID_ROLE == 'ADVE') {
					echo @$_sidebar_admin_approval;
				} else {
					echo @$_sidebar_eval_eselon;
				}
			} else {
				echo @$_sidebar_investor;          
			}*/
			echo @$_sidebar_super_admin;
		?>

		<!-- content -->
		<?php echo @$_content; ?> <!-- headerContent --><!-- mainContent -->

		<!-- footer -->
		<?php echo @$_footer; ?>

		<div class="control-sidebar-bg"></div>
	</div>

	<!-- js -->
	<?php echo @$_js; ?>
</body>
</html>