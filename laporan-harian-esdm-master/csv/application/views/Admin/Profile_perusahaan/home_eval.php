<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
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
                <input type="text" class="form-control" value="<?= $bidder->NAMA_PERUSAHAAN ?>" name="NAMA_PERUSAHAAN" aria-describedby="sizing-addon2" disabled oninvalid="this.setCustomValidity('Nama Perusahaan tidak boleh kosong')" oninput="setCustomValidity('')">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Alamat Perusahaan *
                
              </div>

              <div class="profile-info-value">
                <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2" disabled oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"><?= $bidder->ALAMAT ?></textarea>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Provinsi
                
              </div>

              <div class="profile-info-value">
                <select name="ID_PROVINSI" disabled id="PROVINSI" class="form-control">
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
                <select name="ID_KABKOT" disabled class="KABKOT form-control">
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
                <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" value="<?= $bidder->EMAIL_PERUSAHAAN ?>" aria-describedby="sizing-addon2" disabled oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')" readonly>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Telp. *
                
              </div>

              <div class="profile-info-value">
                <input type="text" class="form-control" disabled pattern="^(0|[0-9][0-9]*)$" oninvalid="this.setCustomValidity('Nomor Telepon tidak boleh kosong dan harus angka')" oninput="setCustomValidity('')" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2" required>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Fax
                
              </div>

              <div class="profile-info-value">
                <input disabled type="text" class="form-control" pattern="^(0|[0-9][0-9]*)$" oninvalid="this.setCustomValidity('Fax harus angka')" oninput="setCustomValidity('')"  value="<?= $bidder->FAX ?>" name="FAX" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Jenis Permodalan *
                
              </div>

              <div class="profile-info-value">
                <select name="STATUS_MODAL" class="form-control" disabled oninvalid="this.setCustomValidity('Jenis Permodalan tidak boleh kosong')" oninput="setCustomValidity('')">
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
                <input type="text" class="form-control" disabled value="<?= $bidder->WEBSITE ?>" name="WEBSITE" aria-describedby="sizing-addon2">
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
                      <input type="hidden" name="NOMOR[]"  class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="text" name="NOMOR[]"  class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_MULAI == NULL) { ?>
                    <td>
                      <input type="hidden" name="TGL_DOKUMEN[]" class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="date" name="TGL_DOKUMEN[]" class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                  <?php } ?>
                  <?php if ($dokumen->IS_TANGGAL_AKHIR == NULL) { ?>
                    <td>
                      <input type="hidden" name="TGL_KEDALUARSA[]" class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } else { ?>
                    <td>
                      <input type="date" name="TGL_KEDALUARSA[]" class="form-control" disabled oninvalid="this.setCustomValidity('Mohon diisi!')" oninput="setCustomValidity('')" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                  <?php } ?>
                  <td style="text-align: right;">
                    <?php if(isset($dokumen->RID)) { ?>
                      <a href="FILE_UPLOAD/<?php echo $bidder->ID_PERUSAHAAN?>/DOKUMEN_PERUSAHAAN/DOKUMEN_PERSYARATAN/<?php echo $dokumen->DOK ?>" target="_blank"><i class="fa fa-save bigger-160"></i></a>
                    <?php } ?>
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
                    <a href="/FILE_UPLOAD/<?php echo $bidder->ID_PERUSAHAAN?>/DOKUMEN_PERUSAHAAN/AKTA/<?php echo $akta->FILE_AKTA?>" target="_blank"><?php echo $akta->NOMOR_AKTA; ?></a>
                  </td>
                  <td><?php echo $akta->NOTARIS; ?></td>
                  <td><?php echo $akta->TGL_AKTA; ?></td>
                  <td>
                    <a href="/FILE_UPLOAD/<?php echo $bidder->ID_PERUSAHAAN?>/DOKUMEN_PERUSAHAAN/AKTA/<?php echo $akta->FILE_PENGESAHAN?>" target="_blank"><?php echo $akta->NO_PENGESAHAN; ?></a>
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

      <div class="form-group">
        <div class="col-md-2 pull-right">
          <a href="<?php echo base_url()?>/Permohonan_izin_eval" class="form-control btn btn-danger"> <i class="glyphicon glyphicon-remove"></i> Batal</a>
        </div>
        <div class="col-md-2 pull-right"> 
          <a href="<?php echo base_url()?>/Permohonan_izin_eval/setuju/<?php echo $bidder->ID_PERUSAHAAN?>" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Setujui</a>
        </div>
      </div>
    </form>

  </div>

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
  });

</script>