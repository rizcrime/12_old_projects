<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data CMS Pengumuman</h3>

  <form id="form-tambah-cms_pengumuman" method="POST">
  <?=get_csrf_token()?>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      </span>
      <input type="text" class="form-control" placeholder="Judul" name="judul" aria-describedby="sizing-addon2">
      <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" aria-describedby="sizing-addon2">
      <input type="text" class="form-control" placeholder="Tgl-Bulan-Tahun" name="durasi_keterangan_start" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" placeholder="Tgl-Bulan-Tahun" name="durasi_keterangan_end" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" placeholder="Proposal" name="proposal" aria-describedby="sizing-addon2">
      <input type="text" class="form-control" placeholder="Tgl-Bulan-Tahun" name="durasi_proposal_start" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
      <input type="text" class="form-control" placeholder="Tgl-Bulan-Tahun" name="durasi_proposal_end" aria-describedby="sizing-addon2" data-date-format="dd-mm-yyyy" data-provide="datepicker"/>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>