<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">
            <strong>Permohonan Detail per Role</strong>
        </h4>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name" style="width: 200px !important;"> Nama Role </div>
                        <div class="profile-info-value">
                            <?=$DataPermohonan[0]->ROLE?>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name" style="width: 200px !important;"> Tanggal Pengajuan </div>
                        <div class="profile-info-value">
                            <?=date('d-M-Y' ,strtotime($DataPermohonanDetail[0]->data_permohonan->TGL_PENGAJUAN))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top: 20px; padding-left: 10px; padding-right: 10px;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- <h3>Iterasi 1</h3> -->
                <table id="list-report-izin-per-izin-detail" class="table table-hover table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th width="25%">Nama Perusahaan</th>
                        <th width="25%">Nama Izin</th>
                        <th width="15%">SOP</th>
                        <th width="15%">Melebihi SOP</th>
                        <th width="15%">Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($DataPermohonanDetail as $row): ?>
                            <tr <?php echo (($row->on_track == false) ? 'style="color: red;"' : ''); ?>>
                                <td><?=$no?></td>
                                <td><?=$row->data_permohonan->NAMA_PERUSAHAAN?></td>
                                <td><?=$row->get_template_name()?></td>
                                <td><?=$row->sla_izin?> hari kerja</td>
                                <td><?php echo (($row->on_track == true) ? "Tidak" : "Ya"); ?></td>
                                <td>
                                    <a class="btn btn-info btn-minier permohonan-detail-per-perusahaan" data-id="<?=$row->data_permohonan->ID_PERMOHONAN?>">
                                        <i class="glyphicon glyphicon-info-sign"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <div class="modal-footer" style="border-radius:0 0 10px 10px;">
        <button class='btn btn-flat btn-sm btn-danger' data-dismiss='modal'>
            <i class='ace-icon fa fa-times'></i>
            Batal
        </button>
    </div>
</div>