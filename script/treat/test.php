<?php
require_once "../function.php";

$localtime = getTime();
	var_dump($localtime);
	$time2 = "20:00 21:50 01:30";
	$test234 = captureTime($time2);
	var_dump($test234);
	
	$start1 = gmdate("H:i", strtotime("20:00") - strtotime($localtime));
	$start2 = gmdate("H:i", strtotime("24:00") - strtotime($localtime));
	$start3 = gmdate("H:i",strtotime($start2)-strtotime($start1));
		var_dump($start1);
		var_dump($start2);
		var_dump($start3);
		
		if(strtotime($start2) >= strtotime($start3)){
			echo "TODAY";
		}
		else{
			echo "DEMAIN";
		}
	
	/*foreach($test234[0] as $test123){
		$start = gmdate("H:i", strtotime($test123)-strtotime($localtime));
		var_dump($start);
		if($test123 <= $localtime){
			echo "FALLAIT LE PRENDRE T'AS DU RETARD.";
		}
		else {
			echo "IL FAUDRA PRENDRE LE MEDOC DANS H.";
		}
	}*/
?>