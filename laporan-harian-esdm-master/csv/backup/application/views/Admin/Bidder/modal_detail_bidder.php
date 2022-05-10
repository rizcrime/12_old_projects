<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Data <?php echo $admin->NAME; ?></h3>
  <form id="regForm" action="">
  <?=get_csrf_token()?>
    <div class="col-md-3">
      <div class="form-group">
        <label>NIK:</label>
        <input class="form-control" value="<?php echo $admin->NIK ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>KODE USER:</label>
        <input class="form-control"
        <?php
          if($admin->USER_CODE == 1){
            echo 'value="Administrator" readonly';
          } else{
            echo 'value="Bidder" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>NAMA:</label>
        <input class="form-control" value="<?php echo $admin->NAME ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>TEMPAT LAHIR:</label>
        <input class="form-control" value="<?php echo $admin->BIRTH_PLACE ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>TANGGAL LAHIR:</label>
        <input class="form-control" value="<?php echo $admin->BIRTH_DATE ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>ALAMAT:</label>
        <input class="form-control" value="<?php echo $admin->ADDRESS ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>RT:</label>
        <input class="form-control" value="<?php echo $admin->RT ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>RW:</label>
        <input class="form-control" value="<?php echo $admin->RW ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KELURAHAN:</label>
        <input class="form-control" value="<?php echo $admin->KELURAHAN ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>JENIS KELAMIN:</label>
        <input class="form-control"
        <?php
          if($admin->GENDER == 1){
            echo 'value="Laki-laki" readonly';
          } else{
            echo 'value="Perempuan" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>GOLONGAN DARAH:</label>
        <input class="form-control"
        <?php
          if($admin->BLOOD_TYPE == 1){
            echo 'value="A" readonly';
          } elseif($admin->USER_CODE == 2){
            echo 'value="B" readonly';
          } elseif($admin->USER_CODE == 3){
            echo 'value="O" readonly';
          } else{
            echo 'value="AB" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KECAMATAN:</label>
        <input class="form-control" value="<?php echo $admin->KECAMATAN ?>" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>AGAMA:</label>
        <input class="form-control"
        <?php
          if($admin->RELIGION == 1){
            echo 'value="Islam" readonly';
          } elseif($admin->USER_CODE == 2){
            echo 'value="Katolik" readonly';
          } elseif($admin->USER_CODE == 3){
            echo 'value="Protestan" readonly';
          } elseif($admin->USER_CODE == 4){
            echo 'value="Budha" readonly';
          } else{
            echo 'value="Hindu" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>STATUS PERNIKAHAN:</label>
        <input class="form-control"
        <?php
          if($admin->RELIGION == 1){
            echo 'value="Sudah Menikah" readonly';
          } else{
            echo 'value="Lajang" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>PEKERJAAN:</label>
        <input class="form-control" value="<?php echo $admin->PROFESSION ?>" readonly>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>KEWARGANEGARAAN:</label>
        <input class="form-control"
        <?php
          if($admin->RELIGION == 1){
            echo 'value="WNI" readonly';
          } else{
            echo 'value="WNA" readonly';
          }
        ?> >
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>AKSES LEVEL:</label>
        <input class="form-control"
        <?php
          if($admin->RELIGION == 1){
            echo 'value="Super Administrator" readonly';
          } else{
            echo 'value="Administrator" readonly';
          }
        ?> >
      </div>
    </div>
  </form>
  <div class="col-md-12">
    <div class="text-right">
      <button class="btn btn-danger" data-dismiss="modal"> Close</button>
    </div>  
  </div>
</div>