<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
  <!--   <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-skemaizin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div> -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Jenis Izin</th>
          <th>Skema yang digunakan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-skemaizin">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_skema_izin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataProvinsi', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Skema Izin';
  $data['url'] = 'Skema_izin/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-skemaizin', $data);
?>