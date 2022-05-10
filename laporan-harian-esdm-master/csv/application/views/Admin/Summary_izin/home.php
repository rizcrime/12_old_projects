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
  <!-- added by rendra -->
  <div class="box-body" style="background-color: white">
    <div id="judulReportIzinPerIzin"></div>
    <table id="list-report-izin-jumlah" class="display" width="100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="35%">Jenis Izin</th>
          <th width="20%">Jumlah Masuk</th>
          <th width="20%">Jumlah Disetujui</th>
          <th width="20%">Jumlah Ditolak</th>
          <th width="20%">Jumlah Diproses</th>
        </tr>
      </thead>
      <tbody id="data-report-izin-per-izin">

      </tbody>
    </table>
  </div>
  <br>

  <div class="box-body" style="background-color: white">
    <div id="judulReportPerPermohonan"></div>
    <table id="list-report-permohonan" class="display" width="100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th>Permohonan</th>
          <th>Jenis Izin</th>
          <th>Proses</th>
          <th>Nama Penanggung Jawab</th>
          <th>Mulai Proses</th>
          <th>Selesai Proses</th>
          <th>Waktu Kerja</th>
          <th>Status</th>
          <th>SOP</th>
        </tr>
      </thead>
      <tbody id="data-report-izin-per-permohonan">
        <!-- <tr>
          <td rowspan="3">1</td>
          <td rowspan="3">PT. Baru Makan</td>
          <td rowspan="3">Kartu Izin Makan</td>
          <td>Evaluasi oleh Evaluator</td>
          <td>Belum pernah di proses</td>
          <td>2018-10-02 14:12:07</td>
          <td>2018-10-02 14:12:07</td>
          <td>17 menit 59 detik </td>
          <td>1 Hari</td>
        </tr>
        <tr>
          <td>Evaluasi oleh Evaluator</td>
          <td>Belum pernah di proses</td>
          <td>2018-10-02 14:12:07</td>
          <td>2018-10-02 14:12:07</td>
          <td>17 menit 59 detik </td>
          <td>1 Hari</td>
        </tr>
        <tr>
          <td>Evaluasi Eselon 4</td>
          <td>Belum pernah di proses</td>
          <td>2018-10-02 14:12:07</td>
          <td>2018-10-02 14:12:07</td>
          <td>17 menit 59 detik </td>
          <td>1 Hari</td>
        </tr> -->
      </tbody>
    </table>
  </div>
  <br>

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
