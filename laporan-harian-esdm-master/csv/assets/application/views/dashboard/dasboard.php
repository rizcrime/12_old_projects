<section class="container" style="height: 100%;">
    <div class="row">
        <div class="col-lg-12">
            <h3>Aplikasi Perizinan dan Non-perizinan EBTKE</h3>
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
                        <a href="#" data-toggle="modal" data-target="#modal_layanan">Klik disini</a> untuk mengetahui jenis layanan yang tersedia.
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
		<div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <div class="item">
                    <div>
                        <a href="#" data-toggle="modal" data-target="#form-login"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo base_url('assets/frontend/'); ?>img/pelayananonline.jpg" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Pelayanan Perizinan</h3>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="item">
                    <div class="caption">
                        <a href="<?=base_url('CekProduk/search')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo base_url('assets/frontend/'); ?>img/perizinan.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <label><h3>Periksa Sertifikat</h3></label>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <a href="<?=base_url('TrackPermohonan/search')?>"><div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo base_url('assets/frontend/'); ?>img/monitoring.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;"></a>
                    <div class="caption">
                        <h3>Monitoring Berkas</h3>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <a href="<?=base_url('Panduan')?>">
                        <div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo base_url('assets/frontend/'); ?>img/user-guides.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
                        </a>
                        <div class="caption">
	                        <h3>Tata Cara / Panduan</h3>
	                    </div>
	                    </div>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <a href="<?=base_url('ListRUP')?>">
                        <div class="thumbnail"> <img alt="100%x200" data-src="holder.js/100%x200" src="<?php echo base_url('assets/frontend/'); ?>img/disetujui.png" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
                        </a>
                        <div class="caption">
	                        <h4>LIST REGISTRASI USAHA PENUNJANG</h4>
	                    </div>
	                    </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	</div>


</section>
<style>
	.MultiCarousel { float: left; overflow: hidden; padding: 10px; width: 100%; position:relative; }
    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
        .MultiCarousel .MultiCarousel-inner .item { float: left;}
        .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:10px; width: 100%;}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:90%;top:calc(35% - 20px); }
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    
    .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }

    .caption-white {
		background: white;
	}
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
        background: url('<?php echo base_url("assets/frontend/"); ?>images/bg-step.png') center 0px scroll no-repeat
    }

    @media only screen and (max-width: 600px) {
        .processPanel {
            width: 100%;
        }
    }
</style>

<?php echo $modal_layanan; ?>



