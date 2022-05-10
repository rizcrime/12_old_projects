<?php
$no = 1;
foreach ($dataMapping_izin as $mapping_izin) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $mapping_izin->NAMA_FORM; ?></td>
     <td class="text-center" style="min-width:230px;">
      <button class="btn btn-info detail-dataMapping_izin btn-minier" data-id="<?php echo $mapping_izin->ID_FORM; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      <button class="btn btn-warning btn-minier update-dataMapping_izin" data-id="<?php echo $mapping_izin->ID_FORM; ?>"><i class="glyphicon glyphicon-repeat"></i> Mapping</button>
      <button class="btn btn-success btn-minier update-dataUrutan_izin" data-id="<?php echo $mapping_izin->ID_FORM; ?>"><i class="glyphicon glyphicon-repeat"></i> Urutan</button>
      <button class="btn btn-danger konfirmasiHapus-mapping_izin btn-minier" data-id="<?php echo $mapping_izin->ID_FORM; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Clear</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>