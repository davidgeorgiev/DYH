<?php
	include "ConvertWeekDay.php";
	//include "CheckIfUserIsSolver.php";
	function PrintHomeworksTimeline($hwid, $timezone, $EditMode, $username, $loggeduserid, $ifNextDate = 0){
		//echo "ENTERRRR";
		$MyHomeworkInfo = returnHomeworkInfoByID($hwid);
		//print_r($MyHomeworkInfo);
		if ($MyHomeworkInfo["MainInfo"]["Date"] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = "";
		}
		
		
			echo '<div class="cd-timeline-block">';
				switch($MyHomeworkInfo["MainInfo"]["Rank"]){
					case 1: $img_bg_color = "";
					break;
					case 2: $img_bg_color = "picture";
					break;
					case 3: $img_bg_color = "location";
					break;
					case 4: $img_bg_color = "movie";
					break;
				}
			echo '<div class="cd-timeline-img cd-'.$img_bg_color.'" style = "z-index:600;">';
		
			
					$margin_top = "margin-top: 30px;";
					$class_zoom = 'class="zoom_img"';
		
					if (strlen($MyHomeworkInfo["MainInfo"]["IMGURL"]) <= 0){
					
						echo '<img src="vertical-timeline/img/cd-icon-picture.svg" alt="Picture">';
				
					} else {
						echo '<div '.$class_zoom.' style = "'.$margin_top.' position:relative;">';
						echo '<a href = "'.$MyHomeworkInfo["MainInfo"]["IMGURL"].'" rel="lightbox"><img style= "border-width:thin; border-style: solid;background-color:#afb7c3;border-color: white;border-radius:15px;" src="'.$MyHomeworkInfo["MainInfo"]["IMGURL"].'" alt="HomeWork image" width="100%" height="100%"></a>';
						echo '</div>';
					}
				echo '</div> <!-- cd-timeline-img -->';
				echo '<style>#MyHWBOX {background-color:#837d7c; border:solid white;border-width:2px;} #MyHWBOX:hover{background-color:#968e8d;}</style>';
				echo '<div class="cd-timeline-content" id = "MyHWBOX">';
				
				$type_of_event = ReturnTypeOfHWinWords($MyHomeworkInfo["MainInfo"]["Type"]);
		if ($EditMode == 0) {
			echo '	<h2 style = "background-color:#d2c9c6;
										padding:10px;
										font-size:30px;
										color:#837d7c;
										border-radius:10px;
										font-family: Hattori;
										font-weight:bold;">'.$type_of_event." по ".$MyHomeworkInfo["MainInfo"]["Title"].'</h2>';
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
			
			echo '</button>';
			echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
			echo '<li><a href="delete_hw_confirm.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий</a></li>';
			echo '<li><a href="edit_hw.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></li>';
			echo '</ul>';
			echo '</div>';
			echo '<h2 style = "background-color:#d2c9c6;
										padding:10px;
										font-size:30px;
										color:#837d7c;
										border-radius:10px;
										font-family: Hattori;
										font-weight:bold;">';
			echo $type_of_event." по ".$MyHomeworkInfo["MainInfo"]["Title"];
			echo '</h2>';
		}
		$SQL = "SELECT (user.UID) FROM user WHERE user.Name = '".$username."'";
			$result4 = mysql_query($SQL);
			$user_id = mysql_fetch_array($result4);
			
			echo '<div class="dropdown" style = "width:130px;padding-right:10px;margin-top:10px;">';
			echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "min-width:100%;color:#837d7c;
																																												background:#d2c9c6;
																																												font-weight:bold;
																																												border-radius:7px;
																																												font-size:16px;
																																												font-family: Hattori;
																																												font-weight:bold;
																																												margin-top:-22px;">';
			if (CheckIfUserIsSolver(Get_Logged_users_id(), $hwid) == 1){
				echo '<span style = "color:green;" class = "glyphicon glyphicon-ok"> Решено</span></a>';
			} else {
				echo '<span style = "color:red;" class = "glyphicon glyphicon-remove"> Нерешено</span>';
			}
		
			echo '</button>';
			
			echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">';
			if ($MyHomeworkInfo["MainInfo"]["Type"] == 0){
				$Label1 = "Реших това домашно";
				$Label2 = "решили това домашно";
			} else if ($MyHomeworkInfo["MainInfo"]["Type"] == 1){
				$Label1 = "Взех този изпит";
				$Label2 = "взели този изпит";
			} else if ($MyHomeworkInfo["MainInfo"]["Type"] == 2){
				$Label1 = "Изпълних тази задача";
				$Label2 = "изпълнили тази задача";
			}
			if (CheckIfUserIsSolver($loggeduserid, $hwid) == 0){
				
				$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
				
				$current_logged_in_username_result = mysql_query($SQL);
				$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
				echo '<li><a style = "color:green;" href = "solve_homework.php?hwid='.$hwid.'&user='.$current_logged_in_username[0].'"><span class="glyphicon glyphicon-ok"></span> '.$Label1.'</a></li>';
			}
			$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$hwid;
			$result4 = mysql_query($SQL);
			$number_of_solvers = mysql_fetch_array($result4);
			if ($number_of_solvers[0] > 0){
				echo '<li><a href="homework_solvers.php?hwid='.$hwid.'&user='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Виж всички '.$Label2.' ('.$number_of_solvers[0].')</a></li>';
			}
			echo '</ul>';
			
			echo '</div>';
		
			echo '	<p style = "color:#514d4b;
										font-family: Arial;
										font-size:20px;
										margin-top:20px;">'.$MyHomeworkInfo["MainInfo"]["Data"].'</p>';
		
		
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
		echo '<a href="comments.php?hwid='.$hwid.'" id = "CommentsButton" style = "">';
		echo '<span class="glyphicon glyphicon-comment"></span>';
		echo ' Коментари '.$MyHomeworkInfo["MainInfo"]["NumOfComments"].'</a></p>';
		
		echo '<p><a href="add_assessment_to_hw.php?hwid='.$hwid.'" id = "CommentsButton" style = "">';
		echo '<span class="glyphicon glyphicon-stats"></span>';
		echo ' Вашата оценка - '.CheckMyAssessmentForHWWithID($hwid, $loggeduserid).'</a></p>';
	
		echo '<span class="cd-date"><h1 style="color:#6f6967;font-family: MyDays;font-size:22px;font-weight:bold;">'.ConvertWeekday($MyHomeworkInfo["MainInfo"]["WEEKDAY"]).' <small id = "smalltag" style = "font-family:Arial;color:black;font-size:15px;">'.$weekday2.$MyHomeworkInfo["MainInfo"]["Date"].'</small></h1></span>';
		echo '</div> <!-- cd-timeline-content -->';
		echo '</div> <!-- cd-timeline-block -->';
	}

?>
