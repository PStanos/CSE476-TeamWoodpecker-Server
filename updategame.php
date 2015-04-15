<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$user = $_POST['user'];
$pass = $_POST['pw'];
$next = $_POST['next'];
if(login($user,$pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

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
	$query = "UPDATE FlockingGame SET Xml=$xmltextQ, DataRead = 0, WhosNext = $nextQ WHERE Player1=$userQ OR Player2=$userQ";

	$result = $pdo->query($query);
	if($result == false){
		echo "<game status='no' msg='Update error' />";
		exit;
	}
	echo '<game status="yes" />';

}
