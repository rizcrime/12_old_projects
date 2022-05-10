<form id="form-update-urutan_izin" method="POST">
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
          <select name="ID_TEMPLATE" class="form-control" onchange="f_show_urutan(this)">
            <?php foreach($dataTemplate as $row): ?>
                <option value="<?php echo $row['ID_TEMPLATE'] ?>"><?php echo $row['NAMA_TEMPLATE'] ?></option>
            <?php endforeach; ?> 
            </select>
          </div>
        </div>

        <div id="checklist-holder">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="text-align: center;">
                <strong>PERSYARATAN</strong>
              </div>

              <div class="profile-info-value"  style="text-align: center; width: 10%;">
                <strong>URUTAN</strong>
              </div>
            </div>


            <?php foreach($dataIzin_instansi as $izin_instansi): ?>
              <div class="profile-info-row">
                <div class="profile-info-name" style="text-align: left;">
                  <?php echo $izin_instansi->PDT ; ?>
                </div>

                <div class="profile-info-value"  style="text-align: center; width: 10%;">
                  <input type="hidden" name="ID_PERSYARATAN[]" value="<?php echo $izin_instansi->IDT ?>">
                  <input type="number" name="URUTAN[]" value="<?php echo $izin_instansi->URUTAN ?>">
                </div>
              </div>
              <?php endforeach; ?>
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
    $('[data-rel=popover]').popover({html:true});
  </script>
