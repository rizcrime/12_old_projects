<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home_perusahaan') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Home_perusahaan'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
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
    	</ul><!-- /.sidebar-menu -->
	</section><!-- /.sidebar -->
</aside>