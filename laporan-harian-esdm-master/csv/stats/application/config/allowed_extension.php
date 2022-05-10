<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Case sensitive type of allowed extension, that company allowed to upload as a persyaratan file
// Warning: Never add any executable type here e.g.: PHP, EXE, etc...
$config['allowed_extension'] = array("PDF", "PNG", "JPG", "JPEG", "XLS", "XLSX");

// Max size ONLY for any ace file input user interface in BYTES
$config['max_size_ace_file_input'] = 5000000;