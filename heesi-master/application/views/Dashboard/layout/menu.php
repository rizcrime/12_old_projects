<html>
<body>
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <div class="sticky-top">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Dashboard/Home'); ?>">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">SIPATUH<br>Haji Khusus</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('Dashboard/Home'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <!-- <hr class="sidebar-divider"> -->

      <!--Awal Menu-->
      <?php 
        if ($this->session->userdata('kd_pihk') == 'monitoring') {
          ?>
          <!-- Sidebar Toggler (Sidebar) -->
      <div class="d-none d-md-inline" style="margin-left: 30px;">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      
          <?php
        }elseif($this->session->userdata('kd_pihk') == 'admin') {
      ?>
          <!-- Heading -->
          <!-- <div class="sidebar-heading">
            PIHK
          </div> -->

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePihk" aria-expanded="true" aria-controls="collapsePihk">
              <i class="fas fa-fw fa-cog"></i>
              <span>PIHK</span>
            </a>
            <div id="collapsePihk" class="collapse" aria-labelledby="headingPihk" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PIHK</h6>
                <!-- <a class="collapse-item" href="<?php echo base_url(''); ?>">Pendaftaran</a> -->
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Pihk'); ?>">Informasi User</a>
                <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest/tambah_pramanifest'); ?>">Pra Manifest</a> -->
              </div>
            </div>
          </li>

          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaket" aria-expanded="true" aria-controls="collapsePaket">
              <i class="fas fa-fw fa-plus"></i>
              <span>Entry</span>
            </a>
            <div id="collapsePaket" class="collapse" aria-labelledby="headingPaket" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Entry</h6>
                <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest/import'); ?>">Upload Pra Manifest</a> -->
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Instrumen/tambah'); ?>">Instrumen Arab Saudi</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/InstrumenIndo/tambah'); ?>">Instrumen Indonesia <span class="badge badge-danger badge-counter">NEW!</span></a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Konfigurasi/tambah_konfigurasi'); ?>">Hotel dan Transportasi</a>
              </div>
            </div>
          </li>

          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePraManifest" aria-expanded="true" aria-controls="collapsePraManifest">
              <i class="fas fa-fw fa-folder"></i>
              <span>Informasi</span>
            </a>
            <div id="collapsePraManifest" class="collapse" aria-labelledby="headingPraManifest" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Informasi</h6>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/paket'); ?>">Paket</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest'); ?>">Pra Manifest</a>
                <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pelunasan'); ?>">Pelunasan</a> -->
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Informasi/tanggal_berangkat'); ?>">Filter Data <span class="badge badge-danger badge-counter">NEW!</span></a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Instrumen'); ?>">Instrumen Arab Saudi</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/InstrumenIndo'); ?>">Instrumen Indonesia <span class="badge badge-danger badge-counter">NEW!</span></a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Konfigurasi'); ?>">Hotel dan Transportasi</a>
              </div>
            </div>
          </li>

          <!-- Divider -->
          <!-- <hr class="sidebar-divider"> -->

          <!-- Heading -->
          <!-- <div class="sidebar-heading">
            Menu
          </div> -->

          <!-- Nav Item - Pages Collapse Menu -->
          

          <!-- Divider -->
          <!-- <hr class="sidebar-divider"> -->
      <?php
        }elseif($this->session->userdata('kd_pihk') == 'super_monitoring'){
      ?>
          <!-- Heading -->
          <!-- <div class="sidebar-heading">
            PIHK
          </div> -->

          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEntry" aria-expanded="true" aria-controls="collapseEntry">
              <i class="fas fa-fw fa-plus"></i>
              <span>Entry</span>
            </a>
            <div id="collapseEntry" class="collapse" aria-labelledby="headingEntry" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Entry</h6>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Instrumen/tambah'); ?>">Instrumen Arab Saudi</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/InstrumenIndo/tambah'); ?>">Instrumen Indonesia <span class="badge badge-danger badge-counter">NEW!</span></a>
              </div>
            </div>
          </li>
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePihk" aria-expanded="true" aria-controls="collapsePihk">
              <i class="fas fa-fw fa-cog"></i>
              <span>PIHK</span>
            </a>
            <div id="collapsePihk" class="collapse" aria-labelledby="headingPihk" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PIHK</h6>
                <!-- <a class="collapse-item" href="<?php echo base_url(''); ?>">Pendaftaran</a> -->
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Pihk'); ?>">Informasi User</a>
                <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest/tambah_pramanifest'); ?>">Pra Manifest</a> -->
              </div>
            </div>
          </li>

          <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePraManifest" aria-expanded="true" aria-controls="collapsePraManifest">
              <i class="fas fa-fw fa-folder"></i>
              <span>Informasi</span>
            </a>
            <div id="collapsePraManifest" class="collapse" aria-labelledby="headingPraManifest" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Informasi</h6>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/paket'); ?>">Paket</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest'); ?>">Pra Manifest</a>
                <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pelunasan'); ?>">Pelunasan</a> -->
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Informasi/tanggal_berangkat'); ?>">Filter Data <span class="badge badge-danger badge-counter">NEW!</span></a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/Instrumen'); ?>">Instrumen Arab Saudi</a>
                <a class="collapse-item" href="<?php echo base_url('Dashboard/InstrumenIndo'); ?>">Instrumen Indonesia <span class="badge badge-danger badge-counter">NEW!</span></a>
              </div>
            </div>
          </li>

          <!-- Divider -->
          <!-- <hr class="sidebar-divider"> -->

          <!-- Heading -->
          <!-- <div class="sidebar-heading">
            Menu
          </div> -->

          <!-- Nav Item - Pages Collapse Menu -->
          

          <!-- Divider -->
          <!-- <hr class="sidebar-divider"> -->
      <?php    
      }else{  
      ?>
      
      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Menu
      </div> -->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaket" aria-expanded="true" aria-controls="collapsePaket">
          <i class="fas fa-fw fa-plus"></i>
          <span>Entry</span>
        </a>
        <div id="collapsePaket" class="collapse" aria-labelledby="headingPaket" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Entry</h6>
            <!-- <a class="collapse-item" href="<?php echo base_url(''); ?>">Pendaftaran</a> -->
            <a class="collapse-item" href="<?php echo base_url('Dashboard/paket/tambah_paket'); ?>">Paket</a>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest/tambah_pramanifest'); ?>">Pra Manifest</a>
            <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest/import'); ?>">Upload Pra Manifest</a> -->
            <a class="collapse-item" href="<?php echo base_url('Dashboard/ProfileJemaah/index'); ?>">Edit Profile Jemaah</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePraManifest" aria-expanded="true" aria-controls="collapsePraManifest">
          <i class="fas fa-fw fa-folder"></i>
          <span>Informasi</span>
        </a>
        <div id="collapsePraManifest" class="collapse" aria-labelledby="headingPraManifest" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Informasi</h6>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/paket'); ?>">Paket</a>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/pramanifest'); ?>">Pra Manifest</a>
            <!-- <a class="collapse-item" href="<?php echo base_url('Dashboard/pelunasan'); ?>">Pelunasan</a> -->
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDownload" aria-expanded="true" aria-controls="collapseDownload">
          <i class="fas fa-fw fa-download"></i>
          <span>Download</span>
        </a>
        <div id="collapseDownload" class="collapse" aria-labelledby="headingDownload" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Download</h6>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/Home/download_android_apk'); ?>">Android APK</a>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/Home/download_manual_book_web'); ?>">Manual Book Web</a>
            <a class="collapse-item" href="<?php echo base_url('Dashboard/Home/download_manual_book_android'); ?>">Manual Book Android</a>
          </div>
        </div>
      </li>

      <?php } ?>
      <!--Bates Menu-->

      <!-- Sidebar Toggler (Sidebar) -->
      <!-- <div class="text-center d-none d-md-inline text-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div> -->
    </div>
    </ul>
    <!-- End of Sidebar --> 
</body>
</html>
