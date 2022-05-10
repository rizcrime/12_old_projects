<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eksternal/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/eksternal/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>assets/index2.html"><b>Admin</b></a>
      </div>
	
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
          Log in to start your session
        </p>
		
        <form action="<?php echo base_url('AuthAdmin/login'); ?>" method="post">
        <?=get_csrf_token()?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
            <div class="form-group">
              <div style="text-align: -webkit-center;">
              <?php echo $captcha; echo $script_captcha; ?>                
              <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
              </div>
            </div>
          <div class="row">
            <!-- <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div> -->
            <div class="col-md-12" style="z-index: 1">
              <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <div class="col-md-6" style="border-left: solid grey 1px">
                    <a data-toggle="modal" data-target="#form-lupa-admin" data-dismiss="modal" href="" style="color:blue;">Lupa password ?</a>
              </div>
            </div>
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

      </div>
      <!-- /.login-box-body -->
      <?php
        echo show_err_msg($this->session->flashdata('error_msg'));
      ?>
    </div>
    <?php echo $modal_lupa_admin; ?>

    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> -->
    <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> -->
    <script src="<?php echo base_url('assets/frontend/'); ?>js/compressed.js"></script>
	<script src="<?php echo base_url('assets/frontend/'); ?>js/main.js"></script>
	<?php if(isset($script_js)) echo $script_js; ?>
  </body>
</html>

<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/blockUI.js"></script>
<script type="text/javascript">
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
