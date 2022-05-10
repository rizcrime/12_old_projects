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
              <a href="<?php echo site_url("Permohonan_izin/edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
                <span class="step">#</span>
                <span class="title">Profile Perusahaan</span>
              </a>
            </li>
            
            <li data-step="2">
              <a href="<?php echo site_url("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
                <span class="step">1</span>
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

    <?=$detail_data_permohonan?>

    <form id="main-form" method="POST" action='<?php echo base_url("Permohonan_izin/uploadDokumenPersyaratan/{$currentIDPermohonanEdit}") ?>' enctype="multipart/form-data">
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
              <td>File</td>
              <td style="min-width:200px !important;">Upload</td>
            </tr>
          </thead>
          <tbody>
            <?php 
            $id_dok_syarat = array();
            $max_file_size = array();
            $allowed_file_type = array();
            $i = 1;
            foreach ($dataDokumen as $row): 
              array_push($id_dok_syarat, $row->ID_PERSYARATAN);
              array_push($max_file_size, $row->MAX_SIZE);
              array_push($allowed_file_type, explode(",", $row->JENIS_FILE));
              ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td>
                <?php 
                    if ($row->IS_MANDATORY == 'Y') {
                      echo $row->PERSYARATAN . " <strong style='color: red;'><sup>*required</sup></strong>";
                    } else {
                      echo $row->PERSYARATAN;
                    }
                  ?>
                <br>
                <span style="color: darkgreen;">Allowed file type: <?=$row->JENIS_FILE?></span>
                <br>
                <span style="color: darkgreen;">Max file size: <?=formatBytes($row->MAX_SIZE)?></span>
                </td>
                <td><a href='<?=base_url("TemplateContoh/download_template?file={$row->ID_PERSYARATAN}")?>' target="_blank"><?php echo $row->FILE_CONTOH ?></a></td>
                <td nowrap="nowrap">
                  <a href='<?=base_url("Permohonan_izin/download_persyaratan?file={$row->ID_PERSYARATAN}") ?>' target="_blank">
                    <?php echo !is_null($row->FILE_PERSYARATAN) ? '<i class="fa fa-download bigger-160"></i>' : "<span id='syarat-dl-{$row->ID_PERSYARATAN}'></span>" ?>
                  </a>
                  <?php if(($row->IS_MANDATORY != 'Y')) : ?>
                  <a href='<?=base_url("/Permohonan_izin/hapus_file_persyaratan/{$currentIDPermohonanEdit}/{$row->ID_PERSYARATAN}") ?>'>
                    <?php echo !is_null($row->FILE_PERSYARATAN) ? '&nbsp;<i class="fa fa-trash" style="font-size:20px;color:red;"></i>' : "<span id='syarat-dlt-{$row->ID_PERSYARATAN}'></span>" ?>
                  </a>
                  <?php endif; ?>
                </td>
                <td>
                <div id="syarat-<?=$row->ID_PERSYARATAN?>" class="file_syarat" data-isreq="<?=(($row->IS_MANDATORY == 'Y') && is_null($row->FILE_PERSYARATAN)) ? 'Y' : 'T' ?>"></div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div style="float:right;">
          <button id="izin-next-step" type="submit" class="btn-sm btn-primary">Upload <i class="fa fa-upload"></i></button>
        </div>
        </form>
      </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:left;">
        <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
      </div>
      <div id="continue-area" style="float:right;">
        <a class="btn-sm btn-info" href="<?php echo site_url("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}") ?>" style="color: white"><i class="fa fa-chevron-left"></i> Kembali</a>
        <button id="izin-next-step" onclick="lanjutClicked()" class="btn-sm btn-success">Lanjut <i class="fa fa-chevron-right"></i></button>
      </div>
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
.steps li.active .step{
  background-color: #fff000;
}
table.table-bordered thead td{
  background-color: #c0d9ec;
  color: black;
  font-weight: 700;
}
</style>
<link href="<?=base_url('assets/js/fine-uploader/fine-uploader-gallery.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/fine-uploader/fine-uploader.js')?>"></script>
<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader qq-gallery">
        <div class="qq-upload-button-selector btn-sm btn-info text-center">
            Pilih File
        </div>
        <div class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <div>
                <div class="progress qq-progress-bar-container-selector" style="background-color:#97a1a0;">
                  <div class="progress-bar progress-bar-striped active qq-progress-bar-selector" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 0.1em;"></div>
                </div>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <span class="qq-upload-size-selector sukses"></span>
                
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <div class="btn-group qq-file-info">
                  <button type="button" class="qq-upload-cancel-selector btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
                  <button type="button" class="qq-upload-retry-selector btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Retry</button>
                  <button type="button" class="qq-upload-pause-selector btn-sm"><i class="glyphicon glyphicon-pause"></i> Pause</button>
                  <button type="button" class="qq-upload-continue-selector btn-sm"><i class="glyphicon glyphicon-play"></i> Continue</button>
                </div>
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

  // $(document).on("submit", "#main-form", function() {
	// 	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	// });

  // Uploader
  var uploader = new Array();
  var ids = <?=json_encode($id_dok_syarat);?>;
  var mfs = <?=json_encode($max_file_size);?>;
  var aft = <?=json_encode($allowed_file_type)?>;
  var onSubmitCount = 0;

  for(let i = 0; i < ids.length; i++) {
    let newUploader = new qq.FineUploader({
        element: document.getElementById('syarat-' + ids[i]),
        multiple: false,
        request: {
          params: {
            id : ids[i]
          }
        },
        form: {
            element: document.getElementById('main-form')
        },
        chunking: {
            enabled: true,
            // mandatory: true,
            concurrent: {
                enabled: true
            },
            success: {
                endpoint: "<?=base_url('Permohonan_izin/doneUploadingChunks')?>?done="+ids[i],
            }
        },
        resume: {
            enabled: true
        },
        retry: {
            enableAuto: true
        },
        validation: {
            acceptFiles: "." + aft[i].join(",."),
            allowedExtensions: aft[i],
            sizeLimit: mfs[i]
        },
        callbacks: {
            onUpload: function(id, name) {
              // onSubmitCount++;
            },
            onComplete: function(id, name, response, xhr) {
			$('.sukses').html('<br>File Berhasil di Unggah');
              if(response.success == true) {
                // onSubmitCount--;
                uploadComplete(ids[i]);
              }
            },
            onCancel: function(id, name, cancelFinalizationEffort) {
              // onSubmitCount--;              
            }
        }
    });

    uploader.push(newUploader);
  }

  function uploadComplete(id) {
    addDownloadButton(id);
    $("#syarat-"+id).attr("data-isreq", "T");
    checkFinish();
  }

  function addDownloadButton(id) {
    $("#syarat-dl-"+id).html('<i class="fa fa-download bigger-160"></i>');

    if($("#syarat-"+id).data("isreq") == "T") {
      $("#syarat-dlt-"+id).html('&nbsp;<i class="fa fa-trash" style="font-size:20px;color:red;"></i>');
    }
  }

  function checkFinish() {
    let syaratRequired = $(".file_syarat[data-isreq='Y']");

    if(syaratRequired.length == 0 && onSubmitCount == 0) {
      // Ok
    } else if(syaratRequired.length > 0 && onSubmitCount == 0) {
      // alert("Mohon lengkapi dan upload dokumen terlebih dahulu");
    }
  }

  function lanjutClicked() {
    let syaratRequired = $(".file_syarat[data-isreq='Y']");

    if(onSubmitCount > 0) {
      alert("Mohon tunggu proses upload.")
    } else if(syaratRequired.length == 0) {
      go_to_next_step();
    } else if(syaratRequired.length > 0) {
      alert("Mohon lengkapi dan upload dokumen terlebih dahulu");
    }
  }

  function go_to_next_step() {
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      window.location.replace('<?=base_url("Permohonan_izin/step4_edit/{$currentIDPermohonanEdit}")?>');
  }
</script>