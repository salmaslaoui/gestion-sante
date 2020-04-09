<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Juridique";
$titre_page = "Informations juridiques du site";
$ariane = "<a href='accueil.php'>Accueil</a>";

require_once '../view/droit.php';
?>