<style>
/* For Firefox */
input[type='number'] {
    -moz-appearance:textfield;
}

/* Webkit browsers like Safari and Chrome */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
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
                <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon1" rows="4"  required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"><?= $bidder->ALAMAT ?></textarea>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Provinsi *
              </div>

              <div class="profile-info-value">
                <select name="ID_PROVINSI" id="PROVINSI" class="form-control" required>
                  <option value="">--PILIH--</option>
                  <?php foreach($dataProvinsi as $provinsi): ?>
                    <?php if($bidder->ID_PROVINSI != NULL) { ?>
                      <option <?php if($provinsi->ID_PROVINSI == "$bidder->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php } else { ?>
                      <option value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php } ?>              
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Kab / Kota *
              </div>

              <div class="profile-info-value">
                <select name="ID_KABKOT" class="KABKOT form-control" required>
                    <option value="">--PILIH PROVINSI DAHULU--</option>
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
                <input type="text" class="form-control" pattern="(?=^.{6,}$)(0|[0-9][0-9]*)" oninvalid="this.setCustomValidity('Nomor Telepon tidak boleh kosong dan minimal 6 angka')" oninput="setCustomValidity('')" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2" required>
<!--                 <input type="text" class="form-control" required pattern="^(0|[0-9][0-9]*)$" oninvalid="this.setCustomValidity('Nomor Telepon tidak boleh kosong dan harus angka')" oninput="setCustomValidity('')" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2" required> -->
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
                    <option <?=$bidder->STATUS_MODAL == "PMA"  ? "selected='selected'" : "" ?> value="PMA">PMA</option>
                    <option <?=$bidder->STATUS_MODAL == "PMDN"  ? "selected='selected'" : "" ?> value="PMDN">PMDN</option>
                </select>
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
				    <input type="checkbox" name="BIDANG_USAHA[]" class="form-check-input" id="BIDANG_USAHA1" <?= !empty($BIDANG_USAHA["Panas Bumi"]) ? "checked" : ""; ?> value="Panas Bumi">
				    <label class="form-check-label" for="BIDANG_USAHA1">Panas Bumi</label>
				    <input type="checkbox" name="BIDANG_USAHA[]" class="form-check-input" id="BIDANG_USAHA2" <?= !empty($BIDANG_USAHA["Konservasi"]) ? "checked" : ""; ?> value="Konservasi">
				    <label class="form-check-label" for="BIDANG_USAHA2">Konservasi</label>
				    <input type="checkbox" name="BIDANG_USAHA[]" class="form-check-input" id="BIDANG_USAHA3" <?= !empty($BIDANG_USAHA["Bioenergi"]) ? "checked" : ""; ?> value="Bioenergi">
				    <label class="form-check-label" for="BIDANG_USAHA3">Bioenergi</label>
				 </div>
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
                <th colspan="2">Dokumen</th>
                <th>Nomor</th>
                <th>Tanggal Terbit</th>
                <th>Berlaku Sampai</th>
                <th width="25%">File</th>
              </tr>
            </thead>
            <tbody>
              <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
              <?php foreach ($dataDokumen as $dokumen): ?>
              <?php
                $data_required = "";
                if($dokumen->IS_MANDATORY == "Y") {
                  $data_required = "required";
                }

                $is_dokumen_readonly = get_dokumen_readonly($dokumen);
                $read_only_string = ($is_dokumen_readonly ? "readonly='readonly'" : "");
                $date_time_dokumen_string = ($is_dokumen_readonly ? "" : "tgl_dokumen_datepicker");
                $date_time_kedaluarsa_string = ($is_dokumen_readonly ? "" : "tgl_kedaluarsa_datepicker");
              ?>
                <tr>
                  <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                  <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                  <?php
                    if(is_null($dokumen->SUB_DOKUMEN_PERSYARATAN)) {
                      $dokumen_colspan = "colspan = '2'";
                    } else {
                      unset($dokumen_colspan);
                    }
                  ?>
                  <td <?=issetor($dokumen_colspan)?>>
                    <?php
                      if(strtoupper($dokumen->DOKUMEN_PERSYARATAN) == "NIB") {
                        $nib_is_exist = TRUE;
                      }
                      echo $dokumen->DOKUMEN_PERSYARATAN; if($dokumen->IS_MANDATORY == "Y"){ echo "(*)"; } 
                    ?>
                  </td>
                  <?php if (!is_null($dokumen->SUB_DOKUMEN_PERSYARATAN)): 
                          $extra = array(
                            "required" => "required",
                          );
                          
                          if(!empty($read_only_string)) {
                            $extra['disabled'] = 'disabled';
                          }
                  ?>
                    <td>
                      <?php print_as_dropdown($dokumen->SUB_DOKUMEN_PERSYARATAN, "SELECTED_SUB_DOKUMEN[]", $dokumen->SELECTED_SUB_DOKUMEN, $extra) ?>
                    </td>
                  <?php else: ?>
                    <input type="hidden" name="SELECTED_SUB_DOKUMEN[]"/>
                  <?php endif; ?>
                  <?php if ($dokumen->IS_NOMOR == "N") { ?>
                    <td>
                      <input type="hidden" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php if ($dokumen->IS_TYPE_NUMBER == "Y"): ?>
                        <input <?=$read_only_string?> type="text" pattern="[0-9]*" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Hanya boleh diisi dengan angka!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                      <?php else:?>
                        <input <?=$read_only_string?> type="text" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                      <?php endif; ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == "N") { ?>
                    <td>
                      <input type="hidden" name="TGL_DOKUMEN[]" class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input <?=$read_only_string?> type="text" name="TGL_DOKUMEN[]" class="form-control <?=$date_time_dokumen_string?>" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" max='<?=date("Y-m-d")?>' value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == "N") { ?>
                    <td>
                      <input type="hidden" name="TGL_KEDALUARSA[]" class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input <?=$read_only_string?> type="text" name="TGL_KEDALUARSA[]" class="form-control <?=$date_time_kedaluarsa_string?>" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" min='<?=date("Y-m-d")?>' value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } ?>
                  <td style="text-align: right;">
                    <?php if(isset($dokumen->RID) && !empty($dokumen->DOK)) { ?>
                      <a class="pull-left" href='<?=base_url("Profile_perusahaan/download_perusahaan?file={$dokumen->RID}")?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php } ?>
                    <?php if(!$is_dokumen_readonly): ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOK ?>">
                      <input type="file" name="DOKUMEN_PERSYARATAN[]" flag="input-file" accept=".pdf,.jpg,.jpeg,.png" <?=isset($dokumen->RID) ? "" : $data_required?>>
                    <?php else: ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOK ?>">
                      <input type="file" name="DOKUMEN_PERSYARATAN[]" style="display:none">
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <p>
            Ukuran maximum file : <?=get_max_size(TRUE)?>
          </p>
          <?php if(isset($nib_is_exist)):?>
              <p>
              Untuk membuat NIB, silakan buat akun di OSS. Kunjungi website berikut: <a href="https://www.oss.go.id" target="_blank">Website OSS</a>
              </p>
              <p>
              Baca pedoman perizinan berusaha di sini: <a href="https://www.oss.go.id/oss/portal/download/f/PedomanIndonesia.pdf" target="_blank">Pedoman</a>
              </p>
          <?php endif;?>
          
        </div>

      </div>
      
      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-list-alt" style="color: #fff000"></i> <strong>Akta Perusahaan</strong></h4>
        </div>
        <div class="col-md-2">
          <a class="form-control btn btn-info"  style="border-radius: 5px" data-toggle="modal" data-target="#tambah-akta"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Akta</a>
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
	  
	  <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Dokumen Narahubung</strong></h4>
        </div>

        <div class="col-md-12">
          <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
            <thead>
              <tr>
                <th colspan="2">Dokumen</th>
                <th>Nomor</th>
                <th>Tanggal Terbit</th>
                <th>Berlaku Sampai</th>
                <th width="25%">File</th>
              </tr>
            </thead>
            <tbody>
              <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
              <?php foreach ($dataNarahubung as $dokumen): ?>
              <?php
                $data_required = "";
                if($dokumen->IS_MANDATORY == "Y") {
                  $data_required = "required";
                }

                $is_dokumen_readonly = get_dokumen_readonly($dokumen);
                $read_only_string = ($is_dokumen_readonly ? "readonly='readonly'" : "");
                $date_time_dokumen_string = ($is_dokumen_readonly ? "" : "tgl_dokumen_datepicker");
                $date_time_kedaluarsa_string = ($is_dokumen_readonly ? "" : "tgl_kedaluarsa_datepicker");
              ?>
                <tr>
                  <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                  <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                  <?php
                    if(is_null($dokumen->SUB_DOKUMEN_PERSYARATAN)) {
                      $dokumen_colspan = "colspan = '2'";
                    } else {
                      unset($dokumen_colspan);
                    }
                  ?>
                  <td <?=issetor($dokumen_colspan)?>>
                    <?php
                      if(strtoupper($dokumen->DOKUMEN_PERSYARATAN) == "NIB") {
                        $nib_is_exist = TRUE;
                      }
                      echo $dokumen->DOKUMEN_PERSYARATAN; if($dokumen->IS_MANDATORY == "Y"){ echo "(*)"; } 
                    ?>
                  </td>
                  <?php if (!is_null($dokumen->SUB_DOKUMEN_PERSYARATAN)): 
                          $extra = array(
                            "required" => "required",
                          );
                          
                          if(!empty($read_only_string)) {
                            $extra['disabled'] = 'disabled';
                          }
                  ?>
                    <td>
                      <?php print_as_dropdown($dokumen->SUB_DOKUMEN_PERSYARATAN, "SELECTED_SUB_DOKUMEN[]", $dokumen->SELECTED_SUB_DOKUMEN, $extra) ?>
                    </td>
                  <?php else: ?>
                    <input type="hidden" name="SELECTED_SUB_DOKUMEN[]"/>
                  <?php endif; ?>
                  <?php if ($dokumen->IS_NOMOR == "N") { ?>
                    <td>
                      <input type="hidden" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <?php if ($dokumen->IS_TYPE_NUMBER == "Y"): ?>
                        <input <?=$read_only_string?> type="text" pattern="[0-9]*" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Hanya boleh diisi dengan angka!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                      <?php else:?>
                        <input <?=$read_only_string?> type="text" name="NOMOR[]"  class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                      <?php endif; ?>
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == "N") { ?>
                    <td>
                      <input type="hidden" name="TGL_DOKUMEN[]" class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input <?=$read_only_string?> type="text" name="TGL_DOKUMEN[]" class="form-control <?=$date_time_dokumen_string?>" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" max='<?=date("Y-m-d")?>' value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == "N") { ?>
                    <td>
                      <input type="hidden" name="TGL_KEDALUARSA[]" class="form-control" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input <?=$read_only_string?> type="text" name="TGL_KEDALUARSA[]" class="form-control <?=$date_time_kedaluarsa_string?>" <?=$data_required?> oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" min='<?=date("Y-m-d")?>' value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } ?>
                  <td style="text-align: right;">
                    <?php if(isset($dokumen->RID) && !empty($dokumen->DOK)) { ?>
                      <a class="pull-left" href='<?=base_url("Profile_perusahaan/download_perusahaan?file={$dokumen->RID}")?>' target="_blank"><i class="fa fa-download bigger-160"></i></a>
                    <?php } ?>
                    <?php if(!$is_dokumen_readonly): ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOK ?>">
                      <input type="file" name="DOKUMEN_PERSYARATAN[]" flag="input-file" accept=".pdf,.jpg,.jpeg,.png" <?=isset($dokumen->RID) ? "" : $data_required?>>
                    <?php else: ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOK ?>">
                      <input type="file" name="DOKUMEN_PERSYARATAN[]" style="display:none">
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <p>
            Ukuran maximum file : <?=get_max_size(TRUE)?>
          </p>
          
          
        </div>

      </div>

      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4>Pernyataan</h4>
        </div>
        <div class="profile-user-info profile-user-info-striped" style="text-align:justify;"> 
          <?= $sk_submit_profile->DESKRIPSI ?>
          <div class="checkbox">
            <label class="block">
              <input type="checkbox" value="Y" name="isSetuju" id="isSetuju" class="ace input-lg" required><span class="lbl"> Saya setuju dengan pernyataan di atas </span>
            </label>
          </div>
        </div>
      </div>
		
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js" ></script>
<script type="text/javascript">


$(document).ready(function(){

  tampilProfile_perusahaan();
  get_kabkot($('#PROVINSI'));
  
  $('#PROVINSI').change(function(){
    get_kabkot(this);
  });
});

function get_kabkot(provinsi_data) {
  var id=$(provinsi_data).val();
  var curr_id_kabkot = "<?=isemptyor($bidder->ID_KABKOT, '')?>";

  $.ajax({
    url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
    method : "POST",
    data : {id: id},
    async : false,
    dataType : 'json',
    success: function(data){
      if(data.length != 0) {
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          var is_selected = "";
          if(data[i].ID_KABKOT == curr_id_kabkot) {
            is_selected = "selected";
          }

          html += '<option ' + is_selected +' value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
        }
        $('.KABKOT').html(html);
      } else {
        var html = '<option value="">--PILIH PROVINSI DAHULU--</option>';
        $('.KABKOT').html(html);
      }
    }
  });
}

// Profile perusahaan
function tampilProfile_perusahaan() {
		$.get('<?php echo base_url('Profile_perusahaan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-akta').html(data);
			refresh();
            check_akta();
		});
	}

	$(document).on("click", ".update-dataAkta", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Profile_perusahaan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-akta').modal('show');
		})
	})

	var id_perizinan;
	$(document).on("click", ".konfirmasiHapus-dataAkta", function() {
		id_perizinan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAkta", function() {
		var id = id_perizinan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Profile_perusahaan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilProfile_perusahaan();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on('submit', '#form-update-akta', function(e){
		var formData = new FormData($(this)[0]);

		$('#update-akta').modal('hide');

    	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Profile_perusahaan/updateAkta'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProfile_perusahaan();
			if (out.status == 'form') {
				$.unblockUI(); 
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$.unblockUI(); 
				document.getElementById("form-update-akta").reset();
				$('#update-akta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-tambah-akta', function(e) {
		var formData = new FormData($(this)[0]);

		$('#tambah-akta').modal('hide');

    	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Profile_perusahaan/tambahAkta'); ?>',
			data: formData,
			processData: false,
            contentType: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProfile_perusahaan();
			if (out.status == 'form') {
				$.unblockUI(); 
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				$.unblockUI(); 
				document.getElementById("form-tambah-akta").reset();
				$("#form-tambah-akta input[flag='input-file']").ace_file_input('reset_input');
				$('#tambah-akta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})

		e.preventDefault();
	});

	$('#tambah-akta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	$('#update-akta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

    function check_akta() {
      var table = $("#list-data").DataTable();

      if (!table.data().any()) {
        if(typeof akta_empty_callback === "function") {
          akta_empty_callback();
        }
      } else {
        if(typeof akta_exists_callback === "function") {
          akta_exists_callback();
        }     
      }
    }
	
	$(document).on('submit', '#form-submit-profile', function(e) {
		
		return false;
	});
	
  // Datepicker
  $('.tgl_dokumen_datepicker').datepicker({
    format: 'yyyy-mm-dd',
    endDate: '<?=date("Y-m-d")?>'
  });

  $('.tgl_dokumen_datepicker').on('changeDate show', function(e) {
    this.setCustomValidity('');
  });

  $('.tgl_kedaluarsa_datepicker').on('changeDate show', function(e) {
    this.setCustomValidity('');
  });

  $('.tgl_kedaluarsa_datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '<?=date("Y-m-d")?>'
  });
</script>