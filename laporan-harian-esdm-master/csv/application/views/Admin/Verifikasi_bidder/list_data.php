<?php
$no = 1;
foreach ($dataVerifikasi_bidder as $verifikasi_bidder) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $verifikasi_bidder->NAMA_PERUSAHAAN; ?></td>
    <td><?php echo $verifikasi_bidder->EMAIL_PERUSAHAAN; ?></td>
    <td class="text-center" style="min-width:230px;">
    <?php if($verifikasi_bidder->IS_VERIFIED == '') { ?>
      <button class="btn btn-info detail-dataVerifikasi_bidder btn-minier" data-id="<?php echo $verifikasi_bidder->ID_PERUSAHAAN; ?>"><i class="glyphicon glyphicon-info-sign"></i>Verifikasi</button>
    <?php } else { ?>
      <button class="btn btn-danger detail-dataVerifikasi_bidder btn-minier" data-id="<?php echo $verifikasi_bidder->ID_PERUSAHAAN; ?>"><i class="glyphicon glyphicon-info-sign"></i>Nonaktifkan</button>
    <?php } ?>
    </td>
  </tr>
  <?php
  $no++;
}
?>
