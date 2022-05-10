<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Perizinan</h3>

  <form id="form-update-perizinan" method="POST">
  <?=get_csrf_token()?>
    <div class="form-group">
      <div class="col-md-12">
        <label>KATEGORI PERIZINAN</label>
        <select name="ID_KATEGORI_PERIZINAN" class="form-control">
          <?php foreach($dataKategori_perizinan as $kp): ?>
            <option value="<?php echo $kp->ID_KATEGORI_PERIZINAN ?>"><?php echo $kp->NAMA ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-12" style="margin-bottom: 10px">
        <label>NAMA</label>
        <input type="text" class="form-control" value="<?php echo $dataPerizinan->NAMA; ?>" name="NAMA" aria-describedby="sizing-addon2">
        <input type="hidden" class="form-control" value="<?php echo $dataPerizinan->ID_PERIZINAN; ?>" name="ID_PERIZINAN" aria-describedby="sizing-addon2">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>