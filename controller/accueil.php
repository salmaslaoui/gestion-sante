<?php
session_start();

$titre_onglet = "Accueil";
$titre_page = "";
$ariane = "";

$alerte = true;
$alerte_title = "ALERTE SANITAIRE</br>Coronavirus COVID-19";
$alerte_text = "Sacrés Pangolins de tes grands morts.";

require_once '../view/accueil.php';
?>

<script>
document.getElementById('subcontact').onclick = function(){
	var nom = $('#nomcontact').val();
	var mail = $('#addmailcontact').val();
	var sujet = $('#sujetcontact').val();
	var msg = $('#msgcontact').val();
	
	if(validateEmail(mail)){
		if(msg == ""){
			alert("Veuillez nous écrire un message");
		}
		else {
			$.post("../script/contact.php", { cnom : nom, cmail : mail, csujet : sujet, cmsg : msg },
				function(success){
					alert(success);
				}
			);
			document.location.href = "accueil.php";
		}
	}
	else {
		alert("Veuillez renseigner une adresse email valide.");
	}
}
</script>