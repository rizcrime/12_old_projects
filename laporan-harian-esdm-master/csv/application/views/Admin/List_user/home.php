<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6">
      <table class="table table-borderless">
        <tr>
            <td style="width: 100px">Nama Izin</td>
            <td>
                <select class="form-control" id="idIzin">
                    <option value="-1">Semua Izin</option>
                    <?php
                        foreach($Izin as $izin) {
                            echo "<option value=\"$izin->ID_FORM\">$izin->NAMA_FORM</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <!-- dummy column -->
            </td>
            <td>
              <button id="showUserByIzin" type="submit" class="btn btn-info pull-right">Tampilkan</button>
            </td>
        </tr>
      </table>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-user" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>NIP</th>
          <th>JABATAN</th>
          <th>NAMA</th>
          <th>USERNAME</th>
          <th>EMAIL</th>
        </tr>
      </thead>
      <tbody id="list-data">
      
      </tbody>
    </table>
  </div>
</div>