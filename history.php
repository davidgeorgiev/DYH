<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";

	$current_page_is = 'history';
	//$current_page_is = 'home';
	$button_to_render = "";
	$the_end_of_query = 'ORDER BY homeworks.Date DESC';
	//$the_end_of_query = "AND homeworks.Date >= '\".date(\"Y-m-d\").\" 00:00:00' ORDER BY homeworks.Date ASC";
	include "main_page.php";
?>
