<form id="form-catatan-kesimpulan">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px;">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Tambah Catatan Kesimpulan</strong></h4>
    </div>
    <div class="modal-body">
    <div class="form-msg"></div>
      <textarea name="catatan-kesimpulan" id="catatan-kesimpulan-text"><?=issetor($cat_kesimpulan->CATATAN_SIMPULAN)?></textarea>    
    </div>  
    <div class="modal-footer" style="border-radius:0 0 10px 10px;">
      <button id="get-catatan-dokumen" type="button" class='btn btn-sm btn-info'>
        <i class='ace-icon fa fa-plus'></i>
        Ambil Catatan Dokumen
      </button>
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

<style type="text/css">
#mceu_22,#mceu_45{
  display: none!important;
}
</style>

<script>
  $(document).on("submit", "#form-catatan-kesimpulan", function(e) {
      e.preventDefault();

      var textContent = tinymce.get('catatan-kesimpulan-text').getContent();
		  $("#catatan-kesimpulan-text").html(textContent);

      var formData = new FormData($(this)[0]);
      formData.set("CATATAN_SIMPULAN", textContent); // Avoid tinymce bug

      if($.trim(textContent) == "") {
        alert("Catatan Kesimpulan wajib diisi");
        return;
      }

      $('#modal-catatan-kesimpulan').modal('hide');
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

      $.ajax({
        method: 'POST',
        url: '<?=base_url("{$tambah_kesimpulan_url}/tambahCatatanKesimpulan")?>',
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function(data) {
        var out = jQuery.parseJSON(data);

        if (out.status == 'form') {
          $('#modal-catatan-kesimpulan').modal('show');
          $('.form-msg').html(out.msg);
          effect_msg_form();
        } else {
          $('#modal-catatan-kesimpulan').modal('hide');
          $('.msg').html(out.msg);
          effect_msg();
          updateCatatanKesimpulan(textContent);
        }
      })
      .always(function(){
        $.unblockUI();
      })
  });

  function updateCatatanKesimpulan(textContent, username = "<?=$userdata->NAMA?>", postedDate = null) {
    var nowDate = new Date();
    currentMonth = nowDate.getMonth() + 1;
    if (currentMonth < 10) { currentMonth = '0' + currentMonth; }

    if(postedDate == null) {
        postedDate = nowDate.getFullYear();
        postedDate += "-" + currentMonth;
        postedDate += "-" + nowDate.getDate();
    }
    $("#catatan-kesimpulan-block").css("display", "");
    $("#catatan-kesimpulan-name").html(username);
    $("#catatan-kesimpulan-date").html(postedDate);
    $("#catatan-kesimpulan-content").html(textContent);
  }

  $("#modal-catatan-kesimpulan").on('show.bs.modal', function (e) {
    tinymce.init({
      selector: '#catatan-kesimpulan-text',
      height: 300,
      plugins: [
        "advlist autolink lists charmap preview hr pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons paste textcolor"
      ],
      toolbar1: "insert | preview | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
    });
  })

  $("#modal-catatan-kesimpulan").on('hidden.bs.modal', function (e) {
    tinyMCE.remove("#catatan-kesimpulan-text");
  })

  $(document).ready(function() {
    checkKesimpulanShow();
  });

  function checkKesimpulanShow() {
    var catatanKesimpulan = $.trim($("#catatan-kesimpulan-content").html());

    if(catatanKesimpulan != "") {
      $("#catatan-kesimpulan-block").css("display", "");
    }
  }

  $(document).on("click", "#get-catatan-dokumen", function(e) {
    e.preventDefault();
    $("#get-catatan-dokumen").attr("disabled", "disabled");

    $.ajax({
      method: "GET",
      url: "<?php echo base_url('Permohonan_izin_both/get_catatan_kesimpulan'); ?>"
    })
    .done(function(data) {
      let activeEditor = tinymce.get('catatan-kesimpulan-text');
      
      if(!activeEditor) {
        return;
      }

      let dataParse = JSON.parse(data);
      let currentContent = activeEditor.getContent();
      let newContent = currentContent + dataParse;

      activeEditor.setContent(newContent);
    })
    .always(function(){
      $("#get-catatan-dokumen").removeAttr("disabled");
    })
  })

  // Riwayat
  $("#view-riwayat-kesimpulan").click(function(e) {
      // e.stopPropagation();
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      var id = $(this).attr("data-id");
      
      $.ajax({
        method: "POST",
        url: "<?php echo base_url("{$tambah_kesimpulan_url}/riwayatCatatanKesimpulan"); ?>",
        data: "id=" +id
      })
      .done(function(data) {
        $('#tempat-modal').html(data);
        $('#riwayat-catatan-kesimpulan').modal('show');
      })
      .always(function(){
        $.unblockUI();
      })
  })
</script>