<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/accounts.class.php';

if(isset($_POST['prise'])){
	$tid = $_POST['tpid'];
	$prise = $_POST['prise'];
	
	// Faire un preg split de tid et récup un ou plusieurs id --> array
	// Foreach array id récupéré :
		// Faire les méthodes de décrémenter t_validate dans la bdd
		// Décrémenter dans Storage
		// Retourner une erreur ou pas
		// Modifier le $GLOBAL des validate ?? 
	
	echo "KOUKOU ON A BIEN LES INFOS DANS PRISE : LE STATUT EST", $_POST['prise'];
}
else {
	echo "Une erreur est survenue.";
}
?>