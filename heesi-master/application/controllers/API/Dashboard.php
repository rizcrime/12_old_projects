<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Dashboard extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard/M_dashboard_android');
	}

	public function getBerangkat_post()
	{

		$_POST['draw'] = $this->post('draw');
		$_POST['start'] = $this->post('start');
		$_POST['length'] = $this->post('length');
		
		$list = $this->M_dashboard_android->GetBerangkatLimit();
        $data = array();
        foreach ($list as $field) {
        	if ($field->posisi_sekarang == 'KEBERANGKATAN_TANAH_AIR') {
	        	$posisi = 'Berangkat Tanah Air';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MEKKAH'){
	            $posisi = 'Mekkah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MADINAH'){
	            $posisi = 'Madinah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_JEDDAH'){
	            $posisi = 'Jeddah';
	          }elseif($field->posisi_sekarang == 'TARWIYAH'){
	            $posisi = 'Tarwiyah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_ARAFAH'){
	            $posisi = 'Kedatangan Arafah';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_MINA'){
	            $posisi = 'Kepulangan Mina';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_ARAB_SAUDI'){
	            $posisi = 'Pulang Arab Saudi';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_TANAH_AIR'){
	            $posisi = 'Kembali Ke Tanah Air';
	          }elseif($field->posisi_sekarang == 'HOTEL_TRANSIT_MEKKAH'){
	            $posisi = 'Hotel Transit';
	        }
	          
            $row = array();
            $row['kd_pihk'] = $field->kd_pihk;
            $row['pihk'] = $field->pihk;
            $row['kd_paket'] = $field->kode_paket;
            $row['nama_paket'] = $field->nama_paket;
            $row['pemberangkatan_ke'] = $field->pemberangkatan_ke;
            $row['jumlah'] = $field->jumlah;
            $row['posisi'] = $posisi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard_android->GetBerangkatCountAll(),
            "recordsFiltered" => $this->M_dashboard_android->GetBerangkatCountFiltered(),
            "data" => $data,
        );

        $this->response($output);
        // echo json_encode($output);
	}

	public function getPosisiJamaah_post()
	{

		$_POST['draw'] = $this->post('draw');
		$_POST['start'] = $this->post('start');
		$_POST['length'] = $this->post('length');
		
		$list = $this->M_dashboard_android->GetPosisiJamaahLimit();
        $data = array();
        foreach ($list as $field) {
        	if ($field->posisi_sekarang == 'KEBERANGKATAN_TANAH_AIR') {
	        	$posisi = 'Berangkat Tanah Air';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MEKKAH'){
	            $posisi = 'Mekkah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_MADINAH'){
	            $posisi = 'Madinah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_JEDDAH'){
	            $posisi = 'Jeddah';
	          }elseif($field->posisi_sekarang == 'TARWIYAH'){
	            $posisi = 'Tarwiyah';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_ARAFAH'){
	            $posisi = 'Kedatangan Arafah';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_MINA'){
	            $posisi = 'Kepulangan Mina';
	          }elseif($field->posisi_sekarang == 'KEPULANGAN_ARAB_SAUDI'){
	            $posisi = 'Pulang Arab Saudi';
	          }elseif($field->posisi_sekarang == 'KEDATANGAN_TANAH_AIR'){
	            $posisi = 'Kembali Ke Tanah Air';
	          }elseif($field->posisi_sekarang == 'HOTEL_TRANSIT_MEKKAH'){
	            $posisi = 'Hotel Transit';
	        }
	          
            $row = array();
            $row['kd_porsi'] = $field->kd_porsi;
            $row['nama_jamaah'] = $field->nama_jamaah;
            $row['jenis_jamaah'] = $field->jenis_jamaah;
            $row['nomor_hp'] = $field->nomor_hp;
            $row['posisi'] = $posisi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard_android->GetPosisiJamaahCountAll(),
            "recordsFiltered" => $this->M_dashboard_android->GetPosisiJamaahCountFiltered(),
            "data" => $data,
        );
        
        //output dalam format JSON
        // echo json_encode($output);
        $this->response($output);

		// $getPosisiJamaah = $this->M_dashboard_android->GetPosisiJamaah()->result();
		// echo json_encode($getPosisiJamaah);
	}

	public function countBerangkatTanahAir_get()
	{
		$tanah_air = $this->M_dashboard_android->GetJamaahBerangkatTanahAir()->result();
		$this->response($tanah_air);
	}

	public function countMekkah_get()
	{
		$mekkah = $this->M_dashboard_android->GetJamaahMekkah()->result();
		$this->response($mekkah);
	}

	public function countMadinah_get()
	{
		$madinah = $this->M_dashboard_android->GetJamaahMadinah()->result();
		$this->response($madinah);
	}

	public function countJeddah_get()
	{
		$jeddah = $this->M_dashboard_android->GetJamaahJeddah()->result();
		$this->response($jeddah);
	}

	public function countTarwiyah_get()
	{
		$tarwiyah = $this->M_dashboard_android->GetJamaahTarwiyah()->result();
		$this->response($tarwiyah);
	}

	public function countArafah_get()
	{
		$arafah = $this->M_dashboard_android->GetJamaahArafah()->result();
		$this->response($arafah);
	}

	public function countMina_get()
	{
		$mina = $this->M_dashboard_android->GetJamaahMina()->result();
		$this->response($mina);
	}

	public function countPulangas_get()
	{
		$pulangas = $this->M_dashboard_android->GetJamaahPulangas()->result();
		$this->response($pulangas);
	}

	public function countPulang_get()
	{
		$pulang = $this->M_dashboard_android->GetJamaahPulang()->result();
		$this->response($pulang);
	}

	public function countBerangkat_get()
	{
		$berangkat = $this->M_dashboard_android->GetJamaahBerangkat()->result();
		$this->response($berangkat);
	}

	public function countBelumBerangkat_get()
	{
		$belum_berangkat = $this->M_dashboard_android->GetJamaahBelumBerangkat()->result();
		$this->response($belum_berangkat);
	}

	public function countSakit_get()
	{
		$sakit = $this->M_dashboard_android->GetJamaahSakit()->result();
		$this->response($sakit);
	}

	public function countWafat_get()
	{
		$file = "http://10.100.88.123:8095/ws/wft_haji_khusus?tahun=".Hijriah()."";
		$konten = file_get_contents($file);
		$wafat = json_decode($konten);
		$this->response($wafat);
	}

	public function profilPIHK_get()
	{
		$profil = $this->M_dashboard_android->GetDataPIHK()->result();
		$this->response($profil);
	}

	public function getDetailJemaah_get()
	{
		$getDetailJemaah = $this->M_dashboard_android->getDetailJemaah()->result();
		$this->response($getDetailJemaah);
	}

	public function getTibaMadinah_get()
	{
		$getTibaMadinah = $this->M_dashboard_android->getTibaMadinah()->result();
		$this->response($getTibaMadinah);
	}

	public function getTibaJeddah_get()
	{
		$getTibaJeddah = $this->M_dashboard_android->getTibaJeddah()->result();
		$this->response($getTibaJeddah);
	}

	public function getDetailJemaahWafat_get()
	{
		$getDetailJemaahWafat = $this->M_dashboard_android->getDetailJemaahWafat()->result();
		$this->response($getDetailJemaahWafat);
	}

}
