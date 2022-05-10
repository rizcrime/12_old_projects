<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_informasi extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getDetailJemaah(){
        $this->db->select('');
        $this->db->from('t_pra_manifest_detail');
        $this->db->where('kd_pra_manifest', $this->input->post('kd_pra_manifest'));

        return $data = $this->db->get();
    }


}
