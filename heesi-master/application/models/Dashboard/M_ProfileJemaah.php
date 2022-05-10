<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ProfileJemaah extends CI_Model {

  public function get_data_jemaah()
    {
        $kd_pihk = $this->session->userdata('kd_pihk');
        $data = $this->db->select("*")
                ->from("t_pra_manifest_detail")
                ->where("kd_pihk", $kd_pihk)
                ->get();
        return $data->result();
    }
    public function get_data_jemaah_by_id($id)
    {
       $data = $this->db->select("*")
                ->from("t_pra_manifest_detail")
                ->where("kd_pra_manifest_detail", $id)
                ->get();
    return $data->row();
    }
    public function do_update()
    {
        $data = $this->input->post();
        $this->db->where("kd_pra_manifest_detail", $data['kd_pra_manifest_detail']);
        // $this->db->set("nomor_hp",$data['nomor_hp']);
        unset($data['kd_pra_manifest_detail']);
        $this->db->update("t_pra_manifest_detail",$data);
    }
}
