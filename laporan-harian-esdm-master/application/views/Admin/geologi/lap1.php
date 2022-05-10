<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
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
      <th style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  
<?php if( $IS_ENTRY == "Y" && $IS_REVIEW == "T" && $IS_POST == "T") { ?>  
  <tbody>
<?php
$no = 1;
foreach ($dataEntry as $entry) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $entry->TANGGAL_LAPORAN; ?></td>
    <td><?php echo $entry->NAMA_GUNUNG; ?></td>
    <td><?php echo $entry->LEVEL; ?></td>
    <td><?=nl2br(htmlspecialchars($entry->KETERANGAN))?></td>
    <td><?=nl2br(htmlspecialchars($entry->REKOMENDASI))?></td>
    <td><?=nl2br(htmlspecialchars($entry->VONA))?></td>
    <td><?=nl2br(htmlspecialchars($entry->DETAIL))?></td>
    <td class="text-center" style="min-width:230px;">
    
      <button class="btn btn-warning update-dataDraftGunungapi btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>

  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
<?php } 

else if( $IS_ENTRY == "T" && $IS_REVIEW == "T" && $IS_POST == "Y") { ?>  
  <tbody>
<?php
$no = 1;
foreach ($dataHasReview as $hasreview) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $hasreview->TANGGAL_LAPORAN; ?></td>
    <td><?php echo $hasreview->NAMA_GUNUNG; ?></td>
    <td><?php echo $hasreview->LEVEL; ?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->KETERANGAN))?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->REKOMENDASI))?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->VONA))?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->DETAIL))?></td>
    <td class="text-center" style="min-width:230px;">
    
    <button class="btn btn-warning update-dataDraftGunungapi btn-minier" data-id="<?php echo $hasreview->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> POST</button>
    <!-- <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $hasreview->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?> -->
  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
<?php } 
 

   else 
{ ?>
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
    <td class="text-center" style="min-width:230px;">
    
    <?php if($IS_ENTRY == 'Y'){ ?>
    <button class="btn btn-warning update-dataDraftGunungapi btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-primary  review-dataDraftGunungapi btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>" ><i class="glyphicon fa fa-search" ></i> Review</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHasReview"><i class="glyphicon glyphicon-ok"></i> Has Review</button>          
  <?php } ?>
	
	<?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
  
  <a target="_blank" href="<?php echo base_url().'Lap_geologi/downloadFileTextGunungApi/'.$data->ID_LAPORAN;?>">Download</a>

  
  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
<?php } ?>   

</table>
<div id="tempat-modal"></div>

</div>

<script type="text/javascript">
  
</script>
