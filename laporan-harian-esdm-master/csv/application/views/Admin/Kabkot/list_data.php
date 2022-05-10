<?php
$no = 1;
foreach ($dataKabkot as $kabkot) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $kabkot->NAMA_PROVINSI; ?></td>
    <td><?php echo $kabkot->NAMA_KABKOT; ?></td>
    <td><?php echo $kabkot->NAMA_KABKOT_EN; ?></td>
    <td><?php echo $kabkot->MULAI_EXIST; ?></td>
    <td><?php echo $kabkot->AKHIR_EXIST; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-info detail-dataKabkot btn-minier" data-id="<?php echo $kabkot->ID_KABKOT; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      <button class="btn btn-warning update-dataKabkot btn-minier" data-id="<?php echo $kabkot->ID_KABKOT; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-kabkot btn-minier" data-id="<?php echo $kabkot->ID_KABKOT; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>