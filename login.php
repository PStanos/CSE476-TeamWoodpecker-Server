<?php
require_once "db.inc.php";
echo '<?xml version="1.0" encoding="UTF-8" ?>';


$user = $_GET['user'];
$pass = $_GET['pw'];

$result = login($user, $pass);
if($result == 'Pass Error'){
	echo '<game status="no" msg="password error" />';
	exit;
}
if($result == 'True'){
	echo '<game status="yes" />';
	exit;
}
if($result == 'User Error'){
	echo '<game status="no" msg="user error" />';
	exit;
}

?>
