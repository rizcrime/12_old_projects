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
              <a href="<?php echo base_url()?>Permohonan_izin_eval/step1" style="display: block; cursor: auto;">
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
              <span class="title">Draft Produk Izin</span>
            </li>

<!--             <li data-step="5">
              <span class="step">5</span>
              <span class="title">Persetujuan/Pengesahan</span>
            </li> -->
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->
	<!--Guideline-->
	<div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: <?= $guide_bg_color; ?>; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-info" style="color: #fff000"></i> <strong>Guideline</strong></h4>
        </div>
        <div class="col-md-12" style="margin-bottom: 10px">
          <div class="profile-user-info">
            <div class="profile-info-row">
              
              <div class="profile-info-value">
                <?= $guide_description ?>
              </div>
            </div>

          </div>
        </div>
    </div>
	<!--/Guideline-->
    <?=$data_alasan_pengembalian?>
    <?=$detail_data_permohonan?>
    <?=$iframe_data_permohonan?>
    <?=$accordion_data_kelengkapan?>

    <form >
    <?=get_csrf_token()?>
     <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
      <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Persyaratan</strong></h4>
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
                  <?php //var_dump($row); ?>
                    <div class="uraian-block alert alert-warning" data-id="<?=$row->ID_DOKUMEN_PERMOHONAN?>" style="display: none;color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;margin-bottom: 10px;">
                      <h6><strong>Catatan</strong> <span class="uraian-name"><?=issetor($row->data_uraian->NAMA)?></span> @ <span class="uraian-date"><?=issetor($row->data_uraian->TGL_CATATAN)?></span></h6>
                      <h6><strong>Uraian:</strong></h6>
                      <div class="uraian-content text">
                        <?=html_entity_decode(issetor($row->data_uraian->URAIAN))?>
                      </div>

                      <h6><strong>Keterangan:</strong></h6>
                      <div class="uraian-keterangan text">
                        <?=html_entity_decode(issetemptyor($row->data_uraian->KETERANGAN, "-"))?>
                      </div>
                    </div>

                  <?php //if($everApproved): ?>
                  <?php if(!is_null($row->ID_DOKUMEN_PERMOHONAN)): ?>
                    <a class="btn btn-info riwayatCatatan btn-minier pull-right" style="margin: 0px 5px 5px 0px;" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>">Riwayat Catatan</a>
                  <?php endif; ?>
                </td>
                <td><a href='<?=base_url("Permohonan_izin_eval/download_persyaratan?file={$row->ID_PERSYARATAN}") ?>' target="_blank"><?php echo !is_null($row->FILE_PERSYARATAN) ? '<i class="fa fa-download bigger-160"></i>' : '' ?></td>
                  <td>
                  <?php if(!is_null($row->ID_DOKUMEN_PERMOHONAN)): ?>
                    <a class="btn btn-info evaluasiCatatan btn-minier" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>" data-idPermohonan="<?=$row->ID_DOKUMEN_PERMOHONAN?>" data-idPerusahaan="<?=$bidder->ID_PERUSAHAAN?>">Evaluasi</a>
                  <?php else: ?>
                    <a href="javascript:void(0);" class="btn btn-info btn-minier">File tidak tersedia</a>
                  <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <hr>
          <div>
            <strong style='color: red;'><sup>*wajib diisi</sup></strong>
          </div>
          <div class="col-md-12">
          <div id="catatan-kesimpulan-block" class="alert alert-warning" style="display:none; color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;">
            <h6><strong>Catatan</strong> <span id="catatan-kesimpulan-name"><?=issetor($cat_kesimpulan->NAMA)?></span> @ <span id="catatan-kesimpulan-date"><?=issetor($cat_kesimpulan->TGL_CATATAN_SIMPULAN)?></span></h6>
            <h6><strong>Uraian:</strong></h6>
            <div id="catatan-kesimpulan-content" class="text">
            <?=html_entity_decode(issetor($cat_kesimpulan->CATATAN_SIMPULAN))?>
            </div>
          </div>
          </div>

          <button type="button" id="view-riwayat-kesimpulan" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-riwayat-kesimpulan" data-id="<?=$id_permohonan?>">Riwayat Kesimpulan</button>
          <button id="add-kesimpulan" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-catatan-kesimpulan" onclick="return false;">Kesimpulan Evaluasi</button>



        </div>
      </div>
      <div style="overflow:auto;">
        <div style="float:left;">
          <a href="<?php echo base_url()?>Permohonan_izin_eval" class="btn btn-danger btn-minier">Cancel <i class="fa fa-times"></i></a>
        </div>
        <div style="float:right;">
          <a href="<?php echo base_url()?>Permohonan_izin_eval/step1" class="btn btn-info btn-minier"><i class="fa fa-chevron-left"></i> Kembali</a>
          <a class="btn btn-danger btn-minier tolak">Tolak</a>
          <a href="<?php echo base_url()?>Permohonan_izin_eval/step5/<?php echo $bidder->ID_PERUSAHAAN?>" class="btn btn-success btn-minier" onclick="blockUINextPage()">Berikutnya <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
    </form>
  </div>
