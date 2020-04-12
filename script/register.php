<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../model/users.class.php';
require_once '../model/accounts.class.php';
require_once "function.php";

if(isset($_POST['ruser'])){
	$user = new Users();
	$bdduser = new ManagementBddUsers($database);
	$account = new Accounts();
	$bddaccount = new ManagementBddAccounts($database);
	
	$array_user = array(
		"u_name" => $_POST['ruser'],
		"u_mail" => $_POST['rmail'],
		"u_password" => $_POST['rpass'],
	);
	$user->hydrate($array_user);
	$pass2 = $_POST['rpass2'];

	$bdduser->add_user($user , $pass2);
	$ret_user = $bdduser->get_last_add();
	$user->hydrate($ret_user[0]);

	$array_account = array(
		"a_uid" => $user->getu_id(),
		"a_first_name" => $_POST['rpre'],
		"a_name" => $_POST['rname'],
		"a_birth_date" => formatDate($_POST['rdate']),
	);
	$account->hydrate($array_account);
	$bddaccount->add_account($account);
}
else {
	echo "Une erreur est survenue.";
}
?>