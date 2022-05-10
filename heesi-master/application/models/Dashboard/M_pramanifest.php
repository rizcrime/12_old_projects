<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pramanifest extends CI_Model {


	public function index(){
	}

	public function GetDataPramanifest(){
		$this->db->select('');
		$this->db->from('t_pra_manifest');
		$this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
		return $data = $this->db->get();
	}

    public function GetDataPramanifestAndJumlahAktual(){
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {
            $this->db->select('');
            $this->db->from('t_pra_manifest p, smpihk s');
            $this->db->where('p.kd_pihk = s.kd_pihk');
        }else{
            $this->db->select('');
            $this->db->from('t_pra_manifest');
            $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $data = $this->db->get()->result_array();

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_aktual');
            $this->db->where('kd_pra_manifest', $data[$i]['kd_pra_manifest']);
            $data[$i]['jumlah_aktual'] = $this->db->get()->num_rows();
        }

        return $data;
    }

    public function GetDataPramanifestForFilterData(){
        $this->db->select('m.kd_pra_manifest, a.pihk, m.bandara_brkt, m.posisi_sekarang, count(m.kd_pra_manifest) as jumlah, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.bandara_tujuan_as, p.akomodasi_1, p.akomodasi_2, p.hotel_transit, m.tanggal_pulang_1, m.bandara_pulang, m.waktu_pulang, m.no_flight_pulang, m.bandara_tujuan_pulang');
        $this->db->from('t_pra_manifest m, t_paket_pihk p, smpihk a, t_pra_manifest_detail d');
        $this->db->where('d.kd_pra_manifest = m.kd_pra_manifest');
        $this->db->where('m.kd_paket = p.kode_paket');
        $this->db->where('m.kd_pihk = a.kd_pihk');
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('m.kd_pra_manifest, a.pihk, m.bandara_brkt, m.posisi_sekarang, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.bandara_tujuan_as, p.akomodasi_1, p.akomodasi_2, p.hotel_transit, m.tanggal_pulang_1, m.bandara_pulang, m.waktu_pulang, m.no_flight_pulang, m.bandara_tujuan_pulang');

        $data = $this->db->get()->result_array();

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_aktual');
            $this->db->where('kd_pra_manifest', $data[$i]['kd_pra_manifest']);
            $data[$i]['jumlah_aktual'] = $this->db->get()->num_rows();
        }

        return $data;
    }

    public function GetDataPramanifestAndPaket(){
        $this->db->select('m.kd_pra_manifest, a.kd_pihk, a.pihk, m.kd_paket, m.kd_tahun, m.pemberangkatan_ke, p.jenis_paket, m.posisi_sekarang, count(m.kd_pra_manifest) as jumlah');
        $this->db->from('t_pra_manifest m, t_paket_pihk p, smpihk a, t_pra_manifest_detail d');
        $this->db->where('d.kd_pra_manifest = m.kd_pra_manifest');
        $this->db->where('m.kd_paket = p.kode_paket');
        $this->db->where('m.kd_pihk = a.kd_pihk');
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('m.kd_pra_manifest, a.kd_pihk, a.pihk, m.kd_paket, m.kd_tahun, m.pemberangkatan_ke, p.jenis_paket, m.posisi_sekarang');

        $data = $this->db->get()->result_array();

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_aktual');
            $this->db->where('kd_pra_manifest', $data[$i]['kd_pra_manifest']);
            $data[$i]['jumlah_aktual'] = $this->db->get()->num_rows();
        }

        return $data;
    }

    public function GetPIHKPerDaker(){
        $this->db->select('s.kd_pihk, s.pihk, count(pd.kd_porsi) as jumlah_jemaah');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest and p.posisi_sekarang is not null', 'inner');
        $this->db->join('smpihk s', 'p.kd_pihk = s.kd_pihk', 'inner');

        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('s.kd_pihk, s.pihk');

        return $this->db->get()->result();
    }

    public function GetPIHKPerDakerByDaker($filter, $jenis)
    {
        $this->db->select('s.kd_pihk, s.pihk, count(pd.kd_porsi) as jumlah_jemaah');
        $this->db->from('t_pra_manifest_detail pd');
        $this->db->join('t_pra_manifest p', 'pd.kd_pra_manifest = p.kd_pra_manifest and p.posisi_sekarang is not null', 'inner');
        $this->db->join('smpihk s', 'p.kd_pihk = s.kd_pihk', 'inner');
        if ($jenis == 'KEDATANGAN_MEKKAH') {
           $this->db->where("p.posisi_sekarang = 'KEDATANGAN_MEKKAH' OR p.posisi_sekarang = 'HOTEL_TRANSIT_MEKKAH'");
        }else{
            $this->db->where('p.posisi_sekarang', $jenis);
        }
        $this->db->group_by('s.kd_pihk, s.pihk');

        return $this->db->get()->result();
    }

    public function GetDataPramanifestAndJumlahAktualByTanggalBerangkat($filter, $tanggal)
    {
        $this->db->select('m.kd_pra_manifest, a.pihk, m.bandara_brkt, m.posisi_sekarang, count(m.kd_pra_manifest) as jumlah, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.bandara_tujuan_as, p.akomodasi_1, p.akomodasi_2, p.hotel_transit, m.tanggal_pulang_1, m.bandara_pulang, m.waktu_pulang, m.no_flight_pulang, m.bandara_tujuan_pulang');
        $this->db->from('t_pra_manifest m, t_paket_pihk p, smpihk a, t_pra_manifest_detail d');
        $this->db->where('d.kd_pra_manifest = m.kd_pra_manifest');
        $this->db->where('m.kd_paket = p.kode_paket');
        $this->db->where('m.kd_pihk = a.kd_pihk');
        if ($filter == 'tanggal_pulang') {
            $this->db->where("(m.tanggal_pulang_1 = '".$tanggal."' OR m.tanggal_pulang_2 = '".$tanggal."' OR m.tanggal_pulang_3 = '".$tanggal."')");
        }else{
            $this->db->where('m.'.$filter, $tanggal);
        }

        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('m.kd_pra_manifest, a.pihk, m.bandara_brkt, m.posisi_sekarang, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.bandara_tujuan_as, p.akomodasi_1, p.akomodasi_2, p.hotel_transit, m.tanggal_pulang_1, m.bandara_pulang, m.waktu_pulang, m.no_flight_pulang, m.bandara_tujuan_pulang');

        $data = $this->db->get()->result_array();

        // var_dump($this->db->last_query());die();
        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_aktual');
            $this->db->where('kd_pra_manifest', $data[$i]['kd_pra_manifest']);
            $data[$i]['jumlah_aktual'] = $this->db->get()->num_rows();
        }

        return $data;
    }

    public function GetDataPramanifestAndJumlahAktualByJenisPaket($filter, $jenis_paket)
    {
        $this->db->select('m.kd_pra_manifest, a.kd_pihk, a.pihk, m.kd_paket, m.kd_tahun, m.pemberangkatan_ke, p.jenis_paket, m.posisi_sekarang, count(m.kd_pra_manifest) as jumlah');
        $this->db->from('t_pra_manifest m, t_paket_pihk p, smpihk a, t_pra_manifest_detail d');
        $this->db->where('d.kd_pra_manifest = m.kd_pra_manifest');
        $this->db->where('m.kd_paket = p.kode_paket');
        $this->db->where('m.kd_pihk = a.kd_pihk');
        $this->db->where('p.'.$filter, $jenis_paket);
        if ($this->session->userdata('kd_pihk') == 'monitoring' || $this->session->userdata('kd_pihk') == 'admin' || $this->session->userdata('kd_pihk') == 'super_monitoring') {

        }else{
            $this->db->where('m.kd_pihk', $this->session->userdata('kd_pihk'));
        }

        $this->db->group_by('m.kd_pra_manifest, a.kd_pihk, a.pihk, m.kd_paket, m.kd_tahun, m.pemberangkatan_ke, p.jenis_paket, m.posisi_sekarang');
        
        $data = $this->db->get()->result_array();
        // var_dump($this->db->last_query());die();
        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_aktual');
            $this->db->where('kd_pra_manifest', $data[$i]['kd_pra_manifest']);
            $data[$i]['jumlah_aktual'] = $this->db->get()->num_rows();
        }

        return $data;
    }

	public function GetPramanifestByID($kd_pra_manifest){
		$this->db->select('');
		$this->db->from('t_pra_manifest m, smpihk s');
		$this->db->where('m.kd_pra_manifest', $kd_pra_manifest);
        $this->db->where('m.kd_pihk = s.kd_pihk');
		return $data = $this->db->get();
	}

	public function GetPramanifestdetailByID($kd_pra_manifest){
		$this->db->select('');
		$this->db->from('t_pra_manifest_detail');
		$this->db->where('kd_pra_manifest', $kd_pra_manifest);
		return $data = $this->db->get();
	}

	public function GetPramanifestdetail(){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        return $data = $this->db->get();
    }

    public function GetPramanifestdetailbyidpramanifest(){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pra_manifest', $this->input->post('kd_pra_manifest'));
        return $data = $this->db->get();
    }

    /**
     * @deprecated Don't use this please.
     */
	public function GetPramanifestByIDAndKeberangkatan($kd_pihk, $keberangkatan_ke){
		$this->db->select('*');
		$this->db->from('t_pra_manifest');
		$this->db->where('kd_pihk', $kd_pihk);
		$this->db->where('pemberangkatan_ke', $keberangkatan_ke);

		$data = $this->db->get();
		return $data;
    }
    
    public function GetPramanifestByPaketAndKeberangkatan($kd_paket, $keberangkatan_ke){
		$this->db->select('*, t_pra_manifest.tanggal_berangkat as tanggal_berangkat, t_paket_pihk.tanggal_berangkat as tanggal_berangkat_paket');
        $this->db->from('t_pra_manifest');
        $this->db->join('t_paket_pihk', 't_paket_pihk.kode_paket = t_pra_manifest.kd_paket');
		$this->db->where('t_pra_manifest.kd_paket', $kd_paket);
		$this->db->where('t_pra_manifest.pemberangkatan_ke', $keberangkatan_ke);

		$data = $this->db->get();
		return $data;
	}

	public function GetPramanifestdetailbyexceptingidpramanifest(){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail pd, t_pra_manifest p');
        $this->db->where('pd.kd_pra_manifest = p.kd_pra_manifest');
        $this->db->where('pd.kd_pra_manifest !=', $this->input->post('kd_pra_manifest'));
        $this->db->where('p.kd_pihk', $this->session->userdata('kd_pihk'));
    	return $data = $this->db->get();
	}

	public function GetListJamaahKeberangkatan($kd_paket, $keberangkatan_ke) {
		$this->db->select('t_pra_manifest_detail.*')
		->from('t_pra_manifest')
		->join('t_pra_manifest_detail', 't_pra_manifest.kd_pra_manifest = t_pra_manifest_detail.kd_pra_manifest')
		->where('t_pra_manifest.kd_paket', $kd_paket)
		->where('t_pra_manifest.pemberangkatan_ke', $keberangkatan_ke);

		$data = $this->db->get();
		return $data;
	}

	public function InsertPramanifest(){
        if ($this->input->post('tanggal_pulang_2') != NULL) {
            $tanggal_pulang_2 = $this->input->post('tanggal_pulang_2');
        }else{
            $tanggal_pulang_2  = NULL;
        }

        if ($this->input->post('tanggal_pulang_3') != NULL) {
            $tanggal_pulang_3 = $this->input->post('tanggal_pulang_3');
        }else{
            $tanggal_pulang_3  = NULL;
        }

        $this->db->select('');
        $this->db->from('t_pra_manifest');
        $this->db->where('kd_tahun', $this->input->post('kd_tahun'));
        $this->db->where('kd_pihk', $this->input->post('kd_pihk'));
        $this->db->where('kd_paket', $this->input->post('kd_paket'));
        $this->db->where('pemberangkatan_ke', $this->input->post('pemberangkatan_ke'));
        $hasil = $this->db->get()->num_rows();
        if ($hasil == 0) {
            //Insert Tabel t_pra_manifest
            $data = array(
                'kd_tahun'              => $this->input->post('kd_tahun'),
                'kd_pihk'               => $this->input->post('kd_pihk'),
                'pemberangkatan_ke'     => $this->input->post('pemberangkatan_ke'),
                'kd_paket'              => $this->input->post('kd_paket'),
                'bandara_brkt'          => $this->input->post('bandara_brkt'),
                'bandara_pulang'        => $this->input->post('bandara_pulang'),
                'nm_airline_brkt'       => $this->input->post('nm_airline_brkt'),
                'nm_airline_pulang'     => $this->input->post('nm_airline_pulang'),
                'no_flight_brkt'        => $this->input->post('kode_flight_brkt_kirim').$this->input->post('no_flight_brkt'),
                'no_flight_pulang'      => $this->input->post('kode_flight_pulang_kirim').$this->input->post('no_flight_pulang'),
                'tanggal_berangkat'     => $this->input->post('tanggal_berangkat'),
                'tanggal_pulang_1'      => $this->input->post('tanggal_pulang_1'),
                'tanggal_pulang_2'      => $tanggal_pulang_2,
                'tanggal_pulang_3'      => $tanggal_pulang_3,
                'waktu_berangkat'       => $this->input->post('waktu_berangkat'),
                'waktu_pulang'          => $this->input->post('waktu_pulang'),
                'jenis_penerbangan_brkt'=> $this->input->post('jenis_penerbangan_brkt'),
                'jenis_penerbangan_pulang'=> $this->input->post('jenis_penerbangan_pulang'),
                'bandara_transit_brkt'  => $this->input->post('bandara_transit_brkt'),
                'bandara_transit_pulang'=> $this->input->post('bandara_transit_pulang'),
                'nm_airline_transit_brkt'=> $this->input->post('nm_airline_transit_brkt'),
                'nm_airline_transit_pulang'=> $this->input->post('nm_airline_transit_pulang'),
                'no_flight_transit_brkt'=> $this->input->post('kode_flight_transit_brkt_kirim').$this->input->post('no_flight_transit_brkt'),
                'no_flight_transit_pulang'=> $this->input->post('kode_flight_transit_pulang_kirim').$this->input->post('no_flight_transit_pulang'),
                'bandara_tujuan_as'     => $this->input->post('bandara_tujuan_as'),
                'bandara_tujuan_pulang'     => $this->input->post('bandara_tujuan_pulang')
            );
            $this->db->insert('t_pra_manifest', $data);
            $id = $this->db->insert_id();

            $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."";
            $konten = file_get_contents($file);
            
            $list_jamaah_service = json_decode($konten);

            $list_jemaah = array();
            foreach ($list_jamaah_service as $list_jamaah_service) {
                if (isset($list_jamaah_service->no_paspor)) {
                    $no_paspor = $list_jamaah_service->no_paspor;
                }else{
                    $no_paspor = '';
                }
                $list_jemaah[$list_jamaah_service->kode_porsi]['kode_porsi'] = $list_jamaah_service->kode_porsi;
                $list_jemaah[$list_jamaah_service->kode_porsi]['nama_jamaah'] = $list_jamaah_service->nama_jamaah;
                $list_jemaah[$list_jamaah_service->kode_porsi]['jenis_jemaah'] = $list_jamaah_service->JENIS_JEMAAH;
                $list_jemaah[$list_jamaah_service->kode_porsi]['jenis_kelamin'] = $list_jamaah_service->jenis_kelamin;
                $list_jemaah[$list_jamaah_service->kode_porsi]['nomor_hp'] = $list_jamaah_service->nomor_hp;
                $list_jemaah[$list_jamaah_service->kode_porsi]['j_pendidikan'] = $list_jamaah_service->j_pendidikan;
                $list_jemaah[$list_jamaah_service->kode_porsi]['tgl_lahir'] = $list_jamaah_service->tgl_lahir;
                $list_jemaah[$list_jamaah_service->kode_porsi]['j_pekerjaan'] = $list_jamaah_service->j_pekerjaan;
                $list_jemaah[$list_jamaah_service->kode_porsi]['s_haji'] = $list_jamaah_service->s_haji;
                $list_jemaah[$list_jamaah_service->kode_porsi]['no_paspor'] = $no_paspor;
            }

            //Insert Pra Manifest Detail
            $list_jamaah = $this->input->post('list_jamaah');
            
            foreach ($list_jamaah as $list_jamaah) {
                $data = array(
                    'kd_pra_manifest'   => $id,
                    'kd_porsi'          => $list_jamaah,
                    'nama_jamaah'       => $list_jemaah[$list_jamaah]['nama_jamaah'],
                    'jenis_jamaah'      => $list_jemaah[$list_jamaah]['jenis_jemaah'],
                    'kd_pihk'           => $this->input->post('kd_pihk'),
                    'jenis_kelamin'     => $list_jemaah[$list_jamaah]['jenis_kelamin'],
                    'nomor_hp'          => $list_jemaah[$list_jamaah]['nomor_hp'],
                    'j_pendidikan'      => $list_jemaah[$list_jamaah]['j_pendidikan'],
                    'tgl_lahir'         => $list_jemaah[$list_jamaah]['tgl_lahir'],
                    'j_pekerjaan'       => $list_jemaah[$list_jamaah]['j_pekerjaan'],
                    's_haji'            => $list_jemaah[$list_jamaah]['s_haji'],
                    'no_paspor'         => $list_jemaah[$list_jamaah]['no_paspor']
                    
                    
                );
                $this->db->insert('t_pra_manifest_detail', $data);
            }
        }
    }

    public function EditPramanifest(){
        if ($this->input->post('jenis_penerbangan_brkt') == 'Direct') {
            $bandara_transit_brkt = '';
            $nm_airline_transit_brkt = '';
            $no_flight_transit_brkt = '';
        }else{
            $bandara_transit_brkt = $this->input->post('bandara_transit_brkt');
            $nm_airline_transit_brkt = $this->input->post('nm_airline_transit_brkt');
            $no_flight_transit_brkt = $this->input->post('kode_flight_transit_brkt_kirim').$this->input->post('no_flight_transit_brkt');
        }

        if ($this->input->post('jenis_penerbangan_pulang') == 'Direct') {
            $bandara_transit_pulang = '';
            $nm_airline_transit_pulang = '';
            $no_flight_transit_pulang = '';
        }else{
            $bandara_transit_pulang = $this->input->post('bandara_transit_pulang');
            $nm_airline_transit_pulang = $this->input->post('nm_airline_transit_pulang');
            $no_flight_transit_pulang = $this->input->post('kode_flight_transit_pulang_kirim').$this->input->post('no_flight_transit_pulang');
        }

        if ($this->input->post('tanggal_pulang_2') != NULL) {
            $tanggal_pulang_2 = $this->input->post('tanggal_pulang_2');
        }else{
            $tanggal_pulang_2  = NULL;
        }

        if ($this->input->post('tanggal_pulang_3') != NULL) {
            $tanggal_pulang_3 = $this->input->post('tanggal_pulang_3');
        }else{
            $tanggal_pulang_3  = NULL;
        }

        $data = array(
            'bandara_brkt'          => $this->input->post('bandara_brkt'),
            'bandara_pulang'        => $this->input->post('bandara_pulang'),
            'nm_airline_brkt'       => $this->input->post('nm_airline_brkt'),
            'nm_airline_pulang'     => $this->input->post('nm_airline_pulang'),
            'no_flight_brkt'        => $this->input->post('kode_flight_brkt_kirim').$this->input->post('no_flight_brkt'),
            'no_flight_pulang'      => $this->input->post('kode_flight_pulang_kirim').$this->input->post('no_flight_pulang'),
            'tanggal_berangkat'     => $this->input->post('tanggal_berangkat'),
            'tanggal_pulang_1'      => $this->input->post('tanggal_pulang_1'),
            'tanggal_pulang_2'      => $tanggal_pulang_2,
            'tanggal_pulang_3'      => $tanggal_pulang_3,
            'waktu_berangkat'       => $this->input->post('waktu_berangkat'),
            'waktu_pulang'          => $this->input->post('waktu_pulang'),
            'jenis_penerbangan_brkt'=> $this->input->post('jenis_penerbangan_brkt'),
            'jenis_penerbangan_pulang'=> $this->input->post('jenis_penerbangan_pulang'),
            'bandara_transit_brkt'  => $bandara_transit_brkt,
            'bandara_transit_pulang'=> $bandara_transit_pulang,
            'nm_airline_transit_brkt'=> $nm_airline_transit_brkt,
            'nm_airline_transit_pulang'=> $nm_airline_transit_pulang,
            'no_flight_transit_brkt'=> $no_flight_transit_brkt,
            'no_flight_transit_pulang'=> $no_flight_transit_pulang,
            'bandara_tujuan_as'     => $this->input->post('bandara_tujuan_as'),
            'bandara_tujuan_pulang'     => $this->input->post('bandara_tujuan_pulang')
        );
        $this->db->where('kd_pra_manifest', $this->input->post('kd_pra_manifest'));
        $this->db->update('t_pra_manifest', $data);

        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$this->session->userdata('kd_pihk')."";
        $konten = file_get_contents($file);
        
        $list_jamaah_service = json_decode($konten);

        $list_jemaah = array();
        foreach ($list_jamaah_service as $list_jamaah_service) {
            if (isset($list_jamaah_service->no_paspor)) {
                    $no_paspor = $list_jamaah_service->no_paspor;
                }else{
                    $no_paspor = '';
            }
            $list_jemaah[$list_jamaah_service->kode_porsi]['kode_porsi'] = $list_jamaah_service->kode_porsi;
            $list_jemaah[$list_jamaah_service->kode_porsi]['nama_jamaah'] = $list_jamaah_service->nama_jamaah;
            $list_jemaah[$list_jamaah_service->kode_porsi]['jenis_jemaah'] = $list_jamaah_service->JENIS_JEMAAH;
            $list_jemaah[$list_jamaah_service->kode_porsi]['jenis_kelamin'] = $list_jamaah_service->jenis_kelamin;
            $list_jemaah[$list_jamaah_service->kode_porsi]['nomor_hp'] = $list_jamaah_service->nomor_hp;
            $list_jemaah[$list_jamaah_service->kode_porsi]['j_pendidikan'] = $list_jamaah_service->j_pendidikan;
            $list_jemaah[$list_jamaah_service->kode_porsi]['tgl_lahir'] = $list_jamaah_service->tgl_lahir;
            $list_jemaah[$list_jamaah_service->kode_porsi]['j_pekerjaan'] = $list_jamaah_service->j_pekerjaan;
            $list_jemaah[$list_jamaah_service->kode_porsi]['s_haji'] = $list_jamaah_service->s_haji;
            $list_jemaah[$list_jamaah_service->kode_porsi]['no_paspor'] = $no_paspor;
        }

        //Update Pra Manifest Detail
        $list_jamaah = $this->input->post('list_jamaah');

        foreach ($list_jamaah as $list_jamaah) {
            
            $this->db->select('');
            $this->db->from('t_pra_manifest_detail');
            $this->db->where('kd_porsi', $list_jamaah);
            $hasil = $this->db->get()->num_rows();
            if ($hasil == 0) {
                $data = array(
                    'kd_pra_manifest'   => $this->input->post('kd_pra_manifest'),
                    'kd_porsi'          => $list_jamaah,
                    'nama_jamaah'       => $list_jemaah[$list_jamaah]['nama_jamaah'],
                    'jenis_jamaah'      => $list_jemaah[$list_jamaah]['jenis_jemaah'],
                    'kd_pihk'           => $this->input->post('kd_pihk'),
                    'jenis_kelamin'     => $list_jemaah[$list_jamaah]['jenis_kelamin'],
                    'nomor_hp'          => $list_jemaah[$list_jamaah]['nomor_hp'],
                    'j_pendidikan'      => $list_jemaah[$list_jamaah]['j_pendidikan'],
                    'tgl_lahir'         => $list_jemaah[$list_jamaah]['tgl_lahir'],
                    'j_pekerjaan'       => $list_jemaah[$list_jamaah]['j_pekerjaan'],
                    's_haji'            => $list_jemaah[$list_jamaah]['s_haji'],
                    'no_paspor'         => $list_jemaah[$list_jamaah]['no_paspor']
                );
                $this->db->insert('t_pra_manifest_detail', $data);
            }
        }
    }

    public function DeletePramanifest(){
        $id = $this->input->post('kode_pramanifest');

        $this->db->trans_start();

        $this->db->where('kd_pra_manifest', $id);
        $this->db->delete('t_pra_manifest');

        $this->db->where('kd_pra_manifest', $id);
        $this->db->delete('t_pra_manifest_detail');
        
        $this->db->trans_complete();
    }

    //Untuk ajax Edit Pramanifest jamaah yang didelete dari list
    public function DeleteJamaahList(){
        $kd_porsi = $this->input->post('kd_porsi');
        if ($kd_porsi != null) {
            foreach ($kd_porsi as $kd_porsi) {
                $this->db->where('kd_porsi', $kd_porsi);
                $this->db->delete('t_pra_manifest_detail');
            }
        }
    }

    //Untuk ajax Edit Pramanifest
    public function GetDataPramanifestByPOST(){
        $this->db->select('');
        $this->db->from('t_pra_manifest');
        $this->db->where('kd_pra_manifest', $this->input->post('kode'));
        return $data = $this->db->get();
    }

    public function upload_file_to_database($data){
        if ($data['pramanifest']['jenis_penerbangan'] == "Direct") {
            $bandara_transit = "";
            $nm_airline_transit = "";
            $no_flight_transit = "";
        }else{
            $bandara_transit = $data['pramanifest']['bandara_transit'];
            $nm_airline_transit = $data['pramanifest']['nm_airline_transit'];
            $no_flight_transit = $data['pramanifest']['no_flight_transit'];
        }

        $pramanifest = array(
            'kd_tahun'          => $data['pramanifest']['kd_tahun'],
            'kd_pihk'           => $data['pramanifest']['kd_pihk'],
            'kd_paket'          => $data['pramanifest']['kd_paket'],
            'pemberangkatan_ke' => $data['pramanifest']['pemberangkatan_ke'],
            'bandara_brkt'      => $data['pramanifest']['bandara_brkt'],
            'nm_airline_brkt'   => $data['pramanifest']['nm_airline_brkt'],
            'no_flight_brkt'    => $data['pramanifest']['no_flight_brkt'],
            'jenis_penerbangan' => $data['pramanifest']['jenis_penerbangan'],
            'bandara_transit'   => $bandara_transit,
            'nm_airline_transit'=> $nm_airline_transit,
            'no_flight_transit' => $no_flight_transit,
            'bandara_tujuan_as' => $data['pramanifest']['bandara_tujuan_as'],
            'tanggal_berangkat' => $data['pramanifest']['tanggal_berangkat'],
            'waktu_berangkat'   => $data['pramanifest']['waktu_berangkat'],
            'tanggal_pulang'    => $data['pramanifest']['tanggal_pulang'],
            'waktu_pulang'      => $data['pramanifest']['waktu_pulang'],
            'nm_airline_pulang' => $data['pramanifest']['nm_airline_pulang'],
            'no_flight_pulang'  => $data['pramanifest']['no_flight_pulang']
        );    

        //Cek apakah Kode Paket sudah terdaftar apa belum
        $this->db->select('');
        $this->db->from('t_paket_pihk');
        $this->db->where('kode_paket', strval($data['pramanifest']['kd_paket']));
        $hasil = $this->db->get()->num_rows();
        if ($hasil > 0) {

            //Cek apakah di database datanya sudah ada apa belum
            $this->db->select('');
            $this->db->from('t_pra_manifest');
            $this->db->where('kd_tahun', strval($data['pramanifest']['kd_tahun']));
            $this->db->where('kd_pihk', strval($data['pramanifest']['kd_pihk']));
            $this->db->where('kd_paket', strval($data['pramanifest']['kd_paket']));
            $this->db->where('pemberangkatan_ke', $data['pramanifest']['pemberangkatan_ke']);
            $hasil = $this->db->get()->num_rows();

            //Jika belum ada
            if ($hasil == 0) {
                $this->db->insert('t_pra_manifest', $pramanifest);
                $id = $this->db->insert_id();

                //Insert ke tabel t_pra_manifest_detail
                for ($i=0; $i < count($data['list_jamaah']); $i++) { 
                    $list_jamaah = array(
                        'kd_pra_manifest'    => $id,
                        'kd_porsi'             => $data['list_jamaah'][$i]['kd_porsi'],
                        'nama_jamaah'         => $data['list_jamaah'][$i]['nama_jamaah'],
                        'jenis_jamaah'        => $data['list_jamaah'][$i]['jenis_jamaah'],
                        'kd_pihk'            => $data['pramanifest']['kd_pihk']
                    );

                    //Cek nama jamaah apakah sudah ada di database apa belum
                    $this->db->select('');
                    $this->db->from('t_pra_manifest_detail');
                    $this->db->where('kd_porsi', strval($data['list_jamaah'][$i]['kd_porsi']));
                    $hasil = $this->db->get()->num_rows();

                    if ($hasil == 0) {
                        //Cek apakah nama tersebut termasuk kedalam pihk
                        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$data['pramanifest']['kd_pihk']."&status_lunas=1";
                        $konten = file_get_contents($file);
                        $data_service = json_decode($konten);
                        for ($z=0; $z < count($data_service); $z++) { 
                            if ($data['list_jamaah'][$i]['kd_porsi'] == $data_service[$z]->kode_porsi) {
                                $this->db->insert('t_pra_manifest_detail', $list_jamaah);
                            }
                        }
                    }else{
                        $this->db->where('kd_porsi', $data['list_jamaah'][$i]['kd_porsi']);
                        $this->db->update('t_pra_manifest_detail', $list_jamaah);
                    }
                }
            //Jika sudah ada    
            }else{
                $this->db->where('kd_tahun', strval($data['pramanifest']['kd_tahun']));
                $this->db->where('kd_pihk', strval($data['pramanifest']['kd_pihk']));
                $this->db->where('kd_paket', strval($data['pramanifest']['kd_paket']));
                $this->db->where('pemberangkatan_ke', $data['pramanifest']['pemberangkatan_ke']);
                $this->db->update('t_pra_manifest', $pramanifest);

                //Mengambil id yang terakhir diupdate
                $this->db->select('');
                $this->db->from('t_pra_manifest');
                $this->db->where('kd_tahun', strval($data['pramanifest']['kd_tahun']));
                $this->db->where('kd_pihk', strval($data['pramanifest']['kd_pihk']));
                $this->db->where('kd_paket', strval($data['pramanifest']['kd_paket']));
                $this->db->where('pemberangkatan_ke', $data['pramanifest']['pemberangkatan_ke']);
                $this->db->limit(1);
                $id_pra_manifest = $this->db->get()->result_array();

                //Jika sudah ada, data jamaah di delete dulu berdasarkan kd_pra_manifest
                $this->db->where('kd_pra_manifest', $id_pra_manifest[0]['kd_pra_manifest']);
                $this->db->delete('t_pra_manifest_detail');

                for ($i=0; $i < count($data['list_jamaah']); $i++) { 
                    $list_jamaah = array(
                        'kd_pra_manifest'    => $id_pra_manifest[0]['kd_pra_manifest'],
                        'kd_porsi'             => $data['list_jamaah'][$i]['kd_porsi'],
                        'nama_jamaah'         => $data['list_jamaah'][$i]['nama_jamaah'],
                        'jenis_jamaah'        => $data['list_jamaah'][$i]['jenis_jamaah'],
                        'kd_pihk'            => $data['pramanifest']['kd_pihk']
                    );

                    //Cek nama jamaah apakah sudah ada di database apa belum
                    $this->db->select('');
                    $this->db->from('t_pra_manifest_detail');
                    $this->db->where('kd_porsi', strval($data['list_jamaah'][$i]['kd_porsi']));
                    $hasil = $this->db->get()->num_rows();

                    if ($hasil == 0) {
                        //Cek apakah nama tersebut termasuk kedalam pihk
                        $file = "http://10.100.88.123:8095/ws/informasi_lunas_hk?tahun_lunas=".Hijriah()."&pihk=".$data['pramanifest']['kd_pihk']."&status_lunas=1";
                        $konten = file_get_contents($file);
                        $data_service = json_decode($konten);
                        for ($z=0; $z < count($data_service); $z++) { 
                            if ($data['list_jamaah'][$i]['kd_porsi'] == $data_service[$z]->kode_porsi) {
                                $this->db->insert('t_pra_manifest_detail', $list_jamaah);
                            }
                        }
                    }else{
                        $this->db->where('kd_porsi', $data['list_jamaah'][$i]['kd_porsi']);
                        $this->db->update('t_pra_manifest_detail', $list_jamaah);
                    }
                }
            }
        }
    }
    
    public function removeJamaahFromDetailByKodePorsi($kd_pra_manifest, $list_kode_porsi) {
        if(empty($list_kode_porsi)) {
            return TRUE;
        }

        $this->db->where('t_pra_manifest_detail.kd_pra_manifest', $kd_pra_manifest);
        $this->db->where_in('t_pra_manifest_detail.kd_porsi', $list_kode_porsi);
        
        return $this->db->delete('t_pra_manifest_detail');
    }

	public function InsertAktualAndJamaah(
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
	) {
        $list_full_jamaah = $this->m_pramanifest->GetListJamaahKeberangkatan($kd_paket, $keberangkatan_ke)->result();

        if(empty($list_full_jamaah)) {
            return FALSE;
        }
        
		$this->db->trans_start();

		$data_aktual_result = $this->InsertDataAktual(
            $kd_pra_manifest,
            $tgl_aktual,
            $waktu_aktual,
            $nm_airline_aktual,
            $no_flight_aktual,
            $jenis,
            $bandara_brkt,
            $hotel_aktual
		);
		
		if($data_aktual_result === TRUE) {
			$new_kd_aktual = $this->db->insert_id();

			
            $this->InsertJamaahAktualKeberangkatan($new_kd_aktual, $list_jamaah_tidak_hadir, $list_full_jamaah);
        }
        
        // Remove jamaah tidak hadir from manifest if tidak berangkat
        $list_kode_porsi = array();
        foreach($list_jamaah_tidak_hadir as $jamaah_tidak_hadir) {
            $list_kode_porsi[] = $jamaah_tidak_hadir['kd_porsi'];
        }
        $this->removeJamaahFromDetailByKodePorsi($kd_pra_manifest, $list_kode_porsi);

		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE) {
			return $new_kd_aktual;
		}

		return FALSE;
	}

	public function InsertDataAktual(
		$kd_pra_manifest,
		$tgl_aktual,
		$waktu_aktual,
		$nm_airline_aktual,
		$no_flight_aktual,
		$jenis,
        $bandara_brkt,
        $hotel_aktual
	) {
        $tgl_aktual = date("Y-m-d", strtotime($tgl_aktual));

		$data = array(
			'kd_pra_manifest'	 => $kd_pra_manifest,
			'tgl_aktual'		 => $tgl_aktual,
			'waktu_aktual'		 => $waktu_aktual,
			'nm_airline_aktual'	 => $nm_airline_aktual,
			'no_flight_aktual' 	 => $no_flight_aktual,
			'jenis'	 			 => $jenis,
			'bandara_aktual'	 => $bandara_brkt,
			'hotel_aktual'	     => $hotel_aktual,
		);

		return $this->db->insert('t_aktual', $data);
	}

	public function InsertJamaahAktualKeberangkatan($kd_aktual, $list_jamaah_tidak_hadir, $list_full_jamaah) {
		$list_check_jamaah_tidak_hadir = array();

		foreach($list_jamaah_tidak_hadir as $jamaah_tidak_hadir) {
			$list_check_jamaah_tidak_hadir[$jamaah_tidak_hadir['kd_porsi']]['status'] = $jamaah_tidak_hadir['status'];
		}

		foreach($list_full_jamaah as $data_jamaah) {
			if(isset($list_check_jamaah_tidak_hadir[$data_jamaah->kd_porsi])) {
				$data_jamaah->status = strtoupper($list_check_jamaah_tidak_hadir[$data_jamaah->kd_porsi]['status']);
			} else {
				$data_jamaah->status = JamaahStatus::BERANGKAT;
			}
		}

		$aktual_detail = array();

		foreach($list_full_jamaah as $data_jamaah) {
			$new_aktual_detail = array(
				'kd_aktual' => $kd_aktual,
				'kd_porsi' => $data_jamaah->kd_porsi,
				'nama_jamaah' => $data_jamaah->nama_jamaah,
				'jenis_jamaah' => $data_jamaah->jenis_jamaah,
				'status' => $data_jamaah->status,
			);

			$aktual_detail[] = $new_aktual_detail;
		}

		return $this->db->insert_batch('t_aktual_detail', $aktual_detail);
	}

    public function GetDataPIHK(){
        $this->db->select('');
        $this->db->from('smpihk');
        $this->db->where('kd_pihk', $this->session->userdata('kd_pihk'));
        return $data = $this->db->get();
    }

    public function GetPengurusFromPramanifestdetail($kd_pra_manifest){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pra_manifest', $kd_pra_manifest);
        $this->db->where('jenis_jamaah', 'PENGURUS');
        return $data = $this->db->get();
    }

    public function GetPembimbingFromPramanifestdetail($kd_pra_manifest){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pra_manifest', $kd_pra_manifest);
        $this->db->where('jenis_jamaah', 'PEMBIMBING');
        return $data = $this->db->get();
    }

    public function GetKesehatanFromPramanifestdetail($kd_pra_manifest){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pra_manifest', $kd_pra_manifest);
        $this->db->where('jenis_jamaah', 'KESEHATAN');
        return $data = $this->db->get();
    }

    public function GetKodeAirline(){
        $this->db->select('noid');
        $this->db->from('msconfig');
        $this->db->where('description', $this->input->post('nama_airline'));
        return $data = $this->db->get();
    }

    public function GetAktual($kd_pra_manifest) {
        $data = $this->db->select("kd_aktual")
        ->from("t_aktual")
        ->where("kd_pra_manifest", $kd_pra_manifest)
        ->order_by("kd_aktual", "DESC") // backward compatibility, get the latest
        ->get();

        return $data->row();
    }

    public function DeleteAktualWithDetail($kd_aktual) {
        $this->db->trans_start();

        $this->db->where("kd_aktual", $kd_aktual);
        $this->db->delete("t_aktual");

        $this->db->where("kd_aktual", $kd_aktual);
        $this->db->delete("t_aktual_detail");

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    
    public function GetDataPaketAndKeberangkatan(){
        $this->db->select('*');
        $this->db->from('t_pra_manifest');
        $this->db->join('t_paket_pihk', 't_paket_pihk.kode_paket = t_pra_manifest.kd_paket');
        $this->db->where('t_pra_manifest.kd_paket', $this->input->post('kd_paket'));
        $data = $this->db->get();
        return $data;
    }

    public function GetDataPramanifestForExport(){
        $this->db->select('m.kd_pihk, s.pihk, m.kd_tahun, m.pemberangkatan_ke, m.bandara_brkt, m.nm_airline_brkt, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.jenis_penerbangan_brkt, m.bandara_transit_brkt, m.nm_airline_transit_brkt, m.no_flight_transit_brkt, m.bandara_tujuan_as, m.bandara_pulang, m.nm_airline_pulang, m.no_flight_pulang, m.tanggal_pulang_1, m.tanggal_pulang_2, m.tanggal_pulang_3, m.waktu_pulang, m.jenis_penerbangan_pulang, m.bandara_transit_pulang, m.nm_airline_transit_pulang, m.no_flight_transit_pulang, m.bandara_tujuan_pulang, count(d.kd_pra_manifest) as jumlah');
        $this->db->from('t_pra_manifest m, smpihk s, t_pra_manifest_detail d');
        $this->db->where('m.kd_pihk = s.kd_pihk');
        $this->db->where('d.kd_pra_manifest = m.kd_pra_manifest');
        $this->db->group_by('m.kd_pihk, s.pihk, m.kd_tahun, m.pemberangkatan_ke, m.bandara_brkt, m.nm_airline_brkt, m.no_flight_brkt, m.tanggal_berangkat, m.waktu_berangkat, m.jenis_penerbangan_brkt, m.bandara_transit_brkt, m.nm_airline_transit_brkt, m.no_flight_transit_brkt, m.bandara_tujuan_as, m.bandara_pulang, m.nm_airline_pulang, m.no_flight_pulang, m.tanggal_pulang_1, m.tanggal_pulang_2, m.tanggal_pulang_3, m.waktu_pulang, m.jenis_penerbangan_pulang, m.bandara_transit_pulang, m.nm_airline_transit_pulang, m.no_flight_transit_pulang, m.bandara_tujuan_pulang, d.kd_pra_manifest');

        return $data = $this->db->get();
    }

    public function GetCountPIHKByPramanifest(){
        $this->db->select('kd_pihk');
        $this->db->from('t_pra_manifest');
        $this->db->group_by('kd_pihk');
        return $data = $this->db->get()->num_rows();
    }    

    public function GetAllCountedPIHKByPramanifest(){
        $this->db->select('p.kd_pihk, s.pihk, count(p.kd_pihk)as jumlah');
        $this->db->from('t_pra_manifest p, smpihk s');
        $this->db->where('p.kd_pihk = s.kd_pihk');
        $this->db->group_by('p.kd_pihk, s.pihk');
        return $data = $this->db->get()->result();
    }    

}
