<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data <?php echo $id->NAMA_FORM ?></h3>

  <form id="form-update-mapping_izin" method="POST">
  <?=get_csrf_token()?>
    <input type="hidden" name="ID_FORM" value="<?php echo $id->ID_FORM ?>">
      <table class="table table-striped">  
        <tr>
          <td><strong>PERSYARATAN</strong></td>
          <td><strong>STATUS</strong></td>
        </tr>
        <?php foreach($dataIzin_instansi as $izin_instansi): ?>
            <tr>
              <td><?php echo $izin_instansi->PDT ; ?></td>
              <td><input type="checkbox" name="ID_PERSYARATAN[]" value="<?php echo $izin_instansi->IDT ?>" <?php if($izin_instansi->IDR != NULL){ echo 'checked'; }?>></td>
            </tr>
        <?php endforeach ?>
      </table>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>