<?php

	$EditMode = 0;
	$name_is_set = 0;
	if (isset($_GET["user"])) {
		$username = $_GET["user"];
		$name_is_set = 1;
	}
	if (isset($_POST["psw"]) && isset($_POST["name"])) {
		$password = $_POST["psw"];
		if ($name_is_set == 0) {
			$username = $_POST["name"];
		}
	} else {
		$password = $_SESSION['psw'];
		if ($name_is_set == 0) {
			$username = $_SESSION['name'];
		}
	}
	include "CheckEditMode.php";
	$_SESSION['psw'] = $password;
	$_SESSION['name'] = $username;

?>