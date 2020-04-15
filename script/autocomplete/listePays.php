<?php
$bdd = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$term = $_GET['term'];

$requete = $bdd->prepare('SELECT * FROM countries WHERE c_name_fr LIKE :term');
$requete->execute(array('term' => '%'.$term.'%'));

$array = array();

while($donnee = $requete->fetch()){
	array_push($array, $donnee['c_name_fr']);
}

echo json_encode($array);

?>