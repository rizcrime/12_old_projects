<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
$internal_url = "http://172.16.0.29";
$external_url = "http://172.16.0.29";
*/
$internal_url = "http://formgen-ebtke-dev.esdm.go.id";
$external_url = "http://formgen-ebtke-dev.esdm.go.id";

$config['pengesahan_url'] = "{$internal_url}/FormgenEBTKE/AJAXHandler/htmlAjaxPengesahanIzin.jsp";
$config['form_data'] = "{$external_url}/FormgenEBTKE/ws_formData.jsp";
$config['view_data'] = "{$external_url}/FormgenEBTKE/ws_viewData.jsp"; // TODO: Ask this. @Step 4 Eval. DONE.
$config['view_pdf'] = "{$external_url}/FormgenEBTKE/ws_viewPDF.jsp";
$config['form_layout'] = "{$external_url}/FormgenEBTKE/ws_formLayout.jsp";

$config['izin_pdf'] = "http://formgen-ebtke.dev.esdm.go.id/FormgenEBTKE/";

$config['enkriptor_location'] = "FILE_UPLOAD/EnkriptorMain.jar";