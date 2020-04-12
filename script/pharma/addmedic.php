<?php

require_once '../../model/storages.class.php';
require_once '../../model/cis_bdpm.class.php';
require_once '../../model/cis_cip_bdpm.class.php';
require_once '../function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['cidu'])){
	$cidu = $_POST['cidu'];
	$cnomp = $_POST['cnomp'];
	$cdosp = $_POST['cdosp'];
	$cexp = $_POST['cexp'];
	$cqup = $_POST['cqup'];
	$clotp = $_POST['clotp'];
	$ccipp = $_POST['ccipp'];

	$tableCis = new ManagementBddCisBdpm($database);
	$tableCip = new ManagementBddCisCipBdpm($database);
	$tableSto = new ManagementBddStorages($database);
	$storage = new Storages();
	
	$medic = $tableCis->select_cis_by_cisname($cnomp);
	$verif = $tableCip->select_cis_cip_by_idcis13($ccipp);

	$cexpf = formatDate($cexp);

	if($medic[0]['cis_cis'] == $verif[0]['cis_cip_cis']){
		$array_sto = array(
			"s_uid" => $cidu,
			"s_cis" => $medic[0]['cis_cis'],
			"s_cip" => $ccipp,
			"s_bundle" => $clotp,
			"s_dosage" => $cdosp,
			"s_quantity" => $cqup,
			"s_date" => $cexpf,
		);
		
		$storage->hydrate($array_sto);
		$verif = $tableSto->add_storage($storage);
	}
	else {
		echo "Une erreur du n°CIP 13 est survenue.";
	}
}
else {
	echo "Une erreur est survenue.";
}
?>

