<?php
	//include "ConvertWeekDay.php";
	function PrintHWInfoInListByID($hwid, $timezone, $EditMode, $username, $loggeduserid, $ifNextDate = 0){
		static $IfCalledYet;
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
		if ($ifNextDate == 1) {
			if (isset($IfCalledYet)){
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '<div id = "MySubjectStatisticsBox">';
			echo '<h2>'.ConvertWeekday($MyCurrentHomeworkIfno["MainInfo"]["WEEKDAY"]).' '.$MyCurrentHomeworkIfno["MainInfo"]["Date"].'<small> '.$weekday2.'</small>';

				echo '</h2>';
				echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo'.$hwid.'" style = "width:100%;">Задачи за деня</button>
				<div id="demo'.$hwid.'" class="collapse">';
				echo '<div class = "SubjectStatistics">';
		}
		$FullTitle = ReturnTypeOfHWinWords($MyCurrentHomeworkIfno["MainInfo"]["Type"])." по ".$MyCurrentHomeworkIfno["MainInfo"]["Title"];
		echo '<div id = "StandartBox" style = "margin-bottom:10px;margin-top:10px;margin-right:10px;padding:10px;">';
		echo '<h2><p style = "font-weight:bold;font-size:30px;">'.mb_substr($FullTitle, 0, 100).'</p></h2>';


		//echo "<p>".ConvertWeekday($MyCurrentHomeworkIfno["MainInfo"]["WEEKDAY"])."</p>";
		//echo '<p style = "font-weight:normal;">'.$weekday2.$MyCurrentHomeworkIfno["MainInfo"]["Date"]."</p>";


		if (CheckIfUserIsSolver($loggeduserid, $hwid) == 0){

			$SQL = "SELECT user.Name FROM user WHERE user.Password = '".$_SESSION["psw"]."'";

			$current_logged_in_username_result = mysql_query($SQL);
			$current_logged_in_username = mysql_fetch_array($current_logged_in_username_result);
			echo '<p style = "text-align:left;"><a style = "color:red;font-weight:bold;" href = "solve_homework.php?hwid='.$hwid.'&user='.$current_logged_in_username[0].'"><span class="glyphicon glyphicon-ok"></span> Още не сте го решили (решете тук)</a></li>';
		} else {
			echo '<p style = "text-align:left;"><a style = "color:green;font-weight:bold;" href = "#"><span class="glyphicon glyphicon-ok"></span> Вече сте го решили :)</a></li>';
		}
		echo '<p><a href="comments.php?hwid='.$hwid.'" id = "CommentsButton" style = "">';
		echo '<span class="glyphicon glyphicon-comment"></span>';
		echo ' Коментари '.$MyCurrentHomeworkIfno["MainInfo"]["NumOfComments"].'</a></p>';


							if (strlen($MyCurrentHomeworkIfno["MainInfo"]["IMGURL"]) <= 0){
								//$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"] = "themes/no-image.jpg";
							} else {
							echo '<a href = "'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'" rel="lightbox" >

								<div class="frame-square" style = "display: inline-block;vertical-align: top; padding: 10px;width: 200px; height: 200px;margin-right: .5em;margin-bottom: .3em;">
									<div class="crop" style = " height: 100%;overflow: hidden;position: relative;">
										<img style = " display: block;width: 100%; height: 100%;margin: auto;position: absolute;top: -100%;right: -100%;bottom: -100%;left: -100%;border:solid #d2c9c6;"src="'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'">
									</div>
								</div>

							</a>';
							}

								echo "<p>".$MyCurrentHomeworkIfno["MainInfo"]["Data"]."</p>";

							if ($EditMode == 1){
								echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;" href="delete_hw_confirm.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-trash"></span> Изтрий </a></p>';
								echo '<p style = "text-align:left;"><a style = "color:#d2c9c6;font-weight:bold;" href="edit_hw.php?hwid='.$hwid.'&class='.$username.'"><span class="glyphicon glyphicon-pencil"></span> Редактирай</a></p>';
							}
							echo '<p style = "text-align:left;"><a href = "add_assessment_to_hw.php?hwid='.$hwid.'"><span class = "glyphicon glyphicon-stats"></span> Вашата оценка - '.CheckMyAssessmentForHWWithID($hwid, $loggeduserid).'</a></p>';


								$SQL = "SELECT COUNT(solvedhomeworks.UID) FROM solvedhomeworks WHERE solvedhomeworks.HWID = ".$hwid;
								$result4 = mysql_query($SQL);
								$number_of_solvers = mysql_fetch_array($result4);
								if ($number_of_solvers[0] > 0){
									echo '<p style = "text-align:left;"><a href="homework_solvers.php?hwid='.$hwid.'&user='.$username.'"><span class="glyphicon glyphicon-pencil"></span> '.$Label2.' '.$number_of_solvers[0].'</a></p>';
								}
								echo "</div>";
		$IfCalledYet = true;
	}

?>
