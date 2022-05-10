<?php
$no = 1;
foreach ($DataPermohonanDitolak as $row) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $row->NAMA_PERUSAHAAN; ?></td>
    <td><?php echo date('d-M-Y' ,strtotime($row->TGL_PENGAJUAN)); ?></td>
    <td><?php echo $row->NAMA_FORM; ?></td>
    <td><?php echo $row->NAMA; ?></td>
    <td>
      <a class="btn btn-info btn-minier" href='<?=base_url("Permohonan_izin_both/arsip_detail/{$row->ID_PERMOHONAN}")?>'><i class="glyphicon glyphicon-info-sign"></i> Detail</a>
    </td>
</tr>
<?php
$no++;
}
?>

