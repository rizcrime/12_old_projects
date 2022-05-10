<?php
$no = 1;
foreach ($DataPermohonanDetail as $row) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?=$row->NAMA_TEMPLATE?></td>
    <td><?=$row->LAMA_HARI_SLA?> hari kerja</td>
    <td><?=$row->ONGOING_COUNT?></td>
    <td><?=$row->ON_TRACK_COUNT?></td>
    <td><?=$row->AT_RISK_COUNT?></td>
    <td><?=$row->OVERDUE_COUNT?></td>
    <td>
    	<a class="btn btn-info btn-minier permohonan-detail-per-izin" data-id="<?=$row->ID_TEMPLATE?>">
    		<i class="glyphicon glyphicon-info-sign"></i> Detail
    	</a>
    </td>
  </tr>
<?php
$no++;
}
?>

