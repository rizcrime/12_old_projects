<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
    <h5>SIPATUH Haji Khusus</h5>
  </div>
	<!-- Begin Page Content -->
        <div class="container-fluid">
          <p class="text-center" id="last_update"></p>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jemaah Berangkat / Tiba</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_berangkat"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jemaah Pulang</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_pulang"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jemaah Sakit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_sakit"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-heart fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jemaah Wafat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_wafat"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
          <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-orange shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">Jemaah Tiba Melalui Madinah</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_tiba_madinah"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-kaaba fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-orange shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-orange   text-uppercase mb-1">Jemaah Tiba Melalui Jeddah</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="jamaah_tiba_jeddah"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-kaaba fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          

          <!-- Content Row -->

          <div class="row">

            <!-- Posisi Jamaah Chart -->
            <div class="col-xl-6 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Posisi Jemaah</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="posisi_jamaah"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#e0e0e0;"></i> Berangkat Tanah Air
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#1cc88a;"></i> Madinah
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#36b9cc;"></i> Jeddah
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#4e73df;"></i> Mekkah
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#990000;"></i> Hotel Transit
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#696969;"></i> Tarwiyah
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#f6c23e;"></i> Kedatangan Arafah
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#cc0033;"></i> Kepulangan Mina
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#9966cc;"></i> Kepulangan dari Arab Saudi
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#cc6600;"></i> Kembali ke Tanah Air
                    </span>

                  </div>
                </div>
              </div>
            </div>

            <!-- Berangkat Pulang Chart -->
            <div class="col-xl-6 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Status Jemaah Berangkat</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="berangkat_belum"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Sudah Berangkat
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Belum Berangkat
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Tabel List Pihk -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Posisi Paket</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="letak_pihk" width="100%" cellspacing="0">
                        <div class="form-group">
                          <thead>
                            <tr>
                              <td>Kode PIHK</td>
                              <td>Nama PIHK</td>
                              <td>Kode Paket</td>
                              <td>Nama Paket</td>
                              <td>Pemberangkatan Ke</td>
                              <td>Jumlah Jemaah</td>
                              <td>Posisi</td>
                            </tr>
                          </thead>
                        </div>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Tabel List Pihk -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Posisi Jemaah</h6>
                  <!-- <a href="<?php echo base_url('Dashboard/Home/export_excel_posisi_jamaah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Posisi Jemaah</a> -->
                  <a href="#" onclick="showModalExport()" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Posisi Jemaah</a>
                  <a href="<?php echo base_url('Dashboard/Home/export_excel_jamaah_berangkat') ?>" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-left: -580px;" ><i class="fas fa-file-excel fa-sm text-white-50"></i> Export Keberangkatan</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="letak_jamaah" width="100%" cellspacing="0">
                        <div class="form-group">
                          <thead>
                            <tr>
                              <td>Kode Porsi</td>
                              <td>Nama Jemaah</td>
                              <td>Jenis Jemaah</td>
                              <td>Nomor HP</td>
                              <td>Posisi</td>
                            </tr>
                          </thead>
                        </div>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <div class="modal fade" id="detail_jemaah" tabindex="-1" role="dialog" aria-labelledby="detail_jemaah" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detail_jemaah">Detail Jemaah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="table_jemaah" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Kode Porsi</th>
                    <th>Nama Jemaah</th>
                    <th>Jenis Jemaah</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="detail_jemaah_wafat" tabindex="-1" role="dialog" aria-labelledby="detail_jemaah_wafat" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detail_jemaah_wafat">Detail Jemaah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="table_jemaah_wafat" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama PIHK</th>
                    <th>Kode Porsi</th>
                    <th>Nama Jemaah</th>
                    <th>Jenis Jemaah</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Lokasi</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="detail_jemaah_sakit" tabindex="-1" role="dialog" aria-labelledby="detail_jemaah_sakit" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detail_jemaah_sakit">Detail Jemaah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered" id="table_jemaah_sakit" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama PIHK</th>
                    <th>Kode Porsi</th>
                    <th>Nama Jemaah</th>
                    <th>Jenis Jemaah</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="export_posisi_jemaah" tabindex="-1" role="dialog" aria-labelledby="export_posisi_jemaah" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="export_posisi_jemaah">Export Posisi Jemaah</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <select class="form-control btn-group" id="pihk">
                <option value="" disabled selected>Pilih</option>
                <?php foreach($pihk as $pihk){
                  echo '<option value="'.$pihk->kd_pihk.'">'.$pihk->pihk.'</option>';
                } ?>
              </select><br><br>
              <button class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" id="tombol_export_modal"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export</button>
            </div>
          </div>
        </div>
      </div>
