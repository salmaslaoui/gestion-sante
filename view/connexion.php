<?php
$titre_onglet = "Se connecter";
$titre_page = "";
$ariane = "";

require_once 'header.php';
?>

<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<!-- Login Register area Start-->
    <div style="text-align: center;margin-bottom: 60px">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <form action="###" method="post">
				<div class="nk-form">
					<div class="input-group">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
						<div class="nk-int-st">
							<input type="text" class="form-control" placeholder="Nom de compte">
						</div>
					</div>
					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
						<div class="nk-int-st">
							<input type="password" class="form-control" placeholder="Mot de passe">
						</div>
					</div>
					<button type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
				</div>
			</form>
            <div class="nk-navigation nk-lg-ic">
                <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#l-register" style="background-color:#00c292"><i style="color:white" class="fas fa-plus"></i><span>S'inscrire</span></a>
                <a href="#l-forget-password" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password" style="background-color:#00c292"><i>?</i><span>Password oublié</span></a>
            </div>
        </div>

        <!-- Register -->
        <div class="nk-block" id="l-register">
			<form action="###" method="post">
				<div class="nk-form">
					<div class="input-group">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
						<div class="nk-int-st">
							<input type="text" class="form-control" placeholder="Nom de compte">
						</div>
					</div>
					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
						<div class="nk-int-st">
							<input type="text" class="form-control" placeholder="Adresse email">
						</div>
					</div>

					<div class="input-group mg-t-15">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
						<div class="nk-int-st">
							<input type="password" class="form-control" placeholder="Mot de passe">
						</div>
					</div>
					<button type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
				</div>
			</form>
            <div class="nk-navigation rg-ic-stl">
                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" style="background-color:#00c292"><i style="color:white" class="fas fa-sign-in-alt"></i><span>Connexion</span></a>
                <a href="#l-forget-password" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password" style="background-color:#00c292"><i>?</i> <span>Password oublié</span></a>
            </div>
        </div>

        <!-- Forgot Password -->
        <div class="nk-block" id="l-forget-password">
			<form action="###" method="post">
				<div class="nk-form">
					<p class="text-left">Pour récupérer un mot de passe temporaire, veuillez saisir votre adresse mail ci-dessous.</p>

					<div class="input-group">
						<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
						<div class="nk-int-st">
							<input type="text" class="form-control" placeholder="Adresse Email">
						</div>
					</div>

					<button type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
				</div>
			</form>
            <div class="nk-navigation nk-lg-ic rg-ic-stl">
                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" style="background-color:#00c292"><i style="color:white" class="fas fa-sign-in-alt"></i><span>Connexion   </span></a>
                <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#l-register" style="background-color:#00c292"><i style="color:white" class="fas fa-plus"></i><span>S'inscrire</span></a>
            </div>
        </div>
    </div>
<!-- Login Register area End-->

<?php
require_once 'footer.php';
?>