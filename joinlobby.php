<?php
require_once "db.inc.php";
function joinlobby($user){
	$pdo = pdo_connect();
	$userQ= $pdo->quote($user);

	$query = "INSERT INTO FlockingLobby (User) VALUES ($userQ) ON DUPLICATE KEY UPDATE User=$userQ";
	$result = $pdo->query($query);
	return $result;
}

