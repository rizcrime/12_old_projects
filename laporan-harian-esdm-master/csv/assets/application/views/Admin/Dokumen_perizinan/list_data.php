<?php
$no = 1;
foreach ($dataDokumen_perizinan as $dokumen_perizinan) {
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $dokumen_perizinan->NAMA; ?></td>
    <td><?php echo $dokumen_perizinan->NAMA_PERUSAHAAN; ?></td>
    <td><?php echo $dokumen_perizinan->FILE_PERIZINAN; ?></td>
    <?php if($dokumen_perizinan->IS_MANDATORY == 'Y') { ?>
    	<td>YA</td>
    <?php } else { ?>
    	<td>TIDAK</td>
    <?php } ?>
    <?php if($dokumen_perizinan->JENIS_FILE == 1) { ?>
    	<td>PDF</td>
    <?php } else { ?>
    	<td>JPG</td>
    <?php } ?>
    <td><?php echo $dokumen_perizinan->MAX_SIZE; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataDokumen_perizinan btn-minier" data-id="<?php echo $dokumen_perizinan->ID_DOKUMEN_PERIZINAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-dokumen_perizinan btn-minier" data-id="<?php echo $dokumen_perizinan->ID_DOKUMEN_PERIZINAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>  
  	</td>
</tr>
<?php
$no++;
}
?>

