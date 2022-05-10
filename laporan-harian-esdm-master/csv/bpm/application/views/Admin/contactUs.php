<?php if($this->session->flashdata('msg')): ?>
  <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
  </div>
<?php endif; ?>
<div style="background-image: url('assets/bolt/assets/img/bg6.jpg');background-repeat: no-repeat; background-size: 100% auto; padding-top: 50px; height: 120%">
  <?php if($this->session->flashdata('msg')) { ?>
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p><strong><?php echo $this->session->flashdata('msg'); ?></strong></p>
    </div>
  <?php } elseif ($this->session->flashdata('')) { ?>
    <div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <p><strong><?php echo $this->session->flashdata(''); ?></strong></p>
    </div>
  <?php } ?>
  <div class="container" style="margin-top: 20px">
    <div class="row contact-wrap" style="color: white;"> 
      <div class="status alert alert-success" style="display: none"></div>
      <form method="POST" action="<?php echo base_url('ContactUs/kirim') ?>" style="padding-top: 1px">
      <?=get_csrf_token()?>
        <div class="row" style="margin-bottom: 20px">
          <div class="col-md-4 asd">
            <div class="col-md-12">
              <img src="assets/bolt/assets/img/contactus.png" style="width: 100%">
            </div>
          </div>
          <div class="col-md-7 asd">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="nama" placeholder="Nama..." class="form-control" required="required">
                </div>
              </div>              
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" name="email" placeholder="E-mail..." class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" name="subjek" placeholder="Subjek..." class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <textarea name="pesan" id="message" required="required" class="form-control" placeholder="Masukkan Pesan disini..."></textarea>
                </div>
              </div>     
              <div class="col-md-2">
                <div class="form-group" style="float:right; width: 100%">
                  <button type="submit" class="btn btn-success" style="border-radius: 5px; height: 40px; padding: 0px; width: 100%;">Kirim</button>
                </div>
              </div>                 
              <div class="col-md-2">  
                <a href="http://izinminerba.cits-indonesia.co.id/">
                  <div type="submit" class="btn btn-danger" style="border-radius: 5px; height: 40px;margin-left:-28;width: 100%;padding: 0">Cancel</div>
                </a>
              </div>
            </div>
          </div>
        </div>
          
      </form> 
    </div>
  </div>
</div>
<style type="text/css">
textarea{
  width: 100%;
  resize: vertical;
  min-height: 176px;
}

div.asd{
  background-color: rgba(52, 120, 146, 0.5);
  border:solid 5px #ffffffb8;
  padding: 15px 10px 10px 10px;
  border-radius: 10px;
  margin: 0 18px;
  font-weight: 400;
  color: white;
}
div.asd:hover{
  font-weight: 17px;
  color: black!important;
}

</style>