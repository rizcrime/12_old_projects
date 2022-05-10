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
      <div class="col-md-2 pull-right" style="margin-top: 15px">
        <div class="col-md-5 home"><a href="<?php echo base_url();?>">Home</a></div>
        <div class="col-md-5 login"><a href="#contact" data-toggle="modal" data-target="#modalLogin">Login</a></div>
      </div>
    </div><!--/.nav-collapse -->
  </div>
</div>

<!-- Modal Login-->
  <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
              <p>Tidak punya akun? <a id="#btn-register" data-toggle="modal" data-target="#modalRegister" data-dismiss="modal" href="" style="color:blue;">Daftar disini.</a><br><a id="#btn-login" data-toggle="modal" data-target="#modalLupa" data-dismiss="modal" href="" style="color:blue;">Lupa password ?</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- //lupa password -->
  <div class="modal fade" id="modalLupa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
        </div>
        <div class="modal-body">
          <?php if($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
            </div>
          <?php endif; ?>
          <form  action="<?php echo base_url('LupaPass/lupa'); ?>" method="post">
          <?=get_csrf_token()?>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="EMAIL_PERUSAHAAN" placeholder="Email untuk login."  style="padding: 14px 20px!important;" required oninvalid="this.setCustomValidity('Mohon masukkan email yang sesuai')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group">
              <label>Captcha</label>
              <?php echo $captcha // tampilkan recaptcha ?>
              <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" >Reset Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal register -->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Daftar</h4>
      </div>
      <div class="modal-body">
        <?php if($this->session->flashdata('msg')): ?>
          <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p><strong><?php echo $this->session->flashdata('msg'); ?></strong></p>
          </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('msg1')): ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p><strong><?php echo $this->session->flashdata('msg'); ?></strong></p>
          </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error_msg')): ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
          </div>
        <?php endif; ?>
        <form method="POST"  enctype="multipart/form-data" action="<?php echo base_url('Registrasi/register'); ?>">
       <?=get_csrf_token()?>
          <input type="hidden" class="form-control" name="TGL_DAFTAR" value="<?php echo date('Y-m-d h:i:sa');?>">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="nama" class="form-control" name="NAMA_PERUSAHAAN" placeholder="Masukkan nama lengkap anda minimal 3 karakter.">
          </div>
          <div class="form-group">
            <label for="npwp">Email:</label>
            <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" placeholder="Masukkan email yang valid untuk digunakan sebagai data akun anda">
          </div>
          <div class="form-group">
            <label>Kode Verifikasi</label>
            <?php echo $captcha // tampilkan recaptcha ?>
            <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
          </div>
          <div class="form-group">
            <input type="checkbox" name="remember"> Anda menyetujui <a id="#btn" data-toggle="modal" data-target="#modalSK"  href="" style="color:blue;"> ketentuan </a>yang berlaku
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <div class="form-group">
            <p>Sudah punya akun? <a id="#btn" data-toggle="modal" data-target="#modalLogin" data-dismiss="modal" href="" style="color:blue;">  Login disini! </a></p>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>

<!-- //modal syarat dan ketentuan -->
  <div class="modal fade" id="modalSK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Syarat dan Ketentuan</h4>
        </div>
        <div class="modal-body">
          <p>Saya memahami dan menyetujui bahwa :<br>
                - akun badan usaha yang dibuat adalah akun representatif badan usaha dan dibuat oleh pegawai badan usaha tersebut.<br>
                - seluruh dokumen dan informasi yang diunggah ke sistem menjadi tanggung jawab badan usaha.<br>
                - akun baru yang tidak membuat pengajuan dalam waktu 7x24 jam akan dihapus.<br>
                - pihak esdm tidak bertanggung jawab atas penyalahgunaan aplikasi.<br>

                peraturan menteri esdm no 29 tahun 2017, pasal 51:<br>
                1. pengurusan terhadap pengajuan perizinan pada kegiatan usaha minyak dan gas bumi dilaksanakan langsung oleh direksi badan usaha atau bentuk usaha tetap tanpa perantara.<br>
              2. dalam hal pengurusan terhadap pengajuan perizinan sebagaimana dimaksud pada ayat (1) tidak dilakukan oleh direksi badan usaha atau bentuk usaha tetap proses penerbitan perizinan dapat dibatalkan.</p>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    // $(window).on('load',function(){
    //     $('#myModal').modal('show');
    // });
    $(window).load(function(){
        $('#modalLogin').modal('show');
    });

    $('#btn').click(function() {
      $('#modalLogin').modal('show');
    });

    $('#btn-login').click(function() {
      $('#modalLogin').modal('hide');
      $('#modalLupa').modal('show');

    });

    $('#btn-register').click(function() {
      $('#modalLogin').modal('hide');
      $('#modalRegister').modal('show');

    });

    $('#btn-sk').click(function() {
      $('#modalRegister').modal('hide');
      $('#modakSK').modal('show');

    });
  </script>


<style type="text/css">
  div.login,div.home{
    background-color: #54a506;
    margin: 5px;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
  }  
  div.login>a,div.home>a{
    color: #ffffff;
  }
  div.login:hover,div.home:hover{
    background-color: #5fbb06;
  }
</style>


