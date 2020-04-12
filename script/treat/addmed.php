<?php
if(isset($_POST['maid'])){
	$id = (int) $_POST['mtag'];
	echo "KOUKOU ON A BIEN LES INFOS DANS ADD MED A UN TREAT : maid = ", $_POST['maid'], "et le tag :",$id;
}

// maid : aid, mtag : tag, mnom : nom, mdated : dated, mdatef : datef, mquan : quan,  mnbjour : nbjour, mtime : time
?>