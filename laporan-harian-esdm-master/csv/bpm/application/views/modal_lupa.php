<!-- //lupa password -->
  <div id="form-lupa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
        </div>
        <div class="modal-body">
          <div class="msg" style="display:none;">
          <?php echo @$this->session->flashdata('msg'); ?>
          </div>
          <form  id="formLupa" method="post">
          <?=get_csrf_token()?>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="EMAIL_PERUSAHAAN" placeholder="Email untuk login."  style="padding: 14px 20px!important;" required oninvalid="this.setCustomValidity('Mohon masukkan email yang sesuai')" oninput="setCustomValidity('')">
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
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px; padding: 5px;">Reset Password</button>
                  </div>
                  <div class="col-md-6" style="border-left: solid grey 1px">
                    Sudah punya akun? <a id="#btn-register" data-toggle="modal" data-target="#form-login" data-dismiss="modal" href="" style="color:blue;">Login disini.</a>
                  </div>
                </div>
              </div>  
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>