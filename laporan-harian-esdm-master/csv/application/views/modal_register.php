<!-- Modal register -->
<div id="form-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Daftar</h4>
    </div>
    <div class="modal-body">
      <div class="msg" style="display:none;">
        <?php echo @$this->session->flashdata('msg'); ?>
      </div>
      <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
        </div>
      <?php endif; ?>
      <form id="formDaftar" method="POST">
      <?=get_csrf_token()?>
        <input type="hidden" class="form-control" name="TGL_DAFTAR" value="<?php echo date('Y-m-d h:i:s');?>">
        <div class="form-group">
          <label for="nama">Nama Perusahaan:</label>
          <input required pattern=".{3,}" oninvalid="this.setCustomValidity('Nama perusahaan harus minimal 3 karakter')" oninput="setCustomValidity('')" type="nama" class="form-control" name="NAMA_PERUSAHAAN" placeholder="Masukkan nama perusahaan anda minimal 3 karakter.">
        </div>
        <div class="form-group">
          <label for="npwp">Email:</label>
          <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required oninvalid="this.setCustomValidity('Mohon masukkan email yang sesuai')" oninput="setCustomValidity('')" type="email" class="form-control" name="EMAIL_PERUSAHAAN" placeholder="Masukkan email yang valid untuk digunakan sebagai data akun anda">
        </div>
        <div class="form-group">
          <label>Kode Verifikasi</label>
          <?php echo $captcha // tampilkan recaptcha ?>
          <span>Masukkan kode verifikasi sesuai pada gambar diatas</span>
        </div>
        <div class="form-group">
          <input type="checkbox" required name="remember" id="draft" value="d"> Anda menyetujui <a data-toggle="modal" data-target="#form-sk"  href="" style="color:blue;"> ketentuan </a>yang berlaku
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                <button id="#submitDaftar" name="submitDaftar" disabled type="submit" class="btn btn-primary btn-block" style="border-radius: 5px; padding: 5px;">Sign Up</button>
              </div>
              <div class="col-md-6" style="border-left: solid 1px grey">
                Sudah punya akun? <a  data-toggle="modal" data-target="#form-login" data-dismiss="modal" href="" style="color:blue;">  Login disini! </a>
              </div>
            </div>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
 var checker = document.getElementById('draft');
 var sendbtn = document.getElementById('#submitDaftar');
 // when unchecked or checked, run the function
 checker.onchange = function(){
  if(this.checked){
    sendbtn.disabled = false;
  } else {
    sendbtn.disabled = true;
  }

}
</script>
