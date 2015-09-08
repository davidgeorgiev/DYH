<?php
	//include "../config.php";
	function ReturnCurriculumByUserName($myusername, $eoweek) {
		
		$MyDayArray = array();
		$MyWeek = array();
		
		for ($counter = 1; $counter <= 7; $counter++) {
		
		
			switch($counter) {
				case 1: $WeekDay = "Monday";
				break;
				case 2: $WeekDay = "Tuesday";
				break;
				case 3: $WeekDay = "Wednesday";
				break;
				case 4: $WeekDay = "Thursday";
				break;
				case 5: $WeekDay = "Friday";
				break;
				case 6: $WeekDay = "Saturday";
				break;
				case 7: $WeekDay = "Sunday";
				break;
			}
			
			for ($i=1; $i<=9; $i++){
				
				
				$SQL = "SELECT class.time, class.subjectid, class.info FROM class, day, weeks, twoweeks, uw, user WHERE user.UID = uw.UserID AND twoweeks.UID = uw.TwoWeeksID AND twoweeks.".$eoweek." = weeks.UID AND day.UID = weeks.".$WeekDay."ID AND class.UID = day.class".$i."ID AND user.Name = '".$myusername."' ORDER BY twoweeks.UID DESC";
				//echo $SQL;
				
				$result3 = mysql_query($SQL);
				$row3 = mysql_fetch_array($result3);
				
				$MyDayArray[$i]["Time"] = strtotime($row3[0]);
				$MyDayArray[$i]["Time"] = date('H:i',$MyDayArray[$i]["Time"]);
				
				$SQL = "SELECT subjects.Name FROM subjects WHERE subjects.UID = ".$row3[1];
				$SubjectNameResult = mysql_query($SQL);
				$MySubjectName = mysql_fetch_array($SubjectNameResult);
				
				$MyDayArray[$i]["Subject"] = $MySubjectName[0];
				$MyDayArray[$i]["Info"] = $row3[2];
				
				
				
			}
			$MyWeek["$WeekDay"] = $MyDayArray;
		}
		return $MyWeek;
	}
	
	//print_r(ReturnCurriculumByUserName("david", "OddWeekID"));
?>