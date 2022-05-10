<form id="regForm" action="">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data Kabupaten Kota</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="EDIT_BY" value="<?php echo $this->userdata->USERNAME ?>">
      <input type="hidden" name="DATE_MODIFIED" value="<?php echo date('Y-m-d') ?>">

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->NAMA_KABKOT ?>
        </div>
      </div>
    </div>

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NANAMA EN
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->NAMA_KABKOT_EN ?>
        </div>
      </div>
    </div>

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MULAI EXIST
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->MULAI_EXIST ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          AKHIR EXIST
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->AKHIR_EXIST ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KODE NEGARA<
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->KODE_NEGARA ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          PROVINSI
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->NAMA_PROVINSI ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          IS KOTA
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->IS_KOTA ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DATE MODIFIED
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->DATE_MODIFIED ?>
        </div>
      </div>
    </div>
    
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          EDIT BY
        </div>

        <div class="profile-info-value">
          <?php echo $kabkot->EDIT_BY ?>
        </div>
      </div>
    </div>
  </div>
</div>
</form>