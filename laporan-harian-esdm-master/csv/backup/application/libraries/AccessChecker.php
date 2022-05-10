<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

class AccessChecker {
    function __construct() {
        $this->_ci = &get_instance();
    }

    public function is_valid_access($id_permohonan) {
		$id_perusahaan = $this->_ci->session->userdata['userdata']->ID_PERUSAHAAN;
		$data_permohonan_izin = $this->_ci->M_r_permohonan_izin->select_permohonan_by_id($id_permohonan);

		if($data_permohonan_izin->ID_PERUSAHAAN != $id_perusahaan) {
			// echo "Not yours<br>";
			$this->restirct_access();
		}

		// $id_process = $this->_ci->M_r_permohonan_izin->select_current_perusahaan_proses($id_permohonan);

		// if(is_null($id_process)) {
		// 	// echo "Not in process<br>";
		// 	$this->restirct_access();
		// }

		// $current_process_data = $this->_ci->M_proses_skema->get_by_id_proses($id_process);
		// $controller_handler = explode("/", $current_process_data->CONTROLLER_HANDLER)[0];
		// $current_controller = $this->_ci->uri->segment(1);

		// if($controller_handler != $current_controller) {
		// 	$this->restirct_access();
		// }

		if ($data_permohonan_izin->IS_REQUEST_DOCUMENT != 'Y') {
			$this->restirct_access();
		}
	}

	private function restirct_access() {
		// TODO: Remove Bypass
		http_response_code(403);
		die("Forbidden");
	}
}