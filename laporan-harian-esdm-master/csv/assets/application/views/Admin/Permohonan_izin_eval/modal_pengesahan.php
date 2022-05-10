<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Pengesahan</h4>
  </div>
  <form id="pengesahan-form" method="POST" action="<?php echo base_url('Permohonan_izin_eval/prosesPengesahan')?>">
  <?=get_csrf_token()?>
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <!-- <input type="hidden" name="ID_CURR_PROSES" value=""> -->
      <div class="profile-info-row">
      
          Apakah anda yakin?
      
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button id="pengesahan-submit" type="submit" class='btn btn-sm btn-primary' data-id="">
      <i class='ace-icon fa fa-save'></i>
      Setuju
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Batal
    </button>
  </div>
</form>
</div>