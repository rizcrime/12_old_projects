<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>ID lAPORAN</th>
      <th>Tanggal Laporan</th>
      <th>Lifting Minyak Bumi</th>
      <th>Salur Gas</th>
      <th>Lifting Elpigi</th>
      <!--<th>Posisi Stock hari ini</th>-->
      <!--<th>Salur Gas</th>-->
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
    <td>LAP. <?php echo $entry->ID_LAPORAN; ?></td>
    <td><?php echo $entry->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($entry->LIFT_MB))?></td>
    <td><?=nl2br(htmlspecialchars($entry->SALUR_GAS))?></td>
    <td><?=nl2br(htmlspecialchars($entry->LIFT_GAS))?></td>
    <!--<td><?=nl2br(htmlspecialchars($entry->POSISI_STOCK))?></td>-->
    <!--<td><?=nl2br(htmlspecialchars($entry->SALUR_GAS))?></td>-->
    <td class="text-center" style="min-width:230px;">
    
    <!-- <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-warning update-dataDraftLiftingTB btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 5 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>

    <?php } ?> -->

    <button class="btn btn-warning update-dataDraftLiftingTB btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 5 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    
    <!-- <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
    <?php } ?> -->
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
foreach ($dataHasReview as $review) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td>LAP. <?php echo $review->ID_LAPORAN; ?></td>
    <td><?php echo $review->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($review->LIFT_MB))?></td>
    <td><?=nl2br(htmlspecialchars($review->LIFT_GAS))?></td>
   <!-- <td><?=nl2br(htmlspecialchars($review->POSISI_STOCK))?></td>-->
    <td><?=nl2br(htmlspecialchars($review->SALUR_GAS))?></td>
    <td class="text-center" style="min-width:230px;">
    
    <!-- <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-warning update-dataDraftLiftingTB btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 5 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?> -->
    <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $review->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>

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
    <td>LAP. <?php echo $data->ID_LAPORAN; ?></td>
    <td><?php echo $data->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($data->LIFT_MB))?></td>
    <td><?=nl2br(htmlspecialchars($data->LIFT_GAS))?></td>
    <!--<td><?=nl2br(htmlspecialchars($data->POSISI_STOCK))?></td>-->
    <td><?=nl2br(htmlspecialchars($data->SALUR_GAS))?></td>
    <td class="text-center" style="min-width:230px;">
    
    <?php if($IS_ENTRY == 'Y'){ ?>
    	<button class="btn btn-warning update-dataDraftLiftingTB btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 5 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-primary  review-dataDraftLiftingTB btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 5 ?>" ><i class="glyphicon fa fa-search" ></i> Review</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHasReview"><i class="glyphicon glyphicon-ok"></i> Has Review</button>          
    <?php } ?>


    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>

<!--      <a target="_blank" href="<?php echo base_url().'Lap_pusdatin/downloadFileTextLiftingTB/'.$data->ID_LAPORAN;?>">Download</a>
-->  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
<?php } ?>

</table>
</div>

