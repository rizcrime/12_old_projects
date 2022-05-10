<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center"><?php echo $nama; ?></h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b><?= $title ?></b> <a class="pull-right"><?php echo $nama; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <?php if(isset($userdata->ID_USER)) { ?>
          <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
        <?php } ?>
        <li <?php if(!isset($userdata->ID_USER)) echo 'class = active'; ?> ><a href="#password" data-toggle="tab">Ubah Password</a></li>
      </ul>
      <div class="tab-content">
        <?php if(isset($userdata->ID_USER)) { ?>
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal" action="<?php echo base_url('Profile_user/update') ?>" method="POST" enctype="multipart/form-data">
            <?=get_csrf_token()?>
              <div class="form-group">
                <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id= placeholder="Username" name="username" value="<?php echo $nama; ?>">
                </div>
              </div>           
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
        <div class="<?php if(!isset($userdata->ID_USER)) echo 'active'; ?> tab-pane" id="password">
          <form class="form-horizontal" action="<?php echo base_url('Profile_user/ubah_password') ?>" method="POST">
          <?=get_csrf_token()?>
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Lama" name="passLama">
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required oninvalid="this.setCustomValidity('8 karakter kombinasi huruf besar, kecil dan angka')" oninput="setCustomValidity('')" class="form-control" placeholder="8 karakter kombinasi huruf besar, kecil dan angka" class="form-control" placeholder="Password Baru" name="passBaru">
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required oninvalid="this.setCustomValidity('8 karakter kombinasi huruf besar, kecil dan angka')" oninput="setCustomValidity('')" class="form-control" placeholder="8 karakter kombinasi huruf besar, kecil dan angka" class="form-control" placeholder="Konfirmasi Password" name="passKonf">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="msg" style="display:none;">
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
</div>