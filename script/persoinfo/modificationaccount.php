<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/Users.class.php';

if(isset($_POST['cid'])){
	$userModif = new Users();
	$tableUsersAModif = new ManagementBddUsers($database);
	
	$array_user = array(
		"u_id" => $_POST['cid'],
		"u_password" => $_POST['cpass'],
		"u_mail" => $_POST['caddr'],
	);
	$pass2 = $_POST['cpass2'];
	$userModif->hydrate($array_user);
	$tableUsersAModif->update_user_by_id($userModif,$pass2);
}
else {
	echo "Une erreur est survenue.";
}
?>
