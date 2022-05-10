<?php
$no = 1;
foreach ($dataPerizinan as $perizinan) {
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $perizinan->NAMA; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataPerizinan btn-minier" data-id="<?php echo $perizinan->ID_PERIZINAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-perizinan btn-minier" data-id="<?php echo $perizinan->ID_PERIZINAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
  </td>
</tr>
<?php
$no++;
}
?>

