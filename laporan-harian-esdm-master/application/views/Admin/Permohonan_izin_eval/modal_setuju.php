<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Setuju</h4>
  </div>
  <form id="modal-form-setuju" method="POST" action="<?php echo base_url('Permohonan_izin_eval/prosesSetuju')?>">
  <?=get_csrf_token()?>
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <!-- <input type="hidden" name="ID_CURR_PROSES" value="<?php //echo $id_curr_proses_next?>"> -->
      <div class="profile-info-row">
      
          Apakah Anda yakin sudah mereview semua data?
      
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary' data-id="">
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

<script>
$(document).on('submit', '#modal-form-setuju', function(e) {
  $("#setuju-permohonan").modal("hide");
  blockUINextPage();
});
</script>