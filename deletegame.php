<?php
require_once "db.inc.php";
require_once "deletelobby.php";
$user = $_GET['user'];
$pass = $_GET['pw'];

//Login check....
if(login($user,$pass) == false){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

//Delete the game of player
$query = "DELETE FROM FlockingGame WHERE (Player1 = '$user' OR Player2='$user')";

$pdo = pdo_connect();
$result = $pdo->query($query);
//If it fails...
if($result == false){
	echo '<game status="no" msg="Delete Error" />';
	exit;
}
//Delete user from lobby, in case they are in there too
deletelobby($user);
echo '<game status="yes" msg="Exited" />';
