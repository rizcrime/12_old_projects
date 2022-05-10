<form>
<?=get_csrf_token()?>
	<iframe style="margin-top: 10px; border: 0px;" src="<?=$enkriptedQS?>" width="100%" height="800" scrolling="no"></iframe>
	<p id="callback">
	</p>
</form>

<div style="text-align: center;">
    <button class="btn btn-md btn-danger tolak">Tolak</button>
    <button type="button" class="btn btn-md btn-info kembali-eval pengembalian">Kembalikan Ke Evaluator</button>
    <?php echo $button?>
</div>


<script type="text/javascript">
    function konfirmasiKembalikan() {
        // if(confirm("Apakah anda yakin?")) {

        // }
    }
	iFrameResize({
        log                     : true,                  // Enable console logging
        inPageLinks             : true,
        resizedCallback         : function(messageData){ // Callback fn when resize is received
        	// $('p#callback').html(
        	// 	'<b>Frame ID:</b> '    + messageData.iframe.id +
        	// 	' <b>Height:</b> '     + messageData.height +
        	// 	' <b>Width:</b> '      + messageData.width +
        	// 	' <b>Event type:</b> ' + messageData.type
        	// 	);
        },
        messageCallback         : function(messageData){ // Callback fn when message is received
        	// $('p#callback').html(
        	// 	'<b>Frame ID:</b> '    + messageData.iframe.id +
        	// 	' <b>Message:</b> '    + messageData.message
        	// 	);
        	alert(messageData.message);
        	// document.getElementsByTagName('iframe')[0].iFrameResizer.sendMessage('Hello back from parent page');
        },
        closedCallback         : function(id){ // Callback fn when iFrame is closed
        	// $('p#callback').html(
        	// 	'<b>IFrame (</b>'    + id +
        	// 	'<b>) removed from page.</b>'
        	// 	);
        }
    });

    $(document).on("click", ".tolak", function(e) {
        e.preventDefault();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
        var id = $(this).attr("data-id");
        // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();
        // var catatanSimpulanText = "";

        var formData = new FormData();
        formData.append("id", id);
        // formData.append("catatan_simpulan", catatanSimpulanText);

        $.ajax({
            method: "POST",
            url: "<?php echo base_url('Permohonan_izin_atas/tolak'); ?>",
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(data) {
            
            $('#tempat-modal').html(data);
            $('#tolak-permohonan').modal('show');

        })
        .always(function(){
            $.unblockUI();
        })
    });

    $(document).on("click", ".pengembalian", function(e) {
        e.preventDefault();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
        var id = $(this).attr("data-id");
        // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();
        // var catatanSimpulanText = "";

        var formData = new FormData();
        formData.append("id", id);
        // formData.append("catatan_simpulan", catatanSimpulanText);

        $.ajax({
            method: "POST",
            url: "<?php echo base_url('Permohonan_izin_atas/pengembalian'); ?>",
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(data) {
            
            $('#tempat-modal').html(data);
            $('#pengembalian-permohonan').modal('show');

        })
        .always(function(){
            $.unblockUI();
        })
    });

    $(document).on("click", ".setuju", function(e) {
        e.preventDefault();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

        var id = $(this).attr("data-id");
        // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();
        // var catatanSimpulanText = "";

        var formData = new FormData();
        formData.append("id", id);
        // formData.append("catatan_simpulan", catatanSimpulanText);

        $.ajax({
            method: "POST",
            url: "<?php echo base_url('Permohonan_izin_atas/setuju'); ?>",
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(data) {
            $('#tempat-modal').html(data);
            $('#setuju-permohonan').modal('show');
        })
        .always(function(){
            $.unblockUI();
        })
    });

    $(document).on("click", ".pengesahan", function(e) {
        e.preventDefault();
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

        var id = $(this).attr("data-id");
        // var catatanSimpulanText = tinymce.get('catatanSimpulan').getContent();
        // var catatanSimpulanText = "";

        var formData = new FormData();
        formData.append("id", id);
        // formData.append("catatan_simpulan", catatanSimpulanText);

        $.ajax({
            method: "POST",
            url: "<?php echo base_url('Permohonan_izin_atas/pengesahan'); ?>",
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(data) {
            $('#tempat-modal').html(data);
            $('#pengesahan-permohonan').modal('show');
        })
        .always(function(){
            $.unblockUI();
        })
    })

    $(document).on("submit", "#pengesahan-form", function(e) {
        $('#pengesahan-permohonan').modal('hide');
        $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
    })

</script>