<?php
require_once "db.inc.php";
function dataread($player){
	$pdo = pdo_connect();
	$query = "UPDATE FlockingGame SET DataRead=1 WHERE (Player1='$player' OR Player2='$player') AND Uploaded!='$player'";
	$row = $pdo->query($query);
	if($row == false){
		echo '<game status="no" msg="Update fail" />';
		return;
	}
	return;
}

$pdo = pdo_connect();
$playerid = $_GET['user'];
$pass = $_GET['pw'];

if(login($playerid, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

$pidQ = $pdo->quote($playerid);
$query = "SELECT  Xml, DataRead FROM FlockingGame WHERE Uploaded!= $pidQ AND (Player1=$pidQ OR Player2=$pidQ)";
$timeoutcheck = "SELECT Xml FROM FlockingGame WHERE (Player1=$pidQ or Player2=$pidQ)";
$rows1 = $pdo->query($query);
$rows2 = $pdo->query($timeoutcheck);
if($row = $rows1->fetch()){
	if($row['DataRead']==1){
		echo '<game status="no" msg="Data already received" />';
		exit;
	}
	//echo '<game status="yes" msg="Data Received" />';
	echo $row['Xml'];
	dataread($playerid);
	exit;
}
else if($row2 = $rows2->fetch()){
	echo '<game status="no" msg="Not your turn" />';
	exit;
}



echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<game status="no" msg="Game not found" />';
