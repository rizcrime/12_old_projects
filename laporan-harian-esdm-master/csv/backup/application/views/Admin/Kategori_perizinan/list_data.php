<?php
$no = 1;
foreach ($dataKategori_perizinan as $kategori_perizinan) {
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $kategori_perizinan->NAMA; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataKategori_perizinan btn-minier" data-id="<?php echo $kategori_perizinan->ID_KATEGORI_PERIZINAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-kategori_perizinan btn-minier" data-id="<?php echo $kategori_perizinan->ID_KATEGORI_PERIZINAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
  </td>
</tr>
<?php
$no++;
}
?>

