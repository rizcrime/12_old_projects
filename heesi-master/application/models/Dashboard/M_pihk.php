<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pihk extends CI_Model {


	public function index(){
	}

	public function GetDataPihk(){
		$this->db->select('');
		$this->db->from('smpihk');
		$data = $this->db->get()->result_array();

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_paket_pihk');
            $this->db->where('kd_pihk', $data[$i]['kd_pihk']);
            $data[$i]['jumlah_paket'] = $this->db->get()->num_rows();
        }

        for ($i=0; $i < count($data); $i++) { 
            $this->db->select('');
            $this->db->from('t_pra_manifest');
            $this->db->where('kd_pihk', $data[$i]['kd_pihk']);
            $data[$i]['jumlah_pramanifest'] = $this->db->get()->num_rows();
        }

        return $data;
	}

    public function GetDataPihkByKode($kd_pihk){
        $this->db->select('');
        $this->db->from('smpihk');
        $this->db->where('kd_pihk', $kd_pihk);

        return $data = $this->db->get();
    }

	public function activate($kd_pihk, $password){
        $data = array(
        	'username'              => 'PIHK'.$kd_pihk,
        	'auth_key'				=> md5($password),
            'kd_pihk'               => $kd_pihk
        );
        $this->db->insert('user', $data);

        $data = array(
            'status'          => 'Aktif'
        );
        $this->db->where('kd_pihk', $kd_pihk);
        $this->db->update('smpihk', $data);

        $this->db->select('');
		$this->db->from('smpihk');
		$this->db->where('kd_pihk', $kd_pihk);
		return $data = $this->db->get()->result_array();
        
    }

    public function non_active($kd_pihk){
        $this->db->where('kd_pihk', $kd_pihk);
        $this->db->delete('user');

        $data = array(
            'status'          => 'Tidak Aktif'
        );
        $this->db->where('kd_pihk', $kd_pihk);
        $this->db->update('smpihk', $data);
    }

    public function EditPihk(){
        $data = array(
            'email'          => $this->input->post('email')
        );
        $this->db->where('kd_pihk', $this->input->post('kd_pihk'));
        $this->db->update('smpihk', $data);
    }

}
