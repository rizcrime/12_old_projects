<?php
	function Usd($angka){
	
		$hasil_usd = "USD " . number_format($angka,2,',','.');
		return $hasil_usd;
 
	}
?>