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
						
			$resultatmedtest .= $row['cis_cis'] . " " . $row['cis_name']. " " . $row['cis_type']
			. " " . $row['cis_take'] ." " . $row['cis_status']." " . $row['cis_proc']
			. " " . $row['cis_comm']. " " . $row['cis_date_amm']. " " . $row['cis_status_bdm']
			. " " . $row['cis_ue_number']. " " . $row['cis_lab']. " " . $row['cis_watch'];

			foreach($retCip AS $rowCip){
				$resultatmedtest .= $rowCip['cis_cip_cip7'] . " " . $rowCip['cis_cip_name']. " " . $rowCip['cis_cip_admin']
				. " " . $rowCip['cis_cip_comm'] ." " . $rowCip['cis_cip_date']." " . $rowCip['cis_cip_cip13']
				. " " . $rowCip['cis_cip_community']. " " . $rowCip['cis_cip_refund']. " " . $rowCip['cis_cip_price']
				. " " . $rowCip['cis_cip_price2']. " " . $rowCip['cis_cip_price3']. " " . $rowCip['cis_cip_law'];
			}
			foreach($retCompo AS $rowCompo){
				$resultatmedtest .= $rowCompo['cis_comp_type'] . " " . $rowCompo['cis_comp_code']. " " . $rowCompo['cis_comp_sub']
				. " " . $rowCompo['cis_comp_dosage']. " " . $rowCompo['cis_comp_ref']
				. " " . $rowCompo['cis_comp_nature']. " " . $rowCompo['cis_comp_link_number']
				. " " . $rowCompo['cis_comp_col9'];
			}
			foreach($retGener AS $rowGener){
				$resultatmedtest .= $rowGener['cis_gen_name'] . " " . $rowGener['cis_gen_cis']. " " . $rowGener['cis_gen_type']
				. " " . $rowGener['cis_gen_sort']. " " . $rowGener['cis_gen_col6'];
			}
			foreach($retCpd AS $rowCpd){
				$resultatmedtest .= $rowCpd['cis_cpd_cond'];
			}
			foreach($retAsmr AS $rowHasAsmr){
				$resultatmedtest .= $rowHasAsmr['cis_ha_file'] . " " . $rowHasAsmr['cis_ha_motive']
				. " " . $rowHasAsmr['cis_ha_date']
				. " " . $rowHasAsmr['cis_ha_value']. " " . $rowHasAsmr['cis_ha_desc'];
			}
			foreach($retSmr AS $rowHasSmr){
				$resultatmedtest .= $rowHasSmr['cis_hs_file'] . " " . $rowHasSmr['cis_hs_motive']
				. " " . $rowHasSmr['cis_hs_date']
				. " " . $rowHasSmr['cis_hs_value']. " " . $rowHasSmr['cis_hs_desc'];
			}
			foreach($retInfosImp AS $rowInfosImp){
				$resultatmedtest .= $rowInfosImp['cis_ii_start_date'] . " " . $rowInfosImp['cis_ii_end_date']
				. " " . $rowInfosImp['cis_ii_desc'];
			}
			if(!empty($retHasLiens)){
				foreach($retHasLiens AS $rowLiens){
					$resultatmedtest .= $rowLiens['has_link'];
				}
			}
		}
	}
}
else {
	$error = "Veuillez saisir au moins 3 caractères";
}


require_once '../view/medicament.php';
?>