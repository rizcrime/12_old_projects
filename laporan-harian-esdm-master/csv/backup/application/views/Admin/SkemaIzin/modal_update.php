<form id="form-update-skemaizin" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_FORM" value="<?php echo $dataSkemaIzin2->ID_FORM ?>">

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          JENIS IZIN
        </div>

        <div class="profile-info-value">
          <select class="form-control" name="ID_FORM" aria-describedby="sizing-addon2">
            <option value="<?php echo $dataSkemaIzin2->ID_FORM?>"><?php echo $dataSkemaIzin2->NAMA_FORM?></option>
            <?php foreach($dataSkemaIzin as $izin): ?>
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
            <option value="">-PILIH-</option>
            <?php foreach($skema as $skema): ?>
              <option value="<?php echo $skema->ID_SKEMA ?>" <?php if($dataSkemaIzin2->ID_SKEMA == $skema->ID_SKEMA) { echo 'selected'; } ?>><?php echo $skema->NAMA_SKEMA ?></option>
            <?php endforeach ?>
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