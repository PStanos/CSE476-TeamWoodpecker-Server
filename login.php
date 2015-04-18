<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';

//Handles initial login activity
$user = $_GET['user'];
$pass = $_GET['pw'];

//Attempts to log in
$result = login($user, $pass);
//Password is incorrect
if($result == 'Pass Error'){
	echo '<game status="no" msg="password error" />';
	exit;
}
//Good login
if($result == 'True'){
	echo '<game status="yes" />';
	exit;
}
//User not found
if($result == 'User Error'){
	echo '<game status="no" msg="user error" />';
	exit;
}

?>
