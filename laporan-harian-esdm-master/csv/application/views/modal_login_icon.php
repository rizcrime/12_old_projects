<!-- Modal Login-->
<div id="form-login-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Login</h4>
    </div>
    <div class="modal-body">
      <div class="msg" style="display:none;">
        <?php echo @$this->session->flashdata('msg'); ?>
      </div>
      <div class="alert alert-info">
        <div class="row">
          <div class="col-md-1">
            <i class="glyphicon glyphicon-info-sign" style="font-size: 35px;"></i>
          </div>
          <div class="col-md-11">
            Untuk dapat mengakses layanan perizinan silahkan login terlebih dahulu atau jika Anda belum memiliki akun silahkan daftar.
          </div>
        </div>
      </div>

      <form  id="form-login-icon2" method="POST">
      <?=get_csrf_token()?>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="EMAIL_PERUSAHAAN" placeholder="Email untuk login."  required oninvalid="this.setCustomValidity('Mohon masukkan email yang sesuai')" oninput="setCustomValidity('')">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="PASSWORD" placeholder="Password untuk login minimal 8 karakter." style="padding: required oninvalid="this.setCustomValidity('Mohon masukkan password yang tepat')" oninput="setCustomValidity('')">
        </div>
        <div class="form-group">
          <label>Captcha</label>
          <?php echo $captcha // tampilkan recaptcha ?>
          <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12" style="z-index: 1">
              <div class="col-md-6">
                <button type="submit"  class="btn btn-primary btn-block" style="border-radius: 5px; padding: 5px;">Sign In</button>
              </div>
              <div class="col-md-6" style="border-left: solid grey 1px">
                Tidak punya akun? <a id="#btn-register" data-toggle="modal" data-target="#form-register" data-dismiss="modal" href="" style="color:blue;">Daftar disini.</a><br><a data-toggle="modal" data-target="#form-lupa" data-dismiss="modal" href="" style="color:blue;">Lupa password ?</a>
              </div>
            </div>
          </div>  
        </div>
        <div class="form-group">

        </div>
      </form>
    </div>
  </div>
</div>
</div>