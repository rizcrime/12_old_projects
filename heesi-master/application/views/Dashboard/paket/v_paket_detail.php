<html>
<body>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Paket</h1>
          <p class="mb-4">Detail Paket merupakan tampilan dari Paket yang dipilih.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Paket</h6>
            </div>
            <div class="card-body">
              <?php foreach ($data_paket as $data_paket) { ?>
              <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th><h3><b>Data Paket</b></h3></th>
                <tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Nama Paket</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->nama_paket; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tahun</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->kode_tahun; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                        <label class="col-lg-9"><b>Jenis Paket</b></label>
                        <div class="col-lg-9">
                          <p><?php echo $data_paket->jenis_paket; ?></p>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Program Paket</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->program_paket; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP Pengurus</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_3; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP Pembimbing</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_2; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP Dokter</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_1; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>

              <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th colspan="3"><h3><b>Hotel, Akomodasi, dan Syarikah</b></h3></th>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Hotel Mekkah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->akomodasi_1; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Masuk</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_masuk_mekkah != NULL) {
                            $tgl_masuk_mekkah = date('m/d/Y', strtotime($data_paket->tgl_masuk_mekkah));
                          }else{
                            $tgl_masuk_mekkah = '';
                          }
                        ?>
                        <p><?php echo $tgl_masuk_mekkah; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Keluar</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_keluar_mekkah != NULL) {
                            $tgl_keluar_mekkah = date('m/d/Y', strtotime($data_paket->tgl_keluar_mekkah));
                          }else{
                            $tgl_keluar_mekkah = '';
                          }
                        ?>
                        <p><?php echo $tgl_keluar_mekkah; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <label class="col-lg-9"><b>Hari</b></label>
                        <div class="col-lg-9">
                          <p><?php echo $data_paket->h_akomodasi_1; ?></p>
                        </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Konsumsi Mekkah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->komsumsi_1; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Hotel Madinah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->akomodasi_2; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Masuk</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_masuk_madinah != NULL) {
                            $tgl_masuk_madinah = date('m/d/Y', strtotime($data_paket->tgl_masuk_madinah));
                          }else{
                            $tgl_masuk_madinah = '';
                          }
                        ?>
                        <p><?php echo $tgl_masuk_madinah; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Keluar</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_keluar_madinah != NULL) {
                            $tgl_keluar_madinah = date('m/d/Y', strtotime($data_paket->tgl_keluar_madinah));
                          }else{
                            $tgl_keluar_madinah = '';
                          }
                        ?>
                        <p><?php echo $tgl_keluar_madinah; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <label class="col-lg-9"><b>Hari</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->h_akomodasi_2; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Konsumsi Madinah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->komsumsi_2; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Maktab Armuzna</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->h_akomodasi_8; ?></p>
                      </div>
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label class="col-lg-9"><b>Konsumsi Armuzna</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->komsumsi_3; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Hotel Jeddah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->akomodasi_3; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <label class="col-lg-9"><b>Tanggal Masuk</b></label>
                        <div class="col-lg-9">
                          <?php
                          if ($data_paket->tgl_masuk_jeddah != NULL) {
                            $tgl_masuk_jeddah = date('m/d/Y', strtotime($data_paket->tgl_masuk_jeddah));
                          }else{
                            $tgl_masuk_jeddah = '';
                          }
                        ?>
                        <p><?php echo $tgl_masuk_jeddah; ?></p>
                        </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Keluar</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_keluar_jeddah != NULL) {
                            $tgl_keluar_jeddah = date('m/d/Y', strtotime($data_paket->tgl_keluar_jeddah));
                          }else{
                            $tgl_keluar_jeddah = '';
                          }
                        ?>
                        <p><?php echo $tgl_keluar_jeddah; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Hari</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->h_akomodasi_3; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Konsumsi Jeddah</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->komsumsi_4; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="form-group">
                      <label class="col-lg-9"><b>Syarikah Transportasi</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->transport; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>

              <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th><h3><b>Transit</b></h3></th>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Hotel Transit</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hotel_transit; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Masuk</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_masuk_transit != NULL) {
                            $tgl_masuk_transit = date('m/d/Y', strtotime($data_paket->tgl_masuk_transit));
                          }else{
                            $tgl_masuk_transit = '';
                          }
                        ?>
                        <p><?php echo $tgl_masuk_transit; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Kapasitas Kamar</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->kapasitas_kamar_transit; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Tanggal Keluar</b></label>
                      <div class="col-lg-9">
                        <?php
                          if ($data_paket->tgl_keluar_transit != NULL) {
                            $tgl_keluar_transit = date('m/d/Y', strtotime($data_paket->tgl_keluar_transit));
                          }else{
                            $tgl_keluar_transit = '';
                          }
                        ?>
                        <p><?php echo $tgl_keluar_transit; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Alamat</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->alamat_hotel_transit; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>

              <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th colspan="2"><h3><b>Mutawif dan Harga Paket</b></h3></th>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Mutawif 1</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->petugas_as_1; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_as_1; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Mutawif 2</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->petugas_as_2; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_as_2; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Mutawif 3</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->petugas_as_3; ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>No. HP</b></label>
                      <div class="col-lg-9">
                        <p><?php echo $data_paket->hp_petugas_as_3; ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label class="col-lg-9"><b>Harga Double</b></label>
                      <div class="col-lg-9">
                        <p><?php echo Usd($data_paket->harga_double); ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group-row">
                      <label class="col-lg-9"><b>Harga Triple</b></label>
                      <div class="col-lg-9">
                        <p><?php echo Usd($data_paket->harga_triple); ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group-row">
                      <label class="col-lg-9"><b>Harga Quadra</b></label>
                      <div class="col-lg-9">
                        <p><?php echo Usd($data_paket->harga_quadra); ?></p>
                      </div>
                    </div>
                  </td>
                </tr>
                
              </table>

            	<?php } ?>
            </div>
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
</body>
</html>
