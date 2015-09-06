<?php
	session_start();
	echo '<html lang="en" class="no-js">';
	include "head.php";
	include "config.php";

	//$current_page_is = 'history';
	$current_page_is = 'home';
	
	//$the_end_of_query = 'ORDER BY homeworks.Date DESC';
	$datetime = new DateTime('tomorrow');
	$datetime = $datetime->format('Y-m-d H:i:s');
	$TimePeriod = $_GET["time_period"];
	if ($TimePeriod == "today_and_tomorrow"){
		$the_end_of_query = "AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' AND homeworks.Date <= '".$datetime."' ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "only_unsolved") {
		$the_end_of_query = "AND homeworks.UID NOT IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id().") ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "only_solved") {
		$the_end_of_query = "AND homeworks.UID IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id().") ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "with_past_unsolved") {
		$the_end_of_query = "AND ((homeworks.Date >= '".date("Y-m-d")." 00:00:00') OR (homeworks.UID NOT IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id()."))) ORDER BY homeworks.Date ASC";
	} else {
		$the_end_of_query = "AND homeworks.Date >= '".date("Y-m-d")." 00:00:00' ORDER BY homeworks.Date ASC";
	}
	if (ifLogged() > 0){
	$button_to_render = '<div class="dropdown" style = "float:left;padding-right:10px;margin-top:-6px;">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:100%;">
				<span class="glyphicon glyphicon-wrench"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
				<li><a href="home.php?user='.$_GET["user"].'&time_period=today_and_tomorrow"><span class="glyphicon glyphicon-trash"></span> Покажи само за днес и за утре</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=with_past_unsolved"><span class="glyphicon glyphicon-pencil"></span> Покажи всички предстоящи включително и пропуснатите</a></li>
				<li><a href="home.php?user='.$_GET["user"].'"><span class="glyphicon glyphicon-pencil"></span> Покажи всички предстоящи като игнорираш пропуснатите</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=only_unsolved"><span class="glyphicon glyphicon-pencil"></span> Покажи само нерешените</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=only_solved"><span class="glyphicon glyphicon-pencil"></span> Покажи само решените</a></li>
				</ul>
				</div>';
	} else {
		$button_to_render = "";
	}
	include "main_page.php";
?>
