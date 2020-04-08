<?php
$titre_onglet = "Médicament";
$titre_page = "Rechercher un médicament";
$ariane = "Accueil > Médicament";

require_once 'header.php';
?>

<div class="row">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<p>
				La base de données du site est la base de données publique des médicaments.
				Celle-ci est accesible via <a href="http://base-donnees-publique.medicaments.gouv.fr/">ce lien</a> :
				<a href="http://base-donnees-publique.medicaments.gouv.fr/">http://base-donnees-publique.medicaments.gouv.fr/</a>.
				</br>
				Leur date de mise à jour est : 07/03/2020.
				(Article 12 de la loi n°78-753 du 17 juillet 1978 - loi CADA)
			</p>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form action="#" method="post">
			<h3>Rechercher un médicament ou une substance active :</h3>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
				<div class="form-example-int form-example-st">
					<div class="form-group">
						<div class="nk-int-st">
							<input name="inputsearch" id="inputsearch" type="text" class="form-control input-sm" placeholder="Rechercher un médicament">
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
				</br>
				</br>
			</div>
		</form>
	</div>
</div>

<div id="result_med" class="row">
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