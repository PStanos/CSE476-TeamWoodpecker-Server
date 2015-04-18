<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';
//Updates the game XML after a turn

$user = $_POST['user'];
$pass = $_POST['pw'];
$next = $_POST['next'];
//Login check
if(login($user,$pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

//Check if XML is present
if(!isset($_POST['xml'])) {
	echo '<game status="no" msg="missing XML" />';
	exit;
}
processXml(stripslashes($_POST['xml']), $user, $next);

function processXml($xmltext, $user, $next){
	$xml = new XMLReader();
	if(!$xml->XML($xmltext)) {
		echo '<game status="no" msg="invalid XML" />';
		exit;
	}
	$pdo = pdo_connect();
	$xmltextQ = $pdo->quote($xmltext);
	$userQ = $pdo->quote($user);
	$nextQ = $pdo->quote($next);
	$query = "UPDATE FlockingGame SET Sleep=NOW(), Xml=$xmltextQ, DataRead = 0, Uploaded = $userQ WHERE Player1=$userQ OR Player2=$userQ";

	//Update game with xml, recent upload user, reset data read
	$result = $pdo->query($query);
	if($result == false){
		echo "<game status='no' msg='Update error' />";
		exit;
	}
	echo '<game status="yes" />';

}
