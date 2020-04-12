<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/Accounts.class.php';
require_once '../../script/function.php';

if(isset($_POST['cidu'])){
	$cidu = $_POST['cidu'];
	$date = formatDate($_POST['cddn']);

	$tableAccount = new ManagementBddAccounts($database);
	$AccountAAdd = new Accounts();

	$array_account = array(
	  "a_uid" => $cidu,
	  "a_first_name" => $_POST['cpnom'],
	  "a_name" => $_POST['cnom'],
	  "a_birth_date" => $date,
	);
	$AccountAAdd->hydrate($array_account);
	$tableAccount->add_account($AccountAAdd);

	echo "Le nouvel utilisateur a été crée !";
}
else {
	echo "Une erreur est survenue.";
}
?>
