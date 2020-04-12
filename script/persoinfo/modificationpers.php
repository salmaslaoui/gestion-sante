<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/accounts.class.php';
require_once '../../script/function.php';

if(isset($_POST['ida'])){
	$ida = $_POST['ida'];
	$date = formatDate($_POST['ddn']);

	$tableAcc = new ManagementBddAccounts($database);
	$AccountAModif = new Accounts();

	$array_account = array(
		"a_id" => $ida,
		"a_first_name" => $_POST['pre'],
		"a_name" => $_POST['nom'],
		"a_birth_date" => $date,
	);

	$AccountAModif->hydrate($array_account);
	$tableAcc->update_account($AccountAModif);

	echo "Toutes les informations concernant cet utilisateur ont bien été modifiées !";
}
else {
	echo "Une erreur est survenue.";
}
?>
