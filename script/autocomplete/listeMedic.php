<?php
$bdd = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$term = $_GET['term'];

$requete = $bdd->prepare('SELECT * FROM cis_bdpm WHERE cis_name LIKE :term');
$requete->execute(array('term' => '%'.$term.'%'));

$array = array();

while($donnee = $requete->fetch()){
    array_push($array, $donnee['cis_name']);
}

echo json_encode($array);

?>