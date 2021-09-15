<?php
	$dsn = 'mysql:host=samehbahnasy7844244.ipagemysql.com;dbname=samah123';
	$user = 'samah123';
	$pass = 'Ahmed@123';
	$option = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);
	try {
		$con = new PDO($dsn, $user, $pass, $option);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo 'Failed To Connect' . $e->getMessage();
	}