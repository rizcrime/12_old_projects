<style>
    .accordion-pengembalian {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 10px;
        width: 100%;
        text-align: left;
        font-size: 18px !important;
        font: message-box;
        border: none;
        outline: none;
        transition: 0.4s;
    }

    .accordion-pengembalian.active:hover {
        background-color: #ccc; 
    }

    .panel_pengembalian {
        padding: 0 1px;
        background-color: white;
        overflow: hidden;
    }

    .accordion-pengembalian:after {
        content: '\25BC';
        font-size: 20px;
        color: white;
        float: right;
        margin-left: 5px;
        -webkit-transition: all .35s;
        -o-transition: all .35s;
        transition: all .35s;
    }

    .accordion-pengembalian.active:after {
        transform: rotateX(180deg);
    }
</style>

<!-- Content -->
<div class="accordion-pengembalian col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom:5px;">
	<i class="fa fa-file-text" style="color: #fff000"></i> <strong>Alasan Pengembalian</strong>
</div>
<?php
    if($open_default):
        $block = "display:block;";
    else:
        $block = "display:none;";
    endif;
?>
<div class="panel-pengembalian" style="<?=$block?> width: 100%; background-color: white; margin: 10px 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
    <div class="col-md-12">
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
    &nbsp; <!-- avoid no content bug -->
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

    $(document).ready(function(){
		var acc = document.getElementsByClassName("accordion-pengembalian");
		var z;
		for (z = 0; z < acc.length; z++) {
			acc[z].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel_pengembalian = this.nextElementSibling;
				if (panel_pengembalian.style.display === "block") {
					panel_pengembalian.style.display = "none";
				} else {
					panel_pengembalian.style.display = "block";
				}
			});
		}
	});
</script>