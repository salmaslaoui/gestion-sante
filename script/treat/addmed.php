<?php
session_start();

require_once '../../model/treatments.class.php';
require_once '../../model/cis_bdpm.class.php';
require_once '../function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');


if(isset($_POST['maid'])){
	$bddtreat = new ManagementBddTreatments($database);
	$treat = new Treatments($database);
	$bddcis = new ManagementBddCisBdpm($database);
	
	$nom = $_POST['mnom'];
	$cis = $bddcis->select_cis_by_cisname($nom);
	$dates = formatDate($_POST['mdated']);
	$datee = formatDate($_POST['mdatef']);
	$prise = $_POST['mnbjour'];
	$val = calculNbPrise($dates,$datee,$prise);
	
	$array_treat = array(
		"t_aid" => $_POST['maid'],
		"t_tag" => $_POST['mtag'],
		"t_cis" => $cis[0]['cis_cis'],
		"t_start_date" => $dates,
		"t_end_date" => $datee,
		"t_quantity" => $_POST['mquan'],
		"t_number_day" => $prise,
		"t_time" => $_POST['mtime'],
		"t_validate" => $val,
		"t_del" => 0,
	);
	
	$treat->hydrate($array_treat);
	$bddtreat->add_treatment($treat);
	
	echo "Le médicament ", $nom ," a bien été ajouté au traitement ", $_POST['mtag'],"!";
}
else {
	echo "Une erreur est survenue.";
}
?>