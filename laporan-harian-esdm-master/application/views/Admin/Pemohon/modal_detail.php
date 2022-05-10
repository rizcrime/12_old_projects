<div class="col-md-offset-1 col-md-10 col-md-offset-1 well" style="width: 630px">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Pemohon</h3>

  <form id="form-tambah-pemohon" method="POST">
  <?=get_csrf_token()?>
    <div class="input-group form-group">
      <div class="col-md-6">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap." name="NAMA_LENGKAP" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>Hubungan</label>
        <select class="form-control" name="ID_HUBUNGAN">
          <option value="">--PILIH--</option>
          <option value="1">HUbungan 1</option>
          <option value="2">Hubungan 2</option>
        </select>
      </div>
      <div class="col-md-12">
        <label>Surat Kuasa</label>
        <input type="file" class="form-control" name="FILE_SURAT_KUASA" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-6">
        <label>Jenis Identitas</label>
        <select class="form-control" name="ID_JENIS_IDENTITAS">
          <option value="">--PILIH--</option>
          <option value="1">KTP</option>
          <option value="2">PASSPOR</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Nomor Identitas</label>
        <input type="text" class="form-control" placeholder="Masukkan Nomor Identitas" name="NOMOR_IDENTITAS" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-12">
        <label>Upload Identitas</label>
        <input type="file" class="form-control" name="FILE_IDENTITAS" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-12">
        <label>Nomor Telpon</label>
        <input type="text" class="form-control" placeholder="Masukkan nomor telpon.." name="NOMOR_TELP" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-12">
        <label>Upload Foto</label>
        <input type="file" class="form-control" name="FILE_FOTO" aria-describedby="sizing-addon2">
      </div>
      <div class="col-md-12">
        <label>ALAMAT</label>
        <input type="text" class="form-control" placeholder="Masukkan alamat" name="ALAMAT" aria-describedby="sizing-addon2">
      </div>
    </div>
    <input type="hidden" name="TGL_INSERT" value="<?php echo date('Y-m-d h:i:sa');?>">
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>