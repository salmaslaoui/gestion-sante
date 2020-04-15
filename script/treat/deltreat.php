<?php
session_start();

require_once '../../model/treatments.class.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['taid'])){
	$bddtreat = new ManagementBddTreatments($database);
	
	$t_id = $_POST['taid'];
	$t_tag = $_POST['ttag'];
	$bddtreat->update_del_treat($t_id,$t_tag);
	
	echo "Votre traitement a bien été supprimé.";
}
?>