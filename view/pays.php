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
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
					<div class="form-example-int form-example-st">
						<div class="form-group">
							<div class="nk-int-st">
								<input type="text" class="form-control input-sm" placeholder="Rechercher un pays">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-3 col-xs-2">
					<div class="form-example-int">
						<button id="buttonsearch" class="btn btn-success notika-btn-success waves-effect">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="result_pays" class="row" style="display:none">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php
				echo $resultat;
				// Faire un super tableau de présentation de la BDD
			?>
			</br>
			</br>
		</div>
	</div>
	
<?php
require_once 'footer.php';
?>

<script>
$(document).ready(function(){
	$("#buttonsearch").click(function(){
		$("#result_pays").toggle();
	});
});
</script>