<style>
/* .accordion-mark:after {
    content: '\25BC';
    font-size: 20px;
    color: white;
    float: right;
    margin-left: 5px;
    -webkit-transition: all .35s;
    -o-transition: all .35s;
    transition: all .35s;
}

.accordion-mark.active:after {
    transform: rotateX(180deg);
} */
</style>

<!-- Content -->
<div class="panel-group" style="width: 100%; background-color: white; border: solid 1px #3c8dbc; border-radius: 5px;margin-bottom: 5px;">
  <div id="catatan-pengembalian-accordion" class="panel panel-default" style="border: none;">
    <div class="panel-heading" style="padding: 1px 15px 1px 15px; background-color: #3c8dbc;" data-toggle="collapse" data-target="#catatan-pengembalian-iframe">
      <div class="panel-title">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong style="color: white;">Alasan Pengembalian</strong><span class="accordion-mark <?= $open_default == "in" ? "active" : ""?>"></span></h4>
      </div>
    </div>
    <div id="catatan-pengembalian-iframe" class="panel-collapse collapse <?=$open_default?>">
      <div class="panel-body">
      <div id="alasan-pengembalian-block" class="alert alert-warning" style="color:#8a6d3b !important;background-color: #fcf8e3 !important;border-color: #faebcc !important;">
            <h6><strong>Catatan</strong> <span id="alasan-pengembalian-name"><?=issetor($alasan_pengembalian->NAMA)?></span> @ <span id="alasan-pengembalian-date"><?=issetor($alasan_pengembalian->TGL_ALASAN_PENGEMBALIAN)?></span></h6>
            <h6><strong>Alasan:</strong></h6>
            <div id="alasan-pengembalian-content" class="text">
                <?=html_entity_decode(issetor($alasan_pengembalian->ALASAN_PENGEMBALIAN))?>
            </div>
        </div>

        <button id="view-riwayat-alasan-pengembalian" class="btn btn-primary btn-md"  onclick="return false;" data-id="<?=$id_permohonan?>">Riwayat Alasan</button>
        <?php if($allowAddPengembalian) : ?>
        <button id="add-pengembalian-quick" class="btn btn-primary btn-md" onclick="return false;" data-id="<?=$id_permohonan?>">Tambah Catatan</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- End of Content -->

<script>
    <?php if($allowAddPengembalian) : ?>
    $(document).on("click", "#add-pengembalian-quick", function(e) {
        e.preventDefault();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

        $.ajax({
            method: "GET",
            url: "<?=base_url("{$controller_url}/pengembalian_quick"); ?>",
            processData: false,
            contentType: false
        })
        .done(function(data) {
            $('#tempat-modal').html(data);
            $('#pengembalian-permohonan-quick').modal('show');
        })
        .always(function(){
            $.unblockUI();
        })
    });

    $(document).on("submit", "#form-pengembalian-quick", function(e){
      e.preventDefault();
      $('#pengembalian-permohonan-quick').modal('hide');
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

      var textContent = tinymce.get('alasan_pengembalian-quick_text').getContent();
	  $("#alasan_pengembalian-quick_text").html(textContent);

      var formData = new FormData($(this)[0]);
      formData.set("ALASAN_PENGEMBALIAN", textContent); // Avoid tinymce bug

      $.ajax({
        method: 'POST',
        url: '<?=base_url("{$controller_url}/tambah_alasan_pengembalian"); ?>',
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function(data) {
        var out = jQuery.parseJSON(data);

        if (out.status == 'form') {
          $('#pengembalian-permohonan-quick').modal('show');
          $('.form-msg').html(out.msg);
          effect_msg_form();
        } else {
          $('#pengembalian-permohonan-quick').modal('hide');
          $('.msg').html(out.msg);
          effect_msg();
          loadNewAlasan(textContent);
        }
      })
      .always(function(){
        $.unblockUI();
      })
    });

    function loadNewAlasan(alasanText) {
      var userName = "<?=$userdata->NAMA?>";
      
      var nowDate = new Date();
      currentMonth = nowDate.getMonth() + 1;
      if (currentMonth < 10) { currentMonth = '0' + currentMonth; }

      var postedDate = nowDate.getFullYear();
      postedDate += "-" + currentMonth;
      postedDate += "-" + nowDate.getDate();
      
      if($.trim(alasanText) == "") {
        alasanText = "-";
      }

      $("#alasan-pengembalian-date").html(postedDate);
      $("#alasan-pengembalian-content").html(alasanText);
      $("#alasan-pengembalian-name").html(userName);
    }

    <?php endif; ?>    

    // Riwayat
    $("#view-riwayat-alasan-pengembalian").click(function(e) {
        e.stopPropagation();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
        var id = $(this).attr("data-id");
        
        $.ajax({
          method: "POST",
          url: "<?php echo base_url("{$controller_url}/riwayat_alasan_pengembalian"); ?>",
          data: "id=" +id
        })
        .done(function(data) {
          $('#tempat-modal').html(data);
          $('#riwayat-alasan-pengembalian').modal('show');
        })
        .always(function(){
          $.unblockUI();
        })
    })
</script>