<?php
	session_start();
	echo 'Redirecting to search...';
	$search_page = "search_users.php?user=".$_GET["user"];
	header('Location: '.$search_page.'&searching_for='.$_POST["what_to_search"]) and exit;
?>