<?php
	session_start();
	$password = $_POST["psw"];
	$username = $_POST["name"];
	
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;

	$SQL = "SELECT COUNT(user.Name) FROM user WHERE user.Name = '".$username."' AND user.Password = '".$password."'";
	$result = mysql_query($SQL);
	$row = mysql_fetch_array($result);
	
	if ($row > 0) {
		header('Location: home.php') and exit;
	} else {
		header('Location: notreg.php') and exit;
	}
	?>