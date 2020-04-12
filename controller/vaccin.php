<?php
session_start();

require_once '../model/accounts.class.php';
require_once '../model/vaccines.class.php';
require_once '../model/inoculations.class.php';
require_once '../script/function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Vaccin";
$ariane = "<a href='accueil.php'>Accueil</a> > Vaccin";

if(isset($_SESSION['a_id'])){
	$recupInfoAccounts = new ManagementBddAccounts($database);
	$recupInocAccounts = new ManagementBddInoculations($database);
	$recupVaccAccounts = new ManagementBddVaccines($database);
	$idaccount = $_SESSION['a_id'];
	
	$resultatRechAccount = $recupInfoAccounts->select_account_with_account_id($idaccount);
	$bddate = formatDateFR($resultatRechAccount[0]['a_birth_date']);
	$titre_page = "Vaccin(s) pour l'utilisateur ".$_SESSION['a_first_name']." ".$_SESSION['a_name'].", né(e) le ".$bddate;

	$resultatInoAccount = $recupInocAccounts->select_inoculation_for_1ppl_join($idaccount);
	$echovacc = "";
	$compvac = 0;
	foreach($resultatInoAccount AS $rowIno){
		$echovacc .= '
		<tr id="idvac'.$rowIno['i_id'].'">
            <td id="nom'.$compvac.'">'.$rowIno['v_name'].'</td>
            <td id="datebase'.$compvac.'">
				<input type="text" id="modifdate'.$compvac.'" value="'.formatDateFR($rowIno['i_date']).'" style="width:80%" disabled>
				<button id="vaccmodif'.$compvac.'" class="btn btn-success notika-btn-success waves-effect">
					<i class="fas fa-edit"></i>
				</button>
			</td>
            <td id="datecalcul'.$compvac.'">CALCUL DATE RAPPEL</td>
            <td id="infog'.$compvac.'">'.$rowIno['v_disease'].' - type : '.$rowIno['v_type'].'</td>
            <td  id="rappel'.$compvac.'">'.$rowIno['v_date'].'</td>
        </tr>';
		$compvac++;
	}
}
else {
	header('Location:connexion.php');
}

require_once '../view/vaccin.php';
?>

<script>
    document.getElementById('vaccsub').onclick = function(){
		var resNomV = document.getElementById('vaccnom').value;
		var resDateV = document.getElementById('vaccdate').value;

		if(resNomV){
			if(resDateV){
				if(validateDate(resDateV)){
					var idacc = <?php echo $idaccount; ?>;
					$.post("../script/vaccin/addvaccine.php", { cida : idacc, cnomv : resNomV, cdatev : resDateV },
						function(success){
							alert(success);
							document.location.href = "vaccin.php";
						}
					);

				}
				else {
					alert("Veuillez renseigner une date au format jj/mm/aaaa.");
				}
			}
			else {
				alert("Veuillez renseigner une date.");
			}
		}
		else {
			alert("Veuillez renseigner le nom du vaccin");
		}
    }

	
	for(i = 0 ; i < <?php echo $compvac;?> ; i++){
		function_modif_vaccin = 'document.getElementById("vaccmodif'+i+'").onclick = function(){if(document.getElementById("modifdate'+i+'").disabled == false){var resDateV = document.getElementById("modifdate'+i+'").value;var str = document.getElementsByTagName("tr")['+i+'].id;var idi = str.substring(5);if(resDateV){if(validateDate(resDateV)){$.post("../script/vaccin/modifvaccine.php", { cidi : idi, cdatev : resDateV },function(success){alert(success);document.location.href = "vaccin.php";});}else {alert("Veuillez renseigner une date valide au format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date.");}}else {document.getElementById("modifdate'+i+'").disabled = false;}}';
		eval(function_modif_vaccin);

		$('#modifdate'+i+'').datepicker({
			format: 'dd/mm/yyyy'
		});
	}
</script>