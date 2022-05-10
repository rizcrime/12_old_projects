<div class="col-md-offset-1 col-md-10 col-md-offset-1 well" style="width: 630px">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Pemohon</h3>

  <form id="form-tambah-pemohon" method="POST">
  <?=get_csrf_token()?>
    <form method="POST">
    <?=get_csrf_token()?>

      <div class="input-group form-group" style="width: 100%">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
          <h4><strong>Profil Perusahaan</strong></h4>
        </div>

        <div class="col-md-6">
          <div class="col-md-12">
            <label>Nama Pemohon*</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Minimal 3 Karakter ..." name="NAMA" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
          </div>

          <div class="col-md-12">
            <label>Status *</label>
            <select class="form-control" required oninvalid="this.setCustomValidity('Status tidak boleh kosong')" oninput="setCustomValidity('')">
              <option value="">--Pilih--</option>
              <option value="direktur">Direktur</option>
              <option value="kuasa">Kuasa</option>
            </select>
          </div>

          <div class="col-md-12">
            <div class="col-md-4">
              <label>File Surat Kuasa *</label>
            </div>
            <div class="col-md-8">
              <input type="file" class="form-control" name="FILE_SURAT_KUASA" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('File Surat Kuasa tidak boleh kosong')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="col-md-12">
            <div class="col-md-4">
              <label>Jenis Identitas *</label>
            </div>
            <div class="col-md-8">
              <select class="form-control" required oninvalid="this.setCustomValidity('Jenis Identitas tidak boleh kosong')" oninput="setCustomValidity('')">
                <option value="">--Pilih--</option>
                <option value="ktp">KTP</option>
                <option value="paspor">Paspor</option>
                <option value="sim">SIM</option>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <div class="col-md-4">
              <label>Nomor Identitas *</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" placeholder="Masukkan Nomor Identitas ..." name="NOMOR_TELEPON" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Nomor Identitas tidak boleh kosong')" oninput="setCustomValidity('')">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="col-md-12">
            <div class="col-md-4">
              <label>Nomor Telepon *</label>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon ..." name="NOMOR_TELEPON" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Nomor Telepon tidak boleh kosong')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="col-md-12">
            <div class="col-md-4">
              <label>Photo *</label>
            </div>
            <div class="col-md-8">
              <input type="file" id="zzz" class="form-control" name="PHOTO" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Photo tidak boleh kosong')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="col-md-12">
            <label>Alamat *</label>
            <textarea class="form-control" placeholder="Masukkan Alamat ..." name="ALAMAT" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
          </div>

        </div>

      </div>

      <div class="form-group" style="width: 100%">
        <div class="col-md-6">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Submit</button>
        </div>
        <div class="col-md-6">
          <button type="submit" class="form-control btn btn-danger"> <i class="glyphicon glyphicon-remove"></i> Batal</button>
        </div>
      </div>
    </form>
    <input type="hidden" name="TGL_INSERT" value="<?php echo date('Y-m-d h:i:sa');?>">
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>