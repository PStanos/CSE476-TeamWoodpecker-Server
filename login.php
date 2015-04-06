<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$pdo = pdo_connect();

$user = $_GET['user'];
$pass = $_GET['pw'];

$userQ = $pdo->quote($user);
$query = "SELECT User, Password FROM FlockingUser where user=$userQ";

$rows = $pdo->query($query);
if($row = $rows->fetch()){
	if($row['Password'] != $pass){
		echo '<game status="no" msg="password error" />';
		exit;
	}
	echo '<game status="yes" />';
	exit;
}
echo '<game status="no" msg="user error" />';
