<?php
require_once "db.inc.php";

$pdo = pdo_connect();
$playerid = $_GET['pid'];

$pidQ = $pdo->quote($playerid);
$query = "SELECT Player1, Xml, Player1Turn FROM FlockingGame WHERE Player1= $pidQ";
$query2 = "SELECT Player2, Xml, Player1Turn FROM FlockingGame WHERE Player2=$pidQ";

$rows1 = $pdo->query($query);
if($row = $rows1->fetch()){
	if($row['Player1Turn'] == 1){
		echo $row['Xml'];
		exit;
	}
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo '<game status="no" msg="Not your turn" />';

}

$rows2 = $pdo->query($query2);
if($row2 = $rows2->fetch()){
		
	if($row2['Player1Turn']==0){
		echo $row['Xml'];
		exit;
	}
	echo '<?xml version="1.0" encoding="UTF-8" ?>';
	echo '<game status="no" msg="Not your turn" />';
	exit;
}

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<game status="no" msg="Game not found" />';
