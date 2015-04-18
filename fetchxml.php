<?php
require_once "db.inc.php";
//Blindly fetches game XML, for recovering from loss of connection
$user = $_GET['user'];
$pass = $_GET['pw'];

//Login check
if(login($user,$pass) == false){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

//Fetch game xml
$query = "SELECT Xml FROM FlockingGame WHERE (Player1 ='$user' OR Player2='$user'";
$pdo = pdo_connect();
$result = $pdo->query($query);
//If it exists, give it to them
if($row = $result->fetch()){
	echo $row['Xml'];
	exit;
}
//Otherwise, return an error
else{
	echo '<game status="no" msg="Game not found" />';
	exit;
}
