<?php
foreach ($dataAkta as $akta) {
  if ($akta->IS_PERUBAHAN == "Y"){
    $akta->IS_PERUBAHAN = "Pendirian";
  } else {
    $akta->IS_PERUBAHAN = "Perubahan";
  }
  ?>
  <tr>
    <td><?php echo $akta->IS_PERUBAHAN; ?></td>
    <td><a href='<?=base_url("Profile_perusahaan/download_dokumen/akta?file={$akta->ID_AKTA}")?>' target="_blank" target="_blank"><?php echo $akta->NOMOR_AKTA; ?></a></td>
    <td><?php echo $akta->NOTARIS; ?></td>
    <td><?php echo $akta->TGL_AKTA; ?></td>
    <td><a href='<?=base_url("Profile_perusahaan/download_dokumen/pengesahan?file={$akta->ID_AKTA}")?>' target="_blank" target="_blank"><?php echo $akta->NO_PENGESAHAN; ?></a></td>
    <td><?php echo $akta->TGL_PENGESAHAN; ?></td>
    <td class="text-center">
      <!-- <a href="#" class="btn btn-success update-dataAkta btn-minier" data-id="<?php echo $akta->ID_AKTA; ?>"><i class="glyphicon glyphicon-pencil"></i></a>  -->
      <i class="btn btn-success btn-minier glyphicon glyphicon-pencil update-dataAkta" id="reload" data-id="<?php echo $akta->ID_AKTA; ?>"></i>  &nbsp; 
      <i class="btn btn-danger btn-minier glyphicon glyphicon-remove-sign konfirmasiHapus-dataAkta" data-id="<?php echo $akta->ID_AKTA; ?>" data-toggle="modal" data-target="#konfirmasiHapus" ></i></td>
  </tr>
  <?php
}
?>

<script type="text/javascript">


</script>