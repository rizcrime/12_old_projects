<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Instrumen</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Instrumen</h6>
            </div>
            <div class="card-body">
            <div id="tombol-tambah">
               <a href="<?php echo base_url('Dashboard/Instrumen/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a><br>
              </div>
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama PIHK</th>
                        <th>Nama Petugas</th>
                        <th>Nomor Telepon</th>
                        <th>Daerah Kerja 1</th>
                        <th>Daerah Kerja 2</th>
                        <th>Daerah Kerja 3</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      <?php foreach ($DataInstrumen as $key): ?>
                      <tr>
                        <?php $no++; ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->pihk; ?></td>
                        <td><?php echo $key->nama_petugas; ?></td>
                        <td><?php echo $key->no_telepon_petugas; ?></td>
                        <td><?php echo $key->daerah_kerja_1; ?></td>
                        <td><?php echo $key->daerah_kerja_2; ?></td>
                        <td><?php echo $key->daerah_kerja_3; ?></td>
                        <td><a href="<?php echo base_url('Dashboard/Instrumen/detail/') ?><?php echo $key->instrumen_as_id ?>"><button type='button' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class='fas fa-info'></i> Detail</button></a> 
                            <a href="<?php echo base_url('Dashboard/Instrumen/ubah/') ?><?php echo $key->instrumen_as_id ?>"><button type='button' class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class='fas fa-edit'></i> Ubah</button></a></td>
                      </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_delete">Delete Pra Manifest</h5>
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

</script> 