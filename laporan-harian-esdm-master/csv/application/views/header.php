<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minerba</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()?>assets/bolt/assets/css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url()?>assets/bolt/assets/css/main.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bolt/assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/chart.js"></script>

  <?php echo $script_captcha; // javascript recaptcha ?>

  <?php 

  // function tgl_indo($tanggal){
  //   $bulan = array (
  //     1 =>   'January',
  //     'February',
  //     'March',
  //     'April',
  //     'May',
  //     'Juny',
  //     'July',
  //     'August',
  //     'September',
  //     'October',
  //     'November',
  //     'December'
  //   );

  //   $pecahkan = explode('-', $tanggal);
  //   return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  // }
  ?>
</head>

<body>

  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" style="border-bottom: solid #555 5px">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img class="img-responsive" src="<?php echo base_url()?>assets/bolt/assets/img/header.png" style="max-height: 80px;"></i></a>
      </div>
      <div class="navbar-collapse collapse">
        <div class="col-md-2 pull-right" style="margin-top: 15px">
          <a href="<?php echo base_url();?>"><div class="col-md-5 home">Home</div></a>
          <a id="#btn-login1" href="" data-toggle="modal" data-target="#form-login"><div class="col-md-5 login">Login</div></a>
        </div>
      </div><!--/.nav-collapse -->
    </div>
  </div>

  <?php echo $modal_login; ?>
  <?php echo $modal_login2; ?>
  <?php echo $modal_register; ?>
  <?php echo $modal_lupa; ?>
  <?php echo $modal_sk; ?>

  <style type="text/css">
  div.modal-header{
    background-color: #428bca;
    border-radius: 5px 5px 0 0;
    text-align: center;
  }
  div.modal-header>h4{
    color: white;
    font-weight: 700;
  }
  div.login{
    background-color: #54a506;
    margin: 5px;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
    color: #ffffff;
  }
  div.home{
    background-color: #ffd82e;
    margin: 5px;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
    color: #000000;
  } 
  div.login:hover{
    background-color: #5fbb06;
  }
  div.home:hover{
    background-color: #ffde4d;
  }
</style>

