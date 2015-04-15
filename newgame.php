<?php
require_once "db.inc.php";
function newgame($p1, $p2){
	$pdo = pdo_connect();

	$p1Q = $pdo->quote($p1);
	$p2Q = $pdo->quote($p2);
	/*$gamecheck = "SELECT ID FROM FlockingGame WHERE (Player1=$p1Q OR Player2=$p1Q) OR (Player1=$p2Q or Player2=$p2Q)";

	$result = $pdo->query($gamecheck);
	if($result != false){
		return false;
	}*/

	$query = "INSERT INTO FlockingGame (Player1, Player2,DataRead, WhosNext) VALUES ($p1Q, $p2Q, 0, $p1Q)";

	$rows = $pdo->query($query);
	if($rows == false){
		return false;
	}
	return true;
}
