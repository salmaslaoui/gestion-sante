<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/accounts.class.php';
require_once '../../model/inoculations.class.php';
require_once '../../model/treatments.class.php';

if(isset($_POST['ida'])){
	$recupAccountsAsuppr = new ManagementBddAccounts($database);
	$recupTreatmentsASuppr = new ManagementBddTreatments($database);
	$recupInoculationsASuppr = new ManagementBddInoculations($database);
	
	$ida = $_POST['ida'];

	$recupTreatmentsASuppr->delete_treatment_for_1ppl($ida);
	$recupInoculationsASuppr->delete_inoculation_for_1ppl($ida);
	$recupAccountsAsuppr->delete_account_with_account_id($ida);

	echo "Toutes les informations concernant cette personne ont bien été supprimées !";
}
else {
	echo "Une erreur est survenue.";
}
?>