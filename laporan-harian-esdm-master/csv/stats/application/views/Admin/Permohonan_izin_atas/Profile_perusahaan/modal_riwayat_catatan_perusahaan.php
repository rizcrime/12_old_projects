<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Riwayat Catatan</strong></h4>
  </div>
  <div class="modal-body">
    <div class="dialogs">

      <?php 
      $count_catatan = 0;
      foreach($catatan as $item_catatan):
        // if($item_catatan->ID_USER == $userdata->ID_USER) { continue; } // Do not show own note.
        if(trim($item_catatan->URAIAN_CAT_DOK_PRSHN) == "" && trim($item_catatan->KETERANGAN_CAT_DOK_PRSHN) == "") { continue; } // Do not show empty comment.
        $count_catatan++; 
      ?>

        <div class="itemdiv dialogdiv">
        <div class="user">
          <img src='<?=base_url("assets/bolt/assets/img/support.png")?>' style="width: 100%">
        </div>

        <div class="body">
          <div class="name">
            <a href="#"><?=$item_catatan->NAMA?> @ <?=$item_catatan->TGL_CAT_DOK_PRSHN?></a>
            <hr style="margin: 0; border-top: 2px solid #eee !important">
          </div>
          <h6><strong>Uraian:</strong></h6>
          <div class="text"><?=html_entity_decode(isemptyor($item_catatan->URAIAN_CAT_DOK_PRSHN, "-"))?></div>

          <h6><strong>Keterangan:</strong></h6>
          <div class="text"><?=html_entity_decode(isemptyor($item_catatan->KETERANGAN_CAT_DOK_PRSHN, "-"))?></div>
        </div>
      </div>
      <?php endforeach; ?>

      <?php if($count_catatan == 0): ?>
        <div class="text-center"><strong>Belum ada riwayat catatan</strong></div>
      <?php endif; ?>
    </div>
  </div>  
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Close
    </button>
  </div>
</div>

<script type="text/javascript">
      jQuery(function($) {
        $('.dialogs,.comments').ace_scroll({
          size: 300
          });
      });

</script>