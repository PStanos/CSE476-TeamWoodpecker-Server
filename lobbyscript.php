<?php
require_once "db.inc.php";
require_once "findplayer.php";
require_once "joinlobby.php";
require_once "newgame.php";
require_once "deletelobby.php";

$user = $_GET['user'];
$pass = $_GET['pw'];

if(login($user, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$result = findplayer($user);
if($result == false){
	joinlobby($user);
	echo '<game status="no" msg="Joined Lobby" />';
	exit;
}
else{
	$gameresult = newgame($user, $result);
	if($gameresult == false){
		echo '<game status="no" msg="New game failure" />';
	}	
	deletelobby($user);
	deletelobby($result);
	echo "<game status='yes' msg='Game Found' p1='$user' p2='$result' />";
	exit;
}


