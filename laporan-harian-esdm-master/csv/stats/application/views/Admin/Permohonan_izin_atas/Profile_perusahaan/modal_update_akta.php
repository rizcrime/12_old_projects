  <div class="form-msg">
  </div>
  <form id="form-update-akta" method="POST" enctype="multipart/form-data">
  <?=get_csrf_token()?>
    <input type="hidden" name="ID_AKTA" value="<?php echo $dataAkta->ID_AKTA?>">
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
                <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Hi There !!" data-content="This is information about Jenis Akta"><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
              </div>

              <div class="profile-info-value">
                <select style="width: 100%!important" class="chosen-select form-control tag-input-style" name="JENIS_AKTA_SELECT" id="" data-placeholder="Pilih Jenis Akta...">
                  <?php if ($dataAkta->IS_PERUBAHAN == 'Y') { ?>
                    <option value="Y" selected="selected">Pendirian</option>
                    <option value="N">Perubahan</option>
                  <?php } else { ?>
                    <option value="Y">Pendirian</option>
                    <option value="N" selected="selected">Perubahan</option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nomor Akta
                <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Hi There !!" data-content="This is information about ....."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
              </div>

              <div class="profile-info-value">
                <input type="text" id="NOMOR_AKTA" required pattern="^(0|[1-9][0-9]*)$" oninvalid="this.setCustomValidity('Nomor Akta tidak boleh kosong dan harus angka')" oninput="setCustomValidity('')" name="NOMOR_AKTA_TEXT" placeholder="Nomor Akta" style="width: 100%;" value="<?php echo $dataAkta->NOMOR_AKTA; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nama Notaris
                <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Hi There !!" data-content="This is information about ....."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
              </div>

              <div class="profile-info-value">
                <input type="text" id="NAMA_NOTARIS" pattern="[a-zA-Z\s]+" oninvalid="this.setCustomValidity('Nama Notaris harus huruf')" oninput="setCustomValidity('')" name="NAMA_NOTARIS_TEXT" placeholder="Nama Notaris" style="width: 100%;" value="<?php echo $dataAkta->NOTARIS; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Tanggal Akta
                
              </div>

              <div class="profile-info-value">
                <input type="date" class="form-control" name="TANGGAL_AKTA_DATE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Tanggal Akta tidak boleh kosong')" oninput="setCustomValidity('')" value="<?php echo $dataAkta->TGL_AKTA; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Nomor SK Kumham
                <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Hi There !!" data-content="This is information about ....."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
              </div>

              <div class="profile-info-value">
                <input type="text" id="NOMOR_SK" name="NOMOR_PENGESAHAN_TEXT" pattern="^(0|[1-9][0-9]*)$" oninvalid="this.setCustomValidity('Nomor SK harus angka')" oninput="setCustomValidity('')"  placeholder="Nomor SK Kumham" style="width: 100%;" value="<?php echo $dataAkta->NO_PENGESAHAN; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Tanggal SK Kumham
                
              </div>

              <div class="profile-info-value">
                <input type="date" class="form-control" name="TANGGAL_PENGESAHAN_DATE" aria-describedby="sizing-addon2" required oninvalid="this.setCustomValidity('Tanggal SK Kumham tidak boleh kosong')" oninput="setCustomValidity('')" value="<?php echo $dataAkta->TGL_PENGESAHAN; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Unggah Akta
                
              </div>

              <div class="profile-info-value">
                <input type="file" class="form-control" name="AKTA_FILE" aria-describedby="sizing-addon2"  oninvalid="this.setCustomValidity('File berupa PDF')"  oninput="setCustomValidity('')">
                <input type="hidden" name="AKTA_FILE" value="<?php echo $dataAkta->FILE_AKTA; ?>">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name">
                Unggah SK Kumham
                
              </div>

              <div class="profile-info-value">
                <input type="file" class="form-control" name="PENGESAHAN_FILE" aria-describedby="sizing-addon2"   oninvalid="this.setCustomValidity('File berupa PDF')" oninput="setCustomValidity('')">
                <input type="hidden" name="PENGESAHAN_FILE" value="<?php echo $dataAkta->FILE_PENGESAHAN; ?>">
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


<script type="text/javascript">
  jQuery("input[type='File']").ace_file_input({
    no_file:'No File ...',
    btn_choose:'Choose',
    btn_change:'Change',
    droppable:false,
    onchange:null,
    thumbnail:false, //| true | large
	  maxSize: <?=get_max_size()?>,
    //whitelist:'gif|png|jpg|jpeg'
    //blacklist:'exe|php'
    //onchange:''
    //
  });

</script>