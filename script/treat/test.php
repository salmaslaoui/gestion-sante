<?php
require_once "../function.php";

/*$localtime = getTime();
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
	
	$bddate = "2020-01-01";
	$bddate2 = new DateTime($bddate);
	var_dump($bddate2);
	
	// Découper la data de la BBD
	$str = "15a : 02m";
	$str2 = substr($str, 0,3); // On récupère l'âge
	$str3 = substr($str, 6); // On récupère le truc des rappels
	$am = substr($str,2,1); // On récupère A pour année ou M pour mois pour l'index de définition 
	var_dump($am);
	var_dump($str2);
	$ret1 = preg_split("/( - )/",$str3);
	var_dump($ret1);
	
	// COMPARAISON DATES + RECUPERER LA LIGNE EN BDD CORRESPONDANTE A L'ÂGE
	// Récupérer date locale + date de naissance et faire une diff
	date_default_timezone_set('Europe/Paris');
	$bddate = new DateTime("1950-10-14");
	$date = new DateTime("2020-10-14");
	$ret = $date->diff($bddate);
	var_dump($ret);
	$ret2 = $ret->format('%Y - %M - %D');
	var_dump($ret2);
	// TEST IF A OU M POUR TROUVER LES BONNES VALEURS A COMPARER
	
	// TEST COMPARAISON DE A | M AVEC DATA BDD
	
	// CALCUL DE LA NOUVELLE DATE
	
	
?>