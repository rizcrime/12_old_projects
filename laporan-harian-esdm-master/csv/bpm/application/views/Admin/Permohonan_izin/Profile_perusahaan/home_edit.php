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
              <span class="step">#</span>
              <span class="title">Profile Perusahaan</span>
            </li>

            <li data-step="2">
              <span class="step">1</span>
              <span class="title">Pilih Jenis Izin</span>
            </li>

            <li data-step="3">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </li>

            <li data-step="4">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="5">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->

    <p style="color: #bb0000">Last Update: <strong><?= $bidder->LAST_UPDATE ?></strong></p>
    <form method="POST" action='<?php echo base_url("Permohonan_izin/prosesUpdateEdit/{$currentIDPermohonanEdit}") ?>' enctype="multipart/form-data">
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
                <input type="text" class="form-control" value="<?= $bidder->NAMA_PERUSAHAAN ?>" name="NAMA_PERUSAHAAN" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Nama Perusahaan tidak boleh kosong')" oninput="setCustomValidity('')">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Alamat Perusahaan *
              </div>

              <div class="profile-info-value">
                <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"><?= $bidder->ALAMAT ?></textarea>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Provinsi
              </div>

              <div class="profile-info-value">
                <select name="ID_PROVINSI" id="PROVINSI" class="form-control">
                  <!-- <option value="<?= $bidder->ID_PROVINSI ?>"><?= $bidder->NAMA_PROVINSI ?></option> -->
                  <?php foreach($dataProvinsi as $provinsi): ?>
                    <option <?php if($provinsi->ID_PROVINSI == "$bidder->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Kab / Kota
              </div>

              <div class="profile-info-value">
                <select name="ID_KABKOT" class="KABKOT form-control">
                  <option value="<?= $bidder->ID_KABKOT ?>"><?= $bidder->NAMA_KABKOT ?></option>
                </select>
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
                <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" value="<?= $bidder->EMAIL_PERUSAHAAN ?>" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')" readonly>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Telp. *
              </div>

              <div class="profile-info-value">
                <input type="text" class="form-control" required pattern="^(0|[0-9][0-9]*)$" oninvalid="this.setCustomValidity('Nomor Telepon tidak boleh kosong dan harus angka')" oninput="setCustomValidity('')" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2" required>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Fax
              </div>

              <div class="profile-info-value">
                <input type="text" class="form-control" pattern="^(0|[0-9][0-9]*)$" oninvalid="this.setCustomValidity('Fax harus angka')" oninput="setCustomValidity('')"  value="<?= $bidder->FAX ?>" name="FAX" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Jenis Permodalan *
              </div>

              <div class="profile-info-value">
                <select name="STATUS_MODAL" class="form-control" required oninvalid="this.setCustomValidity('Jenis Permodalan tidak boleh kosong')" oninput="setCustomValidity('')">
                    <?php if($bidder->STATUS_MODAL == 'PMA') { ?>                  
                      <option selected="selected" value="PMA">PMA</option>
                      <option value="PMDN">PMDN</option>
                    <?php } else if($bidder->STATUS_MODAL == 'PMDN') { ?>
                      <option value="<?= $bidder->STATUS_MODAL ?>"><?= $bidder->STATUS_MODAL ?></option>
                      <option value="PMA">PMA</option>
                      <option value="PMDN">PMDN</option>
                    <?php } else { ?>
                      <option value="PMA">PMA</option>
                      <option value="PMDN">PMDN</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Website
                </div>

                <div class="profile-info-value">
                  <input type="text" class="form-control" value="<?= $bidder->WEBSITE ?>" name="WEBSITE" aria-describedby="sizing-addon2">
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
                  <th>Nomor</th>
                  <th>Tanggal Terbit</th>
                  <th>Berlaku Sampai</th>
                  <th width="">File</th>
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
                      <input type="hidden" name="NOMOR[]"  class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="text" name="NOMOR[]"  class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == NULL) { ?>
                    <td>
                      <input type="hidden" name="TGL_DOKUMEN[]" class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="date" name="TGL_DOKUMEN[]" class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>" max='<?=date("Y-m-d")?>'>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == NULL) { ?>
                    <td>
                      <input type="hidden" name="TGL_KEDALUARSA[]" class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="date" name="TGL_KEDALUARSA[]" class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>" min='<?=date("Y-m-d")?>'>
                    </td>
                  <?php } ?>
                  <td style="text-align: right;">
                    <?php if(isset($dokumen->RID)): ?>
                      <a href='<?=base_url("Profile_perusahaan/download_perusahaan?file={$dokumen->RID}");?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php endif; ?>
                    <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>">
                    <input type="file" name="DOKUMEN_PERSYARATAN[]" flag="input-file" accept=".pdf,.jpg,.jpeg,.png">
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
          <div class="col-md-2">
            <a class="form-control btn btn-info" style="border-radius: 5px" data-toggle="modal" data-target="#tambah-akta"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Akta</a>
          </div>


          <div class="col-md-12">
            <table id="list-data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;">Jenis Akta</th>
                  <th colspan="3" style="text-align: center;">Akta</th>
                  <th colspan="2" style="text-align: center;">Pengesahan</th>
                  <th rowspan="2" style="text-align: center;">Aksi</th>
                </tr>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Notaris</th>
                  <th>Tanggal</th>
                  <th>Nomor</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody id="data-akta">
              </tbody>
            </table>
          </div>

        </div>

        <div style="overflow:auto;">
          <div style="float:left;">
            <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
          </div>
          <div style="float:right;">
            <button id="izin-next-step" type="submit" class="btn-sm btn-success" >Berikutnya <i class="fa fa-chevron-right"></i></button>
          </div>
        </div>
      </form>
    </div>

    <?php echo $modal_add_akta; ?>
    <?php show_my_confirm('konfirmasiHapus', 'hapus-dataAkta', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>

    <div id="tempat-modal"></div>


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
    });

    $(document).on("submit", "#main-profile", function() {
		  $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	  });
  </script>