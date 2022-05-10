<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Data</h3>
    <div class="col-md-6">
        <label>NAMA FORM</label>
        <p><?php echo $mapping_izin->NAMA_FORM ?></p>
    </div>
    <div class="col-md-6">
        <label>KETERANGAN</label>
        <p><?php echo $mapping_izin->KETERANGAN ?></p>
    </div>
    <div class="col-md-6">
        <label>ID INSTANSI</label>
        <p><?php echo $mapping_izin->ID_INSTANSI ?></p>
    </div>
    <div class="col-md-6">
        <label>LAMA HARI SLA</label>
        <p><?php echo $mapping_izin->LAMA_HARI_SLA ?></p>
    </div>
  <div class="col-md-12">
    <div class="text-right">
      <button class="btn btn-danger" data-dismiss="modal"> Close</button>
    </div>  
  </div>
</div>