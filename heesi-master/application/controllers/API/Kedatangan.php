<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Kedatangan extends REST_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->load->model('Dashboard/m_pramanifest');
		$this->load->model('Dashboard/M_aktual');
	}

    public function jamaah_mekkah_get() {
        $this->get_jamaah_list(FlowType::KEDATANGAN_MEKKAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_madinah_get() {
        $this->get_jamaah_list(FlowType::KEDATANGAN_MADINAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_jeddah_get() {
        $this->get_jamaah_list(FlowType::KEDATANGAN_JEDDAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }
    
    public function data_rencana_jamaah_kepulangan_get() {
        $this->get_jamaah_list(FlowType::KEPULANGAN_ARAB_SAUDI, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_kedatangan_tanah_air_get() {
        $this->get_jamaah_list(FlowType::KEDATANGAN_TANAH_AIR, FlowType::KEPULANGAN_ARAB_SAUDI);
    }

    public function jamaah_tarwiyah_get() {
        $this->get_jamaah_list(FlowType::TARWIYAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_kedatangan_arafah_get() {
        $this->get_jamaah_list(FlowType::KEDATANGAN_ARAFAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_kepulangan_mina_get() {
        $this->get_jamaah_list(FlowType::KEPULANGAN_MINA, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function jamaah_hotel_transit_mekkah_get() {
        $this->get_jamaah_list(FlowType::HOTEL_TRANSIT_MEKKAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_mekkah_post() {
        $this->insert_data_kedatangan(FlowType::KEDATANGAN_MEKKAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_madinah_post() {
        $this->insert_data_kedatangan(FlowType::KEDATANGAN_MADINAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_jeddah_post() {
        $this->insert_data_kedatangan(FlowType::KEDATANGAN_JEDDAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_kepulangan_post() {
        $this->insert_data_kedatangan(FlowType::KEPULANGAN_ARAB_SAUDI, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_kedatangan_tanah_air_post() {
        $this->insert_data_kedatangan(FlowType::KEDATANGAN_TANAH_AIR, FlowType::KEPULANGAN_ARAB_SAUDI);
    }

    public function update_aktual_tarwiyah_post() {
        $this->insert_data_kedatangan(FlowType::TARWIYAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_kedatangan_arafah_post() {
        $this->insert_data_kedatangan(FlowType::KEDATANGAN_ARAFAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_aktual_kepulangan_mina_post() {
        $this->insert_data_kedatangan(FlowType::KEPULANGAN_MINA, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    public function update_hotel_transit_mekkah_post() {
        $this->insert_data_kedatangan(FlowType::HOTEL_TRANSIT_MEKKAH, FlowType::KEBERANGKATAN_TANAH_AIR);
    }

    private function get_jamaah_list($current_flow, $sumber_flow) {
        $kd_paket = $this->get("kd_paket");
        $keberangkatan_ke = $this->get("keberangkatan_ke");

        $data_pramanifest = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();
        $data_aktual = $this->M_aktual->get_aktual_data_for_flow($kd_paket, $keberangkatan_ke, $current_flow);

        $aktual_data_exist = !empty($data_aktual);
        $jamaah_sumber_flow = ($aktual_data_exist ? $current_flow : $sumber_flow);
        $data_jamaah = $this->M_aktual->get_jamaah_berangkat_aktual($kd_paket, $keberangkatan_ke, $jamaah_sumber_flow, $aktual_data_exist);

        $result = new stdClass();
        $result->data_pramanifest = $data_pramanifest;
        $result->data_aktual = $data_aktual; // If this empty then no aktual data exist
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

    private function insert_data_kedatangan($jenis_flow, $sumber_flow) {
        if($this->is_allowed_to_submit($jenis_flow) === FALSE) {
            $this->response(array(
                'message' => "Tidak dalam masa submit!",
                'status' => FALSE,
            ), 400);
            return;
        };

        $kd_paket = $this->post("kd_paket");
        $keberangkatan_ke = $this->post("keberangkatan_ke");

        $kd_pra_manifest     = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row()->kd_pra_manifest;


        // $data_aktual = $this->m_pramanifest->GetAktual($kd_pra_manifest);
        $data_aktual = $this->M_aktual->get_aktual_data_for_flow($kd_paket, $keberangkatan_ke, $jenis_flow);

        $tgl_aktual	         = $this->post("tgl_aktual");
        $waktu_aktual		 = $this->post("waktu_aktual");
        $nm_airline_aktual	 = $this->post("nm_airline_aktual");
        $no_flight_aktual 	 = $this->post("no_flight_aktual");
        $jenis               = $jenis_flow;
        $bandara_transit	 = $this->post("bandara_brkt");
        $bandara_transit     = empty($bandara_transit) ? NULL : $bandara_transit;
        $hotel_aktual	     = $this->post("hotel");

        $list_jamaah_tidak_hadir = $this->post("jamaah_tidak_hadir");
        $list_jamaah_tidak_hadir = empty($list_jamaah_tidak_hadir) ? array() : $list_jamaah_tidak_hadir;

        $insert_result = $this->M_aktual->insert_aktual_kedatangan(
            $kd_pra_manifest,
            $tgl_aktual,
            $waktu_aktual,
            $nm_airline_aktual,
            $no_flight_aktual,
            $jenis,
            $bandara_transit,
            $hotel_aktual,
            $kd_paket,
            $keberangkatan_ke,
            $list_jamaah_tidak_hadir,
            $sumber_flow
        );

        if($insert_result === FALSE) {
            $this->response(array(
                'message'   => "Input data gagal!",
                'status'    => FALSE
            ), 400);
        } else {
            $this->M_aktual->update_data_posisi_pramanifest($kd_pra_manifest, $jenis_flow);

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
}