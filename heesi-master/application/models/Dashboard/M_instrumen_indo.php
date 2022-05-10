<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_instrumen_indo extends CI_Model {

    public function GetAllPertanyaan()
    {
        $data = $this->db->select("*")
                ->from("instrumen_indo_pertanyaan")
                ->order_by("instrumen_indo_pertanyaan_id")
                ->get();
        return $data->result();
    }

    public function GetPIHK()
    {
        $data = $this->db->select("*")
                ->from("smpihk")
                ->get();
        return $data->result();
    }

    public function GetDataBandara($id)
    {
        $data = $this->db->select("*")  
                ->from("msconfig")
                ->where("var_id", $id)
                ->get();
        return $data->result();
    }
    public function input_data_instrumen_indo($data)
    {

        $this->db->insert("instrumen_indo", $data);
        return $this->db->insert_id();
    }

    public function GetDataById($id)
    {
        $data = $this->db->select("IA.*,
                                    IP.*,
                                    KTJBI.jumlah_jemaah_tidak_jadi_berangkat,
                                    KTJBI.alasan,
                                    KRTI.jumlah_jemaah_resiko_tinggi,
                                    KRTI.keterangan_sakit
                                    ")
                ->from("instrumen_indo IA")
                ->join("instrumen_indo_penilaian IP","IA.instrumen_indo_id = IP.instrumen_indo_id",'right')
                ->join("t_keterangan_tidak_jadi_berangkat_indo KTJBI", "KTJBI.instrumen_indo_penilaian_id = IP.instrumen_indo_penilaian_id", "left")
                ->join("t_keterangan_resiko_tinggi_indo KRTI", "KRTI.instrumen_indo_penilaian_id = IP.instrumen_indo_penilaian_id", "left")
                ->where("IA.instrumen_indo_id", $id)
                ->order_by("IP.instrumen_indo_penilaian_id")
                ->get();
        return $data->result();
    }

    public function input_data_instrumen_indo_penilaian($data)
    {
        $this->db->insert("instrumen_indo_penilaian", $data);
        return $this->db->insert_id();
    }

    public function input_tabel_lain($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function GetAllData()
    {
        $data = $this->db->select("ia.*, s.pihk, mc.description as bandara, ms.description as maskapai")
                ->from("instrumen_indo ia")
                ->join("smpihk s", "s.kd_pihk = ia.kode_pihk")
                ->join("msconfig mc", "ia.kode_bandara = mc.noid")
                ->join("msconfig ms", "ia.kode_maskapai = ms.noid")
                ->order_by("ia.instrumen_indo_id","desc")
                ->get();
        return $data->result();
    }
    public function update_data_instrumen_indo($table,$id,$data)
    {
        $this->db->where($id,$data[$id]);
        unset($data[$id]);
        $this->db->update($table,$data);
    }
}
