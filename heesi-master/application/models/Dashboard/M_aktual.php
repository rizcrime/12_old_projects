<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktual extends CI_Model {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Dashboard/m_pramanifest');
    }

    public function get_jamaah_berangkat_aktual($kd_paket, $keberangkatan_ke, $flow_type, $show_non_berangkat = FALSE) {
        $data_aktual = $this->get_aktual_data_for_flow($kd_paket, $keberangkatan_ke, $flow_type);

        if(empty($data_aktual)) {
            return array();
        }

        if($show_non_berangkat === FALSE ) {
            $status_filter = array(JamaahStatus::BERANGKAT);
        } else {
            // $status_filter = array(
            //     JamaahStatus::BERANGKAT,
            //     JamaahStatus::SAKIT,
            //     JamaahStatus::WAFAT,
            // );
            $status_filter = FALSE; // Show all
        }

        $list_jemaah = $this->get_jamaah_data_aktual($data_aktual->kd_aktual, $status_filter);
        
        return $list_jemaah;
    }

    public function get_aktual_data_for_flow($kd_paket, $keberangkatan_ke, $flow_type) {
        $data_pra_manifest = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row();

        if(empty($data_pra_manifest)){
            return NULL;
        }

        $kd_pra_manifest = $data_pra_manifest->kd_pra_manifest;

        $data = $this->db->select("*")
        ->from("t_aktual")
        ->where("kd_pra_manifest", $kd_pra_manifest)
        ->where("jenis", $flow_type)
        ->order_by('kd_aktual', 'DESC') // Just get the latest one
        ->get();

        return $data->row();
    }

    /**
     * @param status_filter FALSE means show All including wafat
     */

    public function get_jamaah_data_aktual($kd_aktual, $status_filter = array(JamaahStatus::BERANGKAT)) {
        //TODO: Please fix, for perfomance reasons.
        $status_wafat = JamaahStatus::WAFAT;
        $list_kd_porsi_wafat = array();
        
        if($status_filter !== FALSE) {
            // Select jamaah pernah wafat
            $this->db->select('t_aktual_detail.kd_porsi')
            ->distinct()
            ->from('t_aktual_detail')
            ->join('t_aktual_detail as WAFAT_CHECK_TABLE', "t_aktual_detail.kd_porsi = WAFAT_CHECK_TABLE.kd_porsi AND WAFAT_CHECK_TABLE.status = '{$status_wafat}'")
            ->where('t_aktual_detail.kd_aktual', $kd_aktual);

            $kd_porsi_wafat = $this->db->get()->result();

            foreach($kd_porsi_wafat as $kd_porsi) {
                $list_kd_porsi_wafat[] = $kd_porsi->kd_porsi;
            }
        }
        
        // Select acual jamaah
        $this->db->select('t_aktual_detail.*')
        ->from('t_aktual_detail')
        ->where('t_aktual_detail.kd_aktual', $kd_aktual)
        ->order_by('t_aktual_detail.nama_jamaah');

        if($status_filter !== FALSE) {
            if(!empty($list_kd_porsi_wafat)) {
                $this->db->where_not_in('t_aktual_detail.kd_porsi', $list_kd_porsi_wafat);
            }
            $this->db->where_in('t_aktual_detail.status', $status_filter);
        }

        // TODO: Handle when in kedatangan Wafat. Done.

        $data = $this->db->get();

		return $data->result();
    }

    public function insert_aktual_kedatangan(
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
        $flow_sumber_jamaah
	) {
        $list_full_jamaah = $this->get_jamaah_berangkat_aktual($kd_paket, $keberangkatan_ke, $flow_sumber_jamaah);

        if(empty($list_full_jamaah)) {
            return FALSE;
        }

		$this->db->trans_start();

		$data_aktual_result = $this->m_pramanifest->InsertDataAktual(
            $kd_pra_manifest,
            $tgl_aktual,
            $waktu_aktual,
            $nm_airline_aktual,
            $no_flight_aktual,
            $jenis,
            $bandara_transit,
            $hotel_aktual
		);
		
		if($data_aktual_result === TRUE) {
            $new_kd_aktual = $this->db->insert_id();
			$this->m_pramanifest->InsertJamaahAktualKeberangkatan($new_kd_aktual, $list_jamaah_tidak_hadir, $list_full_jamaah);            
		}

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE) {
			return $new_kd_aktual;
		}

		return FALSE;
    }
    

    // Random stuff here

    public function get_list_kode_paket($kd_pihk) {
        $data = $this->db->select("*")
        ->from("t_paket_pihk")
        ->where("kd_pihk", $kd_pihk)
        ->get();
        
        return $data->result();
    }

    public function update_data_posisi_pramanifest($kd_pra_manifest, $flow_type) {
        $this->db->set('posisi_sekarang', $flow_type);
        $this->db->where('kd_pra_manifest', $kd_pra_manifest);

        return $this->db->update('t_pra_manifest');
    }

    public function test($isi){
        $data = array(
            'username' => $isi
        );
        $this->db->insert('user', $data);
    }
}
