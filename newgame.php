<?php
require_once "db.inc.php";
//Creates a new game with both players
function newgame($p1, $p2){
	$pdo = pdo_connect();

	$p1Q = $pdo->quote($p1);
	$p2Q = $pdo->quote($p2);

	$dt = new DateTime();
	$query = "INSERT INTO FlockingGame (Player1, Player2,DataRead, Uploaded,Sleep) VALUES ($p1Q, $p2Q, 1, $p1Q, NOW())";

	$rows = $pdo->query($query);
	if($rows == false){
		return false;
	}
	return true;
}
