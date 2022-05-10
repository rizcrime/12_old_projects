<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
  </div>
  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Filter Data</h1>
          <p class="mb-4">Filter Data merupakan tampilan data dengan filtering tertentu</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
            </div>
        <ul class="nav nav-tabs  m-tabs-line" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active step-type-select-id" id="berangkat" data-toggle="tab" data-id='0' href="#m_tabs_1_1" role="tab">Tanggal Berangkat</a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link step-type-select-id" id="pulang" data-toggle="tab" data-id='1' href="#m_tabs_1_2" role="tab">Tanggal Pulang</a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link step-type-select-id" id="paket" data-toggle="tab" data-id='1' href="#m_tabs_1_3" role="tab">Jenis Paket</a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link step-type-select-id" id="pihk_per_daker" data-toggle="tab" data-id='1' href="#m_tabs_1_4" role="tab">PIHK Per Daker <span class="badge badge-danger badge-counter">NEW!</span></a>
            </li>
        </ul>
            <div class="card-body">
              <div class="table-responsive">
           <div class="tab-content">
            <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                <label for="tanggal_berangkat" class="col-md-5 col-form-label">Tanggal Berangkat</label>
                 <div class="form-group">
                  <input type="text" class="form-control col-md-3 btn-group typetanggal" autocomplete='off' id="tanggal_berangkat" name="tanggal_berangkat">
                  <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm btn btn-group" id="cek_berangkat"><i class='fas fa-check'></i> Cek</button><br><br>
                  <a href="#" onclick="tampilallberangkatexport()" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>
                  <div id="total_jemaah_berangkat"></div>
                </div>
                <table class="table table-bordered" id="list-data-berangkat" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">Nama PIHK</th>
                      <th colspan="4">Keberangkatan Dari Indonesia</th>
                      <th colspan="3">Kedatangan Di Saudi</th>
                      <th colspan="3">Hotel</th>
                      <!-- <th id="bandara"></th> -->
                      <th rowspan="2">Jumlah Jemaah</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                      <th>Tgl</th>
                      <th>Arv</th>
                      <th>Jam</th>
                      <th>No. Flight</th>
                      <th>Tgl</th>
                      <th>Dest</th>
                      <th>Jam</th>
                      <th>Makkah</th>
                      <th>Madinah</th>
                      <th>Transit</th>
                    </tr>
                  </thead>
                  <tbody id='data-list-berangkat'>
                  </tbody>
                </table>
            </div>
            <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                  <label for="tanggal_pulang" class="col-md-5 col-form-label">Tanggal Pulang</label>
                 <div class="form-group">
                  <input type="text" class="form-control col-md-3 btn-group typetanggal" id="tanggal_pulang" name="tanggal_pulang">
                  <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm btn btn-group" id="cek_pulang"><i class='fas fa-check'></i> Cek</button><br><br>
                  <a href="#" onclick="tampilallpulangexport()" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>
                  <div id="total_jemaah_pulang"></div>
                </div> 
                <table class="table table-bordered" id="list-data-pulang" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">Nama PIHK</th>
                      <th colspan="4">Keberangkatan Dari Arab Saudi</th>
                      <th colspan="3">Kedatangan Di Tanah Air</th>
                      <th rowspan="2">Jumlah Jemaah</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                      <th>Tgl</th>
                      <th>Arv</th>
                      <th>Jam</th>
                      <th>No. Flight</th>
                      <th>Tgl</th>
                      <th>Dest</th>
                      <th>Jam</th>
                    </tr>
                  </thead>
                  <tbody id='data-list-pulang'>
                  </tbody>
                </table>
            </div>
            <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
                  <label for="jenis_paket" class="col-md-5 col-form-label">Jenis Paket</label>
                 <div class="form-group">
                  <select class="form-control col-md-3 btn-group" id="jenis_paket">
                    <option value="" disabled selected>Pilih</option>
                    <?php foreach($jenis as $row){
                      echo '<option value="'.$row->description.'">'.$row->description.'</option>';
                    } ?>
                  </select>
                  <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm btn btn-group" id="cek_jenis_paket"><i class='fas fa-check'></i> Cek</button><br><br>
                  <a href="#" onclick="tampiljenispaketexport()" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>
                  <div id="total_jemaah_paket"></div>
                </div> 
                <table class="table table-bordered" id="list-data-paket" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode PIHK</th>
                      <th>Nama PIHK</th>
                      <th>Kode Paket</th>
                      <th>Kode Tahun</th>
                      <th>Pemberangkatan Ke</th>
                      <th>Jenis Paket</th>
                      <th>Jumlah Jemaah</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id='data-list-paket'>
                  </tbody>
                </table>
            </div>
            <div class="tab-pane" id="m_tabs_1_4" role="tabpanel">
                  <label for="daker" class="col-md-5 col-form-label">Daerah Kerja</label>
                 <div class="form-group">
                  <select class="form-control col-md-3 btn-group" id="daker">
                    <option value="" disabled selected>Pilih</option>
                    <option value="KEBERANGKATAN_TANAH_AIR">Berangkat Tanah Air</option>
                    <option value="KEDATANGAN_MADINAH">Madinah</option>
                    <option value="KEDATANGAN_JEDDAH">Jeddah</option>
                    <option value="KEDATANGAN_MEKKAH">Mekkah</option>
                    <option value="TARWIYAH">Tarwiyah</option>
                    <option value="KEDATANGAN_ARAFAH">Kedatangan Arafah</option>
                    <option value="KEPULANGAN_MINA">Kepulangan Mina</option>
                    <option value="KEPULANGAN_ARAB_SAUDI">Kepulangan dari Arab Saudi</option>
                    <option value="KEDATANGAN_TANAH_AIR">Kembali Ke Tanah Air</option>
                  </select>
                  <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm btn btn-group" id="cek_pihk_per_daker"><i class='fas fa-check'></i> Cek</button><br><br>
                  <a href="#" onclick="tampilpihkperdakerexport()" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" style="margin-bottom: 20px;"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export To Excel</a>
                  <div id="total_pihk_per_daker"></div>
                </div> 
                <table class="table table-bordered" id="list-data-pihk" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode PIHK</th>
                      <th>Nama PIHK</th>
                      <th width="10%">Jumlah Jemaah</th>
                    </tr>
                  </thead>
                  <tbody id='data-list-pihk'>
                  </tbody>
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

