<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data CMS Pemenang</h3>

  <form id="form-update-cms_pemenang" method="POST">
  <?=get_csrf_token()?>
    <input type="hidden" name="id" value="<?php echo $dataCms_pemenang->id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      </span>
      <input type="text" class="form-control" placeholder="Nama Cms_pemenang" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataCms_pemenang->nama; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>