<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
    <h5>SIPATUH Haji Khusus</h5>
  </div>
	<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pelunasan</h1>
    <p class="mb-4">Data Pelunasan merupakan tampilan seluruh status pelunasan seluruh jamaah</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelunasan</h6>
      </div>
      <div class="card-body">
        <label for="filter_data" class="col-lg-11 col-form-label">Filter Data :</label>
        <select class="form-control" name="filter_data" id="filter_data">
          <option>Seluruh Data</option>
          <option>Berhak Lunas</option>
          <option>Lunas</option>
        </select>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" id="table_jamaah" width="100%" cellspacing="0">
            <thead>
              <tr>
    						<th>Kode Porsi</th>
                <th>Nama Jamaah</th>
    						<th>Jenis Jamaah</th>
                <th>Jenis Kelamin</th>
    						<th>Nomor HP</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->	
</body>
</html>

<script>
  var seluruh_jamaah;
  var jamaah_lunas;
  var jamaah_berhak_lunas;
  $(document).ready(function(){
    seluruh_jamaah = [];
    $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/Pelunasan/getSeluruhJamaah') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              seluruh_jamaah.push([value.kode_porsi, value.nama_jamaah, value.jenis_jemaah, value.jenis_kelamin, value.nomor_hp, value.status]);
            });

            $('#table_jamaah').DataTable({
              data: seluruh_jamaah
            });

            $("#loader-wrapper").hide();
          }
      });
  });

  $('#filter_data').on('change', function(){
    $("#loader-wrapper").show();
    seluruh_jamaah = [];
    jamaah_lunas = [];
    jamaah_berhak_lunas = [];
    var filter = $('#filter_data').val();

    $('#table_jamaah').DataTable().destroy();

    if (filter == "Lunas") {
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/Pelunasan/getLunas') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              jamaah_lunas.push([value.kode_porsi, value.nama_jamaah, value.jenis_jemaah, value.jenis_kelamin, value.nomor_hp, value.status]);
            });

            $('#table_jamaah').DataTable({
              data: jamaah_lunas
            });

            $("#loader-wrapper").hide();
          }
      });
    }else if(filter == "Berhak Lunas"){
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/Pelunasan/getBerhakLunas') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              jamaah_berhak_lunas.push([value.kode_porsi, value.nama_jamaah, value.jenis_jemaah, value.jenis_kelamin, value.nomor_hp, value.status]);
            });

            $('#table_jamaah').DataTable({
              data: jamaah_berhak_lunas
            });

            $("#loader-wrapper").hide();
          }
      });
    }else{
      $.ajax({ 
        type: "POST",   
          url: "<?php echo base_url('Dashboard/Pelunasan/getSeluruhJamaah') ?>",
          dataType: "JSON",
          success : function(data)
          {
            $.each(data, function(key, value) {
              seluruh_jamaah.push([value.kode_porsi, value.nama_jamaah, value.jenis_jemaah, value.jenis_kelamin, value.nomor_hp, value.status]);
            });

            $('#table_jamaah').DataTable({
              data: seluruh_jamaah
            });

            $("#loader-wrapper").hide();
          }
      });
    }

  }); 
</script>