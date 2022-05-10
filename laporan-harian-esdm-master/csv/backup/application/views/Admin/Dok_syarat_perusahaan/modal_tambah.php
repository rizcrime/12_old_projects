<form id="form-tambah-dok_syarat_perusahaan" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data Dokumen Syarat Perusahaan</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DOKUMEN PERSYARATAN
        </div>

        <div class="profile-info-value">
          <input  required class="form-control" type="text" name="DOKUMEN_PERSYARATAN" id="" placeholder="Masukkan Dokumen Persyaratan..." style="width: 100%;">
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          SUB JENIS
        </div>

        <div class="profile-info-value">
          <textarea name="SUB_DOKUMEN_PERSYARATAN" class="form-control" placeholder="Masukkan satu item perbaris..."></textarea>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          AKTIF
        </div>

        <div class="profile-info-value">
          <select name="IS_ACTIVE" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MANDATORY
        </div>

        <div class="profile-info-value">
          <select name="IS_MANDATORY" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>


      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NOMOR
        </div>

        <div class="profile-info-value">
          <select name="IS_NOMOR" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TIPE DATA NOMOR
        </div>

        <div class="profile-info-value">
          <select name="IS_TYPE_NUMBER" class="form-control" style="width: 100%" required>
            <option value="T">Text</option>
            <option value="Y">Hanya Angka</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TANGGAL MULAI
        </div>

        <div class="profile-info-value">
          <select name="IS_TANGGAL_MULAI" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TANGGAL AKHIR
        </div>

        <div class="profile-info-value">
          <select name="IS_TANGGAL_AKHIR" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DAPAT DIUBAH
        </div>

        <div class="profile-info-value">
          <select name="IS_UPDATEABLE" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>
          </select>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          GRUP
        </div>

        <div class="profile-info-value">
          <select name="GRUP" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="BU">BU</option>
            <option value="Narahubung">Narahubung</option>
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
