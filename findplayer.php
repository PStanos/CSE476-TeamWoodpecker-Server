<?php
require_once "db.inc.php";
function findplayer($user){

	$query = "SELECT User FROM FlockingLobby";
	$pdo = pdo_connect();

	$result = $pdo->query($query);
	if($row = $result->fetch()){
		if($row['User'] != $user){
			return $row['User'];
		}
	}
	return false;
}
