<?php
	session_start();
	echo 'Redirecting to account...';
	$_SESSION['name'] = $_GET["acc"];
	//$psw = $_SESSION['psw'];
	//$_SESSION['psw'] = $psw;
	$_SESSION['page'] = "other";
	$home = 'home.php?user='.$_SESSION['name'];
	echo $_SESSION['name'];
	header('Location: '.$home) and exit;
?>