<script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/tinymce/init-tinymce.js"></script>

<form id="form-update-syarat_ketentuan" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
<div class="form-msg"></div>
  <div class="modal-body">

    <input type="hidden" name="ID_KETENTUAN" value="<?php echo $syarat_ketentuan->ID_KETENTUAN ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Deskripsi
        </div>

        <div class="profile-info-value">
          <textarea class="form-control tinymce" name="DESKRIPSI"><?= $syarat_ketentuan->DESKRIPSI ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Save
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Cancel
    </button>
  </div>
</div>
</form>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