</div>

<?=$modal_tambah_kesimpulan?>
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

  $(document).on("click", ".evaluasiCatatan", function() {
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
    var id = $(this).attr("data-id");
    var id_permohonan = $(this).attr("data-idPermohonan");
    var id_perusahaan = $(this).attr("data-idPerusahaan");

    $.ajax({
      method: "POST",
      url: "<?=base_url('Permohonan_izin_eval/catatanEval')?>",
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
      url: "<?php echo base_url('Permohonan_izin_eval/riwayatCatatan'); ?>",
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

      var textContent = tinymce.get('uraian-text').getContent();
		  $("#uraian-text").html(textContent);

      var formData = new FormData($(this)[0]);
      formData.set("URAIAN", textContent); // Avoid tinymce bug

      if($.trim(textContent) == "") {
        alert("Uraian wajib diisi");
        return;
      }

      $('#evaluasi-catatan').modal('hide');
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

      $.ajax({
        method: 'POST',
        url: '<?=base_url("Permohonan_izin_eval/prosesEvaluasi")?>',
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function(data) {
        var out = jQuery.parseJSON(data);

        if (out.status == 'form') {
          $('#evaluasi-catatan').modal('show');
          $('.form-msg').html(out.msg);
          effect_msg_form();
        } else {
          $('#evaluasi-catatan').modal('hide');
          $('.msg').html(out.msg);
          effect_msg();
          updateEvaluasiPersyaratan(formData.get("ID_DOKUMEN_PERMOHONAN"), textContent, formData.get("KETERANGAN"));
        }
      })
      .always(function(){
        $.unblockUI();
      })
  });

  function updateEvaluasiPersyaratan(id, uraian, keterangan, user = "<?=$userdata->NAMA?>") {
    var nowDate = new Date();
    currentMonth = nowDate.getMonth() + 1;
    if (currentMonth < 10) { currentMonth = '0' + currentMonth; }

    var postedDate = nowDate.getFullYear();
    postedDate += "-" + currentMonth;
    postedDate += "-" + nowDate.getDate();

    if($.trim(uraian) == "") uraian = "-";
    if($.trim(keterangan) == "") keterangan = "-";
    
    $(".uraian-block[data-id=" + id + "]").css("display", "");
    $(".uraian-block[data-id=" + id + "] .uraian-date").html(postedDate);
    $(".uraian-block[data-id=" + id + "] .uraian-name").html(user);
    $(".uraian-block[data-id=" + id + "] .uraian-content").html(uraian);
    $(".uraian-block[data-id=" + id + "] .uraian-keterangan").html(keterangan);
  }

  $(document).ready(function(e) {
    checkHide();
  });

  function checkHide() {
    $(".uraian-block").each(function() {
      var content = $(this).children(".uraian-content").html();
        if($.trim(content) != "") {
          $(this).css("display", "");
        }
    });
  }

</script>