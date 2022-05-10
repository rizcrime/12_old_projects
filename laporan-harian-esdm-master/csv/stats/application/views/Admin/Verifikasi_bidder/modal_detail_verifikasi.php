<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Data</h3>
  <form>
  <?=get_csrf_token()?>
    <table id="simple-table" class="table table-striped table-bordered table-hover table-custom table-pendaftaran">
      <tr>
        <td width="15%">Nama Perusahaan</td>
        <td width="1%">:</td>
        <td><label type="text" id="txtUrutan" size="4"><?php echo $admin->NAMA_PERUSAHAAN ?></label></td>
      </tr>
      <tr>
        <td>Email Perusahaan</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->EMAIL_PERUSAHAAN ?></label></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->ALAMAT ?></label></td>
      </tr>
      <tr>
        <td>Provinsi</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->NAMA_PROVINSI ?></label></td>
      </tr>
      <tr>
        <td>Kab/Kota</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->NAMA_KABKOT ?></label></td>
      </tr>
      <tr>
        <td>Telp</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->TELEPON ?></label></td>
      </tr>
      <tr>
        <td>Fax</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->FAX ?></label></td>
      </tr>
      <tr>
        <td>Jenis Permohonan</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->STATUS_MODAL ?></label></td>
      </tr>
      <tr>
        <td>Website</td>
        <td>:</td>
        <td><label type="text" id="txtSOP" size="4"><?php echo $admin->WEBSITE ?></label></td>
      </tr>
    </table>
    <div id="npwp-data" data-id="<?=$id_perusahaan?>">
      <div class="uraian-block alert alert-warning" style="color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;margin-bottom: 10px;">
        <h6><strong>Status NPWP</strong></h6>
        <div id="npwn-data-content">
        <h6>Loading...</h6>
        </div>
      </div>
      </div>
    <label>Dokumen Perusahaan</label><br>
    <table id="simple-table" class="table table-striped table-bordered table-hover table-custom table-pendaftaran">    
      <thead>
        <th>Dokumen</th>
        <th>Nomor</th>        
        <th>Tanggal Terbit</th>
        <th>Berlaku Sampai</th>
        <th>File</th>
      </thead>
      <tbody>
      <?php foreach ($dataDokumen as $dokumen): if($dokumen->DOK == NULL) $dokumen->DOK = "-";?>
        <tr>
          <td><?php echo $dokumen->DOKUMEN_PERSYARATAN; ?></td>
          <td><?php echo $dokumen->NOMOR; ?></td>
          <td><?php echo $dokumen->TGL_DOKUMEN; ?></td>
          <td><?php echo $dokumen->TGL_KEDALUARSA; ?></td>
          <td>: <label type="text" id="txtSOP" size="4"><a href='<?=base_url("Verifikasi_bidder/download_perusahaan/{$id_perusahaan}?file={$dokumen->RID}")?>' target="_blank"><?php echo $dokumen->DOK; ?></a></label></td>
        </tr>
      <?php endforeach ?>        
      </tbody>
    </table>
    <label>Akta</label><br>
    <table id="simple-table" class="table table-striped table-bordered table-hover table-custom table-pendaftaran">
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
            <td><a href='<?=base_url("Verifikasi_bidder/download_dokumen/akta/{$id_perusahaan}?file={$akta->ID_AKTA}")?>' target="_blank" target="_blank"><?php echo $akta->NOMOR_AKTA; ?></a></td>
            <td><?php echo $akta->NOTARIS; ?></td>
            <td><?php echo $akta->TGL_AKTA; ?></td>
            <td><a href='<?=base_url("Verifikasi_bidder/download_dokumen/pengesahan/{$id_perusahaan}?file={$akta->ID_AKTA}")?>' target="_blank"><?php echo $akta->NO_PENGESAHAN; ?></a></td>
            <td><?php echo $akta->TGL_PENGESAHAN; ?></td>
          </tr>
          <?php
        }
        ?>        
      </tbody>
  </table>
  <div style="margin-top: 20px; text-align:center;">
    <button type="button" class="btn btn-info btn-danger ban-perusahaan-Verifikasi_bidder" data-id="<?php echo $admin->ID_PERUSAHAAN; ?>">Blacklist Perusahaan</button>
    <?php if($admin->IS_VERIFIED == 'Y') { ?>
      <button class="btn btn-info btn-danger verifikasi-dataVerifikasi_bidder"  data-id="<?php echo $admin->ID_PERUSAHAAN; ?>"><i class="glyphicon glyphicon-check"></i>Nonaktifkan</button>
    <?php } else { ?>
      <button type="button" class="btn btn-info btn-danger tolak-data-Verifikasi_bidder" data-id="<?php echo $admin->ID_PERUSAHAAN; ?>">Tolak</button>
      <button class="btn btn-info btn-success verifikasi-dataVerifikasi_bidder"  data-id="<?php echo $admin->ID_PERUSAHAAN; ?>"><i class="glyphicon glyphicon-check"></i>Terima</button>
    <?php } ?>
    <button class="btn btn-warning" data-dismiss="modal" type="button">Batal</a>
    </div>
  </form>
</div>
