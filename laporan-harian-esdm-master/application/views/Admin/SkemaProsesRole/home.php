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
          <th>Role</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-skema_proses">
      
      </tbody>
    </table>
  </div>
</div>

<div id="tempat-modal"></div>