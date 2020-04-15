<?php
session_start();

require_once '../../model/treatments.class.php';
require_once '../../model/cis_bdpm.class.php';
require_once '../function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');


if(isset($_POST['ttag'])){
	$bddtreat = new ManagementBddTreatments($database);
	$treat = new Treatments($database);
	$bddcis = new ManagementBddCisBdpm($database);
	
	$nom = $_POST['tnom'];
	$cis = $bddcis->select_cis_by_cisname($nom);
	$dates = formatDate($_POST['tdated']);
	$datee = formatDate($_POST['tdatef']);
	$prise = $_POST['tnbjour'];
	$val = calculNbPrise($dates,$datee,$prise);
	
	$array_treat = array(
		"t_aid" => $_POST['taid'],
		"t_tag" => $_POST['ttag'],
		"t_cis" => $cis[0]['cis_cis'],
		"t_start_date" => $dates,
		"t_end_date" => $datee,
		"t_quantity" => $_POST['tquan'],
		"t_number_day" => $prise,
		"t_time" => $_POST['ttime'],
		"t_validate" => $val,
		"t_del" => 0,
	);
	
	$treat->hydrate($array_treat);
	$bddtreat->add_treatment($treat);
	
	echo "Votre nouveau traitement a bien été ajouté !";
}
else {
	echo "Une erreur est survenue.";
}
?>