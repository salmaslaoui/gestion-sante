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
				$day = whenTime($test123 , $localtime);
				
				// BLOC A PRENDRE
				if($day == "TODAY"){
					$echomed .= $nextmed['t_quantity']." ".$nextmednom." à ".$test123."</br>";
					// Il faudrait essayer de faire un truc plus joli et ordonné au niveau du temps
				}
				// BLOC PRIS
				else {
					$medpris = $nextmed['t_quantity']." ".$nextmednom." à ".$test123."</br>";
					$varid .= $nextmed['t_id'];
				}
			}
		}
	}
	else {
		$echomed .= "Aucune prise aujourd'hui";
	}
	
	// BLOC AFFICHAGE
	$echopan = "";
	$j = 0;
	$tabtag = $bddtreat->select_tag_for_1ppl($aid);
	foreach($tabtag as $rowtag){
		$aff = $bddtreat->select_treatment_for_1ppl_with_tag($aid, $rowtag['t_tag']);
		$j2 = 0;
		
		$echopan .= '
			<div class="panel panel-collapse notika-accrodion-cus">
				<div class="panel-heading" role="tab">
					<h4 class="panel-title" id="'.$rowtag['t_tag'].'">
						<a data-toggle="collapse" data-parent="#acctag1" href="#acc'.$j.'" aria-expanded="false">
							'.$rowtag['t_tag'].'
						</a>
					</h4>
				</div>
				<div id="acc'.$j.'" class="collapse" role="tabpanel">
					<div class="panel-body">
						<div class="bsc-tbl-st">
							<table id="treattab'.$j.'" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Nom du médicament</th>
										<th>Quantité</th>
										<th>Nombre de prise</th>
										<th>Horaire de prise</th>
										<th>Date de fin</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>
								</thead>
								<tbody>';
								
		foreach($aff as $aff2){
			$nommed = $bddcis->select_name_by_idcis($aff2['t_cis']);
			$echopan .='						
									<tr id="rowtab'.$j.$aff2['t_id'].'">
										<td>'.$nommed[0]['cis_name'].'</td>
										<td>'.$aff2['t_quantity'].'</td>
										<td>'.$aff2['t_number_day'].'</td>
										<td>'.$aff2['t_time'].'</td>
										<td>'.$aff2['t_end_date'].'</td>
										<td style="text-align:center;width:5%">
											<button id="medmodif'.$j.$j2.'" class="btn btn-success notika-btn-success waves-effect"><i class="fas fa-edit"></i></button>
										</td>
										<td style="text-align:center;width:5%">
											<button id="meddel'.$j.$j2.'"class="btn btn-success notika-btn-success waves-effect"><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
			';
			$j2++;
		}
									
		$echopan .= '
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">';
					
		foreach($aff as $aff2){
			$check = $bddstore->check_drugs_treatment($_SESSION['u_id'], $aff2['t_cis']);
			$nommed2 = $bddcis->select_name_by_idcis($aff2['t_cis']);
			if(!empty($check) AND $check['s_quantity'] <= 10){
				$echopan .= '<p style="color:red">ATTENTION ! Votre stock de : '.$nommed2[0]['cis_name'].' est bas ('.$check['s_quantity'].'). Passez à la pharmacie !</p>';
			}
			if(empty($check)){
				$echopan .= '<p style="color:red">ATTENTION ! Le médicament : '.$nommed2[0]['cis_name'].' n\'est pas dans votre pharmacie personnelle. Passez à la pharmacie !</p>';
			}
		}
		
		$echopan .= '				
						</br></br>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button id="medbutadd'.$j.'" class="btn btn-success notika-btn-success waves-effect" style="display:block">Ajouter un médicament à ce traitement</button>
							</br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<button id="treatbutdel'.$j.'" class="btn btn-success notika-btn-success waves-effect">Supprimer ce traitement</button>
							</br>
						</div>
						<div id="meddivadd'.$j.'" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-example-wrap mg-t-30">
									<div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="mednom'.$j.'" class="">Nom du médicament</label>
													<div class="nk-int-st">
														<input id="mednom'.$j.'" type="text" class="form-control input-sm" placeholder="Nom du médicament">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="meddatedeb'.$j.'" class="">Date de début</label>
														<div class="nk-int-st">
															<input id="meddatedeb'.$j.'" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
														</div>
													</div>
												</div>
												</br>
											</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="meddatef'.$j.'" class="">Date de fin</label>
													<div class="nk-int-st">
														<input id="meddatef'.$j.'" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
													</div>
												</div>
											</div>
											</br>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="medquan'.$j.'" class="">Quantité</label>
													<div class="nk-int-st">
														<input id="medquan'.$j.'" type="text" class="form-control input-sm" placeholder="Dosage">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="mednbjour'.$j.'" class="">Nombre de prise par jour</label>
													<div class="nk-int-st">
														<input id="mednbjour'.$j.'" type="text" class="form-control input-sm" placeholder="Nombre de prise par jour">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<div class="form-example-int form-example-st">
												<div class="form-group">
													<label for="medtime'.$j.'" class="">Heure de prise</label>
													<div class="nk-int-st">
														<input id="medtime'.$j.'" type="text" class="form-control input-sm" placeholder="Heure de prise">
													</div>
												</div>
											</div>
										</div>
										<div class="form-example-int mg-t-15">
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
												<button id="medsub'.$j.'" class="btn btn-success notika-btn-success waves-effect">Ajouter ce médicament</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</br>
				</br>
			</div>	
		';
		
		
		$j++;
	}
}	
else {
	header('Location:accueil.php');
}

