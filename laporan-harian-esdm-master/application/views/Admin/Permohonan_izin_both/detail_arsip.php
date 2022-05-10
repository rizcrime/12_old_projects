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

.steps li::before {
  border-top: 4px solid #89bfe7;
}

.steps li .step {
  border: 5px solid #89bfe7;
}
</style>

<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?=$data_alasan_pengembalian?>
<div class="row">
  <div class="box-body">
    <div class="page-container" data-page-number="1">
    <p style="color: #bb0000">Last Update: <strong><?= $bidder->LAST_UPDATE ?></strong></p>
    <form>
    <?=get_csrf_token()?>
      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 10px; border: solid 1px #3c8dbc; border-radius: 5px;">

        <h4 style="padding-left: 15px"><i class="fa fa-user" style="color: #fff000"></i> <strong>Data Permohonan</strong></h4>

          <div class="col-md-12" style="margin-bottom: 10px; padding-left: 0px">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Kode Tracking
                </div>

                <div class="profile-info-value">
                  <?=encrypted_id_permohonan($id_permohonan)?>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Jenis Izin
                </div>

                <div class="profile-info-value">
                  <?=$data_template->NAMA_TEMPLATE?>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  File Izin
                </div>

                <div class="profile-info-value">
                  <a href='<?=get_izin_pdf_url()?><?=$dataPermohonan_izin->FILE_IZIN?>' target="_blank"><?=$dataPermohonan_izin->NOMOR_IZIN?></a>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Tanggal Pengajuan
                </div>

                <div class="profile-info-value">
                  <?=$dataPermohonan_izin->TGL_PENGAJUAN?>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Data Tracking
                </div>

                <div class="profile-info-value">
                  <a target="_blank" class="btn btn-info btn-minier" href='<?=base_url("ReportPermohonan/detailPermohonan/{$id_permohonan}")?>'><i class="glyphicon glyphicon-info-sign"></i> Detail</a>                  
                </div>
              </div>

            </div>
          </div>

        <h4 style="padding-left: 15px"><i class="fa fa-user" style="color: #fff000"></i> <strong>Profil Perusahaan</strong></h4>

        <div class="col-md-6" style="margin-bottom: 10px; padding-left: 0px">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nama Perusahaan
              </div>

              <div class="profile-info-value">
                <?= $bidder->NAMA_PERUSAHAAN ?>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Alamat Perusahaan
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
                Website
              </div>

              <div class="profile-info-value">
                <?= $bidder->WEBSITE ?>
              </div>
            </div>
          </div>
        </div>

        <h4 style="padding-left: 15px"><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Perusahaan</strong></h4>
        <div class="col-md-12" style="padding-right: 25px">
          <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
            <thead>
              <tr>
                <th>Dokumen</th>
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
                  <?php if ($dokumen->IS_NOMOR == NULL) { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->NOMOR ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == NULL) { ?>
                    <td>
                      -
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php echo $dokumen->TGL_DOKUMEN ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == NULL) { ?>
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
                      <a href='<?=base_url("{$role_url}/download_perusahaan?file={$dokumen->RID}")?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php endif; ?>
                  </td>

                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>

        <h4 style="padding-left: 15px"><i class="fa fa-list-alt" style="color: #fff000"></i> <strong>Akta Perusahaan</strong></h4>
        <div class="col-md-12" style="padding-right: 25px; margin-bottom: 20px;">
          <table id="list-data" class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
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
                    <a href='<?=base_url("{$role_url}/download_dokumen/akta?file={$akta->ID_AKTA}")?>' target="_blank"><?php echo $akta->NOMOR_AKTA; ?></a>
                  </td>
                  <td><?php echo $akta->NOTARIS; ?></td>
                  <td><?php echo $akta->TGL_AKTA; ?></td>
                  <td>
                    <a href='<?=base_url("{$role_url}/download_dokumen/pengesahan?file={$akta->ID_AKTA}")?>' target="_blank"><?php echo $akta->NO_PENGESAHAN; ?></a>
                  </td>
                  <td><?php echo $akta->TGL_PENGESAHAN; ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>


        <h4 style="padding-left: 15px;"><i class="fa fa-file" style="color: #fff000"></i> <strong>Catatan Evaluasi</strong></h4>
        <div class="col-md-12" style="padding-right: 25px">
        <div id="uraian-block" class="alert alert-warning" style="color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;">
          <h6><strong>Catatan</strong> <span id="uraian-name"><?=issetor($data_catatan->NAMA)?></span> @ <span id="uraian-date" style="font-style: normal;"><?=issetor($data_catatan->TGL_CAT_DOK_PRSHN)?></span></h6>
          <br />
          <h6><strong>Uraian:</strong></h6>
          <div id="uraianView-perusahaan" class="text">
            <?=html_entity_decode(issetor($data_catatan->URAIAN_CAT_DOK_PRSHN))?>
          </div>

          <h6><strong>Keterangan:</strong></h6>
          <div id="keteranganView" class="text">
            <?=html_entity_decode(issetemptyor($data_catatan->KETERANGAN_CAT_DOK_PRSHN, "-"))?>
          </div>
        </div>
        </div>
        <div class="col-md-12 text-center">
          <button id="viewRiwayat" class="btn btn-primary" data-toggle="modal" data-target="#riwayat-catatan" onclick="return false;" data-id="<?=$id_permohonan?>">Riwayat Catatan</button>
        </div>


      </div>

      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 10px; border: solid 1px #3c8dbc; border-radius: 5px;">
        
        
      <h4 style="padding-left: 15px"><i class="fa fa-file-text" style="color: #fff000"></i> <strong> Dokumen Persyaratan</strong></h4>
      <div class="col-md-12" style="padding-right: 25px;">
        <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
          <thead>
            <tr>
              <th>No</th>
              <th>Dokumen Persyaratan</th>
              <th>File Upload</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($dataDokumenEval as $row): 
              ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td>
                  <?php echo $row->PERSYARATAN ?>

                    <div class="uraian-block alert alert-warning" data-id="<?=$row->ID_DOKUMEN_PERMOHONAN?>" style="display: none;color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;margin-bottom: 10px;">
                      <h6><strong>Catatan</strong> <span class="uraian-name"><?=issetor($row->data_uraian->NAMA)?></span> @ <span class="uraian-date" style="font-style: normal;"><?=issetor($row->data_uraian->TGL_CATATAN)?></span></h6>
                      <h6><strong>Uraian:</strong></h6>
                      <div class="uraian-content text">
                        <?=html_entity_decode(issetor($row->data_uraian->URAIAN))?>
                      </div>

                      <h6><strong>Keterangan:</strong></h6>
                      <div class="uraian-keterangan text">
                        <?=html_entity_decode(issetemptyor($row->data_uraian->KETERANGAN, "-"))?>
                      </div>
                    </div>
                  <div></div>
                  <?php if($everApproved): ?>
                    <a class="btn btn-warning riwayatCatatan btn-minier" style="margin: 0px 5px 5px 0px;" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>">Riwayat Catatan</a>
                  <?php endif; ?>
                </td>
                <td style="text-align: center;"><a href='<?=base_url("{$role_url}/download_persyaratan?file={$row->ID_PERSYARATAN}") ?>' target="_blank"><?php echo !is_null($row->FILE_PERSYARATAN) ? '<i class="fa fa-download bigger-160"></i>' : '' ?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>


          <hr>      
          <div class="col-md-12">
          <div id="catatan-kesimpulan-block" class="alert alert-warning" style="display:none; color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;">
            <h6><strong>Catatan</strong> <span id="catatan-kesimpulan-name"><?=issetor($cat_kesimpulan->NAMA)?></span> @ <span id="catatan-kesimpulan-date"><?=issetor($cat_kesimpulan->TGL_CATATAN_SIMPULAN)?></span></h6>
            <h6><strong>Uraian:</strong></h6>
            <div id="catatan-kesimpulan-content" class="text">
            <?=html_entity_decode(issetor($cat_kesimpulan->CATATAN_SIMPULAN))?>
            </div>
          </div>
          </div>

          <button id="view-riwayat-kesimpulan" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-riwayat-kesimpulan" onclick="return false;" data-id="<?=$id_permohonan?>">Riwayat Kesimpulan</button>

        </div>
        
      </div>

      </div>

      <div style="overflow:auto;padding-bottom: 25px;">
          
      </div>
      
      <div style="overflow:auto;">
        <div style="float:left;">
          <a href="<?php echo base_url("Permohonan_izin_both/arsip")?>" class="btn btn-info btn-minier"><i class="fa fa-chevron-left"></i> Kembali</a>
        </div>
      </div>
    </form>

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
      // Init uraian box
      var textUraian = $("#uraianView-perusahaan").html();
      if($.trim(textUraian) == "" || $.trim(textUraian).length == 0) {
        $("#uraian-block").css("display", "none");
      }
    });

    $("#viewRiwayat").click(function(e) {
      e.stopPropagation();
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      var id = $(this).attr("data-id");
      
      $.ajax({
        method: "POST",
        url: "<?php echo base_url("{$role_url}/riwayatCatatanPerusahaan"); ?>",
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

  $(document).on("click", ".riwayatCatatan", function() {
    var id = $(this).attr("data-id");
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: "POST",
      url: "<?php echo base_url("{$role_url}/riwayatCatatan"); ?>",
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

    // Riwayat
    $(document).ready(function() {
      checkKesimpulanShow();
    });

    function checkKesimpulanShow() {
      var catatanKesimpulan = $.trim($("#catatan-kesimpulan-content").html());

      if(catatanKesimpulan != "") {
        $("#catatan-kesimpulan-block").css("display", "");
      }
    }

    $("#view-riwayat-kesimpulan").click(function(e) {
      e.stopPropagation();
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      var id = $(this).attr("data-id");
      
      $.ajax({
        method: "POST",
        url: "<?php echo base_url("{$tambah_kesimpulan_url}/riwayatCatatanKesimpulan"); ?>",
        data: "id=" +id
      })
      .done(function(data) {
        $('#tempat-modal').html(data);
        $('#riwayat-catatan-kesimpulan').modal('show');
      })
      .always(function(){
        $.unblockUI();
      })
  })
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
