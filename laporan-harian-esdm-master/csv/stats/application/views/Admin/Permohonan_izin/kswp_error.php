<div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
    <div class="box-body">
        <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-file" style="color: #fff000"></i> <strong>KSWP</strong></h4>
          </div>
          <div class="col-md-12">
              <h3 class="text-center"><?=$error_messages?></h3>
              <h4 class="text-center">Anda tidak dapat melanjutkan permohonan izin</h4>
          </div>
          <div class="col-md-12">
            <a href='<?=base_url("Permohonan_izin")?>'><button class="btn btn-primary pull-right" style="margin-right: 5px">Kembali</button></a>
          </div>
        </div>
    </div>
<div id="tempat-modal"></div>