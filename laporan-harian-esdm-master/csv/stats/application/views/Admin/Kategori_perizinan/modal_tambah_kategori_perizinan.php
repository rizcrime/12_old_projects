<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Kategori Perizinan</h3>

  <form id="form-tambah-kategori_perizinan" method="POST">
  <?=get_csrf_token()?>
    <div class="form-group">
      <div class="col-md-12" style="margin-bottom: 10px">
        <label>NAMA</label>
        <input type="text" class="form-control" placeholder="NAMA..." name="NAMA" aria-describedby="sizing-addon2">
      </div>      
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>