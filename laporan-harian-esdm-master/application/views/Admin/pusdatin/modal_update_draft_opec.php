<form id="form-update-draft-opec" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_LAPORAN" id="ID_LAPORAN" value="<?php echo $datanya[0]->ID_LAPORAN; ?>">
    
    <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        ID LAPORAN OPEC
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="text" name="ID_LAPORAN" id="ID_LAPORAN"
                            value="<?php echo $datanya[0]->ID_LAPORAN; ?>" style="width: 100%;" readonly>
                    </div>
                </div>
    </div>
    
    
    

    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Komentar</div>

        <div class="profile-info-value">
          
          
          <textarea required class="form-control" type="text" name="CATATAN_REVIEW" id="CATATAN_REVIEW" placeholder="Silahkan Tambah Komentar" style="width: 100%;min-height:100px;" readonly><?php echo $datanya[0]->CATATAN_REVIEW ?></textarea>
          <?php /*?><?php echo $datanya[0]->CATATAN_REVIEW.'123' ?<?php */?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          BERITA</div>

        
        
        <div class="profile-info-value">
        	<textarea class="form-control" type="text" name="BERITA" id="BERITA"
                            style="width: 100%;min-height:100px;" placeholder="BERITA"><?php echo $datanya[0]->BERITA; ?></textarea>
            
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 100PX">*Catatan</div>
        <div class="profile-info-value">
          <textarea class="form-control" type="text" name="CATATAN" id="CATATAN"
                            style="width: 80%;min-height:88px;" placeholder="Catatan"><?php echo $datanya[0]->CATATAN; ?></textarea>
        </div>
      </div>
      
        
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Save
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Cancel
    </button>
  </div>
</div>
</form>

