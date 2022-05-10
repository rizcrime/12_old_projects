<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Alasan Penolakan</strong></h4>
  </div>
  <form method="POST" action="<?php echo base_url('Verifikasi_bidder/prosesTolak')?>">
  <?=get_csrf_token()?>
    <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $admin->ID_PERUSAHAAN; ?>">
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          <textarea name="ALASAN_PENOLAKAN" cols="400" rows="4" required></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary' data-id="<?php echo $admin->ID_PERUSAHAAN; ?>">
      <i class='ace-icon fa fa-save'></i>
      Tolak
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Batal
    </button>
  </div>
</form>
</div>