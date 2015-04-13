<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$user = $_POST['user'];
$pass = $_POST['pw'];

if(login($user,$pass) != 'True'){
	echo '<game status="no" msg="Login Fail" />';
	exit;
}

if(!isset($_POST['xml'])) {
	echo '<game status="no" msg="missing XML" />';
	exit;
}

processXml(stripslashes($_POST['xml']));

function processXml($xmltext){
	$xml = new XMLReader();
	if(!$xml->XML($xmltext)) {
		echo '<game status="no" msg="invalid XML" />';
		exit;
	}

	$pdo = pdo_connect();
}
