<?php
  $no = 1;
  foreach ($dataUser as $user) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $user->username; ?></td>
      <td><img class="profile-user-img img-responsive" src="<?php echo base_url(); ?>assets/img/<?php echo $user->picture; ?>" alt="User profile picture"></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-danger konfirmasiHapus-user btn-minier" data-id="<?php echo $user->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>