<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>ID Laporan</th>
      <th>Tanggal Laporan</th>
      <th>Berita</th>
      <th>Foto</th>
      <th>Url</th>
      <th style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php if( $IS_ENTRY == "Y" && $IS_REVIEW == "T" && $IS_POST == "T") { ?>  

<?php
$no = 1;
foreach ($dataEntry as $entry) {
  ?>
  <tr>
    <td width="2%"><?php echo $entry; ?></td>
    <td><?php echo $entry->ID_LAPORAN; ?></td>
    <td><?php echo $entry->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($entry->BERITA))?></td>
    <!-- <td><?php echo $entry->JENIS; ?></td> -->
    <td>
      <img src="<?php echo base_url('image_upload/berita/'.$entry->IMAGE) ?>" width="64" />
    </td>
    
    <!--<td><?php echo $data->URL; ?></td>-->
    
    <td><a href="<?php echo $data->URL; ?>"></a></td>


    <td class="text-center" style="min-width:230px;">

    <button class="btn btn-warning update-dataDraftHotNews btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <button class="btn btn-warning update-dataDraftHotNews btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i>Download</button>
   
    <a target="_blank" href="<?php echo base_url().'Lap_geologi/downloadFileTextGunungApi/'.$data->ID_LAPORAN;?>">Download</a>


<?php /*?>    <?php if($IS_POST == 'Y'){ ?>
<?php */?>      
<!--<button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
--><?php /*?>  <?php } ?>
<?php */?> 
  	<button class="btn btn-danger konfirmasiHapus-target btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete
   </button>
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
    <td><?php echo $hasreview->ID_LAPORAN; ?></td>
    <td><?php echo $hasreview->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->BERITA))?></td>
    <!-- <td><?php echo $data->JENIS; ?></td> -->
    <td>
      <img src="<?php echo base_url('image_upload/berita/'.$hasreview->IMAGE) ?>" width="64" />
    </td>
    
<!--    <td><?php echo $hasreview->URL; ?></td>
-->    
	<td><a href="<?php echo $hasreview->URL; ?>"></a></td>
    <td class="text-center" style="min-width:230px;">

   <!--  <button class="btn btn-warning update-dataDraftHotNews btn-minier" data-id="<?php echo $hasreview->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button> -->
    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $hasreview->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
 	
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
    <td><?php echo $data->ID_LAPORAN; ?></td>
    <td><?php echo $data->TANGGAL_LAPORAN; ?></td>
    <td><?=nl2br(htmlspecialchars($data->BERITA))?></td>
    <!-- <td><?php echo $data->JENIS; ?></td> -->
    <td>
      <img src="<?php echo base_url('image_upload/berita/'.$data->IMAGE) ?>" width="64" />
    </td>
    
<!--    <td><?php echo $data->URL; ?></td>
-->    
<!--	<td><a id="link_data" href="javascript: void(0);"><?php echo $data->URL;?></a></td>
-->	<td><a target="_blank" href="https://<?php echo $data->URL;?>"><?php echo $data->URL;?></a></td>
    <td class="text-center" style="min-width:230px;">
	<?php if($IS_ENTRY == 'Y'){ ?>
    <button class="btn btn-warning update-dataDraftHotNews btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-primary  review-dataDraftHotNews btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 1 ?>" ><i class="glyphicon fa fa-search" ></i> Review</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHasReview"><i class="glyphicon glyphicon-ok"></i> Has Review</button>          
  <?php } ?>
	
	<?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
  
      <?php if($IS_ENTRY == 'Y'){ ?>
  <button class="btn btn-danger konfirmasiHapus-target btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete
   </button>
   <?php } ?>
 
   <a target="_blank" href="<?php echo base_url().'Lap_berita/downloadFileTextHotNews/'.$data->ID_LAPORAN;?>">Download</a>

  </td>
</tr>
<?php
$no++;
}
?>
  </tbody>    
<?php } ?>

</tbody>
</table>
<div id="tempat-modal"></div>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		$("#link_data").on("click", function() {
			window.open("http://<?= $data->URL; ?>");
		});
	});
</script>

