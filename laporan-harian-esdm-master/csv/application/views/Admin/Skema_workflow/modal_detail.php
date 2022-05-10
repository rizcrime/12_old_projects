<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Data</h3>
  <form id="regForm" action="">
  <?=get_csrf_token()?>
    <div class="col-md-12">
      <div class="form-group">
        <label>KATEGORI LELANG:</label>
        <input class="form-control" value="<?php echo $bid_schedule->BID_CATEGORY_NAME ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AKSES DOKUMEN LELANG (START):</label>
        <input class="form-control" value="<?php echo $bid_schedule->BID_DOCUMENT_ACCESS_START_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AKSES DOKUMEN LELANG (END):</label>
        <input class="form-control" value="<?php echo $bid_schedule->BID_DOCUMENT_ACCESS_CLOSING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KLARIFIKASI FORUM (START):</label>
        <input class="form-control" value="<?php echo $bid_schedule->CLARIFICATION_FORUM_OPENING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KLARIFIKASI FORUM (END):</label>
        <input class="form-control" value="<?php echo $bid_schedule->CLARIFICATION_FORUM_CLOSING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>UPLOAD PARTISIPAS DOKUMEN (START):</label>
        <input class="form-control" value="<?php echo $bid_schedule->PARTICIPATION_DOCUMENT_UPLOAD_STARTING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>UPLOAD PARTISIPASI DOKUMEN (END):</label>
        <input class="form-control" value="<?php echo $bid_schedule->PARTICIPATION_DOCUMENT_UPLOAD_CLOSING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>EVALUASI (START):</label>
        <input class="form-control" value="<?php echo $bid_schedule->EVALUATION_START_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>EVALUASI (END):</label>
        <input class="form-control" value="<?php echo $bid_schedule->EVALUATION_CLOSING_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KEPUTUSAN PEMENANG:</label>
        <input class="form-control" value="<?php echo $bid_schedule->WINNER_DECISION ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>PENGUMUMAN PEMENANG:</label>
        <input class="form-control" value="<?php echo $bid_schedule->WINNER_ANNOUNCEMENT_DATE ?>" readonly>
      </div>
    </div>
  </form>
  <div class="col-md-12">
    <div class="text-right">
      <button class="btn btn-danger" data-dismiss="modal"> Close</button>
    </div>  
  </div>
</div>