<?php
	include "PrintPercentageBar.php";
	function ReturnAverageStatisticsForUserSubject($UserID, $subjectID, $StartDate = "1500-01-01 00:00:00", $FinalDate = "9999-12-31 00:00:00"){

		$SQL = "SELECT subjects.Rank FROM subjects WHERE subjects.UID = ".$subjectID;
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);

		//echo $row[0].$row[1];

		$rank_of_subject = $row[0];
		include "subject_scale_to_words.php";
		$rank_of_subject_with_words;

		$SQL = "SELECT solvedhomeworks.TimeForSolve,solvedhomeworks.Assessment,
		solvedhomeworks.PleasureInPercents, solvedhomeworks.LengthInPages,
		solvedhomeworks.LearnedInPercents, solvedhomeworks.IfCheating FROM solvedhomeworks WHERE
		solvedhomeworks.USERID = ".$UserID." AND SubjectID = ".$subjectID." AND ((solvedhomeworks.Date > '".$StartDate."') AND (solvedhomeworks.Date < '".$FinalDate."'))";
		$MySubjectsStatisticsResult = mysql_query($SQL);
		$counter = 0;
		$AssessmentCounter = 0;
		$SumOfTimeForSolve = 0;
		$SumOfAssessment = 0;
		$SumOfPleasureInPercents = 0;
		$SumOfLengthInPages = 0;
		$SumOfLearnedInPercents = 0;
		$SumOfIfCheating = 0;
		while($MySubjectsStatistics = mysql_fetch_array($MySubjectsStatisticsResult)){
			$counter++;
			$SumOfTimeForSolve += $MySubjectsStatistics[0];

			if ($MySubjectsStatistics[1] > 1){
				$AssessmentCounter++;
				$SumOfAssessment += $MySubjectsStatistics[1];
			}
			$SumOfPleasureInPercents += $MySubjectsStatistics[2];
			$SumOfLengthInPages += $MySubjectsStatistics[3];
			$SumOfLearnedInPercents += $MySubjectsStatistics[4];
			$SumOfIfCheating += $MySubjectsStatistics[5];
		}
		$ArrayOfSums = array($SumOfTimeForSolve,$SumOfAssessment,$SumOfPleasureInPercents,$SumOfLengthInPages,
		$SumOfLearnedInPercents,$SumOfIfCheating);
		if ($counter == 0){
			$counter = 1;
		}
		if ($AssessmentCounter == 0){
			$AssessmentCounter = 1;
		}
		$ArrayOfAverage = array($SumOfTimeForSolve/$counter,$SumOfAssessment/$AssessmentCounter,$SumOfPleasureInPercents/$counter,$SumOfLengthInPages/$counter,
		$SumOfLearnedInPercents/$counter,$SumOfIfCheating/$counter);

		$ArrayForReturn = array();
		$ArrayForReturn["NumOfSolvings"] = $counter;
		$ArrayForReturn["NumOfAssessments"] = $AssessmentCounter;
		$ArrayForReturn["Sums"] = $ArrayOfSums;
		$ArrayForReturn["Average"] = $ArrayOfAverage;
		$ArrayForReturn["RankOfSubject"] = $rank_of_subject;
		$ArrayForReturn["RankOfSubjectWithWords"] = $rank_of_subject_with_words;

		return $ArrayForReturn;
	}

	function ShowSubjectStatistics($UserID, $subjectID){
		$MyUserInfo = GetAccountInfoByUSERNAMEorID($username = "",$UserID);
		$MyUserAverageSubjectStatistics = ReturnAverageStatisticsForUserSubject($UserID, $subjectID);
		$SQL = "SELECT subjects.NAME FROM subjects WHERE subjects.UID = ".$subjectID;
		$MySubjectName = mysql_query($SQL);
		$MySubjectName = mysql_fetch_array($MySubjectName);

		echo '<div id = "MySubjectStatisticsBox">';
		echo '<h2>'.$MySubjectName[0].'<a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption=percents&user='.GetUserNamebyID($UserID).'&period=year"><button style = "width:20%;height:30px;float:right;background:#837d7c;color:white;" class="btn btn-default">Графики</button></a>';
			echo '<p style = "font-weight:bold;font-size:15px;">'.$MyUserAverageSubjectStatistics["RankOfSubjectWithWords"].'</p></h2>';

			if ($MyUserAverageSubjectStatistics["Average"][1] < 2){
				$MyUserAverageSubjectStatistics["Average"][1] = "няма";
			}
			$MyTitle = 'Средна оценка досега - '.$MyUserAverageSubjectStatistics["Average"][1];
			echo '<p style = "padding:5px;margin:0px;">'.$MyTitle.'</p>';
			//PrintPercentagebarSimple(((($MyUserAverageSubjectStatistics["Average"][1]-2)*100)/4), $MyTitle, number_format($MyUserAverageSubjectStatistics["Average"][1], 2));

		echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demo'.$subjectID.'" style = "width:100%;">Подробна статистика</button>
		<div id="demo'.$subjectID.'" class="collapse">';
			echo '<div class = "SubjectStatistics">';
			echo '<p style = "margin-top:-5px;padding-top:20px;">Решени задачи - '.$MyUserAverageSubjectStatistics["NumOfSolvings"].', от които оценени са

			'.$MyUserAverageSubjectStatistics["NumOfAssessments"].'

			</p>';
			echo '<p>БАЛ - '.$MyUserAverageSubjectStatistics["Sums"][1].'</p>';

			echo '<h3>Статистика на '.$MyUserInfo[2]." ".$MyUserInfo[3].'</h3>';
			PrintPercentagebarSimple(($MyUserAverageSubjectStatistics["RankOfSubject"]*10), "Любимост", number_format(($MyUserAverageSubjectStatistics["RankOfSubject"]*10),0).'%');



			if ($MyUserAverageSubjectStatistics["Sums"][0] == 1){
				$MyTimeVal = 'час';
			} else {
				$MyTimeVal = 'часа';
			}
			if ($MyUserAverageSubjectStatistics["Sums"][0] < 1){
				$MyUserAverageSubjectStatistics["Sums"][0] = 0;
			}
			$MyTitle = 'Отделено време - '.$MyUserAverageSubjectStatistics["Sums"][0].' '.$MyTimeVal;
			if ($MyUserAverageSubjectStatistics["Average"][0] == 1){
				$MyTimeVal = 'час';
			} else {
				$MyTimeVal = 'часа';
			}
			if ($MyUserAverageSubjectStatistics["Average"][0] < 1){
				$MyUserAverageSubjectStatistics["Average"][0] = 0;
			}
			$MyTitle .= ', средно по '.$MyUserAverageSubjectStatistics["Average"][0].' '.$MyTimeVal .' на задача';

			PrintPercentagebarSimple((($MyUserAverageSubjectStatistics["Sums"][0]*100)/3.75), $MyTitle, number_format((($MyUserAverageSubjectStatistics["Sums"][0]*100)/3.75), 0).'%');

			if ($MyUserAverageSubjectStatistics["Sums"][3] == 1){
				$MyTimeVal = 'страница';
			} else {
				$MyTimeVal = 'страници';
			}
			if ($MyUserAverageSubjectStatistics["Sums"][3] < 1){
				$MyUserAverageSubjectStatistics["Sums"][3] = 0;
			}
			$MyTitle = 'Писано - '.$MyUserAverageSubjectStatistics["Sums"][3].' '.$MyTimeVal;
			if ($MyUserAverageSubjectStatistics["Average"][3] == 1){
				$MyTimeVal = 'страница';
			} else {
				$MyTimeVal = 'страници';
			}
			if ($MyUserAverageSubjectStatistics["Average"][3] < 1){
				$MyUserAverageSubjectStatistics["Average"][3] = 0;
			}
			$MyTitle .= ', средно по '.$MyUserAverageSubjectStatistics["Average"][3].' '.$MyTimeVal .' на задача';

			PrintPercentagebarSimple((($MyUserAverageSubjectStatistics["Sums"][3]*100)/4.5), $MyTitle, number_format((($MyUserAverageSubjectStatistics["Sums"][3]*100)/4.5),0).'%');


			if ($MyUserAverageSubjectStatistics["Average"][2] <= 0){
				$MyUserAverageSubjectStatistics["Average"][2] = 0;
			}
			//echo '<p>Мнение за предмета - '.$MyUserAverageSubjectStatistics["Average"][2].'%</p>';

			PrintPercentagebarSimple($MyUserAverageSubjectStatistics["Average"][2], 'Мнение за предмета', number_format($MyUserAverageSubjectStatistics["Average"][2], 0).'%');

			if ($MyUserAverageSubjectStatistics["Average"][4] <= 0){
				$MyUserAverageSubjectStatistics["Average"][4] = 0;
			}
			//echo '<p>Научено по предмета - '.$MyUserAverageSubjectStatistics["Average"][4].'%</p>';

			PrintPercentagebarSimple($MyUserAverageSubjectStatistics["Average"][4], 'Научено ', number_format($MyUserAverageSubjectStatistics["Average"][4],0).'%');

			if ($MyUserAverageSubjectStatistics["Average"][5] <= 0){
				$MyUserAverageSubjectStatistics["Average"][5] = 0;
			}
			if ($MyUserAverageSubjectStatistics["Average"][5] > 0){
				$MyCheating = ((5-$MyUserAverageSubjectStatistics["Average"][5])*20);
			} else {
				$MyCheating = 0;
			}

			PrintPercentagebarSimple($MyCheating, 'Преписване ', number_format($MyCheating,0).'%');

			echo '</div>';
		echo '</div>';
		echo '</div>';
		//echo '</div>';

		return "YESS";
	}

?>
