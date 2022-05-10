<?php
$no = 1;
foreach ($dataAktivitas as $aktivitas) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $aktivitas->ID_AKTIVITAS; ?></td>
    <td><?php echo $aktivitas->LEVEL; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataAktivitas btn-minier" data-id="<?php echo $aktivitas->ID_AKTIVITAS; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-aktivitas btn-minier" data-id="<?php echo $aktivitas->ID_AKTIVITAS; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>