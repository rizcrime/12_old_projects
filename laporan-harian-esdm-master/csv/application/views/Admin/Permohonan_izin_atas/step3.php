 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
 <style type="text/css">
 button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}
</style>

<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
    <div class="widget-main">
      <div id="fuelux-wizard-container">
        <div>
          <ul class="steps">
            <li data-step="1">
              <!-- 
                edited by rendra 14:18, 03/07/2018 
                menambahkan href dan menambahkan style pada span class=step
              -->
              <a href="<?php echo base_url()?>Permohonan_izin_atas/step1" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">1</span>
                <span class="title">Profile Perusahaan</span>
              </a>
            </li>

            <li data-step="2" class="active">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </li>

            <li data-step="3">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="4">
              <span class="step">4</span>
              <span class="title">Draft Produk Izin</span>
            </li>

            <li data-step="5">
              <span class="step">5</span>
              <span class="title">Persetujuan/Pengesahan</span>
            </li>
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->
    <form >
    <?=get_csrf_token()?>
     <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
      <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Upload Dokumen Persyaratan</strong></h4>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
          <thead>
            <tr>
              <td>No</td>
              <td>Dokumen Persyaratan</td>
              <td>File Upload</td>
              <td>Evaluasi</td>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($dataDokumen as $row): 
              ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td>
                  <?php echo $row->PERSYARATAN ?>
                  <?php if($everApproved): ?>
                    <br><a class="btn btn-info riwayatCatatan btn-minier" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>">Riwayat Catatan</a>
                  <?php endif; ?>
                </td>
                <td><a href='<?=base_url("Permohonan_izin_atas/download_persyaratan?file={$row->ID_PERSYARATAN}") ?>' target="_blank"><?php echo !is_null($row->FILE_PERSYARATAN) ? '<i class="fa fa-download bigger-160"></i>' : '' ?></td>
                  <td><a class="btn btn-info evaluasiCatatan btn-minier" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>" data-idPermohonan="<?=$row->ID_DOKUMEN_PERMOHONAN?>" data-idPerusahaan="<?=$bidder->ID_PERUSAHAAN?>">Evaluasi</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
      <div style="overflow:auto;">
        <div style="float:left;">
          <a href="<?php echo base_url()?>Permohonan_izin_atas" class="btn btn-danger btn-minier">Cancel <i class="fa fa-times"></i></a>
        </div>
        <div style="float:right;">
          <a href="<?php echo base_url()?>Permohonan_izin_atas/step1" class="btn btn-info btn-minier"><i class="fa fa-chevron-left"></i> Kembali</a>
          <a href="<?php echo base_url()?>Permohonan_izin_atas/step4/<?php echo $bidder->ID_PERUSAHAAN?>" class="btn btn-success btn-minier">Berikutnya <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="tempat-modal"></div>

<style type="text/css">
textarea{
  width: 100%;
  resize: vertical;
}
div.col-md-12{
  margin-top: 10px;
}
div.col-md-8{
  padding: 0;
}
.steps li.active .step{
  background-color: #fff000;
}
table.table-bordered thead td{
  background-color: #c0d9ec;
  color: black;
  font-weight: 700;
}
</style>
<script type="text/javascript">

  function f_show(obj) {
    if(obj.value){
      $('div[id^=dokumen]').attr("style","display:none");
      $("#dokumen"+obj.value).attr("style","display:block");
    } else {        
      $('div[id^=dokumen]').attr("style","display:none");
    }
  }

  // $(document).ready(function(){
  //   $('#PROVINSI').change(function(){
  //     var id=$(this).val();
  //     $.ajax({
  //       url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
  //       method : "POST",
  //       data : {id: id},
  //       async : false,
  //       dataType : 'json',
  //       success: function(data){
  //         var html = '';
  //         var i;
  //         for(i=0; i<data.length; i++){
  //           html += '<option value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
  //         }
  //         $('.KABKOT').html(html);
  //       }
  //     });
  //   });
  // });

  $(document).on("click", ".evaluasiCatatan", function() {
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
    var id = $(this).attr("data-id");
    var id_permohonan = $(this).attr("data-idPermohonan");
    var id_perusahaan = $(this).attr("data-idPerusahaan");
    
    $.ajax({
      method: "POST",
      url: "<?=base_url('Permohonan_izin_atas/catatanEval')?>",
      data: {data : id, id_permohonan, id_perusahaan}
    })
    .done(function(data) {

      $('#tempat-modal').html(data);
      $('#evaluasi-catatan').modal('show');
    })
    .always(function(){
        $.unblockUI();
    })
  })

  $(document).on("click", ".riwayatCatatan", function() {
    var id = $(this).attr("data-id");
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Permohonan_izin_atas/riwayatCatatan'); ?>",
      data: "id=" +id
    })
    .done(function(data) {
      $('#tempat-modal').html(data);
      $('#riwayat-catatan').modal('show');
    })
    .always(function(){
        $.unblockUI();
    })
  })

  $(document).on("submit", "#form-evaluasiCatatan", function(e) {
      e.preventDefault();
      $('#evaluasi-catatan').modal('hide');
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

      var textContent = tinymce.get('uraian-text').getContent();
		  $("#uraian-text").html(textContent);

      var formData = new FormData($(this)[0]);
      formData.set("URAIAN", textContent); // Avoid tinymce bug

      $.ajax({
        method: 'POST',
        url: '<?=base_url("Permohonan_izin_atas/prosesEvaluasi")?>',
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function(data) {
        var out = jQuery.parseJSON(data);

        if (out.status == 'form') {
          $('.form-msg').html(out.msg);
          effect_msg_form();
        } else {
          $('#evaluasi-catatan').modal('hide');
          $('.msg').html(out.msg);
          effect_msg();
        }
      })
      .always(function(){
        $.unblockUI();
      })
  });


</script>