<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
    <form id="regForm" action="/action_page.php">
    <?=get_csrf_token()?>
      <!-- One "tab" for each step in the form: -->
      <div class="tab">
        <div class="input-group form-group" style="width: 100%">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Profil Perusahaan</strong></h4>
          </div>
          <div class="col-md-6">
            <table width="100%">
              <tr>
                <td colspan="2" style="padding-bottom: 10px">Nama Perusahaan *</td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->NAMA_PERUSAHAAN ?>" name="NAMA_PERUSAHAAN" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">Alamat Perusahaan *</td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom: 10px">
                  <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2"><?= $bidder->ALAMAT ?></textarea>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Provinsi</td>
                <td style="padding-bottom: 10px">
                  <select name="ID_PROVINSI" id="PROVINSI" class="form-control">
                    <?php foreach ($dataProvinsi as $provinsi): ?>
                      <option <?php if($provinsi->ID_PROVINSI == "$provinsi->ID_PROVINSI"){ echo 'selected="selected"'; } ?> value="<?php echo $provinsi->ID_PROVINSI ?>"><?php echo $provinsi->NAMA_PROVINSI?> </option>
                    <?php endforeach ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Kab / Kota</td>
                <td style="padding-bottom: 10px">
                  <select name="ID_KABKOT" class="KABKOT form-control">
                    <option value="<?= $bidder->ID_KABKOT ?>"><?= $bidder->NAMA_KABKOT ?></option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table width="100%">
              <tr>
                <td style="padding-bottom: 10px">E-mail *</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" name="EMAIL_PERUSAHAAN" value="<?= $bidder->EMAIL_PERUSAHAAN ?>" aria-describedby="sizing-addon2" readonly>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Telp. *</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->TELEPON ?>" name="TELEPON" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Fax</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" value="<?= $bidder->FAX ?>" name="FAX" aria-describedby="sizing-addon2">
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Jenis Permodalan *</td>
                <td style="padding-bottom: 10px">
                  <select name="STATUS_MODAL" class="form-control">
                    <?php if($bidder->STATUS_MODAL == 'PMA') { ?>                  
                      <option value="<?= $bidder->STATUS_MODAL ?>"><?= $bidder->STATUS_MODAL ?></option>
                      <option value="PMDN">PMDN</option>
                    <?php } else if($bidder->STATUS_MODAL == 'PMDN') { ?>
                      <option value="<?= $bidder->STATUS_MODAL ?>"><?= $bidder->STATUS_MODAL ?></option>
                      <option value="PMA">PMA</option>
                    <?php } else { ?>
                      <option value=""></option>
                      <option value="PMDN">PMDN</option>
                      <option value="PMA">PMA</option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 10px">Website</td>
                <td style="padding-bottom: 10px">
                  <input type="text" class="form-control" <?php if($bidder->WEBSITE) { echo 'value="<?= $bidder->WEBSITE ?>"'; } ?> name="WEBSITE" aria-describedby="sizing-addon2">
                </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="input-group form-group" style="width: 100%">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Dokumen Perusahaan</strong></h4>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered table-striped" style="padding: 10px">
              <thead>
                <tr>
                  <th>Dokumen</th>
                  <th>Nomor</th>
                  <th>Tanggal Terbit</th>
                  <th>Berlaku Sampai</th>
                  <th>File</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $bidder->ID_PERUSAHAAN ?>">
                <?php foreach ($dataDokumen as $dokumen): ?>
                  <tr>
                    <input type="hidden" name="ID_DOK_SYARAT[]" class="form-control" value="<?php echo $dokumen->TID ?>">
                    <input type="hidden" name="TGL_UPLOAD[]" class="form-control" value="<?php if($dokumen->TGL_UPLOAD == '') {echo date('Y-m-d'); } else { echo $dokumen->TGL_UPLOAD; } ?>">
                    <td style="padding: 0px">
                      <input type="text" disabled class="form-control" value="<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="text" name="NOMOR[]" class="form-control" value="<?php echo $dokumen->NOMOR ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="date" name="TGL_DOKUMEN[]" class="form-control" value="<?php echo $dokumen->TGL_DOKUMEN ?>">
                    </td>
                    <td style="padding: 0px">
                      <input type="date" name="TGL_KEDALUARSA[]" class="form-control" value="<?php echo $dokumen->TGL_KEDALUARSA ?>">
                    </td>
                    <td style="padding: 0px">
                      <?php if(isset($dokumen->RID)) { ?>
                        <a href="images/<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>"><?php echo $dokumen->DOKUMEN_PERSYARATAN ?></a><br>
                      <?php } ?>
                      <input type="hidden" name="DP[]" value="<?php echo $dokumen->DOKUMEN_PERSYARATAN ?>">
                      <input type="file" class="form-control" name="DOKUMEN_PERSYARATAN[]" aria-describedby="sizing-addon2">
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="input-group form-group" style="width: 100%">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Dokumen Perusahaan</strong></h4>
          </div>
          <div class="col-md-3">
            <a class="form-control btn btn-info" data-toggle="modal" data-target="#tambah-akta"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Akta</a>
          </div>
          <div class="col-md-12">
            <table id="list-data" class="table table-bordered">
              <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;">Jenis Akta</th>
                  <th colspan="3" style="text-align: center;">Akta</th>
                  <th colspan="2" style="text-align: center;">Pengesahan</th>
                </tr>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Notaris</th>
                  <th>Tanggal</th>
                  <th>Nomor</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody id="data-akta">
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="tab">
        <div class="input-group form-group" style="width: 100%">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Tambah Data Pemohon</strong></h4>
          </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nama Lengkap
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="NAMA_LENGKAP" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Status Hubungan
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <select name="ID_STATUS_HUBUNGAN" class="form-control" onchange="f_status_hubungan(this)">
                  <option value="">Pilih</option>
                  <option value="1">Status Hubungan 1</option>
                  <option value="2">Status Hubungan 2</option>
                  <option value="3">Status Hubungan 3</option>
                  <option value="4">Status Hubungan 4</option>
                </select>
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                File Surat Kuasa
                
              </div>
              <div class="surat_kuasa profile-info-value" style="padding: 0px;display: none;">
                <input type="file" name="FILE_SURAT_KUASA" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Jenis Identitas
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <select name="ID_JENIS_IDENTITAS" class="form-control" onchange="f_jenis_identitas(this)">
                  <option value="">Pilih</option>
                  <option value="1">Jenis Identitas 1</option>
                  <option value="2">Jenis Identitas 2</option>
                  <option value="3">Jenis Identitas 3</option>
                  <option value="4">Jenis Identitas 4</option>
                </select>
              </div>
            </div>

            <div class="profile-info-row" style="">
              <div class="profile-info-name" style="min-width: 200PX">
                Nomor Identitas
                
              </div>
              <div class="nomor_identitas profile-info-value" style="padding: 0px;display: none">
                <input type="text" name="NOMOR_IDENTITAS" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                File Identitas
                
              </div>
              <div class="file_identitas profile-info-value" style="padding: 0px;display: none">
                <input type="file" name="FILE_IDENTITAS" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nomor Telp.
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="NOMOR_TELP" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                File Foto
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="file" name="FILE_FOTO" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Alamat
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <textarea class="form-control" name="ALAMAT" aria-describedby="sizing-addon2"></textarea>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="tab">
        <div class="input-group form-group" style="width: 100%">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin-bottom: 15px;">
            <h4><strong>Tambah Data Permohonan Izin</strong></h4>
          </div>
          <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Izin Instansi
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="ID_FORM" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Template Izin Instansi
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="ID_TEMPLATE" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Pemohon
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="ID_PEMOHON" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Tanggal Pengajuan
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="TGL_PENGAJUAN" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Tanggal Disetujui
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="TGL_DISETUJUI" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Status
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="ID_CURR_PROSES" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nomor Izin
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="NOMOR_IZIN" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                Nomor Tahunan
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="NOMOR_TAHUNAN" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

            <div class="profile-info-row">
              <div class="profile-info-name" style="min-width: 200PX">
                TTD
                
              </div>
              <div class="profile-info-value" style="padding: 0px">
                <input type="text" name="ID_TEKS_TTD" class="form-control" aria-describedby="sizing-addon2">
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="tab">Resume
        <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
        <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
      </div>
      <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
      <!-- Circles which indicates the steps of the form: -->
      <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>
    </form>
  </div>
</div>

<?php echo $modal_add_akta; ?>
<div id="tempat-modal"></div>


<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  /*  margin: 100px auto;*/
  font-family: Raleway;
  padding: 40px;
  width: 100%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<script>
  function f_status_hubungan(obj) {
      if(obj.value){
          $(".surat_kuasa").attr("style","display:block;padding: 0px;");
      } else {        
          $(".surat_kuasa").attr("style","display:none;padding: 0px;");
      }
  }

  function f_jenis_identitas(obj) {
      if(obj.value){
          $(".nomor_identitas").attr("style","display:block;padding: 0px;");
          $(".file_identitas").attr("style","display:block;padding: 0px;");
      } else {        
          $(".nomor_identitas").attr("style","display:none;padding: 0px;");
          $(".file_identitas").attr("style","display:none;padding: 0px;");
      }
  }

  $(document).ready(function(){
    $('#PROVINSI').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
          }
          $('.KABKOT').html(html);
        }
      });
    });
  });

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  // if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>