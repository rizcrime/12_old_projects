
<form id="form-update-mapping_izin2" method="POST">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Update Data </strong></h4>
    </div>
    <div class="modal-body" style='max-height: 400px; overflow-x: hidden;'>


      <div class="profile-info-row">
        <select name="ID_TEMPLATE" class="form-control" onchange="f_show(this)">
          <option value="">Pilih</option>
          <option value="1">Template 1</option>
          <option value="2">Template 2</option>
          <option value="3">Template 3</option>
          <option value="4">Template 4</option>
        </select>
      </div>
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name" style="text-align: center;">
            <strong>PERSYARATAN</strong>
          </div>

          <div class="profile-info-value"  style="text-align: center; width: 10%;">
            <strong>STATUS</strong>
          </div>
        </div>

        <?php foreach($dataIzin_instansi as $izin_instansi): ?>
          <div class="profile-info-row">
            <div class="profile-info-name" style="text-align: left;">
              <?php echo $izin_instansi->PDT ; ?>
            </div>

            <div class="profile-info-value"  style="text-align: center; width: 10%;">
              <input type="checkbox" name="ID_PERSYARATAN[]" value="<?php echo $izin_instansi->IDT ?>" <?php if($izin_instansi->IDR != NULL){ echo 'checked'; }?>>
            </div>
          </div>
        <?php endforeach ?>
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
  $('[data-rel=popover]').popover({html:true});

  function f_show(obj) {
    if(obj.value){
     
     var id = (obj.value);

     $.ajax({
      method: "POST",
      url: "<?php echo base_url('Mapping_izin/test'); ?>",
      data: "id=" +id 
    })
     .done(function(data) {
      alert(data);
      var data = jQuery.parseJSON(data);
      $('#checklist-holder').html(data);
    })
   } else {        

  }
}
</script>
