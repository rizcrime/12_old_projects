<form id="form-update-draft-gunungapi" method="POST">
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
                        ID LAPORAN GUNUNG API
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
                        NAMA GUNUNG API
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="text" name="NAMA_GUNUNG" id="NAMA_GUNUNG"
                            value="<?php echo $datanya[0]->NAMA_GUNUNG; ?>" style="width: 100%;" readonly>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        Aktivitas
                    </div>
                    <div class="profile-info-value">
                    <select class="form-control" id="exampleFormControlSelect1" name="LEVEL" id="LEVEL">
                        <option><?php echo $datanya[0]->LEVEL ?></option>
                        <?php foreach($dataLevel as $datas){ ?>
                        <option value="<?php echo $datas->ID_AKTIVITAS ?>"><?php echo $datas->LEVEL; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>

		    <div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Komentar</div>
        
                <div class="profile-info-value">
                  
                  
                  <textarea required class="form-control" type="text" name="CATATAN_REVIEW" id="CATATAN_REVIEW" placeholder="Silahkan Tambah Komentar" style="resize: vertical;" readonly><?php echo $datanya[0]->CATATAN_REVIEW ?></textarea>
                  <?php /*?><?php echo $datanya[0]->CATATAN_REVIEW.'123' ?<?php */?>
                </div>
              	</div>
             </div>   
                
            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        KETERANGAN
                    </div>
                    <div class="profile-info-value">
                        <textarea class="form-control" type="text" name="KETERANGAN" id="KETERANGAN"
                            style="width: 100%;min-height:200px;"><?php echo $datanya[0]->KETERANGAN; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        REKOMENDASI
                    </div>
                    <div class="profile-info-value">
                        <textarea class="form-control" type="text" name="REKOMENDASI" id="REKOMENDASI"
                            style="width: 100%;min-height:200px;"><?php echo $datanya[0]->REKOMENDASI; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        VONA
                    </div>
                    <div class="profile-info-value">
                        <textarea class="form-control" type="text" name="VONA" id="VONA"
                            style="width: 100%;min-height:200px;"><?php echo $datanya[0]->VONA; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        DETAIL
                    </div>
                    <div class="profile-info-value">
                        <textarea class="form-control" type="text" name="DETAIL" id="DETAIL"
                            style="width: 100%;min-height:200px;"><?php echo $datanya[0]->DETAIL; ?></textarea>
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

<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('[data-rel=popover]').popover({
        html: true
    });
</script>



