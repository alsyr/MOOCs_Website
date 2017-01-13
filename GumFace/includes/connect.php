<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'biddle';

	$db = 'moocs160';
	$conn = mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_select_db($db);
?>