require_once '../view/traitement.php';
?>

<script>
$( document ).ready(function() {
	$('#treatnom').autocomplete({
		source : '../script/autocomplete/listeMedic.php',
		minLength : 3,
		select : function(event, ui){
			$('#description').val( ui.item.desc ); 
		}
	});

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

	for(j = 0 ; j < <?php echo $j;?> ; j++){ // compteur des tabpan
		var jbis = j + 1; // Variable utilisée pour récupérer les ID des tabpans, +1 car on passe par la balise h4 et que la première du fichier est pour le bloc A PRENDRE
		var function_del_treat = 'document.getElementById("treatbutdel'+j+'").onclick = function(){ if(confirm("Voulez-vous vraiment supprimer ce traitement ?")) {var taid = <?php echo $_SESSION['a_id'];?>;var ttag = document.getElementsByTagName("h4")['+jbis+'].id;$.post("../script/treat/deltreat.php", { taid : taid, ttag : ttag},function(success){alert(success);document.location.href = "traitement.php";});}}';
		eval(function_del_treat);

		var function_add_med = 'document.getElementById("medsub'+j+'").onclick = function(){var aid = <?php echo $_SESSION['a_id'];?>;var tag = document.getElementsByTagName("h4")['+jbis+'].id;var nom = $("#mednom'+j+'").val();var dated = $("#meddatedeb'+j+'").val();var datef = $("#meddatef'+j+'").val();var quan = $("#medquan'+j+'").val();var nbjour = $("#mednbjour'+j+'").val();var time = $("#medtime'+j+'").val();if(nom){if(dated){if(validateDate(dated)){if(datef){if(validateDate(datef)){if(quan){quan = parseInt(quan);quan = Number(quan);if(!isNaN(quan)){if(nbjour){nbjour = parseInt(nbjour);nbjour = Number(nbjour);if(!isNaN(nbjour)){if(time){if(validateTime(time)){$.post("../script/treat/addmed.php", { maid : aid, mtag : tag, mnom : nom, mdated : dated, mdatef : datef, mquan : quan,  mnbjour : nbjour, mtime : time},function(success){alert(success);document.location.href = "traitement.php";});}else {alert("Veuillez renseigner les horaires approximatifs de la prise du médicament sous le format hh:mm (24h).");}}else {alert("Veuillez renseigner les horaires approximatifs de la prise du médicament.");}}else {alert("Veuillez renseigner en chiffre(s) le nombre de prise par jour du médicament..");}}else {alert("Veuillez renseigner le nombre de prise par jour du médicament.");}}else {alert("Veuillez renseigner en chiffre(s) la quantitée du médicament à prendre par prise.");}}else {alert("Veuillez renseigner la quantitée du médicament à prendre par prise.");}}else {alert("Veuillez renseigner la date de fin du traitement sous le format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date de fin du traitement.");}}else {alert("Veuillez renseigner la date de début du traitement sous le format jj/mm/aaaa.");}}else {alert("Veuillez renseigner une date de début du traitement.");}}else {alert("Veuillez renseigner le nom d\'un médicament.");};};';
		eval(function_add_med);
		
		var autocompmed = '$("#mednom'+j+'").autocomplete({source : "../script/autocomplete/listeMedic.php",minLength : 3,select : function(event, ui){$("#description").val( ui.item.desc );}});';
		eval(autocompmed);

		
		// faire les fonctions de modif et de del dans chaque tableau en fonction de $j et $j2
		// Au moment du foreach de PHP des tags mettre un compteur + déclaration à l'extérieur
		// faire un echo dans un var au début du for JS

		for(j2 = 0 ; j2 < <?php echo $j2;?> ; j2++){ // Ce système ne fonctionne pas car tous les j2 ne sont pas crés en PHP et ça bloc JS
			// test = 'document.getElementById("meddel'+j+j2+'").onclick = function(){alert("KOUKOU ON A LE PAN '+j+' ET LA LIGNE '+j2+'");};';
			// eval(test);
		};
		
	}; // fin de la boucle for des fonctions au nom dynamique
	
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