<?php
foreach ($list_izin as $key => $row) {
  ?>
  <tr>
    <td width="2%"><?php echo $key + 1; ?></td>
    <td><?=$row->NAMA_TEMPLATE?></td>
    <td><?=$row->JUMLAH_MASUK?></td>
    <td><?=$row->JUMLAH_DISETUJUI?></td>
    <td><?=$row->JUMLAH_DITOLAK?></td>
    <td><?=$row->JUMLAH_DIPROSES?></td>
  </tr>
<?php
}
?>

