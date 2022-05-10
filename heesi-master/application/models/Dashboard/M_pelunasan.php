<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelunasan extends CI_Model {

	public function index(){
    }

    public function ListJamaahLunas(){
        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."&status_lunas=1";
        $konten = file_get_contents($file);
        $list_lunas = json_decode($konten);

        $list_jamaah = array();
        foreach ($list_lunas as $list_lunas) {
            array_push($list_jamaah, ["kode_porsi" => $list_lunas->kode_porsi, 
                "nama_jamaah" => $list_lunas->nama_jamaah, 
                "jenis_jemaah" => $list_lunas->JENIS_JEMAAH, 
                "jenis_kelamin" => $list_lunas->jenis_kelamin, 
                "nomor_hp" => $list_lunas->nomor_hp, 
                "status" => "Lunas"]);
        }
        return $list_jamaah;
    }

    public function ListJamaahBerhakLunas(){
        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."&status_lunas=0";
        $konten = file_get_contents($file);
        $list_berhak_lunas = json_decode($konten);

        $list_jamaah = array();
        foreach ($list_berhak_lunas as $list_berhak_lunas) {
            array_push($list_jamaah, ["kode_porsi" => $list_berhak_lunas->kode_porsi, 
                "nama_jamaah" => $list_berhak_lunas->nama_jamaah, 
                "jenis_jemaah" => $list_berhak_lunas->JENIS_JEMAAH, 
                "jenis_kelamin" => $list_berhak_lunas->jenis_kelamin, 
                "nomor_hp" => $list_berhak_lunas->nomor_hp, 
                "status" => "Berhak Lunas"]);
        }
        return $list_jamaah;
    }

    public function ListSeluruhJamaah(){
        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."&status_lunas=0";
        $konten = file_get_contents($file);
        $list_berhak_lunas = json_decode($konten);

        $list_jamaah = array();
        foreach ($list_berhak_lunas as $list_berhak_lunas) {
            array_push($list_jamaah, ["kode_porsi" => $list_berhak_lunas->kode_porsi, 
                "nama_jamaah" => $list_berhak_lunas->nama_jamaah, 
                "jenis_jemaah" => $list_berhak_lunas->JENIS_JEMAAH, 
                "jenis_kelamin" => $list_berhak_lunas->jenis_kelamin, 
                "nomor_hp" => $list_berhak_lunas->nomor_hp, 
                "status" => "Berhak Lunas"]);
        }

        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."&status_lunas=1";
        $konten = file_get_contents($file);
        $list_lunas = json_decode($konten);

        foreach ($list_lunas as $list_lunas) {
            array_push($list_jamaah, ["kode_porsi" => $list_lunas->kode_porsi, 
                "nama_jamaah" => $list_lunas->nama_jamaah, 
                "jenis_jemaah" => $list_lunas->JENIS_JEMAAH, 
                "jenis_kelamin" => $list_lunas->jenis_kelamin, 
                "nomor_hp" => $list_lunas->nomor_hp, 
                "status" => "Lunas"]);
        }
        return $list_jamaah;
    }

}
