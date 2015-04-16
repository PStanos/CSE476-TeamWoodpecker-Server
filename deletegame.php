<?php
require_once "db.inc.php";
require_once "deletelobby.php";
$user = $_GET['user'];
$pass = $_GET['pw'];

if(login($user,$pass) == false){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$query = "DELETE FROM FlockingGame WHERE (Player1 = '$user' OR Player2='$user')";

$pdo = pdo_connect();
$result = $pdo->query($query);
if($result == false){
	echo '<game status="no" msg="Delete Error" />';
	exit;
}
deletelobby($user);
echo '<game status="yes" msg="Exited" />';
