<?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
            </div>
<?php endif; ?>
<div class="" style="min-height: 100vh; margin-top: -70px;">
  <div style="background-image: url('assets/bolt/assets/img/bg6.jpg');background-repeat: no-repeat; background-size: 100% auto; background-position: bottom;">
      <div class="container" style="min-height: 100vh; padding-top: 120px;">
        <div class="row centered mt grid">
          <div class="mt"></div>
          <div class="col-xs-0 col-sm-0 col-md-0 col-lg-1"></div>
          <div class="col-sm-3 col-md-3 col-lg-2 asd">
            <a id="#btn-login2" href="" data-toggle="modal" data-target="#form-login-icon"><img style="opacity: 1" src="assets/bolt/assets/img/planet-earth.png" alt=""></a><br>
            Pelayanan Perizinan
          </div>
          <div class="col-sm-3 col-md-3 col-lg-2 asd">
            <a href="<?=base_url('CekProduk/search')?>"><img style="opacity: 1" src="assets/bolt/assets/img/test.png" alt=""></a><br>
            Cek Produk
          </div>
          <div class="col-sm-3 col-md-3 col-lg-2 asd">
            <a href="<?=base_url('TrackPermohonan/search')?>"><img style="opacity: 1" src="assets/bolt/assets/img/search.png" alt=""></a><br>
            Monitoring Berkas
          </div>
          <div class="col-sm-3 col-md-3 col-lg-2 asd">
            <a href="<?php echo base_url()?>Panduan"><img style="opacity: 1" src="assets/bolt/assets/img/panduan.png" alt=""></a><br>
            Bantuan
          </div>
          <div class="col-xs-0 col-sm-0 col-md-0 col-lg-2"></div>
          
        </div>

        <!-- <div class="row mt centered">
          <div class="col-lg-7 col-lg-offset-1 mt">
            
         </div> -->
      </div>
    </div>
  </div>
</div>
  

<?php echo $modal_alert; ?>

  <style type="text/css">

    div.asd{
      background-color: rgba(52, 120, 146, 0.5);
      border:solid 5px #ffffffb8;
      padding: 15px 10px 10px 10px;
      border-radius: 10px;
      margin: 0 18px;
      margin-bottom: 20px;
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