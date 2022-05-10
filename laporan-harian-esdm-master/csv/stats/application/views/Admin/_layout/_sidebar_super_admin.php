<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
		
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung') {echo 'active';} ?> <?php echo (isset($status) and $status == "SUPER_ADMIN") ? "" : "hidden"; ?>">
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
					<li <?php if ($page == 'hak_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Hak_izin'); ?>">
							<i class="fa fa-cog"></i> <span>Hak Akses</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-user"></i> <span>User</span>
						</a>
					</li>
                    <li <?php if ($page == 'aktivitas') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Aktivitas'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Aktivitas</span>
						</a>
					</li>
                    <li <?php if ($page == 'gunung') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Gunung'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Gunung</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="<?php echo ($page == "pusdatin") ? "active" : ""; ?> <?php echo (isset($side_menu["PUSDATIN"]) and $side_menu["PUSDATIN"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_pusdatin'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Pusdatin</span>
				</a>
			</li>
			<li class="<?php echo ($page == "geologi") ? "active" : ""; ?> <?php echo (isset($side_menu["GEOLOGI"]) and $side_menu["GEOLOGI"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_geologi'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Geologi</span>
				</a>
			</li>
			<li class="<?php echo ($page == "klik") ? "active" : ""; ?> <?php echo (isset($side_menu["KLIK"]) and $side_menu["KLIK"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_klik'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Klik</span>
				</a>
			</li>
			<!--
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'list_user' || $page == 'hak_izin') {echo 'active';} ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Pusdatin</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?php if ($page == 'role') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Role'); ?>" onclick="f(this)">
							<i class="fa fa-file"></i> <span>Produksi Minyak</span>
						</a>
					</li>
					<li <?php if ($page == 'hak_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Hak_izin'); ?>">
							<i class="fa fa-file"></i> <span>ICP</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Produksi Gas</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Produksi Ekuivalen Migas</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Lifting Tahun Berjalan</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Progres Peny. Premium Jamali </span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Berita OPEC Harian</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Harga Batubara Acuan</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Harga Mineral Acuan</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Status Ketenagalistrikan</span>
						</a>
					</li>
					
					
				</ul>
			</li>
			
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'list_user' || $page == 'hak_izin') {echo 'active';} ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Geologi</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?php if ($page == 'role') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Role'); ?>" onclick="f(this)">
							<i class="fa fa-file"></i> <span>Gunung Api</span>
						</a>
					</li>
					<li <?php if ($page == 'hak_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Hak_izin'); ?>">
							<i class="fa fa-file"></i> <span>Gerakan Tanah</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Gempa Bumi</span>
						</a>
					</li>
					
				</ul>
			</li>
			
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'list_user' || $page == 'hak_izin') {echo 'active';} ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Klik</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?php if ($page == 'role') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Role'); ?>" onclick="f(this)">
							<i class="fa fa-file"></i> <span>Migas</span>
						</a>
					</li>
					<li <?php if ($page == 'hak_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Hak_izin'); ?>">
							<i class="fa fa-file"></i> <span>Minerba</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Ketenagalistrikan</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>EBTKE</span>
						</a>
					</li>
					<li <?php if ($page == 'admin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Admin'); ?>">
							<i class="fa fa-file"></i> <span>Geologi</span>
						</a>
					</li>
					
				</ul>
			</li>-->
			
			
			</ul><!-- /.sidebar-menu -->	
		</section><!-- /.sidebar -->
	</aside>