<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
 <style type="text/css">
  button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}
 </style>

<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">

    <div class="widget-main">
      <div id="fuelux-wizard-container">
        <div>
          <ul class="steps">
            <li data-step="1">
             <!-- 
                edited by rendra 16:03, 03/07/2018 
                memperbaiki tampilan cursor saat hover
              -->
              <a href="<?php echo site_url("Permohonan_izin/edit/{$currentIDPermohonanEdit}") ?>" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">#</span>
                <span class="title">Profile Perusahaan</span>
              </a>
            </li>
            
            <li data-step="2">
              <!-- 
                edited by rendra 16:03, 03/07/2018 
                memperbaiki tampilan cursor saat hover
              -->
              <a href="<?php echo site_url("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}") ?>" style="display: block; cursor: auto;">
                <span class="step" style="cursor: pointer;">1</span>
                <span class="title">Pilih Jenis Izin</span>
              </a>
            </li>

            <li data-step="3" class="active">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </li>

            <li data-step="4">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="5">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->


    <form id="main-form" method="POST" action="<?php echo base_url('Permohonan_izin/uploadDokumen') ?>" enctype="multipart/form-data">
    <?=get_csrf_token()?>
     <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
      <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Upload Dokumen Persyaratan</strong></h4>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
          <thead>
            <tr>
              <td>No</td>
              <td>Dokumen Persyaratan</td>
              <td>File Contoh</td>
              <td>Upload</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $ids = array(); 
            $i = 1;
            foreach ($dataDokumen as $row):
              array_push($ids, "'".$row->ID_PERSYARATAN."'");
              ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td>
                  <!-- 
                    edited by rendra 18:38, 03/07/2018 
                    menambahkan kondisi jika IS_MANDATORY == Y maka input file menjadi required
                  -->
                  <?php 
                    if ($row->IS_MANDATORY == 'Y') {
                      echo $row->PERSYARATAN . " <strong style='color: red;'><sup>*required</sup></strong>";
                    } else {
                      echo $row->PERSYARATAN;
                    }
                  ?>
                </td>
                <td><a href="/images/<?php echo $row->FILE_CONTOH ?>" target="_blank"><?php echo $row->FILE_CONTOH ?></a></td>
                <td>
                  <div id="syarat-<?=$row->ID_PERSYARATAN?>"></div>
                  <!-- 
                    edited by rendra 18:38, 03/07/2018 
                    menambahkan kondisi jika IS_MANDATORY == Y maka input file menjadi required
                  -->
                  <!-- <input type="file" accept=".pdf" name="UPLOAD_DOK_SYARAT[]" flag="input-file" class="form-control" 
                    <?php 
                      if (($row->IS_MANDATORY == 'Y')) {
                        echo "required";
                      } 
                    ?> 
                  /> -->
                </td>
                <!-- <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php //echo $row->ID_PERSYARATAN ?>"> -->
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:left;">
        <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
      </div>
      <div style="float:right;">
        <a class="btn-sm btn-info" href="<?php echo site_url("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}") ?>" style="color: white"><i class="fa fa-chevron-left"></i> Kembali</a>
        <button id="izin-next-step" type="submit" class="btn-sm btn-success" onclick="nextPrev(1)">Lanjut <i class="fa fa-chevron-right"></i></button>
      </div>
    </div>
  </form>
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
.steps li.active .step{
  background-color: #fff000;
}
table.table-bordered thead td{
  background-color: #c0d9ec;
  color: black;
  font-weight: 700;
}
</style>
<script src="<?=base_url('assets/js/fine-uploader/fine-uploader.js')?>"></script>
<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader">
        <div class="qq-upload-button-selector qq-upload-button">
            <button type="button">Upload a file</button>
        </div>
        <div class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <div>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">Pause</button>
                <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">Continue</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript">

  // jQuery("input[flag='input-file']").ace_file_input({
  //   no_file:'No File ...',
  //   btn_choose:'Choose',
  //   btn_change:'Change',
  //   droppable:false,
  //   onchange:null,
  //   thumbnail:false //| true | large
  //   //whitelist:'gif|png|jpg|jpeg'
  //   //blacklist:'exe|php'
  //   //onchange:''
  //   //
  //   });

  function f_show(obj) {
    if(obj.value){
      $('div[id^=dokumen]').attr("style","display:none");
      $("#dokumen"+obj.value).attr("style","display:block");
    } else {        
      $('div[id^=dokumen]').attr("style","display:none");
    }
  }

  $(document).ready(function(){
    $('#PROVINSI').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
          }
          $('.KABKOT').html(html);
        }
      });
    });
  });

  $(document).on("submit", "#main-form", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	});

  // Uploader
  var uploader = new Array();
  var ids = [<?=implode(",", $ids);?>];

  for(let i = 0; i < ids.length; i++) {
      let newUploader = new qq.FineUploader({
          element: document.getElementById('syarat-' + ids[i]),
          multiple: false,
          form: {
              element: document.getElementById('main-form')
          },
          chunking: {
              enabled: true,
              mandatory: true,
              concurrent: {
                  enabled: true
              },
              success: {
                  endpoint: "endpoint.php?done="+ids[i],
              }
          },
          resume: {
              enabled: true
          },
          retry: {
              enableAuto: true
          },
          validation: {
              acceptFiles: ".pdf",
              allowedExtensions: ['pdf']
          },
          callbacks: {
              onComplete: function(id, name, response, xhr) {
                  console.log("SUCCESS : " + ids[i]);
              }
          }
      });

      uploader.push(newUploader);
  }
</script>