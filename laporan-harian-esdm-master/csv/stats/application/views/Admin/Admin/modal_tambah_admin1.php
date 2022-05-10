<div class="col-md-offset-1 col-md-10 col-md-offset-1 well" style="width: 630px">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Admin</h3>

    <form id="form-tambah-admin" method="POST">
    <?=get_csrf_token()?>
      <div class="input-group form-group">
        <div class="col-md-12">
          <label>USERNAME</label>
          <input type="text" class="form-control" placeholder="Masukkan Username..." name="USERNAME" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-12">
          <label>PASSWORD</label>
          <input type="password" class="form-control" name="PASSWORD" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-12">
          <label>NAMA</label>
          <input type="text" class="form-control" placeholder="Masukkan Nama..." name="NAMA" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>ROLE</label>
          <select class="form-control" name="ID_ROLE">
            <option value="">--PILIH--</option>
            <?php foreach($dataRole as $role): ?>
              <option value="<?php echo $role->ID_ROLE ?>"><?php echo $role->ROLE ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-6">
          <label>JABATAN STRUKTURAL</label>
          <input type="text" class="form-control" placeholder="Masukkan Jabatan Struktural..." name="JABATAN_STRUKTURAL" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>NIP</label>
          <input type="text" class="form-control" placeholder="Masukkan NIP..." name="NIP" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>ADMIN</label>
          <select class="form-control" name="IS_ADMIN">
            <option value="">__PILIH--</option>            
            <option value="Y">Ya</option>
            <option value="T">Tidak</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
        </div>
      </div>
    </form>
  </div>