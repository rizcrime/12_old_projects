<html>
<body>
  <div id="loader-wrapper">
    <center><img src="<?php echo base_url('assets/loader/loader.gif') ?>"></center>
    <h5>SIPATUH Haji Khusus</h5>
  </div>
	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Jemaah</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Jemaah</h6>
            </div>
          <form id="form-update-profile" method="POST">
            <input type='text' hidden name='kd_pra_manifest_detail' value='<?php echo $DataJemaah->kd_pra_manifest_detail ?>'>
            <div class="card-body">
              <div class="form-group m-form__group">
                    <label>
                        Nama Jemaah
                    </label>
                    <input class="form-control m-input" readonly type="text" name="nama_jamaah" value='<?php echo $DataJemaah->nama_jamaah ?>'>
                </div>
              <div class="form-group m-form__group">
                    <label>
                        Jenis Jemaah
                    </label>
                    <input class="form-control m-input" readonly type="text" name="jenis_jamaah" value='<?php echo $DataJemaah->jenis_jamaah ?>'>
                </div>
             <div class="form-group m-form__group">
                    <label>
                        Jenis Kelamin
                    </label>
                    <?php 
                      $tamp = 'Laki - laki';
                      if ($DataJemaah->jenis_kelamin == 'P') {
                        $tamp = 'Perempuan';
                      }
                     ?>
                    <input class="form-control m-input" readonly type="text" value='<?php echo $tamp ?>'>
              </div>
              <div class="form-group m-form__group">
                    <label>
                        Nomor Telepon
                    </label>
                    <input class="form-control m-input" type="text" name="nomor_hp" value='<?php echo $DataJemaah->nomor_hp ?>'>
              </div>
             <div class="form-group m-form__group">
                <button type='submit' id="submit" class='btn btn-primary'><i class='fas fa-save'></i> Simpan</button>
              </div>  
             </div>
           </form>
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
$(document).ready(function(){
  $("#loader-wrapper").hide();
});
$(document).on('submit', '#form-update-profile', function(e){
   $("#loader-wrapper").show();
  var formData = new FormData($(this)[0]);
  $.ajax({
    method: 'POST',
    url: '<?php echo base_url('Dashboard/ProfileJemaah/proses_edit') ?>',
    data: formData,
    processData: false,
    contentType: false
  })
  .done(function(data) {
    window.location = "<?php echo base_url('Dashboard/ProfileJemaah'); ?>";
     $("#loader-wrapper").hide();
  });

  e.preventDefault();
});
</script> 