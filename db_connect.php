<?php
	@session_start();
	date_default_timezone_set('Europe/Istanbul');


	$db_user 	= "root";
	$db_pass 	= "";
	$db_name 	= "esanlamli";
	$host_name 	= "localhost";
	$host_port	= "3306";
	try {
	    $db  	= new PDO("mysql:host=$host_name;port=$host_port;dbname=$db_name", $db_user, $db_pass);
	} catch (PDOException $e) {
	    echo 'Connection failed: '.$e->getMessage();
	}

	$db->query("SET NAMES utf8");
	$db->query("SET CHARACTER SET utf8");
	$db->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");


?>