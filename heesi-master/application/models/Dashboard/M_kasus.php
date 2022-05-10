<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kasus extends CI_Model {
    public function input_data($waktu, $tempat, $kejadian) {
        $new_data = array(
            'waktu'     => $waktu,
            'tempat'    => $tempat,
            'kejadian'  => $kejadian,
        );

        $result =  $this->db->insert("t_kasus", $new_data);

        if($result === TRUE) {
            return $this->db->insert_id();
        }

        return FALSE;
    }
}
