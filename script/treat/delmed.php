<?php
session_start();

require_once '../../model/treatments.class.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

if(isset($_POST['taid'])){
	$bddtreat = new ManagementBddTreatments($database);
	
	$t_id = $_POST['taid'];
	$t_tag = $_POST['ttag'];
	$bddtreat->update_del_treat($t_id,$t_tag);
	
	echo "Le médicament ", $nom ," a bien été ajouté au traitement ", $_POST['mtag'],"!";
}


if(isset($_POST['maid'])){
	$id = (int) $_POST['mail'];	
	echo "KOUKOU ON A BIEN LES INFOS DANS ADD MED A UN TREAT : maid = ", $_POST['maid'], "et le tag :",$id;
}

// maid : aid, mtag : tag, mnom : nom, mdated : dated, mdatef : datef, mquan : quan,  mnbjour : nbjour, mtime : time
?>