<!-- //modal syarat dan ketentuan -->
  <div id="form-sk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Syarat dan Ketentuan</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <?= $sk_reg->DESKRIPSI ?>
          </div>
        </div>
        <div class="modal-footer" style="border-radius:0 0 10px 10px;">
          <center>
            <button style="padding: 0" class='btn btn-sm btn-success' data-dismiss="modal">Setuju</button>
          </center>
        </div>
      </div>
    </div>
  </div>