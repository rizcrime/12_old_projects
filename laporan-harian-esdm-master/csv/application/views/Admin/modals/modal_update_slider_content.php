<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Slider Content</h3>

  <form id="form-update-slider_content" method="POST">
  <?=get_csrf_token()?>
    <input type="hidden" name="id" value="<?php echo $dataSlider_content->SLIDER_CONTENT_CODE; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      </span>
      <input type="text" class="form-control" name="SLIDER_CONTENT_NAME" value="<?php echo $dataSlider_content->SLIDER_CONTENT_NAME; ?>" aria-describedby="sizing-addon2">
      <input type="file" class="form-control" name="SLIDER_CONTENT_FILE" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>