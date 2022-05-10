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
                <label for="inputIDSkema" class="col-sm-3 control-label"><b>Skema</b></label>

                <div class="col-sm-9">
                <select id="inputIDSkema" name="ID_SKEMA">
                    <option value="-1">Pilih Skema</option>
                    <?php
                        foreach($Skema_workflow as $skema) {
                            $selected = $proses->ID_SKEMA == $skema->ID_SKEMA ? "selected" : "";
                            echo "<option value=\"$skema->ID_SKEMA\" $selected>$skema->NAMA_SKEMA</option>";
                        }
                    ?>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputUrutan" class="col-sm-3 control-label"><b>Urutan</b></label>

                <div class="col-sm-3">
                <input type="number" class="form-control" id="inputUrutan" name="URUTAN" value="<?=$proses->URUTAN?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrutan" class="col-sm-3 control-label"><b>Controller</b></label>

                <div class="col-sm-3">
                <input type="text" class="form-control" id="inputController" name="CONTROLLER" value="<?=$proses->CONTROLLER_HANDLER?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNamaProses" class="col-sm-3 control-label"><b>Nama Proses</b></label>

                <div class="col-sm-9">
                <textarea type="text" class="form-control" id="inputNamaProses" name="NAMA_PROSES" maxlength="60"><?=$proses->NAMA_PROSES?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="inputFinalTTD" name="IS_FINAL_TTD" value="Y" <?= $proses->IS_FINAL_TTD === "Y" ? "checked" : ""?> /> Final TTD
                    </label>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="isfifo" name="IS_FIFO" value="Y" <?= $proses->IS_FIFO === "Y" ? "checked" : ""?> /> Antrian FIFO
                    </label>
                </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="isfifo" name="IS_BKPM" value="Y" <?= $proses->IS_BKPM === "Y" ? "checked" : ""?> /> Proses BKPM
                    </label>
                </div>
                </div>
            </div>

            </div>
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