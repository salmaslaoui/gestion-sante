<?php

function isValidEmail($email) {
    if(preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i", $email)) {
        return true;
    } else {
        return false;
    }
}

$cnom = $_POST['cnom']; 
$cmail = $_POST['cmail'];
$csujet = $_POST['csujet'];
$cmsg = $_POST['cmsg'];


// Faire le blabla avec PHPMailer + test de la variable $cmail avec la fonction

// echo la réponse adaptée à afficher dans l'alerte JS en retour de requête
echo "On a bien reçu les infos dans le script !";
?>