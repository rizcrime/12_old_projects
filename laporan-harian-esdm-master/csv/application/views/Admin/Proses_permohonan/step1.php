<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
    <form method="POST" action="<?php echo base_url('Proses_permohonan/prosesUpdate') ?>" enctype="multipart/form-data">
    <?=get_csrf_token()?>
      <div class="input-group form-group" style="width: 100%">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
          <h4><strong>Profil Perusahaan</strong></h4>
        </div>

          <div class="col-md-6">
            <table width="100%">
              <tr>
                <td colspan="2" style="padding-bottom: 10px">Nama Perusahaan *</td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->NAMA_PERUSAHAAN ?>" name="NAMA_PERUSAHAAN" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">Alamat Perusahaan *</td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">
                  <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2"><?= $bidder->ALAMAT ?></textarea>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Provinsi</td>
                <td style="padding-bottom: 10px">
                  <select name="ID_PROVINSI" id="PROVINSI" class="form-control">
                    <?php foreach ($dataProvinsi as $provinsi): ?>
                      <option <?php if($provinsi->ID_PROVINSI == "$provinsi->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php endforeach ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Kab / Kota</td>
                <td style="padding-bottom: 10px">
                  <select name="ID_KABKOT" class="KABKOT form-control">
                    <option value="<?= $bidder->ID_KABKOT ?>"><?= $bidder->NAMA_KABKOT ?></option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table width="100%">
              <tr>
                <td style="padding-bottom: 10px">E-mail *</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" value="<?= $bidder->EMAIL_PERUSAHAAN ?>" aria-describedby="sizing-addon2" readonly>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Telp. *</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Fax</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->FAX ?>" name="FAX" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Jenis Permodalan *</td>
                <td style="padding-bottom: 10px">
                  <select name="STATUS_MODAL" class="form-control">
                    <?php if($bidder->STATUS_MODAL == 'PMA') { ?>                  
                      <option value="<?= $bidder->STATUS_MODAL ?>"><?= $bidder->STATUS_MODAL ?></option>
                      <option value="PMDN">PMDN</option>
                    <?php } else if($bidder->STATUS_MODAL == 'PMDN') { ?>
                      <option value="<?= $bidder->STATUS_MODAL ?>"><?= $bidder->STATUS_MODAL ?></option>
                      <option value="PMA">PMA</option>
                    <?php } else { ?>
                      <option value=""></option>
                      <option value="PMDN">PMDN</option>
                      <option value="PMA">PMA</option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Website</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->WEBSITE ?>" name="WEBSITE" aria-describedby="sizing-addon2">
                </td>
              </tr>
            </table>
          </div>

        </div>

        <div class="input-group form-group" style="width: 100%">

          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Dokumen Perusahaan</strong></h4>
          </div>

          <div class="col-md-12">
            <table class="table table-bordered table-striped" style="padding: 10px">
              <thead>
                <tr>
                  <th>Dokumen</th>
                  <th>Nomor</th>
                  <th>Tanggal Terbit</th>
                  <th>Berlaku Sampai</th>
                  <th>File</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
                <?php foreach ($dataDokumen as $dokumen): ?>
                  <tr>
                    <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                    <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                    <td style="padding: 0px">
                      <input type="text" disabled class="form-control" value="<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="text" name="NOMOR[]" class="form-control" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="date" name="TGL_DOKUMEN[]" class="form-control" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="date" name="TGL_KEDALUARSA[]" class="form-control" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                    <td style="padding: 0px">
                      <?php if(isset($dokumen->RID)) { ?>
                        <a href="images/<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>"><?php echo $dokumen->DOKUMEN_PERSYARATAN ?></a><br>
                      <?php } ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>">
                      <input type="file" class="form-control" name="DOKUMEN_PERSYARATAN[]" aria-describedby="sizing-addon2">
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>

          </div>

        </div>

        <div class="input-group form-group" style="width: 100%">

          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Dokumen Perusahaan</strong></h4>
          </div>
          <div class="col-md-3">
            <a class="form-control btn btn-info" data-toggle="modal" data-target="#tambah-akta"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Akta</a>
          </div>


          <div class="col-md-12">
            <table id="list-data" class="table table-bordered">
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
              <tbody id="data-akta">
              </tbody>
            </table>
          </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success pull-right">Next</button>
        </div>
      </form>
    </div>

    <?php echo $modal_add_akta; ?>

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
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#PROVINSI').change(function(){
        var id=$(this).val();
        $.ajax({
          url : "<?php echo base_url();?>Proses_permohonan/get_kabkot",
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