<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Jemaah</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Jemaah</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Jemaah</th>
                        <th>Jenis Jemaah</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor Telepon</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      <?php foreach ($DataJemaah as $key): ?>
                      <tr>
                        <?php $no++; ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->nama_jamaah; ?></td>
                        <td><?php echo $key->jenis_jamaah; ?></td>
                        <td><?php if ($key->jenis_kelamin == "L"): ?>
                            Laki - laki
                          <?php else: ?>
                            Perempuan
                        <?php endif ?></td>
                        <td><?php echo $key->nomor_hp; ?></td>
                        <td><a href="<?php echo base_url('Dashboard/ProfileJemaah/update/') ?><?php echo $key->kd_pra_manifest_detail ?>"><button type='button' class='btn btn-warning'><i class='fas fa-edit'></i>Edit</button></a></td>
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