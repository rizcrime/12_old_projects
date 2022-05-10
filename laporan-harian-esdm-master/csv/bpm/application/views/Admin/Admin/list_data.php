<?php
$no = 1;
foreach ($dataAdmin as $admin) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $admin->NAMA_USER; ?></td>
    <td><?php echo $admin->USERNAME; ?></td>
    <td><?php echo $admin->ROLE; ?></td>
    <td>
      <?php if($admin->IS_POST == 'Y') { ?>
        USER POST
      <?php } else { ?>
        DRAFTER
      <?php } ?>        
    </td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn  btn-warning update-dataAdmin btn-minier" data-id="<?php echo $admin->ID_USER; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php if($admin->ID_ROLE != 'ADM'){ ?>
      <button class="btn btn-danger konfirmasiHapus-admin btn-minier" data-id="<?php echo $admin->ID_USER; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
  <?php } ?>
  </td>
</tr>
<?php
$no++;
}
?>

