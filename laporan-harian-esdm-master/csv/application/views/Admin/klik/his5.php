<div class="box-body">
<table id="list-data2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan</th>
      <th>Berita</th>
      <th>Jenis</th>
      <th>Url</th>
      
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
    <td><?=nl2br(htmlspecialchars($data->BERITA))?></td>
    <td><?php echo $data->JENIS; ?></td>
    <td><?php echo $data->URL; ?></td>
    
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

