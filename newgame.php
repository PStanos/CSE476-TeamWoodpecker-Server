<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$pdo = pdo_connect();

$player1 = $_GET['p1'];
$player2 = $_GET['p2'];

$p1Q = $pdo->quote($player1);
$p2Q = $pdo->quote($player2);
$query = "INSERT INTO FlockingGame (Player1, Player2) VALUES ($p1Q, $p2Q)";

$rows = $pdo->query($query);
if($rows == false){
	echo "<game status='no' msg='new game error' />";
	exit;
}
echo "<game status='yes' />";
