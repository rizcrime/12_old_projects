<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-dok_syarat_perusahaan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>DOKUMEN PERSYARATAN</th>
          <th>AKTIF</th>
          <th>MANDATORY</th>
          <th>SUB JENIS</th>
          <th>NOMOR</th>
          <th>TANGGAL MULAI</th>
          <th>TANGGAL AKHIR</th>
          <th>DAPAT DIUBAH</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-dok_syarat_perusahaan">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_dok_syarat_perusahaan; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataDok_syarat_perusahaan', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Dok_syarat_perusahaan';
  $data['url'] = 'Dok_syarat_perusahaan/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-dok_syarat_perusahaan', $data);
?>