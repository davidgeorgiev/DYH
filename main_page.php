<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="vertical-timeline/css/reset.css">
	<link rel="stylesheet" href="vertical-timeline/css/style.css">
	<script src="vertical-timeline/js/modernizr.js"></script>
</head>
<body>

<?php

	include "graphs/convert_weekday_from_php.php";
	include "graphs/make_chart.php";
	include "graphs/collect_data.php";
	include "graphs/my_week_dropdown_buttons.php";
	include "graphs/convert_month_to_word.php";
	include "start_check.php";
	include "some_external_phps/CheckIfUserIsSolver.php";
	include "some_external_phps/PrintAccountInfo.php";
	include "some_external_phps/CheckMyAssessmentForHWWithID.php";
	
	
	CheckFriendShipByNameAndKickOut($_GET["user"], Get_Logged_users_id());
	
	$pars_time_period_to_check_with_page = "";
	if (isset($_GET["time_period"])){
		if (strlen($_GET["time_period"]) > 0){
			$pars_time_period_to_check_with_page = '&time_period='.$_GET["time_period"];
		}
	}
	if ($_SESSION['page'] != 'check_width'){
		header('Location: check_width_and_send_to.php?user='.$username.'&page='.$current_page_is.$pars_time_period_to_check_with_page) and exit;
	}
	$_SESSION['page'] = $current_page_is;
?>

