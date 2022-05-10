
<form id="form-tambah-skema_role" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data <?php echo $id->NAMA_FORM ?></strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_FORM" value="<?php echo $id->ID_FORM ?>">

   <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA SKEMA
          
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="NAMA_SKEMA" placeholder="Masukkan Nama Skema..." style="width: 100%;">
        </div>
      </div>
    </div>

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="text-align: center;">
          <strong>PERSYARATAN</strong>
        </div>

        <div class="profile-info-value"  style="text-align: center; width: 10%;">
          <strong>STATUS</strong>
        </div>
      </div>

      <?php foreach($dataIzin_instansi as $izin_instansi): ?>
        <div class="profile-info-row">
          <div class="profile-info-name">
            <?php echo $izin_instansi->PDT ; ?>
          </div>

          <div class="profile-info-value"  style="text-align: center; width: 10%;">
            <input type="checkbox" name="ID_PERSYARATAN[]" value="<?php echo $izin_instansi->IDT ?>" <?php if($izin_instansi->IDR != NULL){ echo 'checked'; }?>>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Update Data
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
