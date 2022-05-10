<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Pra Manifest</h1>
          <p class="mb-4">Detail Pra Manifest merupakan tampilan dari Pra Manifest yang dipilih.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Pra Manifest </h6>
            </div>
            <div class="card-body">
              <?php foreach ($data_pramanifest as $data_pramanifest) { ?>
                <a href="<?php echo base_url('Dashboard/pramanifest/export?pramanifest=').$data_pramanifest->kd_pra_manifest.'&paket='.$data_pramanifest->kd_paket ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>

              <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                  <th>Tahun</th>
                  <th>Kode PIHK</th>
                  <th>Kode Paket</th>
                  <th>Pemberangkatan Ke</th>
                </tr>
                <tr>
                  <td><?php echo $data_pramanifest->kd_tahun; ?></td>
                  <td><?php echo $data_pramanifest->kd_pihk; ?></td>
                  <td><?php echo $data_pramanifest->kd_paket; ?></td>
                  <td><?php echo $data_pramanifest->pemberangkatan_ke; ?></td>
                </tr>
              </table>
                

              <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th><h3><b>Keberangkatan</b></h3></th>
                  <th width="50%"><h3><b>Kepulangan</b></h3></th>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo  Msconfig_generator($data_pramanifest->bandara_brkt); ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo  Msconfig_generator($data_pramanifest->bandara_pulang); ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Airline Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->nm_airline_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Airline Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->nm_airline_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. Flight Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->no_flight_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. Flight Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->no_flight_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo date('d/m/Y', strtotime($data_pramanifest->tanggal_berangkat)); ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                    <div class="form-group" style="margin-right: -30px;">
                        <label class="col-lg-9"><b>Tanggal Pulang 1</b></label>
                        <div class="col-lg-10">
                          <p><?php echo date('d/m/Y', strtotime($data_pramanifest->tanggal_pulang_1)); ?></p>
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: -30px;">
                        <label class="col-lg-9"><b>Tanggal Pulang 2</b></label>
                        <div class="col-lg-10">
                          <?php
                          if ($data_pramanifest->tanggal_pulang_2 != NULL) {
                            $tanggal_pulang_2 = date('d/m/Y', strtotime($data_pramanifest->tanggal_pulang_2));
                          }else{
                            $tanggal_pulang_2 = '';
                          }
                          ?>
                          <p><?php echo $tanggal_pulang_2; ?></p>
                        </div>
                    </div>
                    <div class="form-group" style="margin-right: -30px;">
                        <label class="col-lg-9"><b>Tanggal Pulang 3</b></label>
                        <div class="col-lg-10">
                          <?php
                          if ($data_pramanifest->tanggal_pulang_3 != NULL) {
                            $tanggal_pulang_3 = date('d/m/Y', strtotime($data_pramanifest->tanggal_pulang_3));
                          }else{
                            $tanggal_pulang_3 = '';
                          }
                          ?>
                          <p><?php echo $tanggal_pulang_3; ?></p>
                        </div>
                    </div>
                  </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label class="col-lg-9"><b>Waktu Berangkat</b></label>
                    <div class="col-lg-9">
                      <p><?php echo $data_pramanifest->waktu_berangkat; ?></p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Waktu Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->waktu_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Jenis Penerbangan Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->jenis_penerbangan_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Jenis Penerbangan Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->jenis_penerbangan_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Transit Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->bandara_transit_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Transit Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->bandara_transit_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Airline Transit Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->nm_airline_transit_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Airline Transit Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->nm_airline_transit_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. Flight Transit Berangkat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->no_flight_transit_brkt; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. Flight Transit Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_pramanifest->no_flight_transit_pulang; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Tujuan Arab Saudi</b></label>
                      <div class="col-lg-9">
                        <p><?php echo Msconfig_generator($data_pramanifest->bandara_tujuan_as); ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Bandara Tujuan Pulang</b></label>
                      <div class="col-lg-9">
                        <p><?php echo  Msconfig_generator($data_pramanifest->bandara_tujuan_pulang); ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            <?php } ?>

              <table class="table table-bordered" id="list_jamaah" width="100%" cellspacing="0">
                  <div class="form-group">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>Nomor Porsi</td>
                        <td>Nama Jamaah</td>
                        <td>Jenis Jamaah</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $a = 1;
                    foreach($data_pramanifest_detail as $data_pramanifest_detail){ 
                      ?>
                      <tr>
                        <td><?php echo $a; ?></td>
                        <td><?php echo $data_pramanifest_detail->kd_porsi ?></td>
                        <td><?php echo $data_pramanifest_detail->nama_jamaah ?></td>
                        <td><?php echo $data_pramanifest_detail->jenis_jamaah ?></td>
                      </tr>
                    <?php 
                    $a++;
                  } ?>
                  </tbody>
                  </div>
              </table>
            	
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
</body>
</html>
<script>
  $(document).ready(function(){
    $('#list_jamaah').DataTable( {
      "order": [[ 2, "asc" ]]
    });
  });
</script>