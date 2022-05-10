<form id="form-update-guideline" method="POST">
<?=get_csrf_token()?>
  <input type="hidden" name="ID_GL" value="<?php echo $data_guideline->ID_GL ?>">
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Update Data Guideline</strong></h4>
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
            		if($row->ID_TEMPLATE == $data_guideline->ID_TEMPLATE){
						echo "<option value=".$row->ID_TEMPLATE." selected = true>".$row->NAMA_TEMPLATE."</option>";
					}else{
						echo "<option value=".$row->ID_TEMPLATE.">".$row->NAMA_TEMPLATE."</option>";
					}
					
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
            <option value="EVAL" <?php if ($data_guideline->ID_RULE == 'EVAL') {echo 'selected="true"';} ?>>Evaluator</option>
            <option value="ESLN" <?php if ($data_guideline->ID_RULE == 'ESLN') {echo 'selected="true"';} ?>>Eselon 4</option>
            <option value="ESL3" <?php if ($data_guideline->ID_RULE == 'ESL3') {echo 'selected="true"';} ?>>Eselon 3</option>
            <option value="ESL2" <?php if ($data_guideline->ID_RULE == 'ESL2') {echo 'selected="true"';} ?>>Eselon 2</option>
            <option value="ESL1" <?php if ($data_guideline->ID_RULE == 'ESL1') {echo 'selected="true"';} ?>>Eselon 1</option>
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
            <option value="1" <?php if ($data_guideline->STEP == '1') {echo 'selected="true"';} ?>>1</option>
            <option value="2" <?php if ($data_guideline->STEP == '2') {echo 'selected="true"';} ?>>2</option>
            <option value="3" <?php if ($data_guideline->STEP == '3') {echo 'selected="true"';} ?>>3</option>
          </select>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Guideline
        </div>

        <div class="profile-info-value">
          <textarea name="DESCRIPTION" class="form-control" placeholder="Masukkan guideline..."><?=$data_guideline->DESCRIPTION ?></textarea>
        </div>
      </div>


      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          Color
        </div>

        <div class="profile-info-value">
		  <input class="jscolor" type="color" value="<?=$data_guideline->COLOR ?>" id="colorTexto" name="COLOR">
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
</script>