</body>
</html>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  function showDetail(kd_aktual){
    $("#loader-wrapper").show();
    var detail_jemaah = []
    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/getDetailJemaah') ?>",
        dataType: "JSON",
        data: {kd_aktual: kd_aktual},
        success : function(data)
        {
          $.each(data, function(key, value) {
            detail_jemaah.push([value.kd_porsi, value.nama_jamaah, value.jenis_jamaah]);
          });

          $('#table_jemaah').DataTable().destroy();

          $('#table_jemaah').DataTable({
            data: detail_jemaah
          });

          $("#loader-wrapper").hide();
          $("#detail_jemaah").modal();
        }
    });
  }

  function showDetailWafat(){
    $("#loader-wrapper").show();
    var detail_jemaah_wafat = []
    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/getDetailJemaahWafat') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
        
            var birthday = new Date(value.TGL_LAHIR);
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            var daysDiff = Math.abs(ageDate.getFullYear() - 1970);

            detail_jemaah_wafat.push([value.PIHK, value.KD_PORSI, value.NAMA, "-", "-", daysDiff+" Tahun", value.TMPT_PELAPOR]);
          });

          $('#table_jemaah_wafat').DataTable().destroy();

          $('#table_jemaah_wafat').DataTable({
            data: detail_jemaah_wafat
          });

          $("#loader-wrapper").hide();
          $("#detail_jemaah_wafat").modal();
        }
    });
  }

  function showDetailSakit(){
    $("#loader-wrapper").show();
    var detail_jemaah_sakit = []
    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/countSakit') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            detail_jemaah_sakit.push([value.pihk, value.kd_porsi, value.nama_jamaah, value.jenis_jamaah]);
          });

          $('#table_jemaah_sakit').DataTable().destroy();

          $('#table_jemaah_sakit').DataTable({
            data: detail_jemaah_sakit
          });

          $("#loader-wrapper").hide();
          $("#detail_jemaah_sakit").modal();
        }
    });
  }

  function showModalExport(){
    $("#loader-wrapper").show();
    $("#loader-wrapper").hide();
    $("#export_posisi_jemaah").modal();
  }

  $("#tombol_export_modal").on("click", function(){
    var kd_pihk = $('#pihk').val();
    window.open('<?php echo base_url('Dashboard/Home/export_excel_posisi_jamaah?kd_pihk=') ?>'+kd_pihk);
    $("#export_posisi_jemaah").modal('hide');
  });

  $(document).ready(function(){
    //Ngeload data ketika awal dibuka
    var tanah_air = 0;
    var mekkah = 0;
    var madinah = 0;
    var jeddah = 0;
    var arafah = 0;
    var tarwiyah = 0;
    var mina = 0;
    var pulang_as = 0;
    var pulang = 0;
    var berangkat = 0;
    var belum_berangkat = 0;
    var sakit = 0;
    var wafat = 0;
    var letak_pihk = [];
    var letak_jamaah = [];
    var posisi;
    var tiba = 0;
    var tiba_madinah = 0;
    var tiba_jeddah = 0;

    //Load Data Chart Posisi Jamaah
    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/countBerangkatTanahAir') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            tanah_air = parseInt(value.jumlah);
          });

          $.ajax({ 
            type: "POST",   
              url: "<?php echo base_url('Dashboard/home/countMekkah') ?>",
              dataType: "JSON",
              success : function(data)
              {
                $.each(data, function(key, value) {
                  mekkah = parseInt(value.jumlah);
                });

                $.ajax({ 
                  type: "POST",   
                    url: "<?php echo base_url('Dashboard/home/countMadinah') ?>",
                    dataType: "JSON",
                    success : function(data)
                    {
                      $.each(data, function(key, value) {
                        madinah = parseInt(value.jumlah);
                      });
                      $.ajax({ 
                        type: "POST",   
                          url: "<?php echo base_url('Dashboard/home/countJeddah') ?>",
                          dataType: "JSON",
                          success : function(data)
                          {
                            $.each(data, function(key, value) {
                              jeddah = parseInt(value.jumlah);
                            });
                            $.ajax({ 
                              type: "POST",   
                                url: "<?php echo base_url('Dashboard/home/countTarwiyah') ?>",
                                dataType: "JSON",
                                success : function(data)
                                {
                                  $.each(data, function(key, value) {
                                    tarwiyah = parseInt(value.jumlah);
                                  });
                                  $.ajax({ 
                                    type: "POST",   
                                      url: "<?php echo base_url('Dashboard/home/countArafah') ?>",
                                      dataType: "JSON",
                                      success : function(data)
                                      {
                                        $.each(data, function(key, value) {
                                          arafah = parseInt(value.jumlah);
                                        });
                                        $.ajax({ 
                                          type: "POST",   
                                            url: "<?php echo base_url('Dashboard/home/countMina') ?>",
                                            dataType: "JSON",
                                            success : function(data)
                                            {
                                              $.each(data, function(key, value) {
                                                mina = parseInt(value.jumlah);
                                              });
                                              $.ajax({ 
                                                type: "POST",   
                                                  url: "<?php echo base_url('Dashboard/home/countPulangas') ?>",
                                                  dataType: "JSON",
                                                  success : function(data)
                                                  {
                                                    $.each(data, function(key, value) {
                                                      pulang_as = parseInt(value.jumlah);
                                                    });
                                                    $.ajax({ 
                                                      type: "POST",   
                                                        url: "<?php echo base_url('Dashboard/home/countPulang') ?>",
                                                        dataType: "JSON",
                                                        success : function(data)
                                                        {
                                                          $.each(data, function(key, value) {
                                                            pulang = parseInt(value.jumlah);
                                                          });
                                                          $.ajax({ 
                                                            type: "POST",   
                                                              url: "<?php echo base_url('Dashboard/home/countTransit') ?>",
                                                              dataType: "JSON",
                                                              success : function(data)
                                                              {
                                                                $.each(data, function(key, value) {
                                                                  transit = parseInt(value.jumlah);
                                                                });
                                                                var ctx = document.getElementById("posisi_jamaah");
                                                                var myPieChart = new Chart(ctx, {
                                                                  type: 'doughnut',
                                                                  data: {
                                                                    labels: ["Berangkat Tanah Air", "Madinah", "Jeddah", "Mekkah", "Hotel Transit", "Tarwiyah", "Arafah", "Mina", "Kepulangan Arab Saudi", "Kembali ke Tanah Air"],
                                                                    datasets: [{
                                                                      data: [tanah_air, madinah, jeddah, mekkah, transit, tarwiyah, arafah, mina, pulang_as, pulang],
                                                                      backgroundColor: ['#e0e0e0', '#1cc88a', '#36b9cc', '#4e73df', '#990000', '#696969', '#f6c23e', '#cc0033', '#9966cc', '#cc6600'],
                                                                      hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                                    }],
                                                                  },
                                                                  options: {
                                                                    maintainAspectRatio: false,
                                                                    tooltips: {
                                                                      backgroundColor: "rgb(255,255,255)",
                                                                      bodyFontColor: "#858796",
                                                                      borderColor: '#dddfeb',
                                                                      borderWidth: 1,
                                                                      xPadding: 15,
                                                                      yPadding: 15,
                                                                      displayColors: false,
                                                                      caretPadding: 10,
                                                                    },
                                                                    legend: {
                                                                      display: false
                                                                    },
                                                                    // cutoutPercentage: 80,
                                                                  },
                                                                });
                                                                document.getElementById("jamaah_pulang").innerHTML = pulang+" Jemaah";
                                                                document.getElementById("last_update").innerHTML = "Last Update : "+Date(Date.now());

                                                                $.ajax({ 
                                                                  type: "POST",   
                                                                    url: "<?php echo base_url('Dashboard/home/countBelumBerangkat') ?>",
                                                                    dataType: "JSON",
                                                                    success : function(data)
                                                                    {
                                                                      $.each(data, function(key, value) {
                                                                        belum_berangkat = parseInt(value.jumlah);
                                                                      });
                                                                      $.ajax({ 
                                                                      type: "POST",   
                                                                        url: "<?php echo base_url('Dashboard/home/countBerangkat') ?>",
                                                                        dataType: "JSON",
                                                                        success : function(data)
                                                                        {
                                                                          $.each(data, function(key, value) {
                                                                            berangkat = parseInt(value.jumlah);
                                                                          });
                                                                          var ctx = document.getElementById("berangkat_belum");
                                                                          var myPieChart = new Chart(ctx, {
                                                                            type: 'doughnut',
                                                                            data: {
                                                                              labels: ["Sudah Berangkat", "Belum Berangkat"],
                                                                              datasets: [{
                                                                                data: [berangkat, belum_berangkat],
                                                                                backgroundColor: ['#4e73df', '#1cc88a'],
                                                                                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                                                                                hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                                              }],
                                                                            },
                                                                            options: {
                                                                              maintainAspectRatio: false,
                                                                              tooltips: {
                                                                                backgroundColor: "rgb(255,255,255)",
                                                                                bodyFontColor: "#858796",
                                                                                borderColor: '#dddfeb',
                                                                                borderWidth: 1,
                                                                                xPadding: 15,
                                                                                yPadding: 15,
                                                                                displayColors: false,
                                                                                caretPadding: 10,
                                                                              },
                                                                              legend: {
                                                                                display: false
                                                                              },
                                                                              // cutoutPercentage: 80,
                                                                            },
                                                                          });

                                                                          $.ajax({ 
                                                                            type: "POST",   
                                                                              url: "<?php echo base_url('Dashboard/home/getTibaMadinah') ?>",
                                                                              dataType: "JSON",
                                                                              success : function(data)
                                                                              {
                                                                                $.each(data, function(key, value) {
                                                                                  tiba_madinah = value.jumlah;
                                                                                  document.getElementById("jamaah_tiba_madinah").innerHTML = tiba_madinah+" Jemaah";
                                                                                });

                                                                                $.ajax({ 
                                                                                  type: "POST",   
                                                                                    url: "<?php echo base_url('Dashboard/home/getTibaJeddah') ?>",
                                                                                    dataType: "JSON",
                                                                                    success : function(data)
                                                                                    {
                                                                                      $.each(data, function(key, value) {
                                                                                        tiba_jeddah = value.jumlah;
                                                                                        document.getElementById("jamaah_tiba_jeddah").innerHTML = tiba_jeddah+" Jemaah";
                                                                                      });

                                                                                      tiba = parseInt(tiba_madinah)+parseInt(tiba_jeddah);
                                                                                      document.getElementById("jamaah_berangkat").innerHTML = berangkat+" / "+tiba+" Jemaah";
                                                                                      
                                                                                    }
                                                                                });
                                                                                
                                                                              }
                                                                          });

                                                                        }
                                                                    });
                                                                    }
                                                                });

                                                                $("#loader-wrapper").hide();
                                                              }
                                                          });
                                                        }
                                                    });
                                                  }
                                              });
                                            }
                                        });
                                      }
                                  });
                                }
                            });
                          }
                      });
                    }
                });
              }
          });
        }
    });

    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/countSakit') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            sakit++;
          });
          document.getElementById("jamaah_sakit").innerHTML = '<a href="#" onclick="showDetailSakit();" class="text-gray-800">'+sakit+' Jemaah</a>';
        }
    });

    $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/countWafat') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            wafat++;
          });
          document.getElementById("jamaah_wafat").innerHTML = '<a href="#" onclick="showDetailWafat();" class="text-gray-800">'+wafat+' Jemaah</a>';
        }
    });

    //Load Server Side Table Posisi Paket
    $('#letak_pihk').DataTable({
      "processing": true, 
      "serverSide": true, 
      "order": [],
      "ajax": {
        "url": "<?php echo base_url('Dashboard/home/getBerangkat') ?>",
        "type": "POST"
      },
      "columnDefs": [
        { 
          "targets": [ 0 ], 
          "orderable": false, 
        },
      ],
    });

    //Load Server Side Table Posisi Jamaah
    $('#letak_jamaah').DataTable({
      "processing": true, 
      "serverSide": true, 
      "order": [],
      "ajax": {
        "url": "<?php echo base_url('Dashboard/home/getPosisiJamaah') ?>",
        "type": "POST"
      },
      "columnDefs": [
        { 
          "targets": [ 0 ], 
          "orderable": false, 
        },
      ],
    });

    //Untuk auto refresh
    setInterval(function(){
      var tanah_air = 0;
      var mekkah = 0;
      var madinah = 0;
      var jeddah = 0;
      var arafah = 0;
      var tarwiyah = 0;
      var mina = 0;
      var pulang_as = 0;
      var pulang = 0;
      var berangkat = 0;
      var belum_berangkat = 0;
      var sakit = 0;
      var wafat = 0;
      var letak_pihk = [];
      var letak_jamaah = [];
      var posisi;
      var tiba = 0;
      var tiba_madinah = 0;
      var tiba_jeddah = 0;

      //Load Data Chart Posisi Jamaah
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/home/countBerangkatTanahAir') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              tanah_air = parseInt(value.jumlah);
            });
            $.ajax({ 
              type: "POST",   
                url: "<?php echo base_url('Dashboard/home/countMekkah') ?>",
                dataType: "JSON",
                success : function(data)
                {
                  $.each(data, function(key, value) {
                    mekkah = parseInt(value.jumlah);
                  });
                  $.ajax({ 
                    type: "POST",   
                      url: "<?php echo base_url('Dashboard/home/countMadinah') ?>",
                      dataType: "JSON",
                      success : function(data)
                      {
                        $.each(data, function(key, value) {
                          madinah = parseInt(value.jumlah);
                        });
                        $.ajax({ 
                          type: "POST",   
                            url: "<?php echo base_url('Dashboard/home/countJeddah') ?>",
                            dataType: "JSON",
                            success : function(data)
                            {
                              $.each(data, function(key, value) {
                                jeddah = parseInt(value.jumlah);
                              });
                              $.ajax({ 
                                type: "POST",   
                                  url: "<?php echo base_url('Dashboard/home/countTarwiyah') ?>",
                                  dataType: "JSON",
                                  success : function(data)
                                  {
                                    $.each(data, function(key, value) {
                                      tarwiyah = parseInt(value.jumlah);
                                    });
                                    $.ajax({ 
                                      type: "POST",   
                                        url: "<?php echo base_url('Dashboard/home/countArafah') ?>",
                                        dataType: "JSON",
                                        success : function(data)
                                        {
                                          $.each(data, function(key, value) {
                                            arafah = parseInt(value.jumlah);
                                          });
                                          $.ajax({ 
                                            type: "POST",   
                                              url: "<?php echo base_url('Dashboard/home/countMina') ?>",
                                              dataType: "JSON",
                                              success : function(data)
                                              {
                                                $.each(data, function(key, value) {
                                                  mina = parseInt(value.jumlah);
                                                });
                                                $.ajax({ 
                                                  type: "POST",   
                                                    url: "<?php echo base_url('Dashboard/home/countPulangas') ?>",
                                                    dataType: "JSON",
                                                    success : function(data)
                                                    {
                                                      $.each(data, function(key, value) {
                                                        pulang_as = parseInt(value.jumlah);
                                                      });
                                                      $.ajax({ 
                                                        type: "POST",   
                                                          url: "<?php echo base_url('Dashboard/home/countPulang') ?>",
                                                          dataType: "JSON",
                                                          success : function(data)
                                                          {
                                                            $.each(data, function(key, value) {
                                                              pulang = parseInt(value.jumlah);
                                                            });
                                                            $.ajax({ 
                                                              type: "POST",   
                                                                url: "<?php echo base_url('Dashboard/home/countTransit') ?>",
                                                                dataType: "JSON",
                                                                success : function(data)
                                                                {
                                                                  $.each(data, function(key, value) {
                                                                    transit = parseInt(value.jumlah);
                                                                  });
                                                                  var ctx = document.getElementById("posisi_jamaah");
                                                                  var myPieChart = new Chart(ctx, {
                                                                    type: 'doughnut',
                                                                    data: {
                                                                      labels: ["Berangkat Tanah Air", "Madinah", "Jeddah", "Mekkah", "Hotel Transit", "Tarwiyah", "Arafah", "Mina", "Kepulangan Arab Saudi", "Kembali ke Tanah Air"],
                                                                      datasets: [{
                                                                        data: [tanah_air, madinah, jeddah, mekkah, transit, tarwiyah, arafah, mina, pulang_as, pulang],
                                                                        backgroundColor: ['#e0e0e0', '#1cc88a', '#36b9cc', '#4e73df', '#990000', '#696969', '#f6c23e', '#cc0033', '#9966cc', '#cc6600'],
                                                                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                                      }],
                                                                    },
                                                                    options: {
                                                                      maintainAspectRatio: false,
                                                                      tooltips: {
                                                                        backgroundColor: "rgb(255,255,255)",
                                                                        bodyFontColor: "#858796",
                                                                        borderColor: '#dddfeb',
                                                                        borderWidth: 1,
                                                                        xPadding: 15,
                                                                        yPadding: 15,
                                                                        displayColors: false,
                                                                        caretPadding: 10,
                                                                      },
                                                                      legend: {
                                                                        display: false
                                                                      },
                                                                      // cutoutPercentage: 80,
                                                                    },
                                                                  });
                                                                  document.getElementById("jamaah_pulang").innerHTML = pulang+" Jemaah";
                                                                  document.getElementById("last_update").innerHTML = "Last Update : "+Date(Date.now());

                                                                  $.ajax({ 
                                                                    type: "POST",   
                                                                      url: "<?php echo base_url('Dashboard/home/countBelumBerangkat') ?>",
                                                                      dataType: "JSON",
                                                                      success : function(data)
                                                                      {
                                                                        $.each(data, function(key, value) {
                                                                          belum_berangkat = parseInt(value.jumlah);
                                                                        });
                                                                        $.ajax({ 
                                                                          type: "POST",   
                                                                            url: "<?php echo base_url('Dashboard/home/countBerangkat') ?>",
                                                                            dataType: "JSON",
                                                                            success : function(data)
                                                                            {
                                                                              $.each(data, function(key, value) {
                                                                                berangkat = parseInt(value.jumlah);
                                                                              });
                                                                              var ctx = document.getElementById("berangkat_belum");
                                                                              var myPieChart = new Chart(ctx, {
                                                                                type: 'doughnut',
                                                                                data: {
                                                                                  labels: ["Sudah Berangkat", "Belum Berangkat"],
                                                                                  datasets: [{
                                                                                    data: [berangkat, belum_berangkat],
                                                                                    backgroundColor: ['#4e73df', '#1cc88a'],
                                                                                    hoverBackgroundColor: ['#2e59d9', '#17a673'],
                                                                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                                                  }],
                                                                                },
                                                                                options: {
                                                                                  maintainAspectRatio: false,
                                                                                  tooltips: {
                                                                                    backgroundColor: "rgb(255,255,255)",
                                                                                    bodyFontColor: "#858796",
                                                                                    borderColor: '#dddfeb',
                                                                                    borderWidth: 1,
                                                                                    xPadding: 15,
                                                                                    yPadding: 15,
                                                                                    displayColors: false,
                                                                                    caretPadding: 10,
                                                                                  },
                                                                                  legend: {
                                                                                    display: false
                                                                                  },
                                                                                  // cutoutPercentage: 80,
                                                                                },
                                                                              });

                                                                              $.ajax({ 
                                                                                type: "POST",   
                                                                                  url: "<?php echo base_url('Dashboard/home/getTibaMadinah') ?>",
                                                                                  dataType: "JSON",
                                                                                  success : function(data)
                                                                                  {
                                                                                    $.each(data, function(key, value) {
                                                                                      tiba_madinah = value.jumlah;
                                                                                      document.getElementById("jamaah_tiba_madinah").innerHTML = tiba_madinah+" Jemaah";
                                                                                    });

                                                                                    $.ajax({ 
                                                                                      type: "POST",   
                                                                                        url: "<?php echo base_url('Dashboard/home/getTibaJeddah') ?>",
                                                                                        dataType: "JSON",
                                                                                        success : function(data)
                                                                                        {
                                                                                          $.each(data, function(key, value) {
                                                                                            tiba_jeddah = value.jumlah;
                                                                                            document.getElementById("jamaah_tiba_jeddah").innerHTML = tiba_jeddah+" Jemaah";
                                                                                          });

                                                                                          tiba = parseInt(tiba_madinah)+parseInt(tiba_jeddah);
                                                                                          document.getElementById("jamaah_berangkat").innerHTML = berangkat+" / "+tiba+" Jemaah";
                                                                                          
                                                                                        }
                                                                                    });
                                                                                    
                                                                                  }
                                                                              });

                                                                            }
                                                                        });
                                                                      }
                                                                  });
                                                                }
                                                            });
                                                          }
                                                      });
                                                    }
                                                });
                                              }
                                          });
                                        }
                                    });
                                  }
                              });
                            }
                        });
                      }
                  });
                }
            });
          }
      });

      $.ajax({ 
      type: "POST",   
        url: "<?php echo base_url('Dashboard/home/countSakit') ?>",
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            sakit++;
          });
          document.getElementById("jamaah_sakit").innerHTML = '<a href="#" onclick="showDetailSakit();" class="text-gray-800">'+sakit+' Jemaah</a>';
        }
    });

      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/home/countWafat') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              wafat++;
            });
            document.getElementById("jamaah_wafat").innerHTML = '<a href="#" onclick="showDetailWafat();" class="text-gray-800">'+wafat+' Jemaah</a>';
          }
      });

      //Destroy and Load Server Side Table Posisi Paket
      $('#letak_pihk').DataTable().destroy();

      $('#letak_pihk').DataTable({
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
          "url": "<?php echo base_url('Dashboard/home/getBerangkat') ?>",
          "type": "POST"
        },
        "columnDefs": [
          { 
            "targets": [ 0 ], 
            "orderable": false, 
          },
        ],
      });

      //Destroy and Load Server Side Table Posisi Jamaah
      $('#letak_jamaah').DataTable().destroy();

      $('#letak_jamaah').DataTable({
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
          "url": "<?php echo base_url('Dashboard/home/getPosisiJamaah') ?>",
          "type": "POST"
        },
        "columnDefs": [
          { 
            "targets": [ 0 ], 
            "orderable": false, 
          },
        ],
      });
      
    }, 600000);

  });

</script>

<!-- Page level plugins -->
<!-- <script src="<?php echo base_url('assets/chart.js/Chart.min.js') ?>"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url('js/demo/chart-area-demo.js') ?>"></script>
<script src="<?php echo base_url('js/demo/chart-pie-demo.js') ?>"></script> -->

