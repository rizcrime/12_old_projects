<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan</th>
      <th>Produksi Harian</th>
      <th>Rata - rata Produksi Bulanan</th>
      <th>Rata - rata Produksi Tahunan</th>
      <th>Target APBN </th>
      <th style="text-align: center;">Aksi</th>
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
    <td class="text-center" style="min-width:230px;">
    
    <?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-warning update-dataDraftEkuiMigas btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 4 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
</table>
</div>