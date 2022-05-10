<?php
foreach ($dataPermohonan_izin as $pizin) {
  ?>
  <tr>
    <td><?php echo $pizin->NAMA_FORM; ?></td>
    <td><?php echo $pizin->NAMA_TEMPLATE; ?></td>
    <td><?php echo $pizin->TGL_PENGAJUAN; ?></td>
    <td><?php echo $pizin->TGL_DISETUJUI; ?></td>
    <td>
      <?php
        if($pizin->ID_CURR_PROSES == 1) {
          echo 'Disetujui';
        } else {
          echo 'Belum Disetujui';
        }
      ?>
    </td>
    <td><?php echo $pizin->NOMOR_IZIN; ?></td>
    <td class="text-center" style="min-width:130px;">
      <button class="btn  btn-warning btn-minier"><i class="glyphicon glyphicon-pencil"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-permohonan_izin btn-minier" data-id="<?php echo $pizin->ID_PERMOHONAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
    </td>
  </tr>
  <?php
}
?>