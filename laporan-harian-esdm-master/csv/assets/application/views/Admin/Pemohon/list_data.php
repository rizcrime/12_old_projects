<?php
$no = 1;
foreach ($dataPemohon as $pemohon) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $pemohon->NAMA_LENGKAP; ?></td>
    <td><?php echo $pemohon->ALAMAT; ?></td>
    <td><?php echo $pemohon->NOMOR_TELP; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataPemohon btn-minier" data-id="<?php echo $pemohon->ID_PEMOHON; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-pemohon btn-minier" data-id="<?php echo $pemohon->ID_PEMOHON; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>