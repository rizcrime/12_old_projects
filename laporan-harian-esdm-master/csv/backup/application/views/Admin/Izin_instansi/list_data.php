<?php
$no = 1;
foreach ($dataIzin_instansi as $izin_instansi) {
  ?>
  <tr>
    <td width="5%"><?php echo $no; ?></td>
    <td><?php echo $izin_instansi->NAMA_FORM; ?></td>
    <td><?php echo $izin_instansi->KETERANGAN; ?></td>
    <td><?php echo $izin_instansi->LAMA_HARI_SLA; ?></td>
  </tr>
  <?php
  $no++;
}
?>