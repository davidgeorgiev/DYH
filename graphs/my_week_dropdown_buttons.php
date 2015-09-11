

<?php
	//print_r($done_array1);
	function PrintMyWeekDropdownButtons($done_array1, $EditMode, $username, $width, $leftmargin, $WeekDayFullOrNot){
		echo '<style>.btn-group {width:'.(($width-$leftmargin)/(sizeof($done_array1))).'%;}.btn btn-default dropdown-toggle{width: 100%;}</style>';
		echo '<div style = "margin-left: '.$leftmargin.'%;width:'.($width-$leftmargin).'%;">';
		foreach ($done_array1 as $value){
			if ($value[0] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))){
				$buttonClass = "btn btn-success dropdown-toggle";
			} else {
				$buttonClass = "btn btn-default dropdown-toggle";
			}
			echo '<div class="btn-group"><button type="button" class="'.$buttonClass.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$timestamp = strtotime($value[0]);
			$weekday = date( "w", $timestamp);
			echo ConvertWeekdayFromPhp($weekday, $WeekDayFullOrNot);
			echo '<span class="caret"></span>';
			echo '</button>';
			if ($_GET["height"] > $_GET["width"]){
				$MyDropdownMenuWidth = 200;
			} else {
				$MyDropdownMenuWidth = 300;
			}
			
			echo '<ul class="dropdown-menu" style = "background-color: white;width:'.$MyDropdownMenuWidth.'px;padding-right:10px;padding-left:10px;padding-top:10px;padding-bottom:0px;overflow-y: scroll; height:320px;">';
			$SQL = "SELECT homeworks.UID FROM homeworks, user, uh WHERE homeworks.Date = '".$value[0]."' AND homeworks.UID = uh.HWID AND user.UID = uh.USERID AND user.Name = '".$username."'";
			$result4 = mysql_query($SQL);
			$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks, user, uh WHERE homeworks.Date = '".$value[0]."' AND homeworks.UID = uh.HWID AND user.UID = uh.USERID AND user.Name = '".$username."'";
			$result5 = mysql_query($SQL);
			$number_of_hws = mysql_fetch_array($result5);
			if ($number_of_hws[0] <= 0){
				echo '<p><a href="#">Няма нищо</a></p>';
			} else {
				while ($homework_info = mysql_fetch_array($result4)){
					$MyHomeworkInfoArray = returnHomeworkInfoByID($homework_info[0]);
					$myHeadingBackgroundColor = "white";
					$TextColor = "black";
					$myHeadingContent = "NULL";
					if ($MyHomeworkInfoArray["MainInfo"]["Type"] == 0) {
						$myHeadingBackgroundColor = "#86cf4b";
						$myHeadingContent = "Домашно";
						$headingPadding = 19;
					} else if ($MyHomeworkInfoArray["MainInfo"]["Type"] == 1) {
						$myHeadingBackgroundColor = "#4ba8cf";
						$myHeadingContent = "Изпит";
						$headingPadding = 24;
					} else if ($MyHomeworkInfoArray["MainInfo"]["Type"] == 2) {
						$myHeadingBackgroundColor = "#dd8043";
						$myHeadingContent = "Напомняне";
						$headingPadding = 24;
					}
					
					if (Get_Logged_users_id()){
						$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$homework_info[0]." AND solvedhomeworks.USERID = ".Get_Logged_users_id();
						//echo $SQL;
						$IfISolvedResult = mysql_query($SQL);
						$MyIfISolved = mysql_fetch_array($IfISolvedResult);
						if ($MyIfISolved[0] > 0){
							$myHeadingBackgroundColor = "#673e7a";
							//echo "USERID = ".Get_Logged_users_id();
							$TextColor = "white";
						}
					}
					
					if ($EditMode == 1){
						$Trash = '<a href="delete_hw_confirm.php?hwid='.$homework_info[0].'&class='.$username.'&page=homeworks_time_chart" style = "text-decoration:none;color:white;font-size:13px;padding:4px;"><span class="glyphicon glyphicon-trash"></span> </a>';
						$Pencil = '<a href="edit_hw.php?hwid='.$homework_info[0].'&class='.$username.'" style = "text-decoration:none;color:white;font-size:13px;"><span class="glyphicon glyphicon-pencil"></span> </a>'; 
					} else {
						$Trash = "";
						$Pencil = "";
					}
					
					echo '<p style = "padding-bottom:15px;padding-top:3px;color:'.$TextColor.';background-color:'.$myHeadingBackgroundColor.';text-left:center;font-size:16px;border-radius:3px;border:solid #837d7c;">'.$Trash.$Pencil.'<a href="comments.php?hwid='.$homework_info[0].'" style = "text-decoration:none;color:white;font-size:13px;"><span class="glyphicon glyphicon-comment"></span> '.$MyHomeworkInfoArray["MainInfo"]["NumOfComments"];
					
					if ($MyHomeworkInfoArray["MainInfo"]["NumOfSolvers"] > 0){						
						echo'<a href="homework_solvers.php?hwid='.$homework_info[0].'&user='.$username;
						echo '" style = "text-decoration:none;color:white;font-size:13px;"><span class="glyphicon glyphicon-stats"></span> '.$MyHomeworkInfoArray["MainInfo"]["NumOfSolvers"];
						echo '</a>';
					}
					
					if (CheckIfUserIsSolver(Get_Logged_users_id(), $homework_info[0]) == 0){
						$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
						//echo $SQL;
						$current_logged_in_username_result = mysql_query($SQL);
						$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
						echo'<a href="'.'solve_homework.php?hwid='.$homework_info[0].'&user='.$current_logged_in_username[0];
						echo '" style = "text-decoration:none;color:white;font-size:13px;"><span class="glyphicon glyphicon-ok"></span> ';
						echo '</a>';
					}
					
					echo '<span style = "padding-left:'.$headingPadding.'%;">'.$myHeadingContent.'<span></p>';
					echo '<div style = "padding:0px;">';
					echo '<a href="#" style = "text-decoration:none;"><p style = "margin-top:-12px;padding:3px;padding-bottom:15px;padding-top:5px;text-align:center;background-color:#837d7c;color:#d2c9c6;font-weight:bold;">'.$MyHomeworkInfoArray["MainInfo"]["Title"].'</p></a>';
					if (strlen($MyHomeworkInfoArray["MainInfo"]["IMGURL"]) > 0) {
						echo '<div style = "background-color:#d2c9c6;border:solid #837d7c;border-bottom:none;margin-top:-10px;margin-bottom:-6px;color:#837d7c;font-size:15px;">';
						echo '<a href = "'.$MyHomeworkInfoArray["MainInfo"]["IMGURL"].'" rel="lightbox"><img src = "'.$MyHomeworkInfoArray["MainInfo"]["IMGURL"].'" style = "border:solid #9f9593;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;margin-bottom:10px;" width = "100%"></a>';
						echo '</div>';
					}
					if (strlen($MyHomeworkInfoArray["MainInfo"]["Data"]) >= 0) {
						echo '<div style = "background-color:#d2c9c6;border:solid #837d7c;border-top:none;padding-left:4px;padding-right:4px;padding-bottom:15px;padding-top:12px;margin-top:-10px;margin-bottom:-6px;color:#837d7c;font-size:15px;"><p>'.$MyHomeworkInfoArray["MainInfo"]["Data"]."</p>";
						
						echo '</div>';
					}
					//echo '<li><a href="#">'.$homework_info[2].'</a></li>';
					
					echo '</div>';
					echo '<div style = "margin-bottom:10px;">';
					
					$MyPercentage = ($MyHomeworkInfoArray["MainInfo"]["Rank"]*25);
					
					echo '<div id="progressbar">';
					echo '<div style = "width: '.$MyPercentage.'%;color:#837d7c;font-weight:bold;">';
					echo $MyPercentage.'%';
					echo '</div>';
					echo '</div>';
					
					echo '</div>';
				}
			}
			echo '</ul>';
			echo '</div>';
		}
		unset($value);
		echo '</div>';
	}
?>