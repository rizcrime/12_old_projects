<form id="form-update-hak_izin" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Hak Akses</strong></h4>
  </div>
  <div class="modal-body">
   <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          ROLE
        </div>
        <div class="profile-info-value">
          <input readonly class="form-control" type="text" name="NAMA_ROLE" value="<?=$role->ROLE?>" placeholder="Masukkan Nama Skema..." style="width: 100%;">
        </div>
      </div>
      <input type="hidden" name="ID_ROLE" value="<?=$role->ID_ROLE?>">
    </div>

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="text-align: center;">
          <strong>MENU</strong>
        </div>

        <div class="profile-info-value"  style="text-align: center; width: 10%;">
          <strong>Checklist</strong>
        </div>
      </div>

      <?php foreach($data_izin as $izin_instansi): ?>
        <div class="profile-info-row">
          <div class="profile-info-name" style="text-align:left">
            <?= $izin_instansi->KATEGORI_LAPORAN ?>
          </div>

          <div class="profile-info-value"  style="text-align: center; width: 10%;">
            <input type="checkbox" name="ID_FORM[]" value="<?= $izin_instansi->ID_KATEGORI ?>" <?php if($izin_instansi->akses == "Y"){ echo 'checked'; }?>>
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