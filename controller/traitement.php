<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once "../model/treatments.class.php";
require_once "../model/storages.class.php";
require_once "../model/cis_bdpm.class.php";
require_once "../script/function.php";

$bddtreat = new ManagementBddTreatments($database);
$bddstore = new ManagementBddStorages($database);
$bddcis = new ManagementBddCisBdpm($database);

$titre_onglet = "Traitement";
$titre_page = "Traitement(s) de ".$_SESSION['a_first_name']." ".$_SESSION['a_name'];
$ariane = "<a href='accueil.php'>Accueil</a> > Traitement";

if(isset($_SESSION['u_id'])){
	$aid = $_SESSION['a_id'];
	$localtime = getTime();
	$nextmedtab = $bddtreat->select_treatment_for_1ppl($aid);
	$echomed = "";
	$medpris = "";
	$varid = "";
	if(!empty($nextmedtab) OR $nextmedtab != false){ // Bloc Prochains médicaments + med pris
		foreach($nextmedtab as $nextmed){
			$time2 = $nextmed['t_time'];
			$test234 = captureTime($time2);
			$echomed .= "Pour ".$nextmed['t_tag']." : </br>";
			foreach($test234[0] as $test123){
				$nextmedcis = $nextmed['t_cis'];
				$numcis = $bddcis->select_cis_by_idcis($nextmedcis);
				$nextmednom = $numcis[0]['cis_name'];
				$nextmedtype = $numcis[0]['cis_type'];
				$day = whenTime($test123 , $localtime);
				if($day == "TODAY"){ // BLOC A PRENDRE
					$echomed .= $nextmed['t_quantity']." ".$nextmednom." à ".$test123."</br>";
					// Il faudrait essayer de faire un truc plus joli et ordonné au niveau du temps
					$GLOBAL['tidvalidate'.$nextmed['t_id'].''] = $nextmed['t_validate'];
				}
				else { // BLOC PRIS
					$medpris = $nextmed['t_quantity']." ".$nextmednom." à ".$test123."</br>";
					$varid .= $nextmed['t_id'].",";
					var_dump($varid);
					$GLOBAL['tidpris'.$nextmed['t_id'].''] = $nextmed['t_validate'];
					// Script med pris + $GLOBAL 
				}
			}
		}
		var_dump($GLOBAL);
	}
	else {
		$echomed .= "Aucune prise aujourd'hui";
	}
	
	// BLOC VALIDATE
	
	// BLOC AFFICHAGE
	
	// BLOC ALERTE MED
}	
else {
	header('Location:accueil.php');
}

require_once '../view/traitement.php';
?>

<script>
//oTable.fnGetData();

