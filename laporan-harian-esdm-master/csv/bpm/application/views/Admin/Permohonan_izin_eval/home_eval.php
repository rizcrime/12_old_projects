<!--   <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script> -->
  <div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
  </div>
  <div class="row">
    <div class="box-body">
      <form method="POST" action="<?php echo site_url('Permohonan_izin/step1') ?>">
      <?=get_csrf_token()?>
        <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Permohonan Izin</strong></h4>
          </div>

          <div class="col-md-12">
          <a id="button-periksa" href='<?=base_url("Permohonan_izin_eval/periksa_perizinan")?>' class="btn btn-success btn-md"><i class="fa fa-pencil-square-o"></i> <?=$periksa_string?></a>
          <hr>
          <h4 class="text-center">Daftar Antrian Permohonan</h4>
            <table id="list-data2" class="display responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Tgl Pengajuan</td>
                  <td>Jenis Izin</td>
                  <td>Status</td>
                  <td>Target Penyelesaian</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($dataPermohonan_izin as $row): 
                  ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td>
                      <?php
                      if ($row->TGL_PENGAJUAN == NULL) {
                        echo '-';
                      } else {
                        echo tgl_indo($row->TGL_PENGAJUAN);
                      } 
                      ?>                        
                    </td>
                    <td><?php echo $row->NAMA_FORM ?></td>
                    <td><?php echo $row->NAMA_PROSES ?></td>
                    <td><?php echo $row->SLA_DATA->SLA_STRING ?></td>                  
                  </tr>
                <?php 
                  $i++;
                  endforeach;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>

    <div id="tempat-modal"></div>

    <style type="text/css">
    textarea{
      width: 100%;
      resize: vertical;
    }
    div.col-md-12{
      margin-top: 10px;
    }
    div.col-md-8{
      padding: 0;
    }
    table.table-bordered thead td{
      background-color: #c0d9ec;
      color: black;
      font-weight: 700;
    }
  </style>

  <script>
  $(document).ready(function() {
    var table = $("#list-data2").DataTable();

    if (!table.data().any()) {
      $("#button-periksa").html('<i class="fa fa-pencil-square-o"></i> Belum ada Permohonan Izin');
      $("#button-periksa").bind('click', false);
    }
  });
  </script>