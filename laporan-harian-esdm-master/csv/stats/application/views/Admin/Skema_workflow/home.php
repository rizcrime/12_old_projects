<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-skema_workflow"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>NAMA SKEMA</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-skema_workflow">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_skema_workflow; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataSkema_workflow', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Skema Workflow';
  $data['url'] = 'skema_workflow/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-skema_workflow', $data);
?>