<form id="form-tambah-t_persyaratan_izin" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data</strong></h4>
  </div>
  <div class="form-msg"></div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          PERSYARATAN
        </div>

        <div class="profile-info-value">
          <textarea required class="form-control" name="PERSYARATAN" placeholder="Masukkan Persyaratan..." style="width: 100%;"></textarea>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          FILE CONTOH
        </div>

        <div class="profile-info-value">
          <input type="file" class="form-control" name="FILE_CONTOH" aria-describedby="sizing-addon2">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MANDATORY
        </div>

        <div class="profile-info-value">
          <select required class="form-control" name="IS_MANDATORY">
            <option value="">--PILIH--</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          JENIS FILE
        </div>

        <div class="profile-info-value">

          <?php foreach ($allowed_extensions as $extension):?>
              <div class="checkbox">
              <label>
                <input type="checkbox" name="JENIS_FILE[]" value="<?=$extension?>"> <?=$extension?>
              </label>
            </div>
          <?php endforeach; ?>

        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MAX SIZE
        </div>

        <div class="profile-info-value">
          <div class="input-group">
            <input required class="form-control" type="number" step="any" name="MAX_SIZE" placeholder="Masukkan Max Size..." style="width: 100%;">
            <div class="input-group-addon">Bytes</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Tambah Data
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

