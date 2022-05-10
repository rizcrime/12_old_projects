<?php
foreach ($dataAkta as $akta) {
  ?>
  <tr>
    <td><?php echo $akta->IS_PERUBAHAN; ?></td>
    <td><?php echo $akta->NOMOR_AKTA; ?></td>
    <td><?php echo $akta->NOTARIS; ?></td>
    <td><?php echo $akta->TGL_AKTA; ?></td>
    <td><?php echo $akta->NO_PENGESAHAN; ?></td>
    <td><?php echo $akta->TGL_PENGESAHAN; ?></td>
  </tr>
  <?php
}
?>