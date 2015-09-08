<?php
	include "return_wp_by_user_name.php";
	function PrintCurriculum($username, $eoweek, $weekdayforprint, $CustomText) {
		$MyCurriculum = ReturnCurriculumByUserName($username, $eoweek);
			
			switch($weekdayforprint) {
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
			switch($weekdayforprint) {
				case 1: $WeekDayBG = "Понеделник";
				break;
				case 2: $WeekDayBG = "Вторник";
				break;
				case 3: $WeekDayBG = "Сряда";
				break;
				case 4: $WeekDayBG = "Четвъртък";
				break;
				case 5: $WeekDayBG = "Петък";
				break;
				case 6: $WeekDayBG = "Събота";
				break;
				case 7: $WeekDayBG = "Неделя";
				break;
			}
				echo '<table class="table" style = "float:left;margin-top:15px;font-size:16px;font-family:Arial;font-weight:bold;color:white;background-color: #6f6565;">';
					echo '<thead>';
						echo '<tr>';
						echo '	<th colspan="4">'.$WeekDayBG.$CustomText.'</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
						for ($i = 1; $i <= 9; $i++){
							echo "<tr>";
							
							if (mb_strlen($MyCurriculum[$WeekDay][$i]["Subject"], 'UTF-8') > 20){
								$IsLonger = 1;
								$MySymbol = "...";
							} else {
								$IsLonger = 0;
								$MySymbol = "";
							}
							
							echo '<td>'.$i.'</td>
								<td style = "font-size:16px;">'.$MyCurriculum[$WeekDay][$i]["Time"].'</td>';
								if ($IsLonger == 1){
									$onhover = 'title="'.$MyCurriculum[$WeekDay][$i]["Subject"].'"';
								} else {
									$onhover = "";
								}
								echo '<td '.$onhover.' style = "font-size:13px;">'.mb_substr($MyCurriculum[$WeekDay][$i]["Subject"],0,20,'UTF-8').$MySymbol.'</td>';
								echo '<td style = "font-size:16px;">'.$MyCurriculum[$WeekDay][$i]["Info"].'</td>';
							echo '</tr>';
						}
					echo '<tbody>';
						
				echo '</table>';
	}
?>