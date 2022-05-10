<div class="box-body">
<table id="list-data2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan</th>
      <th>Lokasi</th>
      <th>Informasi</th>
      <th>Kondisi Geologi</th>
      <th>Penyebab Gempa</th>
      <th>Dampak Gempa</th>
      <th>Rekomendasi</th>
    </tr>
  </thead>
  <tbody>
<?php
$no = 1;
foreach ($dataSet as $data) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $data->TANGGAL_LAPORAN; ?></td>
    <td><?php echo $data->LOKASI; ?></td>
    <td><?=nl2br(htmlspecialchars($data->INFORMASI))?></td>
    <td><?=nl2br(htmlspecialchars($data->KONDISI_GEOLOGI_DT))?></td>
    <td><?=nl2br(htmlspecialchars($data->PENYEBAB_GEMPA))?></td>
    <td><?=nl2br(htmlspecialchars($data->DAMPAK_GEMPA))?></td>
    <td><?=nl2br(htmlspecialchars($data->REKOMENDASI))?></td>
</tr>
<?php
$no++;
}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
  
</script>
