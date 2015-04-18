<?php
require_once "db.inc.php";
//Used to find player in lobby
function findplayer($user){

	$query = "SELECT User FROM FlockingLobby";
	$pdo = pdo_connect();

	$result = $pdo->query($query);
	if($row = $result->fetch()){
		//If a different user exits in the lobby
		if($row['User'] != $user){
			//Return their name
			return $row['User'];
		}
	}
	return false;
}
