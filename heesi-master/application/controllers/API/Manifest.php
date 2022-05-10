<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Manifest extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->load->model('Dashboard/m_pramanifest');
		$this->load->model('Dashboard/M_aktual');
	}

    public function rencana_get()
    {
        $kd_paket = $this->get("kd_paket");
        $keberangkatan_ke = $this->get("keberangkatan_ke");

        $data_pramanifest = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();

        $this->response($data_pramanifest);
    }

    public function jamaah_keberangkatan_get() {
        $kd_paket = $this->get("kd_paket");
        $keberangkatan_ke = $this->get("keberangkatan_ke");

        $data_jamaah = $this->m_pramanifest->GetListJamaahKeberangkatan($kd_paket, $keberangkatan_ke)->result();

        $this->response($data_jamaah);
    }

    public function rencana_dan_jamaah_get() {
        $kd_paket = $this->get("kd_paket");
        $keberangkatan_ke = $this->get("keberangkatan_ke");

        $data_pramanifest = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();
        $data_jamaah = $this->m_pramanifest->GetListJamaahKeberangkatan($kd_paket, $keberangkatan_ke)->result();

        $result = new stdClass();
        $result->data_pramanifest = $data_pramanifest;
        $result->data_jamaah = $data_jamaah;

        $this->response($result);
    }

    private function is_allowed_to_submit($jenis_flow) {
        $field_data = $this->get_check_field($jenis_flow);
        if($field_data === FALSE) {
            return TRUE;
        }

        $kd_paket = $this->post("kd_paket");
        $keberangkatan_ke = $this->post("keberangkatan_ke");

        $data_pra_manifest     = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();

        if(!is_array($field_data)) {
            $lower_date = $data_pra_manifest->$field_data;
        } else {
            $lower_date = get_min_field($data_pra_manifest, $field_data);
        }

        $current_date = date("Y-m-d", strtotime("+1 days"));

        return ($current_date >= $lower_date);
    }

    private function get_check_field($jenis_flow) {
        return check_have_time_limit($jenis_flow);
    }

    public function aktual_dan_jamaah_keberangkatan_post() {
        if($this->is_allowed_to_submit(FlowType::KEBERANGKATAN_TANAH_AIR) === FALSE) {
            $this->response(array(
                'message' => "Tidak dalam masa submit!",
                'status' => FALSE,
            ), 400);
            return;
        };

        $kd_paket = $this->post("kd_paket");
        $keberangkatan_ke = $this->post("keberangkatan_ke");

        $data_pra_manifest   = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();
        $kd_pra_manifest     = $data_pra_manifest->kd_pra_manifest;

        // $data_aktual = $this->m_pramanifest->GetAktual($kd_pra_manifest);
        $data_aktual = $this->M_aktual->get_aktual_data_for_flow($kd_paket, $keberangkatan_ke, FlowType::KEBERANGKATAN_TANAH_AIR);

        $tgl_aktual	         = $this->post("tgl_aktual");
        $waktu_aktual		 = $this->post("waktu_aktual");
        $nm_airline_aktual	 = $this->post("nm_airline_aktual");
        $no_flight_aktual 	 = $this->post("no_flight_aktual");
        $jenis               = FlowType::KEBERANGKATAN_TANAH_AIR;
        $bandara_brkt	 = $this->post("bandara_brkt");
        $hotel_aktual	 = $this->post("hotel");

        $list_jamaah_tidak_hadir = $this->post("jamaah_tidak_hadir");
        $list_jamaah_tidak_hadir = empty($list_jamaah_tidak_hadir) ? array() : $list_jamaah_tidak_hadir;

        $insert_result = $this->m_pramanifest->InsertAktualAndJamaah(
            $kd_pra_manifest,
            $tgl_aktual,
            $waktu_aktual,
            $nm_airline_aktual,
            $no_flight_aktual,
            $jenis,
            $bandara_brkt,
            $hotel_aktual,
            $kd_paket,
            $keberangkatan_ke,
            $list_jamaah_tidak_hadir
        );

        if($insert_result === FALSE) {
            $this->response(array(
                'message'   => "Input data gagal!",
                'status' => FALSE
            ), 400);
        } else {
            $this->M_aktual->update_data_posisi_pramanifest($kd_pra_manifest, FlowType::KEBERANGKATAN_TANAH_AIR);

            // Already inserted, delete old kd_aktual
            if(!empty($data_aktual)) {

                $delete_result = $this->m_pramanifest->DeleteAktualWithDetail($data_aktual->kd_aktual);

                if($delete_result === FALSE) {
                    $this->response(array(
                        'message' => "Gagal menghapus data lama!",
                        'status' => FALSE,
                    ), 400);
        
                    return;
                }
            }

            $this->response(array(
                'kd_aktual' => $insert_result,
                'new_data' => TRUE,
                'status' => TRUE,
            ));
        }
    }

    public function data_paket_get() {
        $kd_pihk = $this->get("kd_pihk");

        $data_paket = $this->M_aktual->get_list_kode_paket($kd_pihk);

        $this->response($data_paket);
    }

    public function test_input_post() {
        $this->response(array(
            'isi_post' => $this->post()
        ));
    }
}