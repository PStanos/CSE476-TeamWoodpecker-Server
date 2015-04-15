<?php
require_once "db.inc.php";

function deletelobby($user){
	$pdo = pdo_connect();
	$userq = $pdo->quote($user);

	$query = "DELETE FROM FlockingLobby WHERE User=$userq";
	$result = $pdo->query($query);
	return $result;
}
