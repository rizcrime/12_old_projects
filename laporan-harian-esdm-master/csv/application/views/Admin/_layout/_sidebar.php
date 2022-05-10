<aside class="main-sidebar">
  <section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
      <li class="header">NAVIGATION MENU</li>
      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
      </li>
      <?php echo 'test'; ?>

      <?php if(isset($this->userdata->ID_ROLE)) { ?>
        <?php if($this->userdata->ID_ROLE == "ADM") { ?>
          <!--<li <?php if ($page == 'verifikasi_perusahaan') {echo 'class="active"';} ?>>
            <a href="<?php echo base_url('Verifikasi_bidder'); ?>">
              <i class="fa fa-user"></i> <span>Registrasi Masuk</span>
            </a>
          </li>-->
          <li <?php if ($page == 'verifikasi_perusahaan') {echo 'class="active"';} ?>>
			<a href="<?php echo base_url('Verifikasi_bidder'); ?>">
				<i class="fa fa-user"></i> <span>Registrasi Masuk <?php if($sum_unverified_bidder > 0) {?><span class="label bg-red">(<?php echo $sum_unverified_bidder; ?>)</span> <?php }?></span>
			</a>
		 </li>
          <li class="treeview menu-open">
            <a href="#">
              <i class="fa fa-dashboard"></i><span>Admin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($page == 'role') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Role'); ?>" onclick="f(this)">
                  <i class="fa fa-database"></i> <span>Role</span>
                </a>
              </li>
              <li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Admin'); ?>">
                  <i class="fa fa-user"></i> <span>User Admin</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="treeview menu-open">
            <a href="#">
              <i class="fa fa-dashboard"></i><span>Manajemen Izin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($page == 't_persyaratan_izin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('T_persyaratan_izin'); ?>">
                  <i class="fa fa-user"></i> <span>Persyaratan Izin</span>
                </a>
              </li>
              <li <?php if ($page == 'mapping_izin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Mapping_izin'); ?>">
                  <i class="fa fa-user"></i> <span>Mapping Persyaratan Izin</span>
                </a>
              </li>
              <li <?php if ($page == 'sla_izin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Sla_izin'); ?>">
                  <i class="fa fa-user"></i> <span>SLA Izin</span>
                </a>
              </li>
              <li <?php if ($page == 'izin_instansi') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Izin_instansi'); ?>">
                  <i class="fa fa-user"></i> <span>Izin Instansi</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="treeview menu-open">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Skema</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($page == 'skema_workflow') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Skema_workflow'); ?>">
                  <i class="fa fa-database"></i> <span>Skema Workflow</span>
                </a>
              </li>
              <li <?php if ($page == 'skemaizin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('SkemaIzin'); ?>">
                  <i class="fa fa-user"></i> <span>Skema Izin</span>
                </a>
              </li>
              <li <?php if ($page == 'skemaizin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Skema_proses'); ?>">
                  <i class="fa fa-exchange"></i> <span>Proses Skema</span>
                </a>
              </li>
              <li <?php if ($page == 'skemaizin') {echo 'class="active"';} ?>>
                <a href="<?php echo base_url('Skema_proses_role'); ?>">
                  <i class="fa fa-cog"></i> <span>Hak Akses Proses</span>
                </a>
              </li>
            </ul>
            <li class="treeview menu-open">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Provinsi dan Kabkot</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($page == 'provinsi') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('Provinsi'); ?>">
                    <i class="fa fa-database"></i> <span>Provinsi</span>
                  </a>
                </li>
                <li <?php if ($page == 'kabkot') {echo 'class="active"';} ?>>
                  <a href="<?php echo base_url('Kabkot'); ?>">
                    <i class="fa fa-database"></i> <span>Kabupaten Kota</span>
                  </a>
                </li>
              </ul>
            </li>
            <li <?php if ($page == 'dok_syarat_perusahaan') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Dok_syarat_perusahaan'); ?>">
                <i class="fa fa-tags"></i> <span>Dokumen Syarat Perusahaan</span>
              </a>
            </li>
          <?php } else { ?>
            <li <?php if ($page == 'verifikasi_perusahaan') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Verifikasi_bidder'); ?>">
                <i class="fa fa-user"></i> <span>Registrasi Masuk <?php if($sum_unverified_bidder > 0) {?><span class="label bg-red">(<?php echo $sum_unverified_bidder; ?>)</span> <?php }?></span>
              </a>
            </li>
            <li <?php if ($page == 'permohonan_izin_eval') {echo 'class="active"';} ?>>
            <?php
                //TODO: Move to controller
                $eval_url = ($this->session->userdata('userdata')->ID_ROLE == "EVAL" ? "Permohonan_izin_eval" : "Permohonan_izin_atas");
            ?>
              <a href="<?php echo base_url($eval_url); ?>">
                <i class="fa fa-user"></i> <span>Permohonan Izin <?php if($sum_permohonan > 0) {?><span class="label bg-red">(<?php echo $sum_permohonan; ?>)</span> <?php }?></span>
              </a>
            </li>
            <li <?php if ($page == 'arsip_izin') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url($eval_url.'/arsip'); ?>">
                <i class="fa fa-archive"></i> <span>Arsip Produk Izin</span>
              </a>
            </li>
            <!-- <li <?php if ($page == 'bidder') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Bidder'); ?>">
                <i class="fa fa-user"></i> <span>Perusahaan</span>
              </a>
            </li> -->
          <?php } ?>
        <?php } else { ?>
          <li <?php if ($page == 'profile_perusahaan') {echo 'class="active"';} ?>>
            <a href="<?php echo base_url('Profile_perusahaan'); ?>">
              <i class="fa fa-user"></i> <span>Profile Perusahaan</span>
            </a>
          </li>

          <!-- 
            edited by rendra 11:27, 03/07/2018
            sebelumnya yang dicek adalah IS_DOKUMEN_KOMPLIT
            seharusnya yang dicek adalah IS_VERIFIED
          -->
          <?php if($this->session->userdata('isVerified')->IS_VERIFIED == "Y") { ?>
            <li <?php if ($page == 'permohonan_izin') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Permohonan_izin'); ?>">
                <i class="fa fa-file"></i> <span>Permohonan Izin</span>
              </a>
            </li>
          <?php } ?>
        <?php } ?>

      </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
  </aside>