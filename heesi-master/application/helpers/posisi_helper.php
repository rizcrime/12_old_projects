<?php
	function Posisi($posisi){
		if ($posisi == 'KEBERANGKATAN_TANAH_AIR') {
			$posisi = 'Berangkat Tanah Air';
		}elseif($posisi == 'KEDATANGAN_MEKKAH'){
			$posisi = 'Mekkah';
		}elseif($posisi == 'KEDATANGAN_MADINAH'){
			$posisi = 'Madinah';
		}elseif($posisi == 'KEDATANGAN_JEDDAH'){
			$posisi = 'Jeddah';
		}elseif($posisi == 'TARWIYAH'){
			$posisi = 'Tarwiyah';
		}elseif($posisi == 'KEDATANGAN_ARAFAH'){
			$posisi = 'Kedatangan Arafah';
		}elseif($posisi == 'KEPULANGAN_MINA'){
			$posisi = 'Kepulangan Mina';
		}elseif($posisi == 'KEPULANGAN_ARAB_SAUDI'){
			$posisi = 'Pulang Arab Saudi';
		}elseif($posisi == 'KEDATANGAN_TANAH_AIR'){
			$posisi = 'Pulang Tanah Air';
		}elseif($posisi == 'HOTEL_TRANSIT_MEKKAH'){
			$posisi = 'Hotel Transit';
		}

		return $posisi;
	}
?>