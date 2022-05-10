<?php
$no = 1;
foreach ($DataPermohonanDetail as $row) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?=$row->ROLE?></td>
    <td><?=date('d-M-Y' ,strtotime($row->TGL_PENGAJUAN))?></td>
    <td>
    	<a class="btn btn-info btn-minier permohonan-detail-per-role" data-id="<?=$row->ID_ROLE?>" data-tgl="<?=date('Y-m-d' ,strtotime($row->TGL_PENGAJUAN))?>">
    		<i class="glyphicon glyphicon-info-sign"></i> Detail
    	</a>
    </td>
  </tr>
<?php
$no++;
}
?>

