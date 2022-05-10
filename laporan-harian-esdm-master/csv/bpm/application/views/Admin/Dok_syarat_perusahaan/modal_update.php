<form id="form-update-dok_syarat_perusahaan" method="POST">
<?=get_csrf_token()?>
  <input type="hidden" name="ID_DOK_SYARAT" value="<?php echo $dok_syarat_perusahaan->ID_DOK_SYARAT ?>">
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data Dokumen Syarat Perusahaan</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DOKUMEN PERSYARATAN
        </div>

        <div class="profile-info-value">
          <input class="form-control" type="text" name="DOKUMEN_PERSYARATAN" id="" value="<?php echo $dok_syarat_perusahaan->DOKUMEN_PERSYARATAN ?>" style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          SUB JENIS
        </div>

        <div class="profile-info-value">
          <textarea name="SUB_DOKUMEN_PERSYARATAN" class="form-control" placeholder="Masukkan satu item perbaris..."><?=$dok_syarat_perusahaan->SUB_DOKUMEN_PERSYARATAN?></textarea>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          AKTIF
        </div>

        <div class="profile-info-value">
          <select name="IS_ACTIVE" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_ACTIVE == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MANDATORY
        </div>

        <div class="profile-info-value">
          <select name="IS_MANDATORY" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_MANDATORY == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>


      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NOMOR
        </div>

        <div class="profile-info-value">
          <select name="IS_NOMOR" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_NOMOR == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TIPE DATA NOMOR
        </div>

        <div class="profile-info-value">
          <select name="IS_TYPE_NUMBER" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_TYPE_NUMBER == 'Y') { ?>
              <option value="Y" selected="selected">Hanya Nomor</option>
              <option value="N">Text</option>
            <?php } else { ?>
              <option value="Y">Hanya Nomor</option>
              <option value="N" selected="selected">Text</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TANGGAL MULAI
        </div>

        <div class="profile-info-value">
          <select name="IS_TANGGAL_MULAI" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_TANGGAL_MULAI == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TANGGAL AKHIR
        </div>

        <div class="profile-info-value">
          <select name="IS_TANGGAL_AKHIR" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_TANGGAL_AKHIR == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DAPAT DIUBAH
        </div>

        <div class="profile-info-value">
          <select name="IS_UPDATEABLE" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->IS_UPDATEABLE == 'Y') { ?>
              <option value="Y" selected="selected">Ya</option>
              <option value="N">Tidak</option>
            <?php } else { ?>
              <option value="Y">Ya</option>
              <option value="N" selected="selected">Tidak</option>
            <?php } ?>
          </select>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          GRUP
        </div>

        <div class="profile-info-value">
          <select name="GRUP" class="form-control" style="width: 100%">
            <?php if ($dok_syarat_perusahaan->GRUP == 'BU') { ?>
              <option value="BU" selected="selected">BU</option>
              <option value="Narahubung">Narahubung</option>
            <?php } else { ?>
              <option value="BU">BU</option>
              <option value="Narahubung" selected="selected">Narahubung</option>
            <?php } ?>
          </select>
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
