<?php
session_start();

require_once '../model/accounts.class.php';
require_once '../model/users.class.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Information";
$titre_page = "Informations personnelles de l'utilisateur ".$_SESSION['u_name'];
$ariane = "<a href='accueil.php'>Accueil</a> > Informations personnelles";

if(isset($_SESSION['u_id'])){
	if(isset($_GET['action']) AND !is_null($_GET['action'])){
		$action = 1;
	}
	else {
		$action = 0;
	}
	
	$recupInfoUsers = new ManagementBddUsers($database);
	$recupInfoAccounts = new ManagementBddAccounts($database);
	$table = "users";
	$idusers = $_SESSION['u_id'];
	
	$resultatRechUsers = $recupInfoUsers->select_all_with_id($table,$idusers);
	$jsondata = json_encode($resultatRechUsers[0]);
	
	$resultatRechAcc = $recupInfoAccounts->select_account_with_user_id($idusers);
	$echotitlepan = "";
	$echotabpan = "";
	$jsondatapan = json_encode($resultatRechAcc);
	$compif = 0;
	foreach($resultatRechAcc as $rechAcc){
		$echotitlepan .= '<li class=""><a data-toggle="tab" href="#menu'.$compif.'" aria-expanded="false">'.$rechAcc['a_first_name'].' '.$rechAcc['a_name'].'</a></li>';
		$echotabpan .= '
		<div id="menu'.$compif.'" class="tab-pane">
			<div class="tab-ctn">
				<div class="form-example-int form-horizental">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="ifprep'.$compif.'" class="hrzn-fm">Prénom</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="ifprep'.$compif.'" type="text" class="form-control input-sm" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int form-horizental">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="ifnomp'.$compif.'" class="hrzn-fm">Nom</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="ifnomp'.$compif.'" type="text" class="form-control input-sm" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int form-horizental">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="ifdate'.$compif.'" class="hrzn-fm">Date de naissance</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="ifdate'.$compif.'" type="text" class="form-control input-sm" data-mask="99/99/9999" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int mg-t-15">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<button id="ifmodifp'.$compif.'" class="btn btn-success notika-btn-success waves-effect">Modifier</button>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							<button id="ifsuppp'.$compif.'" class="btn btn-success notika-btn-success waves-effect">Supprimer cette personne</button>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						</div>
					</div>
				</div>
			</div>
		</div>';
			
		$compif++;
	}
}
else {
	header('Location:connexion.php');
}

require_once '../view/information.php';
?>

