<?php
$titre_onglet = "Je voyage";
$titre_page = "Quel vaccins pour l'étranger ?";
$ariane = "Accueil";

require_once 'header.php';
?>

    <!-- Google Map area End-->
    <div class="data-map-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-map-single">
                        <div id="basic_map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Google Map area End-->
	
	<div class="row">
		<div class="form-example-wrap mg-t-30">
			<div class="cmp-tb-hd cmp-int-hd">
				<h2>Rechercher un pays</h2>
			</div>
			<div class="row">
				<form action="#" method="post">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
						<div class="form-example-int form-example-st">
							<div class="form-group">
								<div class="nk-int-st">
									<input name="inputsearch" id="inputsearch" type="text" class="form-control input-sm" placeholder="Rechercher un pays">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-3 col-xs-2">
						<div class="form-example-int">
							<button name="buttonsearch" id="buttonsearch" class="btn btn-success notika-btn-success waves-effect">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="result_pays" class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php
				if(isset($resultatpaystest)){
					echo "<h3>Résultats pour votre recherche : ".$var."</h3>";
					foreach($ret1 AS $row){
						$id_row = $row['c_id'];
						$ret2 = $var3->select_vaccines_for_1countrie($id_row);
						foreach($ret2 AS $row2) {
							if(!empty($ret2['j_vid'])){
								$id_row2 = $row2['j_vid'];
								$table='vaccines';
								$ret3 = $tableVaccins->select_all_with_id($table,$id_row2);
								echo "Liste des vaccins pour le pays ",$ret1['c_name_fr'], " :";
								foreach($ret3 AS $row3){
									echo $row3['v_name'] . " " . $row3['v_disease']. " " . $row3['v_type']. " " . $row3['v_date'];
								}
							}
							else {
								$error = "Aucune correspondance pour les vaccins trouvée dans la base de données.";
							}
						}
					}
				}
				if(isset($error) && !empty($error)){
					echo '<div style="color:red">',$error,'</div>';
				}
			?>
			</br>
			</br>
		</div>
	</div>
	
<?php
require_once 'footer.php';
?>