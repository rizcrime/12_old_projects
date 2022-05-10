<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Detail Evaluasi</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KODE TRACKING
        </div>

        <div class="profile-info-value">
          <?=encrypted_id_permohonan($id_permohonan)?>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          EVALUATOR
        </div>

        <div class="profile-info-value">
          <?php echo $evaluasi->NAMA ?>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          URAIAN
        </div>

        <div class="profile-info-value">
          <?php echo html_entity_decode(strip_tags($evaluasi->URAIAN_CAT_DOK_PRSHN)) ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KETERANGAN
        </div>

        <div class="profile-info-value">
          <?php echo $evaluasi->KETERANGAN_CAT_DOK_PRSHN ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          TANGGAL EVALUASI
        </div>

        <div class="profile-info-value">
          <?php echo $evaluasi->TGL_CAT_DOK_PRSHN ?>
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
