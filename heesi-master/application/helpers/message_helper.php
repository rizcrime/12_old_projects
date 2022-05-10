<?php 
	function show_succ_msg($content='', $size='14px') {
		if ($content != '') {
			return   '
			    <div class="m-alert m-alert--icon m-alert--air alert alert-success alert-dismissible fade show" role="alert">
					<div class="m-alert__icon">
						<i class="fas fa-check-circle"></i>
					</div>
					<div class="m-alert__text">
						'.$content.'
					</div>
					<div class="m-alert__close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
					</div>
				</div>
			';
		}
	}

	function show_err_msg($content='', $size='14px') {
		if ($content != '') {
			return   '
			    <div class="m-alert m-alert--icon m-alert--air alert alert-danger alert-dismissible fade show" role="alert">
					<div class="m-alert__icon">
						<i class="fas fa-info-circle"></i>
					</div>
					<div class="m-alert__text">
						'.$content.'
					</div>
					<div class="m-alert__close">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
					</div>
				</div>
			';
		}
	}
 ?>