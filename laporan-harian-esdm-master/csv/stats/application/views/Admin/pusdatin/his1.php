<div class="box-body">
<table id="list-data2" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan </th>
      <th>Produksi Minyak Harian (BOPD)</th>
      <th>Rata - rata Produksi Bulanan (BOPD)</th>
      <th>Rata - rata Produksi Tahunan (BOPD)</th>
      <th>Target APBN (BOPD)</th>
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
    <td><?php echo number_format( $data->PROD_HARIAN,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_BULANAN,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_TAHUNAN,0,',','.') ?></td>
    <td><?php echo number_format( $data->APBN,0,',','.') ?></td>
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
