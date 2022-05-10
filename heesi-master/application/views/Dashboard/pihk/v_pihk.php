<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data PIHK</h1>
          <p class="mb-4">Data PIHK merupakan tampilan seluruh PIHK yang terdaftar</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data PIHK</h6>
            </div>
            <div class="card-body">
              <a href="<?php echo base_url('Dashboard/Pihk/export') ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>

              <div class="table-responsive">
                <?php
                if($this->session->userdata('kd_pihk') == 'super_monitoring'){
                ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode PIHK</th>
                        <th>Nama PIHK</th>
                        <th width="20px">Jumlah Paket</th>
                        <th width="20px">Jumlah Pra Manifest</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        for ($i=0; $i < count($data_user); $i++) { 
                      ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data_user[$i]['kd_pihk']; ?></td>
                        <td><?php echo $data_user[$i]['pihk']; ?></td>
                        <td><?php echo $data_user[$i]['jumlah_paket']; ?></td>
                        <td><?php echo $data_user[$i]['jumlah_pramanifest']; ?></td>
                        <td><?php echo $data_user[$i]['status']; ?></td>
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
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode PIHK</th>
                        <th>Nama PIHK</th>
                        <th width="20px">Jumlah Paket</th>
                        <th width="20px">Jumlah Pra Manifest</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        for ($i=0; $i < count($data_user); $i++) { 
                      ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data_user[$i]['kd_pihk']; ?></td>
                        <td><?php echo $data_user[$i]['pihk']; ?></td>
                        <td><?php echo $data_user[$i]['jumlah_paket']; ?></td>
                        <td><?php echo $data_user[$i]['jumlah_pramanifest']; ?></td>
                        <td><?php echo $data_user[$i]['status']; ?></td>
                        <td>
                          <?php if ($data_user[$i]['status'] == 'Aktif') { ?>
                            <a href="Pihk/non_aktif/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Non Aktifkan</a>
                            <a href="Pihk/edit_pihk/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm disabled"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                          <?php }else{ ?>
                            <a href="Pihk/aktif/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Aktifkan</a>
                            <a href="Pihk/edit_pihk/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>
                          <?php } ?>
                           <!-- <a href="Pihk/detail_pihk/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a> <a href="Pihk/delete_pihk/<?php echo $data_user[$i]['kd_pihk'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</a> --></td>
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
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
	
</body>
</html>