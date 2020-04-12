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
										<input id="treatquan" type="text" class="form-control input-sm" placeholder="Dosage" required>
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
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="accordion-stn">
				<div class="panel-group" data-collapse-color="nk-green" id="acctag1" role="tablist" aria-multiselectable="true">
					<div class="panel panel-collapse notika-accrodion-cus">
						<div class="panel-heading" role="tab">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#acctag1" href="#acc1" aria-expanded="false">
									<?php echo "TAG PHP"; ?>
								</a>
							</h4>
						</div>
						<div id="acc1" class="collapse in" role="tabpanel">
							<div class="panel-body">
								<div class="bsc-tbl-st">
									<table id="treattab1" class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Nom du médicament</th>
												<th>Quantité</th>
												<th>Nombre de prise</th>
												<th>Horaire de prise</th>
												<th>Date de fin</th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td><?php echo "QUANT + TYPE";?></td>
												<td></td>
												<td></td>
												<td></td>
												<td style="text-align:center;width:5%">
													<button id="medmodif1" class="btn btn-success notika-btn-success waves-effect"><i class="fas fa-edit"></i></button>
												</td>
												<td style="text-align:center;width:5%">
													<button id="medsupp1"class="btn btn-success notika-btn-success waves-effect"><i class="fas fa-trash-alt"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<?php echo "TEST IF IL Y A ASSEZ DE MEDOCS DANS LA PHARMACIE + ALERTE",
								"</br></br>";?>
							</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
									<button id="medbutadd1" class="btn btn-success notika-btn-success waves-effect" style="display:block">Ajouter un médicament à ce traitement</button>
									</br>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
									<button id="treatbutdel1" class="btn btn-success notika-btn-success waves-effect">Supprimer ce traitement</button>
									</br>
								</div>
								<div id="meddivadd1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-example-wrap mg-t-30">
											<div class="row">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-example-int form-example-st">
														<div class="form-group">
															<label for="mednom1" class="">Nom du médicament</label>
															<div class="nk-int-st">
																<input id="mednom1" type="text" class="form-control input-sm" placeholder="Nom du médicament">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-example-int form-example-st">
														<div class="form-group">
															<label for="meddatedeb1" class="">Date de début</label>
																<div class="nk-int-st">
																	<input id="meddatedeb1" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
																</div>
															</div>
														</div>
														</br>
													</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-example-int form-example-st">
														<div class="form-group">
															<label for="meddatef1" class="">Date de fin</label>
															<div class="nk-int-st">
																<input id="meddatef1" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
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
															<label for="medquan1" class="">Quantité</label>
															<div class="nk-int-st">
																<input id="medquan1" type="text" class="form-control input-sm" placeholder="Dosage">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-example-int form-example-st">
														<div class="form-group">
															<label for="mednbjour1" class="">Nombre de prise par jour</label>
															<div class="nk-int-st">
																<input id="mednbjour1" type="text" class="form-control input-sm" placeholder="Nombre de prise par jour">
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-example-int form-example-st">
														<div class="form-group">
															<label for="medtime1" class="">Heure de prise</label>
															<div class="nk-int-st">
																<input id="medtime1" type="text" class="form-control input-sm" placeholder="Heure de prise">
															</div>
														</div>
													</div>
												</div>
												<div class="form-example-int mg-t-15">
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
														<button id="medsub1" class="btn btn-success notika-btn-success waves-effect">Ajouter ce médicament</button>
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
<?php $i = 1 ?>; // à supprimer à la fin du bordel compteur des tab pan
$(document).ready(function(){

	$("#treatbutadd").click(function(){
		$("#treatdivadd").toggle();
		$("#treatbutadd").toggle();
	});
	
	for(k = 1 ; k <= <?php echo $i;?> ; k++){ // changer à 0
		$('#treattab'+k+'').DataTable();
		$('#meddatedeb'+k+'').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('#meddatef'+k+'').datepicker({
			format: 'dd/mm/yyyy'
		});
		
		var function_toggle = '$("#medbutadd'+k+'").click(function(){ $("#meddivadd'+k+'").toggle(); $("#medbutadd'+k+'").toggle();});';
		eval(function_toggle);
	}



	/* Boucle JS pour les Datatables
	#treatpris
	#treatppris
	
	#medmodif1 - modif med dans table - récup avec le row.data() + faire un id composé (id tag + id med de la table)
	#medsupp1 - supp med dans table - récup avec le row.data() + faire un id composé (id tag + id med de la table)
	
	
	
	
	#treatbutadd DONE
	#treatdivadd DONE
	
	Ajout d'un taitement : BLOC DONE
	#treattag
	#treatnom
	#treatdatedeb
	#treatdatef
	#treatquan
	#treatnbjour
	#treattime
	#treataddsub
	
	#treattab1 DONE

	#medbutadd1 DONE
	#treatbutdel1 DONE
	#meddivadd1 DONE
	
	Ajout d'un médicament dans la table : BLOC DONE
	#mednom1
	#meddatedeb1
	#meddatef1
	#medquan1
	#mednbjour1
	#medtime1
	#medsub1*/
});

$('#treatdatedeb').datepicker({
	format: 'dd/mm/yyyy'
});
$('#treatdatef').datepicker({
	format: 'dd/mm/yyyy'
});
</script>