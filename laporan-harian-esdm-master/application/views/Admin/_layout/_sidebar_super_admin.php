<?php if( $userdata->ID_ROLE == 10  ) { ?>
<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung'|| $page == 'target'|| $page == 'pusdatin') {echo 'active';} ?> <?php echo (isset($status) and $status == "ADMIN_PUSDATIN"); ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Admin Pusdatin</span>
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
                    <!--<li <?php if ($page == 'aktivitas') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Aktivitas'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Aktivitas</span>
						</a>
					</li>
                    <li <?php if ($page == 'gunung') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Gunung'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Gunung</span>
						</a>
					</li>-->
                    <li <?php if ($page == 'target') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Target'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Target</span>
						</a>
					</li>
				</ul>
			</li>
			<?php if($side_menu == null) { ?>
			<li class="disabled" style="margin-top:20px;">
				<a>
					<i class="glyphicon glyphicon-warning-sign"></i> <span>Set hak akses menu dahulu!</span>
				</a>
			</li>
			<?php }else{ }?>


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
			<!--<li class="<?php echo ($page == "klik") ? "active" : ""; ?> <?php echo (isset($side_menu["KLIK"]) and $side_menu["KLIK"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_klik'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
				</a>
			</li>-->
            
            <li class="<?php echo ($page == "berita") ? "active" : ""; ?> <?php echo (isset($side_menu["BERITA"]) and $side_menu["BERITA"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_berita'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
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
   
<?php
}

else if( $userdata->ID_ROLE == 11  ) { ?>
<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung'|| $page == 'target'|| $page == 'pusdatin') {echo 'active';} ?> <?php echo (isset($status) and $status == "ADMIN_GEOLOGI"); ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Admin Geologi</span>
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
                    <!--<li <?php if ($page == 'target') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Target'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Target</span>
						</a>
					</li>-->
				</ul>
			</li>
			<?php if($side_menu == null) { ?>
			<li class="disabled" style="margin-top:20px;">
				<a>
					<i class="glyphicon glyphicon-warning-sign"></i> <span>Set hak akses menu dahulu!</span>
				</a>
			</li>
			<?php }else{ }?>


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
			<!--<li class="<?php echo ($page == "klik") ? "active" : ""; ?> <?php echo (isset($side_menu["KLIK"]) and $side_menu["KLIK"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_klik'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
				</a>
			</li>-->
            
            <li class="<?php echo ($page == "berita") ? "active" : ""; ?> <?php echo (isset($side_menu["BERITA"]) and $side_menu["BERITA"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_berita'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
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
   
<?php
}

else if( $userdata->ID_ROLE == 12  ) { ?>
<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung'|| $page == 'target'|| $page == 'pusdatin') {echo 'active';} ?> <?php echo (isset($status) and $status == "ADMIN_BERITA"); ?>">
				<a href="#">
					<i class="fa fa-dashboard"></i><span>Admin Berita</span>
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
                    <!--<li <?php if ($page == 'aktivitas') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Aktivitas'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Aktivitas</span>
						</a>
					</li>
                    <li <?php if ($page == 'gunung') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Gunung'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Gunung</span>
						</a>
					</li>-->
                    <!--<li <?php if ($page == 'target') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Target'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Target</span>
						</a>
					</li>-->
				</ul>
			</li>
			<?php if($side_menu == null) { ?>
			<li class="disabled" style="margin-top:20px;">
				<a>
					<i class="glyphicon glyphicon-warning-sign"></i> <span>Set hak akses menu dahulu!</span>
				</a>
			</li>
			<?php }else{ }?>


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
			<!--<li class="<?php echo ($page == "klik") ? "active" : ""; ?> <?php echo (isset($side_menu["KLIK"]) and $side_menu["KLIK"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_klik'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
				</a>
			</li>-->
            
            <li class="<?php echo ($page == "berita") ? "active" : ""; ?> <?php echo (isset($side_menu["BERITA"]) and $side_menu["BERITA"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_berita'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
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
   
<?php
}

else {?>    
    
<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung'|| $page == 'target') {echo 'active';} ?> <?php echo (isset($status) and $status == "SUPER_ADMIN") ? "" : "hidden"; ?>">
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
                    <li <?php if ($page == 'target') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Target'); ?>" onclick="f(this)">
							<i class="fa fa-database"></i> <span>Target</span>
						</a>
					</li>
				</ul>
			</li>
			<?php if($side_menu == null) { ?>
			<li class="disabled" style="margin-top:20px;">
				<a>
					<i class="glyphicon glyphicon-warning-sign"></i> <span>Set hak akses menu dahulu!</span>
				</a>
			</li>
			<?php }else{ }?>


			<li class="<?php echo ($page == "pusdatin") ? "active" : ""; ?> <?php echo (isset($side_menu["PUSDATIN"]) and $side_menu["PUSDATIN"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_pusdatin'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Pusdatin</span>
				</a>
			</li>
            
            
       <!--<li class="treeview menu-open <?php if ($page == 'role' || $page == 'admin' || $page == 'hak_izin'|| $page == 'aktivitas'|| $page == 'gunung'|| $page == 'target') {echo 'active';} ?> <?php echo (isset($status) and $status == "SUPER_ADMIN") ? "" : "hidden"; ?>">

            
            <li class="<?php echo ($page == "arsip_pusdatin") ? "active" : ""; ?> <?php echo (isset($side_menu["ARSIP_PUSDATIN"]) and $side_menu["ARSIP_PUSDATIN"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_arsip_pusdatin'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Arsip Laporan Harian Pusdatin</span>
				</a>
			</li>-->
            
            <!--<li <?php if ($page == 'arsip_pusdatin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Lap_arsip_pusdatin'); ?>" onclick="f(this)">
							<i class="glyphicon glyphicon-file"></i> <span>Arsip Pusdatin</span>
						</a>
			</li>-->
            
            <!--<li <?php if ($page == 'arsip_pusdatin') {echo 'class="active"';} ?><?php echo (isset($status) and $status == "ARSIP_PUSDATIN") ? "" : "hidden"; ?>>
						<a href="<?php echo base_url('Lap_arsip_pusdatin'); ?>" onclick="f(this)">
							<i class="glyphicon glyphicon-file"></i> <span>Arsip Pusdatin</span>
						</a>
			</li>-->
            
         <!--   <li <?php if ($page == 'arsip_pusdatin') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Lap_arsip_pusdatin'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Arsip Pusdatin</span>
				</a>
			</li>-->
            
			<li class="<?php echo ($page == "geologi") ? "active" : ""; ?> <?php echo (isset($side_menu["GEOLOGI"]) and $side_menu["GEOLOGI"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_geologi'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Geologi</span>
				</a>
			</li>
			<!--<li class="<?php echo ($page == "klik") ? "active" : ""; ?> <?php echo (isset($side_menu["KLIK"]) and $side_menu["KLIK"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_klik'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
				</a>
			</li>-->
            
            <li class="<?php echo ($page == "berita") ? "active" : ""; ?> <?php echo (isset($side_menu["BERITA"]) and $side_menu["BERITA"] == "Y") ? "" : "hidden"; ?> ">
				<a href="<?=base_url('Lap_berita'); ?>">
					<i class="glyphicon glyphicon-file"></i> <span>Laporan Harian Update Berita</span>
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
<?php } ?>    
    
        