<form id="form-update-kabkot" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" value="<?php echo $kabkot->ID_KABKOT ?>" name="ID_KABKOT">
      <input type="hidden" name="EDIT_BY" value="<?php echo $this->userdata->USERNAME ?>">
      <input type="hidden" name="DATE_MODIFIED" value="<?php echo date('Y-m-d') ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="NAMA_KABKOT" value="<?php echo $kabkot->NAMA_KABKOT ?>" name="NAMA_KABKOT" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA EN
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="NAMA_KABKOT_EN" value="<?php echo $kabkot->NAMA_KABKOT_EN ?>" name="NAMA_KABKOT_EN" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MULAI EXIST
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="date" name="MULAI_EXIST" value="<?php echo $kabkot->MULAI_EXIST?>" name="MULAI_EXIST" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          AKHIR EXIST
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="date" name="AKHIR_EXIST" value="<?php echo $kabkot->AKHIR_EXIST?>" name="AKHIR_EXIST" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KODE NEGARA
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="date" name="KODE_NEGARA" value="<?php echo $kabkot->KODE_NEGARA ?>" name="KODE_NEGARA" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          PROVINSI
        </div>

        <div class="profile-info-value">
          <select class="form-control" name="ID_PROVINSI" aria-describedby="sizing-addon2">
            <!-- <option value="<?php echo $kabkot->ID_PROVINSI?>"><?php echo $kabkot->NAMA_PROVINSI?></option> -->
            <?php foreach($dataProvinsi as $provinsi): ?>
              <option <?php if($provinsi->ID_PROVINSI == "$kabkot->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KOTA
        </div>

        <div class="profile-info-value">
          <select class="form-control" name="IS_KOTA">
            <option value="<?php echo $kabkot->IS_KOTA?>">
              <?php if($kabkot->IS_KOTA == 1) { ?>
                Ya</option>
                <option value="0">Tidak</option>
              <?php } else { ?>
                Tidak</option>
                <option value="1">Ya</option>
              <?php } ?>
          </select>
        </div>
      </div>
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