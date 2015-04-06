<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$pdo = pdo_connect();

$user = $_GET['user'];
$pass = $_GET['pw'];

$userQ = $pdo->quote($user);
$passQ = $pdo->quote($pass);
$query = "INSERT INTO FlockingUser (User,Password) VALUES ($userQ, $passQ)";

$rows = $pdo->query($query);
if($rows == false){
	echo "<game status='no' msg='user error' />";
	exit;
}
echo "<game status='yes' />";
