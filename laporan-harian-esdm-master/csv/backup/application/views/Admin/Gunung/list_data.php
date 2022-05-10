<?php
$no = 1;
foreach ($dataGunung as $gunung) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $gunung->ID_GUNUNG; ?></td>
    <td><?php echo $gunung->NAMA_GUNUNG; ?></td>
    <td><?php echo $gunung->NAMA_KABKOT; ?></td>
    <td><?php echo $gunung->NAMA_PROVINSI; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataGunung btn-minier" data-id="<?php echo $gunung->ID_GUNUNG; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-gunung btn-minier" data-id="<?php echo $gunung->ID_GUNUNG; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>