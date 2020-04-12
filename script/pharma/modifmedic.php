<?php

require_once '../../model/storages.class.php';
require_once '../function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['cidu'])){
	$cidu = $_POST['cidu'];
	$cexp = formatDate($_POST['cexp']);
	$cqup = $_POST['cqup'];
	$clotp = $_POST['clotp'];

	$tableSto = new ManagementBddStorages($database);
	$storage = new Storages();
	$table = "storages";
	
	$ret = $tableSto->select_all_with_id($table,$cidu);

	$array_sto = array(
		"s_id" => $ret[0]['s_id'],
		"s_uid" => $ret[0]['s_uid'],
		"s_cis" => $ret[0]['s_cis'],
		"s_cip" => $ret[0]['s_cip'],
		"s_bundle" => $clotp,
		"s_dosage" => $ret[0]['s_dosage'],
		"s_quantity" => $cqup,
		"s_date" => $cexp,
	);

	$storage->hydrate($array_sto);
	$tableSto->update_storage($storage);
	
	echo "Votre modification a bien été effectuée.";
}
else {
	echo "Une erreur est survenue.";
}
?>