$( document ).ready(function() {
	document.getElementById('treataddsub').onclick = function(){
		var aid = <?php echo $_SESSION['a_id'];?>;
		var tag = $('#treattag').val();
		var nom = $('#treatnom').val();
		var dated = $('#treatdatedeb').val();
		var datef = $('#treatdatef').val();
		var quan = $('#treatquan').val();
		var nbjour = $('#treatnbjour').val();
		var time = $('#treattime').val();
		
		if(tag){
			if(nom){
				if(dated){
					if(validateDate(dated)){
						if(datef){
							if(validateDate(datef)){
								if(quan){
									quan = parseInt(quan);
									quan = Number(quan);
									if(quan){
										if(nbjour){
											nbjour = parseInt(nbjour);
											nbjour = Number(nbjour);
											if(!isNaN(nbjour)){
												if(time){
													if(validateTime(time)){
														$.post("../script/treat/addtreat.php", { taid : aid, ttag : tag, tnom : nom, tdated : dated, tdatef : datef, tquan : quan,  tnbjour : nbjour, ttime : time},
															function(success){
																alert(success);
																document.location.href = "traitement.php";
															}
														);
													}
													else {
														alert("Veuillez renseigner les horaires approximatifs de la prise du médicament sous le format hh:mm (24h).");
													}
												}
												else {
													alert("Veuillez renseigner les horaires approximatifs de la prise du médicament sous le format hh:mm (24h).");
												}	
											}
											else {
												alert("Veuillez renseigner en chiffre(s) le nombre de prise par jour du médicament.");
											}
										}
										else {
											alert("Veuillez renseigner le nombre de prise par jour du médicament.");
										}
									}
									else {
										alert("Veuillez renseigner en chiffre(s) la quantitée du médicament à prendre par prise.");
									}
								}
								else {
									alert("Veuillez renseigner la quantitée du médicament à prendre par prise.");
								}
							}
							else {
								alert("Veuillez renseigner la date de fin du traitement sous le format jj/mm/aaaa.");
							}
						}
						else {
							alert("Veuillez renseigner une date de fin du traitement.");
						}
					}
					else {
						alert("Veuillez renseigner la date de début du traitement sous le format jj/mm/aaaa.");
					}
				}
				else {
					alert("Veuillez renseigner une date de début du traitement.");
				}
			}
			else {
				alert("Veuillez renseigner le nom d'un médicament.");
			}
		}
		else {
			alert("Veuillez renseigner une appellation pour le traitement.");
		}
	}

	for(j = 1 ; j <= <?php echo $i;?> ; j++){ // changer à 0 -- $i = compteur des tab pan
		// revoir les var de la fonction
		var function_del_treat = 'document.getElementById("treatbutdel'+j+'").onclick = function(){ if(confirm("Voulez-vous vraiment supprimer ce traitement ?")) {var taid = <?php echo $_SESSION['a_id'];?>;var ttag = "Je suis le tag du j n°'+j+'";var tid = "test";$.post("../script/treat/deltreat.php", { taid : taid, ttag : ttag, tid : tid},function(success){alert(success);document.location.href = "traitement.php";});}}';
		eval(function_del_treat);

		// revoir le var tag de la fonction (Récupération en PHP)
		var function_add_med = 'document.getElementById("medsub'+j+'").onclick = function(){var aid = <?php echo $_SESSION['a_id'];?>;var tag = '+j+';var nom = $("#mednom'+j+'").val();var dated = $("#meddatedeb'+j+'").val();var datef = $("#meddatef'+j+'").val();var quan = $("#medquan'+j+'").val();var nbjour = $("#mednbjour'+j+'").val();var time = $("#medtime'+j+'").val();if(nom){if(dated){if(validateDate(dated)){if(datef){if(validateDate(datef)){if(quan){quan = parseInt(quan);quan = Number(quan);if(!isNaN(quan)){if(nbjour){nbjour = parseInt(nbjour);nbjour = Number(nbjour);if(!isNaN(nbjour)){if(time){if(validateTime(time)){$.post("../script/treat/addmed.php", { maid : aid, mtag : tag, mnom : nom, mdated : dated, mdatef : datef, mquan : quan,  mnbjour : nbjour, mtime : time},function(success){alert(success);document.location.href = "traitement.php";});}else {alert("Veuillez renseigner les horaires approximatifs de la prise du médicament sous le format hh:mm (24h).");}}else {alert("Veuillez renseigner les horaires approximatifs de la prise du médicament.");}}else {alert("Veuillez renseigner en chiffre(s) le nombre de prise par jour du médicament..");}}else {alert("Veuillez renseigner le nombre de prise par jour du médicament.");}}else {alert("Veuillez renseigner en chiffre(s) la quantitée du médicament à prendre par prise.");}}else {alert("Veuillez renseigner la quantitée du médicament à prendre par prise.");}}else {alert("Veuillez renseigner la date de fin du traitement sous le format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date de fin du traitement.");}}else {alert("Veuillez renseigner la date de début du traitement sous le format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date de début du traitement.");}}else {alert("Veuillez renseigner le nom d\'un médicament.");};};';
		eval(function_add_med);
		
		
		// faire les fonctions de modif et de del dans chaque tableau
		// Au moment du foreach de PHP des tags mettre un compteur + déclaration à l'extérieur
		// faire un echo dans un var au début du for JS

	
		
	} // fin de la boucle for des fonctions au nom dynamique
	
	document.getElementById('treatpris').onclick = function(){
		var tid = <?php echo $varid;?>;
		var treatprise = 1;
		$.post("../script/treat/prise.php", { tpid : tid, prise : treatprise},
			function(success){
				alert(success);
			}
		);
	}
	document.getElementById('treatppris').onclick = function(){
		var tid = <?php echo $varid;?>;
		var treatprise = 0;
		$.post("../script/treat/prise.php", { tpid : tid, prise : treatprise},
			function(success){
				alert(success);
			}
		);
	}
}); // fin du document.ready()
















</script>