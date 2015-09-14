<?php
	//include "ConvertWeekDay.php";
	function PrintHWInfoInTableByID($hwid, $timezone, $EditMode, $username, $loggeduserid){
		$MyCurrentHomeworkIfno = returnHomeworkInfoByID($hwid);
		//print_r($MyCurrentHomeworkIfno);
		if ($MyCurrentHomeworkIfno["MainInfo"]["Date"] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))) {
			$weekday2 = '(днес) ';
		} else {
			$weekday2 = "";
		}
		if ($MyCurrentHomeworkIfno["MainInfo"]["Type"] == 0){
			$Label1 = "Реших това домашно";
			$Label2 = "Решено от";
		} else if ($MyCurrentHomeworkIfno["MainInfo"]["Type"] == 1){
			$Label1 = "Взех този изпит";
			$Label2 = "Взет от";
		} else if ($MyCurrentHomeworkIfno["MainInfo"]["Type"] == 2){
			$Label1 = "Изпълних тази задача";
			$Label2 = "Изпълнено от";
		}
		
		echo '<div id = "Curriculum" style = "margin-top:5%;">';
			echo '<table style = "font-family:Arial;color:#837d7c;">';
				echo '<thead>';
					echo '<tr style = "font-weight:bold;">';
						echo '<th colspan="2" style = "font-size:17px;">';
							echo "<p>".ConvertWeekday($MyCurrentHomeworkIfno["MainInfo"]["WEEKDAY"])."</p>";
							echo '<p style = "font-weight:normal;">'.$weekday2.$MyCurrentHomeworkIfno["MainInfo"]["Date"]."</p>";
							
						echo '</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
					echo '<tr>';
					echo '<td>';
						if (CheckIfUserIsSolver($loggeduserid, $hwid) == 0){
				
							$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";
							
							$current_logged_in_username_result = mysql_query($SQL);
							$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
							echo '<p style = "text-align:left;"><a style = "color:red;font-weight:bold;" href = "solve_homework.php?hwid='.$hwid.'&user='.$current_logged_in_username[0].'"><span class="glyphicon glyphicon-ok"></span> Нерешено</a></li>';
						} else {
							echo '<p style = "text-align:left;"><a style = "color:green;font-weight:bold;" href = "#"><span class="glyphicon glyphicon-ok"></span> Решено</a></li>';
						}
					echo '</td>';
					echo '</tr>';
					
					echo '<tr style = "background-color:#635e5d;color:#d2c9c6;">';
						echo '<td>';
							$FullTitle = ReturnTypeOfHWinWords($MyCurrentHomeworkIfno["MainInfo"]["Type"])." по ".$MyCurrentHomeworkIfno["MainInfo"]["Title"];
							echo mb_substr($FullTitle, 0, 24);
						echo '</td>';
						echo '</tr>';
						echo '<tr style = "background:#635e5d;">';
						echo '<td>';
							if (strlen($MyCurrentHomeworkIfno["MainInfo"]["IMGURL"]) <= 0){
								$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"] = "themes/no-image.jpg";
							}
							echo '<a href = "'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'" rel="lightbox" >
							
								<div class="frame-square" style = "display: inline-block;vertical-align: top; padding: 10px;width: 200px; height: 200px;margin-right: .5em;margin-bottom: .3em;">
									<div class="crop" style = " height: 100%;overflow: hidden;position: relative;">
										<img style = " display: block;width: 100%; height: 100%;margin: auto;position: absolute;top: -100%;right: -100%;bottom: -100%;left: -100%;border:solid #d2c9c6;"src="'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'">
									</div>
								</div>
							
							</a>';
						echo '</td>';
						echo '<tr style = "background:#635e5d;">';
							echo '<td>';
								echo '<ul style="background-color: #635e5d;width:100%;padding-right:10px;padding-left:10px;padding-top:10px;padding-bottom:0px;overflow-y: scroll; height:150px;"><p style = "background:#635e5d;color:#d2c9c6;font-size:20px;">';
								echo $MyCurrentHomeworkIfno["MainInfo"]["Data"];
								echo '</p></ul>';
								
							echo '</td>';
							echo '</tr>';
							if ($EditMode == 1){
								echo '<tr style = "background:#837d7c;">';
								echo '<td >';
								echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;" href="delete_hw_confirm.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий </a></p>';
								echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;" href="edit_hw.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></p>';
								echo '</td>';
								echo '</tr>';
							}
							echo '<tr style = "background:#837d7c;height:60px;">';
									echo '<td >';
									echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;"  href = "add_assessment_to_hw.php?hwid='.$hwid.'"><span class = "glyphicon glyphicon-stats"></span> Вашата оценка - '.CheckMyAssessmentForHWWithID($hwid, $loggeduserid).'</a></p>';
								
								
								$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$hwid;
								$result4 = mysql_query($SQL);
								$number_of_solvers = mysql_fetch_array($result4);
								if ($number_of_solvers[0] > 0){
									echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;" href="homework_solvers.php?hwid='.$hwid.'&user='.$username.'"><span class="glyphicon glyphicon-pencil"></span> '.$Label2.' '.$number_of_solvers[0].'</a></p>';
								}
								echo '</td>';
							echo '</tr>';
						echo '</tr>';
				echo '</tbody>';
			echo '</table>';
		echo '</div>';
		
	}

?>