<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Data <?php echo $informasi->NAMA_INFORMASI; ?></h3>
  <form id="regForm" action="">
  <?=get_csrf_token()?>
    <div class="col-md-6">
      <div class="form-group">
        <label>KODE INFORMASI :</label>
        <input class="form-control" value="<?php echo $informasi->KODE_INFORMASI ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>NAMA INFORMASI :</label>
        <input class="form-control" value="<?php echo $informasi->NAMA_INFORMASI ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>FILE INFORMASI :</label>
        <input class="form-control" value="<?php echo $informasi->FILE_INFORMASI ?>" readonly>
      </div>
    </div>
  </form>
  <div class="col-md-12">
  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>  
</div>
</div>