<?php
require_once "db.inc.php";

$user = $_GET['user'];
$pass = $_GET['pw'];

if(login($user,$pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$query = "SELECT User FROM FlockingLobby";
$pdo = pdo_connect();

$result = $pdo->query($query);
if($row = $result->fetch()){
	if($row['User'] != ""){
		echo '<game status="yes" msg="Match found" />';
		exit;
	}
}
echo '<game status="no" msg="No match found" />';
