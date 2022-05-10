<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Hotel dan Transportasi</h1>
          <p class="mb-4">Hotel dan Transportasi merupakan tampilan seluruh hotel dan Transportasi yang terdaftar. Masukkan data hotel dan transportasi dengan klik menu Tambah Data.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Hotel dan Transportasi</h6>
            </div>
            <div class="card-body">

              <div id="tombol-tambah">
            	 <a href="<?php echo base_url('Dashboard/Konfigurasi/tambah_konfigurasi') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a><br>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Deskripsi</th>
                      <th>Jenis Konfigurasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($msconfig as $msconfig) {
                    ?>
                        <tr>
                          <td><?php echo $msconfig->description; ?></td>
                          <td><?php echo $msconfig->var_id; ?></td>
                        </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
</body>
</html>