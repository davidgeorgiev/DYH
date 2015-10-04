<?php
	session_start();
	unset($_SESSION['name']);
	unset($_SESSION['psw']);
	header('Location: index.php') and exit;
?>