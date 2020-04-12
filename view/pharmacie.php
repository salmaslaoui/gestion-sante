<?php
require_once 'header.php';
?>

<div class="data-table-area">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<button id="buttonadd" class="btn btn-success notika-btn-success waves-effect" style="display:block">Ajouter un médicament à ma pharmacie</button>
			</br>
		</div>
		<div id="divadd" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-example-wrap mg-t-30">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phanom" class="">Nom</label>
									<div class="nk-int-st">
										<input id="phanom" type="text" class="form-control input-sm" placeholder="Nom du médicament">
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phados" class="">Dosage</label>
									<div class="nk-int-st">
										<input id="phados" type="text" class="form-control input-sm" placeholder="Dosage">
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phaexp" class="">Expiration</label>
									<div class="nk-int-st">
										<input id="phaexp" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
									</div>
								</div>
							</div>
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phaquan" class="">Quantité</label>
										<div class="nk-int-st">
										<input id="phaquan" type="text" class="form-control input-sm" placeholder="Quantité">
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phalot" class="">N° Lot</label>
									<div class="nk-int-st">
										<input id="phalot" type="text" class="form-control input-sm" placeholder="N° de lot">
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-example-int form-example-st">
								<div class="form-group">
									<label for="phacip" class="">CIP</label>
									<div class="nk-int-st">
										<input id="phacip" type="text" class="form-control input-sm" placeholder="N° CIP">
									</div>
								</div>
							</div>
						</div>
					</div>
					</br>
					<div class="form-example-int mg-t-15">
						<div class="row">
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<button type="submit" id="phasub" class="btn btn-success notika-btn-success waves-effect">Ajouter ce médicement</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="data-table-list">
					<div class="table-responsive">
						<table id="pharmatab" class="table table-striped dataTable">
							<thead>
								<tr role="row">
									<th class="sorting" tabindex="0" aria-controls="data-table-basic" rowspan="1" colspan="1" aria-label=" NOM : activate to sort column descending">Nom</th>
									<th class="sorting_asc" tabindex="0" aria-controls="data-table-basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" EXP : activate to sort column ascending"> Expiration</th>
									<th class="sorting" tabindex="0" aria-controls="data-table-basic" rowspan="1" colspan="1" aria-label=" QUANTITE DE BOITE : activate to sort column ascending"> Quantité </th>
									<th class="sorting" tabindex="0" aria-controls="data-table-basic" rowspan="1" colspan="1" aria-label=" LOT : activate to sort column ascending">Lot</th>
									<th class="sorting" tabindex="0" aria-controls="data-table-basic" rowspan="1" colspan="1" aria-label=" CIP : activate to sort column ascending">CIP</th>
									<th>Modifier</th>
									<th>Supprimer</th>
								</tr>
							</thead>
								<?php
									echo $echotabpharma;
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>Nom</th>
									<th>Expiration</th>
									<th>Quantité</th>
									<th>Lot</th>
									<th>CIP 13</th>
									<th>Modifier</th>
									<th>Supprimer</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
        </div>
		<?php
			if(isset($echomodpha)){
				echo $echomodpha;
			}
		?>
    </div>
</div>

<?php
require_once 'footer.php';
?>

<script>
$(document).ready(function(){
	$('#pharmatab').DataTable();
	$("#buttonadd").click(function(){
		$("#divadd").toggle();
		$("#buttonadd").toggle();
	});
});
$('#phaexp').datepicker({
	format: 'dd/mm/yyyy'
});
</script>