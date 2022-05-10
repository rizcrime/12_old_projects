<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li <?php if ($page == 'verifikasi_perusahaan') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Verifikasi_bidder'); ?>">
					<i class="fa fa-user"></i> <span>Registrasi Masuk <?php if($sum_unverified_bidder > 0) {?><span class="label bg-red">(<?php echo $sum_unverified_bidder; ?>)</span> <?php }?></span>
				</a>
			</li>
			<li <?php if ($page == 'izin_view') {echo 'class="active"';} ?>>
				<a href="<?=base_url('ReportPermohonan/allIzin'); ?>">
					<i class="glyphicon glyphicon-globe"></i> <span>Overview Izin</span>
				</a>
			</li>
			<li <?php if ($page == 'permohonan_search') {echo 'class="active"';} ?>>
				<a href="<?=base_url('ReportPermohonan/search_permohonan'); ?>">
					<i class="glyphicon glyphicon-search"></i> <span>Track Izin</span>
				</a>
			</li>
			<li <?php if ($page == 'arsip_izin') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Permohonan_izin_both/arsip'); ?>">
					<i class="fa fa-archive"></i> <span>Arsip Produk Izin</span>
				</a>
			</li>
		</ul><!-- /.sidebar-menu -->
	</section><!-- /.sidebar -->
</aside>