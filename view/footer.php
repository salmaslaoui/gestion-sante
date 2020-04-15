	<!-- Fin du container -->
	</div>
    <!-- Start Footer area -->
    <div class="footer-copyright-area" style="height:unset">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <a href="https://miage-bordeaux.fr/"><img src="../img/logo_miage.png" alt="Logo de la MIAGE de Bordeaux" style="max-width: 60%; margin:10%;"/></a>
                </div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
						<p>
							<a href="../controller/droit.php#cgu">CGU</a> | 
							<a href="../controller/droit.php#poc">Politique de Confidentialité</a> | 
							<a href="../controller/droit.php#ml">Mentions Légales</a> | 
							<a href="../controller/accueil.php#contact">Contact</a> | 
							<a href="../controller/accueil.php#qui">Qui sommes nous ?</a> | 
							<a href="#">Plan du site</a>
							</br>
							</br>
							<a href="https://colorlib.com">Template Notika par colorlib</a>
						</p>
                    </div>
                </div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <a href="https://www.u-bordeaux.fr/"><img src="../img/logo_u_bdx.png" alt="Logo de l'Université de Bordeaux" style="max-width: 60%; margin:10%;"/></a>
                </div>
            </div>
        </div>
    </div>
	
	<!-- End Footer area-->
    <!-- jquery -->
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- wow JS -->
    <script src="../js/wow.min.js"></script>
    <!-- price-slider JS -->
    <script src="../js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- scrollUp JS -->
    <script src="../js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS -->
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS -->
    <script src="../js/counterup/jquery.counterup.min.js"></script>
    <script src="../js/counterup/waypoints.min.js"></script>
    <script src="../js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS -->
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS -->
    <script src="../js/sparkline/jquery.sparkline.min.js"></script>
    <script src="../js/sparkline/sparkline-active.js"></script>
    <!-- flot JS -->
    <script src="../js/flot/jquery.flot.js"></script>
    <script src="../js/flot/jquery.flot.resize.js"></script>
    <script src="../js/flot/flot-active.js"></script>
    <!-- knob JS -->
    <script src="../js/knob/jquery.knob.js"></script>
    <script src="../js/knob/jquery.appear.js"></script>
    <script src="../js/knob/knob-active.js"></script>
    <!--  Chat JS-->
    <script src="../js/chat/jquery.chat.js"></script>
	<!-- icheck JS -->
	<script src="../js/icheck/icheck.min.js"></script>
	<script src="../js/icheck/icheck-active.js"></script>
    <!--  todo JS -->
    <script src="../js/todo/jquery.todo.js"></script>
    <!--  wave JS -->
    <script src="../js/wave/waves.min.js"></script>
    <script src="../js/wave/wave-active.js"></script>
	<!-- Login JS -->
	<script src="../js/login/login-action.js"></script>
    <!-- plugins JS -->
    <script src="../js/plugins.js"></script>
    <!-- main JS -->
    <script src="../js/main.js"></script>
    <!-- tawk chat JS -->
    <!-- <script src="js/tawk-chat.js"></script> -->
	<!-- Data Maps JS -->
    <script src="../js/data-map/d3.min.js"></script>
    <script src="../js/data-map/topojson.js"></script>
    <script src="../js/data-map/datamaps.all.min.js"></script>
    <script src="../js/data-map/data-maps-active.js"></script>
	<!-- DataTable JS -->
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
	<!-- Datepicker JS -->
	<script src="../js/datapicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../js/datapicker/datepicker-active.js" type="text/javascript"></script>
	<!-- jQuery UI-->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>

</html>

<script>
function validateEmail(email){
	var emailReg = new RegExp(/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i);
	var valid = emailReg.test(email);
	
	if(!valid) {
		return false;
	} else {
		return true;
	}
}

function validatePass(pass){
	var passReg = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,20}$/gm);
	var valid = passReg.test(pass);
	
	if(!valid) {
		return false;
	} else {
		return true;
	}
}

function validateDate(date){
	var dateReg = new RegExp(/^(0?[1-9]|[12]\d|3[01])[\/](0?[1-9]|1[0-2])[\/](19|20)\d{2}$/);
	var valid = dateReg.test(date);
	
	if(!valid) {
		return false;
	} else {
		return true;
	}
}

function validateTime(time){
	var timeReg = new RegExp(/([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/g);
	var valid = timeReg.test(time);
	
	if(!valid) {
		return false;
	} else {
		return true;
	}
}

function reverseDate(date){
   return date.split('-').reverse().join('/');
}
</script>