<?php
$no = 1;
foreach ($dataPanduan as $panduan) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $panduan->THUMBNAIL; ?></td>
    <td><?php echo $panduan->DOKUMEN; ?></td>
    <td><?php echo $panduan->FILE; ?></td>
    <td><?php echo $panduan->SIZE; ?> KB</td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataPanduan btn-minier" data-id="<?php echo $panduan->ID_PANDUAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-panduan btn-minier" data-id="<?php echo $panduan->ID_PANDUAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>