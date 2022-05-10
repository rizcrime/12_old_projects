<nav class="navbar navbar-static-top" role="navigation" style="background: #F4E909">
  <!-- Sidebar toggle button-->
  <a href="<?php echo base_url(); ?>assets/admin/#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu" style="background:#000">
    <ul class="nav navbar-nav">
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        
<!--    <td width="100%" align="center" bgcolor="#222d32" class="border; btn-prodminyak_view-all" style="padding:0 5 0 5; font-size:14px" colspan="4" ><p align="left" style="color: #FFFF00;">Login as :</p></td>
-->
        <a href="<?php echo base_url(); ?>assets/#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <!--           <img src="<?php //echo base_url(); ?>assets/img/<?php //echo $userdata->picture; ?>" class="user-image" alt="User Image"> -->
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <!-- <span class="hidden-xs"><?php //echo $userdata->USERNAME; ?></span> -->
        Login as : <?php if(isset($userdata->USERNAME)) { echo $userdata->USERNAME; } else { echo $userdata->EMAIL_PERUSAHAAN; } ?>
         
          
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header" style="background: #F4E909">
            <!--             <img src="<?php //echo base_url(); ?>assets/img/<?php //echo $userdata->picture; ?>" class="img-circle" alt="User Image"> -->

            <p style="color:#000">
              <?php if(isset($userdata->USERNAME)) { echo $userdata->USERNAME; } else { echo $userdata->EMAIL_PERUSAHAAN; } ?>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
            <?php
              $profile_url = ($this->session->userdata('status') == "INVESTOR") ? "Profile_user" : "Profile" ;
            ?>
              
            </div>
            <?php if(isset($userdata->USERNAME)) { ?>
<!--               <?php if($this->session->userdata('status') == 'EVALUATOR' || $this->session->userdata('status') == 'SUPER_ADMIN') { ?> -->
              <div class="pull-right">
                <a href="<?php echo base_url('AuthAdmin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
<!--               <?php } ?> -->
            <?php } else { ?>
              <div class="pull-right">
                <a href="<?php echo base_url('Beranda/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            <?php } ?> 
<!--             <?php if(isset($userdata->USERNAME)) { 
              if($this->session->userdata('status') == 'EVALUATOR') { ?>
                <div class="pull-right">
                  <a href="<?php echo base_url('AuthAdmin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              <?php } ?>
            <?php } else { ?>
              <div class="pull-left">
                <a href="<?php echo base_url('Profile_perusahaan'); ?>" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url('Beranda/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
              </div> 
            <?php } ?> -->
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>