MyTableBerangkat = $('#list-data-berangkat').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });

MyTablePulang = $('#list-data-pulang').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });

MyTablePaket = $('#list-data-paket').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });

MyTablePIHK = $('#list-data-pihk').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });

function refresh_berangkat() {
  MyTableBerangkat = $('#list-data-berangkat').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });
}

function refresh_pulang() {
  MyTablePulang = $('#list-data-pulang').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });
}

function refresh_paket() {
  MyTablePaket = $('#list-data-paket').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });
}

function refresh_pihk() {
  MyTablePIHK= $('#list-data-pihk').dataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    bFilter: true
      });
}

window.onload = function() {
    tampilallberangkat();
}

function showDetail(kd_pra_manifest){
  $("#loader-wrapper").show();
  var detail_jemaah = []
  $.ajax({ 
    type: "POST",   
      url: "<?php echo base_url('Dashboard/Informasi/getDetailJemaah') ?>",
      dataType: "JSON",
      data: {kd_pra_manifest: kd_pra_manifest},
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

$("#cek_berangkat").click(function() {
    parameter = $("#tanggal_berangkat").val();
    filter    = 'tanggal_berangkat';
    tampilallberangkat();
});
$("#cek_pulang").click(function() {
    parameter = $("#tanggal_pulang").val();
    filter    = 'tanggal_pulang';
    tampilallpulang();
});
$("#cek_jenis_paket").click(function() {
    parameter = $("#jenis_paket").val();
    filter    = 'jenis_paket';
    tampiljenispaket();
});
$("#cek_pihk_per_daker").click(function() {
    parameter = $("#daker").val();
    filter    = 'jenis';
    tampilpihkperdaker();
});

var parameter = 0;
var filter    = 'all';
function tampilallberangkat() {
  var total_jemaah = 0;
  $("#loader-wrapper").show();
    $.get('<?php echo base_url('Dashboard/Informasi/tampilallberangkat/'); ?>'+filter+'/'+parameter, function(data) {
      MyTableBerangkat.fnDestroy();
        $('#data-list-berangkat').html(data);
      refresh_berangkat();
    });
    $.ajax({ 
      type: "GET",   
        url: "<?php echo base_url('Dashboard/Informasi/tampilallberangkatforcountjemaah/'); ?>"+filter+'/'+parameter,
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            total_jemaah += Number(value.jumlah);
            
          });
          document.getElementById("total_jemaah_berangkat").innerHTML = "Jumlah Jemaah : "+total_jemaah+" Jemaah";
          $("#loader-wrapper").hide();
          // alert(total_jemaah);
        }
    });
}

