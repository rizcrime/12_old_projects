        
      <div class="row mt centered">
        <div class="col-lg-7 col-lg-offset-1 mt">
          
       </div>
      </div>

<div style="background-image: url('assets/bolt/assets/img/bg6.jpg');background-repeat: no-repeat; background-size: 100% auto;">
    <div class="container">
      <div class="row centered mt grid"">
        <div class="mt"></div>
        <div class="col-lg-2 asd" style="margin: 0 18px 0 25px!important">
          <a href="#"><img style="opacity: 1" src="assets/bolt/assets/img/planet-earth.png" alt=""></a><br>
          Pelayanan Perizinan
        </div>
        <div class="col-lg-2 asd">
          <a href="#"><img style="opacity: 1" src="assets/bolt/assets/img/test.png" alt=""></a><br>
          Cek Sertifikat
        </div>
        <div class="col-lg-2 asd">
          <a href="#"><img style="opacity: 1" src="assets/bolt/assets/img/search.png" alt=""></a><br>
          Monitoring Berkas
        </div>
        <div class="col-lg-2 asd">
          <a href="#"><img style="opacity: 1" src="assets/bolt/assets/img/chat.png" alt=""></a><br>
          Contact Us
        </div>
        <div class="col-lg-2 asd">
          <a href="#"><img style="opacity: 1" src="assets/bolt/assets/img/support.png" alt=""></a><br>
          Bantuan
        </div>
        
      </div>
</div>
  
      <div class="row mt centered">
        <div class="col-lg-7 col-lg-offset-1 mt">
          
       </div>
      </div>
  </div>

  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal2').modal('show');
    });
</script>

  <style type="text/css">
    div.asd{
      background-color: rgba(52, 120, 146, 0.5);
      border:solid 1px #555;
      padding: 15px 10px 10px 10px;
      border-radius: 10px;
      margin: 0 18px;
      font-weight: 400;
      color: white;
    }
    div.asd:hover{
      background-color: #efe54a!important;
      font-weight: 17px;
      color: black!important;
    }

  </style>

  <script type="text/javascript">

  </script>