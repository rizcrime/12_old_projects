<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    
    <meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eksternal/font-awesome.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />
	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" />
	
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
	
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eksternal/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-layout" style="background: url(<?php echo base_url('assets/img/bg-1.jpg'); ?>); background-size: 100%; background-position: center;">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="space-6"></div>
							<div class="space-6"></div>
							<div class="space-6"></div>
							<div class="space-6"></div>
							<div class="center">
								<img src="<?php echo base_url("assets/img/Logo_ESDM.png"); ?>" width="100px" height="auto">
							</div>
							<div class="center">
								<h1>
									<span class="">Aplikasi Laporan Harian</span>
								</h1>
							</div>

							<div class="space-6"></div>
							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border" style="padding: 0">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger" style="text-align: center;">
												<i class="ace-icon fa fa-lock"></i>
												Login to Your Account
											</h4>

											<div class="space-6"></div>

											<form action="<?php echo base_url('AuthAdmin/login'); ?>" method="post">
											<?=get_csrf_token()?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username"  name="username" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="password" required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>
													<div class="form-group">
										              <div style="text-align: -webkit-center;">
										              <?php echo $captcha; echo $script_captcha; ?>                
										              <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
										              </div>
										            </div>

													<div class="clearfix">
														<button type="submit" class="btn btn-sm btn-primary btn-block">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-10"></div>
<!--
													<label class="block toolbar clearfix" style="background: transparent; border-top: none; text-align: center;">
															Forgot <a href=""  data-target="#forgot-box" class="forgot-password-link" style="color: blue">Password ?</a>
												
													</label>-->

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="space-6"></div>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border" style="padding: 0">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger" style="text-align: center;">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="space-10"></div>

													<div class="clearfix">
														<button type="button" class="btn btn-sm btn-danger btn-block">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>

													<div class="space-6"></div>

													<label class="block toolbar clearfix" style="background: transparent; border: none; text-align: center;">
														<a href="#" data-target="#login-box" class="back-to-login-link" style="text-shadow: none; color: blue; font-weight: 400">
															Back to login
														</a>
														<!-- &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
														<a href="#" data-target="#signup-box" class="user-signup-link">
															Register ? 
														</a>-->
													</label>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border" style="padding: 0">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger" style="text-align: center;">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>

													<div class="space-10"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="button" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>

													<div class="space-6"></div>

													<label class="block toolbar clearfix" style="background: transparent; border: none; text-align: center;">
														<a href="#" data-target="#login-box" class="back-to-login-link" style="text-shadow: none; color: blue; font-weight: 400">
															Back to login
														</a>
													</label>
												</fieldset>
											</form>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
</body>
</html>
<script src="<?php echo base_url('assets/frontend/'); ?>js/compressed.js"></script>
<script src="<?php echo base_url('assets/frontend/'); ?>js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/blockUI.js"></script>
<?php if(isset($script_js)) echo $script_js; ?>
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");

	jQuery(function($) {
	 $(document).on('click', '.toolbar a[data-target]', function(e) {
		e.preventDefault();
		var target = $(this).data('target');
		$('.widget-box.visible').removeClass('visible');//hide others
		$(target).addClass('visible');//show target
	 });
	});
	
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
  function effect_msg2() {
    // $('.msg').hide();
    $('.msg').show(1000);
    // setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
  }
  
  $('#formLupaAdmin').submit(function(e) {
    var formData = new FormData($(this)[0]);
    
    //$('#form-lupa-admin').modal('close');
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' }); 

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('LupaPass/lupaAdmin'); ?>',
      data: formData,
      processData: false,
      contentType: false
    })

    .done(function(data) {
      var out = jQuery.parseJSON(data);
      var sendbtn = document.getElementById('sumbitLupa');

      if (out.status == 'form') {
        $.unblockUI(); 
        $('#form-lupa-admin').modal('show');
        $('.form-msg').html(out.msg);
        effect_msg_form();
        grecaptcha.reset();
        

      } else if(out.status == 'sukses') {
      	$.unblockUI();
        document.getElementById("formLupaAdmin").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg2();
        
        sendbtn.disabled = true;
      } else {
        $.unblockUI(); 
        $('#form-lupa-admin').modal('show');
        document.getElementById("formLupaAdmin").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg();
      }
    })
    e.preventDefault();
  });
	
	
</script>
	
