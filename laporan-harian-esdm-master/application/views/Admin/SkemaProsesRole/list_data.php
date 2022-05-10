<?php
foreach ($dataProses_skema as $skema_proses) {
  ?>
  <tr>
    <td width="2%"><?php echo $skema_proses->URUTAN; ?></td>
    <td><?php echo $skema_proses->NAMA_PROSES; ?></td>
    <td><?=$skema_proses->IS_FINAL_TTD == "Y" ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>" ?></td>
    <td>
      <?php
      $role = array();
      foreach($skema_proses->ROLES as $data) {
        array_push($role, $data->ROLE);
      }

      if(empty($role)) {
        array_push($role, "Perusahaan");
      }

      echo implode(", ", $role);
      ?>
    </td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataSkema_proses btn-minier" data-id="<?php echo $skema_proses->ID_PROSES; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
    </td>
  </tr>
  <?php
}
?>