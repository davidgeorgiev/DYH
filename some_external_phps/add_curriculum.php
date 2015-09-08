<?php

	function AddCurriculum($userid, $classesArray){
		echo '<div class="panel panel-default">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">Информация за програмата</h3>';
			echo '</div>';
			echo '<div class="panel-body">';
			echo '<div class="row">';
				echo '<div class="col-sm-6">';
				echo 'Седмица: '.$classesArray["WEEK"];
				echo '</div>';
				echo '<div class="col-sm-6">';
				echo 'Ден: '.$classesArray["DAY"]; 
				echo '</div>';
				echo '</div>';

				echo '<div class="row">';
				
				//print_r($classesArray);
				include "convert_class_number_to_words.php";
				$idsArray = array();
				for ($counter = 0; $counter < sizeof($classesArray["HOURS"]); $counter++){
					echo '<div class="col-sm-4">';
						
						echo '<h3>'.ConvertClassNumberToWords($counter+1).' час</h3>';
						
						echo '<p>Време: '.$classesArray["HOURS"][$counter].'</p>';
						echo '<p>Предмет: '.$classesArray["SUBJECTS"][$counter];
						echo '<p>Информация: '.$classesArray["INFO"][$counter];
						
						$SQL = "INSERT INTO class (time, subjectid, info) VALUES ('".$classesArray["HOURS"][$counter]."',".$classesArray["SUBJECTS"][$counter].",'".$classesArray["INFO"][$counter]."')";
						//echo $SQL;
						$insertion = mysql_query($SQL);
						array_push($idsArray,mysql_insert_id());
						
					echo '</div>';
				}
				//print_r($idsArray);
				$SQL = "INSERT INTO day (";
				for ($counter = 0; $counter < sizeof($classesArray["HOURS"]); $counter++){
					if ($counter != (sizeof($classesArray["HOURS"]) - 1)){
						$symbol = ", ";
					} else {
						$symbol = "";
					}
					
					$SQL = $SQL."class".($counter+1)."ID".$symbol;
				}
				$SQL = $SQL.") ";
				$SQL = $SQL."VALUES (";
				
				for ($counter = 0; $counter < sizeof($classesArray["HOURS"]); $counter++){
					if ($counter != (sizeof($classesArray["HOURS"]) - 1)){
						$symbol = ", ";
					} else {
						$symbol = "";
					}
					$SQL = $SQL.$idsArray[$counter].$symbol;
					
					
				}
				$SQL = $SQL.")";
				$insertion = mysql_query($SQL);
				$InsertedDayID = mysql_insert_id();
				//echo $SQL;
				
				$SQL = "SELECT MAX(uw.TwoWeeksID) FROM uw, user WHERE uw.UserID = ".$userid;
				//echo $SQL;
				$TwoWeeksIDResult = mysql_query($SQL);
				$TwoWeeksID = mysql_fetch_array($TwoWeeksIDResult);
				
				if ($classesArray["WEEK"] == 1) {
					//$NextWeek = "EvenWeekID";
					$CurrentWeek = "OddWeekID";
				} else if ($classesArray["WEEK"] == 2){
					//$NextWeek = "OddWeekID";
					$CurrentWeek = "EvenWeekID";
				} else if ($classesArray["WEEK"] == 3){
					$CurrentWeek = "OtherWeekID";
				}
				
				$SQL = "SELECT twoweeks.".$CurrentWeek.", twoweeks.UID FROM twoweeks WHERE twoweeks.UID = ".$TwoWeeksID[0];
				//echo $SQL;
				$WeekIDResult = mysql_query($SQL);
				$WeekID = mysql_fetch_array($WeekIDResult);
				
				$SQL = "SELECT weeks.MondayId, weeks.TuesdayId, weeks.WednesdayId, weeks.ThursdayId, weeks.FridayId, weeks.SaturdayId, weeks.SundayId FROM weeks WHERE weeks.UID = ".$WeekID[0];
				//echo $SQL;
				$dayIDsResult = mysql_query($SQL);
				$dayIDs = mysql_fetch_array($dayIDsResult);
				
				
				
				//print_r($dayIDs);
				
				$dayIDs[($classesArray["DAY"]-1)] = $InsertedDayID;
				
				
					
				
				
				$SQL = "INSERT INTO weeks (MondayId, TuesdayId, WednesdayId, ThursdayId, FridayId, SaturdayId, SundayId) VALUES (";
				//echo $SQL;
				for ($counter = 0; $counter <= 6; $counter++){
				
					if ($counter != 6){
						$symbol = ", ";
					} else {
						$symbol = "";
					}
					$SQL = $SQL.$dayIDs[$counter].$symbol;
				
				}
				$SQL = $SQL.")";
				//echo "<p>".$SQL."</p>";
				$dayIDsResult = mysql_query($SQL);
				
				$AddedWeekId = mysql_insert_id();
				//echo $AddedWeekId;
				
				//$dayIDs = mysql_fetch_array($dayIDsResult);
				
				$SQL = "SELECT twoweeks.EvenWeekID, twoweeks.OddWeekID, twoweeks.OtherWeekID, twoweeks.CheckToOtherWeek FROM twoweeks WHERE twoweeks.UID = ".$TwoWeeksID[0];
				$NextWeekIdResult = mysql_query($SQL);
				$MyOldWeeksIDs = mysql_fetch_array($NextWeekIdResult);
				
				$MyOldWeeksIDs[($classesArray["WEEK"] - 1)] = $AddedWeekId;
				//echo $MyNextWeekID[0];
				
				$SQL = "INSERT INTO twoweeks (OddWeekID, EvenWeekID, OtherWeekID, CheckToOtherWeek) VALUES (".$MyOldWeeksIDs[0].", ".$MyOldWeeksIDs[1].", ".$MyOldWeeksIDs[2].", ".$MyOldWeeksIDs[3].")";
				$InsertingNewTwoWeeksResult = mysql_query($SQL);
				$MyInsertedNewTwoWeeksId = mysql_insert_id();
				
				//echo $MyInsertedNewTwoWeeksId;
				
				$SQL = "INSERT INTO uw (UserID, TwoWeeksID) VALUES (".$userid.", ".$MyInsertedNewTwoWeeksId.")";
				$InsertingNewUserWeekResult = mysql_query($SQL);
				
			echo '</div>';
		echo '</div>';
		include "garbage_collector.php";
		
	}

?>