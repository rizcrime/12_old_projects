<?php
$no = 1;
foreach ($dataT_persyaratan_izin as $t_persyaratan_izin) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $t_persyaratan_izin->PERSYARATAN; ?></td>
    <td><a href='<?=base_url("TemplateContoh/download_template?file={$t_persyaratan_izin->ID_PERSYARATAN}")?>' target="_blank"><?php echo $t_persyaratan_izin->FILE_CONTOH; ?></a></td>
    <td><?php echo $t_persyaratan_izin->IS_MANDATORY; ?></td>
    <td><?php echo $t_persyaratan_izin->JENIS_FILE; ?></td>
    <td><?php echo number_format($t_persyaratan_izin->MAX_SIZE,0, ",","."); ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataT_persyaratan_izin btn-minier" data-id="<?php echo $t_persyaratan_izin->ID_PERSYARATAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-t_persyaratan_izin btn-minier" data-id="<?php echo $t_persyaratan_izin->ID_PERSYARATAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>