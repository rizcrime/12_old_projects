<?php
$no = 1;
foreach ($dataAdmin as $admin) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $admin->ROLE; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-info update-dataAdmin btn-minier" data-id="<?= $admin->ID_ROLE ?>"><i class="glyphicon glyphicon-plus"></i> Hak Izin</button>
    </td>
</tr>
<?php
$no++;
}
?>

