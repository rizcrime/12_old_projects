<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Alasan Pengembalian</strong></h4>
  </div>
  <form id="form-pengembalian-quick">
  <?=get_csrf_token()?>
  <div class="form-msg"></div>
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          <textarea id="alasan_pengembalian-quick_text" name="ALASAN_PENGEMBALIAN" cols="400" rows="4" required><?=issetor($latest_alasan->ALASAN_PENGEMBALIAN)?></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button id="kirim-pengembalian-quick" type="submit" class='btn btn-sm btn-primary' data-id="">
      <i class='ace-icon fa fa-save'></i>
      Simpan
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Batal
    </button>
  </div>
</form>
</div>

<script>
  $(document).on("click", "#kirim-pengembalian-quick", function(e) {
    tinymce.triggerSave();
  });

  $("#pengembalian-permohonan-quick").on('show.bs.modal', function (e) {
    tinymce.init({
      selector: '#alasan_pengembalian-quick_text',
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

  $("#pengembalian-permohonan-quick").on('hidden.bs.modal', function (e) {
    tinymce.remove("#alasan_pengembalian-quick_text");
  })
</script>