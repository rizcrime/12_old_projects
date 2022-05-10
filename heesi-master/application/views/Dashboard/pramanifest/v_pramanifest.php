<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
    <h5>SIPATUH Haji Khusus</h5>
  </div>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Pra Manifest</h1>
          <p class="mb-4">Data Pra Manifest merupakan tampilan seluruh Pra Manifest yang terdaftar</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pra Manifest</h6>
            </div>
            <div class="card-body">
              <?php
                if($this->session->userdata('kd_pihk') != 'super_monitoring'){
              ?>
              
            	 <!-- <a href="<?php echo base_url('Dashboard/pramanifest/tambah_pramanifest') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pra Manifest</a> -->
               <!-- <a href="Pramanifest/import" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="color: white;"><i class="fas fa-upload fa-sm text-white-50" id="tombol-import"></i> Upload Pra Manifest</a> -->
               <br>
               <!-- <br><h6>Jumlah PIHK : <a href="#" onclick="showDetail();"><?php echo $count_pihk ?></a></h6><br> -->
              
              <?php 
                }elseif($this->session->userdata('kd_pihk') == 'super_monitoring'){
              ?>
                  <a href="<?php echo base_url('Dashboard/pramanifest/export_all') ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Seluruh Pra Manifest</a>

                  <h6>Jumlah PIHK : <a href="#" onclick="showDetail();"><?php echo $count_pihk ?></a></h6><br>
              <?php
                }
              ?>
              <div class="table-responsive">
                <?php
                  if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin') {
                ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode PIHK</th>
                        <th>Nama PIHK</th>
                        <th>Kode Paket</th>
                        <th>Kode Tahun</th>
                        <th>Pemberangkatan Ke -</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        for ($i=0; $i < count($data_pramanifest); $i++) {
                          ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_pihk']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['pihk']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_paket']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_tahun']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['pemberangkatan_ke']; ?></td>
                            <td>
                              <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) {
                                echo "Berangkat";
                              }else{
                                echo "Belum Berangkat";
                              } ?> 
                            </td>
                            <td><a href="pramanifest/detail_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a> 
                              <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) { ?>
                                <a href="pramanifest/edit_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm disabled"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a> 
                                <button value="<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_pramanifest" disabled data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
                              <?php }else{ ?>
                                <a href="pramanifest/edit_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a> 
                                <button value="<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_pramanifest" data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode PIHK</th>
                        <th>Nama PIHK</th>
                        <th>Kode Paket</th>
                        <th>Kode Tahun</th>
                        <th>Pemberangkatan Ke -</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        for ($i=0; $i < count($data_pramanifest); $i++) {
                          ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_pihk']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['pihk']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_paket']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_tahun']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['pemberangkatan_ke']; ?></td>
                            <td>
                              <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) {
                                echo "Berangkat";
                              }else{
                                echo "Belum Berangkat";
                              } ?> 
                            </td>
                            <td><a href="pramanifest/detail_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a> 
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
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Paket</th>
                        <th>Kode Tahun</th>
                        <th>Pemberangkatan Ke -</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no = 1;
                        for ($i=0; $i < count($data_pramanifest); $i++) {
                          ?>
                          <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_paket']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['kd_tahun']; ?></td>
                            <td><?php echo $data_pramanifest[$i]['pemberangkatan_ke']; ?></td>
                            <td>
                              <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) {
                                echo "Berangkat";
                              }else{
                                echo "Belum Berangkat";
                              } ?> 
                            </td>
                            <td><a href="pramanifest/detail_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a> 
                              <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) { ?>
                                <a href="pramanifest/edit_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm disabled"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a> 
                                <button value="<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_pramanifest" disabled data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
                              <?php }else{ ?>
                                <a href="pramanifest/edit_pramanifest/<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a> 
                                <button value="<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>" type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm del_pramanifest" data-toggle="modal" data-target="#delete"><i class="fas fa-trash fa-sm text-white-50"></i>Delete</button>
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

      <div class="modal fade" id="detail_pihk" tabindex="-1" role="dialog" aria-labelledby="detail_pihk" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detail_pihk">Detail PIHK</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="table_list_pihk" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Kode PIHK</th>
                    <th>Nama PIHK</th>
                    <th>Jumlah Pra Manifest</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($all_counted_pihk as $all_counted_pihk) {
                  ?>
                      <tr>
                        <td><?php echo $all_counted_pihk->kd_pihk ?></td>
                        <td><?php echo $all_counted_pihk->pihk ?></td>
                        <td><?php echo $all_counted_pihk->jumlah ?></td>
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
	
</body>
</html>

<script>
  var kode_pramanifest;

  $(document).ready(function(){
    $("#loader-wrapper").hide();
  });

  $('#table_list_pihk').DataTable();

  $('.del_pramanifest').on('click', function(){
    kode_pramanifest = $(this).val();
  });

  $('#btn_delete').on('click', function(){
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('Dashboard/Pramanifest/delete_pramanifest')?>",
        dataType : "JSON",
        data : {kode_pramanifest:kode_pramanifest},
        success : function(data)
          {
            $('#delete').modal('hide');
            location = "<?php echo base_url('Dashboard/Pramanifest') ?>";
          }
    }); 
  }); 

  function showDetail(){
    $("#detail_pihk").modal();
  }
</script>