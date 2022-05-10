<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-gunung"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>ID</th>
          <th>Nama Gunung</th>
          <th>Kabupaten / Kota</th>
          <th>Provinsi</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-gunung">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_gunung; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataGunung', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Gunung';
  $data['url'] = 'Gunung/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-gunung', $data);
?>