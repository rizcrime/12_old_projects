<div class="row">
  <div class="box-body">
    <form method="POST">
    <?=get_csrf_token()?>
      <div class="input-group form-group">
        <div class="col-md-6">
          <label>NIK</label>
          <input type="text" class="form-control" placeholder="NIK..." name="NIK" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>KODE USER</label>
          <div class="form-control" style="border: 0px; background-color: #f5f5f5;">
            <input type="radio" name="USER_CODE" value="1"> Administrator &nbsp
            <input type="radio" name="USER_CODE" value="2"> Bidder          
          </div>
        </div>
        <div class="col-md-6">
          <label>NAMA</label>
          <input type="text" class="form-control" placeholder="NAMA..." name="NAME" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>PEKERJAAN</label>
          <input type="text" class="form-control" placeholder="PEKERJAAN..." name="PROFESSION" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>TEMPAT LAHIR</label>
          <input type="text" class="form-control" placeholder="TEMPAT LAHIR..." name="BIRTH_PLACE" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>TANGGAL LAHIR</label>
          <input type="date" class="form-control" name="BIRTH_DATE" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-12">
          <label>ALAMAT</label>
          <input type="text" class="form-control" placeholder="ALAMAT..." name="ADDRESS" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>RT</label>
          <input type="number" class="form-control" placeholder="RT..." min="1" name="RT" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>RW</label>
          <input type="number" class="form-control" placeholder="RW..." min="1" name="RW" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>KELURAHAN</label>
          <input type="text" class="form-control" placeholder="KELUARAHAN..." name="KELURAHAN" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>JENIS KELAMIN</label>
          <div class="form-control" style="border: 0px; background-color: #f5f5f5;">
            <input type="radio" name="GENDER" value="1"> Laki-laki &nbsp
            <input type="radio" name="GENDER" value="2"> Perempuan          
          </div>
        </div>
        <div class="col-md-6">
          <label>GOLONGAN DARAH</label>
          <select class="form-control" name="BLOOD_TYPE" aria-describedby="sizing-addon2">
            <option>  </option>
            <option value="1"> A </option>
            <option value="2"> B </option>
            <option value="3"> O </option>
            <option value="4"> AB </option>
          </select>
        </div>
        <div class="col-md-6">
          <label>KECAMATAN</label>
          <input type="text" class="form-control" placeholder="KECAMATAN..." name="KECAMATAN" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>AGAMA</label>
          <select class="form-control" name="RELIGION" aria-describedby="sizing-addon2">
            <option>  </option>
            <option value="1"> Islam </option>
            <option value="2"> Katolik </option>
            <option value="3"> Protestan </option>
            <option value="4"> Budha </option>
            <option value="5"> Hindu </option>
          </select>
        </div>
        <div class="col-md-6">
          <label>STATUS PERNIKAHAN</label>
          <select class="form-control" name="MARITAL_STATUS" aria-describedby="sizing-addon2">
            <option>  </option>
            <option value="1"> Sudah Menikah </option>
            <option value="2"> Lajang </option>
          </select>
        </div>
        <div class="col-md-6">
          <label>KEWARGANEGARAAN</label>
          <div class="form-control" style="border: 0px; background-color: #f5f5f5;">
            <input type="radio" name="NATIONALITY" value="1"> WNI &nbsp
            <input type="radio" name="NATIONALITY" value="2"> WNA
          </div>
        </div>
        <div class="col-md-6">
          <label>AKSES LEVEL</label>
          <div class="form-control" style="border: 0px; background-color: #f5f5f5;">
            <input type="radio" name="ACCESS_LEVEL" value="1"> Super Administrator &nbsp
            <input type="radio" name="ACCESS_LEVEL" value="2"> Administrator
          </div>
        </div>
        <div class="col-md-6">
          <label>USERNAME</label>
          <input type="text" class="form-control" placeholder="USERNAME..." name="USERNAME" aria-describedby="sizing-addon2">
        </div>
        <div class="col-md-6">
          <label>PASSWORD</label>
          <input type="password" class="form-control" name="PASSWORD" aria-describedby="sizing-addon2">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
        </div>
      </div>
    </form>
  </div>
</div>

