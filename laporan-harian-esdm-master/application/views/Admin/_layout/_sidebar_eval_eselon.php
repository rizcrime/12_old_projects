<aside class="main-sidebar">
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree"><!-- Sidebar Menu -->
			<li class="header">NAVIGATION MENU</li>
			<li <?php if ($page == 'home') {echo 'class="active"';} ?>>
				<a href="<?=base_url('Home'); ?>">
					<i class="fa fa-dashboard"></i> <span>Home</span>
				</a>
			</li>
			<li <?php if ($page == 'permohonan_izin_eval' || $page == 'permohonan_izin_atas') {echo 'class="active"';} ?>>
				<?php
                //TODO: Move to controller
				$eval_url = ($this->session->userdata('userdata')->ID_ROLE == "EVAL" ? "Permohonan_izin_eval" : "Permohonan_izin_atas");
				?>
				<a href="<?php echo base_url($eval_url); ?>">
					<i class="fa fa-user"></i> <span>Permohonan Izin <?php if($sum_permohonan > 0) {?><span class="label bg-red">(<?php echo $sum_permohonan; ?>)</span> <?php }?></span>
				</a>
			</li>

			<li <?php if ($page == 'permohonan_izin_ood') {echo 'class="active"';} ?>>
				<a href="<?=base_url('Permohonan_izin_ood'); ?>">
					<i class="glyphicon glyphicon-stats"></i> <span>Daftar Request</span>
				</a>
			</li>

			<?php 
				if($this->userdata->ID_ROLE == "ESL1" 
				|| $this->userdata->ID_ROLE == "ESL2"
				|| $this->userdata->ID_ROLE == "ESLS"
				|| $this->userdata->ID_ROLE == "ESLT"
				):
			?>
			<li <?php if ($page == 'izin_view') {echo 'class="active"';} ?>>
				<a href="<?=base_url('ReportPermohonan/allIzin'); ?>">
					<i class="glyphicon glyphicon-globe"></i> <span>Overview Izin</span>
				</a>
			</li>

			<li class="treeview menu-open <?php if ($page == 'report_izin' || $page == 'summary_izin') {echo 'active';} ?>">
				<a href="#">
					<i class="glyphicon glyphicon-stats"></i> <span>Reporting</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?php if ($page == 'report_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Report_izin'); ?>">
							<i class="glyphicon glyphicon-stats"></i> <span>Report Izin</span>
						</a>
					</li>
					<li <?php if ($page == 'summary_izin') {echo 'class="active"';} ?>>
						<a href="<?php echo base_url('Summary_izin'); ?>">
							<i class="glyphicon glyphicon-stats"></i> <span>Rekap Bulanan</span>
						</a>
					</li>
				</ul>
			</li>


			<li <?php if ($page == 'permohonan_search') {echo 'class="active"';} ?>>
				<a href="<?=base_url('ReportPermohonan/search_permohonan'); ?>">
					<i class="glyphicon glyphicon-search"></i> <span>Track Izin</span>
				</a>
			</li>
			<?php endif;?>
			
			<li <?php if ($page == 'arsip_izin') {echo 'class="active"';} ?>>
				<a href="<?php echo base_url('Permohonan_izin_both/arsip'); ?>">
					<i class="fa fa-archive"></i> <span>Arsip Produk Izin</span>
				</a>
			</li>
		</ul><!-- /.sidebar-menu -->
	</section><!-- /.sidebar -->
</aside>