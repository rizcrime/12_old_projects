<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
    <h5>SIPATUH Haji Khusus</h5>
  </div>
	<!-- Begin Page Content -->
        <div class="container-fluid">
          <p class="text-center" id="last_update"></p>
          <!-- Profil PIHK -->
            <div class="col-xl-12 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Profil PIHK</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <center>
                  <img class="col-md-2 mb-2" src="<?php echo base_url('assets/img/logo-kementrian-agama.jpg') ?>">
                  <h6 class="m-0 font-weight-bold" id="kode_pihk"></h6>
                  <h6 class="m-0 font-weight-bold" id="nama_pihk"></h6>
                  <h6 class="m-0 font-weight-bold" id="alamat_pihk"></h6>
                  <h6 class="m-0 font-weight-bold" id="no_telp"></h6>
                </center>
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
                  <h6 class="m-0 font-weight-bold text-primary">Posisi Jamaah</h6>
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
                  <h6 class="m-0 font-weight-bold text-primary">Status Jamaah Berangkat</h6>
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
                  <h6 class="m-0 font-weight-bold text-primary">Posisi Jamaah</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="letak_jamaah" width="100%" cellspacing="0">
                        <div class="form-group">
                          <thead>
                            <tr>
                              <td>Kode Porsi</td>
                              <td>Nama Jamaah</td>
                              <td>Jenis Jamaah</td>
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
                                                                document.getElementById("last_update").innerHTML = "Last Update : "+Date(Date.now());
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
                document.getElementById("jamaah_berangkat").innerHTML = berangkat+" Jamaah";
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
          document.getElementById("jamaah_sakit").innerHTML = sakit+" Jamaah";
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
          document.getElementById("jamaah_wafat").innerHTML = wafat+" Jamaah";
        }
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

      //Load Data Chart Posisi Jamaah
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/home/countBerangkatTanahAir') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              tanah_ai = parseInt(value.jumlah);
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
                                                                  document.getElementById("last_update").innerHTML = "Last Update : "+Date(Date.now());
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
                  document.getElementById("jamaah_berangkat").innerHTML = berangkat+" Jamaah";
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
            document.getElementById("jamaah_sakit").innerHTML = sakit+" Jamaah";
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
            document.getElementById("jamaah_wafat").innerHTML = wafat+" Jamaah";
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
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/home/profilPIHK') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              document.getElementById("kode_pihk").innerHTML = value.kd_pihk;
              document.getElementById("nama_pihk").innerHTML = value.pihk;
              document.getElementById("alamat_pihk").innerHTML = value.alamat;
              document.getElementById("no_telp").innerHTML = value.no_telp;
            });
          }
      });

  });

</script>

<!-- Page level plugins -->
<!-- <script src="<?php echo base_url('assets/chart.js/Chart.min.js') ?>"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url('js/demo/chart-area-demo.js') ?>"></script>
<script src="<?php echo base_url('js/demo/chart-pie-demo.js') ?>"></script> -->

