<?php
// EMAIL
function isValidEmail($email) {
    if(preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i", $email)) {
        return true;
    } else {
        return false;
    }
}

// DATES
function formatDate($date){
	$date1 = substr($date,6,4);
	$date1 .= "-".substr($date,3,2);
	$date1 .= "-".substr($date,0,2);
	return $date1;
}

function formatDateFR($date){
	$date1 = substr($date,8,2);
	$date1 .= "/".substr($date,5,2);
	$date1 .= "/".substr($date,0,4);
	return $date1;
}

function calculNbPrise($date1,$date2,$prise){
	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
	$ret = $date1->diff($date2);
	$ret2 = $ret->format('%R%a');
	$ret3 = substr($ret2,1);
	$ret4 = $ret3 * $prise;
	return $ret4;
}

function diffDate($date1,$date2){
	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
	$ret = $date1->diff($date2);
	$ret2 = $ret->format('%R%a days');
	$ret3 = substr($ret2,0,1);
	if($ret3 == "+"){ // si date1 est antérieure à date2
		return true;
	}
	else {
		return false;
	}
}

function getTime(){
	date_default_timezone_set('Europe/Paris');
	$date = date_create();
	$time = $date->format('H:i');
	return $time;
}

function captureTime($time) {
	$matches;
    if(preg_match_all("/([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/", $time, $matches,PREG_PATTERN_ORDER)) {
		return $matches;
    } else {
        return false;
    }
}

function whenTime($time , $localtime){
	$start1 = gmdate("H:i", strtotime($time) - strtotime($localtime));
	$start2 = gmdate("H:i", strtotime("24:00") - strtotime($localtime));
	$start3 = gmdate("H:i",strtotime($start2) - strtotime($start1));
	
	if(strtotime($start2) >= strtotime($start3)){
		return "TODAY";
	}
	else{
		return "DEMAIN";
	}
}

function calculRappel($str,$date,$bddate){
	$ret = substr($str,6);
	$test = substr($str,0,3);
	
	
	$ret1 = preg_split("/( - )/",$ret);
	$t;
	$d;
	$date1 = strtotime($date);
	foreach($ret1 as $row){
		$t = substr($row,-1);
		$d = substr($row,0,2);
		if($t == "a"){
			$ds = "+".$d." years";
			$newdate = strtotime($ds, $date1);
			echo date('d-m-Y', $newdate). PHP_EOL;
		}
		else {
			$ds = "+".$d." months";
			$newdate = strtotime($ds, $date1);
			echo date('d-m-Y', $newdate). PHP_EOL;
		}
	}
}
?>