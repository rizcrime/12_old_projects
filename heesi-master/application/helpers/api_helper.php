<?php

class FlowType {
    const KEBERANGKATAN_TANAH_AIR   = "KEBERANGKATAN_TANAH_AIR";
    const KEDATANGAN_MEKKAH         = "KEDATANGAN_MEKKAH";
    const KEDATANGAN_MADINAH        = "KEDATANGAN_MADINAH";
    const KEDATANGAN_JEDDAH         = "KEDATANGAN_JEDDAH";
    const TARWIYAH                  = "TARWIYAH";
    const KEDATANGAN_ARAFAH         = "KEDATANGAN_ARAFAH";
    const KEPULANGAN_MINA           = "KEPULANGAN_MINA";
    const KEPULANGAN_ARAB_SAUDI     = "KEPULANGAN_ARAB_SAUDI";
    const KEDATANGAN_TANAH_AIR      = "KEDATANGAN_TANAH_AIR";
    const HOTEL_TRANSIT_MEKKAH      = "HOTEL_TRANSIT_MEKKAH";
}

class JamaahStatus {
    const BERANGKAT     = "BERANGKAT";
    const SAKIT         = "SAKIT";
    const WAFAT         = "WAFAT";
    // const LAIN_LAIN     = "LAIN_LAIN";
}


function check_have_time_limit($jenis_flow) {
    $have_time_limit = array(
        FlowType::KEBERANGKATAN_TANAH_AIR   => 'tanggal_berangkat',
        FlowType::KEDATANGAN_MEKKAH         => 'tgl_masuk_mekkah',
        FlowType::KEDATANGAN_MADINAH        => 'tgl_masuk_madinah',
        FlowType::KEDATANGAN_JEDDAH         => 'tgl_masuk_jeddah',
        FlowType::HOTEL_TRANSIT_MEKKAH      => 'tgl_masuk_transit',
        FlowType::KEPULANGAN_ARAB_SAUDI     => array('tanggal_pulang_1','tanggal_pulang_2', 'tanggal_pulang_3'),
        FlowType::KEDATANGAN_TANAH_AIR      => array('tanggal_pulang_1','tanggal_pulang_2', 'tanggal_pulang_3'),
    );
    
    $is_exist = array_key_exists($jenis_flow, $have_time_limit);

    if($is_exist === FALSE) {
        return FALSE;
    }

    return $have_time_limit[$jenis_flow];
}

function get_min_field($data_pra_manifest, $check_field = array()) {
    $field_date = array();

    foreach($check_field as $field) {
        $data = $data_pra_manifest->$field;

        if(!is_null($data)) {
            $field_date[] = $data;
        }
    }

    return min($field_date);
}

// class APIValidator {



//     public static function test() {
//         var_dump("Behehe");
//     }

//     public function is_allowed_to_submit($jenis_flow) {
//         if(!$this->is_have_time_limit($jenis_flow)) {
//             return TRUE;
//         }

//         $kd_paket = $this->post("kd_paket");
//         $keberangkatan_ke = $this->post("keberangkatan_ke");

//         $kd_pra_manifest     = $this->m_pramanifest->GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke)->row()->kd_pra_manifest;

//         return FALSE;
//     }

//     public function is_have_time_limit($jenis_flow) {
//         return array_key_exists($jenis_flow);
//     }
// }