<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Paket</h1>
          <p class="mb-4">Data Paket merupakan tampilan seluruh paket yang terdaftar. Masukkan data paket baru dengan klik menu Tambah Paket.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
            </div>
            <div class="card-body">
              <?php
                if($this->session->userdata('kd_pihk') != 'super_monitoring'){
              ?>
              <div id="tombol-tambah">
            	 <a href="<?php echo base_url('Dashboard/paket/tambah_paket') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket</a><br>
              </div>
              <?php
                }elseif($this->session->userdata('kd_pihk') == 'super_monitoring'){
              ?>
                  <a href="<?php echo base_url('Dashboard/Paket/export_all') ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Seluruh Paket</a>
              <?php
                }
              ?>
              <div class="table-responsive">
                <?php
                  if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin') {
                ?>
                    <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode PIHK</th>
                          <th>Nama PIHK</th>
              						<th>Kode Paket</th>
              						<th>Nama Paket</th>
                          <th>Jumlah Pra Manifest</th>
              						<th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
              						$no = 1;
                          foreach ($data_paket as $data_paket) {
              					?>
              							<tr>
              								<td><?php echo $no ?></td>
                              <td><?php echo $data_paket->kd_pihk; ?></td>
                              <td><?php echo $data_paket->pihk; ?></td>
              								<td><?php echo $data_paket->kode_paket; ?></td>
              								<td><?php echo $data_paket->nama_paket; ?></td>
                              <td><?php echo $data_paket->jumlah_pramanifest; ?></td>
                              <td><a href="<?php echo base_url('Dashboard/paket/detail_paket/').$data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a>
                              <?php if ($data_paket->jumlah_pramanifest > 0) { ?>
                                <a href="paket/edit_paket/<?php echo $data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm disabled"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                                <button value="<?php echo $data_paket->kode_paket ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_paket" disabled data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
                              <?php }else{ ?>
              								  <a href="paket/edit_paket/<?php echo $data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                                <button value="<?php echo $data_paket->kode_paket ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_paket" data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
              							  <?php } ?>
                              </td>
                            </tr>
              						<?php
              						$no++;
              						}
              					?>
                      </tbody>
                    </table>
                <?php
                  }elseif($this->session->userdata('kd_pihk') == 'super_monitoring'){
                ?>
                    <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode PIHK</th>
                          <th>Nama PIHK</th>
                          <th>Kode Paket</th>
                          <th>Nama Paket</th>
                          <th>Jumlah Pra Manifest</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no = 1;
                          foreach ($data_paket as $data_paket) {
                        ?>
                            <tr>
                              <td><?php echo $no ?></td>
                              <td><?php echo $data_paket->kd_pihk; ?></td>
                              <td><?php echo $data_paket->pihk; ?></td>
                              <td><?php echo $data_paket->kode_paket; ?></td>
                              <td><?php echo $data_paket->nama_paket; ?></td>
                              <td><?php echo $data_paket->jumlah_pramanifest; ?></td>
                              <td><a href="<?php echo base_url('Dashboard/paket/detail_paket/').$data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a>
                              </td>
                            </tr>
                          <?php
                          $no++;
                          }
                        ?>
                      </tbody>
                    </table>
                <?php
                }else{
                ?>
                    <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Paket</th>
                          <th>Nama Paket</th>
                          <th>Jumlah Pra Manifest</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $no = 1;
                          foreach ($data_paket as $data_paket) {
                        ?>
                            <tr>
                              <td><?php echo $no ?></td>
                              <td><?php echo $data_paket->kode_paket; ?></td>
                              <td><?php echo $data_paket->nama_paket; ?></td>
                              <td><?php echo $data_paket->jumlah_pramanifest; ?></td>
                              <td><a href="<?php echo base_url('Dashboard/paket/detail_paket/').$data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a>
                              <?php if ($data_paket->jumlah_pramanifest > 0) { ?>
                                <a href="paket/edit_paket/<?php echo $data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm disabled"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                                <button value="<?php echo $data_paket->kode_paket ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_paket" disabled data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
                              <?php }else{ ?>
                                <a href="paket/edit_paket/<?php echo $data_paket->kode_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                                <button value="<?php echo $data_paket->kode_paket ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_paket" data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
                              <?php } ?>
                              </td>
                            </tr>
                          <?php
                          $no++;
                          }
                        ?>
                      </tbody>
                    </table>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>

      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_delete">Delete Paket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                 <strong>Apakah anda yakin data ini ingin dihapus?</strong>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="kode_paket" id="kode_paket" class="form-control">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="button" id="btn_delete" aria-hidden="true" class="btn btn-primary">Yes</button>
            </div>
          </div>
        </div>
      </div>
</body>
</html>

<script>
  var kode_paket;
  $('.del_paket').on('click', function(){
    kode_paket = $(this).val();
  });

  $('#btn_delete').on('click', function(){
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('Dashboard/paket/delete_paket')?>",
        dataType : "JSON",
        data : {kode_paket:kode_paket},
        success : function(data)
          {
            $('#delete').modal('hide');
            location = "<?php echo base_url('Dashboard/paket') ?>";
          }
    }); 
  }); 
</script>