<form id="form-update-draft-gatrik" method="POST">
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
                        BERITA
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="text" name="BERITA" id="BERITA"
                            value="<?php echo $datanya[0]->BERITA; ?>" style="width: 100%;">
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        JENIS
                    </div>
                    <div class="profile-info-value">
                    <select class="form-control" id="JENIS" name="JENIS">
                        <option value="<?php $datanya[0]->JENIS;?>"><?php echo ($datanya[0]->JENIS == "N") ? "Netral" : "Tidak Netral";?></option>
                        <option value="N">Netral</option>
                        <option value="T">Tidak Netral</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name" style="min-width: 200PX">
                        URL
                    </div>
                    <div class="profile-info-value">
                        <input class="form-control" type="text" name="URL" id="URL"
                            value="<?php echo $datanya[0]->URL; ?>" style="width: 100%;">
                    </div>
                </div>
            </div>

            <br>
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



