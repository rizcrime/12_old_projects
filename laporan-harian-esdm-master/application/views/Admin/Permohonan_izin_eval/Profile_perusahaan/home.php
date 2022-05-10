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
            <li data-step="1" class="active">
              <!-- 
                edited by rendra 14:18, 03/07/2018 
                mengganti tampilan # menjadi 1
              -->
              <span class="step">1</span>
              <span class="title">Profile Perusahaan</span>
            </li>

            <li data-step="2">
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

        <hr/>
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
	
    <?=$detail_data_permohonan?>
    <?=$data_alasan_pengembalian?>

    <p style="color: #bb0000">Last Update: <strong><?= $bidder->LAST_UPDATE ?></strong></p>
    <form>
    <?=get_csrf_token()?>
      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Profil Perusahaan</strong></h4>
        </div>

        <div class="col-md-6" style="margin-bottom: 10px">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nama Perusahaan *
              </div>

              <div class="profile-info-value">
                <?= $bidder->NAMA_PERUSAHAAN ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX; height: 105PX">
                Alamat Perusahaan *
              </div>	

              <div class="profile-info-value">
                <?= $bidder->ALAMAT ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Provinsi
              </div>

              <div class="profile-info-value">
                <?= $bidder->NAMA_PROVINSI ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Kab / Kota
              </div>

              <div class="profile-info-value">
                <?= $bidder->NAMA_KABKOT ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6" style="margin-bottom: 10px">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Email *
              </div>

              <div class="profile-info-value">
                <?= $bidder->EMAIL_PERUSAHAAN ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Telp. *
              </div>

              <div class="profile-info-value">
                <?= $bidder->TELEPON ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Fax
              </div>

              <div class="profile-info-value">
                <?= $bidder->FAX ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Jenis Permodalan *
              </div>

              <div class="profile-info-value">
                <?= $bidder->STATUS_MODAL ?>
              </div>
            </div>
			
			<div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Bidang Usaha
              </div>
			  <?php
			  	$BIDANG_USAHA_ARR = explode(",",$bidder->BIDANG_USAHA);
			  	foreach ($BIDANG_USAHA_ARR as $data){
					$BIDANG_USAHA[$data] = $data;
				}
			  ?>
              <div class="profile-info-value">
                 <div class="checkbox-group-required">
				    <input type="checkbox" name="BIDANG_USAHA[]" disabled="true" class="form-check-input" id="BIDANG_USAHA1" <?= !empty($BIDANG_USAHA["Panas Bumi"]) ? "checked" : ""; ?> value="Panas Bumi">
				    <label class="form-check-label" for="BIDANG_USAHA1">Panas Bumi</label>
				    <input type="checkbox" name="BIDANG_USAHA[]" disabled="true" class="form-check-input" id="BIDANG_USAHA2" <?= !empty($BIDANG_USAHA["Konservasi"]) ? "checked" : ""; ?> value="Konservasi">
				    <label class="form-check-label" for="BIDANG_USAHA2">Konservasi</label>
				    <input type="checkbox" name="BIDANG_USAHA[]" disabled="true" class="form-check-input" id="BIDANG_USAHA3" <?= !empty($BIDANG_USAHA["Bioenergi"]) ? "checked" : ""; ?> value="Bioenergi">
				    <label class="form-check-label" for="BIDANG_USAHA3">Bioenergi</label>
				 </div>
              </div>
            </div>
            
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Website
              </div>

              <div class="profile-info-value">
                <?= $bidder->WEBSITE; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Perusahaan</strong></h4>
        </div>

        <div class="col-md-12">
          <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
            <thead>
              <tr>
                <th>Dokumen</th>
                <th>Sub Jenis</th>
                <th>Nomor</th>
                <th>Tanggal Terbit</th>
                <th>Berlaku Sampai</th>
                <th width="5%">File</th>
              </tr>
            </thead>
            <tbody>
              <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
              <?php foreach ($dataDokumen as $dokumen): ?>
                <tr>
                  <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                  <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                  <td>
                    <?php echo $dokumen->DOKUMEN_PERSYARATAN ?>
                  </td>
                  <td>
                    <?php
                      if(!empty($dokumen->SUB_DOKUMEN_PERSYARATAN)) {
                        print_as_dropdown($dokumen->SUB_DOKUMEN_PERSYARATAN, "", $dokumen->SELECTED_SUB_DOKUMEN, "disabled");
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  <?php if ($dokumen->IS_NOMOR == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->NOMOR ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->TGL_DOKUMEN ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->TGL_KEDALUARSA ?>
                    </td>
                  <?php } ?>

                  <!-- 
                    edited by rendra 11:50, 03/07/2018 
                    1. mengubah icon pada kolom file menjadi icon unduh bukan simpan
                    2. mengubah text-align nya menjadi center
                    3. memperbaiki link href dokumen, dengan menambahkan base_url didepannya
                  -->
                  <td style="text-align: center;">
                    <?php if(isset($dokumen->RID)): ?>
                      <a href='<?=base_url("Permohonan_izin_eval/download_perusahaan?file={$dokumen->RID}")?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php endif; ?>
                  </td>

                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>

      </div>

      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-list-alt" style="color: #fff000"></i> <strong>Akta Perusahaan</strong></h4>
        </div>

        <div class="col-md-12">
          <table id="list-data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th rowspan="2" style="text-align: center;">Jenis Akta</th>
                <th colspan="3" style="text-align: center;">Akta</th>
                <th colspan="2" style="text-align: center;">Pengesahan</th>
              </tr>
              <tr>
                <th>Nomor</th>
                <th>Nama Notaris</th>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($dataAkta as $akta) {
                if ($akta->IS_PERUBAHAN == "Y"){
                  $akta->IS_PERUBAHAN = "Pendirian";
                } else {
                  $akta->IS_PERUBAHAN = "Perubahan";
                }
                ?>
                <tr>
                  <td><?php echo $akta->IS_PERUBAHAN; ?></td>
                  <td>
                    <a href='<?=base_url("Permohonan_izin_eval/download_dokumen/akta?file={$akta->ID_AKTA}")?>' target="_blank"><?php echo $akta->NOMOR_AKTA; ?></a>
                  </td>
                  <td><?php echo $akta->NOTARIS; ?></td>
                  <td><?php echo $akta->TGL_AKTA; ?></td>
                  <td>
                    <a href='<?=base_url("Permohonan_izin_eval/download_dokumen/pengesahan?file={$akta->ID_AKTA}")?>' target="_blank"><?php echo $akta->NO_PENGESAHAN; ?></a>
                  </td>
                  <td><?php echo $akta->TGL_PENGESAHAN; ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Narahubung</strong></h4>
        </div>

        <div class="col-md-12">
          <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
            <thead>
              <tr>
                <th>Dokumen</th>
                <th>Sub Jenis</th>
                <th>Nomor</th>
                <th>Tanggal Terbit</th>
                <th>Berlaku Sampai</th>
                <th width="5%">File</th>
              </tr>
            </thead>
            <tbody>
              <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
              <?php foreach ($dataNarahubung as $dokumen): ?>
                <tr>
                  <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                  <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                  <td>
                    <?php echo $dokumen->DOKUMEN_PERSYARATAN ?>
                  </td>
                  <td>
                    <?php
                      if(!empty($dokumen->SUB_DOKUMEN_PERSYARATAN)) {
                        print_as_dropdown($dokumen->SUB_DOKUMEN_PERSYARATAN, "", $dokumen->SELECTED_SUB_DOKUMEN, "disabled");
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  <?php if ($dokumen->IS_NOMOR == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->NOMOR ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->TGL_DOKUMEN ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == "N") { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->TGL_KEDALUARSA ?>
                    </td>
                  <?php } ?>

                  <!-- 
                    edited by rendra 11:50, 03/07/2018 
                    1. mengubah icon pada kolom file menjadi icon unduh bukan simpan
                    2. mengubah text-align nya menjadi center
                    3. memperbaiki link href dokumen, dengan menambahkan base_url didepannya
                  -->
                  <td style="text-align: center;">
                    <?php if(isset($dokumen->RID)): ?>
                      <a href='<?=base_url("Permohonan_izin_eval/download_perusahaan?file={$dokumen->RID}")?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php endif; ?>
                  </td>

                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>

      </div>

      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #aaa; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-file" style="color: #fff000"></i> <strong>Catatan Evaluasi</strong></h4>
        </div>
        <div class="col-md-12">
        <div id="uraian-block" class="alert alert-warning" style="color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;">
          <h6><strong>Catatan</strong> <span id="uraian-name"><?=issetor($data_catatan->NAMA)?></span> @ <span id="uraian-date"><?=issetor($data_catatan->TGL_CAT_DOK_PRSHN)?></span></h6>
          <h6><strong>Uraian:</strong></h6>
          <div id="uraianView" class="text">
            <?=html_entity_decode(issetor($data_catatan->URAIAN_CAT_DOK_PRSHN))?>
          </div>

          <h6><strong>Keterangan:</strong></h6>
          <div id="keteranganView" class="text">
            <?=html_entity_decode(issetemptyor($data_catatan->KETERANGAN_CAT_DOK_PRSHN, "-"))?>
          </div>
        </div>
        </div>
        <div class="col-md-12 text-center">
          <?php //if($everApproved): ?>
            <button id="viewRiwayat" class="btn btn-primary" data-toggle="modal" data-target="#riwayat-catatan" onclick="return false;" data-id="<?=$id_permohonan?>">Riwayat Catatan</button>
          <?php //endif; ?>
          <button id="addNote" class="btn btn-primary" data-toggle="modal" data-target="#tambah-catatan" onclick="return false;">Evaluasi Profil</button>
        </div>
      </div>
      
      <div style="overflow:auto;padding-bottom: 25px;">
          
      </div>
      
      <div style="overflow:auto;">
        <div style="float:left;">
          <a href="<?php echo base_url()?>Permohonan_izin_eval" class="btn btn-danger btn-minier">Cancel <i class="fa fa-times"></i></a>
        </div>
        <div style="float:right;">
          <a class="btn btn-danger btn-minier tolak">Tolak</a>
          <a href="<?php echo base_url()?>Permohonan_izin_eval/step3/<?php echo $bidder->ID_PERUSAHAAN?>" class="btn btn-success btn-minier" onclick="blockUINextPage()">Berikutnya <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
    </form>
    <?=$modal_tambah_catatan?>

    <div id="tempat-modal"></div>

    <style type="text/css">
    textarea{
      min-height: 68px;
    }

    div.col-sm-12{
      padding: 0;
    }

    div.col-md-12{
      margin-top: 10px;
    }

    div.col-md-8{
      padding: 0;
    }

  </style>

  <script type="text/javascript">


    $(document).ready(function(){
      $('#PROVINSI').change(function(){
        var id=$(this).val();
        $.ajax({
          url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
          method : "POST",
          data : {id: id},
          async : false,
          dataType : 'json',
          success: function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
              html += '<option value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
            }
            $('.KABKOT').html(html);
          }
        });
      });

      // Init uraian box
      var textUraian = $("#uraianView").html();
      if($.trim(textUraian) == "" || $.trim(textUraian).length == 0) {
        $("#uraian-block").css("display", "none");
      }
    });

    $("#form-tambah-catatan").submit(function(e){
      e.preventDefault();
      // $('#tambah-catatan').modal('hide');

      var textContent = tinymce.get('uraian-text').getContent();
		  $("#uraian-text").html(textContent);

      var formData = new FormData($(this)[0]);
      formData.set("URAIAN", textContent); // Avoid tinymce bug

      var keteranganText = formData.get("KETERANGAN");

      if($.trim(textContent) == "") {
        alert("Uraian wajib diisi");
        return;
      }
      
      hideModal($('#tambah-catatan'));
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      
      $.ajax({
        method: 'POST',
        url: '<?=base_url("Permohonan_izin_eval/tambahCatatanPerusahaan"); ?>',
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function(data) {
        var out = jQuery.parseJSON(data);

        if (out.status == "EVAL_TAKEN") {
          window.location.replace("<?=base_url('Permohonan_izin_eval')?>")
        }
        else if (out.status == 'form') {
          // $('#tambah-catatan').modal('show');
          showModal($('#tambah-catatan'));
          $('.form-msg').html(out.msg);
          effect_msg_form();
        } else {
          // $('#tambah-catatan').modal('hide');
          hideModal($('#tambah-catatan'));
          $('.msg').html(out.msg);
          effect_msg();
          loadNewUraian(textContent, keteranganText);
        }
      })
      .always(function(){
        $.unblockUI();
      })
    });

    $("#viewRiwayat").click(function(e) {
      e.stopPropagation();
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      var id = $(this).attr("data-id");
      
      $.ajax({
        method: "POST",
        url: "<?php echo base_url('Permohonan_izin_eval/riwayatCatatanPerusahaan'); ?>",
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

    function loadNewUraian(uraianText, keteranganText) {
      $("#uraian-block").css("display", "");
      var userName = "<?=$userdata->NAMA?>";
      
      // For first time comment only
      var tglUraian = $("#uraian-date").html();
      if($.trim(tglUraian) == "" || $.trim(tglUraian).length == 0) {
        var nowDate = new Date();
        currentMonth = nowDate.getMonth() + 1;
        if (currentMonth < 10) { currentMonth = '0' + currentMonth; }

        var postedDate = nowDate.getFullYear();
        postedDate += "-" + currentMonth;
        postedDate += "-" + nowDate.getDate();
        $("#uraian-date").html(postedDate);
      }
      
      if($.trim(uraianText) == "") {
        uraianText = "-";
      }

      if($.trim(keteranganText) == "") {
        keteranganText = "-";
      }

      $("#uraianView").html(uraianText);
      $("#keteranganView").html(keteranganText);
      $("#uraian-name").html(userName);
    }

  </script>


  <style type="text/css">
  textarea{
    min-height: 68px;
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

</style>