<script type="text/javascript">
  var myEl = document.getElementById('#btn-login1');

  myEl.addEventListener('click', function() {
    document.getElementById("formDaftar").reset();
    document.getElementById("form-login2").reset();
    grecaptcha.reset();
  }, false);

  function effect_msg_form() {
    // $('.form-msg').hide();
    $('.form-msg').show(1000);
    setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
  }

  function effect_msg() {
    // $('.msg').hide();
    $('.msg').show(1000);
    setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
  }
  function effect_msg2() {
    // $('.msg').hide();
    $('.msg').show(1000);
    // setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
  }
  //login
  $('#form-login2').submit(function(e) {
    var formData = new FormData($(this)[0]);

    hideModal($('#form-login'));
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('AuthBidder/login'); ?>',
      data: formData,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      if (out.status == 'form') {

        $.unblockUI(); 
        $('#form-login').modal('show');
        $('.form-msg').html(out.msg);
        effect_msg_form();
        grecaptcha.reset();
        
      } else if(out.status == 'login') {

        $('#modal_login').modal('hide'); 
        window.location.href = '<?php echo base_url('Home_perusahaan');?>';
        
      } else if(out.status == 'is_password'){

        $.unblockUI(); 
        window.location.href = '<?php echo base_url('Ubah_password');?>';

      } else {
        $.unblockUI();
        showModal($('#form-login'));
        document.getElementById("formDaftar").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg();

      }
      // tampillogin();$.unblockUI(); 

    })
    e.preventDefault();
  });

  //login2
  $('#form-login-icon2').submit(function(e) {
    var formData = new FormData($(this)[0]);

    hideModal($('#form-login'));
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('AuthBidder/login'); ?>',
      data: formData,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      if (out.status == 'form') {

        $.unblockUI(); 
        $('#form-login-icon').modal('show');
        $('.form-msg').html(out.msg);
        effect_msg_form();
        grecaptcha.reset();
        
      } else if(out.status == 'login') {

        $('#modal_login').modal('hide'); 
        window.location.href = '<?php echo base_url('Home_perusahaan');?>';
        
      } else if(out.status == 'is_password'){

        $.unblockUI(); 
        window.location.href = '<?php echo base_url('Ubah_password');?>';

      } else {
        $.unblockUI();
        showModal($('#form-login'));
        document.getElementById("formDaftar").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg();

      }
      // tampillogin();$.unblockUI(); 

    })
    e.preventDefault();
  });

  function tampillogin() {
    $.get('<?php echo base_url('Home/index'); ?>', function(data) {
      refresh();
    });
  }
  
  //register
  $('#formDaftar').submit(function(e) {
    var formData = new FormData($(this)[0]);
    
    $('#form-register').modal('hide');
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' }); 

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Registrasi/register'); ?>',
      data: formData,
      processData: false,
      contentType: false
    })

    .done(function(data) {
      var out = jQuery.parseJSON(data);
      var sendbtn = document.getElementById('#submitDaftar');

      if (out.status == 'form') {
        $.unblockUI(); 
        $('#form-register').modal('show');
        $('.form-msg').html(out.msg);
        effect_msg_form();
        grecaptcha.reset();

      } else if(out.status == 'sukses') {
        $.unblockUI(); 
        $('#form-register').modal('show');
        document.getElementById("formDaftar").reset();
        $('.msg').html(out.msg);
        effect_msg2();
        grecaptcha.reset();
        sendbtn.disabled = false;
      } else {
        $.unblockUI(); 
        $('#form-register').modal('show');
        document.getElementById("formDaftar").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg();
      }
    })
    e.preventDefault();
  });

  //lupa password
  $('#formLupa').submit(function(e) {
    var formData = new FormData($(this)[0]);
    
    $('#form-lupa').modal('hide');
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' }); 

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('LupaPass/lupa'); ?>',
      data: formData,
      processData: false,
      contentType: false
    })

    .done(function(data) {
      var out = jQuery.parseJSON(data);
      var sendbtn = document.getElementById('#sumbitLupa');

      if (out.status == 'form') {
        $.unblockUI(); 
        $('#form-lupa').modal('show');
        $('.form-msg').html(out.msg);
        effect_msg_form();
        grecaptcha.reset();

      } else if(out.status == 'sukses') {
        $.unblockUI(); 
        $('#form-lupa').modal('show');
        document.getElementById("formLupa").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg2();
        
        sendbtn.disabled = false;
      } else {
        $.unblockUI(); 
        $('#form-lupa').modal('show');
        document.getElementById("formLupa").reset();
        grecaptcha.reset();
        $('.msg').html(out.msg);
        effect_msg();
      }
    })
    e.preventDefault();
  });

  $('#form-login').on('hidden.bs.modal', function () {
    document.getElementById("formDaftar").reset();
    document.getElementById("form-login2").reset();
    grecaptcha.reset();
    $('.form-msg').html('');
  })

  $('#form-register').on('hidden.bs.modal', function () {
    document.getElementById("formDaftar").reset();
    document.getElementById("form-login2").reset();
    grecaptcha.reset();
    $('.form-msg').html('');
  })

  $('#form-lupa').on('hidden.bs.modal', function () {
    document.getElementById("formDaftar").reset();
    document.getElementById("form-login2").reset();
    grecaptcha.reset();
    $('.form-msg').html('');
  })

  $('#form-sk').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })


  $(document).ready(function(e){
    var action = getUrlParameter("action");
    
    if(action === "login") {
      $("#form-login").modal('show');
    }
  });

  // Modal helper
	var actionInProgress = false;
	var nextActionQueue = [];

	function showModal(modal) {
	if (actionInProgress) {
		nextActionQueue.push({
		id: modal.attr('id'),
		action: showModal
		});
		return;
	}

	actionInProgress = true;
	modal.on('shown.bs.modal', showCompleted);
	modal.modal("show");

	function showCompleted() {
		actionInProgress = false;
		modal.off('shown.bs.modal', showCompleted);
		if (nextActionQueue.length > 0) {
		var next = nextActionQueue.shift();
		next.action($("#" + next.id));
		}
	}
	};

	function hideModal(modal) {
	if (actionInProgress) {
		nextActionQueue.push({
		id: modal.attr('id'),
		action: hideModal
		});
		return;
	}
	
	actionInProgress = true;
	modal.on('hidden.bs.modal', hideCompleted);
	modal.modal("hide");

	function hideCompleted() {
		actionInProgress = false;
		modal.off('hidden.bs.modal', hideCompleted);
		if (nextActionQueue.length > 0) {
		var next = nextActionQueue.shift();
		next.action($("#" + next.id));
		}
	}
	};

  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
  if(!(originalOptions.data instanceof FormData)) {
    if(!options.data) {
      //options.data = "<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
	  options.data = "";
    } else {
      //options.data += "&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
	  options.data += "";
    }
  }
});

function resetAllRecaptcha() {
    let recaptchaCount = $(".g-recaptcha").length;

    for(let i = 0; i < recaptchaCount; i++) {
      grecaptcha.reset(i);
    }
}
$(document).ajaxComplete(function() {
  resetAllRecaptcha();
});
</script>
