<?php

require_once '../../model/inoculations.class.php';
require_once '../../model/vaccines.class.php';
require_once '../function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['cidi'])){
	$cidi = $_POST['cidi'];
	$cdatev = $_POST['cdatev'];
	$cdatef = formatDate($cdatev);

	$tableInocu = new ManagementBddInoculations($database);
	$inocul = new Inoculations();

	$array_ino = array(
		"i_id" => $cidi,
		"i_date" => $cdatef,
	);

	$inocul->hydrate($array_ino);
	$tableInocu->update_inoculation_bis($inocul);

	echo "Le vaccin a bien été modifiée !";
}
else {
	echo "Une erreur est survenue.";
}
?>