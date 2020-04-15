<?php
require_once 'header.php';
?>

<div class="widget-tabs-int">
	<div class="widget-tabs-list">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home" aria-expanded="false">Compte</a></li>
			<?php
				echo $echotitlepan;
			?>
			<li class=""><a data-toggle="tab" href="#addp" aria-expanded="false">Ajouter</a></li>
		</ul>
		</br>
		<div class="tab-content tab-custom-st">
			<div id="home" class="tab-pane active in">
				<div class="tab-ctn">
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifnomc" class="hrzn-fm">Nom de compte</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifnomc" type="text" class="form-control input-sm" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifpassc" class="hrzn-fm">Mot de passe</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifpassc" type="password" class="form-control input-sm" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int form-horizental" style="display:none" id="blocConfirMdp">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifpassc2" class="hrzn-fm">Confirmation du mot de passe</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifpassc2" type="password" class="form-control input-sm" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifadrc" class="hrzn-fm">Adresse e-mail</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifadrc" type="text" class="form-control input-sm" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int mg-t-15">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<button id="ifmodifc" class="btn btn-success notika-btn-success waves-effect">Modifier</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<button id="ifsuppc" class="btn btn-success notika-btn-success waves-effect">Supprimer mon compte</button>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				echo $echotabpan;
			?>
			<div id="addp" class="tab-pane">
				<div class="tab-ctn">
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifprea" class="hrzn-fm">Prénom</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifprea" type="text" class="form-control input-sm">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifnoma" class="hrzn-fm">Nom</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifnoma" type="text" class="form-control input-sm">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int form-horizental">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
									<label for="ifdatea" class="hrzn-fm">Date de naissance</label>
								</div>
								<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
									<div class="nk-int-st">
										<input id="ifdatea" type="text" class="form-control input-sm" data-mask="99/99/9999">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-example-int mg-t-15">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<button id="ifadd" class="btn btn-success notika-btn-success waves-effect">Ajouter</button>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							</div>
						</div>
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
$('#ifdatea').datepicker({
	dateFormat: 'dd/mm/yy'
});
</script>