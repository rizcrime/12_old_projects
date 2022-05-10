<form id="form-update-draft-icp" method="POST">
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
                        ID Laporan ICP
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
          
          
          <textarea required class="form-control" type="text" name="CATATAN_REVIEW" id="CATATAN_REVIEW" placeholder="Silahkan Tambah Komentar" style="resize: vertical;" readonly><?php echo $datanya[0]->CATATAN_REVIEW ?></textarea>
          <?php /*?><?php echo $datanya[0]->CATATAN_REVIEW.'123' ?<?php */?>
        </div>
      </div>
                
                
                
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      JAN</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_01" id="PROD_01" value="<?php echo $datanya[0]->PROD_01 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      FEB</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_02" id="PROD_02" value="<?php echo $datanya[0]->PROD_02 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      MAR</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_03" id="PROD_03" value="<?php echo $datanya[0]->PROD_03 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      APR</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_04" id="PROD_04" value="<?php echo $datanya[0]->PROD_04 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      MEI</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_05" id="PROD_05" value="<?php echo $datanya[0]->PROD_05 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      JUN</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_06" id="PROD_06" value="<?php echo $datanya[0]->PROD_06 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      JUL</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_07" id="PROD_07" value="<?php echo $datanya[0]->PROD_07 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      AGS</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_08" id="PROD_08" value="<?php echo $datanya[0]->PROD_08 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      SEP</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_09" id="PROD_09" value="<?php echo $datanya[0]->PROD_09 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      OKT</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_10" id="PROD_10" value="<?php echo $datanya[0]->PROD_10 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      NOV</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_11" id="PROD_11" value="<?php echo $datanya[0]->PROD_11 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      DES</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="PROD_12" id="PROD_12" value="<?php echo $datanya[0]->PROD_12 ?>" style="width: 100%;">
                    </div>
      		  </div>
              
              <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                      RATA - RATA</div>
            
                    <div class="profile-info-value">
                      <input class="form-control" type="number" name="RATARATA" id="RATARATA" value="<?php echo $datanya[0]->RATARATA ?>" style="width: 100%;">
                    </div>
      		  </div>
                
                
    </div>

	
      
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Catatan</div>

        <div class="profile-info-value">
          
          
          <textarea required class="form-control" type="text" name="CATATAN" id="CATATAN" placeholder="Catatanr" style="resize: vertical;" ><?php echo $datanya[0]->CATATAN ?></textarea>
          <?php /*?><?php echo $datanya[0]->CATATAN_REVIEW.'123' ?<?php */?>
        </div>
      </div>
      
      
      
      <!--<div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          LAPORAN</div>

        
        
        <div class="profile-info-value">
        	<textarea class="form-control" type="text" name="KETERANGAN" id="KETERANGAN"
                            style="width: 100%;min-height:200px;" placeholder="LAPORAN"><?php echo $datanya[0]->KETERANGAN; ?></textarea>
            
        </div>
      </div>-->
      
        
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






<script type="text/javascript">

</script>
