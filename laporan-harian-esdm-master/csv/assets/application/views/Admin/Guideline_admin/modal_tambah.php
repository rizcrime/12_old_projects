
<form id="form-tambah-guideline" method="POST">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Tambah Data Guideline</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Izin
        </div>

        <div class="profile-info-value">
          <select name="ID_TEMPLATE" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <?php 
            	foreach ($izinSet as $row){
					echo "<option value=".$row->ID_TEMPLATE.">".$row->NAMA_TEMPLATE."</option>";
				}
            ?>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Rule
        </div>

        <div class="profile-info-value">
          <select name="ID_RULE" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="EVAL">Evaluator</option>
            <option value="ESLN">Eselon 4</option>
            <option value="ESL3">Eselon 3</option>
            <option value="ESL2">Eselon 2</option>
            <option value="ESL1">Eselon 1</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Step
        </div>

        <div class="profile-info-value">
          <select name="STEP" class="form-control" style="width: 100%" required>
            <option value="">PILIH</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Guideline
        </div>

        <div class="profile-info-value">
          <textarea name="DESCRIPTION" class="form-control" placeholder="Masukkan guideline..."></textarea>
        </div>
      </div>


      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Color
        </div>

        <div class="profile-info-value">
		  <input class="jscolor" type="color" value="#ff0000" id="colorTexto" name="COLOR">
        </div>
      </div>

    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary'>
      <i class='ace-icon fa fa-save'></i>
      Save
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
  
  var options = {
    zIndex: 1080
  }
  var picker = new jscolor('colorTexto', options);  
</script>
