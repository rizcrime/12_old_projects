<?php
$no = 1;
foreach ($dataList_user as $item) {
?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $item->NIP; ?></td>
    <td><?php echo $item->JABATAN_STRUKTURAL; ?></td>
    <td><?php echo $item->NAMA; ?></td>
    <td><?php echo $item->USERNAME; ?></td>
    <td><?php echo $item->EMAIL_USER; ?></td>
  </tr>
<?php
  $no++;
}
?>

