<form id="form-update-t_persyaratan_izin" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data</strong></h4>
  </div>
  <div class="form-msg"></div>
  <div class="modal-body">
    <input type="hidden" name="ID_PERSYARATAN" value="<?php echo $t_persyaratan_izin->ID_PERSYARATAN ?>">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          PERSYARATAN
        </div>

        <div class="profile-info-value">
          <textarea required id="persyaratan-area" class="form-control" name="PERSYARATAN" style="width: 100%;"><?=$t_persyaratan_izin->PERSYARATAN?></textarea>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          FILE CONTOH
        </div>

        <div class="profile-info-value">
          <input class="data-file" type="file" class="form-control" name="FILE_CONTOH" aria-describedby="sizing-addon2">
          <a href='<?=base_url("/T_persyaratan_izin/delete_current_template/{$t_persyaratan_izin->ID_PERSYARATAN}") ?>'>
            <?php echo !is_null($t_persyaratan_izin->FILE_CONTOH) ? '<i class="fa fa-trash" style="font-size:20px;color:red;"></i>' : "" ?>
          </a>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MANDATORY
        </div>

        <div class="profile-info-value">
          <select required name="IS_MANDATORY" class="form-control">
            <option value="<?php echo $t_persyaratan_izin->IS_MANDATORY ?>">
              <?php if($t_persyaratan_izin->IS_MANDATORY == 'Y'): ?>
                Ya
            </option>
            <option value="N">Tidak</option>
              <?php else: ?>
                Tidak
            </option>
            <option value="Y">Ya</option>
              <?php endif; ?> 
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          JENIS FILE
        </div>

        <div class="profile-info-value">

        <?php foreach ($allowed_extensions as $extension):?>
            <div class="checkbox">
            <label>
              <input type="checkbox" name="JENIS_FILE[]" value="<?=$extension?>" <?=checked_jenis_file($t_persyaratan_izin->JENIS_FILE, $extension)?>> <?=$extension?>
            </label>
          </div>
        <?php endforeach; ?>

        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MAX SIZE
        </div>

        <div class="profile-info-value">
          <div class="input-group">
            <input required class="form-control" type="number" name="MAX_SIZE" value="<?php echo $t_persyaratan_izin->MAX_SIZE ?>" style="width: 100%;">
            <div class="input-group-addon">Bytes</div>            
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Update Data
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Cancel
    </button>
  </div>
</div>
</form>

<script type="text/javascript">
    $('.input-file').popover({html:true});

    $('.data-file').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        thumbnail:false, //| true | large
        maxSize: <?=get_max_size()?>,
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
  });
  tinyMCE.remove("#persyaratan-area");
  tinymce.init({
      selector: '#persyaratan-area',
      height: 300,
      plugins: [
        "advlist autolink lists charmap preview hr pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons paste textcolor"
      ],
      toolbar1: "insert | preview | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
    });
</script>