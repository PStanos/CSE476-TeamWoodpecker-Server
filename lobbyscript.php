<?php
require_once "db.inc.php";
require_once "findplayer.php";
require_once "joinlobby.php";
require_once "newgame.php";
require_once "deletelobby.php";

$user = $_GET['user'];
$pass = $_GET['pw'];
$pdo = pdo_connect();
if(login($user, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}



$query = "SELECT ID,Player1,Player2 FROM FlockingGame WHERE (Player1='$user' OR Player2='$user')";
$result2 = $pdo->query($query);
if($result2->rowCount() > 0){
	$row2 = $result2->fetch();
	$user1 = $row2['Player1'];
	$user2 = $row2['Player2'];
	echo "<game status='yes' msg='Game Found' p1='$user1' p2='$user2' />";
	exit;
}



$result = findplayer($user);
if($result == false){
	joinlobby($user);
	echo '<game status="no" msg="Joined Lobby" />';
	exit;
}
else{
	$gameresult = newgame($result, $user);
	if($gameresult == false){
		echo '<game status="no" msg="New game failure" />';
	}	
	deletelobby($user);
	deletelobby($result);
	echo "<game status='yes' msg='Game Found' p1='$result' p2='$user' />";
	exit;
}
