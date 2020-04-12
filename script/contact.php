<?php
require_once "function.php";

if(isset($_POST['cmail'])){
	$cnom = $_POST['cnom']; 
	$cmail = $_POST['cmail'];
	$csujet = $_POST['csujet'];
	$cmsg = $_POST['cmsg'];


	// Faire le blabla avec PHPMailer + test de la variable $cmail avec la fonction

	// echo la réponse adaptée à afficher dans l'alerte JS en retour de requête
	echo "On a bien reçu les infos dans le script !";
}
else {
	echo "Une erreur est survenue.";
}
?>