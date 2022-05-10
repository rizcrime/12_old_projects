<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
    <table class="table table-borderless">
        <tr>
            <td style="width: 200px">Skema</td>
            <td>
                <select id="skemaID">
                    <option value="-1">Pilih Skema</option>
                    <?php
                        foreach($Skema_workflow as $skema) {
                            echo "<option value=\"$skema->ID_SKEMA\">$skema->NAMA_SKEMA</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <!-- dummy column -->
            </td>
            <td>
            <button id="showProsesSkema" type="submit" class="btn btn-info pull-right">Tampilkan</button>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Urutan</th>
          <th>Proses</th>
          <th>Tanda Tangan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-skema_proses">
      
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-skema_proses"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
</div>

<?php echo $modal_add_skema_proses; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataSkema_proses', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Proses Skema';
  $data['url'] = 'skema_proses/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-skema_proses', $data);
?>