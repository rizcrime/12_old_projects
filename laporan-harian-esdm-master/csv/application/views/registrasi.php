
<div class="container">
  <div class="row centered mt grid">
    <div class="mt"></div>   
    <div class="col-lg-8 col-lg-offset-2">
      <div class="col-lg-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="text-center">Daftar</h1>
          </div>
          <div class="panel-body">
            <center>
             <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
              Daftar
            </button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <input type="checkbox" name="remember"> Anda menyetujui <a href="<?php echo base_url('Syarat'); ?>" style="color:blue;"> ketentuan </a>yang berlaku
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <div class="form-group">
            <p>Sudah punya akun? <a href="<?php echo base_url('Beranda'); ?>" style="color:blue;">  Login disini! </a></p>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(window).on('load',function(){
    $('#myModal1').modal('show');
  });
</script>

</body>
</html>