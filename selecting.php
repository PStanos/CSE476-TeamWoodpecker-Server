<?php
require_once "db.inc.php";

$user = $_GET['user'];
$pass = $_GET['pw'];

if(login($user, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$pdo = pdo_connect();
$userQ = $pdo->quote($user);
$query = "SELECT Selecting FROM FlockingGame WHERE Player1=$userQ OR Player2=$userQ";

$result = $pdo->query($query);
if($row = $result->fetch()){
	if($row['Selecting'] == 1){
		echo '<game status="yes" msg="Selecting" />';
		exit;
	}
	echo '<game status="no" msg="Not Selecting" />';
	exit;
}
echo '<game status="no" msg="Game not found" />';


