<?php
$no = 1;
foreach ($dataAdmin as $admin) {
//$role = adas;	
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $admin->NAMA_USER; ?></td>
    <td><?php echo $admin->USERNAME; ?></td>
    <td><?php echo $admin->ROLE; ?></td>
  
        <td>
      <?php if($admin->ROLE == 'SUPER_ADMIN') { ?>
        SUPER ADMIN
      <?php } 
	  else if($admin->ROLE == 'ADMIN_PUSDATIN') { ?>
        ADMIN
      <?php }
	  else if($admin->ROLE == 'ADMIN_GEOLOGI') { ?>
        ADMIN
      <?php }
	  else if($admin->ROLE == 'ADMIN_BERITA') { ?>
        ADMIN
      <?php }
	  else if($admin->ROLE == 'ENTRY PUSDATIN') { ?>
        ENTRY / DRAFTER
      <?php }
	  else if($admin->ROLE == 'ENTRY GEO') { ?>
        ENTRY / DRAFTER
      <?php }
	  else if($admin->ROLE == 'ENTRY BERITA') { ?>
        ENTRY / DRAFTER
      <?php }
	  else if($admin->ROLE == 'REVIEWER_PUSDATIN') { ?>
        REVIEWER
      <?php }
	  else if($admin->ROLE == 'REVIEWER_GEO') { ?>
        REVIEWER
      <?php }
	  else if($admin->ROLE == 'REVIEWER_BERITA') { ?>
        REVIEWER
      <?php }
	  else if($admin->ROLE == 'APPROVAL_PUSDATIN') { ?>
        APPROVAL / POSTING
      <?php }
	  else if($admin->ROLE == 'APPROVAL_GEO') { ?>
        APPROVAL / POSTING
      <?php }
	  else if($admin->ROLE == 'APPROVAL_BERITA') { ?>
        APPROVAL / POSTING
      <?php }
	  else if($admin->ROLE == 'VIEW_DRAFT') { ?>
        VIEW DRAFT / HISTORY
      <?php }
	  else { ?>
        LAINNYA
      <?php } ?>        
    </td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn  btn-warning update-dataAdmin btn-minier" data-id="<?php echo $admin->ID_USER; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <?php if($admin->ID_ROLE != 'ADM'){ ?>
      <button class="btn btn-danger konfirmasiHapus-admin btn-minier" data-id="<?php echo $admin->ID_USER; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>          
  <?php } ?>
  </td>
</tr>
<?php
$no++;
}
?>

