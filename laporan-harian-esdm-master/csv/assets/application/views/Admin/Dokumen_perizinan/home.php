<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-dokumen_perizinan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>PERIZINAN</th>
          <th>PERUSAHAAN</th>
          <th>FILE PERIZINAN</th>
          <th>MANDATORY</th>
          <th>JENIS FILE</th>
          <th>MAX SIZE</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-dokumen_perizinan">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_dokumen_perizinan; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataDokumen_perizinan', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Dokumen_perizinan';
  $data['url'] = 'Dokumen_perizinan/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-dokumen_perizinan', $data);
?>