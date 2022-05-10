<form id="form-update-panduan" method="POST">
<?=get_csrf_token()?>
  <input type="hidden" name="ID_PANDUAN" value="<?php echo $panduan->ID_PANDUAN ?>">
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data Panduan</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          THUMBNAIL
          
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="THUMBNAIL" id="" value="<?php echo $panduan->THUMBNAIL ?>" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DOKUMEN
          
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="DOKUMEN" id="" value="<?php echo $panduan->DOKUMEN ?>" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          FILE
          <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Hi There !!" data-content="Pilih file jika ingin update file ...."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="file" name="FILE" id="" style="width: 100%;">
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
