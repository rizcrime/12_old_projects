<?php
    function Hijriah(){
        $tahun_masehi = getdate();
        $y = $tahun_masehi['year'];
        $m = $tahun_masehi['month'];
        $d = $tahun_masehi['mday'];

        if ($m == "January") {
            $m = 1;
        } elseif ($m == "February") {
            $m = 2;
        } elseif ($m == "March") {
            $m = 3;
        } elseif ($m == "April") {
            $m = 4;
        } elseif ($m == "May") {
            $m = 5;
        } elseif ($m == "June") {
            $m = 6;
        } elseif ($m == "July") {
            $m = 7;
        } elseif ($m == "August") {
            $m = 8;
        } elseif ($m == "September") {
            $m = 9;
        } elseif ($m == "October") {
            $m = 10;
        } elseif ($m == "November") {
            $m = 11;
        } elseif ($m == "December") {
            $m = 12;
        }
        
        $jd = GregoriantoJD($m, $d, $y);
        $l = $jd - 1948440 + 10632;
        $n = (int) (( $l - 1 ) / 10631);
        $l = $l - 10631 * $n + 354;
        $j = ( (int) (( 10985 - $l ) / 5316)) * ( (int) (( 50 * $l) / 17719)) + (
        (int) ( $l / 5670 )) * ( (int) (( 43 * $l ) / 15238 ));
        $l = $l - ( (int) (( 30 - $j ) / 15 )) * ( (int) (( 17719 * $j ) / 50)) - (
        (int) ( $j / 16 )) * ( (int) (( 15238 * $j ) / 43 )) + 29;
        $m = (int) (( 24 * $l ) / 709 );
        $d = $l - (int) (( 709 * $m ) / 24);
        $y = 30 * $n + $j - 30;
         
        $Hijriah = $y;
         
        return $Hijriah;
    }
?>