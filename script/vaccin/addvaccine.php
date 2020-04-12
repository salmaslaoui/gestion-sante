<?php
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/inoculations.class.php';
require_once '../../model/vaccines.class.php';
require_once '../function.php';

if(isset($_POST['cida'])){
	$cida = $_POST['cida'];
	$cnomv = $_POST['cnomv'];
	$cdatev = $_POST['cdatev'];

	$tableInocu = new ManagementBddInoculations($database);
	$inocul = new Inoculations();
	$tableVaccine = new ManagementBddVaccines($database);

	$resVaccine = $tableVaccine->select_id_vaccin_with_vac_name($cnomv);

	$cdatef = formatDate($cdatev);

	$array_ino = array(
	  "i_aid" => $cida,
	  "i_vid" => $resVaccine[0]['v_id'],
	  "i_date" => $cdatef,
	);

	$inocul->hydrate($array_ino);
	$true = $tableInocu->add_inoculation($inocul);
	
	echo "Votre vaccin a bien été enregistré.";
}
else {
	echo "Une erreur est survenue.";
}
?>