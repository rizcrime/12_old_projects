<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>NAMA PERUSAHAAN</th>
          <th>E-MAIL</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-bidder">
      
      </tbody>
    </table>
  </div>
</div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataBidder', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Bidder';
  $data['url'] = 'Bidder/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-bidder', $data);
?>