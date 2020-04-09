<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once "../model/treatments.class.php";
require_once "../model/storages.class.php";

$titre_onglet = "Traitement";
$titre_page = "Traitement(s) de ".$_SESSION['a_first_name']." ".$_SESSION['a_name'];
$ariane = "<a href='accueil.php'>Accueil</a> > Traitement";

// Faire un test if $_SESSION pour rentrer sur la page sinon une redirection



require_once '../view/traitement.php';
?>

<script>
document.getElementById('treataddsub').onclick = function(){
	var tag = $('#treattag').val();
	var nom = $('#treatnom').val();
	var dated = $('#treatdatedeb').val();
	var datef = $('#treatdatef').val();
	var quan = $('#treatquan').val();
	var nbjour = $('#treatnbjour').val();
	var time = $('#treattime').val();
	
	if(tag != ""){
		if(nom != ""){
			if(dated != ""){
				if(validateDate(dated)){
					if(datef != ""){
						if(validateDate(datef)){
							if(quan != ""){
								if(nbjour != ""){
									if(time != "" && Number(time) != "NaN"){
										time = Number(time);
										if(validateTime(time)){
											$.post("../script/treat/addtreat.php", { ttag : tag, tnom : nom, tdateb : dateb, tdatef : datef, tquan : quan,  tnbjour : nbjour, ttime : time},
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
										alert("Veuillez renseigner les horaires approximatifs de la prise du médicament.");
									}
								}
								else {
									alert("Veuillez renseigner le nombre de prise par jour du médicament.");
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

document.getElementById('treataddsub').onclick = function(){
	
}

	/*#medbutdel1*/
</script>