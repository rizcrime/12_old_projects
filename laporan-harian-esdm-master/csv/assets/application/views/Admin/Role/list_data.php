<?php
$no = 1;
foreach ($dataRole as $role) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $role->ID_ROLE; ?></td>
    <td><?php echo $role->ROLE; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataRole btn-minier" data-id="<?php echo $role->ID_ROLE; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-role btn-minier" data-id="<?php echo $role->ID_ROLE; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>