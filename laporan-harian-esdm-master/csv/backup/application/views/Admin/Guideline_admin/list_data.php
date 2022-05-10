<?php
$no = 1;
foreach ($data_guideline as $data) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $data->NAMA_TEMPLATE; ?></td>
    <td><?php echo $data->ID_RULE; ?></td>
    <td><?php echo $data->STEP; ?></td>
    <td><?php echo $data->DESCRIPTION; ?></td>
    <td><?php echo $data->COLOR; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-data_guideline btn-minier" data-id="<?php echo $data->ID_GL; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-data_guideline btn-minier" data-id="<?php echo $data->ID_GL; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>