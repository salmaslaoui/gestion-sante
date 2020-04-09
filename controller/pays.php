<?php
session_start();

require_once '../model/countries.class.php';
require_once '../model/vaccines.class.php';
require_once '../model/journeys.class.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Je voyage !";
$titre_page = "Rechercher les vaccins d'un pays";
$ariane = "<a href='accueil.php'>Accueil</a> > Pays";

$tableVaccins = new ManagementBddVaccines($database);

if(isset($_POST['buttonsearch'])){
	$var = $_POST['inputsearch'];
	if(!empty($var) && strlen($var)>=3){
		$var2 = new ManagementBddCountries($database);
		$ret1 = $var2->select_country_by_name_fr($var);
		if($ret1 != false){
			$var3 = new ManagementBddJourneys($database);
			$resultatpaystest = 1;
		}
		else {
		  $error = "Aucun résultat de pays pour la recherche";
		}
	}
	else {
		$error = "Veuillez saisir au moins 3 caractères";
	}
}
require_once '../view/pays.php';
?>



