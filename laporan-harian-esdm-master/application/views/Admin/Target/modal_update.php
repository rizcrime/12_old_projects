<form id="form-update-target" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_TARGET" value="<?php echo $target->ID_TARGET ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
          <span class="profile-info-name" style="min-width: 200PX">PRODUKSI MINYAK</span></div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="APBN_PROD_MINYAK" value="<?php echo $target->APBN_PROD_MINYAK ?>" style="width: 100%;">
          
        </div>
      </div>
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
          <span class="profile-info-name" style="min-width: 200PX">PRODUKSI GAS</span></div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="APBN_PROD_GAS" value="<?php echo $target->APBN_PROD_GAS ?>" style="width: 100%;">
          
        </div>
      </div>
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
          <span class="profile-info-name" style="min-width: 200PX">EKUIVALEN MINYAK &amp; GAS</span></div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="APBN_EKV_MIGAS" value="<?php echo $target->APBN_EKV_MIGAS ?>" style="width: 100%;">
          
        </div>
      </div>
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TAHUN
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="number" name="TAHUN" value="<?php echo $target->TAHUN ?>" style="width: 100%;">
          
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
