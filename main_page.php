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
	if ($result = mysql_query("SELECT DISTINCT homeworks.Date, WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query )){
		//echo 'Success';
		//echo "SELECT DISTINCT homeworks.Date, WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query;
	} else {
		echo 'FAIL';
	}
	$SQL = "SELECT DISTINCT COUNT(homeworks.Date), WEEKDAY(homeworks.Date) FROM homeworks,user,uh WHERE user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID ".$the_end_of_query;
	//echo '<div style="margin-top:100px;">'.$SQL."</div>";
	//echo $SQL;
	$result3 = mysql_query($SQL);
	$row3 = mysql_fetch_array($result3);
	$SQL = "SELECT DISTINCT COUNT(otherinfo.Title) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC";
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
	
	echo '<div id = "my_page" style = "background: rgba(243, 243, 243, 0.4);margin-top:2%;">';
	$result = mysql_query("SELECT user.UID FROM user WHERE user.Name = '".$username."'");
	$currentuserid = mysql_fetch_array($result);
	if ($currentuserid[0] != Get_Logged_users_id()){
		if (CheckIfFriends($currentuserid[0], Get_Logged_users_id()) == 0){
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
	<section id="cd-timeline" class="cd-container">
	<?php
	while ($row = mysql_fetch_array($result)){
		//print_r($row);
		
		//echo '<div class="page-header" style = "font-size:17px;">';
		
		switch($row[1]){
			case 0: $weekday = 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: $weekday = 'ЗА ВТОРНИК';
			break;
			case 2: $weekday = 'ЗА СРЯДА';
			break;
			case 3: $weekday = 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: $weekday = 'ЗА ПЕТЪК';
			break;
			case 5: $weekday = 'ЗА СЪБОТА';
			break;
			case 6: $weekday = 'ЗА НЕДЕЛЯ';
			break;
		}
		
		if ($row[0] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = "";
		}
		
		//echo '<h1>'.$weekday.' <small id = "smalltag" style = "font-size:15px;">'.$weekday2.$row[0].'</small></h1>';
		//echo '</div>';
		//echo '<div class="row">';
		if ($current_page_is == "home"){
			$result2 = mysql_query("SELECT homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.UID, imgurl.URL, homeworks.UID, homeworks.Type FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ".str_replace("ORDER BY homeworks.Date ASC","",$the_end_of_query)." ORDER BY homeworks.UID DESC");
		} else {
			$result2 = mysql_query("SELECT homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.UID, imgurl.URL, homeworks.UID, homeworks.Type FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ORDER BY homeworks.UID DESC");
		}
		//echo "SELECT homeworks.Title, homeworks.Data, homeworks.Rank, homeworks.UID, imgurl.URL, homeworks.UID, homeworks.Type FROM homeworks,user,uh,imgurl,hwimg WHERE imgurl.UID = hwimg.IMGURLID AND hwimg.HWID = homeworks.UID AND user.Name = '".$username."' AND uh.HWID = homeworks.UID AND uh.USERID = user.UID AND homeworks.Date = '".$row[0]." 00:00:00' ".str_replace("ORDER BY homeworks.Date ASC","",$the_end_of_query)." ORDER BY homeworks.UID DESC";
		while ($row2 = mysql_fetch_array($result2)){
			//echo '	<div class="col-sm-3" style = "margin:10px;background-color: white;border-radius:7px;">';
			switch($row2[2]){
				case 1: $color = "white";
				break;
				case 2: $color = "#a8f293";
				break;
				case 3: $color = "#ffb495";
				break;
				case 4: $color = "#fa7194";
				break;
			}
			switch($row2[6]){
				case 1: $type_color = "#ffe1a8";
				break;
				case 0: $type_color = "#a8c0ff";
				break;
			}
				echo '<div class="cd-timeline-block">';
					if ($row2[2] == 1){
						$img_bg_color = "";
					} else if ($row2[2] == 2){
						$img_bg_color = "picture";
					} else if ($row2[2] == 3){
						$img_bg_color = "location";
					} else if ($row2[2] == 4){
						$img_bg_color = "movie";
					}
					echo '<div class="cd-timeline-img cd-'.$img_bg_color.'">';
					if ($_GET["width"] <= 1170) {
						$margin_top = "margin-top: 20px;";
						$class_zoom = ' ';
					} else {
						$margin_top = "margin-top: 30px;";
						$class_zoom = 'class="zoom_img"';
					}
						if (strlen($row2[4]) <= 0){
							//echo '<div class="zoom_img" style = "margin-top:'.$margin_top.'px;z-index: 5;">';
							echo '<img src="vertical-timeline/img/cd-icon-picture.svg" alt="Picture">';
							//echo '</div>';
						} else {
							echo '<div '.$class_zoom.' style = "'.$margin_top.' z-index:100;position:relative;">';
							echo '<a href = "'.$row2[4].'" rel="lightbox"><img style= "border-width:thin; border-style: solid;background-color:#afb7c3;border-color: white;border-radius:15px;" src="'.$row2[4].'" alt="HomeWork image" width="100%" height="100%"></a>';
							echo '</div>';
						}
					echo '</div> <!-- cd-timeline-img -->';
					echo '<style>#MyHWBOX {background-color:#837d7c; border:solid white;border-width:2px;} #MyHWBOX:hover{background-color:#968e8d;}</style>';
					echo '<div class="cd-timeline-content" id = "MyHWBOX">';
					
				if ($row2[6] == 0){
					$type_of_event = "Домашно по ";
				} else {
					$type_of_event = "Изпит по ";
				}
			if ($EditMode == 0) {
				echo '	<h2 style = "background-color:#d2c9c6;
											padding:10px;
											font-size:30px;
											color:#837d7c;
											border-radius:10px;
											font-family: Hattori;
											font-weight:bold;">'.$type_of_event.$row2[0].'</h2>';
			} else {
				echo '<div class="dropdown" style = "float:left;padding-right:10px;margin-top:-6px;">';
				echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:100%;background:#d2c9c6;
																																																color:#837d7c;
																																																font-weight:bold;
																																																border-radius:20px;
																																																font-size:25px;
																																																font-family: Hattori;
																																																font-weight:bold;">';
				echo '<span class="glyphicon glyphicon-wrench"></span>';
				//echo '<span class="caret"></span>';
				echo '</button>';
				echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
				echo '<li><a href="delete_hw_confirm.php?hwid='.$row2[3].'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
				echo '<li><a href="edit_hw.php?hwid='.$row2[3].'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></li>';
				echo '</ul>';
				echo '</div>';
				echo '<h2 style = "background-color:#d2c9c6;
											padding:10px;
											font-size:30px;
											color:#837d7c;
											border-radius:10px;
											font-family: Hattori;
											font-weight:bold;">';
				echo $type_of_event.$row2[0];
				echo '</h2>';
			}
			$SQL = "SELECT (user.UID) FROM user WHERE user.Name = '".$username."'";
				$result4 = mysql_query($SQL);
				$user_id = mysql_fetch_array($result4);
				
				echo '<div class="dropdown" style = "width:130px;padding-right:10px;margin-top:10px;">';
				echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:100%;color:#837d7c;
																																													background:#d2c9c6;
																																													font-weight:bold;
																																													border-radius:7px;
																																													font-size:16px;
																																													font-family: Hattori;
																																													font-weight:bold;
																																													margin-top:-22px;">';
				if (CheckIfUserIsSolver(Get_Logged_users_id(), $row2[3]) == 1){
					echo '<span style = "color:green;" class = "glyphicon glyphicon-ok"> Решено</span></a>';
				} else {
					echo '<span style = "color:red;" class = "glyphicon glyphicon-remove"> Нерешено</span>';
				}
				//echo '<span class="caret"></span>';
				echo '</button>';
				
				echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
				if ($row2[6] == 0){
					$Label1 = "Реших това домашно";
					$Label2 = "решили това домашно";
				} else {
					$Label1 = "Взех този изпит";
					$Label2 = "взели този изпит";
				}
				if (CheckIfUserIsSolver(Get_Logged_users_id(), $row2[3]) == 0){
					//echo $number_of_solved_hws[0];
					$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
					//echo $SQL;
					$current_logged_in_username_result = mysql_query($SQL);
					$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
					echo '<li><a style = "color:green;" href = "solve_homework.php?hwid='.$row2[3].'&user='.$current_logged_in_username[0].'"><span class="glyphicon glyphicon-ok"></span> '.$Label1.'</a></li>';
				}
				$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$row2[3];
				$result4 = mysql_query($SQL);
				$number_of_solvers = mysql_fetch_array($result4);
				if ($number_of_solvers[0] > 0){
					echo '<li><a href="homework_solvers.php?hwid='.$row2[3].'&user='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Виж всички '.$Label2.' ('.$number_of_solvers[0].')</a></li>';
				}
				echo '</ul>';
				//echo $username;
				echo '</div>';
			// if (strlen($row2[4]) > 0) {
				//echo ' <p style = "border-width:thin; border-style: solid;background-color:'.$type_color.';border-color: #BEBEBE;border-radius:5px; padding: 9px;"></p>';
			// }
				echo '	<p style = "color:#514d4b;
											font-family: Arial;
											font-size:20px;
											margin-top:20px;">'.$row2[1].'</p>';
			
			if ($EditMode == 1) {
				// echo '<div style = "margin-bottom: 13px;"><div>';
				// echo '<form id="tab" role="form"'; echo "action="; echo '"delete_hw.php?hwid='.$row2[3].'&class='.$username.'"'; echo ' method="post">
					// <div><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Изтрий</button></div>
				// </form>';
				// echo '<form id="tab" role="form"'; echo "action="; echo '"edit_hw.php?hwid='.$row2[3].'&class='.$username.'"'; echo ' method="post">
					// <div><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Редактирай</button></div>
				// </form>';
				// echo '</div></div>';
			}
			$SQL = "SELECT COUNT(usercommenthomework.UID) FROM usercommenthomework WHERE usercommenthomework.HWID = ".$row2[5];
			$result4 = mysql_query($SQL);
			$row4 = mysql_fetch_array($result4);
			echo '<p>';
			echo '<style>#CommentsButton{
							text-decoration: none;
							font-size:18px;color:#d2c9c6;
							font-family: Arial;
							font-size:20px;
							margin-top:3px;
						}#CommentsButton:hover{
							color:#4f4b4a;
						}</style>';
			echo '<a href="comments.php?hwid='.$row2[3].'" id = "CommentsButton" style = "">';
			echo '<span class="glyphicon glyphicon-comment"></span>';
			echo ' Коментари '.$row4[0].'</a>';
			echo '</p>';
			// echo '<form id="tab" role="form"'; echo "action="; echo 'comments.php?hwid='.$row2[3]; echo ' method="post">
					// <button class="btn btn-default" style = "width: 100%;background-color:white;" type="submit" >Коментари - '.$row4[0].'</button>
				// </form>';
			
			//echo '</div>';
			echo '<span class="cd-date"><h1 style="color:#6f6967;font-family: MyDays;font-size:22px;font-weight:bold;">'.$weekday.' <small id = "smalltag" style = "font-family:Arial;color:black;font-size:15px;">'.$weekday2.$row[0].'</small></h1></span>';
			echo '</div> <!-- cd-timeline-content -->';
			echo '</div> <!-- cd-timeline-block -->';
		}
		//echo '	</div>';
	}
	echo '</section> <!-- cd-timeline -->';
	
	if ($result = mysql_query("SELECT DISTINCT COUNT(otherinfo.Title) FROM otherinfo,user,uoi WHERE user.Name = '".$username."' AND uoi.UserID = user.UID AND uoi.OtherInfoID = otherinfo.UID  ORDER BY otherinfo.UID DESC")){
	//echo 'Success';
	} else {
		echo 'FAIL';
	}
	$row = mysql_fetch_array($result);
	if ($row[0] > 0){
		echo '<div class="page-header">';
		echo '<h1>ДОПЪЛНИТЕЛНО</h1>';
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
			echo '<div class="col-sm-3" style = "margin:10px;background-color: white;border-radius:7px;">';
			echo '<h3>'.$row[0].'</h3>';
			echo '<p>'.$row[1].'</p>';
			if ($EditMode == 1) {
				echo '<table style = "margin-bottom: 15px;"><tr>';
				echo '<form id="tab" role="form"'; echo "action="; echo '"delete_info.php?infoid='.$row[2].'&class='.$username.'"'; echo ' method="post">
					<td style = "width: 50%;"><button class="btn btn-default" style = "width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Изтрий</button></td>
				</form>';
				echo '<form id="tab" role="form"'; echo "action="; echo '"edit_info.php?infoid='.$row[2].'&class='.$username.'"'; echo ' method="post">
					<td style = "width: 50%;"><button class="btn btn-default" style = "margin-left:10px;width: 100%;background-color:white;height:27px;padding:3px;" type="submit" >Редактирай</button></td>
				</form>';
				echo '</tr></table>';
			}
			echo '</div>';
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