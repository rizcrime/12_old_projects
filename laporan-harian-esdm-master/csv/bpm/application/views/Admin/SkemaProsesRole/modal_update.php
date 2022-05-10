<form id="form-update-skema_proses" class="form-horizontal" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Skema</strong></h4>
  </div>
  <div class="modal-body">

        <div class="box-header with-border">
            <h3 class="box-title">Proses Skema</h3>
        </div>
        <!-- /.box-header -->

        <!-- form start -->
            <input type="hidden" name="ID_PROSES" value="<?=$proses->ID_PROSES?>">

            <div class="box-body">

            <div class="form-group">
                <label for="inputUrutan" class="col-sm-3 control-label"><b>Urutan</b></label>

                <div class="col-sm-3">
                <input type="number" class="form-control" id="inputUrutan" name="URUTAN" value="<?=$proses->URUTAN?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="inputNamaProses" class="col-sm-3 control-label"><b>Nama Proses</b></label>

                <div class="col-sm-9">
                <textarea type="text" class="form-control" id="inputNamaProses" name="NAMA_PROSES" readonly><?=$proses->NAMA_PROSES?></textarea>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="inputFinalTTD" name="IS_FINAL_TTD" value="Y" <?= $proses->IS_FINAL_TTD === "Y" ? "checked" : ""?> onclick="return false;"/> Final TTD
                    </label>
                </div>
                </div>
            </div> -->
                <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="text-align: center;">
                    <strong>Role</strong>
                    </div>

                    <div class="profile-info-value"  style="text-align: center; width: 10%;">
                    <strong>Checklist</strong>
                    </div>
                </div>
                <?php foreach($role_list as $role): ?>
                <div class="profile-info-row">
                    <div class="profile-info-name">
                        <?=$role->ROLE?>
                    </div>

                    <div class="profile-info-value"  style="text-align: center; width: 10%;">
                        <input type="checkbox" name="ID_ROLE[]" value="<?=$role->ID_ROLE ?>" <?php if($role->ID_PROSES != NULL){ echo 'checked'; }?>>
                    </div>
                </div>
                <?php endforeach ?>
            </div> <!-- /.box-body -->
            <!-- /.box-footer -->

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


<!-- <script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script> -->