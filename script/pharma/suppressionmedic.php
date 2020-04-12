<?php

require_once '../../model/storages.class.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['ids'])){
	$ids = $_POST['ids'];
	$tableStorage = new ManagementBddStorages($database);

	$verif = $tableStorage->delete_storage_with_sid($ids);
	
	echo "Ce médicament a bien été supprimé de votre pharmacie.";
}
else {
	echo "Une erreur est survenue.";
}
?>
