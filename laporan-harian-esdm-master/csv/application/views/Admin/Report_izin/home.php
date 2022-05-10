<?php if($this->session->flashdata('msg')): ?>
  <div class="alert alert-info alert-dismissible" style="margin-top: 5px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p><i class="glyphicon glyphicon-info-sign"></i><strong> <?php echo $this->session->flashdata('msg'); ?></strong></p>
  </div>
<?php endif; ?>
<div class="center">
    Bulan
    <select id="BULAN">
      <?php
        $tgl = intval(date('m'));
        $val = '';
        for ($i=1; $i <= 12 ; $i++) {
          if ($i == 1) {
            $bulan = 'Januari';
          } elseif ($i == 2) {
            $bulan = 'Febuari';
          } elseif ($i == 3) {
            $bulan = 'Maret';
          } elseif ($i == 4) {
            $bulan = 'April';
          } elseif ($i == 5) {
            $bulan = 'Mei';
          } elseif ($i == 6) {
            $bulan = 'Juni';
          } elseif ($i == 7) {
            $bulan = 'Juli';
          } elseif ($i == 8) {
            $bulan = 'Agustus';
          } elseif ($i == 9) {
            $bulan = 'September';
          } elseif ($i == 10) {
            $bulan = 'Oktober';
          } elseif ($i == 11) {
            $bulan = 'November';
          } elseif ($i == 12) {
            $bulan = 'Desember';
          }

          if ($i == $tgl) {
            echo '<option value="'.$i.'" selected>'.$bulan.'</option>';
          } else {
            echo '<option value="'.$i.'">'.$bulan.'</option>';
          }
        }
      ?>
    </select>
    <select id="TAHUN">
      <?php
        $year = date('Y');
        $yearpast = $year - 10;
        $val = '';
        for ($i=1; $i <= 10 ; $i++) {
          $temp = $yearpast + $i;
          if ($temp == $year) {
            echo '<option value="'.$temp.'" selected>'.$temp.'</option>';
          } else {
            echo '<option value="'.$temp.'">'.$temp.'</option>';
          }
        }
      ?>
    </select>
    <button id="pilihPermohonan">Submit</button>
</div>
  <br>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="bar" style="width:100%; height:400px;"></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="bar-izin-masuk" style="width:100%; height:400px;"></div>
    </div>
  </div>
  <br>
  <!-- added by rendra -->
  <div class="box-body" style="background-color: white">
    <div id="judulReportIzinPerPerusahaan"></div>
    <table id="list-report-izin-per-perusahaan" class="display" width="100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="15%">NAMA PERUSAHAAN</th>
          <th width="15%">TGL PENGAJUAN</th>
          <th width="30%">JENIS IZIN</th>
          <th width="15%">SOP</th>
          <th width="15%">MELEBIHI SOP</th>
          <th width="5%">AKSI</th>
        </tr>
      </thead>
      <tbody id="data-report-izin-per-perusahaan">

      </tbody>
    </table>
  </div>
  <br>

  <div class="box-body" style="background-color: white">
    <div id="judulReportIzinPerIzin"></div>
    <table id="list-report-izin-per-izin" class="display" width="100%">
      <thead>
        <tr>
          <th width="10%">#</th>
          <th width="50%">JENIS IZIN</th>
          <th width="10%">SOP</th>
          <th width="10%">Ongoing</th>
          <th width="10%">On track</th>
          <th width="10%">At risk</th>
          <th width="10%">Overdue</th>
          <th width="10%">AKSI</th>
        </tr>
      </thead>
      <tbody id="data-report-izin-per-izin">

      </tbody>
    </table>
  </div>
  <br>

  <!-- <div class="center">
    Skema
    <select id="SKEMA">
      <option value="-1">Pilih skema</option>
      <?php
        // foreach ($DataSkema as $skema) {
        //   echo '<option value="'. $skema->ID_SKEMA .'">'. $skema->NAMA_SKEMA .'</option>';
        // }
      ?>
    </select>
    <button id="pilihSkema">Submit</button>
  </div>
  <br> -->
  <!-- <div class="box-body" style="background-color: white">
    <div id="judulReportIzinPerRole"></div>
    <table id="list-report-izin-per-role" class="display" width="100%">
      <thead>
        <tr>
          <th width="10%">#</th>
          <th width="40%">ROLE</th>
          <th width="25%">MENGURUS PERMOHONAN YANG MASUK PADA TANGGAL</th>
          <th width="25%">AKSI</th>
        </tr>
      </thead>
      <tbody id="data-report-izin-per-role">

      </tbody>
    </table>
  </div> -->

<div id="tempat-modal"></div>
