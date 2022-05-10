<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
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
      <th style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  
<?php if( $IS_ENTRY == "Y" && $IS_REVIEW == "T" && $IS_POST == "T") { ?>    
  <tbody>
<?php
$no = 1;
foreach ($dataEntry as $data) {
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
    <td class="text-center" style="min-width:230px;">
    <button class="btn btn-warning update-dataDraftGempaBumi btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 3 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
   <!-- <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>-->
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
foreach ($dataHasReview as $data) {
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
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
   <!-- <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>-->
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
    <td><?php echo $data->LOKASI; ?></td>
    <td><?=nl2br(htmlspecialchars($data->INFORMASI))?></td>
    <td><?=nl2br(htmlspecialchars($data->KONDISI_GEOLOGI_DT))?></td>
    <td><?=nl2br(htmlspecialchars($data->PENYEBAB_GEMPA))?></td>
    <td><?=nl2br(htmlspecialchars($data->DAMPAK_GEMPA))?></td>
    <td><?=nl2br(htmlspecialchars($data->REKOMENDASI))?></td>
    <td class="text-center" style="min-width:230px;">
    <?php if($IS_ENTRY == 'Y'){ ?>
    <button class="btn btn-warning update-dataDraftGempaBumi btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 3 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
	<?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-primary  review-dataDraftGerakanTanah btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 3 ?>" ><i class="glyphicon fa fa-search" ></i> Review</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHasReview"><i class="glyphicon glyphicon-ok"></i> Has Review</button>          
  <?php } ?>
	<?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
  
      <a target="_blank" href="<?php echo base_url().'Lap_geologi/downloadFileTextGempaBumi/'.$data->ID_LAPORAN;?>">Download</a>

  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
<?php } ?> 

</table>
</div>

<script type="text/javascript">
  
</script>
