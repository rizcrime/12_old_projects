<div class="col-md-offset-1 col-md-10 col-md-offset-1 well" style="width: 630px">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Bid Schedule</h3>

  <form id="form-update-bid_schedule" method="POST">
  <?=get_csrf_token()?>
        <input type="hidden" class="form-control" value="<?php echo $dataBid_schedule->BID_SCHEDULE_CODE; ?>" name="BID_SCHEDULE_CODE" aria-describedby="sizing-addon2">
    <div class="input-group form-group">
      <div class="col-md-12">
        <label>KATEGORI LELANG</label>
        <select name="BID_CATEGORY" class="form-control">
          <?php foreach($dataCategory as $category) : ?> 
            <option value="<?php echo $category->BID_CATEGORY_CODE ?>"><?php echo $category->BID_CATEGORY_NAME ?></option>
          <?php endforeach ?>         
        </select>
      </div>
      <div class="col-md-6">
        <label>AKSES DOKUMEN LELANG (START)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->BID_DOCUMENT_ACCESS_START_DATE; ?>" name="BID_DOCUMENT_ACCESS_START_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>AKSES DOKUMEN LELANG (END)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->BID_DOCUMENT_ACCESS_CLOSING_DATE; ?>" name="BID_DOCUMENT_ACCESS_CLOSING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>KLARIFIKASI FORUM (START)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->CLARIFICATION_FORUM_OPENING_DATE; ?>" name="CLARIFICATION_FORUM_OPENING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>KLARIFIKASI FORUM (END)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->CLARIFICATION_FORUM_CLOSING_DATE; ?>" name="  CLARIFICATION_FORUM_CLOSING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>UPLOAD PARTISIPASI DOKUMEN (START)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->PARTICIPATION_DOCUMENT_UPLOAD_STARTING_DATE; ?>" name="PARTICIPATION_DOCUMENT_UPLOAD_STARTING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>UPLOAD PARTISIPASI DOKUMEN (END)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->PARTICIPATION_DOCUMENT_UPLOAD_CLOSING_DATE; ?>" name="PARTICIPATION_DOCUMENT_UPLOAD_CLOSING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>EVALUASI (START)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->EVALUATION_START_DATE; ?>" name="EVALUATION_START_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>EVALUASI (END)</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->EVALUATION_CLOSING_DATE; ?>" name="EVALUATION_CLOSING_DATE" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>KEPUTUSAN PEMENANG</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->WINNER_DECISION; ?>" name="WINNER_DECISION" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>PENGUMUMAN PEMENANG</label>
        <input type="date" class="form-control" value="<?php echo $dataBid_schedule->WINNER_ANNOUNCEMENT_DATE; ?>" name="WINNER_ANNOUNCEMENT_DATE" aria-describedby="sizing-addon2">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>