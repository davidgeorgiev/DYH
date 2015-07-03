<?php
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbLink = mysql_connect($servername, $username, $password);
	if (!$dbLink) {
		exit;
	}else{
	}
	mysql_query("SET character_set_results=utf8", $dbLink);
	$db_found = mysql_select_db('dyh') or die('Could not select database');
	mysql_query("set names 'utf8'",$dbLink);
?>