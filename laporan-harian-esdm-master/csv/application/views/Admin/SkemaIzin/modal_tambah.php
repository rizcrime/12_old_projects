<form id="form-tambah-skemaizin" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data Skema Izin</strong></h4>
  </div>
  <div class="modal-body">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          JENIS IZIN
          
        </div>

        <div class="profile-info-value">
          <select class="form-control" name="ID_FORM" aria-describedby="sizing-addon2">
            <option value="">--PILIH--</option>
            <?php foreach($dataJenisIzin as $izin): ?>
              <option value="<?php echo $izin->ID_FORM ?>"><?php echo $izin->NAMA_FORM ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Skema yang digunakan
          
        </div>

        <div class="profile-info-value">
          <select class="form-control" name="ID_SKEMA" aria-describedby="sizing-addon2">
            <option value="">--PILIH--</option>
            <?php foreach($skemaIzin as $skema): ?>
              <option value="<?php echo $skema->ID_SKEMA ?>"><?php echo $skema->NAMA_SKEMA ?></option>
            <?php endforeach ?>
          </select>
      </div>
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
