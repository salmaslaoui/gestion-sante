<?php
session_start();

require_once '../model/users.class.php';
require_once '../model/storages.class.php';
require_once '../model/cis_bdpm.class.php';
require_once '../model/cis_cip_bdpm.class.php';
require_once '../script/function.php';

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

$titre_onglet = "Pharmacie";
$titre_page = "Pharmacie pour l'utilisateur ".$_SESSION['u_name'];
$ariane = "<a href='accueil.php'>Accueil</a> > Pharmacie";

$tableStorages = new ManagementBddStorages($database);
$tableCis = new ManagementBddCisBdpm($database);
$tableCip = new ManagementBddCisCipBdpm($database);

if(isset($_SESSION['u_id'])){
	$idusers = $_SESSION['u_id'];
	$rsu = $tableStorages->select_storage_with_uid($idusers);
	$j = 0;
	$echotabpharma = "";
	$echomodpha = "";
	foreach($rsu AS $rowStorage) {
		$cis = $tableCis->select_cis_by_idcis($rowStorage['s_cis']);
		$cip = $tableCip->select_cis_cip_by_idcis($cis[0]['cis_cis']);
		$style = "";
		if($rowStorage['s_quantity'] == 0){
			$style = 'style="color:red"';
		}
		$echotabpharma .= '
			<tr id="icmed'.$rowStorage['s_id'].'">
				<td id="nom'.$j.'" '.$style.'>'.$cis[0]['cis_name'].'</td>
				<td id="exp'.$j.'" '.$style.'>'.formatDateFR($rowStorage['s_date']).'</td>
				<td id="quan'.$j.'" '.$style.'>'.$rowStorage['s_quantity'].'</td>
				<td id="lot'.$j.'" '.$style.'>'.$rowStorage['s_bundle'].'</td>
				<td id="cip'.$j.'" '.$style.'>'.$cip[0]['cis_cip_cip13'].'</td> 
				<td style="text-align:center;width:5%">
					<button id="pharmamodif'.$j.'" class="btn btn-success notika-btn-success waves-effect">
						<i class="fas fa-edit"></i>
					</button>
				</td>
				<td style="text-align:center;width:5%">
					<button  id="pharmasupp'.$j.'" class="btn btn-success notika-btn-success waves-effect">
						<i class="fas fa-trash-alt"></i>
					</button>
				</td>
			</tr>
		';
		$echomodpha .= '
			<div id="divphamod'.$j.'" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
				<h4 id="immed'.$rowStorage['s_id'].'"> Modifier le médicament : '.$cis[0]['cis_name'].'</h4>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-example-wrap mg-t-30">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<div class="form-example-int form-example-st">
									<div class="form-group">
										<label for="phamodexp'.$j.'" class="">Expiration</label>
										<div class="nk-int-st">
											<input id="phamodexp'.$j.'" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<div class="form-example-int form-example-st">
									<div class="form-group">
										<label for="phamodquan'.$j.'" class="">Quantité</label>
										<div class="nk-int-st">
											<input id="phamodquan'.$j.'" type="text" class="form-control input-sm" placeholder="Quantité">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<div class="form-example-int form-example-st">
									<div class="form-group">
										<label for="phamodlot'.$j.'" class="">N° Lot</label>
										<div class="nk-int-st">
											<input id="phamodlot'.$j.'" type="text" class="form-control input-sm" placeholder="N° de lot">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<button type="submit" id="phamodsub'.$j.'" class="btn btn-success notika-btn-success waves-effect">Modifier</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		';
		
		$j++;
	}
}
else {
	header('Location:connexion.php');
}

require_once '../view/pharmacie.php';
?>

<script>
$(document).ready(function() {
	$('#phanom').autocomplete({
		source : '../script/autocomplete/listeMedic.php',
		minLength : 3,
		select : function(event, ui){
			$('#description').val( ui.item.desc ); 
		}
    });
	
    document.getElementById('phasub').onclick = function(){
		var resNomP = document.getElementById('phanom').value;
		var resDosP = document.getElementById('phados').value;
		var resExpP = document.getElementById('phaexp').value;
		var resQuanP = document.getElementById('phaquan').value;
		var resLotP = document.getElementById('phalot').value;
		var resCipP = document.getElementById('phacip').value;

		if(resNomP){
			if(resDosP){
				if(validateDate(resExpP)){
					if(resQuanP){
						if(resLotP) {
							if(resCipP){
								var idu = <?php echo $_SESSION['u_id'] ?>;
								$.post("../script/pharma/addmedic.php", { cidu : idu, cnomp : resNomP, cdosp : resDosP, cexp : resExpP, cqup : resQuanP, clotp : resLotP, ccipp : resCipP},
									function(success){
										alert(success);
										document.location.href = "pharmacie.php";
									}
								);
							}
							else {
								alert("Veuillez renseigner un numéro de CIP.");
							}
						}
						else {
							alert("Veuillez renseigner un numéro de lot.");
						}
					}
					else {
						alert("Veuillez renseigner une quantité.");
					}
				}
				else {
					alert("Veuillez renseigner une date d'expiration valide.");
				}
			}
			else {
				alert("Veuillez renseigner le dosage.");
			}
		}
		else {
			alert("Veuillez renseigner le nom du médicament.");
		}
    }

	for(i = 0 ; i < <?php echo $j;?> ; i++){
		$('#phamodexp'+i+'').datepicker({
			dateFormat: 'dd/mm/yy'
		});
		
		function_toggle_modif = '$("#pharmamodif'+i+'").click(function(){$("#divphamod'+i+'").toggle();});';
		eval(function_toggle_modif);
		
		function_modif_med = 'document.getElementById("phamodsub'+i+'").onclick = function(){var resExpP = document.getElementById("phamodexp'+i+'").value;var resQuanP = document.getElementById("phamodquan'+i+'").value;var resLotP = document.getElementById("phamodlot'+i+'").value;if(resExpP){if(validateDate(resExpP)){if(resQuanP){if(resLotP) {var str = document.getElementsByTagName("h4")['+i+'].id;var idu = str.substring(5);$.post("../script/pharma/modifmedic.php", { cidu : idu, cexp : resExpP, cqup : resQuanP, clotp : resLotP},function(success){alert(success);document.location.href = "pharmacie.php";});}else {alert("Veuillez renseigner un numéro de lot.");}}else {alert("Veuillez renseigner une nouvelle quantité.");}}else {alert("Veuillez renseigner une nouvelle date d\'expiration valide au format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date d\'expiration.");}}';
		eval(function_modif_med);
		
		function_del_med = 'document.getElementById("pharmasupp'+i+'").onclick = function(){if(confirm("Voulez-vous vraiment supprimer ce médicament de la pharmacie ?")){var str = document.getElementsByTagName("tr")['+i+'].id;var id_sto = str.substring(5);$.post("../script/pharma/suppressionmedic.php", { ids : id_sto },function(success){alert(success);document.location.href = "pharmacie.php";});}}';
		eval(function_del_med);
	}
});
</script>