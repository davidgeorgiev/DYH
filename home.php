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
		$the_end_of_query = "AND homeworks.Date >= '".gmdate("Y-m-d", time() + 3600*($timezone+date("I")))." 00:00:00' AND homeworks.Date <= '".$datetime."' ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "only_unsolved") {
		$the_end_of_query = "AND homeworks.UID NOT IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id().") ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "only_solved") {
		$the_end_of_query = "AND homeworks.UID IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id().") ORDER BY homeworks.Date ASC";
	} else if ($TimePeriod == "with_past_unsolved") {
		$the_end_of_query = "AND ((homeworks.Date >= '".gmdate("Y-m-d", time() + 3600*($timezone+date("I")))." 00:00:00') OR (homeworks.UID NOT IN (SELECT solvedhomeworks.HWID FROM solvedhomeworks WHERE homeworks.UID = solvedhomeworks.HWID AND solvedhomeworks.USERID = ".Get_Logged_users_id()."))) ORDER BY homeworks.Date ASC";
	} else {
		$the_end_of_query = "AND homeworks.Date >= '".gmdate("Y-m-d", time() + 3600*($timezone+date("I")))." 00:00:00' ORDER BY homeworks.Date ASC";
	}
	if (ifLogged() > 0){
	$button_to_render = '<div><div class="dropdown" style = "float:left;padding-right:10px;">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:46px;
																																									width:100%;background:#d2c9c6;
																																									color:#837d7c;
																																									font-weight:bold;
																																									border-radius:5px;
																																									font-size:25px;
																																									font-family: Hattori;
																																									font-weight:bold;
																																							">
				<span class="glyphicon glyphicon-wrench"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
				<li><a href="home.php?user='.$_GET["user"].'&time_period=today_and_tomorrow"><span class="glyphicon glyphicon-circle-arrow-down"></span><span class="glyphicon glyphicon-circle-arrow-right"></span> Покажи само за днес и за утре</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=with_past_unsolved"><span class = "glyphicon glyphicon-exclamation-sign"></span><span class="glyphicon glyphicon-share-alt"></span> Покажи всички предстоящи задачи включително пропуснатите от мен</a></li>
				<li><a href="home.php?user='.$_GET["user"].'"><span class="glyphicon glyphicon-share-alt"></span> Всички предстоящи задачи без пропуснатите от мен</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=only_unsolved"><span class="glyphicon glyphicon-remove"></span> Покажи само нерешените от мен задачи</a></li>
				<li><a href="home.php?user='.$_GET["user"].'&time_period=only_solved"><span class="glyphicon glyphicon-ok"></span> Покажи само решените от мен задачи</a></li>
				</ul>
				</div>';
				$myButtonLabel = "";
				$UserInfo = ReturnALLUserInfoByIdOrByName($_GET["user"]);
				switch ($TimePeriod){
					case "with_past_unsolved": $myButtonLabel = "Всички предстоящи задачи на ".$UserInfo["FirstName"]." включително пропуснатите от вас";
					break;
					case "false": $myButtonLabel = "Всички предстоящи задачи на ".$UserInfo["FirstName"]." без пропуснатите от вас";
					break;
					case "only_unsolved": $myButtonLabel = "Всички задачи на ".$UserInfo["FirstName"].", които сте пропуснали";
					break;
					case "only_solved": $myButtonLabel = "Всички задачи на ".$UserInfo["FirstName"].", които сте решили";
					break;
					
				}
				
				
				$button_to_render = $button_to_render.'<div style = "text-align:center;border:1px solid #c8ccc1;border-radius: 5px;padding: 10px;color:#d2c9c6;background-color:#837d7c;font-size:35;font-family:MyDays	;">'.$myButtonLabel.'</div></div>';
	} else {
		$button_to_render = "";
	}
	include "main_page.php";
?>
