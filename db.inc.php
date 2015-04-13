<?php

function pdo_connect() {
	try{
		//Production Server
		$dbhost = "mysql:host=mysql-user.cse.msu.edu;dbname=chiversb";
		$user = "chiversb";
		$password = "A46905098";
		return new PDO($dbhost, $user, $password);
	} catch(PDOException $e){
		die( "Unable to select database");
	}
}

function login($user, $pass){
	$pdo = pdo_connect();

	$userQ = $pdo->quote($user);
	$query = "SELECT User, Password FROM FlockingUser where user=$userQ";

	$rows = $pdo->query($query);
	if($row = $rows->fetch()){
		if($row['Password'] != $pass){
			return 'Pass Error';
		}
		return 'True';
	}
	return 'User Error';
}
