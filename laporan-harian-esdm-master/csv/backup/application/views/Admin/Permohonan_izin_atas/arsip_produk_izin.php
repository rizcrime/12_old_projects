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
            <table id="table" class="display responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Nomor Izin</td>
                  <td>Tanggal Persetujuan</td>
                  <td>Perusahaan</td>
                  <td>Jenis Permohonan</td>
                  <td>Detail</td>
                </tr>
              </thead>
              <tbody>
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

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            
            "ajax": {
                "url": "<?php echo site_url('Permohonan_izin_atas/get_arsip')?>",
                "type": "POST"
            },
            "searchDelay": 350,
            
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],

        });

    });

</script>