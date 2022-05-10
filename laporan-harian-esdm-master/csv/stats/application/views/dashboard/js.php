<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/blockUI.js"></script>
<script src="<?php  echo config_item('asset_back'); ?>/js/highchart/highcharts.js"></script>
<script src="<?php  echo config_item('asset_back'); ?>/js/highchart/exporting.js"></script>


<!------ Include the above in your HEAD tag ---------->

<!------ Carousel ---------->

<!-- Dashboard -->

<script type="text/javascript">
// function get12Month()
// {
//     var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
//     var today = new Date();
//     var d;
//     var month;

//     for(var i = 6; i > 0; i -= 1) {
//     d = new Date(today.getFullYear(), today.getMonth()-3 - i, 1);
//     month = monthNames[d.getMonth()];
//     year = d.getFullYear();
//     console.log(month+" "+year);
//     }
// }
// $(document).ready(function(){
    // var datadis = [{
    //     name:'Produksi',
    //     data:[190000,243000,1812000,2221000,2805000,3961081,1652801,3656359,3416417,2157424.15]
    // },{
    //     name:'Distribusi',
    //     data:[119000,223000,359000,669000,1048000,1844663,915460,3008474,2571569,1242164]
    // },{
    //     name:'Ekspor',
    //     data:[70000,20000,1453000,1552000,1757000,1629262,328573,476937,187349,388799.0529]
    // }];
    // var datadis = ;
    // var dataharga = ;
//     $('#grafik_harga').highcharts({
//         chart:{
//             zoomtype: 'x',
//         },
//         title:{
//             text: 'Data Harga Bahan Bakar Nabati'
//         },
//         subtitle:{
//             text: 'Kementerian Energi dan Sumber Daya Mineral'
//         },
//         xAxis:{
//             categories:,
//             crosshair:true
//         },
//         yAxis:{
//             min: 0,
//             title:{
//                 text: 'Harga (Rp/Liter)'
//             }
//         },
//         tooltip: {
//             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                 '<td style="padding:0"><b>Rp {point.y:.2f}/L</b></td></tr>',
//             footerFormat: '</table>',
//             shared: true,
//             useHTML: true
//         },
//         plotOptions: {
//             column: {
//                 pointPadding: 0.2,
//                 borderWidth: 0
//             },
//             series:{
//                 cursor: 'pointer',
//                 point: {
//                     events: {
//                         click: function (e) {
//                             set_grafik(this.x,,"line");
//                         }
//                     }
//                 },
//                 marker: {
//                     lineWidth: 1
//                 }
//             }
//         },
//         series: dataharga
//     });
//     $('#grafik').highcharts({
//         chart:{
//             type: 'column'
//         },
//         title:{
//             text: 'Data Produksi, Distribusi dan Export Bahan Bakar Nabati'
//         },
//         subtitle:{
//             text: 'Kementerian Energi dan Sumber Daya Mineral'
//         },
//         xAxis:{
//             categories:,
//             crosshair:true
//         },
//         yAxis:{
//             min: 0,
//             title:{
//                 text: 'Volume (kL)'
//             }
//         },
//         tooltip: {
//             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                 '<td style="padding:0"><b>{point.y:.1f} kL</b></td></tr>',
//             footerFormat: '</table>',
//             shared: true,
//             useHTML: true
//         },
//         plotOptions: {
//             column: {
//                 pointPadding: 0.2,
//                 borderWidth: 0
//             },
//             series:{
//                 cursor: 'pointer',
//                 point: {
//                     events: {
//                         click: function (e) {
//                             set_grafik(this.x,,"column");
//                         }
//                     }
//                 },
//                 marker: {
//                     lineWidth: 1
//                 }
//             }
//         },
//         series: datadis
//     });
// });
// function set_grafik(x,data,tipe){
//     tahun = data['year'][x];
//     konten = data[tahun];
//     bulan = [
//         "Jan "+tahun,
//         "Feb "+tahun,
//         "Mar "+tahun,
//         "Apr "+tahun,
//         "Mei "+tahun,
//         "Jun "+tahun,
//         "Jul "+tahun,
//         "Agu "+tahun,
//         "Sep "+tahun,
//         "Okt "+tahun,
//         "Nov "+tahun,
//         "Des "+tahun,
//     ]
//     var chart=[]
//     var kunci=[]
//     for(data_bulan in konten){
//         for(key in konten[data_bulan]){
//             if(key!='id_tahun'&&key!='id_bulan'){
//                 if(key in kunci){
//                     kunci[key][data_bulan-1]=parseFloat(konten[data_bulan][key])
//                 }
//                 else{
//                     kunci[key]=[];
//                     kunci[key][data_bulan-1]=parseFloat(konten[data_bulan][key])
//                 }
//             }
//         }
//     }
//     i=0;
//     for(key in kunci){
//         if(kunci[key].length<12){
//             for(var konci=kunci[key].length;konci<12;konci++){
//                 kunci[key][konci]=0;
//             }
//         }
//         chart[i++]={
//             name:key,
//             data:kunci[key]
//         }
//     }
//     if(tipe=='line'){
//         render_line(chart,bulan);
//     }
//     else{
//         render_column(chart,bulan);
//     }
// }
// function render_line(chart,bulan){
//     $('#grafim').highcharts({
//         chart:{
//             zoomtype: 'x',
//         },
//         title:{
//             text: 'Data Harga Bahan Bakar Nabati'
//         },
//         subtitle:{
//             text: 'Kementerian Energi dan Sumber Daya Mineral'
//         },
//         xAxis:{
//             categories:bulan,
//             crosshair:true
//         },
//         yAxis:{
//             min: 0,
//             title:{
//                 text: 'Harga (Rp/Liter)'
//             }
//         },
//         tooltip: {
//             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                 '<td style="padding:0"><b>Rp {point.y:.2f}/L</b></td></tr>',
//             footerFormat: '</table>',
//             shared: true,
//             useHTML: true
//         },
//         series: chart
//     });
//     $('#mod-grafik').modal();
// }
// function render_column(chart,bulan){
//     $('#grafim').highcharts({
//         chart:{
//             type: 'column'
//         },
//         title:{
//             text: 'Data Produksi, Distribusi dan Export Bahan Bakar Nabati'
//         },
//         subtitle:{
//             text: 'Kementerian Energi dan Sumber Daya Mineral'
//         },
//         xAxis:{
//             categories:bulan,
//             crosshair:true
//         },
//         yAxis:{
//             min: 0,
//             title:{
//                 text: 'Volume (kL)'
//             }
//         },
//         tooltip: {
//             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                 '<td style="padding:0"><b>{point.y:.1f} kL</b></td></tr>',
//             footerFormat: '</table>',
//             shared: true,
//             useHTML: true
//         },
//         series: chart
//     });
//     $('#mod-grafik').modal();
// }
// 
</script>
<script src="<?php echo base_url()?>assets/js/jquery.dataTablesPanduan.js"></script>

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
      options.data = "<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
    } else {
      options.data += "&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
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
$(document).ready( function () {
    $('#table_id').DataTable({
        "pageLength": 5
    });
    
    $('#modal_pengumuman').modal('show');
    
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});



</script>
