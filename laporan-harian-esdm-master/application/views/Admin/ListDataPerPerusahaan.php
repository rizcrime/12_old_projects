<?php
$no = 1;
$i = 0;
foreach ($DataPermohonanDetail as $row) {
  ?>
  <tr <?php echo (($row->on_track == false) ? 'style="color: red;"' : ''); ?>>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $row->data_permohonan->NAMA_PERUSAHAAN; ?></td>
    <td><?php echo date('d-M-Y' ,strtotime($row->data_permohonan->TGL_PENGAJUAN)); ?></td>
    <td><?php echo $DataPermohonan[$i]->NAMA_TEMPLATE; ?></td>
    <td><?php echo $row->sla_izin . ' hari kerja'; ?></td>
    <td><?php echo (($row->on_track == true) ? "Tidak" : "Ya"); ?></td>
    <td>
    	<a class="btn btn-info btn-minier permohonan-detail-per-perusahaan" data-id="<?=$row->data_permohonan->ID_PERMOHONAN?>">
    		<i class="glyphicon glyphicon-info-sign"></i> Detail
    	</a>
    </td>
  </tr>
<?php
$no++;
$i++;
}
?>

