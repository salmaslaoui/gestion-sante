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
			$resultatpaystest = "";
			
			foreach($ret1 AS $row){
				$id_row = $row['c_id'];
				$ret2 = $var3->select_vaccines_for_1countrie($id_row);
				foreach($ret2 AS $row2) {
					if(!empty($ret2['j_vid'])){
						$id_row2 = $row2['j_vid'];
						$table='vaccines';
						$ret3 = $tableVaccins->select_all_with_id($table,$id_row2);
						$resultatpaystest .= "Liste des vaccins pour le pays ".$ret1['c_name_fr']." :</br>";
						foreach($ret3 AS $row3){
							$resultatpaystest .= $row3['v_name'] . " " . $row3['v_disease']. " " . $row3['v_type']. "</br> Date des Rappels : à partir de" . $row3['v_age'] . " : " . $row3['v_date']."</br>";
						}
					}
					else {
						$error = "Aucune correspondance pour les vaccins trouvée dans la base de données.";
					}
				}
			}
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
<script>
	$('#inputsearch').autocomplete({
		source : '../script/autocomplete/listePays.php',
		minLength: 3,
		select : function(event, ui){
			$('#description').val( ui.item.desc ); 
		}
    });
</script>



