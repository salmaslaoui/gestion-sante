<?php 
if(isset($_POST['taid'])){
	$id = (int) $_POST['ttag'];
	$id -= 1; // NE PAS OUBLIEZ D'ENLEVER 1 A CAUSE DE LA BOUCLE FOR DE JS !!
	echo "KOUKOU ON A BIEN LES INFOS DANS DEL TREAT : taid = ", $_POST['taid'], "et le tag :",$_POST['ttag'];
}
?>