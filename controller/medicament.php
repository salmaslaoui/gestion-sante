<?php
session_start();

require_once '../model/cis_bdpm.class.php';
require_once '../model/cis_cip_bdpm.class.php';
require_once '../model/cis_compo_bdpm.class.php';
require_once '../model/cis_cpd_bdpm.class.php';
require_once '../model/cis_gener_bdpm.class.php';
require_once '../model/cis_has_asmr_bdpm.class.php';
require_once '../model/cis_has_smr_bdpm.class.php';
require_once '../model/cis_infoImportantes_aaaammjjhhmiss_bdpm.class.php';
require_once '../model/has_lienspagect_bdpm.class.php';


$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Je me soigne !";
$titre_page = "Rechercher un medicament";
$ariane = "<a href='accueil.php'>Accueil</a> > Informations médicament";

$recupMedicament = new ManagementBddCisBdpm($database);
$recupMedicCip = new ManagementBddCisCipBdpm($database);
$recupMedicCompo = new ManagementBddCisCompoBdpm($database);
$recupMedicGener = new ManagementBddCisGenerBdpm($database);
$recupMedicCpd = new ManagementBddCisCpdBdpm($database);
$recupMedicHasAsmr = new ManagementBddCisHasAsmrBdpm($database);
$recupMedicHasSmr = new ManagementBddCisHasSmrBdpm($database);
$recupMedicInfosImp = new ManagementBddCisInfoImportantesAAAAMMJJhhmissBdpm($database);
$recupMedicLiens = new ManagementBddHasLienPageCTBdpm($database);

if(isset($_POST['buttonsearch'])){
	$var = $_POST['inputsearch'];
	if(!empty($var) && strlen($var)>=3){
		$ret = $recupMedicament->select_cis_by_cisname($var);
		$resultatmedtest = "";
		
		foreach($ret AS $row){
			$id_row = $row['cis_cis'];
			$retCip = $recupMedicCip->select_cis_cip_by_idcis($id_row);
			$retCompo = $recupMedicCompo->select_cis_compo_by_idcis($id_row);
			$retGener = $recupMedicGener->select_cis_gener_by_idcis($id_row);
			$retCpd = $recupMedicCpd->select_cis_cpd_by_idcis($id_row);
			$retAsmr = $recupMedicHasAsmr->select_cis_has_asmr_by_idcis($id_row);				
			$retSmr = $recupMedicHasSmr->select_cis_has_smr_by_idcis($id_row);
			if(!empty($retAsmr)){
				$retHasLiens = $recupMedicLiens->select_liens_page_by_code_dossier($retAsmr[0]['cis_ha_file']);
			}
			$retInfosImp = $recupMedicInfosImp->select_cis_infoImportantes_aaaammjjhhmiss_by_idcis($id_row);
						
			$resultatmedtest .= "<br/><h4>" . $row['cis_name']. "</h4><b>Type de médicament</b> : " . $row['cis_type']
			. "<br/><b>Voie d'administration</b> : " . $row['cis_take'] ."<br/><b>Informations de commercialisation</b> : " . $row['cis_status']." - " . $row['cis_proc']
			. " - " . $row['cis_comm']. " en " . $row['cis_date_amm']. " - " . $row['cis_status_bdm']
			. " - N° Européen : " . $row['cis_ue_number']. "<br/><b>Laboratoire</b> : " . $row['cis_lab']."<br/>";

			foreach($retCip AS $rowCip){
				$resultatmedtest .= "<b>Composition d'une boîte</b> : " . $rowCip['cis_cip_name']. " <br/>" . $rowCip['cis_cip_admin']
				. "<br/><b>Prise en charge possible par la Sécurité sociale</b> : " . $rowCip['cis_cip_refund']. "<br/>Prix disponibles : " . $rowCip['cis_cip_price']
				. " - " . $rowCip['cis_cip_price2']. " - " . $rowCip['cis_cip_price3']. "<br/>" . $rowCip['cis_cip_law'];
			}
			foreach($retCompo AS $rowCompo){
				$resultatmedtest .= "<br/><b>Composition :<br/>Code composition</b> : " . $rowCompo['cis_comp_code']. "<br/><b>Substance active</b> : " . $rowCompo['cis_comp_sub']
				. " dosé à " . $rowCompo['cis_comp_dosage']. " par " . $rowCompo['cis_comp_ref']
				. ". Nature de la substance : " . $rowCompo['cis_comp_nature']. ".</br>";
			}
			foreach($retGener AS $rowGener){
				$resultatmedtest .= "<br/><b>Générique</b> : <br/>Nom : ".$rowGener['cis_gen_name'] . "<br/> Code : " . $rowGener['cis_gen_cis']. "<br/> Type du générique : " . $rowGener['cis_gen_type'];
			}
			foreach($retCpd AS $rowCpd){
				$resultatmedtest .= "<b>Conditions d'usage</b> : ".$rowCpd['cis_cpd_cond'];
			}
			foreach($retAsmr AS $rowHasAsmr){
				$resultatmedtest .= "<br/><br/><b>Informations Haute Autorité de santé</b> :<br/>N° de dossier HAS : ".$rowHasAsmr['cis_ha_file'] . "<br/>Motivations : " . $rowHasAsmr['cis_ha_motive']
				. "<br/>Date : " . $rowHasAsmr['cis_ha_date']
				. "<br/>Importance : " . $rowHasAsmr['cis_ha_value']. "<br/>Contenu :<br/> " . $rowHasAsmr['cis_ha_desc'];
			}
			foreach($retSmr AS $rowHasSmr){
				$resultatmedtest .= "<br/><br/><b>Informations Haute Autorité de santé</b> - Service Médical Rendu :<br/>N° de dossier : ".$rowHasSmr['cis_hs_file'] . "<br/>Motivations : " . $rowHasSmr['cis_hs_motive']
				. "<br/>Date : " . $rowHasSmr['cis_hs_date']
				. "<br/>Importance : " . $rowHasSmr['cis_hs_value']. "<br/>Contenu :<br/>" . $rowHasSmr['cis_hs_desc'];
			}
			foreach($retInfosImp AS $rowInfosImp){
				$resultatmedtest .= "<br/><br/><b>Informations importantes</b> :<br/> Du ".$rowInfosImp['cis_ii_start_date'] . " au " . $rowInfosImp['cis_ii_end_date']
				. " : " . $rowInfosImp['cis_ii_desc'];
			}
			if(!empty($retHasLiens)){
				foreach($retHasLiens AS $rowLiens){
					$resultatmedtest .= "<br/><b>Liens</b> : ".$rowLiens['has_link'];
				}
			}
			$resultatmedtest .= "<hr>";
		}
	}
	else {
		$error = "Veuillez saisir au moins 3 caractères";
	}
}

require_once '../view/medicament.php';
?>
<script>
	$('#inputsearch').autocomplete({
		source : '../script/autocomplete/listeMedic.php',
		minLength : 3,
		select : function(event, ui){
			$('#description').val( ui.item.desc ); 
		}
    });
</script>