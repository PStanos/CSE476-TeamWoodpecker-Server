<?php
require_once "db.inc.php";

$user = $_GET['user'];
$pass = $_GET['pw'];

if(login($user, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$pdo = pdo_connect();
$userQ= $pdo->quote($user);

$query = "INSERT INTO FlockingLobby (User) VALUES ($userQ)";
$result = $pdo->query($query);


