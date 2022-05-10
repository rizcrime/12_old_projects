<div tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pemberitahuan</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning" style="margin-top: 5px;">
                <p><strong><?php echo $this->session->flashdata('msg'); ?></strong></p>
            </div>
        </div>
        <div class="modal-footer" style="border-radius:0 0 10px 10px; padding: 10px 20px 5px 20px;">
            <button class='btn btn-primary' style="padding: 5px 5px 5px 5px; font-size:12px; border-radius:5px;" data-dismiss='modal'>
            <i class='ace-icon fa fa-times'></i>
            Tutup
            </button>
        </div>
      </div>
    </div>
  </div>