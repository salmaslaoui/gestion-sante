<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Se connecter";
$titre_page = "";
$ariane = "";

if(isset($_GET['action']) AND !is_null($_GET['action'])){
	$action = 1;
}
else {
	$action = 0;
}

if(isset($_SESSION['u_id'])){
	header('Location:accueil.php');
}

require_once '../view/connexion.php';
?>

<script>
var action = <?php echo $action; ?>;

if(action == 1){
	document.getElementById('l-login').className = "nk-block";
	document.getElementById('l-register').className = "nk-block toggled";
}

document.getElementById('lsub').onclick = function(){
	var user = $('#luser').val();
	var pass = $('#lpass').val();
	var test = "";
	
	if(user){
		if(pass){
			$.post("../script/reglog/login.php", { luser : user, lpass : pass },
				function(success){
					test = success;
					alert(success);
					if(test === "Connexion réussie, bienvenue !"){
						document.location.href = "traitement.php";
					}
					else {
						document.location.href = "connexion.php";
					}
				}
			);
		}
		else {
			alert("Veuillez remplir le champ Mot de passe");
		}
	}
	else {
		alert("Veuillez remplir le champ Nom de compte");
	}
};

document.getElementById('rsub').onclick = function(){
	var user = $('#ruser').val();
	var mail = $('#rmail').val();
	var pass = $('#rpass').val();
	var pass2 = $('#rpass2').val();
	var pre = $('#rpre').val();
	var name = $('#rname').val();
	var date = $('#rdate').val();
	var test = "";
	
	if(user){
		if(user.length >= 6){
			if(mail){
				if(validateEmail(mail)){
					if(pass){
						if(pass.length >=8 && pass.length <= 20){
							if(validatePass(pass)){
								if(pass2){
									if(pass == pass2){
										if(pre){
											if(name){
												if(date){
													if(validateDate(date)){
														$.post("../script/reglog/register.php", { ruser : user, rmail : mail, rpass : pass, rpass2 : pass2, rpre : pre, rname : name, rdate : date},
															function(success){
																test = success;
																alert(success);
																if(test === "Inscription réussie, connectez-vous !"){
																	document.location.href = "connexion.php";
																}
																else {
																	document.location.href = "connexion.php?action=inscription";
																}
															}
														);
													}
													else {
														alert("Veuillez renseigner une date de naissance valide.");
													}
												}
												else {
													alert("Veuillez renseigner le champ Date de naissance.");
												}
											}
											else {
												alert("Veuillez renseigner le champ Nom.");
											}
										}
										else {
											alert("Veuillez renseigner le champ Prénom.");
										}
									}
									else {
										alert("Vos mots de passe ne correspondent pas.");
									}
								}
								else {
									alert("Veuillez renseigner le champ Confirmer le mot de passe.");
								}
							}
							else {
								alert("Votre mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre. Il peut contenir des caractères spéciaux.");
							}
						}
						else {
							alert("Votre mot de passe doit contenir entre 8 et 20 caractères.");
						}
					}
					else {
						alert("Veuillez renseigner le champ Mot de passe.");
					}
				}
				else {
					alert("Veuillez renseigner une adresse mail valide.");
				}
			}
			else {
				alert("Veuillez renseigner le champ Adresse email.");
			}
		}
		else {
			alert("Votre nom d'utilisateur doit contenir au moins 6 caractères.");
		}
	}
	else {
		alert("Veuillez renseigner le champ Nom de compte.");
	}
};

document.getElementById('psub').onclick = function(){
	var mail = $('#pmail').val();
	
	if(mail){
		if(validateEmail(mail)){
			$.post("../script/reglog/forgetpass.php", { pmail : mail},
				function(success){
					alert("Un mail avec un mot de passe temporaire vous a été envoyé.");
					document.location.href = "connexion.php";
				}
			);
		}
		else {
			alert("Veuillez renseigner une adresse mail valide.");
		}
	}
	else {
		alert("Veuillez renseigner votre adresse mail.");
	}
};
</script>