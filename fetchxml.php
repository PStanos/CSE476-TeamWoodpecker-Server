<?php
require_once "db.inc.php";
//Blindly fetches game XML, for recovering from loss of connection
$user = $_GET['user'];
$pass = $_GET['pw'];

//Login check
if(login($user,$pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}
$pdo = pdo_connect();
$userQ= $pdo->quote($user);
//Fetch game xml
$query = "SELECT Xml FROM FlockingGame WHERE Player1 =$userQ OR Player2=$userQ";
$pdo = pdo_connect();
$result = $pdo->query($query);
//If game doesn't exist, throw error
if($result == false){
	echo '<game status="no" msg="Game not found" />';
	exit;
}
else{
	$row = $result->fetch();
	echo $row['Xml'];
	exit;
}
