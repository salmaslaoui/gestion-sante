<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../../model/accounts.class.php';
require_once '../../model/users.class.php';
require_once '../../model/treatments.class.php';
require_once '../../model/storages.class.php';
require_once '../../model/inoculations.class.php';

if(isset($_POST['idu'])){
	$recupAccountsAsuppr = new ManagementBddAccounts($database);
	$recupUserASuppr = new ManagementBddUsers($database);
	$recupTreatmentsASuppr = new ManagementBddTreatments($database);
	$recupStoragesASuppr = new ManagementBddStorages($database);
	$recupInoculationsASuppr = new ManagementBddInoculations($database);
	
	$idu = $_POST['idu'];

	$resRechASuppr = $recupAccountsAsuppr->select_account_with_user_id($idu);
	foreach($resRechASuppr AS $rowAccASuppr) {
		$idAcc = $rowAccASuppr['a_id'];
		$recupTreatmentsASuppr->delete_treatment_for_1ppl($idAcc);
		$recupInoculationsASuppr->delete_inoculation_for_1ppl($idAcc);
		$recupAccountsAsuppr->delete_account_with_user_id($idAcc);
	}
	$resStorages = $recupStoragesASuppr->delete_storage_with_uid($idu);
	$recupUserASuppr->delete_user_with_user_id($idu);

	echo "Toutes les informations vous concernant et vos personnes affiliées sont bien supprimées !";
}
else {
	echo "Une erreur est survenue.";
}
?>
