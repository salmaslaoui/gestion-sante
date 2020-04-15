<?php
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/inoculations.class.php';
require_once '../../model/vaccines.class.php';
require_once '../../model/accounts.class.php';
require_once '../function.php';

// if(isset($_POST['cida'])){
	$cida = 1;//$_POST['cida'];
	$cnomv = "Grippe";//$_POST['cnomv'];
	$cdatev = "1985-10-01";//$_POST['cdatev'];

	$tableInocu = new ManagementBddInoculations($database);
	$inocul = new Inoculations();
	$tableVaccine = new ManagementBddVaccines($database);
	$tableacc = new ManagementBddAccounts($database);
	
	$bddate = "1985-10-01";//$tableacc->get_birth_day($cida);
	
	$resVaccine = $tableVaccine->select_id_vaccin_with_vac_name($cnomv);
	
	foreach($resVaccine as $res2){
		var_dump($res2);
		$compdate = substr($res2['v_age'],0,2); // AGE EN BDD
		$am = substr($res2['v_age'],2); // A ou M
		
		date_default_timezone_set('Europe/Paris');
		$date = date_create(); // Date actuelle
		$bddate2 = new DateTime($bddate);
		$diff = $date->diff($bddate2);
		$diffa = $diff->format('%Y YEARS'); // Différence date actuelle en année
		$diffm = $diff->format('%M MONTHS'); // Différence mois
		var_dump($diffa);
		var_dump($diffm);
		
		if($diffa == 0 AND $am == "m"){
			echo 'MOIS';// return $res2['v_id'];
		}
		else if($diffa > 0 AND $am == "a"){
			echo "ANS";
			// return $res2['v_id'];
		}
	}
	var_dump($res2['v_id']);
	$cdatef = formatDate($cdatev);

	$array_ino = array(
	  "i_aid" => $cida,
	  "i_vid" => $resVaccine[0]['v_id'],
	  "i_date" => $cdatef,
	);

	/*$inocul->hydrate($array_ino);
	$true = $tableInocu->add_inoculation($inocul);
	
	echo "Votre vaccin a bien été enregistré.";*/
// }
// else {
	// echo "Une erreur est survenue.";
// }
?>