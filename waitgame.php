<?php
require_once "db.inc.php";
//Checks if data has been read
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
//Login check
if(login($playerid, $pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}


$pidQ = $pdo->quote($playerid);
$query = "SELECT  Xml, DataRead FROM FlockingGame WHERE Uploaded!= $pidQ AND (Player1=$pidQ OR Player2=$pidQ)";
$timeoutcheck = "SELECT Sleep FROM FlockingGame WHERE (Player1=$pidQ or Player2=$pidQ)";
$rows1 = $pdo->query($query);
$rows2 = $pdo->query($timeoutcheck);

//If game found...
if($row = $rows1->fetch()){
	//If that data has been read
	if($row['DataRead']==1){
		echo '<game status="no" msg="Data already received" />';
		exit;
	}
	//Else, read the data
	//echo '<game status="yes" msg="Data Received" />';
	echo $row['Xml'];
	dataread($playerid);  //Set data to read
	exit;
}
//Not your turn
else if($row2 = $rows2->fetch()){
	$timestamp = new DateTime($row2['Sleep']);
	$dt = new DateTime($timestamp->format(""));
	date_add($dt, new DateInterval('PT2M'));
	$interval = date_diff($dt, $timestamp);
	/*if($interval->invert){
		$deletequery = "DELETE FROM FlockingGame WHERE (Player1='$playerid' OR Player2='$playerid')";		
		$result = $pdo->query($deletequery);
		echo '<game status="no" msg="Timeout" />';
		exit;
	}*/

	echo '<game status="no" msg="Not your turn" />';
	exit;
}


//Game not found
echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<game status="no" msg="Game not found" />';
