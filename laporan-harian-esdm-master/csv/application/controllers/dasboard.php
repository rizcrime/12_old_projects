<section class="container" style="height: 1000px;">
    <div class="row">
        <div class="col-lg-12">
            <h3>Aplikasi Perizinan EBTKE</h3>
        </div>
    </div>
    <div class="row" style="margin-top: 60px;">
        <div class="headingPanel">Langkah Pengajuan Izin</div>
        <div class="row">
            <div class="processPanel col-sm-2">
                <div class="stepNum">Step 1</div>
                <div class="col-sm-12 paddingLeft boxsizing">
                    <h5 class="row marginBottom grey marginBottom paddingTop mobAlignCenter">Pembuatan Akun</h5>
                    <div class="row mobAlignCenter">Akun perusahaan menggunakan alamat email resmi perusahaan.</div>
                </div>
            </div>
            <div class="processPanel col-sm-2">
                <div class="stepNum">Step 2</div>
                <div class="col-sm-12 paddingLeft boxsizing">
                    <h5 class="row marginBottom grey marginBottom paddingTop mobAlignCenter">Mengisi Data Perusahaan</h5>
                    <div class="row mobAlignCenter">Lengkapi data profil perusahaan.</div>
                </div>
            </div>
            <div class="processPanel col-sm-2">
                <div class="stepNum">Step 3</div>
                <div class="col-sm-12 paddingLeft boxsizing">
                    <h5 class="row marginBottom grey marginBottom paddingTop mobAlignCenter">Memilih Jenis Pelayanan Perizinan.</h5>
                    <div class="row mobAlignCenter">
                        Layanan perizinan Direktorat Jenderal EBTKE meliputi: <br>
                        1. Izin Usaha Niaga BBN <br>
                        2. Rekomendasi Ekspor dan Impor BBN
                    </div>
                </div>
            </div>
            <div class="processPanel col-sm-2">
                <div class="stepNum">Step 4</div>
                <div class="col-sm-12 paddingLeft boxsizing">
                    <h5 class="row marginBottom grey marginBottom paddingTop mobAlignCenter">Melengkapi persyaratan layanan perizinan yang dipilih</h5>
                    <div class="row mobAlignCenter">Unggah berkas-berkas yang diperlukan sesuai dng izin yang dipilih<br>
                        <br>
                    </div>
                </div>
            </div>
            <div class="processPanel col-sm-2">
                <div class="stepNum">Step 5</div>
                <div class="col-sm-12 paddingLeft boxsizing">
                    <h5 class="row marginBottom grey marginBottom paddingTop mobAlignCenter">Proses Verifikasi dan Persetujuan</h5>
                    <div class="row mobAlignCenter">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-md-10 col-sm-offset-1"> -->
            <div class="col-sm-6 col-md-3">
                <a href="<?=base_url('login/page')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo config_item('asset_front'); ?>img/pelayananonline.jpg" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Pelayanan Perizinan</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?=base_url('luar/periksa_sertifikat')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo config_item('asset_front'); ?>img/perizinan.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Periksa Sertifikat</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?=base_url('luar/monitoring_berkas')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo config_item('asset_front'); ?>img/monitoring.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Monitoring Berkas</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?=base_url('luar/panduan')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo config_item('asset_front'); ?>img/user-guides.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Tata Cara / Panduan</h3>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>
</section>
<style>
    .headingPanel {
        background: black;
        color: #fff;
        padding: 15px 0px;
        width: 100%;
        text-align: center;
        font-size: 24px;
        text-shadow: 0px 2px 2px #000;
        text-transform: uppercase;
        margin: -63px 0px 0px;
    }

    .processPanel {
        width: 20%;
        padding: 0px 30px 30px;
        height: 260px;
        border-left: solid 1px black;
    }

    .processPanel:first-child {
        border-left: none;
    }

    .processPanel .stepNum {
        width: 100%;
        text-align: center;
        height: 70px;
        font-weight: bold;
        color: #FFF;
        padding-top: 25px;
        font-size: 15px;
        background: url('/asset/frontend/images/bg-step.png') center 0px scroll no-repeat
    }
</style>