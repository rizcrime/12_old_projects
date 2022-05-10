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

function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'January',
    'February',
    'March',
    'April',
    'May',
    'Juny',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  );

  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
</head>

<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid #fff000 5px">
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
        <form  action="<?php echo base_url('AuthBidder/login'); ?>" method="post">
          <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" style="padding: 14px 20px!important;">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="PASSWORD" style="padding: 14px 20px!important;">
        </div>
        <div class="form-group">
          <label>Captcha</label>
          <?php echo $captcha // tampilkan recaptcha ?>
        </div>
        <div class="form-group">
          <button type="submit" >Login</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
        <div class="form-group">
          <input type="checkbox" name="remember"> Remember me
          | <a href="<?php echo base_url('Beranda'); ?>" style="color:blue;">Forgot password?</a>
          <p>Belum punya akun ? <a href="<?php echo base_url('Registrasi'); ?>" style="color:blue;">Daftar disini.</a></p>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</div>



