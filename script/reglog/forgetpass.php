<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/users.class.php';

if(isset($_POST['cmail'])){
	$user = new ManagementBddUsers($database);
	
	$cmail = $_POST['cmail'];

	$ret = $user->get_email($cmail);
	// $ret['u_mail'] OU false

	// Faire le PHP mailer + echo de la réponse
	echo "On a bien reçu les informations dans le script !";
}
else {
	echo "Une erreur est survenue.";
}
?>