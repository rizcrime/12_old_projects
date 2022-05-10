<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
    // Set searchable column fields berangkat
    var $column_search_berangkat = array('a.kd_pihk', 'a.pihk', 'p.kode_paket', 'p.nama_paket', 'm.posisi_sekarang', 'CAST(m.pemberangkatan_ke AS TEXT)');
    
    // Set searchable column fields 
    var $column_search_jamaah = array('pd.kd_porsi', 'pd.nama_jamaah', 'pd.jenis_jamaah', 'pd.nomor_hp' ,'p.posisi_sekarang');

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function GetDataPIHK(){
        $this->db->select('');
        $this->db->from('smpihk');
        $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        return $data = $this->db->get();
    }

    public function GetAllPIHK(){
        $this->db->select('');
        $this->db->from('smpihk');
        return $data = $this->db->get();
    }

    public function GetBerangkat(){
        $this->db->select('ak.kd_aktual, m.kd_pra_manifest, a.kd_pihk, a.pihk, p.kode_paket, p.nama_paket, m.pemberangkatan_ke, m.posisi_sekarang, count(d.kd_aktual) as jumlah');
        $this->db->from('t_pra_manifest m');
        $this->db->join('t_paket_pihk p', 'm.kd_paket = p.kode_paket', '');
        $this->db->join('smpihk a', 'm.kd_pihk = a.kd_pihk');
        $this->db->join('t_aktual ak', 'm.kd_pra_manifest = ak.kd_pra_manifest and m.posisi_sekarang = ak.jenis');
        $this->db->join('t_aktual_detail d', 'd.kd_aktual = ak.kd_aktual');
        $this->db->join('t_pra_manifest_detail pd', 'd.kd_porsi = pd.kd_porsi');
        $this->db->where('m.posisi_sekarang is not null');

        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('ak.kd_aktual, m.kd_pra_manifest, a.kd_pihk, a.pihk, p.kode_paket, p.nama_paket, m.pemberangkatan_ke, m.posisi_sekarang, d.kd_aktual');

        $i = 0;
       
        foreach ($this->column_search_berangkat as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_berangkat) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function GetBerangkatLimit()
    {
        $this->GetBerangkat();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function GetBerangkatCountFiltered()
    {
        $this->GetBerangkat();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function GetBerangkatCountAll()
    {
        $this->db->select('ak.kd_aktual, m.kd_pra_manifest, a.kd_pihk, a.pihk, p.kode_paket, p.nama_paket, m.pemberangkatan_ke, m.posisi_sekarang, count(d.kd_aktual) as jumlah');
        $this->db->from('t_pra_manifest m');
        $this->db->join('t_paket_pihk p', 'm.kd_paket = p.kode_paket', '');
        $this->db->join('smpihk a', 'm.kd_pihk = a.kd_pihk');
        $this->db->join('t_aktual ak', 'm.kd_pra_manifest = ak.kd_pra_manifest and m.posisi_sekarang = ak.jenis');
        $this->db->join('t_aktual_detail d', 'd.kd_aktual = ak.kd_aktual');
        $this->db->join('t_pra_manifest_detail pd', 'd.kd_porsi = pd.kd_porsi');
        $this->db->where('m.posisi_sekarang is not null');
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        $this->db->group_by('ak.kd_aktual, m.kd_pra_manifest, a.kd_pihk, a.pihk, p.kode_paket, p.nama_paket, m.pemberangkatan_ke, m.posisi_sekarang, d.kd_aktual');
        return $this->db->count_all_results();
    }

    public function GetPosisiJamaah(){
        $this->db->select('pd.kd_porsi, pd.nama_jamaah, pd.jenis_jamaah, pd.nomor_hp, p.posisi_sekarang');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang is not null');

        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $i = 0;
       
        foreach ($this->column_search_jamaah as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_jamaah) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function GetPosisiJamaahLimit()
    {
        $this->GetPosisiJamaah();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function GetPosisiJamaahCountFiltered()
    {
        $this->GetPosisiJamaah();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function GetPosisiJamaahCountAll()
    {
        $this->db->select('pd.kd_porsi, pd.nama_jamaah, pd.jenis_jamaah, pd.nomor_hp, p.posisi_sekarang');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang is not null');
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        return $this->db->count_all_results();
    }

    public function GetJamaahBerangkatTanahAir(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEBERANGKATAN_TANAH_AIR);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        return $data = $this->db->get();
    }

    public function GetJamaahMekkah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEDATANGAN_MEKKAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        return $data = $this->db->get();
    }

    public function GetJamaahMadinah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEDATANGAN_MADINAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        return $data = $this->db->get();
    }

    public function GetJamaahJeddah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEDATANGAN_JEDDAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahTarwiyah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::TARWIYAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahArafah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEDATANGAN_ARAFAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahMina(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEPULANGAN_MINA);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahPulangas(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEPULANGAN_ARAB_SAUDI);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahPulang(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::KEDATANGAN_TANAH_AIR);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahHotelTransit(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', 'p.kd_pra_manifest = pd.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', FlowType::HOTEL_TRANSIT_MEKKAH);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahBerangkat(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang IS NOT NULL');
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahBelumBerangkat(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest', 'inner');
        $this->db->where('p.posisi_sekarang', NULL);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }
        
        return $data = $this->db->get();
    }

    public function GetJamaahSakit(){
        $this->db->select('');
        $this->db->from('t_pra_manifest p, t_aktual a, t_aktual_detail d, smpihk s');
        $this->db->where('p.kd_pra_manifest = a.kd_pra_manifest');
        $this->db->where('p.posisi_sekarang = a.jenis');
        $this->db->where('a.kd_aktual = d.kd_aktual');
        $this->db->where('p.posisi_sekarang !=', '');
        $this->db->where('d.status', JamaahStatus::SAKIT);
        $this->db->where('p.kd_pihk = s.kd_pihk');

        return $data = $this->db->get();
    }

    public function GetJamaahWafat(){
        $this->db->select('');
        $this->db->from('t_aktual_detail');
        $this->db->where('status', JamaahStatus::WAFAT);

        return $data = $this->db->get();
    }

    public function GetAllPosisiJamaah(){
        $this->db->select('a.tgl_aktual, d.kd_porsi, d.nama_jamaah, d.jenis_jamaah, p.kd_pihk, s.pihk, a.jenis');
        $this->db->from('t_aktual_detail d, t_aktual a, t_pra_manifest p, smpihk s, t_pra_manifest_detail pd');
        $this->db->where('d.kd_aktual = a.kd_aktual');
        $this->db->where('a.kd_pra_manifest = p.kd_pra_manifest');
        $this->db->where('p.kd_pihk = s.kd_pihk');
        $this->db->where('d.kd_porsi = pd.kd_porsi');
        $this->db->where('p.kd_pihk', $this->input->get('kd_pihk'));

        return $data = $this->db->get();
    }

    public function GetAllJamaahBerangkat(){
        $this->db->select('a.tgl_aktual, d.kd_porsi, d.nama_jamaah, d.jenis_jamaah, p.kd_pihk, s.pihk');
        $this->db->from('t_aktual_detail d, t_aktual a, t_pra_manifest p, smpihk s, t_pra_manifest_detail pd');
        $this->db->where('d.kd_aktual = a.kd_aktual');
        $this->db->where('a.kd_pra_manifest = p.kd_pra_manifest');
        $this->db->where('p.kd_pihk = s.kd_pihk');
        $this->db->where('d.kd_porsi = pd.kd_porsi');
        $this->db->where('a.jenis', 'KEBERANGKATAN_TANAH_AIR');

        return $data = $this->db->get();
    }

    public function getDetailJemaah(){
        $this->db->select('');
        $this->db->from('t_aktual_detail a, t_pra_manifest_detail pd');
        $this->db->where('a.kd_aktual', $this->input->post('kd_aktual'));
        $this->db->where('a.kd_porsi = pd.kd_porsi');

        return $data = $this->db->get();
    }

    public function getDetailJemaahWafat(){
        $this->db->select('');
        $this->db->from('t_aktual_detail a, t_pra_manifest_detail pd, t_pra_manifest p, smpihk s');
        $this->db->where("a.status = 'WAFAT'");
        $this->db->where('a.kd_porsi = pd.kd_porsi');
        $this->db->where('pd.kd_pra_manifest = p.kd_pra_manifest');
        $this->db->where('p.kd_pihk = s.kd_pihk');

        return $data = $this->db->get();
    }

    public function getTibaMadinah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', "pd.kd_pra_manifest = p.kd_pra_manifest
            and p.bandara_tujuan_as = 'MED' and p.posisi_sekarang != 'KEBERANGKATAN_TANAH_AIR' and p.posisi_sekarang IS NOT null", 'inner');

        return $data = $this->db->get();
    }

    public function getTibaJeddah(){
        $this->db->select('count(pd.kd_pra_manifest_detail) as jumlah');
        $this->db->from('t_pra_manifest p');
        $this->db->join('t_pra_manifest_detail pd', "pd.kd_pra_manifest = p.kd_pra_manifest
            and p.bandara_tujuan_as = 'JED' and p.posisi_sekarang != 'KEBERANGKATAN_TANAH_AIR' and p.posisi_sekarang IS NOT null", 'inner');

        return $data = $this->db->get();
    }


}
