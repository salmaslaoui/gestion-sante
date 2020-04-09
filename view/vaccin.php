<?php
$titre_onglet = "Vaccins";
$titre_page = "Carnet vaccinal de NOM PHP, né le DATE PHP";
$ariane = "Accueil > Carnet vaccinal";

require_once 'header.php';
?>

<div class="data-table-area">
    <div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button id="buttonaddv" class="btn btn-success notika-btn-success waves-effect" style="display:block">Ajouter un vaccin</button>
				</br>
			</div>
			<div id="divaddv" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-example-wrap mg-t-30">
						<form action="###" method="post">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-example-int form-example-st">
										<div class="form-group">
											<label for="vaccnom" class="">Nom du vaccin</label>
											<div class="nk-int-st">
												<input id="vaccnom" type="text" class="form-control input-sm" placeholder="Nom du vaccin">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-example-int form-example-st">
										<div class="form-group">
											<label for="vaccdate" class="">Date</label>
											<div class="nk-int-st">
												<input id="vaccdate" type="text" class="form-control" data-mask="99/99/9999" placeholder="jj/mm/aaaa">
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<button type="submit" id="vaccsub" class="btn btn-success notika-btn-success waves-effect">Ajouter ce médicement</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="vacctab" class="table table-striped">
							<thead>
                                <tr>
                                    <th>Nom du vaccin</th>
                                    <th>Dernier rappel</th>
                                    <th>Prochain rappel</th>
                                    <th>Informations Générales</th>
                                    <th>Informations des rappels</th>
								</tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                             <tfoot>
                                <tr>
                                    <th>Nom du vaccin</th>
                                    <th>Dernier rappel</th>
                                    <th>Prochain rappel</th>
                                    <th>Informations Générales</th>
                                    <th>Informations des rappels</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>

<script>
$(document).ready(function(){
	$('#vacctab').DataTable();
	$("#buttonaddv").click(function(){
		$("#divaddv").toggle();
		$("#buttonaddv").toggle();
	});
});
$('#vaccdate').datepicker({
	format: 'dd/mm/yyyy'
});
</script>