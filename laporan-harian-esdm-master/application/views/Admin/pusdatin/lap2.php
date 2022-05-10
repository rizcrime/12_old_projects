<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th width="14%">ID LAPORAN</th>
      <th width="11%">Tanggal Laporan</th>
	  <th width="42%">Jan</th>
      <th width="42%">Feb</th>
      <th width="42%">Mar</th>
      <th width="42%">Apr</th>
      <th width="42%">Mei</th>
      <th width="42%">Jun</th>
      <th width="42%">Jul</th>
      <th width="42%">Ags</th>
      <th width="42%">Sep</th>
      <th width="42%">Okt</th>
      <th width="42%">Nov</th>
      <th width="42%">Des</th>
      <th width="42%">Laporan</th>
      <th width="29%" style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  
<?php if( $IS_ENTRY == "Y" && $IS_REVIEW == "T" && $IS_POST == "T") { ?>    
  <tbody>
<?php
$no = 1;
foreach ($dataEntry as $entry) {
  ?>
  <tr>
    <td width="4%"><?php echo $no; ?></td>
    <td>LAP. <?php echo $entry->ID_LAPORAN; ?></td>
    <td><?php echo $entry->TANGGAL_LAPORAN; ?></td>
    <td><?php echo number_format( $entry->PROD_01,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_02,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_03,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_04,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_05,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_06,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_07,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_08,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_09,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_10,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_11,0,',','.') ?></td>
    <td><?php echo number_format( $entry->PROD_12,0,',','.') ?></td>
    <td><?=nl2br(htmlspecialchars($entry->CATATAN))?></td>
    <td class="text-center" style="min-width:230px;">
    
   <?php /*?> <!--<?php if($IS_REVIEW == 'Y'){ ?>--><?php */?>
    	<button class="btn btn-warning update-dataDraftICP btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 2 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php /*?><!--<?php } ?>--><?php */?>
    
    <!--<?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
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
foreach ($dataHasReview as $hasreview) {
  ?>
  <tr>
    <td width="4%"><?php echo $no; ?></td>
    <td>LAP. <?php echo $hasreview->ID_LAPORAN; ?></td>
    <td><?php echo $hasreview->TANGGAL_LAPORAN; ?></td>
    <td><?php echo number_format( $hasreview->PROD_01,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_02,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_03,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_04,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_05,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_06,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_07,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_08,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_09,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_10,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_11,0,',','.') ?></td>
    <td><?php echo number_format( $hasreview->PROD_12,0,',','.') ?></td>
    <td><?=nl2br(htmlspecialchars($hasreview->CATATAN))?></td>
    <td class="text-center" style="min-width:230px;">
    
    <?php /*?><?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-warning update-dataDraftICP btn-minier" data-id="<?php echo $entry->ID_LAPORAN; ?>" data-jenis="<?php echo 2 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?><?php */?>
    
    <?php /*?><?php if($IS_POST == 'Y'){ ?><?php */?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $hasreview->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button></td>
</tr>
<?php
$no++;
}
?>
  </tbody>  
  
<?php } 

else  { ?>
<tbody>
<?php
$no = 1;
foreach ($dataSet as $data) {
  ?>
  <tr>
    <td width="4%"><?php echo $no; ?></td>
    <td>LAP. <?php echo $data->ID_LAPORAN; ?></td>
    <td><?php echo $data->TANGGAL_LAPORAN; ?></td>
    <td><?php echo number_format( $data->PROD_01,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_02,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_03,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_04,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_05,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_06,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_07,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_08,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_09,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_10,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_11,0,',','.') ?></td>
    <td><?php echo number_format( $data->PROD_12,0,',','.') ?></td>
    <td><?=nl2br(htmlspecialchars($data->CATATAN))?></td>
    
    <td class="text-center" style="min-width:230px;">
    
    <?php if($IS_ENTRY == 'Y'){ ?>
    	<button class="btn btn-warning update-dataDraftICP btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 2 ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
    	<button class="btn btn-primary  review-dataDraftICP btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-jenis="<?php echo 2 ?>" ><i class="glyphicon fa fa-search" ></i> Review</button>
    <?php } ?>
    
    <?php if($IS_REVIEW == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiHasReview"><i class="glyphicon glyphicon-ok"></i> Has Review</button>          
  <?php } ?>
    
    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPostSingle"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>

<!--      <a target="_blank" href="<?php echo base_url().'Lap_pusdatin/downloadFileTextICP/'.$data->ID_LAPORAN;?>">Download</a>
-->  </td>
</tr>
<?php
$no++;
}
?>
  </tbody>    
<?php } ?>
</table>
<span class="text-center" style="min-width:230px;">
<?php /*?><?php } ?><?php */?>
</span></div>

