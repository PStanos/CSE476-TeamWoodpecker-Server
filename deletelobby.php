<?php
require_once "db.inc.php";

//Deletes user from lobby
function deletelobby($user){
	$pdo = pdo_connect();
	$userq = $pdo->quote($user);

	$query = "DELETE FROM FlockingLobby WHERE User=$userq";
	$result = $pdo->query($query);
	return $result;
}
