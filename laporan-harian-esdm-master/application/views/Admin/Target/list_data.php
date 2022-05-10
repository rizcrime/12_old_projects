<?php
$no = 1;
foreach ($dataTarget as $target) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $target->ID_TARGET; ?></td>
    <td><?php echo $target->APBN_PROD_MINYAK; ?></td>
    <td><?php echo $target->APBN_PROD_GAS; ?></td>
    <td><?php echo $target->APBN_EKV_MIGAS; ?></td>
    <td><?php echo $target->TAHUN; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataTarget btn-minier" data-id="<?php echo $target->ID_TARGET; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-target btn-minier" data-id="<?php echo $target->ID_TARGET; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>