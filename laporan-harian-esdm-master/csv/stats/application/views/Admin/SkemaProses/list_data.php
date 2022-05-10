<?php
foreach ($dataProses_skema as $skema_proses) {
  ?>
  <tr>
    <td width="2%"><?php echo $skema_proses->URUTAN; ?></td>
    <td><?php echo $skema_proses->NAMA_PROSES; ?></td>
    <td><?=$skema_proses->IS_FINAL_TTD == "Y" ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>" ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataSkema_proses btn-minier" data-id="<?php echo $skema_proses->ID_PROSES; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-skema_proses btn-minier" data-id="<?php echo $skema_proses->ID_PROSES; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
}
?>