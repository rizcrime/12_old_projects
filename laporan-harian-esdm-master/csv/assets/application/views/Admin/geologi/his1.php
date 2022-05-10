<div class="box-body">
<table id="list-data2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan</th>
      <th>Nama Gunung</th>
      <th>Aktivita</th>
      <th>Keterangan</th>
      <th>Rekomendasi</th>
      <th>Vona</th>
      <th>Detail</th>
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
    <td><?php echo $data->NAMA_GUNUNG; ?></td>
    <td><?php echo $data->LEVEL; ?></td>
    <td><?=nl2br(htmlspecialchars($data->KETERANGAN))?></td>
    <td><?=nl2br(htmlspecialchars($data->REKOMENDASI))?></td>
    <td><?=nl2br(htmlspecialchars($data->VONA))?></td>
    <td><?=nl2br(htmlspecialchars($data->DETAIL))?></td>
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
