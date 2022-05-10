<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_instrumen extends CI_Model {

    public function index(){
    }

    public function GetPIHK()
    {
        $data = $this->db->select("*")
                ->from("smpihk")
                ->get();
        return $data->result();
    }

    public function GetLayanan()
    {
        $data = $this->db->select("JL.*,L.*,LD.*")
                ->from("instrumen_as_judul_layanan JL")
                ->join("instrumen_as_layanan L", "L.instrumen_as_judul_layanan_id = JL.instrumen_as_judul_layanan_id",'left')
                ->join("instrumen_as_layanan_detail LD", "L.instrumen_as_layanan_id = LD.instrumen_as_layanan_id",'right')
                ->order_by("LD.instrumen_as_layanan_detail_id")
                ->get();
        return $data->result();
    }

    public function GetJudulById($id)
    {
        $data = $this->db->select("*")
                ->from("instrumen_as_judul_layanan")
                ->where("instrumen_as_judul_layanan_id", $id)
                ->get();
        return $data->row();
    }

    public function GetLastDetailById($id)
    {
        $data = $this->db->select("*")
                ->limit(1)
                ->from("instrumen_as_detail")
                ->where("instrumen_as_id", $id)
                ->order_by("instrumen_as_detail_id", "desc")
                ->get();
        return $data->row();
    }

    public function input_detail_keterangan_sakit($data)
    {
        $this->db->insert("t_keterangan_jemaah_sakit", $data);
    }
    public function input_detail_keterangan_wafat($data)
    {
        $this->db->insert("t_keterangan_jemaah_wafat", $data);
    }
    public function input_detail_keterangan_tertinggal($data)
    {
        $this->db->insert("t_keterangan_jemaah_tertinggal", $data);
    }
    public function input_instrumen_id($data)
    {
        $this->db->insert("instrumen_as", $data);
        return $this->db->insert_id();
    }

    public function update_instrumen_id($data)
    {
        $this->db->where("instrumen_as_id", $data['instrumen_as_id']);
        unset($data['instrumen_as_id']);
        return $this->db->update("instrumen_as", $data);
    }

    public function update_instrumen_as_detail($data)
    {
        $this->db->where("instrumen_as_detail_id", $data['instrumen_as_detail_id']);
        unset($data['instrumen_as_detail_id']);
        return $this->db->update("instrumen_as_detail", $data);
    }

    public function update_detail_keterangan_sakit($data)
    {
        $this->db->where("instrumen_as_detail_id", $data['instrumen_as_detail_id']);
        unset($data['instrumen_as_detail_id']);
        return $this->db->update("t_keterangan_jemaah_sakit", $data);
    }

    public function update_detail_keterangan_wafat($data)
    {
        $this->db->where("instrumen_as_detail_id", $data['instrumen_as_detail_id']);
        unset($data['instrumen_as_detail_id']);
        return $this->db->update("t_keterangan_jemaah_wafat", $data);
    }
    
    public function update_detail_keterangan_tertinggal($data)
    {
        $this->db->where("instrumen_as_detail_id", $data['instrumen_as_detail_id']);
        unset($data['instrumen_as_detail_id']);
        return $this->db->update("t_keterangan_jemaah_tertinggal", $data);
    }
    
    public function GetDataById($id)
    {
        $data = $this->db->select("ia.*, s.pihk")
                ->from("instrumen_as ia")
                ->join("smpihk s", "s.kd_pihk = ia.kd_pihk")
                ->where("ia.instrumen_as_id", $id)
                ->get();
        return $data->row();
    }

    public function GetAllData()
    {
        $data = $this->db->select("ia.*, s.pihk")
                ->from("instrumen_as ia")
                ->join("smpihk s", "s.kd_pihk = ia.kd_pihk")
                ->get();
        return $data->result();
    }

    public function GetDetailById($id)
    {
        $data = $this->db->select("*")
                ->from("instrumen_as_detail")
                ->where("instrumen_as_id", $id)
                ->order_by("instrumen_as_layanan_detail_id")
                ->get();
        return $data->result();
    }

    public function GetKeteranganSakitById($id)
    {
        $data = $this->db->select("ks.*")
                ->from("t_keterangan_jemaah_sakit ks")
                ->join("instrumen_as_detail as", "as.instrumen_as_detail_id = ks.instrumen_as_detail_id")
                ->where("as.instrumen_as_id", $id)
                ->get();
        return $data->result();
    }

     public function GetKeteranganWafatById($id)
    {
        $data = $this->db->select("ks.*")
                ->from("t_keterangan_jemaah_wafat ks")
                ->join("instrumen_as_detail as", "as.instrumen_as_detail_id = ks.instrumen_as_detail_id")
                ->where("as.instrumen_as_id", $id)
                ->get();
        return $data->result();
    }

    public function GetKeteranganKetinggalById($id)
    {
        $data = $this->db->select("ks.*")
                ->from("t_keterangan_jemaah_tertinggal   ks")
                ->join("instrumen_as_detail as", "as.instrumen_as_detail_id = ks.instrumen_as_detail_id")
                ->where("as.instrumen_as_id", $id)
                ->get();
        return $data->row();
    }

    public function GetDataPaket(){
        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        return $data = $this->db->get();
    }
    public function input_instrumen_as_detail($data)
    {
        $this->db->insert("instrumen_as_detail", $data);
        return $this->db->insert_id();
    }

    public function GetDataPaketAndJumlahPramanifest(){
        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        $data = $this->db->get()->result_array();

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_pra_manifest');
            $this->db->where('kd_paket', $data[$i]['kode_paket']);
            $data[$i]['jumlah_pramanifest'] = $this->db->get()->num_rows();
        }

        return $data;
    }

    public function GetByDataPaket($kode){
        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kode_paket', $kode);
        return $data = $this->db->get();
    }

    public function GetPaketByKodepihk(){
        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kode_paket', $this->input->post('kode'));
        return $data = $this->db->get();
    }

    public function InsertPaket(){
        //Insert Tabel User
        $paket_gen=KodePaket();
        
        $data = array(
            'kode_paket'        => $paket_gen,
            'nama_paket'        => $this->input->post('nama_paket'),
            'kd_pihk'           => $this->session->userdata('kd_pihk'),
            'jenis_paket'       => $this->input->post('jenis_paket'),
            'program_paket'     => $this->input->post('program_paket'),
            'kode_tahun'        => $this->input->post('kode_tahun'),
            //'nama_airline'        => $this->input->post('nama_airline'),
            'hp_petugas_1'      => $this->input->post('hp_petugas_1'),
            'hp_petugas_2'      => $this->input->post('hp_petugas_2'),
            'hp_petugas_3'      => $this->input->post('hp_petugas_3'),
            'akomodasi_1'       => $this->input->post('akomodasi_1'),
            'h_akomodasi_1'     => $this->input->post('h_akomodasi_1'),
            'akomodasi_2'       => $this->input->post('akomodasi_2'),
            'h_akomodasi_2'     => $this->input->post('h_akomodasi_2'),
            'h_akomodasi_8'     => $this->input->post('h_akomodasi_8'),
            'akomodasi_3'       => $this->input->post('akomodasi_3'),
            'h_akomodasi_3'     => $this->input->post('h_akomodasi_3'),
            'tgl_masuk_mekkah'  => $this->input->post('tgl_masuk_mekkah'),
            'tgl_keluar_mekkah' => $this->input->post('tgl_keluar_mekkah'),
            'tgl_masuk_madinah' => $this->input->post('tgl_masuk_madinah'),
            'tgl_keluar_madinah'=> $this->input->post('tgl_keluar_madinah'),
            'tgl_masuk_jeddah'  => $this->input->post('tgl_masuk_jeddah'),
            'tgl_keluar_jeddah' => $this->input->post('tgl_keluar_jeddah'),
            'komsumsi_1'        => $this->input->post('komsumsi_1'),
            'komsumsi_2'        => $this->input->post('komsumsi_2'),
            'komsumsi_3'        => $this->input->post('komsumsi_3'),
            'komsumsi_4'        => $this->input->post('komsumsi_4'),
            'transport'         => $this->input->post('transport'),
            'petugas_as_1'      => $this->input->post('petugas_as_1'),
            'hp_petugas_as_1'   => $this->input->post('hp_petugas_as_1'),
            'petugas_as_2'      => $this->input->post('petugas_as_2'),
            'hp_petugas_as_2'   => $this->input->post('hp_petugas_as_2'),
            'petugas_as_3'      => $this->input->post('petugas_as_3'),
            'hp_petugas_as_3'   => $this->input->post('hp_petugas_as_3'),
            'harga_double'      => $this->input->post('harga_double'),
            'harga_triple'      => $this->input->post('harga_triple'),
            'harga_quadra'      => $this->input->post('harga_quadra'),
            'hotel_transit'     => $this->input->post('hotel_transit'),
            'kapasitas_kamar_transit'   => $this->input->post('kapasitas_kamar_transit'),
            'alamat_hotel_transit'      => $this->input->post('alamat_hotel_transit'),
            'tgl_masuk_transit' => $this->input->post('tgl_masuk_transit'),
            'tgl_keluar_transit'=> $this->input->post('tgl_keluar_transit'),
        );
        $ins = $this->db->insert('t_paket_pihk', $data);


        //Ambil nilai user_id
        // $this->db->select('');
        // $this->db->from('user');
        // $this->db->where('username', $this->input->post('username'));
        // $this->db->where('password', md5($this->input->post('password')));
        // $user_id = $this->db->get()->row_array();

        // //Insert Tabel Role
        // $data = array(
        //  'user_id'            => $user_id['user_id'],
        //  'role'              => $this->input->post('role')
        // );
        // $this->db->insert('role', $data);
    }

    public function EditPaket(){
        $data = array(
            'nama_paket'        => $this->input->post('nama_paket'),
            'kd_pihk'           => $this->session->userdata('kd_pihk'),
            'jenis_paket'       => $this->input->post('jenis_paket'),
            'program_paket'     => $this->input->post('program_paket'),
            'kode_tahun'        => $this->input->post('kode_tahun'),
            //'nama_airline'        => $this->input->post('nama_airline'),
            'hp_petugas_1'      => $this->input->post('hp_petugas_1'),
            'hp_petugas_2'      => $this->input->post('hp_petugas_2'),
            'hp_petugas_3'      => $this->input->post('hp_petugas_3'),
            'akomodasi_1'       => $this->input->post('akomodasi_1'),
            'h_akomodasi_1'     => $this->input->post('h_akomodasi_1'),
            'akomodasi_2'       => $this->input->post('akomodasi_2'),
            'h_akomodasi_2'     => $this->input->post('h_akomodasi_2'),
            'h_akomodasi_8'     => $this->input->post('h_akomodasi_8'),
            'akomodasi_3'       => $this->input->post('akomodasi_3'),
            'h_akomodasi_3'     => $this->input->post('h_akomodasi_3'),
            'tgl_masuk_mekkah'  => $this->input->post('tgl_masuk_mekkah'),
            'tgl_keluar_mekkah' => $this->input->post('tgl_keluar_mekkah'),
            'tgl_masuk_madinah' => $this->input->post('tgl_masuk_madinah'),
            'tgl_keluar_madinah'=> $this->input->post('tgl_keluar_madinah'),
            'tgl_masuk_jeddah'  => $this->input->post('tgl_masuk_jeddah'),
            'tgl_keluar_jeddah' => $this->input->post('tgl_keluar_jeddah'),
            'komsumsi_1'        => $this->input->post('komsumsi_1'),
            'komsumsi_2'        => $this->input->post('komsumsi_2'),
            'komsumsi_3'        => $this->input->post('komsumsi_3'),
            'komsumsi_4'        => $this->input->post('komsumsi_4'),
            'transport'         => $this->input->post('transport'),
            'petugas_as_1'      => $this->input->post('petugas_as_1'),
            'hp_petugas_as_1'   => $this->input->post('hp_petugas_as_1'),
            'petugas_as_2'      => $this->input->post('petugas_as_2'),
            'hp_petugas_as_2'   => $this->input->post('hp_petugas_as_2'),
            'petugas_as_3'      => $this->input->post('petugas_as_3'),
            'hp_petugas_as_3'   => $this->input->post('hp_petugas_as_3'),
            'harga_double'      => $this->input->post('harga_double'),
            'harga_triple'      => $this->input->post('harga_triple'),
            'harga_quadra'      => $this->input->post('harga_quadra'),
            'hotel_transit'     => $this->input->post('hotel_transit'),
            'kapasitas_kamar_transit'   => $this->input->post('kapasitas_kamar_transit'),
            'alamat_hotel_transit'      => $this->input->post('alamat_hotel_transit'),
            'tgl_masuk_transit' => $this->input->post('tgl_masuk_transit'),
            'tgl_keluar_transit'=> $this->input->post('tgl_keluar_transit'),
        );
        $this->db->where('kode_paket', $this->input->post('kode_paket'));
        $this->db->update('t_paket_pihk', $data);
    }

    public function DeletePaket(){
        $c = $this->input->post('kode_paket');

        $this->db->where('kode_paket', $c);
        $this->db->delete('t_paket_pihk');
    }

    public function EksportPaket($kode){

        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kode_paket', $kode);

        return $this->db->get();
    }   
}
