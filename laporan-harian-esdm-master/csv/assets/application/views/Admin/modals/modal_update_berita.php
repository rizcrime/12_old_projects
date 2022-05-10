<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data CMS Pengumuman</h3>

  <form id="form-update-cms_pengumuman" method="POST">
  <?=get_csrf_token()?>
    <input type="hidden" name="id" value="<?php echo $dataCms_pengumuman->id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      </span>
      <input type="text" class="form-control" name="judul" aria-describedby="sizing-addon2" value="<?php echo $dataCms_pengumuman->judul; ?>">
      <input type="text" class="form-control" name="keterangan" aria-describedby="sizing-addon2" value="<?php echo $dataCms_pengumuman->keterangan; ?>">
      <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($dataCms_pengumuman->durasi_keterangan_start)); ?>" name="durasi_keterangan_start" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($dataCms_pengumuman->durasi_keterangan_end)); ?>" name="durasi_keterangan_end" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" name="proposal" aria-describedby="sizing-addon2" value="<?php echo $dataCms_pengumuman->proposal; ?>">
      <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($dataCms_pengumuman->durasi_proposal_start)); ?>" name="durasi_proposal_start" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($dataCms_pengumuman->durasi_proposal_end)); ?>" name="durasi_proposal_end" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>