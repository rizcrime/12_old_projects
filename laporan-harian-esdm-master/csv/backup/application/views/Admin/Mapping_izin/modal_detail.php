<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Detail Data</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA FORM
        </div>

        <div class="profile-info-value">
          <?php echo $mapping_izin->NAMA_FORM ?>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KETERANGAN
        </div>

        <div class="profile-info-value">
          <?php echo $mapping_izin->KETERANGAN ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          ID INSTANSI
        </div>

        <div class="profile-info-value">
          <?php echo $mapping_izin->ID_INSTANSI ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          LAMA HARI SLA
        </div>

        <div class="profile-info-value">
          <?php echo $mapping_izin->LAMA_HARI_SLA ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Close
    </button>
  </div>
</div>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
