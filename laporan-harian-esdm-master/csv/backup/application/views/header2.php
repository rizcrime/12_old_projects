<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Lelang WK Migas ESDM</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/bolt/assets/css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/bolt/assets/css/main.css" rel="stylesheet">
  <link href="assets/bolt/assets/css/font-awesome.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="assets/js/chart.js"></script>

  <?php echo $script_captcha; // javascript recaptcha ?>

  <?php 

  // function tgl_indo($tanggal){
  //   $bulan = array (
  //     1 =>   'January',
  //     'February',
  //     'March',
  //     'April',
  //     'May',
  //     'Juny',
  //     'July',
  //     'August',
  //     'September',
  //     'October',
  //     'November',
  //     'December'
  //   );

  //   $pecahkan = explode('-', $tanggal);
  //   return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  // }
  ?>
</head>

<body>

  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid #555 5px">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img class="img-responsive" src="assets/bolt/assets/img/header.png" style="max-height: 80px;"></i></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
          <li class="active"><a href="#contact" data-toggle="modal" data-target="#myModal">Login</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <!-- Modal Login-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Login</h4>
        </div>
        <div class="modal-body">
          <?php if($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
            </div>
          <?php endif; ?>
          <form  action="<?php echo base_url('AuthBidder/login'); ?>" method="post">
          <?=get_csrf_token()?>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="EMAIL_PERUSAHAAN" placeholder="Email untuk login."  style="padding: 14px 20px!important;" required oninvalid="this.setCustomValidity('Mohon masukkan email yang sesuai')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="PASSWORD" placeholder="Password untuk login minimal 8 karakter." style="padding: 14px 20px!important;" required oninvalid="this.setCustomValidity('Mohon masukkan password yang tepat')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group">
              <label>Captcha</label>
              <?php echo $captcha // tampilkan recaptcha ?>
              <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" >Sign In</button>
            </div>
            <div class="form-group">
              <p>Tidak punya akun? <a href="<?php echo base_url('Registrasi'); ?>" style="color:blue;">Daftar disini.</a><br><a href="<?php echo base_url('LupaPass'); ?>" style="color:blue;">Lupa password ?</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>




