<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-t_persyaratan_izin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>PERSYARATAN</th>
          <th>FILE CONTOH</th>
          <th>MANDATORY</th>
          <th>JENIS FILE</th>
          <th>MAX SIZE (Bytes)</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-t_persyaratan_izin">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_t_persyaratan_izin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataT_persyaratan_izin', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'T PERSYARATAN IZIN';
  $data['url'] = 'T_persyaratan_izin/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-t_persyaratan_izin', $data);
?>