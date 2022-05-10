<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ganti Password</title>
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
      <?php if($this->session->flashdata('msg-error')): ?>
            <div class="alert alert-danger alert-dismissible" style="margin-top: 20px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('msg-error'); ?></strong></p>
            </div>
      <?php elseif($this->session->flashdata('msg-success')): ?>
            <div class="alert alert-success alert-dismissible" style="margin-top: 20px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('msg-success'); ?></strong></p>
            </div>
      <?php endif; ?>
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>assets/index2.html"><b></b></a>
      </div>

      <!-- /.login-logo -->
      <?php if($expired) { ?>
        <div class="login-box-body">
          <p class="login-box-msg">
            Ubah Password
          </p>
          <form action="<?php echo base_url('Lupa/prosesUbahPassAdmin'); ?>" method="post">
          <?=get_csrf_token()?>
            <input type="hidden" name="token" value="<?= $token ?>">
            <div class="form-group has-feedback">
              <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required oninvalid="this.setCustomValidity('8 karakter kombinasi huruf besar, kecil dan angka')" oninput="setCustomValidity('')" class="form-control" placeholder="8 karakter kombinasi huruf besar, kecil dan angka" name="PASSWORD">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required oninvalid="this.setCustomValidity('8 karakter kombinasi huruf besar, kecil dan angka')" oninput="setCustomValidity('')" class="form-control" placeholder="Ketik ulang password" name="PASSWORD_ULANG">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <p>Mohon masukkan password 8 karakter kombinasi huruf besar, kecil dan angka.</p>
            </div>
            <div class="row">

              <div class="col-xs-offset-8 col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
              </div>
            </div>
          </form>
        </div>
      <?php } else { ?>
        <center><a href="<?php echo base_url('AuthAdmin'); ?>">Kembali ke Login</a></center>
      <?php } ?>
      <!-- /.login-box-body -->
      <?php
        echo show_err_msg($this->session->flashdata('error_msg'));
      ?>
    </div>
    

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
  </body>
</html>