<script>
$(document).ready(function() {
	var action = <?php echo $action; ?>;

	if(action == 1){
		document.getElementById('home').className = "tab-pane";
		document.getElementById('addp').className = "tab-pane active";
	}
	
	var json = JSON.parse('<?= $jsondata ; ?>');
	document.getElementById('ifnomc').value = json.u_name;
	document.getElementById('ifpassc').value = json.u_password;
	document.getElementById('ifadrc').value = json.u_mail;

	document.getElementById('ifmodifc').onclick = function(){
		if(document.getElementById('ifpassc').disabled == false){
			document.getElementById('blocConfirMdp').style.display = "none";
			document.getElementById('ifpassc').disabled = true;
			document.getElementById('ifpassc2').disabled = true;
			document.getElementById('ifadrc').disabled = true;
			
			var resPass = document.getElementById('ifpassc').value;
			var resPass2 = document.getElementById('ifpassc2').value;
			var resAddrM = document.getElementById('ifadrc').value;
			
			if(resPass){
				if(validatePass(resPass)){
					if(resPass==resPass2) {
						if(validateEmail(resAddrM)){
							var iduser = <?php echo $_SESSION['u_id'] ?>;
							$.post("../script/persoinfo/modificationaccount.php", { cid : iduser, cpass : resPass, caddr : resAddrM, cpass2 : resPass2 },
								function(success){
									alert(success);
									document.location.href = "information.php";
								}
							);
						}
						else {
							alert("Veuillez renseigner une adresse email valide.");
						}
					}
					else {
						alert("Les deux mots de passe ne correspondent pas.");
					}
				}
				else {
					alert("Le mot de passe doit contenir au moins un lettre minimum, une majuscule et un chiffre.");
				}
			}
			else{
				alert("Veuillez remplir le champs Mot de passe.");
			}
		}
		else {
			document.getElementById('blocConfirMdp').style.display = "block";
			document.getElementById('ifpassc').disabled = false;
			document.getElementById('ifpassc2').disabled = false;
			document.getElementById('ifadrc').disabled = false;
		}
	}

	document.getElementById('ifsuppc').onclick = function(){
		if(confirm("Voulez-vous vraiment supprimer ce compte et ses utilisateurs associés ?")){
			var iduser = <?php echo $_SESSION['u_id'] ?>;
			$.post("../script/persoinfo/suppression.php", { idu : iduser },
				function(success){
					alert(success);
					document.location.href = "accueil.php";
				}
			);
		}
	}
	
	document.getElementById('ifadd').onclick = function(){
        var recupPrenom = document.getElementById('ifprea').value;
        var recupNom = document.getElementById('ifnoma').value;
        var recupDdn = document.getElementById('ifdatea').value;
        if(recupPrenom) {
            if(recupNom){
				if(validateDate(recupDdn)){
					var iduser = <?php echo $_SESSION['u_id'] ?>;
					$.post("../script/persoinfo/addaccount.php", { cidu : iduser, cpnom : recupPrenom, cnom : recupNom, cddn : recupDdn },
						function(success){
							alert(success);
							document.location.href = "information.php";
						}
					);
				}
				else {
					alert("Veuillez renseigner une date de naissance valide.");
				}
            }
            else {
				alert("Veuillez renseigner le champ Nom.");
            }
        }
        else {
            alert("Veuillez renseigner le champ Prenom.");
        }
    }

	var json2 = JSON.parse('<?= $jsondatapan ; ?>');	
	for(i = 0; i < <?php echo $compif; ?>; i++){
		var function_modif_personne = 'document.getElementById("ifprep'+i+'").value = json2['+i+'].a_first_name;document.getElementById("ifnomp'+i+'").value = json2['+i+'].a_name;document.getElementById("ifdate'+i+'").value = reverseDate(json2['+i+'].a_birth_date);document.getElementById("ifmodifp'+i+'").onclick = function(){if(document.getElementById("ifprep'+i+'").disabled == false){document.getElementById("ifprep'+i+'").disabled = true;document.getElementById("ifnomp'+i+'").disabled = true;document.getElementById("ifprep'+i+'").disabled = true;var preModif = document.getElementById("ifprep'+i+'").value;var nomModif = document.getElementById("ifnomp'+i+'").value;var ddnModif = document.getElementById("ifdate'+i+'").value;if(preModif){if(nomModif){if(validateDate(ddnModif)){var idaccount = json2['+i+'].a_id;var iduser = <?php echo $_SESSION['u_id'] ?>;$.post("../script/persoinfo/modificationpers.php", { ida : idaccount, idu : iduser, pre : preModif, nom : nomModif, ddn : ddnModif},function(success){alert(success);document.location.href = "information.php";});}else {alert("Veuillez renseigner une date de naissance valide");}}else {alert("Veuillez renseigner le champ nom");}}else {alert("Veuillez renseigner le champ prénom");}}else {document.getElementById("ifprep'+i+'").disabled = false;document.getElementById("ifnomp'+i+'").disabled = false;document.getElementById("ifdate'+i+'").disabled = false;}}';
		eval(function_modif_personne);
	
		var function_del_personne = 'document.getElementById("ifsuppp'+i+'").onclick = function(){if(confirm("Voulez-vous vraiment supprimer cet utilisateur ?")){var idaccount = json2['+i+'].a_id;$.post("../script/persoinfo/suppressionpers.php", { ida : idaccount },function(success){alert(success);document.location.href = "information.php";});}}';
		eval(function_del_personne);
	}	
});
</script>