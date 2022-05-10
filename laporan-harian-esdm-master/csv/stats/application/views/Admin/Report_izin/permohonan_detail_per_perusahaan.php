<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">
            <strong>Permohonan Detail per Perusahaan</strong>
        </h4>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Nama Perusahaan </div>
                        <div class="profile-info-value">
                            <?=$DataPermohonanDetail->data_permohonan->NAMA_PERUSAHAAN?>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Tgl. Pengajuan </div>
                        <div class="profile-info-value">
                            <?=date('d-M-Y' ,strtotime($DataPermohonanDetail->data_permohonan->TGL_PENGAJUAN))?>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Jenis Izin </div>
                        <div class="profile-info-value">
                            <?=$DataPermohonanDetail->get_template_name()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            // $i = 0;
            // foreach($DataPermohonanDetail->get_step_detail()->fill_tracking_detail()->list_tracking_detail as $iterasi):
        ?>
            <div class="row" style="padding-top: 20px; padding-left: 10px; padding-right: 10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- <h3>Iterasi 1</h3> -->
                    <table id="simple-table" class="table table-hover table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th width="20%">Posisi</th>
                            <th width="20%">Nama Penanggung Jawab</th>
                            <th width="20%">Mulai Proses</th>
                            <th width="20%">Selesai Proses</th>
                            <th width="20%">Waktu Kerja</th>
                            <th width="20%">SOP</th>
                        </thead>
                        <tbody>
                            <?php
                                $j = 0;
                                foreach($DataPermohonanDetail->get_step_detail()->list_tracking_detail as $key => $tracking_detail):
                                  if($key == 0) continue; // Skip Pengajuan berkas permohonan
                            ?>
                                <tr>
                                    <td><?=$key?></td>
                                    <td><?=$tracking_detail->data_proses->NAMA_PROSES?></td>
                                    <td><?=issetor($tracking_detail->get_assigned_user_data()->NAMA, "Belum pernah di proses")?></td>
                                    <td><?=issetor($tracking_detail->list_tracking_item[$j]->data_tracking->TGL_MULAI_PROSES, '-')?></td>
                                    <td><?=issetor($tracking_detail->list_tracking_item[$j]->data_tracking->TGL_SELESAI_PROSES, '-')?></td>
                                    <td>
                                        <?php 
                                            if(method_exists($tracking_detail->list_tracking_item[$j], 'get_time_elapsed_string')){
                                                echo $tracking_detail->list_tracking_item[$j]->get_time_elapsed_string();
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td><?=$tracking_detail->sla_process?> hari</td>
                                </tr>
                            <?php 
                                $j++;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php 
            // $i++;
            // endforeach; 
        ?>
        

    </div>
    <div class="modal-footer" style="border-radius:0 0 10px 10px;">
        <button class='btn btn-flat btn-sm btn-danger' data-dismiss='modal'>
            <i class='ace-icon fa fa-times'></i>
            Batal
        </button>
    </div>
</div>