<div class="container">
<?php include "main_menu.php"; ?>	
<?php
	if ($result = mysql_query("SELECT DISTINCT homeworks.Date FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query )){
		//echo 'Success';
		//echo "SELECT DISTINCT homeworks.Date, WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query;
	} else {
		echo 'FAIL';
	}
	$SQL = "SELECT DISTINCT COUNT(homeworks.UID), WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query;
	//echo '<div style="margin-top:100px;">'.$SQL."</div>";
	//echo $SQL;
	$result3 = mysql_query($SQL);
	$row3 = mysql_fetch_array($result3);
	$SQL = "SELECT DISTINCT COUNT(otherinfo.UID) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC";
	$result4 = mysql_query($SQL);
	$row4 = mysql_fetch_array($result4);
	if (($row3[0] > 0) || ($row4[0] > 0)) {
		$there_is_some_info = 1;
	} else {
		$there_is_some_info = 0;
	}
	echo '<div class="container">';

	function PrintAChart($IdOfChart, $username, $strDateFrom, $strDateTo, $PrevMonth, $EditMode, $timezone){
		
		$done_array1 = CollectData(1, $username, $strDateFrom, $strDateTo);
		$done_array0 = CollectData(0, $username, $strDateFrom, $strDateTo);
		$done_array2 = CollectData(2, $username, $strDateFrom, $strDateTo);
		$done_array_1 = CollectData(-100, $username, $strDateFrom, $strDateTo);//Empty data to skip cyan color in chart
		$done_array3 = CollectData(-1, $username, $strDateFrom, $strDateTo);
		
		
		$MyFinalArray = array($done_array1,$done_array0, $done_array2, $done_array_1, $done_array3);
		$MyChart = MakeMyChart($MyFinalArray, "Напрегнатост", "area", "c".$IdOfChart);
		
		$MyDate = date_create($done_array1[6][0]);
		$MyLastDayOfThisWeekMonth = date_format($MyDate, "m");
		$MyYearToShow = date_format($MyDate, "Y");
		if ($MyLastDayOfThisWeekMonth != $PrevMonth){
			echo '<div class="page-header">';
			echo '<h1 style = "color:#837d7c;">'.ConvertMonthToWord($MyLastDayOfThisWeekMonth)." ".$MyYearToShow.'</h1>';
			echo '</div>';
		}
		
		if (($_GET["width"] < 385) && ($_GET["height"] > $_GET["width"])){
			$MyWidth = 160;
			$MyLeftMargin = -30;
		} else if (($_GET["width"] >= 385) && (($_GET["width"] < 530) && ($_GET["height"] > $_GET["width"]))){
			$MyWidth = 140;
			$MyLeftMargin = -18;
		}
		else if (($_GET["width"] >= 530) && ($_GET["height"] > $_GET["width"])){
			$MyWidth = 132;
			$MyLeftMargin = -13;
		} else {
			$MyWidth = 100;
			$MyLeftMargin = 0;
		}
		
		if ($_GET["height"] > $_GET["width"]){
			$MyButtonWidth = 100;
			$MyButtonLeftMargin = 0;
		} else {
			$MyButtonWidth = $MyWidth+5;
			$MyButtonLeftMargin = 15;
		}
		$MyHeight = 75;
		PrintMyWeekDropdownButtons($MyFinalArray[0],$EditMode,$username,$MyButtonWidth,$MyButtonLeftMargin, 1, $timezone);
		
		echo '<div style="margin-left:'.$MyLeftMargin.'%;width:'.$MyWidth.'%;height:'.$MyHeight.'%; min-width:100px;">';
			echo $MyChart; 
		echo '</div>';
		
		return $MyLastDayOfThisWeekMonth;
	}
	
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);margin-top:2%;height:850px;">';
	$MyUserUIDresult = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$username."'");
	$currentuserid = mysql_fetch_array($MyUserUIDresult);
	if ($currentuserid[0] != Get_Logged_users_id()){
		if (CheckIfFriends($currentuserid[0], Get_Logged_users_id()) == 0){
			header('Location: you_are_not_friends.php?secured_user='.$_GET["user"]) and exit;
			if ((CheckIfRequestSent(Get_Logged_users_id(), $currentuserid[0])) == 0){
				echo '<a href = "send_friend_request_to.php?user='.$username.'"><button class="btn btn-default" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Сприятеляване</button></a>';
			} else {
				echo '<a href = "#"><button class="btn btn-default" style = "min-width:100%;color:#837d7c;background:#d2c9c6;font-weight:bold;border-radius:7px;font-size:16px;font-family: Arial;font-weight:bold;margin-top:0px;" type="button"><span class = "glyphicon glyphicon-user"></span><span class = "glyphicon glyphicon-user"></span> Поканата е изпратена</button></a>';
			}
		}
	}
	
	PrintAccountInfoByUSERNAME($username, 1);
	
	include "some_external_phps/show_today_and_tomorrow_div.php";
	echo '</div>';
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);margin-top:2%;">';
	
	$MyToday = gmdate("Y-m-d", time() + 3600*($timezone+date("I")));
	$strDateFrom = date('Y-m-d', strtotime($MyToday. ' - 1 day'));
	$strDateTo = date('Y-m-d', strtotime($MyToday. ' + 2 days'));
	include "some_external_phps/LegendButtonsForChart.php";
	PrintChartHeader(0, 0, 0, "Вашите скорошни задачи");
	PrintAChart(1, $username, $strDateFrom, $strDateTo, "0", $EditMode, $timezone);
	echo '</div>';
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);">';
	if (!$there_is_some_info) {
		echo '<div class="alert alert-success">';
		echo 'За съжаление желаният списък е <strong>празен!</strong>';
		echo '</div>';
	}
	echo $button_to_render;
	?>
	<!--<section id="cd-timeline" class="cd-container">-->
	<?php
	include "some_external_phps/PrintHWInfoInTableByID.php";
	include "some_external_phps/PrintHomeworksTimeline.php";
	include "some_external_phps/PrintHWInfoInList.php";
	
	$ifNextDate = 0;
	while ($row = mysql_fetch_array($result)){
		
		$ifNextDate = 1;
		//echo '<div class="page-header" style = "font-size:17px;">';
		
		//echo '<h1>'.$weekday.' <small id = "smalltag" style = "font-size:15px;">'.$weekday2.$row[0].'</small></h1>';
		//echo '</div>';
		//echo '<div class="row">';
	
	
		if ($current_page_is == "home"){
			$result2 = mysql_query("SELECT homeworks.UID FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ".str_replace("ORDER BY homeworks.Date ASC","",$the_end_of_query)." ORDER BY homeworks.UID DESC");
		} else {
			$result2 = mysql_query("SELECT homeworks.UID FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ORDER BY homeworks.UID DESC");
		}
		//echo "SELECT homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.UID, imgurl.URL, homeworks.UID, homeworks.Type FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ".str_replace("ORDER BY homeworks.Date ASC","",$the_end_of_query)." ORDER BY homeworks.UID DESC";
		while ($row2 = mysql_fetch_array($result2)){
			//$MyHomeworkInfo = returnHomeworkInfoByID($row2[0]);
			//print_r($MyHomeworkInfo);
			PrintHWInfoInListByID($row2[0], $timezone, $EditMode, $username, Get_Logged_users_id(), $ifNextDate);
			
			// if ($_GET["height"] > $_GET["width"]){
				// PrintHWInfoInTableByID($row2[0], $timezone, $EditMode, $username, Get_Logged_users_id(), $ifNextDate);
			// } else {
				// PrintHomeworksTimeline($row2[0], $timezone, $EditMode, $username, Get_Logged_users_id());
			// }
			$ifNextDate = 0;
		}
		$ifNextDate = 0;
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';
	//echo '</section> <!-- cd-timeline -->';
	
	if ($result = mysql_query("SELECT DISTINCT COUNT(otherinfo.Title) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC")){
	//echo 'Success';
	} else {
		echo 'FAIL';
	}
	$row = mysql_fetch_array($result);
	if ($row[0] > 0){
		echo '<div class="page-header">';
		echo '<h1 style = "font-size:40px;color:#837d7c;">ДОПЪЛНИТЕЛНО</h1>';
		echo '</div>';
	}
  ?>
  
  <div class="row">
    
	<?php
		if ($result = mysql_query("SELECT DISTINCT otherinfo.Title,otherinfo.Data,otherinfo.UID FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC")){
			//echo 'Success';
		} else {
			echo 'FAIL';
		}
		while ($row = mysql_fetch_array($result)){
			//echo '<div class="col-sm-8" style = "margin:10px;background-color: white;border-radius:7px;">';
			echo '<h3 style = "font-size:30px;padding:20px;background:#d2c9c6;color:#837d7c;font-family:arial;">'.$row[0].'</h3>';
			echo '<p style = "background:#837d7c;color:#d2c9c6;font-size:20px;font-family:Arial;padding:20px;">'.$row[1].'</p>';
			if ($EditMode == 1) {
				echo '<style>.MyDeleteEditLink{
						color:#837d7c;
						font-size:25px;
						font-family:arial;
						text-decoration: none;
					}
					.MyDeleteEditLink:hover{
						color:#696160;
						text-decoration: none;
						font-weight:bold;
					}
				}
				</style>';
				echo '<div style = "padding:20px;background:#d2c9c6;">';
				echo '<a class = "MyDeleteEditLink" href = "delete_info.php?infoid='.$row[2].'&class='.$username.'"';
				echo '<p>Изтрий</p></a>';
				
				echo '<a class = "MyDeleteEditLink" href = "edit_info.php?infoid='.$row[2].'&class='.$username.'"';
				echo '<p>Редактирай</p></a>';
				echo '</div>';
			}
			//echo '</div>';
		}
	?>
  </div>
  <?php
	//echo '<div class="alert alert-success" role="alert">...</div><div class="alert alert-info" role="alert">...</div><div class="alert alert-warning" role="alert">...</div><div class="alert alert-danger" role="alert">Много важно събитие</div>';
	echo '</div>';
	?>
<div>
	
</div>
</div>
<script src="vertical-timeline/jquery.min.js"></script>
<script src="vertical-timeline/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
