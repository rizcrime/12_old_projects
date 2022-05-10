<?php
$no = 1;
foreach ($dataSkemaIzin as $izin) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $izin->NAMA_FORM; ?></td>
    <?php if($izin->NAMA_SKEMA == '') { ?>
    <td><?php echo "-" ?></td>
    <?php } else { ?>
    <td><?php echo $izin->NAMA_SKEMA; ?></td>
    <?php } ?>
    
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataSkemaIzin btn-minier" data-id="<?php echo $izin->ID_FORM; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>