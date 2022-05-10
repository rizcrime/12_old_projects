<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
<!--     <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-verifikasi_bidder"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div> -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <h2 class="center">Daftar Perusahaan</h2>
    <!-- NEW -->
    <table id="list-need-ver" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="2%">#</th>
          <th>Nama Perusahaan</th>
          <th>E-MAIL</th>
          <th>Tanggal Daftar</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-verifikasi_bidder">
      
      </tbody>
    </table>
    <!-- END OF NEW -->
    <hr>
    <h2 class="center">Daftar Decline</h2>
    <!-- DAFTAR DECLINE -->
    <table id="list-decline" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="2%">#</th>
          <th>Nama Perusahaan</th>
          <th>E-MAIL</th>
        </tr>
      </thead>
      <tbody id="data-verifikasi_bidder">
      
      </tbody>
    </table>
    <!-- END OF DAFTAR DECLINE -->
    <hr>
    <h2 class="center">Daftar Blacklist</h2>
    <!-- DAFTAR BLACKLIST -->
    <table id="list-blacklist" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="2%">#</th>
          <th>Nama Perusahaan</th>
          <th>E-MAIL</th>
        </tr>
      </thead>
      <tbody id="data-verifikasi_bidder">
      
      </tbody>
    </table>
    <!-- END OF DAFTAR BLACKLIST -->
  </div>
</div>
<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataVerifikasi_bidder', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php show_my_confirm('konfirmasi', 'verifikasi-dataVerifikasi_bidder', 'Verifikasi Data Ini?', 'Ya, Verifikasi Data Ini'); ?>
<?php
  $data['judul'] = 'Verifikasi_bidder';
  $data['url'] = 'Verifikasi_bidder/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-verifikasi_bidder', $data);
?>