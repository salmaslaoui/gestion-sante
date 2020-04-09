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
		$resultatmedtest = 1;
	}
	else {
		$error = "Veuillez saisir au moins 3 caractères";
	}
}

require_once '../view/medicament.php';
?>