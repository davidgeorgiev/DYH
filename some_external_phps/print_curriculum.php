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
				echo '<div id = "StandartBox" style = "padding:20px;margin:0px;">';
					echo '<h1 id = "StandartTitle" style = "padding-bottom:10px;">';
						echo $WeekDayBG.$CustomText;
					echo '</h1>';
						//echo '</th>';
						//echo '</tr>';
					//echo '</thead>';
					//echo '<tbody>';
						for ($i = 1; $i <= 9; $i++){
							//echo "<tr>";

							if (mb_strlen($MyCurriculum[$WeekDay][$i]["Subject"], 'UTF-8') > 20){
								$IsLonger = 1;
								$MySymbol = "...";
							} else {
								$IsLonger = 0;
								$MySymbol = "";
							}

							//echo '<td data-label="'.$WeekDayBG.'">'.$i.'</td>';
								//echo '<td>';
								echo '<p class = "InfoTitleLabel" style = "padding-top:6px;">';
								echo $i.'. ';
								echo $MyCurriculum[$WeekDay][$i]["Time"].' ';
								//echo '</td>';
								if ($IsLonger == 1){
									$onhover = 'title="'.$MyCurriculum[$WeekDay][$i]["Subject"].'"';
								} else {
									$onhover = "";
								}
								//echo '<td '.$onhover.'>';
								echo mb_substr($MyCurriculum[$WeekDay][$i]["Subject"],0,20,'UTF-8').$MySymbol.' ';
								//echo '</td>';
								//echo '<td>';
								echo $MyCurriculum[$WeekDay][$i]["Info"];
								echo '</p>';
								//echo '</td>';
							//echo '</tr>';
						}
						echo '</div>';
					//echo '</tbody>';

				//echo '</table>';
	}
?>
