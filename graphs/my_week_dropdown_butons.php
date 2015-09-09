<style>
#progressbar {
	background-color: #837d7c;
	border-radius: 3px; /* (height of inner div) / 2 + padding */
	padding: 3px;
}

#progressbar > div {
	background-color: #d2c9c6;
	width: 40%; /* Adjust with JavaScript */
	height: 20px;
	border-radius: 3px;
	text-align:center;font-size:16px;
	font-weight: normal;
}
</style>
<?php
	//print_r($done_array1);
	function PrintMyWeekDropdownButtons($done_array1){
		echo '<style>.btn-group {width:'.(93/(sizeof($done_array1))).'%;}.btn btn-default dropdown-toggle{width: 100%;}</style>';
		echo '<div style = "margin-left: 5%;">';
		foreach ($done_array1 as $value){
			if ($value[0] == gmdate("Y-m-d", time() + 3600*($timezone+date("I")))){
				$buttonClass = "btn btn-success dropdown-toggle";
			} else {
				$buttonClass = "btn btn-default dropdown-toggle";
			}
			echo '<div class="btn-group"><button type="button" class="'.$buttonClass.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$timestamp = strtotime($value[0]);
			$weekday = date( "w", $timestamp);
			include "convert_weekday_from_php.php";
			
			echo $convertered_weekday;
			echo '<span class="caret"></span>';
			echo '</button>';
			if ($_GET["width"] <= 768){
				$MyDropdownMenuWidth = 200;
			} else {
				$MyDropdownMenuWidth = 300;
			}
			echo '<ul class="dropdown-menu" style = "background-color: white;width:'.$MyDropdownMenuWidth.'px;padding-right:10px;padding-left:10px;padding-top:10px;padding-bottom:0px;">';
			$SQL = "SELECT homeworks.Data, homeworks.Title, homeworks.Rank, homeworks.Type FROM homeworks WHERE homeworks.Date = '".$value[0]."'";
			$result4 = mysql_query($SQL);
			$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks WHERE homeworks.Date = '".$value[0]."'";
			$result5 = mysql_query($SQL);
			$number_of_hws = mysql_fetch_array($result5);
			if ($number_of_hws[0] <= 0){
				echo '<p><a href="#">Няма нищо</a></p>';
			} else {
				while ($homework_info = mysql_fetch_array($result4)){
					$myHeadingBackgroundColor = "white";
					$myHeadingContent = "Неопределено събитие";
					if ($homework_info[3] == 0) {
						$myHeadingBackgroundColor = "#86cf4b";
						$myHeadingContent = "Домашно";
					} else if ($homework_info[3] == 1) {
						$myHeadingBackgroundColor = "#4ba8cf";
						$myHeadingContent = "Изпит";
					} else if ($homework_info[3] == 2) {
						$myHeadingBackgroundColor = "#dd8043";
						$myHeadingContent = "Друго";
					}
					
					echo '<p style = "background-color:'.$myHeadingBackgroundColor.';text-align:center;font-size:16px;border-radius:3px;border:solid #837d7c;">'.$myHeadingContent.'</p>';
					echo '<div style = "padding:0px;">';
					echo '<a href="#" style = "text-decoration:none;"><p style = "margin-top:-12px;padding:3px;text-align:center;background-color:#837d7c;color:#d2c9c6;font-weight:bold;">'.$homework_info[1].'</p></a>';
					if (strlen($homeworks_info[0]) >= 0) {
						echo '<a href="#" style = "text-decoration:none;"><p style = "background-color:#d2c9c6;border:solid #837d7c;padding-left:4px;padding-right:4px;padding-bottom:15px;padding-top:12px;margin-top:-10px;margin-bottom:-6px;color:#837d7c;font-size:15px;">'.$homework_info[0].'</p></a>';
					}
					//echo '<li><a href="#">'.$homework_info[2].'</a></li>';
					echo '</div>';
					echo '<div style = "margin-bottom:10px;">';
					
					$MyPercentage = ($homework_info[2]*25);
					
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