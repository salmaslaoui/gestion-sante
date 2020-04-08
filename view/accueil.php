<?php
$titre_onglet = "Accueil";
$titre_page = "";
$ariane = "";

require_once 'header.php';
?>

<?php
if(isset($alerte)){
	echo '<div class="row">
	   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div style="border-style:dashed;border-color:red;text-align:center;color:red">
				<!-- Penser à faire une fonction PHP + un display none selon les besoins -->
				<h2>', $alerte_title,'</h2>
				<p>',
					$alerte_text,
				'</p>
			</div>
		</div>
	</div>
	</br>';
}
?>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:unset">
		<img src="../img/menu1.jpg" alt="menu" style="max-width: 100%">
		<div style="text-align:center;position:inherit;bottom:100px;">
			<a href="../controller/medicament.php">
				<button class="btn btn-success notika-btn-success waves-effect">
					Rechercher un médicament
				</button>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:unset">
		<img src="../img/menu2.jpg" alt="menu" style="max-width: 100%">
		<div style="text-align:center;position:inherit;bottom:100px;">
			<a href="../controller/pays.php">
				<button class="btn btn-success notika-btn-success waves-effect">
					Je pars en voyage
				</button>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:unset">
		<img src="../img/menu3.jpg" alt="menu" style="max-width: 100%">
		<div style="text-align:center;position:inherit;bottom:100px;">
			<?php
			if(isset($_SESSION['u_id'])) {
				echo '<a href="../controller/information.php">
					<button class="btn btn-success notika-btn-success waves-effect">
						Accéder à mon compte
					</button>
				</a>';
			}
			else {
				echo '<a href="../controller/connexion.php?action=inscription">
					<button class="btn btn-success notika-btn-success waves-effect">
						Je m\'inscris
					</button>
				</a>';
			}
			?>
		</div>
	</div>
</div>
<hr>
<div class="row" id="contact">
	<div class="container">
		<h3>Une question ou une remarque ? Contactez-nous !</h3>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-example-wrap mg-t-30">
				<div class="form-example-int form-horizental mg-t-15">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="nomcontact" class="hrzn-fm">Votre nom</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="nomcontact"type="text" class="form-control input-sm" placeholder="Nom">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int form-horizental">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label class="hrzn-fm" for="addmailcontact">Votre adresse mail</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="addmailcontact" type="text" class="form-control input-sm" placeholder="Email" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int form-horizental mg-t-15">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="sujetcontact" class="hrzn-fm">Objet</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<input id="sujetcontact" type="text" class="form-control input-sm" placeholder="Objet du message">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int form-horizental mg-t-15">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
								<label for="msgcontact" class="hrzn-fm">Votre message</label>
							</div>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<div class="nk-int-st">
									<textarea type="text" id="msgcontact" name="message" rows="5" class="form-control md-textarea" placeholder="Votre message" required></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-example-int mg-t-15">
					<div class="row">
						<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
						</div>
						<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
							<button id="subcontact" class="btn btn-success notika-btn-success waves-effect">Envoyer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row" id="qui">
	<div class="container">
		<h3>Qui sommes-nous ?</h3>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="contact-list">
					<div class="contact-win">
						<div class="contact-img">
							<img src="../img/pingu.png" alt="">
						</div>
						<div class="conct-sc-ic">
							<a class="btn waves-effect" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-pinterest-p"></i></a>
						</div>
					</div>
					<div class="contact-ctn">
						<div class="contact-ad-hd">
							<h2>Béatrice Commandeur</h2>
							<p class="ctn-ads">Bordeaux, France</p>
						</div>
						<p>Je suis un texte de présentation.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="contact-list sm-res-mg-t-30">
					<div class="contact-win">
						<div class="contact-img">
							<img src="../img/pingu.png" alt="">
						</div>
						<div class="conct-sc-ic">
							<a class="btn waves-effect" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-pinterest-p"></i></a>
						</div>
					</div>
					<div class="contact-ctn">
						<div class="contact-ad-hd">
							<h2>Quentin Jollivet-Castelot</h2>
							<p class="ctn-ads">Bordeaux, France</p>
						</div>
						<p>Je suis un texte de présentation.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="contact-list sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
					<div class="contact-win">
						<div class="contact-img">
							<img src="../img/pingu.png" alt="">
						</div>
						<div class="conct-sc-ic">
							<a class="btn waves-effect" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-pinterest-p"></i></a>
						</div>
					</div>
					<div class="contact-ctn">
						<div class="contact-ad-hd">
							<h2>Rabeb Ben Amara</h2>
							<p class="ctn-ads">Bordeaux, France</p>
						</div>
						<p>Je suis un texte de présentation.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="contact-list sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
					<div class="contact-win">
						<div class="contact-img">
							<img src="../img/pingu.png" alt="">
						</div>
						<div class="conct-sc-ic">
							<a class="btn waves-effect" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn waves-effect" href="#"><i class="fab fa-pinterest-p"></i></a>
						</div>
					</div>
					<div class="contact-ctn">
						<div class="contact-ad-hd">
							<h2>Salma Slaoui Andaloussi</h2>
							<p class="ctn-ads">Bordeaux, France</p>
						</div>
						<p>Je suis un texte de présentation.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once 'footer.php';
?>