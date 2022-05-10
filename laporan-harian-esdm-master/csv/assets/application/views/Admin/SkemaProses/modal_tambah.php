<form class="form-horizontal" id="form-tambah-skema_proses" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Proses Skema</strong></h4>
  </div>
  <div class="modal-body">

        <div class="box-header with-border">
            <h3 class="box-title">Proses Skema</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <div class="box-body">
            <div class="form-group">
                <label for="inputUrutan" class="col-sm-3 control-label"><b>Urutan</b></label>

                <div class="col-sm-3">
                <input type="number" class="form-control" id="inputUrutan" name="URUTAN">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNamaProses" class="col-sm-3 control-label"><b>Nama Proses</b></label>

                <div class="col-sm-9">
                <textarea class="form-control" id="inputNamaProses" name="NAMA_PROSES" maxlength="60"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrutan" class="col-sm-3 control-label"><b>Controller</b></label>

                <div class="col-sm-3">
                <input type="text" class="form-control" id="inputController" name="CONTROLLER_HANDLER">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="inputFinalTTD" name="IS_FINAL_TTD" value="Y"/> Final TTD
                    </label>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="isfifo" name="IS_FIFO" value="Y" checked/> Antrian FIFO
                    </label>
                </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="isbkpm" name="IS_BKPM" value="Y"/> Proses BKPM
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
      Tambah Data
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
