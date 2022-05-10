<style>
.profile-user-info {
    padding: 5px 5px 0 5px;
}
</style>
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
            <?php foreach($dataTemplate as $row):?>
              <option value="<?=$row['ID_TEMPLATE'] ?>"><?=$row['NAMA_TEMPLATE'] ?></option>
            <?php endforeach;?> 
            </select>
          </div>
        </div>

        <div id="checklist-holder">
          <div class="profile-user-info profile-user-info-striped">
            <table class="daftar-persyaratan" style="width:100% !important;">
              <thead>
                <tr>
                  <th>PERSYARATAN</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($dataIzin_instansi as $izin_instansi): ?>
                        <tr>
                          <td><?=$izin_instansi->PDT ; ?></td>
                          <td>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" class="checkbox-with-status" name="ID_PERSYARATAN[]" value="<?=$izin_instansi->IDT?>" <?php if($izin_instansi->IDTEMP != NULL){ echo 'checked'; }?>>
                                <span class="checkbox-status">
                                  <?php if($izin_instansi->IDTEMP != NULL):?>
                                  Aktif
                                  <?php else: ?>
                                  Tidak Aktif
                                  <?php endif; ?>
                                </span>
                              </label>
                            </div>
                          </td>
                        </tr>
                  <?php endforeach ?>
            </tbody>
          </table>
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
    $('.daftar-persyaratan').dataTable({
      "columnDefs": [
        { "width": "10%", "targets": 1 }
      ],
      "columns": [
        { title: "Persyaratan" },
        { title: "Status" }
      ],
      "order": [[ 1, "asc" ]]
    });

    $(document).on("change", "input:checkbox.checkbox-with-status", function(e) {
      let newStatus = (this.checked ? "Aktif" : "Tidak Aktif");
      
      let checkbox_status = $(this).siblings(".checkbox-status");
      checkbox_status.html(newStatus);
    })
  </script>
