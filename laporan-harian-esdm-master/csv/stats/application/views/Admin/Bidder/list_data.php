<?php
$no = 1;
foreach ($dataBidder as $bidder) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $bidder->NAMA_PERUSAHAAN; ?></td>
    <td><?php echo $bidder->EMAIL_PERUSAHAAN; ?></td>
    <td class="text-center" style="min-width:230px;">
      <!-- <button class="btn btn-info detail-dataBidder" data-id="<?php echo $bidder->ID_PERUSAHAAN; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button> -->
      <button class="btn btn-danger konfirmasiHapus-bidder btn-minier" data-id="<?php echo $bidder->ID_PERUSAHAAN; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
  </td>
</tr>
<?php
$no++;
}
?>