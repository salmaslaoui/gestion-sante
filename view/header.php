<?php
require_once "../model/accounts.class.php";

if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])){
	$bddacc = new ManagementBddAccounts($database);
	$retmenu = $bddacc->select_account_with_user_id($_SESSION['u_id']);
	$url = $_SERVER['PHP_SELF'];

	if(isset($_GET['change']) && !empty($_GET['change'])){
		$test = $_GET['change'];
		$id_sess = $_SESSION['u_id'];
		$testret = $bddacc->check_session($id_sess, $test);
		
		if($testret['a_id'] == $test){
			$_SESSION['a_id'] = $testret['a_id'];
			$_SESSION['a_name'] = $testret['a_name'];
			$_SESSION['a_first_name'] = $testret['a_first_name'];
		}
	}
}
?>
<!doctype html>
<html class="no-js" lang="FR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> MD2 | <?php echo $titre_onglet; ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- owl.carousel CSS -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.css">
    <link rel="stylesheet" href="../css/owl.transitions.css">
    <!-- meanmenu CSS -->
    <link rel="stylesheet" href="../css/meanmenu/meanmenu.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- normalize CSS -->
    <link rel="stylesheet" href="../css/normalize.css">
    <!-- wave CSS -->
    <link rel="stylesheet" href="../css/wave/waves.min.css">
    <link rel="stylesheet" href="../css/wave/button.css">
    <!-- mCustomScrollbar CSS -->
    <link rel="stylesheet" href="../css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS-->
    <link rel="stylesheet" href="../css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- Notika icon CSS -->
    <!--<link rel="stylesheet" href="../css/notika-custom-icon.css">-->
    <!-- main CSS -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr JS -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- DataTable JS-->
	<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
	<!-- Datepicker JS -->
	<link rel="stylesheet" href="../css/datapicker/datepicker3.css">
	<!--jQuery UI-->
	<link rel="stylesheet" href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
</head>

<body>
	<!-- Start Header Top Area -->
    <div class="header-top-area" style="height:unset">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="logo-area">
						<a href="accueil.php"><img src="../img/logo.png" alt="Logo du site MD2" /></a>
						<?php
						if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {
							echo '<a href="#" data-toggle="collapse" data-target="#menu"><i class="fas fa-bars fa-lg" style="color:white;padding-left:5%"></i></a>';
						}
						?>	
					</div>
					<div id="menu" class="collapse dropdown-menu message-dd" role="menu">
						<ul>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="#">
									<i class="fas fa-user"></i> <?php echo $_SESSION['a_first_name']," ",$_SESSION['a_name']; ?>
								</a>
							</li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="#" data-toggle="collapse" data-target="#fam">
									<i class="fas fa-users"></i> Ma famille
									<i class="fas fa-chevron-down"></i>
								</a>
							</li>
							
							<div id="fam" aria-expanded="false" class="collapse">
								<ul>
									<li class="divider"></li>
									<?php
									foreach($retmenu as $rowmenu){
										echo '<li class="hd-message-sn">
											<a role="menuitem" tabindex="-1" href="',$url,'?change=',$rowmenu['a_id'],'">
												<i class="fas fa-user"></i>',' ',$rowmenu['a_first_name'],' ',$rowmenu['a_name'],'
											</a>
										</li>';
									}
									?>
									<li class="hd-message-sn">
										<a role="menuitem" tabindex="-1" href="information.php?action=ajouter">
											<i class="fas fa-user-plus"></i> Ajouter un membre
										</a>
									</li>
									<li class="divider"></li>
								</ul>
							</div>
							
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="information.php">
									<i class="fas fa-user-cog"></i> Mes informations
								</a>
							</li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="traitement.php">
									<i class="fas fa-prescription-bottle-alt"></i> Mon traitement
								</a>
							</li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="pharmacie.php">
									<i class="fas fa-pills"></i> Ma pharmacie
								</a>
							</li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="vaccin.php">
									<i class="fas fa-book-medical"></i> Mon carnet de santé
								</a>
							</li>
							<li class="divider"></li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="medicament.php">
									<i class="fas fa-pills"></i> Informations médicaments
								</a>
							</li>
							<li role="presentation" class="hd-message-sn">
								<a role="menuitem" tabindex="-1" href="pays.php">
									<i class="fas fa-syringe"></i> Informations vaccins
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="header-top-menu">
						<ul class="nav navbar-nav notika-top-nav">
							<li class="nav-item">
								<a href="../controller/accueil.php">
									<span><i class="fas fa-home"></i></span><span>     Accueil</span>
								</a>
							</li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
									<span><i class="fas fa-search"></i>     Rechercher</span>
								</a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="fas fa-arrow-left"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li>
							
							<?php
							if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {
								echo '<li class="nav-item">
									<a href="#">
										<span><i class="fas fa-bell"></i></span><span>     Notifications</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="../script/reglog/logout.php">
										<span><i class="fas fa-user-slash"></i></span><span>     Se déconnecter</span>
									</a>
								</li>';
							}
							else {
								echo '<li class="nav-item">
									<a href="../controller/connexion.php">
										<span><i class="fas fa-user"></i></span><span>     Se connecter</span>
									</a>
								</li>';
							}
							?>
							
							<li class="nav-item">
								<a href="#">
									<span>     FR | EN</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>
	<!-- End Header Top Area -->

	
	<!-- Mobile Menu start -->
    <?php
	if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {
		echo '<div class="mobile-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="mobile-menu">
							<nav id="dropdown">
								<ul class="mobile-menu-nav">
									<li>
										<a href="#">',$_SESSION['a_first_name']," ",$_SESSION['a_name'], '</a>
									</li>
									<li><a data-toggle="collapse" data-target="#mfam" href="#">Ma famille</a>
										<ul id="mfam" class="collapse dropdown-header-top">';
											foreach($retmenu as $rowmenu){
												echo '<li><a href="',$url,'?change=',$rowmenu['a_id'],'">',' ',$rowmenu['a_first_name'],' ',$rowmenu['a_name'],'</a></li>';
											}
											echo '<li><a href="information.php?action=ajouter">Ajouter un membre</a></li>
										</ul>
									</li>
									<li>
										<a href="information.php">Mes informations</a>
									</li>
									<li>
										<a href="traitement.php">Mon traitement</a>
									</li>
									<li>
										<a href="pharmacie.php">Ma pharmacie</a>
									</li>
									<li>
										<a href="vaccin.php">Mon carnet de santé</a>
									</li>
									<li>
										<a href="medicament.php">Informations médicaments</a>
									</li>
									<li>
										<a href="pays.php">Informations vaccins</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
	?>
    <!-- Mobile Menu end -->
	
	<!-- Début du contenu de la page -->
	<div class="container" style="background-color:#FFFFFF;margin-top:40px">
		<div>
			<?php 
				echo "</br>";
				echo $ariane; 
				echo "</br>";
				echo "<h1>",$titre_page,"</h1>";
			?>
		</div>