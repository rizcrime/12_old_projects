<?php
$no = 1;
foreach ($dataSyaratKetentuan as $syarat_ketentuan) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $syarat_ketentuan->ID_KETENTUAN; ?></td>
    <td><?php echo $syarat_ketentuan->DESKRIPSI; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataSyaratKetentuan btn-minier" data-id="<?php echo $syarat_ketentuan->ID_KETENTUAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-syarat_ketentuan btn-minier" data-id="<?php echo $syarat_ketentuan->ID_KETENTUAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>