function tampilallberangkatexport() {
  window.open("<?php echo base_url('Dashboard/Informasi/tampilallberangkatforexport/'); ?>"+filter+'/'+parameter);
}

function tampilallpulang() {
  var total_jemaah = 0;
  $("#loader-wrapper").show();
    $.get('<?php echo base_url('Dashboard/Informasi/tampilallpulang/'); ?>'+filter+'/'+parameter, function(data) {
      MyTablePulang.fnDestroy();
        $('#data-list-pulang').html(data);
      refresh_pulang();
    });
    $.ajax({ 
      type: "GET",   
        url: "<?php echo base_url('Dashboard/Informasi/tampilallpulangforcountjemaah/'); ?>"+filter+'/'+parameter,
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            total_jemaah += Number(value.jumlah);
            
          });
          document.getElementById("total_jemaah_pulang").innerHTML = "Jumlah Jemaah : "+total_jemaah+" Jemaah";
          $("#loader-wrapper").hide();
        }
    });
}

function tampilallpulangexport() {
  window.open("<?php echo base_url('Dashboard/Informasi/tampilallpulangforexport/'); ?>"+filter+'/'+parameter);
}

function tampiljenispaket() {
  var total_jemaah = 0;
  $("#loader-wrapper").show();
    $.get('<?php echo base_url('Dashboard/Informasi/tampilalljenispaket/'); ?>'+filter+'/'+parameter, function(data) {
      MyTablePaket.fnDestroy();
        $('#data-list-paket').html(data);
      refresh_paket();
      $.ajax({ 
      type: "GET",   
        url: "<?php echo base_url('Dashboard/Informasi/tampilalljenispaketforcountjemaah/'); ?>"+filter+'/'+parameter,
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            total_jemaah += Number(value.jumlah);
            
          });
          document.getElementById("total_jemaah_paket").innerHTML = "Jumlah Jemaah : "+total_jemaah+" Jemaah";
          $("#loader-wrapper").hide();
        }
    });
    });
}

function tampiljenispaketexport() {
  window.open("<?php echo base_url('Dashboard/Informasi/tampilalljenispaketforexport/'); ?>"+filter+'/'+parameter);
}

function tampilpihkperdaker() {
  var total_pihk = 0;
  $("#loader-wrapper").show();
    $.get('<?php echo base_url('Dashboard/Informasi/tampilallpihkperdaker/'); ?>'+filter+'/'+parameter, function(data) {
      MyTablePIHK.fnDestroy();
        $('#data-list-pihk').html(data);
      refresh_pihk();
      $.ajax({ 
      type: "GET",   
        url: "<?php echo base_url('Dashboard/Informasi/tampilallpihkperdakerforcountpihk/'); ?>"+filter+'/'+parameter,
        dataType: "JSON",
        success : function(data)
        {
          $.each(data, function(key, value) {
            total_pihk++;
            
          });
          document.getElementById("total_pihk_per_daker").innerHTML = "Jumlah PIHK : "+total_pihk+" PIHK";
          $("#loader-wrapper").hide();
        }
      });
    });
}

function tampilpihkperdakerexport() {
  window.open("<?php echo base_url('Dashboard/Informasi/tampilallpihkperdakerforexport/'); ?>"+filter+'/'+parameter);
}

$('.typetanggal').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
});  
  $("#berangkat").click(
    function(){
       var x = $(this).attr("data-id");
       $("#tanggal_pulang").val("");
       $("#tanggal_berangkat").val("");
        parameter = 0;
        filter    = 'all';
        tampilallberangkat();
    }
  );

  $("#pulang").click(
    function(){
       var x = $(this).attr("data-id");
       $("#tanggal_pulang").val("");
       $("#tanggal_berangkat").val("");
        parameter = 0;
        filter    = 'all';
        tampilallpulang();
    }
  );

  $("#paket").click(
    function(){
       var x = $(this).attr("data-id");
       $("#tanggal_pulang").val("");
       $("#tanggal_berangkat").val("");
        parameter = 0;
        filter    = 'all';
        tampiljenispaket();
    }
  );

  $("#pihk_per_daker").click(
    function(){
       var x = $(this).attr("data-id");
        parameter = 0;
        filter    = 'all';
        tampilpihkperdaker();
    }
  );
  
</script>