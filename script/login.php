<?php
session_start();

$database = new PDO('mysql:host=localhost;dbname=md2;charset=utf8', 'root', '');

require_once '../model/users.class.php';

$user = new ManagementBddUsers($database);

$luser = $_POST['luser'];
$lpass = $_POST['lpass'];

$ret = $user->connect_to($luser , $lpass);
?>