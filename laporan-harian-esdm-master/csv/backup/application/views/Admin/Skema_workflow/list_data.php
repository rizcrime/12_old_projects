<?php
$no = 1;
foreach ($dataSkema_workflow as $skema_workflow) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $skema_workflow->NAMA_SKEMA; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataSkema_workflow btn-minier" data-id="<?php echo $skema_workflow->ID_SKEMA; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-skema_workflow btn-minier" data-id="<?php echo $skema_workflow->ID_SKEMA; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>