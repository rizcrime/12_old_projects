<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-panduan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>THUMBNAIL</th>
          <th>DOKUMEN</th>
          <th>FILE</th>
          <th>SIZE</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-panduan">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_panduan; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPanduan', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Panduan';
  $data['url'] = 'Panduan/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-panduan', $data);
?>