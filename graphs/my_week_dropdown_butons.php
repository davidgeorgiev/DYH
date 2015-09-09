<?php
	//print_r($done_array1);
	function PrintMyWeekDropdownButtons($done_array1){
		echo '<style>.btn-group {width:'.(93/(sizeof($done_array1))).'%;}.btn btn-default dropdown-toggle{width: 100%;}</style>';
		echo '<div style = "margin-left: 5%;">';
		foreach ($done_array1 as $value){
			echo '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$timestamp = strtotime($value[0]);
			$weekday = date( "w", $timestamp);
			include "convert_weekday_from_php.php";
			
			echo $convertered_weekday;
			echo '<span class="caret"></span>';
			echo '</button>';
			echo '<ul class="dropdown-menu" style = "background-color: #d0c8c8;">';
			$SQL = "SELECT homeworks.Data, homeworks.Title, homeworks.Rank, homeworks.Type FROM homeworks WHERE homeworks.Date = '".$value[0]."'";
			$result4 = mysql_query($SQL);
			$SQL = "SELECT COUNT(homeworks.UID) FROM homeworks WHERE homeworks.Date = '".$value[0]."'";
			$result5 = mysql_query($SQL);
			$number_of_hws = mysql_fetch_array($result5);
			if ($number_of_hws[0] <= 0){
				echo '<li><a href="#">Няма нищо</a></li>';
			} else {
				while ($homework_info = mysql_fetch_array($result4)){
					
					if ($homework_info[3] == 0) {
						echo '<li style = "width:90%;margin-left:9px;background-color:#ade77f;text-align:center;">Домашно</li>';
					} else {
						echo '<li style = "width:90%;margin-left:9px;background-color:#7fc5e7;text-align:center;">Изпит</li>';
					}
					echo '<li><a href="#">'.$homework_info[1].'</a></li>';
					if (strlen($homeworks_info[0]) >= 0) {
						echo '<li><a href="#">'.$homework_info[0].'</a></li>';
					}
					//echo '<li><a href="#">'.$homework_info[2].'</a></li>';
					echo '<div style = "width:90%;padding-left:10px;padding-top:20px;">';
					if ($homework_info[2] == 1) {
						echo '<div class="progress">
							<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
								<span class="sr-only">25%</span>
							</div>
						</div>';
					} else if ($homework_info[2] == 2) {
						echo '<div class="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
								<span class="sr-only">50%</span>
							</div>
						</div>';
					} else if ($homework_info[2] == 3) {
						echo '<div class="progress">
							<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
								<span class="sr-only">75%</span>
							</div>
						</div>';
					} else if ($homework_info[2] == 4) {
						echo '<div class="progress">
							<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<span class="sr-only">100%</span>
							</div>
						</div>';
					}
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