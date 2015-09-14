<?php
	function ConvertWeekday($weekday){
		switch($weekday){
			case 0: return 'ЗА ПОНЕДЕЛНИК';
			break;
			case 1: return 'ЗА ВТОРНИК';
			break;
			case 2: return 'ЗА СРЯДА';
			break;
			case 3: return 'ЗА ЧЕТВЪРТЪК';
			break;
			case 4: return 'ЗА ПЕТЪК';
			break;
			case 5: return 'ЗА СЪБОТА';
			break;
			case 6: return 'ЗА НЕДЕЛЯ';
			break;
		}
	}
	function ReturnTypeOfHWinWords($type){
		switch($type){
			case 0: return "Домашно";
			break;
			case 1: return "Изпит";
			break;
			case 2: return "Напомняне";
			break;
		}
	}
	include "some_external_phps/return_hw_info_by_id.php";
	function PrintHWInfoInTableByID($hwid){
		$MyCurrentHomeworkIfno = returnHomeworkInfoByID($hwid);
		//print_r($MyCurrentHomeworkIfno);
		echo '<div id = "Curriculum">';
			echo '<table style = "height:100px;">';
				echo '<thead>';
					echo '<tr>';
						echo '<th colspan="2">';
							echo ConvertWeekday($MyCurrentHomeworkIfno["MainInfo"]["WEEKDAY"])." - ".$MyCurrentHomeworkIfno["MainInfo"]["Date"];
							
						echo '</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
					echo '<tr>';
						echo '<td>';
							echo ReturnTypeOfHWinWords($MyCurrentHomeworkIfno["MainInfo"]["Type"])." по ".$MyCurrentHomeworkIfno["MainInfo"]["Title"];
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td>';
							if (strlen($MyCurrentHomeworkIfno["MainInfo"]["IMGURL"]) <= 0){
								$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"] = "themes/no-image.jpg";
							}
							echo '<a href = "'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'" rel="lightbox"><img src = "'.$MyCurrentHomeworkIfno["MainInfo"]["IMGURL"].'" width = "100%"></a>';
						echo '</td>';
						echo '<tr>';
							echo '<td>';
								echo $MyCurrentHomeworkIfno["MainInfo"]["Data"];
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>';
								echo '<a href = "add_assessment_to_hw.php?hwid='.$hwid.'">Въведи оценка</a>';
							echo '</td>';
						echo '</tr>';
				echo '</tbody>';
			echo '</table>';
		echo '</div>';
		
	}

?>