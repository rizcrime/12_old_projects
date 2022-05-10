 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script> 
 <script src="<?php echo base_url(); ?>assets/js/tinymce/init-tinymce.js"></script>
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
                edited by rendra 14:42, 03/07/2018 
                menambahkan href dan menambahkan style pada span class=step
              -->
              <a href="<?php echo base_url()?>Permohonan_izin_atas/step1" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">1</span>
                <span class="title">Profile Perusahaan</span>
              </a>
            </li>

            <li data-step="2">
              <!-- 
                edited by rendra 14:42, 03/07/2018 
                menambahkan href dan menambahkan style pada span class=step
              -->
              <a href="<?php echo base_url()?>Permohonan_izin_atas/step3/<?php echo $bidder->ID_PERUSAHAAN?>" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">2</span>
                <span class="title">Dokumen Persyaratan</span>
              </a>
            </li>

            <li data-step="3">
              <!-- 
                edited by rendra 14:42, 03/07/2018 
                menambahkan href dan menambahkan style pada span class=step
              -->
              <a href="<?php echo base_url()?>Permohonan_izin_atas/step4/<?php echo $bidder->ID_PERUSAHAAN?>" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">3</span>
                <span class="title">Data Permohonan</span>
              </a>
            </li>

            <li data-step="4" >
              <!-- 
                edited by rendra 14:36, 03/07/2018 
                menambahkan href dan menambahkan style pada span class=step
              -->
              <a href="<?php echo base_url()?>Permohonan_izin_atas/step5/<?php echo $bidder->ID_PERUSAHAAN?>" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">4</span>
                <span class="title">Draft Produk Izin</span>
              </a>
            </li>

            <li data-step="5" class="active">
              <span class="step">5</span>
              <span class="title">Persetujuan/Pengesahan</span>
            </li>
          </ul>
        </div>
        <hr />

      </div>

    </div><!-- /.widget-main -->
<div class="accordion-step4 col-md-12" style="background-color: #3c8dbc; color: white;">
  <i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Perusahaan</strong>
</div>
<div class="panel_step4">
  <table class="table table-bordered table-striped" style="margin: 0px; padding: 10px; border: solid 1px #c0d9ec;">
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
      <?php foreach ($dataDokumenSyaratPerusahaan as $dokumen): ?>
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

          <!-- edited by rendra 11:50, 03/07/2018 
                    1. mengubah icon pada kolom file menjadi icon unduh bukan simpan
                    2. mengubah text-align nya menjadi center
                    3. memperbaiki link href dokumen, dengan menambahkan base_url didepannya -->

                    <td style="text-align: center;">
                      <?php if(isset($dokumen->RID)) { ?>
                        <a href='<?=base_url("Permohonan_izin_atas/download_perusahaan?file={$dokumen->RID}");?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                      <?php } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="accordion-step4 col-md-12" style="background-color: #3c8dbc; color: white; border-top: solid 1px; margin-top: 0px">
  <i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Persyaratan</strong>
</div>
<div class="panel_step4">
  <table class="table table-bordered table-striped" style="margin: 0px; padding: 10px; border: solid 1px #c0d9ec;">
    <thead>
      <tr>
        <td>No</td>
        <td>Dokumen Persyaratan</td>
        <td>File Upload</td>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($dataDokumenSyaratIzin as $row): ?>
        <tr>
          <td><?php echo $i++ ?></td>
          <td>
            <?php echo $row->PERSYARATAN ?>
<!--            <br><a class="btn btn-info riwayatCatatan btn-minier" data-id="<?php echo $row->ID_DOKUMEN_PERMOHONAN; ?>">Riwayat Catatan</a> -->
          </td>
          <td>
            <a href='<?=base_url("Permohonan_izin_atas/download_persyaratan?file={$row->ID_PERSYARATAN}") ?>' target="_blank"><?php echo !is_null($row->FILE_PERSYARATAN) ? '<i class="fa fa-download bigger-160"></i>' : '' ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>  
</div>
<div class="col-md-12"></div>

    <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
      <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
        <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Preview Catatan Evaluasi</strong></h4>
      </div>

      <div class="col-md-6">
        <h4><strong>Preview Catatan Evaluasi</strong></h4>
        <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
          <thead>
            <tr>
              <th>Dokumen</th>
              <th>Uraian</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataDokumen as $dokumen): ?>
              <tr>
                <td>
                  <a href="images/<?php echo $dokumen->FILE_PERSYARATAN ?>" target="_blank"><?php echo $dokumen->PERSYARATAN ?></a>
                </td>
                <td>
                  <?php echo $dokumen->URAIAN ?>
                </td>
                <td>
                  <?php echo $dokumen->KETERANGAN ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
        <h4><strong>Kesimpulan Catatan Evaluasi</strong></h4>
        <textarea id="catatanSimpulan" class="tinymce" name="URAIAN"></textarea>
        <div class="row">
          <div class="col-md-12">
            <button class="btn-sm btn-danger tolak">Tolak</button>
            <?php echo $button?>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<div style="overflow:auto;">
  <div style="float:left;">
    <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin_atas') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
    <div style="float:right;">&nbsp
    <a href="<?php echo base_url()?>Permohonan_izin_atas/step5/<?php echo $bidder->ID_PERUSAHAAN?>" class="btn-sm btn-info"><i class="fa fa-chevron-left"></i> Kembali</a>
  </div>
  
  </div>
</div>
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
  $(document).on("click", ".tolak", function() {
    var id = $(this).attr("data-id");
    // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();

    var formData = new FormData();
    formData.append("id", id);
    // formData.append("catatan_simpulan", catatanSimpulanText);

    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Permohonan_izin_atas/tolak'); ?>",
      data: formData,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      
      $('#tempat-modal').html(data);
      $('#tolak-permohonan').modal('show');

    })
  })

  $(document).on("click", ".setuju", function() {
    var id = $(this).attr("data-id");
    // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();

    var formData = new FormData();
    formData.append("id", id);
    // formData.append("catatan_simpulan", catatanSimpulanText);

    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Permohonan_izin_atas/setuju'); ?>",
      data: formData,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      
      $('#tempat-modal').html(data);
      $('#setuju-permohonan').modal('show');

    })
  })

  $(document).on("click", ".pengesahan", function() {
    var id = $(this).attr("data-id");
    // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();

    var formData = new FormData();
    formData.append("id", id);
    // formData.append("catatan_simpulan", catatanSimpulanText);

    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Permohonan_izin_atas/pengesahan'); ?>",
      data: formData,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      
      $('#tempat-modal').html(data);
      $('#pengesahan-permohonan').modal('show');

    })
  })
  
</script>