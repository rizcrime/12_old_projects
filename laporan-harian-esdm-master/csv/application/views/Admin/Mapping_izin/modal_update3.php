<form id="form-update-mapping_izin" method="POST">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Update Data <?php echo $id->NAMA_FORM ?></strong></h4>
    </div>
    <div class="modal-body" style='max-height: 400px; overflow-x: hidden;'>

      <input type="hidden" name="ID_FORM" id="ID_FORM" value="<?php echo $id->ID_FORM ?>">

      <div class="row" style="padding: 20px;">
        <div class="col-md-4">
            Template Perizinan :  
        </div>
        <div class="col-md-8">
                <select name="ID_TEMPLATE" class="form-control" onchange="f_show(this)">
                    <option value="">Pilih Template</option>
                    <?php
                    foreach($dataTemplate as $row)
                    { ?>
                      <option value="<?php echo $row['ID_TEMPLATE'] ?>"><?php echo $row['NAMA_TEMPLATE'] ?></option>
                    <?php }
                    ?> 
                </select>
        </div>
      </div>

    <?php foreach ($dataTemplate as $abc): ?>
      <div id="checklistholder<?php echo $abc['ID_TEMPLATE'] ?>" style="display:none">
        <div class="profile-user-info profile-user-info-striped">
          <div class="profile-info-row">
            <div class="profile-info-name" style="text-align: center;">
              <strong>PERSYARATAN</strong>
            </div>

            <div class="profile-info-value"  style="text-align: center; width: 10%;">
              <strong>STATUS</strong>
            </div>
          </div>


          <?php $syarat = $dataSyarat[$abc['ID_TEMPLATE']]; foreach($syarat as $izin_instansi): ?>
            <div class="profile-info-row">
              <div class="profile-info-name" style="text-align: left;">
                <?php echo $izin_instansi['PDT'] ; ?>
              </div>

              <div class="profile-info-value"  style="text-align: center; width: 10%;">
                <input type="checkbox" name="ID_PERSYARATAN[]" value="<?php echo $izin_instansi['IDT'] ?>" <?php if($izin_instansi['IDR'] != NULL){ echo 'checked'; }?>>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    <?php endforeach ?>

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
  $('[data-rel=popover]').popover({html:true});
</script>

<script type="text/javascript">
    function f_show(obj) {
        if(obj.value){
            $('div[id^=checklistholder]').attr("style","display:none");
            $("#checklistholder"+obj.value).attr("style","display:block");
        } else {        
            $('div[id^=checklistholder]').attr("style","display:none");
        }
    }
</script>