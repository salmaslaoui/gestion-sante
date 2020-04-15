<?php
require_once 'header.php';
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<h4>Prochain(s) médicament(s) à prendre aujourd'hui :</h4>
		<?php
		echo $echomed;
		if(!empty($medpris)){
			echo '<hr>',$medpris,
			'<div class="form-example-int mg-t-15">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<button id="treatpris" class="btn btn-success notika-btn-success waves-effect">J\'ai bien pris mon traitement</button>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<button id="treatppris" class="btn btn-success notika-btn-success waves-effect">Non, je ne l\'ai pas pris</button>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
					</div>
				</div>
			</div>
			';
		}?>
		</br>
		</br>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<button id="treatbutadd" class="btn btn-success notika-btn-success waves-effect" style="display:block">Ajouter un nouveau traitement</button>
			</br>
		</div>
		<div id="treatdivadd" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-example-wrap mg-t-30">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treattag" class="">Matricule du traitement</label>
									<div class="nk-int-st">
										<input id="treattag" type="text" class="form-control input-sm" placeholder="Matricule du traitement" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treatnom" class="">Nom du médicament</label>
									<div class="nk-int-st">
										<input id="treatnom" type="text" class="form-control input-sm" placeholder="Nom du médicament" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treatdatedeb" class="">Date de début</label>
									<div class="nk-int-st">
										<input id="treatdatedeb" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa" required>
									</div>
								</div>
							</div>
							</br>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treatdatef" class="">Date de fin</label>
									<div class="nk-int-st">
										<input id="treatdatef" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa" required>
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
									<label for="treatquan" class="">Quantité</label>
									<div class="nk-int-st">
										<input id="treatquan" type="text" class="form-control input-sm" placeholder="Quantité par prise" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treatnbjour" class="">Nombre de prise par jour</label>
									<div class="nk-int-st">
										<input id="treatnbjour" type="text" class="form-control input-sm" placeholder="Nombre de prise par jour" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="treattime" class="">Heure de prise</label>
									<div class="nk-int-st">
										<input id="treattime" type="text" class="form-control input-sm" placeholder="Heure de prise" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-example-int mg-t-15">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<button id="treataddsub" class="btn btn-success notika-btn-success waves-effect">Ajouter ce traitement</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="accordion-stn">
				<div class="panel-group" data-collapse-color="nk-green" id="acctag1" role="tablist" aria-multiselectable="true">
					<?php
						echo $echopan;
					?>
				</div>
			</div>
		</div>
		</br>
	</div>
</div>


<?php
require_once 'footer.php';
?>

<script>
$(document).ready(function(){

	$("#treatbutadd").click(function(){
		$("#treatdivadd").toggle();
		$("#treatbutadd").toggle();
	});
	
	for(k = 0 ; k < <?php echo $j;?> ; k++){ // changer à 0
		$('#treattab'+k+'').DataTable();
		$('#meddatedeb'+k+'').datepicker({
			dateFormat: 'dd/mm/yy'
		});
		$('#meddatef'+k+'').datepicker({
			dateFormat: 'dd/mm/yy'
		});
		
		var function_toggle = '$("#medbutadd'+k+'").click(function(){ $("#meddivadd'+k+'").toggle(); $("#medbutadd'+k+'").toggle();});';
		eval(function_toggle);
	}



	/* Boucle JS pour les Datatables
	#treatpris
	#treatppris
	
	#medmodif1 - modif med dans table - récup avec le row.data() + faire un id composé (id tag + id med de la table)
	#medsupp1 - supp med dans table - récup avec le row.data() + faire un id composé (id tag + id med de la table)*/
});

$('#treatdatedeb').datepicker({
	dateFormat: 'dd/mm/yy'
});
$('#treatdatef').datepicker({
	dateFormat: 'dd/mm/yy'
});
</script>