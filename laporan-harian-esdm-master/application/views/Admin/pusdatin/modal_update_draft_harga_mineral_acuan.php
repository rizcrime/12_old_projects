<form id="form-update-draft-mineral" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="modal-body">

    <input type="hidden" name="ID_LAPORAN" id="ID_LAPORAN"  value="<?php echo $datanya[0]->ID_LAPORAN; ?>">

    <div class="profile-user-info profile-user-info-striped">
    <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        ID Laporan Harga Mineral Acuan
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="text" name="ID_LAPORAN" id="ID_LAPORAN"
                            value="LAP. <?php echo $datanya[0]->ID_LAPORAN; ?>" style="width: 100%;" readonly>
                    </div>
                </div>
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
                        Harga Mineral
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="number" name="HARGA" id="HARGA"
                            value="<?php echo $datanya[0]->HARGA; ?>" style="width: 100%;" readonly>
                    </div>
     </div>
     
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">Sumber</div>
        <div class="profile-info-value">
          <textarea class="form-control" type="text" name="SUMBER" id="SUMBER"
                            style="width: 100%;min-height:100px;" placeholder="Sumber"><?php echo $datanya[0]->SUMBER; ?></textarea>
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

