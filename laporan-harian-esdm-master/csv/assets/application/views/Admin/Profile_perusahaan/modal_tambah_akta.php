  <div class="form-msg">
  </div>
  <form id="form-tambah-akta" method="POST" enctype="multipart/form-data">
  <?=get_csrf_token()?>
    <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 10px">
        <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center;"><strong>Form Akta dan Pengesahannya</strong></h4>
        </div>
        <div class="modal-body">
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Jenis Akta
              </div>

              <div class="profile-info-value">
                <select style="width: 100%!important" class="chosen-select form-control tag-input-style" name="JENIS_AKTA_SELECT" id="" data-placeholder="Pilih Jenis Akta..." required>
                  <option value="">-Pilih-</option>
                  <option value="Y">Pendirian</option>
                  <option value="T">Perubahan</option>  
                </select>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nomor Akta
              </div>

              <div class="profile-info-value">
                <input type="text" id="NOMOR_AKTA" required oninvalid="this.setCustomValidity('Nomor Akta tidak boleh kosong')" oninput="setCustomValidity('')" name="NOMOR_AKTA_TEXT" placeholder="Nomor Akta" style="width: 100%;">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nama Notaris
              </div>

              <div class="profile-info-value">
                <input type="text" id="NAMA_NOTARIS" oninvalid="this.setCustomValidity('Nama Notaris tidak boleh kosong')" oninput="setCustomValidity('')" name="NAMA_NOTARIS_TEXT" placeholder="Nama Notaris" style="width: 100%;" required>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Tanggal Akta
              </div>

              <div class="profile-info-value">
                <input id="tgl-akta-datepicker-add" type="text" class="form-control" name="TANGGAL_AKTA_DATE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Tanggal Akta tidak boleh kosong')" oninput="setCustomValidity('')" max='<?=date("Y-m-d")?>'>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nomor SK Kumham
              </div>

              <div class="profile-info-value">
                <input type="text" id="NOMOR_SK" name="NOMOR_PENGESAHAN_TEXT" oninvalid="this.setCustomValidity('Nomor SK tidak boleh kosong')" oninput="setCustomValidity('')"  placeholder="Nomor SK Kumham" style="width: 100%;" required>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Tanggal SK Kumham
              </div>

              <div class="profile-info-value">
                <input id="tgl-sk-kumham-datepicker-add" type="text" class="form-control" name="TANGGAL_PENGESAHAN_DATE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Tanggal SK Kumham tidak boleh kosong')" oninput="setCustomValidity('')" max='<?=date("Y-m-d")?>'>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Unggah Akta
              </div>

              <div class="profile-info-value">
                <input accept=".pdf,.jpg,.jpeg,.png" type="file" class="form-control" flag="input-file" name="AKTA_FILE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('File harus dicantumkan')" oninput="setCustomValidity('')">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Unggah SK Kumham
              </div>

              <div class="profile-info-value">
                <input accept=".pdf,.jpg,.jpeg,.png" type="file" class="form-control" flag="input-file" name="PENGESAHAN_FILE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('File harus dicantumkan')" oninput="setCustomValidity('')">
              </div>
            </div>
          </div>
        </div>  
        <div class="modal-footer" style="border-radius:0 0 10px 10px;">
          <button type="submit" class='btn btn-sm btn-primary' >
            <i class='ace-icon fa fa-save'></i>
            Save
          </button>
          <button class='btn btn-sm btn-danger' data-dismiss='modal'>
            <i class='ace-icon fa fa-times'></i>
            Cancel
          </button>
        </div>
      </div>
      
    </div>
  </form>
</div>

<script>
  $('#tgl-akta-datepicker-add').datepicker({
		format: 'yyyy-mm-dd',
		setDate: new Date(),
    endDate: '<?=date("Y-m-d")?>'
	});

	$('#tgl-akta-datepicker-add').on('changeDate show', function(e) {
		this.setCustomValidity('');

    setSKLimit();
	});

	$('#tgl-sk-kumham-datepicker-add').datepicker({
		format: 'yyyy-mm-dd',
		setDate: new Date(),
    startDate: '<?=date("Y-m-d")?>'
	});

  $('#tgl-sk-kumham-datepicker-add').on('changeDate show', function(e) {
		this.setCustomValidity('');
	});

  function setSKLimit() {
    var tglAkta = $('#tgl-akta-datepicker-add').datepicker("getDate"); // Tgl akta, can be null
    var tglSKKumham = $('#tgl-sk-kumham-datepicker-add').datepicker("getDate");
    
    $('#tgl-sk-kumham-datepicker-add').datepicker("destroy");

    $('#tgl-sk-kumham-datepicker-add').datepicker({
      format: 'yyyy-mm-dd',
      setDate: new Date(),
      startDate: tglAkta
    });

    $('#tgl-sk-kumham-datepicker-add').datepicker('setDate', tglSKKumham);
  }
</script>