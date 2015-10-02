<?php
	session_start();
	include "config.php";
	
	$username = $_POST["name"];
	
	$SQL = "SELECT user.UID FROM user WHERE user.Name = '".$username."'";
	$MyUserUIDResult = mysql_query($SQL);
	$MyUserUID = mysql_fetch_array($MyUserUIDResult);
	
	$password = $_POST["psw"].$MyUserUID[0];
	
	
	

	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Name = '".$username."' AND user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	
	if ($row[0] > 0) {
		$_SESSION['psw'] = $password;
		$_SESSION['name'] = $username;
		header('Location: home.php?user='.$username) and exit;
	} else {
		header('Location: notreg.php') and exit;
	}
	?>