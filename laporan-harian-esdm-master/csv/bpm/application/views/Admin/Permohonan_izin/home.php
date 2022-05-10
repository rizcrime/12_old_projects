  <div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
  </div>
  <div class="row">
    <div class="box-body">
       <form method="POST" action="<?php echo site_url('Permohonan_izin/step1') ?>">
      <?=get_csrf_token()?>
      	<div class="input-group form-group" style="width: 10%; padding: 0 0px 10px 0px; border-radius: 5px;">
      		<div class="col-md-12">
            	<button class="btn btn-primary pull-right" style="margin-right: 5px">Ajukan Izin</button>
          	</div>
        </div>
      </form>	
      
      <form method="POST" action="<?php echo base_url('Permohonan_izin') ?>">
      <?=get_csrf_token()?>
      
		<div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
		
		<div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
		<h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Daftar Jenis Permohonan Izin / Non Perizinan</strong></h4>
		</div>
		
      	<div class="col-md-12">
	      <table id="search-result-izin" class="display">
	      <thead>
	        <tr>
	          <td>No</td>
	          <td>Permohonan Izin / Perizinan</td>
	          <td>Jenis Permohonan Izin / Perizinan</td>
	        </tr>
	      </thead>
	      <tbody>
			<?php foreach($list_izin as $key => $value):?>
	        <tr>
	          <td><?=$key + 1?></td>
	          <td><?=$value->NAMA_FORM?></td>
	          <td><?=$value->NAMA_TEMPLATE?></td>
	        </tr>
	        <?php endforeach;?>    
	      </tbody>
	      </table>
		</div>
	</div>	
      
	      
        <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          </div>
          <div class="col-md-6" style="margin-bottom: 10px">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name" style="min-width: 200PX">
                  Status
                </div>

                <div class="profile-info-value">
                  <select name="STATUS">
                  <option>--Pilih--</option>
                  <option value="N">Ditolak</option>
                  <option value="Y">Disetujui</option>
                </select>
                </div>
              </div>

              <div class="profile-info-row">
                <div class="profile-info-value">
                  <button type="submit" class="btn-sm btn-success">Search</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </form>
      
        <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-user" style="color: #fff000"></i> <strong>Permohonan Izin</strong></h4>
          </div>

          <div class="col-md-12">
            <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
              <thead>
                <tr>
                  <td>No</td>
                  <td>No Tracking</td>
                  <td>Tgl Pengajuan</td>
                  <td>Jenis Izin</td>
                  <td>Status</td>
                  <td>Aksi</td>
                  <td>Batal</td>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                foreach ($dataPermohonan_izin as $row): 
                ?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$row->KODE_TRACKING?></td>
                    <td><?=$row->TGL_PENGAJUAN_STRING?></td>
                    <td><?=$row->NAMA_TEMPLATE ?></td>
                    <td><?=$row->STATUS_STRING?></td>
                    <td><?=$row->EDIT_STRING?></td>
                    <td><?=$row->HAPUS_STRING?></td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
          
        </div>
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
  	modalConfirm(".delete-draft", function(confirm, event){
      if(confirm){
        window.location = event.target.attributes.href.nodeValue;
      }
	});
	
	$(document).ready(function() {
	  $('#search-result-izin').dataTable({
			"pageLength" : 10
		});
	})
	
	</script>