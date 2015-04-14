<?php
require_once "db.inc.php";
function dataread($player){
	$pdo = pdo_connect();
	$query = "UPDATE FlockingGame SET DataRead=1 WHERE (Player1='$player' OR Player2='$player')";
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
$query = "SELECT Player1, Xml, DataSender, DataRead FROM FlockingGame WHERE Player1= $pidQ
";
$query2 = "SELECT Player2, Xml, DataSender, DataRead FROM FlockingGame WHERE Player2=$pidQ";

$rows1 = $pdo->query($query);
if($row = $rows1->fetch()){
	if($row['DataSender'] != $playerid){
		if($row['DataRead']==1){
			echo '<game status="no" msg="Data already received" />';
			exit;
		}
		echo $row['Xml'];
		dataread($playerid);
		exit;
	}
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo '<game status="no" msg="Not your turn" />';
	exit;
}

$rows2 = $pdo->query($query2);
if($row2 = $rows2->fetch()){
		
	if($row2['DataSender']!=$playerid){
		if($row2['DataRead']==1){
			echo '<game status="no" msg="Data already received" />';
			exit;
		}

		echo $row['Xml'];
		dataread($playerid);
		exit;
	}
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo '<game status="no" msg="Not your turn" />';
	exit;
}

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<game status="no" msg="Game not found" />';
