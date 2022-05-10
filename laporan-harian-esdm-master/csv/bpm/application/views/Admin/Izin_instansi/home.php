<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
<!--   <div class="box-header">
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-izin_instansi"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
 -->  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>NAMA IZIN</th>
          <th>KETERANGAN</th>
          <th>SLA (HARI)</th>
<!--           <th style="text-align: center;">Aksi</th> -->
        </tr>
      </thead>
      <tbody id="data-izin_instansi">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_izin_instansi; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataIzin_instansi', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Izin Instansi';
  $data['url'] = 'Izin_instansi/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-izin_instansi', $data);
?>