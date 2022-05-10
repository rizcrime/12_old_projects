<?php
	function Msconfig_generator($noid){
		$ci =& get_instance();
		$ci->db->select('description');
		$ci->db->from('msconfig');
		$ci->db->where('noid', $noid);
		$ci->db->limit(1);
		$result = $ci->db->get()->result_array();
		// $hasil = $result[0];
		return $result[0]['description'];
	}
?>