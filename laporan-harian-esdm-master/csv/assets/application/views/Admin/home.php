							<div class="space-6"></div>
                            <div class="space-6"></div>
                            <div class="space-6"></div>
							<div class="center">
								<img src="<?php echo base_url("assets/img/Logo_ESDM.png"); ?>" width="212px" height="212px">
							</div>
<?php if($this->session->flashdata('msg')): ?>
	<div class="alert alert-info alert-dismissible" style="margin-top: 5px;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<p><i class="glyphicon glyphicon-info-sign"></i><strong> <?php echo $this->session->flashdata('msg'); ?></strong></p>
	</div>
<?php endif; ?>
<div class="center" >
		
</div>
	
