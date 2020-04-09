<?php
require_once 'header.php';
?>

<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<!-- Login Register area Start-->
    <div style="text-align: center;margin-bottom: 60px">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
			<div class="nk-form">
				<div class="input-group">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
					<div class="nk-int-st">
						<input id="luser" type="text" class="form-control" placeholder="Nom de compte" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
					<div class="nk-int-st">
						<input id="lpass" type="password" class="form-control" placeholder="Mot de passe" required>
					</div>
				</div>
				<button id="lsub" type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
			</div>
            <div class="nk-navigation nk-lg-ic">
                <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#l-register" style="background-color:#00c292"><i style="color:white" class="fas fa-plus"></i><span>S'inscrire</span></a>
                <a href="#l-forget-password" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password" style="background-color:#00c292"><i>?</i><span>Password oublié</span></a>
            </div>
        </div>

        <!-- Register -->
        <div class="nk-block" id="l-register">
			<div class="nk-form">
				<div class="input-group">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
					<div class="nk-int-st">
						<input id="ruser" type="text" class="form-control" placeholder="Nom de compte" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail" ></i></span>
					<div class="nk-int-st">
						<input id="rmail" type="text" class="form-control" placeholder="Adresse email" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
					<div class="nk-int-st">
						<input id="rpass" type="password" class="form-control" placeholder="Mot de passe" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
					<div class="nk-int-st">
						<input id="rpass2" type="password" class="form-control" placeholder="Confirmer le mot de passe" required>
					</div>
				</div>
				</br>
				</br>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
					<div class="nk-int-st">
						<input id="rpre" type="text" class="form-control" placeholder="Prénom" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
					<div class="nk-int-st">
						<input id="rname" type="text" class="form-control" placeholder="Nom" required>
					</div>
				</div>
				<div class="input-group mg-t-15">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail" required></i></span>
					<div class="nk-int-st">
						<input id="rdate" type="text" class="form-control" data-mask="99/99/9999" placeholder="Date de naissance (jj/mm/aaaa)">
					</div>
				</div>
				<button id="rsub" type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
			</div>
            <div class="nk-navigation rg-ic-stl">
                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" style="background-color:#00c292"><i style="color:white" class="fas fa-sign-in-alt"></i><span>Connexion</span></a>
                <a href="#l-forget-password" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password" style="background-color:#00c292"><i>?</i> <span>Password oublié</span></a>
            </div>
        </div>

        <!-- Forgot Password -->
        <div class="nk-block" id="l-forget-password">
			<div class="nk-form">
				<p class="text-left">Pour récupérer un mot de passe temporaire, veuillez saisir votre adresse mail ci-dessous.</p>
				<div class="input-group">
					<span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
					<div class="nk-int-st">
						<input id="pmail" type="text" class="form-control" placeholder="Adresse Email" required>
					</div>
				</div>
				<button id="psub" type="submit" class="btn btn-login btn-success btn-float" style="background-color:#00c292"><i style="color:white" class="fas fa-arrow-right"></i></button>
			</div>
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