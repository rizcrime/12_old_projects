<script src="<?php echo base_url('\assets\js\jscolor.js'); ?>"></script>
<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-guideline"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>IZIN</th>
          <th>RULE</th>
          <th>STEP</th>
          <th>GUIDELINE</th>
          <th>COLOR</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-guideline">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_guideline; ?>

<div id="tempat-modal"></div> 

<?php show_my_confirm('konfirmasiHapus', 'hapus-data_guideline', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Dok_syarat_perusahaan';
  $data['url'] = 'Dok_syarat_perusahaan/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-dok_syarat_perusahaan', $data);
?>