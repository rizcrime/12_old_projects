<form id="form-update-admin" method="POST">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
    </div>
    <div class="form-msg"></div>
    <div class="modal-body">

      <input type="hidden" value="<?php echo $admin->ID_USER ?>" name="ID_USER">

      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 200PX">
            USERNAME
          </div>

          <div class="profile-info-value">
            <input required class="form-control" type="text" name="USERNAME" value="<?php echo $admin->USERNAME ?>" style="width: 100%;" aria-describedby="sizing-addon2">
          </div>
        </div>

        

        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 200PX">
            PASSWORD
          </div>

          <div class="profile-info-value">
            <input class="form-control" type="password" name="PASSWORD" style="width: 100%;" aria-describedby="sizing-addon2">
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 200PX">
            NAMA
          </div>

          <div class="profile-info-value">
            <input required class="form-control" type="text" name="NAMA_USER" value="<?php echo $admin->NAMA_USER ?>" style="width: 100%;" aria-describedby="sizing-addon2">
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name">
            ROLE
          </div>

          <div class="profile-info-value">
            <select required class="form-control" name="ID_ROLE">
              <!-- <option value="<?php echo $admin->ID_ROLE ?>"><?php echo $admin->ROLE ?></option> -->

              <?php foreach($dataRole as $role): ?>
                <!-- <option value="<?php echo $role->ID_ROLE ?>"><?php echo $role->ROLE ?></option> -->
                <option <?php if($role->ID_ROLE == "$admin->ID_ROLE"){ echo 'selected="selected"'; } ?> value="<?php echo $role->ID_ROLE ?>"><?php echo $role->ROLE?> </option>
              <?php endforeach ?>
            </select>

          </div>
        </div>

        

        

        <div class="profile-info-row">
          <div class="profile-info-name">
            POSTING
          </div>

          <div class="profile-info-value">
            <select required class="form-control" name="IS_POST">
              <option value="<?php echo $admin->IS_POST ?>">
                <?php if($admin->IS_POST == 'Y') { ?>
                Ya</option>
                <option value="T">Tidak</option>
              <?php } else { ?>Tidak</option>
              <option value="Y">Ya</option>
            <?php } ?>            
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Update Data
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Cancel
    </button>
  </div>
</div>
</form>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
