<?php
$no = 1;
foreach ($dataProvinsi as $provinsi) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $provinsi->NAMA_PROVINSI; ?></td>
    <td><?php echo $provinsi->NAMA_PROVINSI_EN; ?></td>
    <td><?php echo $provinsi->MULAI_EXIST; ?></td>
    <td><?php echo $provinsi->AKHIR_EXIST; ?></td>
    <td><?php echo $provinsi->KODE_PROVINSI; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-info detail-dataProvinsi btn-minier" data-id="<?php echo $provinsi->ID_PROVINSI; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      <button class="btn btn-warning update-dataProvinsi btn-minier" data-id="<?php echo $provinsi->ID_PROVINSI; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-provinsi btn-minier" data-id="<?php echo $provinsi->ID_PROVINSI; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>