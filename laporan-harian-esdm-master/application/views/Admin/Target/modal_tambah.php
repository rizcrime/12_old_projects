<form id="form-tambah-target" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data Target</strong></h4>
  </div>
<div class="form-msg"></div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
        PRODUKSI MINYAK</div>

        <div class="profile-info-value">
          <!--<input required class="form-control" type="text" name="APBN" id="APBN" placeholder="Masukkan Target..." style="width: 100%;">-->
          <input required class="form-control" type="number" name="APBN_PROD_MINYAK" id="APBN_PROD_MINYAK" placeholder="Masukkan Target...">
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
        PRODUKSI GAS</div>

        <div class="profile-info-value">
          <!--<input required class="form-control" type="text" name="APBN" id="APBN" placeholder="Masukkan Target..." style="width: 100%;">-->
          <input required class="form-control" type="number" name="APBN_PROD_GAS" id="APBN_PROD_GAS" placeholder="Masukkan Target...">
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TARGET
        EKUIVALEN MINYAK &amp; GAS</div>

        <div class="profile-info-value">
          <!--<input required class="form-control" type="text" name="APBN" id="APBN" placeholder="Masukkan Target..." style="width: 100%;">-->
          <input required class="form-control" type="number" name="APBN_EKV_MIGAS" id="APBN_EKV_MIGAS" placeholder="Masukkan Target...">
        </div>
      </div>
      
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TAHUN
        </div>

        <div class="profile-info-value">
          <!--<input required class="form-control" type="text" name="APBN" id="APBN" placeholder="Masukkan Target..." style="width: 100%;">-->
          <input required class="form-control" type="number" name="TAHUN" id="TAHUN" placeholder="Tahun Target">
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
